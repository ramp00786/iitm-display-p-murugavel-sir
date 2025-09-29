@extends('layouts.admin')

@section('title', 'Create New Meteorological Tab')
@section('page-title', 'Create New Meteorological Tab')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-plus"></i> Step 1: Create Tab Heading
                </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.meteorological.store.tab') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="heading" class="font-weight-bold">Tab Heading</label>
                        <input type="text" name="heading" id="heading" class="form-control @error('heading') is-invalid @enderror" 
                               value="{{ old('heading') }}" placeholder="e.g., Solapur Obs, Delhi Obs, Chennai Obs, Pune Obs" required>
                        @error('heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">This will be the tab button text on the display and determine the station.</small>
                    </div>

                    <div class="form-group mb-0">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.meteorological.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Next: Add Charts <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Preview Card -->
        <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-eye"></i> Tab Preview
                </h6>
            </div>
            <div class="card-body">
                <p class="text-muted mb-2">This is how your tab will appear on the display:</p>
                <div class="station-bar-preview border rounded p-2 bg-light">
                    <button type="button" class="btn btn-sm btn-outline-primary mr-2">Existing Tab 1</button>
                    <button type="button" class="btn btn-sm btn-primary" id="preview-tab">
                        <span id="preview-text">Your Tab Heading</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-primary ml-2">Existing Tab 2</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Live preview of tab heading
    $('#heading').on('input', function() {
        var heading = $(this).val().trim();
        if (heading) {
            $('#preview-text').text(heading);
        } else {
            $('#preview-text').text('Your Tab Heading');
        }
    });

    // Auto-detect station from heading
    $('#heading').on('input', function() {
        var heading = $(this).val().toLowerCase();
        if (heading.includes('solapur') || heading.includes('delhi') || heading.includes('chennai') || heading.includes('pune')) {
            $('#preview-tab').removeClass('btn-primary').addClass('btn-success');
        } else {
            $('#preview-tab').removeClass('btn-success').addClass('btn-primary');
        }
    });
});
</script>

<style>
.station-bar-preview {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 50px;
}
</style>
@endsection