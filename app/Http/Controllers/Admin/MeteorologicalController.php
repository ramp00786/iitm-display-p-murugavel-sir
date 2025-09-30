<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MeteorologicalTab;
use App\Models\MeteorologicalChart;
use App\Models\ChartData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MeteorologicalController extends Controller
{
    public function index()
    {
        $tabs = MeteorologicalTab::with(['charts.chartData'])
                                ->orderBy('order')
                                ->get();
        
        return view('admin.meteorological.index', compact('tabs'));
    }

    public function createTab()
    {
        return view('admin.meteorological.create-tab');
    }

    public function storeTab(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
        ]);

        // Auto-detect station from heading
        $heading = strtolower($request->heading);
        $dataStation = 'solapur'; // default
        
        if (strpos($heading, 'delhi') !== false) {
            $dataStation = 'delhi';
        } elseif (strpos($heading, 'chennai') !== false) {
            $dataStation = 'chennai';
        } elseif (strpos($heading, 'pune') !== false) {
            $dataStation = 'pune';
        } elseif (strpos($heading, 'solapur') !== false) {
            $dataStation = 'solapur';
        }

        $maxOrder = MeteorologicalTab::max('order') ?? 0;

        $tab = MeteorologicalTab::create([
            'heading' => $request->heading,
            'data_station' => $dataStation,
            'order' => $maxOrder + 1,
            'is_active' => true,
        ]);

        return redirect()->route('admin.meteorological.add.chart', $tab->id)
                         ->with('success', 'Tab created successfully. Now add charts to this tab.');
    }

    public function addChart($tabId)
    {
        $tab = MeteorologicalTab::findOrFail($tabId);
        return view('admin.meteorological.add-chart', compact('tab'));
    }

    public function showChartTypes()
    {
        $chartTypes = MeteorologicalChart::getChartTypes();
        return view('admin.meteorological.chart-types', compact('chartTypes'));
    }

    public function storeChart(Request $request)
    {
        $request->validate([
            'tab_id' => 'required|exists:meteorological_tabs,id',
            'title' => 'required|string|max:255',
            'chart_type' => 'required|string|in:bar,line,area,pie,doughnut,radar,polarArea,scatter,bubble',
        ]);

        $maxOrder = MeteorologicalChart::where('tab_id', $request->tab_id)->max('order') ?? 0;

        $chart = MeteorologicalChart::create([
            'tab_id' => $request->tab_id,
            'title' => $request->title,
            'chart_type' => $request->chart_type,
            'order' => $maxOrder + 1,
            'is_active' => true,
        ]);

        return redirect()->route('admin.meteorological.chart.data.form', $chart->id)
                         ->with('success', 'Chart created successfully. Now add data to this chart.');
    }

    public function chartDataForm($chartId)
    {
        $chart = MeteorologicalChart::with(['chartData', 'tab'])->findOrFail($chartId);
        
        // Get existing data or create empty structure
        $existingData = $chart->chartData ? [
            'data' => $chart->chartData->data,
            'labels' => $chart->chartData->labels,
            'datasets' => $chart->chartData->datasets,
        ] : null;

        return view('admin.meteorological.chart-data-form', compact('chart', 'existingData'));
    }

    public function storeChartData(Request $request, $chartId)
    {
        $chart = MeteorologicalChart::findOrFail($chartId);
        
        $validationRules = $this->getValidationRulesForChartType($chart->chart_type);
        $request->validate($validationRules);

        $chartData = $this->processChartData($request, $chart->chart_type);

        // Update chart title if changed
        if ($request->chart_title !== $chart->title) {
            $chart->update(['title' => $request->chart_title]);
        }

        // Create or update chart data
        ChartData::updateOrCreate(
            ['chart_id' => $chart->id],
            [
                'data' => $chartData['data'],
                'labels' => $chartData['labels'] ?? null,
                'datasets' => $chartData['datasets'] ?? null,
            ]
        );

        return redirect()->route('admin.meteorological.index')
                         ->with('success', 'Chart data saved successfully!');
    }

    public function deleteTab($tabId)
    {
        $tab = MeteorologicalTab::findOrFail($tabId);
        $tab->delete();

        return redirect()->route('admin.meteorological.index')
                         ->with('success', 'Tab and all its charts deleted successfully!');
    }

    public function deleteTabWithPassword(Request $request, $tabId)
    {
        $request->validate([
            'admin_password' => 'required'
        ]);

        // Verify admin password
        if (!auth()->check() || !Hash::check($request->admin_password, auth()->user()->password)) {
            return response()->json(['error' => 'Incorrect admin password'], 401);
        }

        $tab = MeteorologicalTab::findOrFail($tabId);
        
        // Delete all related charts and their data
        foreach ($tab->charts as $chart) {
            $chart->delete();
        }
        
        // Delete the tab
        $tab->delete();

        return response()->json(['success' => 'Tab and all charts deleted successfully']);
    }

    public function deleteChart(Request $request, $chartId)
    {
        $chart = MeteorologicalChart::findOrFail($chartId);
        $tabId = $chart->tab_id;
        $chart->delete();

        // Check if it's an AJAX request
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Chart deleted successfully!']);
        }

        return redirect()->route('admin.meteorological.index')
                         ->with('success', 'Chart deleted successfully!');
    }

    private function getValidationRulesForChartType($chartType)
    {
        $rules = [
            'chart_title' => 'required|string|max:255',
            'labels_input' => 'required|string',
        ];

        if (in_array($chartType, ['bar', 'line', 'area'])) {
            // Multiple datasets validation
            $rules['datasets'] = 'required|array|min:1';
            $rules['datasets.*.label'] = 'required|string|max:255';
            $rules['datasets.*.color'] = 'required|string';
            $rules['datasets.*.data'] = 'required|string';
        } else {
            // Single dataset validation
            $rules['data_input'] = 'required|string';
            $rules['dataset_label'] = 'required|string|max:255';
            $rules['colors_input'] = 'nullable|string';
        }

        return $rules;
    }

    private function processChartData($request, $chartType)
    {
        // Parse labels
        $labels = array_map('trim', explode(',', $request->labels_input));
        
        $datasets = [];

        if (in_array($chartType, ['bar', 'line', 'area'])) {
            // Handle multiple datasets
            foreach ($request->datasets as $datasetInput) {
                $data = array_map('floatval', array_map('trim', explode(',', $datasetInput['data'])));
                
                $dataset = [
                    'label' => $datasetInput['label'],
                    'data' => $data,
                    'backgroundColor' => $datasetInput['color'],
                    'borderColor' => $datasetInput['color'],
                ];

                if ($chartType === 'area') {
                    $dataset['fill'] = true;
                    $dataset['tension'] = 0.4;
                } elseif ($chartType === 'line') {
                    $dataset['fill'] = false;
                    $dataset['tension'] = 0.4;
                }

                $datasets[] = $dataset;
            }
        } elseif (in_array($chartType, ['scatter', 'bubble'])) {
            // Handle scatter and bubble charts (special x,y,r format)
            $dataInput = trim($request->data_input);
            $data = [];
            
            if ($chartType === 'bubble') {
                // Parse bubble data in format: "x1,y1,r1;x2,y2,r2;x3,y3,r3"
                $points = array_filter(array_map('trim', explode(';', $dataInput)));
                foreach ($points as $point) {
                    $coords = array_map('floatval', array_map('trim', explode(',', $point)));
                    if (count($coords) >= 3) {
                        $data[] = ['x' => $coords[0], 'y' => $coords[1], 'r' => $coords[2]];
                    }
                }
            } else {
                // Parse scatter data in format: "x1,y1;x2,y2;x3,y3"
                $points = array_filter(array_map('trim', explode(';', $dataInput)));
                foreach ($points as $point) {
                    $coords = array_map('floatval', array_map('trim', explode(',', $point)));
                    if (count($coords) >= 2) {
                        $data[] = ['x' => $coords[0], 'y' => $coords[1]];
                    }
                }
            }
            
            $dataset = [
                'label' => $request->dataset_label,
                'data' => $data,
                'backgroundColor' => $request->colors_input ? trim($request->colors_input) : '#36a2eb',
                'borderColor' => $request->colors_input ? trim($request->colors_input) : '#36a2eb',
            ];

            $datasets[] = $dataset;
        } else {
            // Handle single dataset for pie, doughnut, etc.
            $data = array_map('floatval', array_map('trim', explode(',', $request->data_input)));
            
            // Parse colors if provided
            $colors = $request->colors_input ? 
                array_map('trim', explode(',', $request->colors_input)) : 
                $this->getDefaultColors(count($data));

            $dataset = [
                'label' => $request->dataset_label,
                'data' => $data,
            ];

            if (in_array($chartType, ['pie', 'doughnut', 'polarArea'])) {
                $dataset['backgroundColor'] = $colors;
            } else {
                $dataset['backgroundColor'] = '#36a2eb';
                $dataset['borderColor'] = '#36a2eb';
            }

            $datasets[] = $dataset;
        }

        return [
            'data' => [], // Keep for backward compatibility
            'labels' => $labels,
            'datasets' => $datasets
        ];
    }

    private function getDefaultColors($count)
    {
        $defaultColors = [
            '#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0', 
            '#9966ff', '#ff9f40', '#ff6384', '#c9cbcf'
        ];
        
        return array_slice($defaultColors, 0, $count);
    }

    public function showTabChartsPage($tabId)
    {
        $tab = MeteorologicalTab::with(['charts' => function($query) {
            $query->with('chartData');
        }])->findOrFail($tabId);
        
        return view('admin.meteorological.tab-charts', compact('tab'));
    }

    public function getTabCharts($tabId)
    {
        $tab = MeteorologicalTab::with('charts.chartData')->findOrFail($tabId);
        
        $chartsHtml = '';
        if ($tab->charts->count() > 0) {
            foreach ($tab->charts as $chart) {
                $hasData = $chart->chartData ? 'success' : 'warning';
                $dataText = $chart->chartData ? 'Has Data' : 'No Data';
                
                $chartsHtml .= '
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card border-left-' . $hasData . '">
                            <div class="card-body">
                                <h6 class="font-weight-bold text-primary">' . htmlspecialchars($chart->title) . '</h6>
                                <p class="text-xs text-gray-600 mb-2">Type: ' . ucfirst($chart->chart_type) . '</p>
                                <span class="badge badge-' . $hasData . ' mb-2">' . $dataText . '</span>
                                <div class="btn-group w-100" role="group">
                                    <a href="' . route('admin.meteorological.chart.data.form', $chart->id) . '" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteChart(' . $chart->id . ', \'' . htmlspecialchars($chart->title) . '\')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        } else {
            $chartsHtml = '
                <div class="col-12 text-center py-4">
                    <i class="fas fa-chart-line fa-3x text-gray-300 mb-3"></i>
                    <p class="text-gray-500">No charts in this tab yet.</p>
                    <button class="btn btn-primary" onclick="window.location.href=\'' . route('admin.meteorological.add.chart', $tabId) . '\'">
                        <i class="fas fa-plus"></i> Add First Chart
                    </button>
                </div>
            ';
        }
        
        return response($chartsHtml);
    }

    public function updateTab(Request $request, $tabId)
    {
        $request->validate([
            'tab_heading' => 'required|string|max:255'
        ]);

        $tab = MeteorologicalTab::findOrFail($tabId);
        $tab->update([
            'heading' => $request->tab_heading
        ]);

        return response()->json(['success' => true, 'message' => 'Tab updated successfully']);
    }
}
