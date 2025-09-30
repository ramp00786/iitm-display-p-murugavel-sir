@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'IITM Display Portal Dashboard')

@section('content')

<!-- System Status Banner -->
<div class="row mb-4">
    <div class="col-12">
        @if($stats['system_health']['status'] === 'healthy')
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="bg-success rounded-circle p-2" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check text-white fa-lg"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="alert-heading mb-1 fw-bold">System Running Smoothly</h6>
                        <p class="mb-0">Display portal is operational with {{ $stats['system_health']['total_content'] }} content items. {{ $stats['system_health']['content_activity'] }} items added in the last 7 days.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('home') }}" class="btn btn-success btn-sm" target="_blank">
                            <i class="fas fa-external-link-alt me-2"></i>View Live Display
                        </a>
                        <a href="{{ route('admin.help.index') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-question-circle me-2"></i>Help
                        </a>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @else
            <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="bg-warning rounded-circle p-2" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-exclamation-triangle text-white fa-lg"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="alert-heading mb-1 fw-bold">Setup Required</h6>
                        <p class="mb-0">Get started by adding content to your display portal. Check the help center for step-by-step guides.</p>
                    </div>
                    <a href="{{ route('admin.help.index') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-rocket me-2"></i>Get Started
                    </a>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>

<!-- Content Statistics -->
<div class="row mb-4">
    <div class="col-xl-2 col-lg-4 col-md-6 mb-4">
        <div class="card gradient-card-1 h-100 border-0 shadow-sm">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-white-50 text-uppercase fw-bold mb-1">Categories</div>
                        <div class="h4 mb-0 fw-bold">{{ $stats['categories'] }}</div>
                        <div class="small text-white-75 mt-1">
                            <i class="fas fa-tags me-1"></i>Content groups
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded p-2">
                        <i class="fas fa-tags fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-4 col-md-6 mb-4">
        <div class="card gradient-card-2 h-100 border-0 shadow-sm">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-white-50 text-uppercase fw-bold mb-1">News Items</div>
                        <div class="h4 mb-0 fw-bold">{{ $stats['news'] }}</div>
                        <div class="small text-white-75 mt-1">
                            <i class="fas fa-rss me-1"></i>Live tickers
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded p-2">
                        <i class="fas fa-newspaper fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-4 col-md-6 mb-4">
        <div class="card gradient-card-3 h-100 border-0 shadow-sm">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-white-50 text-uppercase fw-bold mb-1">Videos</div>
                        <div class="h4 mb-0 fw-bold">{{ $stats['videos'] }}</div>
                        <div class="small text-white-75 mt-1">
                            <i class="fas fa-play me-1"></i>Background media
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded p-2">
                        <i class="fas fa-video fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-4 col-md-6 mb-4">
        <div class="card gradient-card-4 h-100 border-0 shadow-sm">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-white-50 text-uppercase fw-bold mb-1">Slideshows</div>
                        <div class="h4 mb-0 fw-bold">{{ $stats['slideshows'] }}</div>
                        <div class="small text-white-75 mt-1">
                            <i class="fas fa-images me-1"></i>Presentation mode
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded p-2">
                        <i class="fas fa-images fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-4 col-md-6 mb-4">
        <div class="card gradient-card-5 h-100 border-0 shadow-sm">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-white-50 text-uppercase fw-bold mb-1">Charts</div>
                        <div class="h4 mb-0 fw-bold">{{ $stats['meteorological_tabs'] }}</div>
                        <div class="small text-white-75 mt-1">
                            <i class="fas fa-chart-line me-1"></i>Data displays
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded p-2">
                        <i class="fas fa-chart-area fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-4 col-md-6 mb-4">
        <div class="card gradient-card-6 h-100 border-0 shadow-sm">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="small text-white-50 text-uppercase fw-bold mb-1">Storage</div>
                        <div class="h4 mb-0 fw-bold">{{ $stats['storage_usage']['total'] }}</div>
                        <div class="small text-white-75 mt-1">
                            <i class="fas fa-hdd me-1"></i>Total used
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded p-2">
                        <i class="fas fa-database fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Dashboard Content -->
