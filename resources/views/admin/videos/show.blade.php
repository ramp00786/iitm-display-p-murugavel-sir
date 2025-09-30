@extends('layouts.admin')

@section('title', 'View Video')
@section('page-title', 'Video Details')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Header with actions -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">
                <i class="fas fa-video text-primary me-2"></i>{{ $video->title }}
            </h4>
            <div>
                <a href="{{ route('admin.videos.edit', $video) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit Video
                </a>
                <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Videos
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Video Preview -->
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">
                            <i class="fas fa-play me-2"></i>Video Preview
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        @php
                            // Construct video URL from path and filename
                            $videoUrl = null;
                            if ($video->path && $video->filename) {
                                if (str_ends_with($video->path, $video->filename)) {
                                    $fullPath = $video->path;
                                } else {
                                    $fullPath = rtrim($video->path, '/') . '/' . $video->filename;
                                }
                                
                                if (str_starts_with($fullPath, 'storage/')) {
                                    $videoUrl = asset($fullPath);
                                } else {
                                    $videoUrl = asset('storage/' . ltrim($fullPath, '/'));
                                }
                            }
                        @endphp
                        
                        @if($videoUrl)
                            <video 
                                controls 
                                class="w-100" 
                                style="max-height: 500px; background: #000;"
                                preload="metadata"
                            >
                                <source src="{{ $videoUrl }}" type="{{ $video->mime_type }}">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                <h5>Video Preview Not Available</h5>
                                <p class="text-muted">The video file could not be located or accessed.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Display Status -->
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">
                            <i class="fas fa-tv me-2"></i>Display Status
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Active on Display</h6>
                                        <small class="text-muted">This video appears in the background rotation</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-sort-numeric-down text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">Play Order: {{ $video->sort_order ?: 'Auto' }}</h6>
                                        <small class="text-muted">Position in the video sequence</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Live Status:</strong> This video is currently playing in the background loop on the main display screen.
                            <a href="{{ route('home') }}" target="_blank" class="alert-link">View Live Display</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Information -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h6 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>Video Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Title:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $video->title }}
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Filename:</strong>
                            </div>
                            <div class="col-sm-8">
                                <code class="small">{{ $video->filename }}</code>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>File Size:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ number_format($video->size / 1024 / 1024, 2) }} MB
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Type:</strong>
                            </div>
                            <div class="col-sm-8">
                                <span class="badge bg-primary">{{ strtoupper(pathinfo($video->filename, PATHINFO_EXTENSION)) }}</span>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>MIME Type:</strong>
                            </div>
                            <div class="col-sm-8">
                                <small class="text-muted">{{ $video->mime_type }}</small>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Sort Order:</strong>
                            </div>
                            <div class="col-sm-8">
                                <span class="badge bg-info">{{ $video->sort_order ?: 'Auto' }}</span>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Uploaded:</strong>
                            </div>
                            <div class="col-sm-8">
                                <small>{{ $video->created_at->format('M d, Y g:i A') }}</small>
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-sm-4">
                                <strong>Last Updated:</strong>
                            </div>
                            <div class="col-sm-8">
                                <small>{{ $video->updated_at->format('M d, Y g:i A') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="mb-0">
                            <i class="fas fa-tools me-2"></i>Quick Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.videos.edit', $video) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Edit Video Details
                            </a>
                            
                            @if($videoUrl)
                                <a href="{{ $videoUrl }}" target="_blank" class="btn btn-info">
                                    <i class="fas fa-external-link-alt me-2"></i>View Full Size
                                </a>
                                
                                <a href="{{ $videoUrl }}" download="{{ $video->filename }}" class="btn btn-success">
                                    <i class="fas fa-download me-2"></i>Download Video
                                </a>
                            @endif
                            
                            <hr class="my-2">
                            
                            <button 
                                type="button" 
                                class="btn btn-danger"
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal"
                            >
                                <i class="fas fa-trash me-2"></i>Delete Video
                            </button>
                        </div>
                    </div>
                </div>
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
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Video Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone!
                </div>
                
                <p>Are you sure you want to delete the video: <strong>"{{ $video->title }}"</strong>?</p>
                
                <ul class="mb-3">
                    <li>The video will be removed from the display immediately</li>
                    <li>The video file will be permanently deleted from the server</li>
                    <li>This action cannot be reversed</li>
                </ul>
                
                <div class="mb-3">
                    <label for="deletePassword" class="form-label">
                        <strong>Enter your admin password to confirm:</strong>
                    </label>
                    <input type="password" class="form-control" id="deletePassword" placeholder="Your password" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="d-inline" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="password" id="deletePasswordField">
                    <button type="submit" class="btn btn-danger" id="confirmDeleteBtn" disabled>
                        <i class="fas fa-trash me-2"></i>Yes, Delete Video
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deletePasswordInput = document.getElementById('deletePassword');
    const deletePasswordField = document.getElementById('deletePasswordField');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    
    deletePasswordInput.addEventListener('input', function() {
        const password = this.value.trim();
        deletePasswordField.value = password;
        confirmDeleteBtn.disabled = password.length === 0;
    });
    
    // Clear password when modal is hidden
    document.getElementById('deleteModal').addEventListener('hidden.bs.modal', function() {
        deletePasswordInput.value = '';
        deletePasswordField.value = '';
        confirmDeleteBtn.disabled = true;
    });
});
</script>
@endpush