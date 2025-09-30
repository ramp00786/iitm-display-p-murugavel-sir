@extends('layouts.admin')

@section('title', 'News Management Guide')
@section('page-title', 'News Management Guide')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('admin.help.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Help Center
                </a>
                <a href="{{ route('admin.news.index') }}" class="btn btn-success">
                    <i class="fas fa-newspaper me-2"></i>Go to News
                </a>
            </div>

            <!-- Introduction -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-newspaper me-2"></i>
                        News Management Overview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>What is News Management?</h6>
                            <p>The News Management system allows you to create and manage text content that appears as scrolling tickers at the bottom of your display screen. This is perfect for:</p>
                            
                            <ul>
                                <li><strong>Breaking News:</strong> Important announcements and updates</li>
                                <li><strong>Weather Information:</strong> Temperature and weather conditions</li>
                                <li><strong>Research Updates:</strong> Latest research findings and publications</li>
                                <li><strong>Event Notifications:</strong> Upcoming meetings, seminars, and events</li>
                                <li><strong>General Information:</strong> Contact details, operating hours, etc.</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-tv me-2"></i>On the Display</h6>
                                <p class="mb-1">News items appear as:</p>
                                <ul class="mb-0 small">
                                    <li>Scrolling text at bottom of screen</li>
                                    <li>Organized by category</li>
                                    <li>Automatically rotating content</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How to Add News -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-plus me-2"></i>
                        How to Add News Items
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Step-by-Step Process:</h6>
                            <div class="list-group">
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">1</span>
                                    <div>
                                        <strong>Navigate to News Section</strong>
                                        <p class="mb-0 small text-muted">Click "News" in the left sidebar menu</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">2</span>
                                    <div>
                                        <strong>Click "Add New News"</strong>
                                        <p class="mb-0 small text-muted">Look for the green "Add New News" button at the top</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">3</span>
                                    <div>
                                        <strong>Select Category</strong>
                                        <p class="mb-0 small text-muted">Choose from existing categories (News, Temperature, etc.)</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">4</span>
                                    <div>
                                        <strong>Enter News Title</strong>
                                        <p class="mb-0 small text-muted">Write a clear, concise title (this appears on screen)</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">5</span>
                                    <div>
                                        <strong>Set Display Order</strong>
                                        <p class="mb-0 small text-muted">Lower numbers appear first (1, 2, 3...)</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-success rounded-pill me-3 mt-1">6</span>
                                    <div>
                                        <strong>Save Your News</strong>
                                        <p class="mb-0 small text-muted">Click "Create News" - it appears on display immediately!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-form me-2"></i>Form Fields Explained</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Category</strong> <span class="badge bg-danger">Required</span>
                                        <p class="small mb-0 text-muted">Groups related news together (e.g., all weather info under "Temperature")</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Title</strong> <span class="badge bg-danger">Required</span>
                                        <p class="small mb-0 text-muted">The actual text that scrolls on screen. Keep it concise but informative.</p>
                                    </div>
                                    <div class="mb-0">
                                        <strong>Sort Order</strong> <span class="badge bg-warning">Optional</span>
                                        <p class="small mb-0 text-muted">Controls display sequence. Leave blank to add at the end.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-success mt-3">
                                <h6><i class="fas fa-lightbulb me-2"></i>Writing Tips</h6>
                                <ul class="mb-0 small">
                                    <li>Keep titles under 100 characters</li>
                                    <li>Use clear, professional language</li>
                                    <li>Include key information (dates, times, locations)</li>
                                    <li>Avoid excessive punctuation</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How to Edit News -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>
                        How to Edit Existing News
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Editing Process:</h6>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item border-0 ps-0">
                                    <strong>Find Your News Item:</strong>
                                    <ul class="mt-2">
                                        <li>Go to the News management page</li>
                                        <li>Use the search box to find specific items</li>
                                        <li>Filter by category using the dropdown</li>
                                    </ul>
                                </li>
                                <li class="list-group-item border-0 ps-0">
                                    <strong>Click Edit:</strong> Look for the yellow "Edit" button next to your news item
                                </li>
                                <li class="list-group-item border-0 ps-0">
                                    <strong>Make Changes:</strong> Update the title, category, or sort order as needed
                                </li>
                                <li class="list-group-item border-0 ps-0">
                                    <strong>Save Updates:</strong> Click "Update News" to save your changes
                                </li>
                            </ol>

                            <div class="alert alert-info">
                                <h6><i class="fas fa-clock me-2"></i>Real-Time Updates</h6>
                                <p class="mb-0">Changes to news items appear on the display screen immediately after saving. No need to refresh or restart anything!</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-warning">
                                <div class="card-body">
                                    <h6 class="text-warning"><i class="fas fa-search me-2"></i>Finding News Quickly</h6>
                                    <p class="small">Use these tools on the News page:</p>
                                    <ul class="small mb-0">
                                        <li><strong>Search Box:</strong> Type keywords from the title</li>
                                        <li><strong>Category Filter:</strong> Show only specific categories</li>
                                        <li><strong>Sort by Date:</strong> View newest or oldest first</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How to Delete News -->
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-trash me-2"></i>
                        How to Delete News Items
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Deletion Steps:</h6>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <strong>1. Locate the News Item</strong>
                                    <p class="mb-0 small text-muted">Find the item you want to remove from the news list</p>
                                </div>
                                <div class="list-group-item">
                                    <strong>2. Click Delete Button</strong>
                                    <p class="mb-0 small text-muted">Click the red "Delete" button next to the item</p>
                                </div>
                                <div class="list-group-item">
                                    <strong>3. Enter Password</strong>
                                    <p class="mb-0 small text-muted">Type your admin password in the popup dialog</p>
                                </div>
                                <div class="list-group-item">
                                    <strong>4. Confirm Deletion</strong>
                                    <p class="mb-0 small text-muted">Click "Yes, Delete" to permanently remove the item</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-danger">
                                <h6><i class="fas fa-exclamation-triangle me-2"></i>Important Warning</h6>
                                <p><strong>Before deleting news items:</strong></p>
                                <ul class="mb-2">
                                    <li>Double-check you have the right item</li>
                                    <li>Consider editing instead of deleting</li>
                                    <li>Remember: Deletion is permanent!</li>
                                </ul>
                                <p class="mb-0 small"><strong>Tip:</strong> You can temporarily hide news by editing it instead of deleting.</p>
                            </div>

                            <div class="card bg-light mt-3">
                                <div class="card-body">
                                    <h6><i class="fas fa-shield-alt me-2 text-primary"></i>Security Feature</h6>
                                    <p class="small mb-0">Password confirmation prevents accidental deletions and ensures only authorized users can remove content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Managing Sort Order -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-sort-numeric-down me-2"></i>
                        Managing Display Order
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>How Sort Order Works:</h6>
                            <p>Sort order determines which news items appear first in the scrolling ticker.</p>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sort Order</th>
                                            <th>Display Position</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>First to appear</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Second</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Third</td>
                                        </tr>
                                        <tr>
                                            <td>No number</td>
                                            <td>Added to end</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6><i class="fas fa-lightbulb me-2 text-warning"></i>Best Practices</h6>
                                    <ul class="mb-3">
                                        <li>Use numbers like 10, 20, 30 to leave space for insertions</li>
                                        <li>Put urgent news at low numbers (1, 2, 3)</li>
                                        <li>Leave regular updates at higher numbers</li>
                                        <li>Use consistent numbering patterns</li>
                                    </ul>
                                    
                                    <h6><i class="fas fa-example me-2 text-info"></i>Example Order</h6>
                                    <div class="small">
                                        <div class="mb-1"><strong>1:</strong> Emergency Alert</div>
                                        <div class="mb-1"><strong>10:</strong> Today's Weather</div>
                                        <div class="mb-1"><strong>20:</strong> Research Update</div>
                                        <div class="mb-1"><strong>30:</strong> General Info</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories in News -->
            <div class="card mb-4">
                <div class="card-header" style="background: #6f42c1; color: white;">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tags me-2"></i>
                        Using Categories Effectively
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Why Categories Matter:</h6>
                            <p>Categories help organize your news content and control what appears in different ticker areas on the display.</p>
                            
                            <h6>Common Category Setup:</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card border-success">
                                        <div class="card-header bg-success text-white">
                                            <strong>"News" Category</strong>
                                        </div>
                                        <div class="card-body">
                                            <ul class="small mb-0">
                                                <li>General announcements</li>
                                                <li>Research updates</li>
                                                <li>Event notifications</li>
                                                <li>Institute news</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card border-info">
                                        <div class="card-header bg-info text-white">
                                            <strong>"Temperature" Category</strong>
                                        </div>
                                        <div class="card-body">
                                            <ul class="small mb-0">
                                                <li>Weather conditions</li>
                                                <li>Temperature readings</li>
                                                <li>Weather stations data</li>
                                                <li>Climate information</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-warning">
                                <h6><i class="fas fa-exclamation-circle me-2"></i>No Categories?</h6>
                                <p class="small">If you don't see categories in the dropdown:</p>
                                <ol class="small mb-0">
                                    <li>Go to Categories section first</li>
                                    <li>Create at least one category</li>
                                    <li>Return to add news items</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Troubleshooting -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-wrench me-2"></i>
                        Troubleshooting Common Issues
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="newsAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#news1">
                                    My news doesn't appear on the display
                                </button>
                            </h2>
                            <div id="news1" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Possible causes:</strong>
                                    <ul>
                                        <li>News item was not saved properly - check if it appears in the news list</li>
                                        <li>Display screen needs refresh - wait 30 seconds or refresh browser</li>
                                        <li>Sort order is very high - check if other news items are showing first</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#news2">
                                    Can't select a category when adding news
                                </button>
                            </h2>
                            <div id="news2" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Solution:</strong> You need to create categories first. Go to the Categories section and add at least one category (like "News" or "General"), then return to add your news items.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#news3">
                                    News appears in wrong order
                                </button>
                            </h2>
                            <div id="news3" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Fix:</strong> Edit the news items and adjust their sort order numbers. Lower numbers appear first. If items have no sort order, they appear in the order they were created.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#news4">
                                    Password required for deletion
                                </button>
                            </h2>
                            <div id="news4" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Explanation:</strong> This is a security feature to prevent accidental deletions. Use the same password you use to log into the admin panel. If you've forgotten your password, contact your system administrator.
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