<div class="row mb-4">
    <!-- Recent Activity -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-dark mb-0">
                        <i class="fas fa-clock text-primary me-2"></i>Recent Activity
                    </h6>
                    <small class="text-muted">Last 10 actions</small>
                </div>
            </div>
            <div class="card-body pt-3">
                @if($stats['recent_activity']->count() > 0)
                    <div class="timeline">
                        @foreach($stats['recent_activity'] as $activity)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-{{ $activity['color'] }}">
                                <i class="{{ $activity['icon'] }} fa-sm text-white"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1 fw-semibold">{{ $activity['title'] }}</h6>
                                <p class="mb-0 text-muted small">{{ $activity['description'] }}</p>
                                <small class="text-muted">{{ $activity['time'] }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-2x text-muted mb-3"></i>
                        <p class="text-muted mb-0">No recent activity</p>
                        <small class="text-muted">Start by adding some content!</small>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pb-0">
                <h6 class="fw-bold text-dark mb-0">
                    <i class="fas fa-rocket text-primary me-2"></i>Quick Actions
                </h6>
            </div>
            <div class="card-body pt-3">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.news.create') }}" class="btn btn-outline-success btn-action">
                        <div class="d-flex align-items-center">
                            <div class="action-icon bg-success me-3">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <div class="text-start">
                                <div class="fw-semibold">Add News Item</div>
                                <small class="text-muted">Create ticker content</small>
                            </div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.videos.create') }}" class="btn btn-outline-primary btn-action">
                        <div class="d-flex align-items-center">
                            <div class="action-icon bg-primary me-3">
                                <i class="fas fa-video"></i>
                            </div>
                            <div class="text-start">
                                <div class="fw-semibold">Upload Video</div>
                                <small class="text-muted">Background media</small>
                            </div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.slideshows.create') }}" class="btn btn-outline-warning btn-action">
                        <div class="d-flex align-items-center">
                            <div class="action-icon bg-warning me-3">
                                <i class="fas fa-images"></i>
                            </div>
                            <div class="text-start">
                                <div class="fw-semibold">Add Slideshow</div>
                                <small class="text-muted">Images & videos</small>
                            </div>
                        </div>
                    </a>
                    
                    <hr class="my-3">
                    
                    <a href="{{ route('home') }}" class="btn btn-dark btn-action" target="_blank">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-external-link-alt me-2"></i>
                            <span class="fw-semibold">View Live Display</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Breakdown -->
<div class="row mb-4">
    <!-- Storage Analysis -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pb-0">
                <h6 class="fw-bold text-dark mb-0">
                    <i class="fas fa-chart-pie text-primary me-2"></i>Storage Breakdown
                </h6>
            </div>
            <div class="card-body pt-3">
                <div class="storage-item mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="storage-icon bg-info me-3">
                                <i class="fas fa-video text-white"></i>
                            </div>
                            <span class="fw-semibold">Background Videos</span>
                        </div>
                        <span class="badge bg-info">{{ $stats['storage_usage']['videos'] }}</span>
                    </div>
                </div>
                
                <div class="storage-item mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="storage-icon bg-warning me-3">
                                <i class="fas fa-images text-white"></i>
                            </div>
                            <span class="fw-semibold">Slideshow Content</span>
                        </div>
                        <span class="badge bg-warning">{{ $stats['storage_usage']['slideshows'] }}</span>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">Total Storage Used</h6>
                    <h6 class="mb-0 text-primary fw-bold">{{ $stats['storage_usage']['total'] }}</h6>
                </div>
                
                @if($stats['system_health']['storage_warning'])
                    <div class="alert alert-warning alert-sm mt-3 mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <small>Storage usage is high. Consider cleaning up old files.</small>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Content Distribution -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pb-0">
                <h6 class="fw-bold text-dark mb-0">
                    <i class="fas fa-chart-bar text-primary me-2"></i>Content Distribution
                </h6>
            </div>
            <div class="card-body pt-3">
                @if($stats['content_breakdown']['news_by_category']->count() > 0)
                    <div class="mb-4">
                        <small class="text-muted text-uppercase fw-bold mb-2 d-block">News by Category</small>
                        @foreach($stats['content_breakdown']['news_by_category'] as $category)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small">{{ $category->category_name }}</span>
                            <span class="badge bg-success">{{ $category->count }} items</span>
                        </div>
                        @endforeach
                    </div>
                @endif
                
                @if($stats['content_breakdown']['slideshow_by_type']->count() > 0)
                    <div>
                        <small class="text-muted text-uppercase fw-bold mb-2 d-block">Slideshow Content</small>
                        @foreach($stats['content_breakdown']['slideshow_by_type'] as $type)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small">{{ ucfirst($type->type) }}s</span>
                            <span class="badge bg-warning">{{ $type->count }} files</span>
                        </div>
                        @endforeach
                    </div>
                @endif
                
                @if($stats['content_breakdown']['news_by_category']->count() == 0 && $stats['content_breakdown']['slideshow_by_type']->count() == 0)
                    <div class="text-center py-4">
                        <i class="fas fa-chart-bar fa-2x text-muted mb-3"></i>
                        <p class="text-muted mb-0">No content to analyze</p>
                        <small class="text-muted">Add some content to see distribution charts</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- System Information -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 pb-0">
                <h6 class="fw-bold text-dark mb-0">
                    <i class="fas fa-cogs text-primary me-2"></i>System Information
                </h6>
            </div>
            <div class="card-body pt-3">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-upload text-primary me-2"></i>
                            <strong class="text-dark">Upload Limits</strong>
                        </div>
                        <div class="small text-muted">
                            <div>Video: {{ number_format(env('MAX_VIDEO_SIZE', 104857600) / 1048576, 0) }}MB max</div>
                            <div>Image: {{ number_format(env('MAX_IMAGE_SIZE', 10485760) / 1048576, 0) }}MB max</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-file-video text-success me-2"></i>
                            <strong class="text-dark">Video Formats</strong>
                        </div>
                        <div class="small text-muted">
                            {{ strtoupper(str_replace(',', ', ', env('SUPPORTED_VIDEO_FORMATS', 'mp4,avi,mov'))) }}
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-file-image text-warning me-2"></i>
                            <strong class="text-dark">Image Formats</strong>
                        </div>
                        <div class="small text-muted">
                            {{ strtoupper(str_replace(',', ', ', env('SUPPORTED_IMAGE_FORMATS', 'jpg,jpeg,png,gif'))) }}
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-server text-info me-2"></i>
                            <strong class="text-dark">Environment</strong>
                        </div>
                        <div class="small text-muted">
                            <div>Mode: {{ ucfirst(config('app.env')) }}</div>
                            <div>Debug: {{ config('app.debug') ? 'Enabled' : 'Disabled' }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-code text-danger me-2"></i>
                            <strong class="text-dark">Framework</strong>
                        </div>
                        <div class="small text-muted">
                            <div>Laravel {{ app()->version() }}</div>
                            <div>PHP {{ PHP_VERSION }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-heartbeat text-success me-2"></i>
                            <strong class="text-dark">System Status</strong>
                        </div>
                        <div class="small">
                            @if($stats['system_health']['status'] === 'healthy')
                                <span class="badge bg-success">
                                    <i class="fas fa-check me-1"></i>Healthy
                                </span>
                            @else
                                <span class="badge bg-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Needs Setup
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-top">
                    <div class="row text-center">
                        <div class="col-md-3 col-6 mb-2">
                            <div class="text-muted small">Categories</div>
                            <div class="fw-bold text-primary">{{ $stats['system_health']['categories_configured'] ? 'Configured' : 'Not Set' }}</div>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <div class="text-muted small">News Content</div>
                            <div class="fw-bold {{ $stats['system_health']['has_news'] ? 'text-success' : 'text-muted' }}">
                                {{ $stats['system_health']['has_news'] ? 'Available' : 'None' }}
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <div class="text-muted small">Video Content</div>
                            <div class="fw-bold {{ $stats['system_health']['has_videos'] ? 'text-success' : 'text-muted' }}">
                                {{ $stats['system_health']['has_videos'] ? 'Available' : 'None' }}
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <div class="text-muted small">Slideshow Content</div>
                            <div class="fw-bold {{ $stats['system_health']['has_slideshows'] ? 'text-success' : 'text-muted' }}">
                                {{ $stats['system_health']['has_slideshows'] ? 'Available' : 'None' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Gradient Cards */
    .gradient-card-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .gradient-card-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .gradient-card-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .gradient-card-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    .gradient-card-5 { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
    .gradient-card-6 { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); color: #333 !important; }

    /* Timeline Styles */
    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 20px;
        padding-left: 40px;
    }

    .timeline-item:not(:last-child):before {
        content: '';
        position: absolute;
        left: 15px;
        top: 30px;
        width: 2px;
        height: calc(100% + 10px);
        background: #e9ecef;
    }

    .timeline-marker {
        position: absolute;
        left: 0;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .timeline-content {
        background: #f8f9fa;
        padding: 12px 16px;
        border-radius: 8px;
        border-left: 3px solid #007bff;
    }

    /* Action Buttons */
    .btn-action {
        padding: 12px 16px;
        border: 1px solid #e9ecef;
        /* background: #fff; */
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .action-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    /* Storage Items */
    .storage-item .storage-icon {
        width: 35px;
        height: 35px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* System Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .info-item {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border-left: 3px solid #007bff;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .timeline {
            padding-left: 20px;
        }
        
        .timeline-item {
            padding-left: 30px;
        }
        
        .timeline-marker {
            width: 24px;
            height: 24px;
        }
    }

    /* Alert Customizations */
    .alert-sm {
        padding: 8px 12px;
        font-size: 0.875rem;
    }

    /* Card Hover Effects */
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
        transition: all 0.3s ease;
    }

    /* Badge Improvements */
    .badge {
        font-size: 0.75rem;
        padding: 4px 8px;
    }
</style>
@endpush