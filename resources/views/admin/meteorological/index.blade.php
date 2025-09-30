@extends('layouts.admin')

@section('title', 'Meteorological Data Management')
@section('page-title', 'Meteorological Data Management')

@section('content')
<div class="row">
    <div class="col-12 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="text-dark">Meteorological Tabs</h4>
            <a href="{{ route('admin.meteorological.create.tab') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Tab
            </a>
        </div>
    </div>
</div>

<!-- Tabs as Cards -->
<div class="row" id="tabsContainer">
    @if($tabs->count() > 0)
        @foreach($tabs as $tab)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-left-primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-1 font-weight-bold">
                                <a href="{{ route('admin.meteorological.tab.charts.page', $tab->id) }}" 
                                   class="text-primary text-decoration-none" style="cursor: pointer;">
                                    {{ $tab->heading }}
                                </a>
                            </div>
                            <div class="text-xs text-gray-600">
                                <a href="{{ route('admin.meteorological.tab.charts.page', $tab->id) }}" 
                                   class="text-primary text-decoration-none" style="cursor: pointer;">
                                {{ $tab->charts->count() }} {{ $tab->charts->count() == 1 ? 'chart' : 'charts' }}
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-info btn-sm edit-tab" data-tab-id="{{ $tab->id }}" 
                                data-tab-heading="{{ $tab->heading }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm delete-tab" data-tab-id="{{ $tab->id }}"
                                data-tab-heading="{{ $tab->heading }}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-cloud-sun fa-5x text-gray-300 mb-4"></i>
                <h4 class="text-gray-500">No Meteorological Data Tabs</h4>
                <p class="text-gray-400 mb-4">Start by creating your first meteorological data tab.</p>
                <a href="{{ route('admin.meteorological.create.tab') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create First Tab
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Edit Tab Modal -->
<div class="modal fade" id="editTabModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Edit Tab Heading</h5>
                <button type="button" class="close modal-close-btn" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editTabForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editTabHeading" class="form-label">Tab Heading:</label>
                        <input type="text" class="form-control" id="editTabHeading" name="tab_heading" 
                               placeholder="Enter new heading" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-close-btn" data-dismiss="modal" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Update Heading</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="close modal-close-btn" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteTabForm">
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Warning!</strong> This action will permanently delete the tab <strong id="deleteTabName"></strong> and all its charts.
                    </div>
                    <div class="form-group">
                        <label for="adminPassword" class="form-label">Enter Admin Password to Confirm:</label>
                        <input type="password" class="form-control" id="adminPassword" name="admin_password" 
                               placeholder="Enter admin password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-close-btn" data-dismiss="modal" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Tab & Charts</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>
                <span id="toastMessage">Tab heading updated successfully!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <span id="errorToastMessage">Error occurred!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentTabId = null;
let currentTabHeading = null;

$(document).ready(function() {
    // Modal close event handlers for both Bootstrap 4 and 5 compatibility
    $('.modal-close-btn').on('click', function() {
        const modalId = $(this).closest('.modal').attr('id');
        $(`#${modalId}`).modal('hide');
    });
    
    // Close modals when clicking outside or pressing ESC
    $('.modal').on('click', function(e) {
        if (e.target === this) {
            $(this).modal('hide');
        }
    });
    
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            $('.modal.show').modal('hide');
        }
    });
    
    // Clear form data when modals are closed
    $('#editTabModal').on('hidden.bs.modal hidden.modal', function() {
        $('#editTabHeading').val('');
    });
    
    $('#deleteConfirmModal').on('hidden.bs.modal hidden.modal', function() {
        $('#adminPassword').val('');
    });
    
    // Edit tab button - show edit modal
    $('.edit-tab').on('click', function() {
        const tabId = $(this).data('tab-id');
        const tabHeading = $(this).data('tab-heading');
        showEditTabModal(tabId, tabHeading);
    });
    
    // Delete tab button - show password confirmation modal
    $('.delete-tab').on('click', function() {
        const tabId = $(this).data('tab-id');
        const tabHeading = $(this).data('tab-heading');
        showDeleteConfirmModal(tabId, tabHeading);
    });
    
    // Edit tab form submission
    $('#editTabForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        updateTab(currentTabId, formData);
    });
    
    // Delete tab form submission with password verification
    $('#deleteTabForm').on('submit', function(e) {
        e.preventDefault();
        const password = $('#adminPassword').val();
        deleteTabWithPassword(currentTabId, password);
    });
});

function showEditTabModal(tabId, tabHeading) {
    currentTabId = tabId;
    currentTabHeading = tabHeading;
    $('#editTabHeading').val(tabHeading);
    $('#editTabModal').modal('show');
}

function showDeleteConfirmModal(tabId, tabHeading) {
    currentTabId = tabId;
    currentTabHeading = tabHeading;
    $('#deleteTabName').text(tabHeading);
    $('#adminPassword').val('');
    $('#deleteConfirmModal').modal('show');
}

function updateTab(tabId, formData) {
    $.ajax({
        url: `{{ url('admin/meteorological/tab') }}/${tabId}/update`,
        method: 'PUT',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            // Close the modal
            $('#editTabModal').modal('hide');
            
            // Update the heading in the card immediately
            const newHeading = $('#editTabHeading').val();
            $(`.edit-tab[data-tab-id="${tabId}"]`).closest('.card').find('a.text-primary').text(newHeading);
            $(`.edit-tab[data-tab-id="${tabId}"]`).attr('data-tab-heading', newHeading);
            $(`.delete-tab[data-tab-id="${tabId}"]`).attr('data-tab-heading', newHeading);
            
            // Show success toast
            showSuccessToast('Tab heading updated successfully!');
        },
        error: function(xhr) {
            showErrorToast('Error updating tab. Please try again.');
        }
    });
}

function deleteTabWithPassword(tabId, password) {
    $.ajax({
        url: `{{ url('admin/meteorological/tab') }}/${tabId}/delete-with-password`,
        method: 'POST',
        data: {
            admin_password: password
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            $('#deleteConfirmModal').modal('hide');
            showSuccessToast('Tab and all charts deleted successfully!');
            
            // Remove the deleted card from DOM immediately
            $(`.delete-tab[data-tab-id="${tabId}"]`).closest('.col-lg-4').fadeOut(500, function() {
                $(this).remove();
                
                // Check if no tabs remain, show empty state
                if ($('#tabsContainer .col-lg-4').length === 0) {
                    $('#tabsContainer').html(`
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-cloud-sun fa-5x text-gray-300 mb-4"></i>
                                <h4 class="text-gray-500">No Meteorological Data Tabs</h4>
                                <p class="text-gray-400 mb-4">Start by creating your first meteorological data tab.</p>
                                <a href="/admin/meteorological/create-tab" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create First Tab
                                </a>
                            </div>
                        </div>
                    `);
                }
            });
        },
        error: function(xhr) {
            if (xhr.status === 401) {
                showErrorToast('Incorrect admin password. Please try again.');
                $('#adminPassword').focus();
            } else {
                showErrorToast('Error deleting tab. Please try again.');
            }
        }
    });
}

// Toast helper functions
function showSuccessToast(message) {
    $('#toastMessage').text(message);
    const successToast = new bootstrap.Toast(document.getElementById('successToast'));
    successToast.show();
}

function showErrorToast(message) {
    $('#errorToastMessage').text(message);
    const errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
    errorToast.show();
}
</script>
@endpush