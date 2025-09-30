@extends('layouts.admin')

@section('title', 'News Management')
@section('page-title', 'News Management')

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
            <h4 class="mb-0">News Items</h4>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add News Item
            </a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($news->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover" id="newsTable">
                    <thead class="table-dark">
                        <tr>
                            <th width="50"><i class="fas fa-arrows-alt" title="Drag to reorder"></i></th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Sort Order</th>
                            <th>Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortableNews">
                        @foreach($news as $item)
                        <tr class="sortable" data-id="{{ $item->id }}">
                            <td class="handle text-center">
                                <i class="fas fa-grip-vertical text-muted"></i>
                            </td>
                            <td>
                                <strong>{{ $item->title }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $item->category->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $item->sort_order }}</span>
                            </td>
                            <td>{{ $item->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.news.edit', $item) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            title="Delete" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal"
                                            data-news-id="{{ $item->id }}"
                                            data-news-title="{{ $item->title }}"
                                            data-news-category="{{ $item->category->name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No news items found</h5>
                <p class="text-muted">Start by creating your first news item.</p>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add First News Item
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Category Filter -->
@if($news->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">News by Category</h6>
            </div>
            <div class="card-body">
                @php
                    $categories = $news->groupBy('category.name');
                @endphp
                
                @foreach($categories as $categoryName => $categoryNews)
                <div class="mb-4">
                    <h6 class="text-primary border-bottom pb-2">{{ $categoryName }} ({{ $categoryNews->count() }} items)</h6>
                    <div class="row">
                        @foreach($categoryNews as $item)
                        <div class="col-md-6 col-lg-4 mb-2">
                            <div class="card border-left-primary">
                                <div class="card-body py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-truncate">{{ $item->title }}</small>
                                        <span class="badge bg-secondary ms-2">{{ $item->sort_order }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm News Item Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone!
                </div>
                
                <div class="news-info mb-3">
                    <h6>You are about to delete:</h6>
                    <div class="d-flex align-items-center p-3 bg-light rounded">
                        <div class="news-icon me-3">
                            <i class="fas fa-newspaper fa-2x text-primary"></i>
                        </div>
                        <div>
                            <strong id="deleteNewsTitle">News Title</strong><br>
                            <span class="badge bg-primary" id="deleteNewsCategory">Category</span>
                        </div>
                    </div>
                </div>
                
                <div class="consequences mb-3">
                    <h6>Consequences:</h6>
                    <ul class="mb-0">
                        <li>The news item will be removed from all news tickers immediately</li>
                        <li>The news will no longer appear on the main display</li>
                        <li>This action cannot be reversed</li>
                        <li>Any running news rotations will continue without this item</li>
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
    const sortable = new Sortable(document.getElementById('sortableNews'), {
        handle: '.handle',
        animation: 150,
        onEnd: function(evt) {
            let newsIds = [];
            $('#sortableNews tr').each(function() {
                newsIds.push($(this).data('id'));
            });
            
            // Update sort order via AJAX
            $.ajax({
                url: '{{ route('admin.news.reorder') }}',
                method: 'POST',
                data: {
                    news: newsIds,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Update the sort order badges
                        $('#sortableNews tr').each(function(index) {
                            $(this).find('.badge.bg-secondary').text(index + 1);
                        });
                        
                        // Show success message
                        showAlert('success', 'News items reordered successfully');
                    }
                },
                error: function() {
                    showAlert('danger', 'Failed to reorder news items');
                }
            });
        }
    });

    // Delete Modal Functionality
    $('#deleteModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const newsId = button.data('news-id');
        const newsTitle = button.data('news-title');
        const newsCategory = button.data('news-category');
        
        // Update modal content
        $('#deleteNewsTitle').text(newsTitle);
        $('#deleteNewsCategory').text(newsCategory);
        
        // Set delete form action
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/news/${newsId}`;
        
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