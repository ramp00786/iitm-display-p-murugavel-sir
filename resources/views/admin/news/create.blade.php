@extends('layouts.admin')

@section('title', 'Create News Item')
@section('page-title', 'Create New News Item')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">News Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.news.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ old('category_id', $selectedCategory) == $category->id ? 'selected' : '' }}>
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
                                  placeholder="Enter the news title or content">{{ old('title') }}</textarea>
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
                            <i class="fas fa-save me-2"></i>Create News Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Information</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-4">
                    <li class="mb-2">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        News items appear in tickers at the bottom of the display.
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-sort text-info me-2"></i>
                        Items can be reordered by dragging in the news list.
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-tags text-info me-2"></i>
                        Each news item must belong to a category.
                    </li>
                    <li>
                        <i class="fas fa-eye text-info me-2"></i>
                        News items are displayed in scrolling tickers.
                    </li>
                </ul>

                @if($categories->count() == 0)
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>No categories found!</strong><br>
                    <a href="{{ route('admin.categories.create') }}">Create a category first</a>
                </div>
                @endif

                <h6 class="text-primary mb-2">Available Categories:</h6>
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