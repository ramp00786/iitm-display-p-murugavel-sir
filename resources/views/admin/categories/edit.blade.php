@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Enter a unique name for this category.</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Categories
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category Details</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <strong>Current Name:</strong><br>
                        {{ $category->name }}
                    </li>
                    <li class="mb-2">
                        <strong>Sort Order:</strong><br>
                        {{ $category->sort_order }}
                    </li>
                    <li class="mb-2">
                        <strong>News Items:</strong><br>
                        <span class="badge bg-info">{{ $category->news()->count() }}</span>
                    </li>
                    <li class="mb-2">
                        <strong>Created:</strong><br>
                        {{ $category->created_at->format('M d, Y h:i A') }}
                    </li>
                    <li>
                        <strong>Last Updated:</strong><br>
                        {{ $category->updated_at->format('M d, Y h:i A') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection