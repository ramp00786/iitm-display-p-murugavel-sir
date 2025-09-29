@extends('layouts.admin')

@section('title', 'Upload Slideshow Item')
@section('page-title', 'Upload New Slideshow Item')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Slideshow Item Upload</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.slideshows.store') }}" enctype="multipart/form-data" id="slideshowUploadForm">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Item Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Enter a descriptive title for this slideshow item.</div>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Media File <span class="text-danger">*</span></label>
                        <div class="file-upload-area" onclick="document.getElementById('file').click()">
                            <i class="fas fa-images fa-3x mb-3 text-muted"></i>
                            <h5>Click to select file</h5>
                            <p class="text-muted">Images, Videos, or GIFs</p>
                        </div>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" 
                               id="file" name="file" accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov" required style="display: none;">
                        @error('file')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        
                        <div id="fileInfo" class="mt-2" style="display: none;">
                            <div class="alert alert-info">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div id="filePreview"></div>
                                    </div>
                                    <div class="col">
                                        <strong>Selected file:</strong> <span id="fileName"></span><br>
                                        <strong>Size:</strong> <span id="fileSize"></span><br>
                                        <strong>Type:</strong> <span id="fileType"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Progress -->
                    <div id="uploadProgress" class="upload-progress mb-3">
                        <h6>Upload Progress:</h6>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                 role="progressbar" style="width: 0%" id="progressBar"></div>
                        </div>
                        <div class="mt-2">
                            <span id="progressText">0%</span> - 
                            <span id="progressSpeed">0 MB/s</span> - 
                            <span id="progressETA">Calculating...</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.slideshows.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Slideshows
                        </a>
                        <button type="submit" class="btn btn-primary" id="uploadBtn">
                            <i class="fas fa-upload me-2"></i>Upload Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Upload Guidelines</h6>
            </div>
            <div class="card-body">
                <h6 class="text-primary">Image Files</h6>
                <ul class="list-unstyled mb-3">
                    <li class="mb-1">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        <strong>Max size:</strong> {{ number_format(env('MAX_IMAGE_SIZE', 10485760) / 1048576, 0) }}MB
                    </li>
                    <li class="mb-1">
                        <i class="fas fa-file-image text-info me-2"></i>
                        <strong>Formats:</strong> JPG, JPEG, PNG, GIF
                    </li>
                </ul>

                <h6 class="text-primary">Video Files</h6>
                <ul class="list-unstyled mb-3">
                    <li class="mb-1">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        <strong>Max size:</strong> {{ number_format(env('MAX_VIDEO_SIZE', 104857600) / 1048576, 0) }}MB
                    </li>
                    <li class="mb-1">
                        <i class="fas fa-file-video text-info me-2"></i>
                        <strong>Formats:</strong> MP4, AVI, MOV
                    </li>
                </ul>

                <h6 class="text-primary">General</h6>
                <ul class="list-unstyled mb-3">
                    <li class="mb-1">
                        <i class="fas fa-sort text-info me-2"></i>
                        Items can be reordered by dragging.
                    </li>
                    <li class="mb-1">
                        <i class="fas fa-tv text-info me-2"></i>
                        Shown before main display loads.
                    </li>
                    <li class="mb-1">
                        <i class="fas fa-clock text-info me-2"></i>
                        Auto-advances every 5 seconds.
                    </li>
                </ul>

                <div class="alert alert-info">
                    <i class="fas fa-lightbulb me-2"></i>
                    <small><strong>Tip:</strong> Use high-quality images and videos for best display on LED screens.</small>
                </div>
            </div>
        </div>

        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Best Practices</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">• Use 1920x1080 resolution for best quality</li>
                    <li class="mb-2">• Keep file sizes reasonable for faster loading</li>
                    <li class="mb-2">• Test content before uploading</li>
                    <li class="mb-2">• Use clear, readable fonts in images</li>
                    <li class="mb-2">• Avoid very bright or flashing content</li>
                    <li>• Consider viewing distance on LED screens</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let startTime;
let lastLoaded = 0;

