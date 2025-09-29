@extends('layouts.admin')

@section('title', 'Category Details')
@section('page-title', 'Category: ' . $category->name)

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Categories
                </a>
            </div>
            <div>
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit Category
                </a>
                <a href="{{ route('admin.news.create') }}?category_id={{ $category->id }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Add News Item
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category Information</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <strong>Name:</strong><br>
                        <span class="h5">{{ $category->name }}</span>
                    </li>
                    <li class="mb-3">
                        <strong>Sort Order:</strong><br>
                        <span class="badge bg-secondary fs-6">{{ $category->sort_order }}</span>
                    </li>
                    <li class="mb-3">
                        <strong>Total News Items:</strong><br>
                        <span class="badge bg-info fs-6">{{ $category->news->count() }}</span>
                    </li>
                    <li class="mb-3">
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

    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">News Items in this Category</h6>
                <a href="{{ route('admin.news.create') }}?category_id={{ $category->id }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i>Add News
                </a>
            </div>
            <div class="card-body">
                @if($category->news->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Sort Order</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->news as $news)
                                <tr>
                                    <td>{{ $news->title }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $news->sort_order }}</span>
                                    </td>
                                    <td>{{ $news->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.news.edit', $news) }}" 
                                               class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.news.destroy', $news) }}" 
                                                  class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No news items found</h5>
                        <p class="text-muted">This category doesn't have any news items yet.</p>
                        <a href="{{ route('admin.news.create') }}?category_id={{ $category->id }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add First News Item
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection