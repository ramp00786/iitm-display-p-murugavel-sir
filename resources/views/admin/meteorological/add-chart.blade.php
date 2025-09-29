@extends('layouts.admin')

@section('title', 'Add Chart to Tab')
@section('page-title', 'Add Chart to Tab: ' . $tab->heading)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-line"></i> Step 2: Select Chart Type
                </h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> 
                    Adding chart to tab: <strong>{{ $tab->heading }}</strong>
                </div>

                <div class="row">
                    <!-- Bar Chart -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card chart-preview-card">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0">Bar Chart</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="barChart" width="300" height="200"></canvas>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-success btn-select" 
                                            data-chart-type="bar" data-chart-title="Bar Chart">
                                        <i class="fas fa-check"></i> Select This Chart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Line Chart -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card chart-preview-card">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0">Line Chart</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="lineChart" width="300" height="200"></canvas>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-success btn-select" 
                                            data-chart-type="line" data-chart-title="Line Chart">
                                        <i class="fas fa-check"></i> Select This Chart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Area Chart -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card chart-preview-card">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">Area Chart</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="areaChart" width="300" height="200"></canvas>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-success btn-select" 
                                            data-chart-type="area" data-chart-title="Area Chart">
                                        <i class="fas fa-check"></i> Select This Chart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card chart-preview-card">
                            <div class="card-header bg-warning text-white">
                                <h6 class="mb-0">Pie Chart</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart" width="300" height="200"></canvas>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-success btn-select" 
                                            data-chart-type="pie" data-chart-title="Pie Chart">
                                        <i class="fas fa-check"></i> Select This Chart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Doughnut Chart -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card chart-preview-card">
                            <div class="card-header bg-danger text-white">
                                <h6 class="mb-0">Doughnut Chart</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="doughnutChart" width="300" height="200"></canvas>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-success btn-select" 
                                            data-chart-type="doughnut" data-chart-title="Doughnut Chart">
                                        <i class="fas fa-check"></i> Select This Chart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Radar Chart -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card chart-preview-card">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0">Radar Chart</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="radarChart" width="300" height="200"></canvas>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-success btn-select" 
                                            data-chart-type="radar" data-chart-title="Radar Chart">
                                        <i class="fas fa-check"></i> Select This Chart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Polar Area Chart -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card chart-preview-card">
                            <div class="card-header bg-dark text-white">
                                <h6 class="mb-0">Polar Area Chart</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="polarChart" width="300" height="200"></canvas>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-success btn-select" 
                                            data-chart-type="polarArea" data-chart-title="Polar Area Chart">
                                        <i class="fas fa-check"></i> Select This Chart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Scatter Chart -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card chart-preview-card">
                            <div class="card-header" style="background-color: #6f42c1; color: white;">
                                <h6 class="mb-0">Scatter Chart</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="scatterChart" width="300" height="200"></canvas>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-success btn-select" 
                                            data-chart-type="scatter" data-chart-title="Scatter Chart">
                                        <i class="fas fa-check"></i> Select This Chart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bubble Chart -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card chart-preview-card">
                            <div class="card-header" style="background-color: #e83e8c; color: white;">
                                <h6 class="mb-0">Bubble Chart</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="bubbleChart" width="300" height="200"></canvas>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-success btn-select" 
                                            data-chart-type="bubble" data-chart-title="Bubble Chart">
                                        <i class="fas fa-check"></i> Select This Chart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('admin.meteorological.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Wait for Chart.js to load before initializing charts
console.log("loading")
function waitForChart() {
    console.log('Waiting for Chart.js...');
    if (typeof Chart !== 'undefined') {
        console.log('Chart.js loaded, initializing charts...');
        initializeCharts();
    } else {
        console.log('Chart.js not yet loaded, retrying...');
        setTimeout(waitForChart, 100);
    }
}

// Use both jQuery and vanilla JS fallback
if (typeof $ !== 'undefined') {
    $(document).ready(function() {
        console.log('Document ready with jQuery');
        waitForChart();
        
        // Handle select buttons
        $('.btn-select').on('click', function() {
        const chartType = $(this).data('chart-type');
        const chartTitle = $(this).data('chart-title');
        
        // Create form and submit
        const form = $('<form>', {
            'method': 'POST',
            'action': '{{ route("admin.meteorological.store.chart") }}'
        });
        
        form.append($('<input>', {
            'type': 'hidden',
            'name': '_token',
            'value': '{{ csrf_token() }}'
        }));
        
        form.append($('<input>', {
            'type': 'hidden',
            'name': 'tab_id',
            'value': '{{ $tab->id }}'
        }));
        
        form.append($('<input>', {
            'type': 'hidden',
            'name': 'chart_type',
            'value': chartType
        }));
        
        form.append($('<input>', {
            'type': 'hidden',
            'name': 'title',
            'value': chartTitle
        }));
        
        $('body').append(form);
        form.submit();
    });
    });
} else {
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Document ready with vanilla JS');
        waitForChart();
        
        // Handle select buttons
        document.querySelectorAll('.btn-select').forEach(function(button) {
            button.addEventListener('click', function() {
                const chartType = this.getAttribute('data-chart-type');
                const chartTitle = this.getAttribute('data-chart-title');
                
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.meteorological.store.chart") }}';
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);
                
                const tabInput = document.createElement('input');
                tabInput.type = 'hidden';
                tabInput.name = 'tab_id';
                tabInput.value = '{{ $tab->id }}';
                form.appendChild(tabInput);
                
                const typeInput = document.createElement('input');
                typeInput.type = 'hidden';
                typeInput.name = 'chart_type';
                typeInput.value = chartType;
                form.appendChild(typeInput);
                
                const titleInput = document.createElement('input');
                titleInput.type = 'hidden';
                titleInput.name = 'title';
                titleInput.value = chartTitle;
                form.appendChild(titleInput);
                
                document.body.appendChild(form);
                form.submit();
            });
        });
    });
}