$(document).ready(function() {
    const fileInput = $('#file');
    const fileUploadArea = $('.file-upload-area');
    
    // Auto-fill title from filename and show preview
    fileInput.on('change', function() {
        const file = this.files[0];
        if (file) {
            const fileName = file.name;
            const fileSize = formatBytes(file.size);
            const fileType = file.type || 'Unknown';
            const extension = fileName.split('.').pop().toLowerCase();
            
            // Auto-fill title if empty
            if (!$('#title').val()) {
                const titleFromFile = fileName.replace(/\.[^/.]+$/, ""); // Remove extension
                $('#title').val(titleFromFile);
            }
            
            // Show file info
            $('#fileName').text(fileName);
            $('#fileSize').text(fileSize);
            $('#fileType').text(fileType);
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                let previewHtml = '';
                
                if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                    previewHtml = `<img src="${e.target.result}" alt="Preview" style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px;">`;
                } else if (['mp4', 'avi', 'mov'].includes(extension)) {
                    previewHtml = `<video width="80" height="60" style="border-radius: 4px;"><source src="${e.target.result}" type="${fileType}"></video>`;
                } else {
                    previewHtml = `<i class="fas fa-file fa-3x text-muted"></i>`;
                }
                
                $('#filePreview').html(previewHtml);
            };
            reader.readAsDataURL(file);
            
            $('#fileInfo').show();
            
            // Update upload area appearance
            fileUploadArea.addClass('border border-success');
            fileUploadArea.find('h5').text('File selected: ' + fileName);
            fileUploadArea.find('p').text('Click to change file');
        }
    });
    
    // Drag and drop functionality
    fileUploadArea.on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('border border-primary');
    });
    
    fileUploadArea.on('dragleave', function(e) {
        e.preventDefault();
        $(this).removeClass('border border-primary');
    });
    
    fileUploadArea.on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('border border-primary');
        
        const files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            // Check if it's a supported file
            const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov'];
            const fileName = file.name.toLowerCase();
            const hasValidExtension = allowedExtensions.some(ext => fileName.endsWith('.' + ext));
            
            if (hasValidExtension) {
                fileInput[0].files = files;
                fileInput.trigger('change');
            } else {
                showAlert('warning', 'Please select a valid file (JPG, PNG, GIF, MP4, AVI, or MOV)');
            }
        }
    });
    
    // Form submission with progress tracking
    $('#slideshowUploadForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        startTime = new Date().getTime();
        lastLoaded = 0;
        
        // Show progress
        $('#uploadProgress').show();
        $('#uploadBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Uploading...');
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        const currentTime = new Date().getTime();
                        const elapsedTime = (currentTime - startTime) / 1000; // seconds
                        const uploadSpeed = (e.loaded - lastLoaded) / 1024 / 1024; // MB/s
                        const remainingBytes = e.total - e.loaded;
                        const eta = uploadSpeed > 0 ? Math.round(remainingBytes / 1024 / 1024 / uploadSpeed) : 0;
                        
                        $('#progressBar').css('width', percentComplete + '%');
                        $('#progressText').text(Math.round(percentComplete) + '%');
                        $('#progressSpeed').text(uploadSpeed.toFixed(2) + ' MB/s');
                        $('#progressETA').text(eta > 0 ? eta + ' seconds remaining' : 'Calculating...');
                        
                        lastLoaded = e.loaded;
                    }
                });
                return xhr;
            },
            success: function(response) {
                $('#uploadBtn').html('<i class="fas fa-check me-2"></i>Upload Complete!');
                showAlert('success', 'Slideshow item uploaded successfully!');
                
                setTimeout(() => {
                    window.location.href = '{{ route('admin.slideshows.index') }}';
                }, 1500);
            },
            error: function(xhr) {
                $('#uploadBtn').prop('disabled', false).html('<i class="fas fa-upload me-2"></i>Upload Item');
                
                let errorMsg = 'Upload failed';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMsg += ': ' + Object.values(xhr.responseJSON.errors).flat().join(', ');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg += ': ' + xhr.responseJSON.message;
                }
                
                showAlert('danger', errorMsg);
                $('#uploadProgress').hide();
            }
        });
    });
});

function formatBytes(bytes) {
    if (bytes === 0) return '0 B';
    const k = 1024;
    const sizes = ['B', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function showAlert(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    $('.container-fluid.py-4').prepend(alertHtml);
    
    setTimeout(() => {
        $('.alert').alert('close');
    }, 5000);
}
</script>
@endpush