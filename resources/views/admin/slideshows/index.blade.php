@extends('layouts.admin')

@section('title', 'Slideshow Management')
@section('page-title', 'Slideshow Management')

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
            <h4 class="mb-0">Slideshow Items</h4>
            <div>
                <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#multiUploadModal">
                    <i class="fas fa-upload me-2"></i>Multiple Upload
                </button>
                <a href="{{ route('admin.slideshows.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Single Item
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="card shadow mb-3">
    <div class="card-body py-2">
        <ul class="nav nav-pills" id="filterTabs">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-filter="all">
                    <i class="fas fa-list me-2"></i>All Items <span class="badge bg-secondary ms-1">{{ $slideshows->count() }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-filter="image">
                    <i class="fas fa-image me-2"></i>Images <span class="badge bg-info ms-1">{{ $slideshows->where('type', 'image')->count() }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-filter="video">
                    <i class="fas fa-video me-2"></i>Videos <span class="badge bg-danger ms-1">{{ $slideshows->where('type', 'video')->count() }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-filter="gif">
                    <i class="fas fa-magic me-2"></i>GIFs <span class="badge bg-warning ms-1">{{ $slideshows->where('type', 'gif')->count() }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($slideshows->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover" id="slideshowsTable">
                    <thead class="table-dark">
                        <tr>
                            <th width="50"><i class="fas fa-arrows-alt" title="Drag to reorder"></i></th>
                            <th>Preview</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Sort Order</th>
                            <th>Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortableSlideshows">
                        @foreach($slideshows as $slideshow)
                        <tr class="sortable slideshow-row" data-id="{{ $slideshow->id }}" data-type="{{ $slideshow->type }}">
                            <td class="handle text-center">
                                <i class="fas fa-grip-vertical text-muted"></i>
                            </td>
                            <td>
                                @if($slideshow->type === 'image' || $slideshow->type === 'gif')
                                    <img src="{{ $slideshow->url }}" alt="Preview" 
                                         class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                @elseif($slideshow->type === 'video')
                                    <video width="60" height="40" controls preload="none">
                                        <source src="{{ $slideshow->url }}" type="{{ $slideshow->mime_type }}">
                                        <i class="fas fa-video text-muted fa-2x"></i>
                                    </video>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $slideshow->title }}</strong><br>
                                <small class="text-muted">{{ $slideshow->filename }}</small>
                            </td>
                            <td>
                                @if($slideshow->type === 'image')
                                    <span class="badge bg-info"><i class="fas fa-image me-1"></i>Image</span>
                                @elseif($slideshow->type === 'video')
                                    <span class="badge bg-danger"><i class="fas fa-video me-1"></i>Video</span>
                                @elseif($slideshow->type === 'gif')
                                    <span class="badge bg-warning"><i class="fas fa-magic me-1"></i>GIF</span>
                                @endif
                                <br>
                                <small class="text-muted">{{ strtoupper(pathinfo($slideshow->filename, PATHINFO_EXTENSION)) }}</small>
                            </td>
                            <td>{{ $slideshow->formatted_size }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $slideshow->sort_order }}</span>
                            </td>
                            <td>{{ $slideshow->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.slideshows.show', $slideshow) }}" 
                                       class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.slideshows.edit', $slideshow) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            title="Delete" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal"
                                            data-slideshow-id="{{ $slideshow->id }}"
                                            data-slideshow-title="{{ $slideshow->title }}"
                                            data-slideshow-filename="{{ $slideshow->filename }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Storage Usage Summary -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Storage Summary</h6>
                            <p class="card-text">
                                <strong>Total Items:</strong> {{ $slideshows->count() }}<br>
                                <strong>Total Size:</strong> {{ formatBytes($slideshows->sum('size')) }}<br>
                                <strong>Average Size:</strong> {{ $slideshows->count() > 0 ? formatBytes($slideshows->sum('size') / $slideshows->count()) : '0 B' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Upload Limits</h6>
                            <p class="card-text">
                                <strong>Max Image Size:</strong> {{ number_format(env('MAX_IMAGE_SIZE', 10485760) / 1048576, 0) }}MB<br>
                                <strong>Max Video Size:</strong> {{ number_format(env('MAX_VIDEO_SIZE', 104857600) / 1048576, 0) }}MB<br>
                                <strong>Image Formats:</strong> {{ env('SUPPORTED_IMAGE_FORMATS', 'jpg,jpeg,png,gif') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Type Distribution</h6>
                            <p class="card-text">
                                <strong>Images:</strong> {{ $slideshows->where('type', 'image')->count() }}<br>
                                <strong>Videos:</strong> {{ $slideshows->where('type', 'video')->count() }}<br>
                                <strong>GIFs:</strong> {{ $slideshows->where('type', 'gif')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No slideshow items found</h5>
                <p class="text-muted">Start by uploading your first slideshow item (image, video, or GIF).</p>
                <div>
                    <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#multiUploadModal">
                        <i class="fas fa-upload me-2"></i>Multiple Upload
                    </button>
                    <a href="{{ route('admin.slideshows.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add First Item
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Multiple Upload Modal -->
<div class="modal fade" id="multiUploadModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Multiple Slideshow Items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="multiUploadForm" enctype="multipart/form-data">
                    @csrf
                    <div class="file-upload-area" id="uploadArea">
                        <i class="fas fa-cloud-upload-alt fa-3x mb-3 text-muted"></i>
                        <h5>Drag & Drop Files Here</h5>
                        <p class="text-muted">Images, Videos, or GIFs</p>
                        <input type="file" id="files" name="files[]" multiple 
                               accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov" style="display: none;">
                        <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('files').click()">
                            Choose Files
                        </button>
                    </div>
                    
                    <div id="fileList" class="mt-3" style="display: none;">
                        <h6>Selected Files:</h6>
                        <div id="selectedFiles"></div>
                    </div>
                    
                    <div id="uploadProgress" class="mt-3" style="display: none;">
                        <h6>Upload Progress:</h6>
                        <div class="progress mb-2">
                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                        <div id="progressText">0%</div>
                    </div>
                    
                    <div id="uploadResults" class="mt-3" style="display: none;"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="uploadBtn" style="display: none;">
                    <i class="fas fa-upload me-2"></i>Upload Files
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Slideshow Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone!
                </div>
                
                <div class="slideshow-info mb-3">
                    <h6>You are about to delete:</h6>
                    <div class="d-flex align-items-center p-3 bg-light rounded">
                        <div class="slideshow-preview me-3" id="deletePreview">
                            <!-- Preview will be populated by JavaScript -->
                        </div>
                        <div>
                            <strong id="deleteSlideshowTitle">Slideshow Title</strong><br>
                            <small class="text-muted" id="deleteSlideshowFilename">filename.jpg</small>
                        </div>
                    </div>
                </div>
                
                <div class="consequences mb-3">
                    <h6>Consequences:</h6>
                    <ul class="mb-0">
                        <li>The slideshow item will be removed from all displays immediately</li>
                        <li>The file will be permanently deleted from the server</li>
                        <li>This action cannot be reversed</li>
                        <li>Any running slideshows will continue without this item</li>
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
// Format bytes function for JavaScript
function formatBytes(bytes) {
    if (bytes === 0) return '0 B';
    const k = 1024;
    const sizes = ['B', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

$(document).ready(function() {
    // Initialize sortable
    const sortable = new Sortable(document.getElementById('sortableSlideshows'), {
        handle: '.handle',
        animation: 150,
        onEnd: function(evt) {
            let slideshowIds = [];
            $('#sortableSlideshows tr').each(function() {
                slideshowIds.push($(this).data('id'));
            });
            
            // Update sort order via AJAX
            $.ajax({
                url: '{{ route('admin.slideshows.reorder') }}',
                method: 'POST',
                data: {
                    slideshows: slideshowIds,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Update the sort order badges
                        $('#sortableSlideshows tr').each(function(index) {
                            $(this).find('.badge.bg-secondary').text(index + 1);
                        });
                        
                        showAlert('success', 'Slideshow items reordered successfully');
                    }
                },
                error: function() {
                    showAlert('danger', 'Failed to reorder slideshow items');
                }
            });
        }
    });

    // Filter functionality
    $('#filterTabs .nav-link').on('click', function(e) {
        e.preventDefault();
        
        // Update active tab
        $('#filterTabs .nav-link').removeClass('active');
        $(this).addClass('active');
        
        const filter = $(this).data('filter');
        
        if (filter === 'all') {
            $('.slideshow-row').show();
        } else {
            $('.slideshow-row').hide();
            $(`.slideshow-row[data-type="${filter}"]`).show();
        }
    });

    // File upload handling
    let selectedFiles = [];
    
    $('#files').on('change', function() {
        selectedFiles = Array.from(this.files);
        updateFileList();
    });
    
    // Drag and drop
    $('#uploadArea').on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('border border-primary');
    });
    
    $('#uploadArea').on('dragleave', function(e) {
        e.preventDefault();
        $(this).removeClass('border border-primary');
    });
    
    $('#uploadArea').on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('border border-primary');
        
        const files = Array.from(e.originalEvent.dataTransfer.files);
        selectedFiles = files.filter(file => {
            const extension = file.name.split('.').pop().toLowerCase();
            return ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov'].includes(extension);
        });
        
        updateFileList();
    });
    
    function updateFileList() {
        if (selectedFiles.length > 0) {
            let fileListHtml = '';
            selectedFiles.forEach((file, index) => {
                const extension = file.name.split('.').pop().toLowerCase();
                let icon = 'fas fa-file';
                let badgeClass = 'secondary';
                
                if (['jpg', 'jpeg', 'png'].includes(extension)) {
                    icon = 'fas fa-image';
                    badgeClass = 'info';
                } else if (extension === 'gif') {
                    icon = 'fas fa-magic';
                    badgeClass = 'warning';
                } else if (['mp4', 'avi', 'mov'].includes(extension)) {
                    icon = 'fas fa-video';
                    badgeClass = 'danger';
                }
                
                fileListHtml += `
                    <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                        <div>
                            <i class="${icon} me-2"></i>
                            <strong>${file.name}</strong> (${formatBytes(file.size)})
                            <span class="badge bg-${badgeClass} ms-2">${extension.toUpperCase()}</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile(${index})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            });
            
            $('#selectedFiles').html(fileListHtml);
            $('#fileList').show();
            $('#uploadBtn').show();
        } else {
            $('#fileList').hide();
            $('#uploadBtn').hide();
        }
    }
    
    window.removeFile = function(index) {
        selectedFiles.splice(index, 1);
        updateFileList();
    };
    
    $('#uploadBtn').on('click', function() {
        if (selectedFiles.length === 0) {
            showAlert('warning', 'Please select at least one file');
            return;
        }
        
        const formData = new FormData();
        selectedFiles.forEach(file => {
            formData.append('files[]', file);
        });
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        
        // Show progress
        $('#uploadProgress').show();
        $('.progress-bar').css('width', '0%');
        $('#progressText').text('0%');
        
        $.ajax({
            url: '{{ route('admin.slideshows.upload') }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        $('.progress-bar').css('width', percentComplete + '%');
                        $('#progressText').text(Math.round(percentComplete) + '%');
                    }
                });
                return xhr;
            },
            success: function(response) {
                if (response.success) {
                    let resultsHtml = `
                        <div class="alert alert-success">
                            <h6>Upload Summary:</h6>
                            <ul class="mb-0">
                                <li>Total Files: ${response.summary.total}</li>
                                <li>Successful: ${response.summary.success}</li>
                                <li>Failed: ${response.summary.failed}</li>
                            </ul>
                        </div>
                    `;
                    
                    if (response.results.some(r => !r.success)) {
                        resultsHtml += '<div class="alert alert-warning"><h6>Failed Uploads:</h6><ul class="mb-0">';
                        response.results.forEach(result => {
                            if (!result.success) {
                                resultsHtml += `<li>${result.filename}: ${result.message}</li>`;
                            }
                        });
                        resultsHtml += '</ul></div>';
                    }
                    
                    $('#uploadResults').html(resultsHtml).show();
                    
                    // Reload page after successful uploads
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            },
            error: function(xhr) {
                let errorMsg = 'Upload failed';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMsg += ': ' + Object.values(xhr.responseJSON.errors).flat().join(', ');
                }
                showAlert('danger', errorMsg);
            }
        });
    });

    // Delete Modal Functionality
    $('#deleteModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const slideshowId = button.data('slideshow-id');
        const slideshowTitle = button.data('slideshow-title');
        const slideshowFilename = button.data('slideshow-filename');
        
        // Update modal content
        $('#deleteSlideshowTitle').text(slideshowTitle);
        $('#deleteSlideshowFilename').text(slideshowFilename);
        
        // Set delete form action
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `{{ url('admin/slideshows') }}/${slideshowId}`;
        
        // Find the slideshow row to get preview
        const slideshowRow = $(`.slideshow-row[data-id="${slideshowId}"]`);
        const previewCell = slideshowRow.find('td:nth-child(2)');
        const previewContent = previewCell.html();
        
        // Update preview in modal
        $('#deletePreview').html(previewContent);
        
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
        
        // Let the form submit normally - Laravel will handle the password validation
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

@php
function formatBytes($bytes) {
    if ($bytes == 0) return '0 B';
    $units = ['B', 'KB', 'MB', 'GB'];
    $i = 0;
    while ($bytes > 1024 && $i < count($units) - 1) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, 2) . ' ' . $units[$i];
}
@endphp