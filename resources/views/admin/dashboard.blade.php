@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Categories</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['categories'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tags fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">News Items</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['news'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Videos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['videos'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-video fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Slideshows</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['slideshows'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-images fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Storage Usage -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Storage Usage</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Videos</span>
                        <span>{{ $stats['storage_usage']['videos'] }}</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Slideshows</span>
                        <span>{{ $stats['storage_usage']['slideshows'] }}</span>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Total Storage</strong>
                    <strong>{{ $stats['storage_usage']['total'] }}</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add New Video
                    </a>
                    <a href="{{ route('admin.slideshows.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Add Slideshow Item
                    </a>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-info">
                        <i class="fas fa-plus me-2"></i>Add News Item
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-warning" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>View Display
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- System Information -->
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">System Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>File Upload Limits</h6>
                        <ul class="list-unstyled">
                            <li><strong>Max Video Size:</strong> {{ number_format(env('MAX_VIDEO_SIZE', 104857600) / 1048576, 0) }}MB</li>
                            <li><strong>Max Image Size:</strong> {{ number_format(env('MAX_IMAGE_SIZE', 10485760) / 1048576, 0) }}MB</li>
                            <li><strong>Supported Video Formats:</strong> {{ env('SUPPORTED_VIDEO_FORMATS', 'mp4,avi,mov') }}</li>
                            <li><strong>Supported Image Formats:</strong> {{ env('SUPPORTED_IMAGE_FORMATS', 'jpg,jpeg,png,gif') }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Application Info</h6>
                        <ul class="list-unstyled">
                            <li><strong>Environment:</strong> {{ config('app.env') }}</li>
                            <li><strong>Debug Mode:</strong> {{ config('app.debug') ? 'Enabled' : 'Disabled' }}</li>
                            <li><strong>Laravel Version:</strong> {{ app()->version() }}</li>
                            <li><strong>PHP Version:</strong> {{ PHP_VERSION }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }
</style>
@endpush