function initializeCharts() {
    console.log('Initializing charts...');
    console.log('Chart.js available:', typeof Chart !== 'undefined');
    
    // Check if canvas elements exist
    const canvasElements = ['barChart', 'lineChart', 'areaChart', 'pieChart', 'doughnutChart', 'radarChart', 'polarChart', 'scatterChart', 'bubbleChart'];
    canvasElements.forEach(id => {
        const element = document.getElementById(id);
        console.log(`Canvas ${id}:`, element ? 'found' : 'NOT FOUND');
    });
    
    // Sample data
    const sampleData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Dataset 1',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };

    const lineData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Temperature',
            data: [15, 18, 22, 25, 28, 30],
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.4
        }]
    };

    const scatterData = {
        datasets: [{
            label: 'Scatter Dataset',
            data: [{x: -10, y: 0}, {x: 0, y: 10}, {x: 10, y: 5}, {x: 0.5, y: 5.5}],
            backgroundColor: 'rgb(255, 99, 132)'
        }]
    };

    const bubbleData = {
        datasets: [{
            label: 'Bubble Dataset',
            data: [{x: 20, y: 30, r: 15}, {x: 40, y: 10, r: 10}],
            backgroundColor: 'rgb(255, 99, 132)'
        }]
    };

    // Bar Chart
    try {
        const barCanvas = document.getElementById('barChart');
        if (barCanvas) {
            new Chart(barCanvas, {
                type: 'bar',
                data: sampleData,
                options: { responsive: true, maintainAspectRatio: false }
            });
            console.log('Bar chart created successfully');
        } else {
            console.error('Bar chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating bar chart:', error);
    }

    // Line Chart
    try {
        const lineCanvas = document.getElementById('lineChart');
        if (lineCanvas) {
            new Chart(lineCanvas, {
                type: 'line',
                data: lineData,
                options: { responsive: true, maintainAspectRatio: false }
            });
            console.log('Line chart created successfully');
        } else {
            console.error('Line chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating line chart:', error);
    }

    // Area Chart
    try {
        const areaCanvas = document.getElementById('areaChart');
        if (areaCanvas) {
            new Chart(areaCanvas, {
                type: 'line',
                data: {
                    ...lineData,
                    datasets: [{
                        ...lineData.datasets[0],
                        fill: true
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
            console.log('Area chart created successfully');
        } else {
            console.error('Area chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating area chart:', error);
    }

    // Pie Chart
    try {
        const pieCanvas = document.getElementById('pieChart');
        if (pieCanvas) {
            new Chart(pieCanvas, {
                type: 'pie',
                data: sampleData,
                options: { responsive: true, maintainAspectRatio: false }
            });
            console.log('Pie chart created successfully');
        } else {
            console.error('Pie chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating pie chart:', error);
    }

    // Doughnut Chart
    try {
        const doughnutCanvas = document.getElementById('doughnutChart');
        if (doughnutCanvas) {
            new Chart(doughnutCanvas, {
                type: 'doughnut',
                data: sampleData,
                options: { responsive: true, maintainAspectRatio: false }
            });
            console.log('Doughnut chart created successfully');
        } else {
            console.error('Doughnut chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating doughnut chart:', error);
    }

    // Radar Chart
    try {
        const radarCanvas = document.getElementById('radarChart');
        if (radarCanvas) {
            new Chart(radarCanvas, {
                type: 'radar',
                data: {
                    labels: ['Speed', 'Reliability', 'Comfort', 'Safety', 'Efficiency'],
                    datasets: [{
                        label: 'Performance',
                        data: [80, 90, 70, 85, 75],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)'
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
            console.log('Radar chart created successfully');
        } else {
            console.error('Radar chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating radar chart:', error);
    }

    // Polar Area Chart
    try {
        const polarCanvas = document.getElementById('polarChart');
        if (polarCanvas) {
            new Chart(polarCanvas, {
                type: 'polarArea',
                data: sampleData,
                options: { responsive: true, maintainAspectRatio: false }
            });
            console.log('Polar chart created successfully');
        } else {
            console.error('Polar chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating polar chart:', error);
    }

    // Scatter Chart
    try {
        const scatterCanvas = document.getElementById('scatterChart');
        if (scatterCanvas) {
            new Chart(scatterCanvas, {
                type: 'scatter',
                data: scatterData,
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false,
                    scales: {
                        x: { type: 'linear', position: 'bottom' },
                        y: { type: 'linear' }
                    }
                }
            });
            console.log('Scatter chart created successfully');
        } else {
            console.error('Scatter chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating scatter chart:', error);
    }

    // Bubble Chart
    try {
        const bubbleCanvas = document.getElementById('bubbleChart');
        if (bubbleCanvas) {
            new Chart(bubbleCanvas, {
                type: 'bubble',
                data: bubbleData,
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false,
                    scales: {
                        x: { type: 'linear', position: 'bottom' },
                        y: { type: 'linear' }
                    }
                }
            });
            console.log('Bubble chart created successfully');
        } else {
            console.error('Bubble chart canvas not found');
        }
    } catch (error) {
        console.error('Error creating bubble chart:', error);
    }
}
</script>

<style>
.chart-preview-card {
    transition: all 0.3s ease;
    border: 2px solid #e3e6f0;
}

.chart-preview-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
}

.chart-preview-card canvas {
    height: 200px !important;
}

.btn-select {
    transition: all 0.3s ease;
}

.btn-select:hover {
    transform: scale(1.05);
}
</style>
@endpush