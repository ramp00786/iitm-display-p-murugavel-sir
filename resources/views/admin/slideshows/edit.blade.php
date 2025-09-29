@extends('layouts.admin')

@section('title', 'Edit Slideshow Item')
@section('page-title', 'Edit Slideshow Item')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Slideshow Item Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.slideshows.update', $slideshow) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Item Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $slideshow->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Enter a descriptive title for this slideshow item.</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.slideshows.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Slideshows
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Current Item Details</h6>
            </div>
            <div class="card-body">
                <!-- Preview -->
                <div class="text-center mb-3">
                    @if($slideshow->type === 'image' || $slideshow->type === 'gif')
                        <img src="{{ $slideshow->url }}" alt="Preview" 
                             class="img-fluid rounded" style="max-height: 200px;">
                    @elseif($slideshow->type === 'video')
                        <video width="100%" height="200" controls>
                            <source src="{{ $slideshow->url }}" type="{{ $slideshow->mime_type }}">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>

                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <strong>Current Title:</strong><br>
                        {{ $slideshow->title }}
                    </li>
                    <li class="mb-2">
                        <strong>Type:</strong><br>
                        @if($slideshow->type === 'image')
                            <span class="badge bg-info"><i class="fas fa-image me-1"></i>Image</span>
                        @elseif($slideshow->type === 'video')
                            <span class="badge bg-danger"><i class="fas fa-video me-1"></i>Video</span>
                        @elseif($slideshow->type === 'gif')
                            <span class="badge bg-warning"><i class="fas fa-magic me-1"></i>GIF</span>
                        @endif
                    </li>
                    <li class="mb-2">
                        <strong>File Name:</strong><br>
                        {{ $slideshow->filename }}
                    </li>
                    <li class="mb-2">
                        <strong>File Size:</strong><br>
                        {{ $slideshow->formatted_size }}
                    </li>
                    <li class="mb-2">
                        <strong>Sort Order:</strong><br>
                        <span class="badge bg-secondary">{{ $slideshow->sort_order }}</span>
                    </li>
                    <li class="mb-2">
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
                <h6 class="m-0 font-weight-bold text-primary">File Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ $slideshow->url }}" class="btn btn-outline-primary" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>View Full Size
                    </a>
                    <a href="{{ $slideshow->url }}" class="btn btn-outline-success" download="{{ $slideshow->filename }}">
                        <i class="fas fa-download me-2"></i>Download File
                    </a>
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
    </div>
</div>
@endsection