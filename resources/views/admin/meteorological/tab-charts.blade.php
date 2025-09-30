@extends('layouts.admin')

@section('title', $tab->heading . ' - Charts')
@section('page-title', $tab->heading)

@section('content')
<div class="row">
    <div class="col-12 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                &nbsp;
            </div>
            <div>
                <a href="{{ route('admin.meteorological.add.chart', $tab->id) }}" class="btn btn-primary mr-2">
                    <i class="fas fa-plus"></i> Add New Chart
                </a>
                <a href="{{ route('admin.meteorological.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Tabs
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Charts Display -->
<div class="row" id="chartsContainer">
    @if($tab->charts->count() > 0)
        @foreach($tab->charts as $chart)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-left-{{ $chart->chartData ? 'success' : 'warning' }} shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-{{ $chart->chartData ? 'success' : 'warning' }} text-uppercase mb-1">
                                {{ ucfirst($chart->chart_type) }} Chart
                            </div>
                            <div class="h6 mb-1 font-weight-bold text-gray-800">
                                {{ $chart->title }}
                            </div>
                            <div class="text-xs text-gray-600">
                                Status: {{ $chart->chartData ? 'Has Data' : 'No Data' }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-{{ $chart->chart_type == 'line' ? 'line' : ($chart->chart_type == 'bar' ? 'bar' : 'pie') }} fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    
                    <!-- Chart Preview (if has data) -->
                    @if($chart->chartData)
                    <div class="mt-3" style="position: relative; height: 200px;">
                        <canvas id="chart-{{ $chart->id }}" style="max-height: 200px; width: 100%;"></canvas>
                    </div>
                    @endif
                    
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('admin.meteorological.chart.data.form', $chart->id) }}" 
                               class="btn btn-info btn-sm btn-block">
                                <i class="fas fa-edit"></i> {{ $chart->chartData ? 'Edit' : 'Add' }} Data
                            </a>
                        <button class="btn btn-danger btn-sm btn-block delete-chart" 
                                    data-chart-id="{{ $chart->id }}" data-chart-title="{{ $chart->title }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-chart-line fa-5x text-gray-300 mb-4"></i>
                <h4 class="text-gray-500">No Charts in this Tab</h4>
                <p class="text-gray-400 mb-4">Start by creating your first chart for this meteorological tab.</p>
                <a href="{{ route('admin.meteorological.add.chart', $tab->id) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create First Chart
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteChartModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Chart Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Warning!</strong> This action will permanently delete the chart <strong id="deleteChartName"></strong>.
                </div>
                <p class="text-muted mb-0">Are you sure you want to continue? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteChart">Delete Chart</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>
                <span id="toastMessage">Chart deleted successfully!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <span id="errorToastMessage">Error occurred!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Initialize charts with data
    @foreach($tab->charts as $chart)
        @if($chart->chartData)
            try {
                // Build chart data from the chartData object properties
                const chartData{{ $chart->id }} = {
                    labels: @json($chart->chartData->labels ?? []),
                    datasets: @json($chart->chartData->datasets ?? [])
                };
                
                const canvasElement{{ $chart->id }} = document.getElementById('chart-{{ $chart->id }}');
                
                // Validate chart data
                if (!chartData{{ $chart->id }} || !chartData{{ $chart->id }}.labels || !chartData{{ $chart->id }}.datasets) {
                    return;
                }
                
                if (chartData{{ $chart->id }}.labels.length === 0 || chartData{{ $chart->id }}.datasets.length === 0) {
                    // Show a message in the chart area
                    if (canvasElement{{ $chart->id }}) {
                        const parent = canvasElement{{ $chart->id }}.parentElement;
                        parent.innerHTML = '<div class="text-center text-muted py-3"><i class="fas fa-chart-line"></i><br>No data available</div>';
                    }
                    return;
                }
                
                if (canvasElement{{ $chart->id }}) {
                    const ctx{{ $chart->id }} = canvasElement{{ $chart->id }}.getContext('2d');
                    
                    // Configure chart options based on chart type
                    let chartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom'
                            },
                            tooltip: {
                                enabled: true
                            }
                        }
                    };

                    // Add appropriate scales based on chart type
                    @if(in_array($chart->chart_type, ['scatter', 'bubble']))
                    chartOptions.scales = {
                        x: {
                            type: 'linear',
                            position: 'bottom'
                        },
                        y: {
                            type: 'linear'
                        }
                    };
                    @elseif(!in_array($chart->chart_type, ['pie', 'doughnut', 'polar', 'radar']))
                    chartOptions.scales = {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            display: true
                        }
                    };
                    @endif

                    new Chart(ctx{{ $chart->id }}, {
                        type: '{{ $chart->chart_type }}',
                        data: chartData{{ $chart->id }},
                        options: chartOptions
                    });
                }
            } catch (error) {
                // Silently handle chart initialization errors
            }
        @endif
    @endforeach
    
    // Delete chart functionality
    let currentChartId = null;
    let currentChartCard = null;
    
    $('.delete-chart').on('click', function() {
        const chartId = $(this).data('chart-id');
        const chartTitle = $(this).data('chart-title');
        const chartCard = $(this).closest('.col-lg-4');
        
        // Store current chart info
        currentChartId = chartId;
        currentChartCard = chartCard;
        
        // Show modal
        $('#deleteChartName').text(chartTitle);
        $('#deleteChartModal').modal('show');
    });
    
    // Handle confirm delete button click
    $('#confirmDeleteChart').on('click', function() {
        if (currentChartId && currentChartCard) {
            deleteChart(currentChartId, currentChartCard);
        }
    });
});

// Function to delete chart
function deleteChart(chartId, chartCard) {
    $.ajax({
        url: `{{ url('admin/meteorological/chart') }}/${chartId}`,
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            // Close modal
            $('#deleteChartModal').modal('hide');
            
            // Remove the chart card with animation
            chartCard.fadeOut(500, function() {
                $(this).remove();
                
                // Check if no charts remain, show empty state
                if ($('#chartsContainer .col-lg-4').length === 0) {
                    $('#chartsContainer').html(`
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-chart-line fa-5x text-gray-300 mb-4"></i>
                                <h4 class="text-gray-500">No Charts in this Tab</h4>
                                <p class="text-gray-400 mb-4">Start by creating your first chart for this meteorological tab.</p>
                                <a href="{{ route('admin.meteorological.add.chart', $tab->id) }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create First Chart
                                </a>
                            </div>
                        </div>
                    `);
                }
            });
            
            // Show success toast
            showSuccessToast('Chart deleted successfully!');
        },
        error: function(xhr) {
            // Close modal
            $('#deleteChartModal').modal('hide');
            showErrorToast('Error deleting chart. Please try again.');
        }
    });
}

// Toast helper functions
function showSuccessToast(message) {
    $('#toastMessage').text(message);
    const successToast = new bootstrap.Toast(document.getElementById('successToast'));
    successToast.show();
}

function showErrorToast(message) {
    $('#errorToastMessage').text(message);
    const errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
    errorToast.show();
}
</script>
@endpush