@extends('layouts.admin')

@section('title', 'Chart Data Input')
@section('page-title', 'Chart Data Input: ' . $chart->title)

@section('content')
<div class="row">
    <div class="col-lg-6">
        <!-- Data Input Form -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-keyboard"></i> Input Chart Data
                </h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong>{{ $chart->title }}</strong><br>
                    <small>Chart Type: {{ ucwords($chart->chart_type) }}</small><br>
                    <small>Tab: {{ $chart->tab->heading }}</small>
                </div>

                <form method="POST" action="{{ route('admin.meteorological.chart.data.store', $chart->id) }}" id="dataForm">
                    @csrf

                    <div class="form-group">
                        <label for="chart_title" class="font-weight-bold">Chart Title</label>
                        <input type="text" name="chart_title" id="chart_title" class="form-control" 
                               value="{{ $chart->title }}" required>
                        <small class="form-text text-muted">Update the chart title if needed</small>
                    </div>

                    <div class="form-group">
                        <label for="labels_input" class="font-weight-bold">Chart Labels</label>
                        <input type="text" name="labels_input" id="labels_input" class="form-control" 
                               value="{{ $existingData && $existingData['labels'] ? implode(', ', $existingData['labels']) : 'Label 1, Label 2, Label 3, Label 4, Label 5' }}" 
                               placeholder="Enter labels separated by commas" required>
                        <small class="form-text text-muted">Enter labels for your chart data separated by commas</small>
                    </div>

                    <!-- Multiple Datasets Section -->
                    @if(in_array($chart->chart_type, ['bar', 'line', 'area']))
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="font-weight-bold mb-0">Chart Datasets</label>
                            <button type="button" class="btn btn-primary btn-sm" id="addDatasetBtn">
                                <i class="fas fa-plus"></i> Add Dataset
                            </button>
                        </div>
                        
                        <div id="datasetsContainer">
                            @if($existingData && isset($existingData['datasets']) && count($existingData['datasets']) > 0)
                                @foreach($existingData['datasets'] as $index => $dataset)
                                <div class="dataset-item card mb-3" data-dataset-index="{{ $index }}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0">Dataset {{ $index + 1 }}</h6>
                                            @if($index > 0)
                                                <button type="button" class="btn btn-danger btn-sm remove-dataset">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Dataset Label</label>
                                                <input type="text" name="datasets[{{ $index }}][label]" class="form-control dataset-label" 
                                                       value="{{ $dataset['label'] ?? 'Data Series ' . ($index + 1) }}" 
                                                       placeholder="Dataset Label" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Color</label>
                                                <input type="color" name="datasets[{{ $index }}][color]" class="form-control dataset-color" 
                                                       value="{{ $dataset['backgroundColor'] ?? '#36a2eb' }}" style="height: 38px;">
                                            </div>
                                        </div>
                                        
                                        <div class="mt-2">
                                            <label>Data Values (comma-separated)</label>
                                            <input type="text" name="datasets[{{ $index }}][data]" class="form-control dataset-data" 
                                                   value="{{ is_array($dataset['data']) ? implode(', ', $dataset['data']) : $dataset['data'] }}" 
                                                   placeholder="10, 20, 30, 40, 50" required>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <!-- Default first dataset -->
                                <div class="dataset-item card mb-3" data-dataset-index="0">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0">Dataset 1</h6>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Dataset Label</label>
                                                <input type="text" name="datasets[0][label]" class="form-control dataset-label" 
                                                       value="Data Series 1" placeholder="Dataset Label" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Color</label>
                                                <input type="color" name="datasets[0][color]" class="form-control dataset-color" 
                                                       value="#36a2eb" style="height: 38px;">
                                            </div>
                                        </div>
                                        
                                        <div class="mt-2">
                                            <label>Data Values (comma-separated)</label>
                                            <input type="text" name="datasets[0][data]" class="form-control dataset-data" 
                                                   value="10, 20, 30, 40, 50" placeholder="10, 20, 30, 40, 50" required>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <!-- Single dataset for pie, doughnut, etc. -->
                    <div class="form-group">
                        <label for="data_input" class="font-weight-bold">Chart Data</label>
                        <input type="text" name="data_input" id="data_input" class="form-control" 
                               value="{{ $existingData && $existingData['data'] ? implode(', ', $existingData['data']) : '10, 20, 30, 40, 50' }}" 
                               placeholder="Enter data values separated by commas" required>
                        <small class="form-text text-muted">Enter numeric values separated by commas</small>
                    </div>

                    <div class="form-group">
                        <label for="dataset_label" class="font-weight-bold">Dataset Label</label>
                        <input type="text" name="dataset_label" id="dataset_label" class="form-control" 
                               value="{{ $existingData && isset($existingData['datasets'][0]['label']) ? $existingData['datasets'][0]['label'] : 'Data Series' }}" 
                               placeholder="Enter dataset label">
                        <small class="form-text text-muted">Label for the data series</small>
                    </div>
                    @endif

                    @if(in_array($chart->chart_type, ['pie', 'doughnut', 'polarArea']))
                    <div class="form-group">
                        <label for="colors_input" class="font-weight-bold">Colors</label>
                        <input type="text" name="colors_input" id="colors_input" class="form-control" 
                               value="#ff6384, #36a2eb, #ffcd56, #4bc0c0, #9966ff" 
                               placeholder="Enter hex colors separated by commas">
                        <small class="form-text text-muted">Enter hex colors for each data segment (optional)</small>
                    </div>
                    @endif

                    <div class="form-group mb-0">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.meteorological.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list"></i> Back to List
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Save Chart Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <!-- Live Preview -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-eye"></i> Live Preview
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="previewChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart Info -->
        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-info-circle"></i> Chart Information
                </h6>
            </div>
            <div class="card-body">
                <p><strong>Chart Type:</strong> {{ ucwords(str_replace(['24h', 'Bc', 'Smps'], ['24h', 'BC', 'SMPS'], $chart->chart_type)) }}</p>
                @if($chart->chart_type === 'weatherCurrent')
                    <p><strong>Description:</strong> Current weather conditions displayed as a bar chart</p>
                @elseif($chart->chart_type === 'weatherMinMax')
                    <p><strong>Description:</strong> Minimum and maximum values comparison</p>
                @elseif(str_contains($chart->chart_type, '24h'))
                    <p><strong>Description:</strong> 24-hour trend data displayed as a line chart</p>
                @endif
                <p><strong>Updates:</strong> Data updates in real-time as you type</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let previewChart = null;

