@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories Management')

@section('content')

<!-- Alert Container for both server-side and client-side alerts -->
<div data-alert-container>
    <!-- Success/Error Messages from Server -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show server-alert" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show server-alert" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>

<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Categories</h4>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Category
            </a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover" id="categoriesTable">
                    <thead class="table-dark">
                        <tr>
                            <th width="50"><i class="fas fa-arrows-alt" title="Drag to reorder"></i></th>
                            <th>Name</th>
                            <th>News Count</th>
                            <th>Sort Order</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortableCategories">
                        @foreach($categories as $category)
                        <tr class="sortable" data-id="{{ $category->id }}">
                            <td class="handle text-center">
                                <i class="fas fa-grip-vertical text-muted"></i>
                            </td>
                            <td>
                                <strong>{{ $category->name }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $category->news->count() }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $category->sort_order }}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.categories.show', $category) }}" 
                                       class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($category->news->count() == 0)
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            title="Delete" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal"
                                            data-category-id="{{ $category->id }}"
                                            data-category-name="{{ $category->name }}"
                                            data-category-news-count="{{ $category->news->count() }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-sm btn-outline-secondary" 
                                            title="Cannot delete - has {{ $category->news->count() }} news items" disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No categories found</h5>
                <p class="text-muted">Start by creating your first category.</p>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add First Category
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Category Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone!
                </div>
                
                <div class="category-info mb-3">
                    <h6>You are about to delete:</h6>
                    <div class="d-flex align-items-center p-3 bg-light rounded">
                        <div class="category-icon me-3">
                            <i class="fas fa-tags fa-2x text-primary"></i>
                        </div>
                        <div>
                            <strong id="deleteCategoryName">Category Name</strong><br>
                            <span class="badge bg-info" id="deleteCategoryNewsCount">0 news items</span>
                        </div>
                    </div>
                </div>
                
                <div class="consequences mb-3">
                    <h6>Consequences:</h6>
                    <ul class="mb-0">
                        <li>The category will be permanently removed from the system</li>
                        <li>This category will no longer be available for organizing news items</li>
                        <li>This action cannot be reversed</li>
                        <li>Only empty categories (with no news items) can be deleted</li>
                    </ul>
                </div>
                
                <div class="password-section">
                    <label for="deletePassword" class="form-label">
                        <strong><i class="fas fa-lock me-2"></i>Enter your admin password to confirm:</strong>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-key"></i>
                        </span>
                        <input type="password" 
                               class="form-control" 
                               id="deletePassword" 
                               placeholder="Your admin password" 
                               required 
                               autocomplete="current-password">
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="fas fa-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                    <div class="invalid-feedback" id="passwordError" style="display: none;">
                        Password is required to confirm deletion.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="password" id="deletePasswordField">
                    <button type="submit" class="btn btn-danger" id="confirmDeleteBtn" disabled>
                        <i class="fas fa-trash me-2"></i>Yes, Delete Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize sortable
    const sortable = new Sortable(document.getElementById('sortableCategories'), {
        handle: '.handle',
        animation: 150,
        onEnd: function(evt) {
            let categoryIds = [];
            $('#sortableCategories tr').each(function() {
                categoryIds.push($(this).data('id'));
            });
            
            // Update sort order via AJAX
            $.ajax({
                url: '{{ route('admin.categories.reorder') }}',
                method: 'POST',
                data: {
                    categories: categoryIds,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Update the sort order badges
                        $('#sortableCategories tr').each(function(index) {
                            $(this).find('.badge.bg-secondary').text(index + 1);
                        });
                        
                        // Show success message
                        showAlert('success', 'Categories reordered successfully');
                    }
                },
                error: function() {
                    showAlert('danger', 'Failed to reorder categories');
                }
            });
        }
    });

    // Delete Modal Functionality
    $('#deleteModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const categoryId = button.data('category-id');
        const categoryName = button.data('category-name');
        const newsCount = button.data('category-news-count');
        
        // Update modal content
        $('#deleteCategoryName').text(categoryName);
        $('#deleteCategoryNewsCount').text(`${newsCount} news items`);
        
        // Set delete form action
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/categories/${categoryId}`;
        
        // Reset password field and button state
        $('#deletePassword').val('');
        $('#deletePasswordField').val('');
        $('#confirmDeleteBtn').prop('disabled', true);
        $('#passwordError').hide();
        $('#deletePassword').removeClass('is-invalid');
    });

    // Password visibility toggle
    $('#togglePassword').on('click', function() {
        const passwordField = $('#deletePassword');
        const passwordIcon = $('#passwordIcon');
        
        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Password input validation
    $('#deletePassword').on('input', function() {
        const password = $(this).val().trim();
        const deleteBtn = $('#confirmDeleteBtn');
        const passwordField = $('#deletePasswordField');
        const passwordError = $('#passwordError');
        
        if (password.length === 0) {
            deleteBtn.prop('disabled', true);
            $(this).removeClass('is-valid is-invalid');
            passwordError.hide();
        } else if (password.length < 6) {
            deleteBtn.prop('disabled', true);
            $(this).removeClass('is-valid').addClass('is-invalid');
            passwordError.text('Password must be at least 6 characters long.').show();
        } else {
            deleteBtn.prop('disabled', false);
            $(this).removeClass('is-invalid').addClass('is-valid');
            passwordError.hide();
        }
        
        passwordField.val(password);
    });

    // Clear modal state when hidden
    $('#deleteModal').on('hidden.bs.modal', function() {
        $('#deletePassword').val('');
        $('#deletePasswordField').val('');
        $('#confirmDeleteBtn').prop('disabled', true);
        $('#passwordError').hide();
        $('#deletePassword').removeClass('is-valid is-invalid');
        $('#passwordIcon').removeClass('fa-eye-slash').addClass('fa-eye');
        $('#deletePassword').attr('type', 'password');
    });

    // Handle delete form submission
    $('#deleteForm').on('submit', function(e) {
        const password = $('#deletePassword').val().trim();
        
        if (password.length === 0) {
            e.preventDefault();
            $('#deletePassword').addClass('is-invalid');
            $('#passwordError').text('Password is required to confirm deletion.').show();
            return false;
        }
        
        // Show loading state
        $('#confirmDeleteBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Deleting...');
        
        // Let the form submit normally
        return true;
    });

    // Check for delete errors on page load (from server-side validation)
    @if($errors->has('delete_error') || session('error'))
        $(document).ready(function() {
            // Show the modal again if there were validation errors
            $('#deleteModal').modal('show');
            
            @if($errors->has('delete_error'))
                $('#deletePassword').addClass('is-invalid');
                $('#passwordError').text('{{ $errors->first('delete_error') }}').show();
            @endif
        });
    @endif
});

function showAlert(type, message) {
    // Check if there's already a server-side alert with the same message
    const existingAlerts = $('.alert').filter(function() {
        return $(this).text().trim().includes(message);
    });
    
    if (existingAlerts.length > 0) {
        // Don't show duplicate alert
        return;
    }
    
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show js-alert" role="alert">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    // Insert after any existing server-side alerts
    const lastAlert = $('.alert').last();
    if (lastAlert.length > 0) {
        lastAlert.after(alertHtml);
    } else {
        // If no existing alerts, prepend to content section
        $('[data-alert-container]').prepend(alertHtml);
    }
    
    // Auto-dismiss only JavaScript-generated alerts
    setTimeout(() => {
        $('.js-alert').alert('close');
    }, 3000);
}
</script>
@endpush