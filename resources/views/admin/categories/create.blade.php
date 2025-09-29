@extends('layouts.admin')

@section('title', 'Create Category')
@section('page-title', 'Create New Category')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
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
                            <i class="fas fa-save me-2"></i>Create Category
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
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        Categories are used to organize news items into groups like "News" and "Temperature".
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-sort text-info me-2"></i>
                        Categories can be reordered by dragging in the categories list.
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Category names must be unique.
                    </li>
                    <li>
                        <i class="fas fa-trash text-danger me-2"></i>
                        Categories with news items cannot be deleted.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection