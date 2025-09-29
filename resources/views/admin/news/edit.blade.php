@extends('layouts.admin')

@section('title', 'Edit News Item')
@section('page-title', 'Edit News Item')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">News Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.news.update', $news) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Select the category for this news item.</div>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">News Title <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('title') is-invalid @enderror" 
                                  id="title" name="title" rows="3" required 
                                  placeholder="Enter the news title or content">{{ old('title', $news->title) }}</textarea>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">This text will be displayed in the ticker on the landing page.</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to News
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update News Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">News Details</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <strong>Current Category:</strong><br>
                        <span class="badge bg-primary">{{ $news->category->name }}</span>
                    </li>
                    <li class="mb-2">
                        <strong>Current Title:</strong><br>
                        {{ $news->title }}
                    </li>
                    <li class="mb-2">
                        <strong>Sort Order:</strong><br>
                        <span class="badge bg-secondary">{{ $news->sort_order }}</span>
                    </li>
                    <li class="mb-2">
                        <strong>Created:</strong><br>
                        {{ $news->created_at->format('M d, Y h:i A') }}
                    </li>
                    <li>
                        <strong>Last Updated:</strong><br>
                        {{ $news->updated_at->format('M d, Y h:i A') }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="card shadow mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Available Categories</h6>
            </div>
            <div class="card-body">
                @foreach($categories as $category)
                <div class="mb-1">
                    <span class="badge bg-primary">{{ $category->name }}</span>
                    <small class="text-muted">({{ $category->news->count() }} items)</small>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection