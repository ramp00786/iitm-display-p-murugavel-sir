@extends('layouts.admin')

@section('title', 'Edit Video')
@section('page-title', 'Edit Video')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Video Details</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.videos.update', $video) }}" enctype="multipart/form-data" id="videoEditForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Video Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $video->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Enter a descriptive title for this video.</div>
                    </div>

                    <div class="mb-3">
                        <label for="video" class="form-label">Replace Video File (optional)</label>
                        <div class="file-upload-area" onclick="document.getElementById('video').click()">
                            <i class="fas fa-video fa-3x mb-3 text-muted"></i>
                            <h5>Click to select new video file</h5>
                            <p class="text-muted">or drag & drop here (leave empty to keep current file)</p>
                        </div>
                        <input type="file" class="form-control @error('video') is-invalid @enderror" 
                               id="video" name="video" accept=".mp4,.avi,.mov" style="display: none;">
                        @error('video')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        
                        <div id="fileInfo" class="mt-2" style="display: none;">
                            <div class="alert alert-info">
                                <strong>Selected file:</strong> <span id="fileName"></span><br>
                                <strong>Size:</strong> <span id="fileSize"></span><br>
                                <strong>Type:</strong> <span id="fileType"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Progress -->
                    <div id="uploadProgress" class="upload-progress mb-3" style="display: none;">
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
                        <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Videos
                        </a>
                        <button type="submit" class="btn btn-primary" id="updateBtn">
                            <i class="fas fa-save me-2"></i>Update Video
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Current Video</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <video width="100%" controls style="max-height: 200px;">
                        <source src="{{ $video->url }}" type="{{ $video->mime_type }}">
                        Your browser does not support the video tag.
                    </video>
                </div>
                
                <ul class="list-unstyled mb-3">
                    <li class="mb-2">
                        <i class="fas fa-file-signature text-info me-2"></i>
                        <strong>Filename:</strong> {{ $video->filename }}
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-hdd text-info me-2"></i>
                        <strong>Size:</strong> {{ $video->formatted_size }}
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-file-video text-info me-2"></i>
                        <strong>Type:</strong> {{ $video->mime_type }}
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-calendar text-info me-2"></i>
                        <strong>Added:</strong> {{ $video->created_at->format('M j, Y g:i A') }}
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-edit text-info me-2"></i>
                        <strong>Modified:</strong> {{ $video->updated_at->format('M j, Y g:i A') }}
                    </li>
                </ul>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <small><strong>Note:</strong> Leave the file field empty to keep the current video. Only select a new file if you want to replace it completely.</small>
                </div>
            </div>
        </div>

        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Upload Guidelines</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-3">
                    <li class="mb-2">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        <strong>Max file size:</strong> {{ number_format(env('MAX_VIDEO_SIZE', 104857600) / 1048576, 0) }}MB
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-file-video text-info me-2"></i>
                        <strong>Supported formats:</strong> {{ env('SUPPORTED_VIDEO_FORMATS', 'MP4, AVI, MOV') }}
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-sort text-info me-2"></i>
                        Videos can be reordered by dragging in the video list.
                    </li>
                    <li>
                        <i class="fas fa-tv text-info me-2"></i>
                        Videos will be displayed on the main screen in order.
                    </li>
                </ul>
            </div>
        </div>

        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tips for Best Results</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">• Use H.264 encoding for MP4 files</li>
                    <li class="mb-2">• Recommended resolution: 1920x1080</li>
                    <li class="mb-2">• Keep bitrate under 10 Mbps</li>
                    <li class="mb-2">• Use descriptive filenames</li>
                    <li>• Test videos before uploading</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.file-upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 0.5rem;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.file-upload-area:hover {
    border-color: #007bff;
    background-color: #f8f9ff;
}

.upload-progress {
    display: none;
    padding: 1rem;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    background-color: #f8f9fa;
}
</style>
@endpush

@push('scripts')
<script>
let startTime;
let lastLoaded = 0;

$(document).ready(function() {
    const fileInput = $('#video');
    const fileUploadArea = $('.file-upload-area');
    
    // File selection handling
    fileInput.on('change', function() {
        const file = this.files[0];
        if (file) {
            const fileName = file.name;
            const fileSize = formatBytes(file.size);
            const fileType = file.type || 'Unknown';
            
            // Show file info
            $('#fileName').text(fileName);
            $('#fileSize').text(fileSize);
            $('#fileType').text(fileType);
            $('#fileInfo').show();
            
            // Update upload area appearance
            fileUploadArea.addClass('border border-success');
            fileUploadArea.find('h5').text('New file selected: ' + fileName);
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
            // Check if it's a video file
            const allowedTypes = ['video/mp4', 'video/avi', 'video/quicktime'];
            if (allowedTypes.includes(file.type) || file.name.match(/\.(mp4|avi|mov)$/i)) {
                fileInput[0].files = files;
                fileInput.trigger('change');
            } else {
                showAlert('warning', 'Please select a valid video file (MP4, AVI, or MOV)');
            }
        }
    });
    
    // Form submission with progress tracking
    $('#videoEditForm').on('submit', function(e) {
        const hasFile = fileInput[0].files.length > 0;
        
        if (hasFile) {
            e.preventDefault();
            
            const formData = new FormData(this);
            startTime = new Date().getTime();
            lastLoaded = 0;
            
            // Show progress
            $('#uploadProgress').show();
            $('#updateBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Updating...');
            
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
                    $('#updateBtn').html('<i class="fas fa-check me-2"></i>Update Complete!');
                    showAlert('success', 'Video updated successfully!');
                    
                    setTimeout(() => {
                        window.location.href = '{{ route('admin.videos.index') }}';
                    }, 1500);
                },
                error: function(xhr) {
                    $('#updateBtn').prop('disabled', false).html('<i class="fas fa-save me-2"></i>Update Video');
                    
                    let errorMsg = 'Update failed';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMsg += ': ' + Object.values(xhr.responseJSON.errors).flat().join(', ');
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg += ': ' + xhr.responseJSON.message;
                    }
                    
                    showAlert('danger', errorMsg);
                    $('#uploadProgress').hide();
                }
            });
        } else {
            // No file selected, just update title - let form submit normally
            $('#updateBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Updating...');
        }
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