// Wait for both jQuery and Chart.js to be available
function waitForLibraries() {
    if (typeof $ !== 'undefined' && typeof Chart !== 'undefined') {
        initializePreviewChart();
        setupEventHandlers();
    } else {
        setTimeout(waitForLibraries, 100);
    }
}

// Use vanilla JS for initial setup
document.addEventListener('DOMContentLoaded', function() {
    waitForLibraries();
});

function setupEventHandlers() {
    // Update chart on input change
    $(document).on('input change', 'input[type="text"], input[type="color"]', updatePreviewChart);
    
    // Add dataset button
    $('#addDatasetBtn').on('click', addDataset);
    
    // Remove dataset button (delegated event)
    $(document).on('click', '.remove-dataset', function() {
        $(this).closest('.dataset-item').remove();
        reindexDatasets();
        updatePreviewChart();
    });
    
    // Add sample data button
    const sampleBtn = $('<button type="button" class="btn btn-info btn-sm mt-2">Generate Sample Data</button>');
    sampleBtn.on('click', generateSampleData);
    $('#labels_input').after(sampleBtn);
}

let datasetCounter = 1;

function addDataset() {
    const chartType = '{{ $chart->chart_type }}';
    if (!['bar', 'line', 'area'].includes(chartType)) return;
    
    const colors = ['#ff6384', '#4bc0c0', '#ffcd56', '#9966ff', '#ff9f40', '#36a2eb'];
    const colorIndex = datasetCounter % colors.length;
    
    const datasetHtml = `
        <div class="dataset-item card mb-3" data-dataset-index="${datasetCounter}">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Dataset ${datasetCounter + 1}</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-dataset">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <label>Dataset Label</label>
                        <input type="text" name="datasets[${datasetCounter}][label]" class="form-control dataset-label" 
                               value="Data Series ${datasetCounter + 1}" placeholder="Dataset Label" required>
                    </div>
                    <div class="col-md-6">
                        <label>Color</label>
                        <input type="color" name="datasets[${datasetCounter}][color]" class="form-control dataset-color" 
                               value="${colors[colorIndex]}" style="height: 38px;">
                    </div>
                </div>
                
                <div class="mt-2">
                    <label>Data Values (comma-separated)</label>
                    <input type="text" name="datasets[${datasetCounter}][data]" class="form-control dataset-data" 
                           value="5, 15, 25, 35, 45" placeholder="10, 20, 30, 40, 50" required>
                </div>
            </div>
        </div>
    `;
    
    $('#datasetsContainer').append(datasetHtml);
    datasetCounter++;
    updatePreviewChart();
}

