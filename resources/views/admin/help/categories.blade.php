@extends('layouts.admin')

@section('title', 'Categories Guide')
@section('page-title', 'Categories Management Guide')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('admin.help.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Help Center
                </a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">
                    <i class="fas fa-tags me-2"></i>Go to Categories
                </a>
            </div>

            <!-- Introduction -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tags me-2"></i>
                        Categories Overview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>What are Categories?</h6>
                            <p>Categories help you organize different types of content in your display system. Think of them as folders that group related information together.</p>
                            
                            <h6>Common Categories</h6>
                            <ul>
                                <li><strong>News</strong> - General news and announcements</li>
                                <li><strong>Temperature</strong> - Weather and temperature information</li>
                                <li><strong>Research</strong> - Research updates and findings</li>
                                <li><strong>Events</strong> - Upcoming events and meetings</li>
                                <li><strong>Alerts</strong> - Important notifications</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-lightbulb me-2"></i>Pro Tip</h6>
                                <p class="mb-0">Start with 3-5 basic categories. You can always add more later as your content grows!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How to Add Categories -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-plus me-2"></i>
                        How to Add a New Category
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Step-by-Step Instructions:</h6>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex">
                                    <span class="badge bg-primary rounded-pill me-3">1</span>
                                    <div>
                                        <strong>Navigate to Categories</strong>
                                        <br>Click on "Categories" in the left sidebar menu
                                    </div>
                                </div>
                                <div class="list-group-item d-flex">
                                    <span class="badge bg-primary rounded-pill me-3">2</span>
                                    <div>
                                        <strong>Click "Add New Category"</strong>
                                        <br>Look for the green "Add New Category" button
                                    </div>
                                </div>
                                <div class="list-group-item d-flex">
                                    <span class="badge bg-primary rounded-pill me-3">3</span>
                                    <div>
                                        <strong>Enter Category Name</strong>
                                        <br>Type a clear, descriptive name (e.g., "Weather Updates")
                                    </div>
                                </div>
                                <div class="list-group-item d-flex">
                                    <span class="badge bg-success rounded-pill me-3">4</span>
                                    <div>
                                        <strong>Save Your Category</strong>
                                        <br>Click the "Create Category" button
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-eye me-2"></i>What You'll See</h6>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded p-3 mb-3" style="background: #f8f9fa;">
                                        <strong>Form Fields:</strong>
                                        <ul class="mt-2 mb-0">
                                            <li>Category Name (required)</li>
                                            <li>Description (optional)</li>
                                        </ul>
                                    </div>
                                    <div class="alert alert-warning alert-sm">
                                        <strong>Note:</strong> Category names must be unique and cannot be left empty.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How to Edit Categories -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>
                        How to Edit an Existing Category
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Editing Steps:</h6>
                            <ol>
                                <li class="mb-2">
                                    <strong>Find the Category:</strong> Go to the Categories page and locate the category you want to edit
                                </li>
                                <li class="mb-2">
                                    <strong>Click Edit Button:</strong> Look for the yellow "Edit" button next to the category name
                                </li>
                                <li class="mb-2">
                                    <strong>Make Changes:</strong> Update the category name or description as needed
                                </li>
                                <li class="mb-2">
                                    <strong>Save Changes:</strong> Click "Update Category" to save your modifications
                                </li>
                            </ol>

                            <div class="alert alert-info">
                                <h6><i class="fas fa-info-circle me-2"></i>Important to Know:</h6>
                                <ul class="mb-0">
                                    <li>Editing a category name will update it everywhere it's used</li>
                                    <li>All news items in this category will remain connected</li>
                                    <li>Changes appear immediately on the display</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-warning">
                                <div class="card-body text-center">
                                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                                    <h6>Be Careful!</h6>
                                    <p class="small mb-0">Changing a category name affects all content using that category.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How to Delete Categories -->
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-trash me-2"></i>
                        How to Delete a Category
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Deletion Process:</h6>
                            <ol>
                                <li class="mb-2">
                                    <strong>Locate the Category:</strong> Find the category you want to remove
                                </li>
                                <li class="mb-2">
                                    <strong>Click Delete Button:</strong> Click the red "Delete" button
                                </li>
                                <li class="mb-2">
                                    <strong>Enter Password:</strong> Type your admin password for security
                                </li>
                                <li class="mb-2">
                                    <strong>Confirm Deletion:</strong> Click "Yes, Delete" to confirm
                                </li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-danger">
                                <h6><i class="fas fa-exclamation-triangle me-2"></i>Warning!</h6>
                                <p><strong>Before deleting a category:</strong></p>
                                <ul class="mb-0">
                                    <li>Make sure it's not being used by any news items</li>
                                    <li>Consider editing instead of deleting</li>
                                    <li>Remember: Deletion cannot be undone!</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Best Practices -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-star me-2"></i>
                        Best Practices for Categories
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-check-circle text-success me-2"></i>Recommended Practices</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Use Clear Names:</strong> "Weather Updates" instead of "Weather"</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Keep It Simple:</strong> Start with 3-5 categories maximum</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Be Consistent:</strong> Use similar naming patterns</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Think Long-term:</strong> Choose names that will make sense in 6 months</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-lightbulb text-warning me-2"></i>Naming Suggestions</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Good Names</th>
                                            <th>Poor Names</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Research Updates</td>
                                            <td>Research</td>
                                        </tr>
                                        <tr>
                                            <td>Daily Weather</td>
                                            <td>Temp</td>
                                        </tr>
                                        <tr>
                                            <td>Institute News</td>
                                            <td>News1</td>
                                        </tr>
                                        <tr>
                                            <td>Emergency Alerts</td>
                                            <td>Alerts123</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                        Common Issues & Solutions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="troubleshootingAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#issue1">
                                    Cannot delete a category
                                </button>
                            </h2>
                            <div id="issue1" class="accordion-collapse collapse" data-bs-parent="#troubleshootingAccordion">
                                <div class="accordion-body">
                                    <strong>Reason:</strong> The category is being used by existing news items.<br>
                                    <strong>Solution:</strong> First, move all news items to a different category or delete them, then try deleting the category again.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#issue2">
                                    "Category name already exists" error
                                </button>
                            </h2>
                            <div id="issue2" class="accordion-collapse collapse" data-bs-parent="#troubleshootingAccordion">
                                <div class="accordion-body">
                                    <strong>Reason:</strong> You're trying to create a category with a name that already exists.<br>
                                    <strong>Solution:</strong> Choose a different name or edit the existing category instead.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#issue3">
                                    Category doesn't appear in dropdown
                                </button>
                            </h2>
                            <div id="issue3" class="accordion-collapse collapse" data-bs-parent="#troubleshootingAccordion">
                                <div class="accordion-body">
                                    <strong>Reason:</strong> The page needs to be refreshed or there was an error saving.<br>
                                    <strong>Solution:</strong> Refresh the page and check if the category was actually created. If not, try creating it again.
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