@extends('layouts.admin')

@section('title', 'Meteorological Data Guide')
@section('page-title', 'Meteorological Data Management Guide')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('admin.help.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Help Center
                </a>
                <a href="{{ route('admin.meteorological.index') }}" class="btn btn-info">
                    <i class="fas fa-cloud-sun me-2"></i>Go to Meteorological Data
                </a>
            </div>

            <!-- Introduction -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cloud-sun me-2"></i>
                        Meteorological Data System Overview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>What is the Meteorological System?</h6>
                            <p>This powerful system displays interactive weather and climate data through dynamic charts and graphs. It's designed to showcase real-time meteorological information from multiple stations in an engaging visual format.</p>
                            
                            <h6>Key Components:</h6>
                            <ul>
                                <li><strong>Weather Stations (Tabs):</strong> Different locations like Solapur, Delhi, Pune, Chennai</li>
                                <li><strong>Interactive Charts:</strong> Various chart types (bar, line, pie, radar, etc.)</li>
                                <li><strong>Real-time Data:</strong> Live updates and measurements</li>
                                <li><strong>Automatic Rotation:</strong> Charts cycle automatically on the display</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-tv me-2"></i>Display Features</h6>
                                <p class="mb-1">On the main display:</p>
                                <ul class="mb-0 small">
                                    <li>Station buttons at top</li>
                                    <li>Interactive charts in right panel</li>
                                    <li>Automatic chart rotation</li>
                                    <li>Professional dark theme</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Understanding the System Structure -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-sitemap me-2"></i>
                        System Structure: Tabs and Charts
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-layer-group me-2 text-primary"></i>Meteorological Tabs (Stations)</h6>
                            <p>Think of tabs as different weather stations or observation points:</p>
                            
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6>Example Structure:</h6>
                                    <div class="ms-3">
                                        <div class="mb-2">
                                            <i class="fas fa-map-marker-alt text-primary me-2"></i><strong>Solapur Obs</strong>
                                            <div class="ms-4 small text-muted">
                                                <i class="fas fa-chart-bar me-1"></i>Temperature Chart<br>
                                                <i class="fas fa-chart-line me-1"></i>Humidity Chart<br>
                                                <i class="fas fa-chart-pie me-1"></i>Wind Data
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <i class="fas fa-map-marker-alt text-success me-2"></i><strong>Delhi Obs</strong>
                                            <div class="ms-4 small text-muted">
                                                <i class="fas fa-chart-area me-1"></i>Rainfall Chart<br>
                                                <i class="fas fa-chart-radar me-1"></i>Pressure Data
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-chart-line me-2 text-success"></i>Charts Within Tabs</h6>
                            <p>Each tab can contain multiple charts showing different data:</p>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Chart Type</th>
                                            <th>Best For</th>
                                            <th>Example Use</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bar Chart</td>
                                            <td>Comparisons</td>
                                            <td>Monthly rainfall</td>
                                        </tr>
                                        <tr>
                                            <td>Line Chart</td>
                                            <td>Trends</td>
                                            <td>Temperature over time</td>
                                        </tr>
                                        <tr>
                                            <td>Pie Chart</td>
                                            <td>Proportions</td>
                                            <td>Wind direction %</td>
                                        </tr>
                                        <tr>
                                            <td>Radar Chart</td>
                                            <td>Multi-variable</td>
                                            <td>Weather conditions</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Creating Weather Stations (Tabs) -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-plus me-2"></i>
                        How to Create Weather Stations (Tabs)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Step-by-Step Tab Creation:</h6>
                            <div class="list-group">
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">1</span>
                                    <div>
                                        <strong>Navigate to Meteorological Section</strong>
                                        <p class="mb-0 small text-muted">Click "Meteorological Data" in the left sidebar</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">2</span>
                                    <div>
                                        <strong>Click "Add New Tab"</strong>
                                        <p class="mb-0 small text-muted">Blue button at the top of the page</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">3</span>
                                    <div>
                                        <strong>Enter Tab Information</strong>
                                        <p class="mb-0 small text-muted">Fill out the form with station details</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-success rounded-pill me-3 mt-1">4</span>
                                    <div>
                                        <strong>Save and Add Charts</strong>
                                        <p class="mb-0 small text-muted">Create the tab, then add charts to it</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-form me-2"></i>Tab Form Fields</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Heading</strong> <span class="badge bg-danger">Required</span>
                                        <p class="small mb-1 text-muted">Display name for the station (e.g., "Solapur Observatory")</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Data Station</strong> <span class="badge bg-danger">Required</span>
                                        <p class="small mb-1 text-muted">Choose: Solapur, Delhi, Chennai, or Pune</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Display Order</strong> <span class="badge bg-warning">Optional</span>
                                        <p class="small mb-1 text-muted">Controls button position (1 = first button)</p>
                                    </div>
                                    <div class="mb-0">
                                        <strong>Active Status</strong> <span class="badge bg-info">Optional</span>
                                        <p class="small mb-0 text-muted">Enable/disable station on display</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Adding Charts to Stations -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Adding Charts to Weather Stations
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <h6>Chart Creation Process:</h6>
                            <div class="timeline">
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-marker bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">1</div>
                                    <div>
                                        <strong>Select Station Tab</strong>
                                        <p class="mb-1 small text-muted">Click on a station from the meteorological list</p>
                                    </div>
                                </div>
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-marker bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">2</div>
                                    <div>
                                        <strong>Click "Add New Chart"</strong>
                                        <p class="mb-1 small text-muted">Green button to add charts to this station</p>
                                    </div>
                                </div>
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-marker bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">3</div>
                                    <div>
                                        <strong>Choose Chart Type</strong>
                                        <p class="mb-1 small text-muted">Select from 9 available chart types (bar, line, pie, etc.)</p>
                                    </div>
                                </div>
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-marker bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">4</div>
                                    <div>
                                        <strong>Add Chart Data</strong>
                                        <p class="mb-1 small text-muted">Enter labels, data values, and customize appearance</p>
                                    </div>
                                </div>
                                <div class="timeline-item d-flex">
                                    <div class="timeline-marker bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;"><i class="fas fa-check"></i></div>
                                    <div>
                                        <strong>View on Display</strong>
                                        <p class="mb-1 small text-muted">Chart appears immediately in the station's rotation</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card border-info">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0"><i class="fas fa-palette me-2"></i>Available Chart Types</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled small mb-0">
                                                <li><i class="fas fa-chart-bar text-primary me-2"></i>Bar Chart</li>
                                                <li><i class="fas fa-chart-line text-success me-2"></i>Line Chart</li>
                                                <li><i class="fas fa-chart-area text-info me-2"></i>Area Chart</li>
                                                <li><i class="fas fa-chart-pie text-warning me-2"></i>Pie Chart</li>
                                                <li><i class="fas fa-dot-circle text-danger me-2"></i>Doughnut</li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled small mb-0">
                                                <li><i class="fas fa-star text-secondary me-2"></i>Radar Chart</li>
                                                <li><i class="fas fa-circle text-dark me-2"></i>Polar Area</li>
                                                <li><i class="fas fa-braille text-info me-2"></i>Scatter Plot</li>
                                                <li><i class="fas fa-circles text-primary me-2"></i>Bubble Chart</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-success mt-3">
                                <h6><i class="fas fa-lightbulb me-2"></i>Chart Selection Tips</h6>
                                <ul class="mb-0 small">
                                    <li><strong>Bar:</strong> Compare different locations</li>
                                    <li><strong>Line:</strong> Show trends over time</li>
                                    <li><strong>Pie:</strong> Show proportions/percentages</li>
                                    <li><strong>Radar:</strong> Multi-parameter analysis</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Managing Chart Data -->
            <div class="card mb-4">
                <div class="card-header" style="background: #6f42c1; color: white;">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-database me-2"></i>
                        Managing Chart Data
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Understanding Chart Data Structure:</h6>
                            <p>Each chart needs two main components:</p>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-white">
                                            <strong><i class="fas fa-tags me-2"></i>Labels</strong>
                                        </div>
                                        <div class="card-body">
                                            <p class="small mb-2">Names for your data categories:</p>
                                            <div class="bg-light p-2 rounded">
                                                <code class="small">
                                                    ["January", "February", "March", "April", "May"]
                                                </code>
                                            </div>
                                            <p class="small mt-2 mb-0 text-muted">These appear as X-axis labels, legend items, or slice labels</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border-success">
                                        <div class="card-header bg-success text-white">
                                            <strong><i class="fas fa-chart-line me-2"></i>Data Values</strong>
                                        </div>
                                        <div class="card-body">
                                            <p class="small mb-2">Actual measurements or values:</p>
                                            <div class="bg-light p-2 rounded">
                                                <code class="small">
                                                    [23.5, 25.1, 28.3, 31.2, 29.8]
                                                </code>
                                            </div>
                                            <p class="small mt-2 mb-0 text-muted">These are the actual numbers that get plotted</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="mt-4">Adding/Editing Chart Data:</h6>
                            <ol>
                                <li><strong>From Station View:</strong> Click "Edit Data" next to any chart</li>
                                <li><strong>Enter Labels:</strong> Type category names separated by commas</li>
                                <li><strong>Enter Values:</strong> Type corresponding numbers separated by commas</li>
                                <li><strong>Customize Colors:</strong> Choose colors for better visibility</li>
                                <li><strong>Save Changes:</strong> Data updates immediately on display</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-example me-2"></i>Example Data</h6>
                                </div>
                                <div class="card-body">
                                    <h6>Temperature Data:</h6>
                                    <div class="small">
                                        <strong>Labels:</strong><br>
                                        <code class="bg-white px-2 py-1 rounded">6AM, 9AM, 12PM, 3PM, 6PM</code>
                                    </div>
                                    <div class="small mt-2">
                                        <strong>Values:</strong><br>
                                        <code class="bg-white px-2 py-1 rounded">18, 22, 28, 32, 26</code>
                                    </div>
                                    
                                    <h6 class="mt-3">Rainfall Data:</h6>
                                    <div class="small">
                                        <strong>Labels:</strong><br>
                                        <code class="bg-white px-2 py-1 rounded">Mon, Tue, Wed, Thu, Fri</code>
                                    </div>
                                    <div class="small mt-2">
                                        <strong>Values:</strong><br>
                                        <code class="bg-white px-2 py-1 rounded">0, 2.5, 0, 1.2, 0.8</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Editing and Deleting -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Editing and Deleting Weather Data
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-edit text-warning me-2"></i>Editing Stations and Charts</h6>
                            
                            <div class="card border-warning">
                                <div class="card-header bg-warning text-dark">
                                    <strong>Editing Weather Stations</strong>
                                </div>
                                <div class="card-body">
                                    <ol class="small">
                                        <li>Go to Meteorological Data page</li>
                                        <li>Click "Edit" button next to station</li>
                                        <li>Modify heading, location, or order</li>
                                        <li>Save changes</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="card border-info mt-3">
                                <div class="card-header bg-info text-white">
                                    <strong>Editing Charts</strong>
                                </div>
                                <div class="card-body">
                                    <ol class="small">
                                        <li>Go into a station's chart view</li>
                                        <li>Click "Edit Data" on any chart</li>
                                        <li>Update labels, values, or colors</li>
                                        <li>Changes appear immediately</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-trash text-danger me-2"></i>Deleting Items Safely</h6>
                            
                            <div class="alert alert-danger">
                                <h6><i class="fas fa-exclamation-triangle me-2"></i>Deletion Warnings</h6>
                                <ul class="mb-3">
                                    <li><strong>Station Deletion:</strong> Removes all charts within it</li>
                                    <li><strong>Chart Deletion:</strong> Removes from display immediately</li>
                                    <li><strong>Password Required:</strong> For security confirmation</li>
                                    <li><strong>Permanent Action:</strong> Cannot be undone</li>
                                </ul>
                                
                                <h6>Deletion Process:</h6>
                                <ol class="small mb-0">
                                    <li>Click red "Delete" button</li>
                                    <li>Enter your admin password</li>
                                    <li>Confirm deletion</li>
                                    <li>Item removed immediately</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Best Practices -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-star me-2"></i>
                        Best Practices for Meteorological Data
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-map-marker-alt text-primary me-2"></i>Station Organization</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Clear Names:</strong> Use "Pune Observatory" not just "Pune"</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Logical Order:</strong> Arrange geographically or by importance</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Consistent Naming:</strong> Use similar patterns for all stations</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Active Management:</strong> Disable unused stations</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-chart-bar text-info me-2"></i>Chart Design</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i><strong>Relevant Data:</strong> Show data that matters to viewers</li>
                                <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i><strong>Updated Regularly:</strong> Keep data current and accurate</li>
                                <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i><strong>Proper Scale:</strong> Use appropriate value ranges</li>
                                <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i><strong>Clear Labels:</strong> Make axis labels descriptive</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <h6><i class="fas fa-clock me-2"></i>Update Schedule</h6>
                                <ul class="mb-0 small">
                                    <li>Daily: Temperature, humidity</li>
                                    <li>Weekly: Rainfall totals</li>
                                    <li>Monthly: Climate summaries</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-palette me-2"></i>Color Guidelines</h6>
                                <ul class="mb-0 small">
                                    <li>Blue: Temperature, water</li>
                                    <li>Green: Humidity, vegetation</li>
                                    <li>Orange: Heat, solar data</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-sort me-2"></i>Data Quality</h6>
                                <ul class="mb-0 small">
                                    <li>Verify all numbers</li>
                                    <li>Use consistent units</li>
                                    <li>Remove outdated data</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Troubleshooting -->
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-wrench me-2"></i>
                        Troubleshooting Meteorological Issues
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="meteorologicalAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#met1">
                                    Charts not showing on display
                                </button>
                            </h2>
                            <div id="met1" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Check these items:</strong>
                                    <ul>
                                        <li>Verify station is marked as "Active"</li>
                                        <li>Ensure charts have data entered (not empty)</li>
                                        <li>Check if station has proper display order</li>
                                        <li>Refresh the display screen browser</li>
                                        <li>Wait for chart rotation cycle to complete</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#met2">
                                    Chart data appears incorrect or empty
                                </button>
                            </h2>
                            <div id="met2" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Data troubleshooting:</strong>
                                    <ul>
                                        <li>Check that labels and values have same number of items</li>
                                        <li>Verify no empty spaces in data entry</li>
                                        <li>Ensure values are actual numbers, not text</li>
                                        <li>Use commas to separate multiple values</li>
                                        <li>Re-save chart data if recently edited</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#met3">
                                    Station buttons not appearing
                                </button>
                            </h2>
                            <div id="met3" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Station visibility issues:</strong>
                                    <ul>
                                        <li>Verify station is set to "Active" status</li>
                                        <li>Check display order numbers (1, 2, 3, etc.)</li>
                                        <li>Ensure station has at least one chart with data</li>
                                        <li>Try changing browser zoom if buttons are cut off</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#met4">
                                    Charts look wrong or distorted
                                </button>
                            </h2>
                            <div id="met4" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Chart appearance issues:</strong>
                                    <ul>
                                        <li>Check if correct chart type was selected</li>
                                        <li>Verify data values are in reasonable ranges</li>
                                        <li>Try different chart type for better visualization</li>
                                        <li>Ensure display screen resolution is correct</li>
                                        <li>Check browser compatibility (Chrome recommended)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush