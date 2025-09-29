@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories Management')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Categories</h4>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Category
            </a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover" id="categoriesTable">
                    <thead class="table-dark">
                        <tr>
                            <th width="50"><i class="fas fa-arrows-alt" title="Drag to reorder"></i></th>
                            <th>Name</th>
                            <th>News Count</th>
                            <th>Sort Order</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortableCategories">
                        @foreach($categories as $category)
                        <tr class="sortable" data-id="{{ $category->id }}">
                            <td class="handle text-center">
                                <i class="fas fa-grip-vertical text-muted"></i>
                            </td>
                            <td>
                                <strong>{{ $category->name }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $category->news->count() }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $category->sort_order }}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.categories.show', $category) }}" 
                                       class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($category->news->count() == 0)
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" 
                                          class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @else
                                    <button type="button" class="btn btn-sm btn-outline-secondary" 
                                            title="Cannot delete - has news items" disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No categories found</h5>
                <p class="text-muted">Start by creating your first category.</p>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add First Category
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize sortable
    const sortable = new Sortable(document.getElementById('sortableCategories'), {
        handle: '.handle',
        animation: 150,
        onEnd: function(evt) {
            let categoryIds = [];
            $('#sortableCategories tr').each(function() {
                categoryIds.push($(this).data('id'));
            });
            
            // Update sort order via AJAX
            $.ajax({
                url: '{{ route('admin.categories.reorder') }}',
                method: 'POST',
                data: {
                    categories: categoryIds,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Update the sort order badges
                        $('#sortableCategories tr').each(function(index) {
                            $(this).find('.badge.bg-secondary').text(index + 1);
                        });
                        
                        // Show success message
                        showAlert('success', 'Categories reordered successfully');
                    }
                },
                error: function() {
                    showAlert('danger', 'Failed to reorder categories');
                }
            });
        }
    });
});

function showAlert(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    $('.container-fluid.py-4').prepend(alertHtml);
    
    // Auto dismiss after 3 seconds
    setTimeout(() => {
        $('.alert').alert('close');
    }, 3000);
}
</script>
@endpush