function reindexDatasets() {
    $('#datasetsContainer .dataset-item').each(function(index) {
        $(this).attr('data-dataset-index', index);
        $(this).find('h6').text('Dataset ' + (index + 1));
        $(this).find('input[name*="[label]"]').attr('name', `datasets[${index}][label]`);
        $(this).find('input[name*="[color]"]').attr('name', `datasets[${index}][color]`);
        $(this).find('input[name*="[data]"]').attr('name', `datasets[${index}][data]`);
        
        // Update placeholder text
        if ($(this).find('.dataset-label').val() === `Data Series ${index + 2}` || $(this).find('.dataset-label').val() === `Data Series ${index}`) {
            $(this).find('.dataset-label').val(`Data Series ${index + 1}`);
        }
    });
}

function initializePreviewChart() {
    const ctx = document.getElementById('previewChart').getContext('2d');
    const chartType = '{{ $chart->chart_type }}';
    
    previewChart = new Chart(ctx, getChartConfig(chartType));
    updatePreviewChart();
}

function updatePreviewChart() {
    if (!previewChart) return;
    
    const chartType = '{{ $chart->chart_type }}';
    const data = collectFormData(chartType);
    
    if (data) {
        previewChart.data = data;
        previewChart.update();
    }
}

function collectFormData(chartType) {
    // Get labels
    const labelsInput = $('#labels_input').val();
    const labels = labelsInput ? labelsInput.split(',').map(label => label.trim()) : [];
    
    let datasets = [];
    
    if (['bar', 'line', 'area'].includes(chartType)) {
        // Multiple datasets support
        $('#datasetsContainer .dataset-item').each(function() {
            const label = $(this).find('.dataset-label').val() || 'Data Series';
            const color = $(this).find('.dataset-color').val() || '#36a2eb';
            const dataInput = $(this).find('.dataset-data').val();
            const data = dataInput ? dataInput.split(',').map(value => parseFloat(value.trim()) || 0) : [];
            
            let dataset = {
                label: label,
                data: data
            };

            if (chartType === 'line') {
                dataset.borderColor = color;
                dataset.backgroundColor = color + '40'; // Add transparency
                dataset.fill = false;
                dataset.tension = 0.4;
            } else if (chartType === 'area') {
                dataset.borderColor = color;
                dataset.backgroundColor = color + '40';
                dataset.fill = true;
                dataset.tension = 0.4;
            } else {
                dataset.backgroundColor = color;
                dataset.borderColor = color;
            }
            
            datasets.push(dataset);
        });
    } else {
        // Single dataset for pie, doughnut, etc.
        const dataInput = $('#data_input').val();
        const data = dataInput ? dataInput.split(',').map(value => parseFloat(value.trim()) || 0) : [];
        const datasetLabel = $('#dataset_label').val() || 'Data Series';
        
        // Get colors for pie/doughnut charts
        const colorsInput = $('#colors_input').val();
        const colors = colorsInput ? 
            colorsInput.split(',').map(color => color.trim()) : 
            ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0', '#9966ff'];

        let dataset = {
            label: datasetLabel,
            data: data
        };

        if (['pie', 'doughnut', 'polarArea'].includes(chartType)) {
            dataset.backgroundColor = colors.slice(0, data.length);
        } else {
            dataset.backgroundColor = '#36a2eb';
            dataset.borderColor = '#36a2eb';
        }
        
        datasets.push(dataset);
    }

    return {
        labels: labels,
        datasets: datasets
    };
}function getChartConfig(chartType) {
    let config = {
        type: chartType,
        data: { labels: [], datasets: [] },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    };

    // Add scales for charts that need them
    if (['bar', 'line', 'area'].includes(chartType)) {
        config.options.scales = {
            y: {
                beginAtZero: true
            }
        };
    }

    // Handle scatter and bubble charts
    if (['scatter', 'bubble'].includes(chartType)) {
        config.options.scales = {
            x: {
                type: 'linear',
                position: 'bottom'
            },
            y: {
                type: 'linear'
            }
        };
    }

    return config;
}

// Generate sample data button
function generateSampleData() {
    const sampleLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    $('#labels_input').val(sampleLabels.join(', '));
    
    const chartType = '{{ $chart->chart_type }}';
    
    if (['bar', 'line', 'area'].includes(chartType)) {
        // Generate sample data for multiple datasets
        $('#datasetsContainer .dataset-item').each(function() {
            const sampleData = Array.from({length: 6}, () => Math.floor(Math.random() * 100) + 1);
            $(this).find('.dataset-data').val(sampleData.join(', '));
        });
    } else {
        // Generate sample data for single dataset
        const sampleData = Array.from({length: 6}, () => Math.floor(Math.random() * 100) + 1);
        $('#data_input').val(sampleData.join(', '));
    }
    
    updatePreviewChart();
}
</script>
@endpush