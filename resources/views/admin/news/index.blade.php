@extends('layouts.admin')

@section('title', 'News Management')
@section('page-title', 'News Management')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">News Items</h4>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add News Item
            </a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($news->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover" id="newsTable">
                    <thead class="table-dark">
                        <tr>
                            <th width="50"><i class="fas fa-arrows-alt" title="Drag to reorder"></i></th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Sort Order</th>
                            <th>Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortableNews">
                        @foreach($news as $item)
                        <tr class="sortable" data-id="{{ $item->id }}">
                            <td class="handle text-center">
                                <i class="fas fa-grip-vertical text-muted"></i>
                            </td>
                            <td>
                                <strong>{{ $item->title }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $item->category->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $item->sort_order }}</span>
                            </td>
                            <td>{{ $item->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.news.edit', $item) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.news.destroy', $item) }}" 
                                          class="d-inline" onsubmit="return confirm('Are you sure you want to delete this news item?')">
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
                <p class="text-muted">Start by creating your first news item.</p>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add First News Item
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Category Filter -->
@if($news->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">News by Category</h6>
            </div>
            <div class="card-body">
                @php
                    $categories = $news->groupBy('category.name');
                @endphp
                
                @foreach($categories as $categoryName => $categoryNews)
                <div class="mb-4">
                    <h6 class="text-primary border-bottom pb-2">{{ $categoryName }} ({{ $categoryNews->count() }} items)</h6>
                    <div class="row">
                        @foreach($categoryNews as $item)
                        <div class="col-md-6 col-lg-4 mb-2">
                            <div class="card border-left-primary">
                                <div class="card-body py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-truncate">{{ $item->title }}</small>
                                        <span class="badge bg-secondary ms-2">{{ $item->sort_order }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize sortable
    const sortable = new Sortable(document.getElementById('sortableNews'), {
        handle: '.handle',
        animation: 150,
        onEnd: function(evt) {
            let newsIds = [];
            $('#sortableNews tr').each(function() {
                newsIds.push($(this).data('id'));
            });
            
            // Update sort order via AJAX
            $.ajax({
                url: '{{ route('admin.news.reorder') }}',
                method: 'POST',
                data: {
                    news: newsIds,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Update the sort order badges
                        $('#sortableNews tr').each(function(index) {
                            $(this).find('.badge.bg-secondary').text(index + 1);
                        });
                        
                        // Show success message
                        showAlert('success', 'News items reordered successfully');
                    }
                },
                error: function() {
                    showAlert('danger', 'Failed to reorder news items');
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