@extends('layouts.admin')

@section('title', 'Slideshow Item Details')
@section('page-title', 'Slideshow: ' . $slideshow->title)

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('admin.slideshows.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Slideshows
                </a>
            </div>
            <div>
                <a href="{{ route('admin.slideshows.edit', $slideshow) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit Item
                </a>
                <a href="{{ $slideshow->url }}" class="btn btn-success" target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>View Full Size
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Preview</h6>
            </div>
            <div class="card-body text-center">
                @if($slideshow->type === 'image' || $slideshow->type === 'gif')
                    <img src="{{ $slideshow->url }}" alt="{{ $slideshow->title }}" 
                         class="img-fluid rounded shadow" style="max-height: 500px;">
                @elseif($slideshow->type === 'video')
                    <video width="100%" height="400" controls class="rounded shadow">
                        <source src="{{ $slideshow->url }}" type="{{ $slideshow->mime_type }}">
                        Your browser does not support the video tag.
                    </video>
                @endif
                
                <div class="mt-3">
                    <h5>{{ $slideshow->title }}</h5>
                    @if($slideshow->type === 'image')
                        <span class="badge bg-info fs-6"><i class="fas fa-image me-1"></i>Image File</span>
                    @elseif($slideshow->type === 'video')
                        <span class="badge bg-danger fs-6"><i class="fas fa-video me-1"></i>Video File</span>
                    @elseif($slideshow->type === 'gif')
                        <span class="badge bg-warning fs-6"><i class="fas fa-magic me-1"></i>Animated GIF</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Item Information</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <strong>Title:</strong><br>
                        <span class="h6">{{ $slideshow->title }}</span>
                    </li>
                    <li class="mb-3">
                        <strong>File Name:</strong><br>
                        {{ $slideshow->filename }}
                    </li>
                    <li class="mb-3">
                        <strong>File Type:</strong><br>
                        {{ $slideshow->mime_type }}
                    </li>
                    <li class="mb-3">
                        <strong>File Size:</strong><br>
                        <span class="badge bg-info fs-6">{{ $slideshow->formatted_size }}</span>
                    </li>
                    <li class="mb-3">
                        <strong>Sort Order:</strong><br>
                        <span class="badge bg-secondary fs-6">{{ $slideshow->sort_order }}</span>
                    </li>
                    <li class="mb-3">
                        <strong>Created:</strong><br>
                        {{ $slideshow->created_at->format('M d, Y h:i A') }}
                    </li>
                    <li>
                        <strong>Last Updated:</strong><br>
                        {{ $slideshow->updated_at->format('M d, Y h:i A') }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ $slideshow->url }}" class="btn btn-outline-primary" target="_blank">
                        <i class="fas fa-eye me-2"></i>View Full Size
                    </a>
                    
                    <a href="{{ $slideshow->url }}" class="btn btn-outline-success" download="{{ $slideshow->filename }}">
                        <i class="fas fa-download me-2"></i>Download File
                    </a>
                    
                    <a href="{{ route('admin.slideshows.edit', $slideshow) }}" class="btn btn-outline-warning">
                        <i class="fas fa-edit me-2"></i>Edit Details
                    </a>
                    
                    <button type="button" class="btn btn-outline-info" onclick="copyUrl()">
                        <i class="fas fa-copy me-2"></i>Copy URL
                    </button>
                </div>

                <hr>

                <form method="POST" action="{{ route('admin.slideshows.destroy', $slideshow) }}" 
                      onsubmit="return confirm('Are you sure you want to delete this slideshow item? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-trash me-2"></i>Delete Item
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Display Information</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        This item appears in the pre-display slideshow.
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-clock text-info me-2"></i>
                        Displays for 5 seconds before auto-advancing.
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-sort text-info me-2"></i>
                        Order can be changed by dragging in the list.
                    </li>
                    <li>
                        <i class="fas fa-tv text-info me-2"></i>
                        Optimized for LED screen display.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyUrl() {
    const url = '{{ $slideshow->url }}';
    
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(url).then(() => {
            showAlert('success', 'URL copied to clipboard!');
        }).catch(() => {
            fallbackCopyTextToClipboard(url);
        });
    } else {
        fallbackCopyTextToClipboard(url);
    }
}

function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";
    
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        document.execCommand('copy');
        showAlert('success', 'URL copied to clipboard!');
    } catch (err) {
        showAlert('error', 'Failed to copy URL');
    }
    
    document.body.removeChild(textArea);
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
    }, 3000);
}
</script>
@endpush