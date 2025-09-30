@extends('layouts.admin')

@section('title', 'User Guide & Help')
@section('page-title', 'User Guide & Help Documentation')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Welcome Section -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-book me-2"></i>
                        Welcome to IITM Display Portal Admin Guide
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>About This System</h6>
                            <p>The IITM Display Portal is a comprehensive digital display management system designed for the Indian Institute of Tropical Meteorology. This system allows you to manage various types of content that appear on the main display screen including:</p>
                            <ul>
                                <li><strong>Videos</strong> - Background videos that play continuously</li>
                                <li><strong>Slideshows</strong> - Full-screen images and videos shown periodically</li>
                                <li><strong>News Tickers</strong> - Scrolling text messages</li>
                                <li><strong>Temperature Data</strong> - Weather information displays</li>
                                <li><strong>Meteorological Charts</strong> - Interactive data visualization</li>
                            </ul>
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-lightbulb me-2"></i>
                                <strong>Tip:</strong> All changes you make in the admin panel will automatically appear on the main display screen. No technical knowledge required!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6><i class="fas fa-external-link-alt me-2"></i>Quick Links</h6>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('home') }}" target="_blank" class="btn btn-success btn-sm">
                                            <i class="fas fa-tv me-2"></i>View Live Display
                                        </a>
                                        <a href="#getting-started" class="btn btn-primary btn-sm">
                                            <i class="fas fa-play me-2"></i>Getting Started
                                        </a>
                                        <a href="#modules" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-th-large me-2"></i>Module Guides
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Getting Started -->
            <div class="card mb-4" id="getting-started">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-play me-2"></i>
                        Getting Started - First Steps
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h6>Step-by-Step Setup Process</h6>
                            <div class="timeline-steps">
                                <div class="step-item d-flex mb-3">
                                    <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;">1</div>
                                    <div>
                                        <strong>Login to Admin Panel</strong>
                                        <p class="mb-1">Use your provided username and password to access the admin area.</p>
                                    </div>
                                </div>
                                <div class="step-item d-flex mb-3">
                                    <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;">2</div>
                                    <div>
                                        <strong>Set Up Categories (Optional)</strong>
                                        <p class="mb-1">Create categories like "News", "Temperature", "Announcements" to organize your content.</p>
                                    </div>
                                </div>
                                <div class="step-item d-flex mb-3">
                                    <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;">3</div>
                                    <div>
                                        <strong>Upload Your First Video</strong>
                                        <p class="mb-1">Add a background video that will play continuously on the display.</p>
                                    </div>
                                </div>
                                <div class="step-item d-flex mb-3">
                                    <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;">4</div>
                                    <div>
                                        <strong>Add News Items</strong>
                                        <p class="mb-1">Create news entries that will scroll at the bottom of the screen.</p>
                                    </div>
                                </div>
                                <div class="step-item d-flex mb-3">
                                    <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;">5</div>
                                    <div>
                                        <strong>Create Meteorological Displays</strong>
                                        <p class="mb-1">Set up weather stations and charts to display real-time data.</p>
                                    </div>
                                </div>
                                <div class="step-item d-flex">
                                    <div class="step-number bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px;"><i class="fas fa-check"></i></div>
                                    <div>
                                        <strong>View Your Display</strong>
                                        <p class="mb-1">Click "View Display" to see your content live on the main screen!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Module Guides -->
            <div class="card mb-4" id="modules">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-th-large me-2"></i>
                        Module Guides - Detailed Instructions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Categories Module -->
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 border-primary">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-tags fa-3x text-primary"></i>
                                    </div>
                                    <h6 class="card-title">Categories</h6>
                                    <p class="card-text small">Organize your content into categories like News, Temperature, Announcements</p>
                                    <a href="{{ route('admin.help.categories') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-book me-2"></i>View Guide
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- News Module -->
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 border-success">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-newspaper fa-3x text-success"></i>
                                    </div>
                                    <h6 class="card-title">News Management</h6>
                                    <p class="card-text small">Create and manage scrolling news tickers and announcements</p>
                                    <a href="{{ route('admin.help.news') }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-book me-2"></i>View Guide
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Videos Module -->
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 border-danger">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-video fa-3x text-danger"></i>
                                    </div>
                                    <h6 class="card-title">Videos</h6>
                                    <p class="card-text small">Upload and manage background videos for continuous playback</p>
                                    <a href="{{ route('admin.help.videos') }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-book me-2"></i>View Guide
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Slideshows Module -->
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 border-warning">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-images fa-3x text-warning"></i>
                                    </div>
                                    <h6 class="card-title">Slideshows</h6>
                                    <p class="card-text small">Manage full-screen images and videos shown periodically</p>
                                    <a href="{{ route('admin.help.slideshows') }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-book me-2"></i>View Guide
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Meteorological Module -->
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 border-info">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-cloud-sun fa-3x text-info"></i>
                                    </div>
                                    <h6 class="card-title">Meteorological Data</h6>
                                    <p class="card-text small">Create weather stations and interactive charts</p>
                                    <a href="{{ route('admin.help.meteorological') }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-book me-2"></i>View Guide
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Module -->
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 border-secondary">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-user fa-3x text-secondary"></i>
                                    </div>
                                    <h6 class="card-title">Profile Settings</h6>
                                    <p class="card-text small">Manage your account settings and change password</p>
                                    <a href="{{ route('admin.help.profile') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-book me-2"></i>View Guide
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Tips -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-lightbulb me-2"></i>
                        Quick Tips & Best Practices
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-check-circle text-success me-2"></i>Do's</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Use high-quality images and videos (HD recommended)</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Keep news titles concise and clear</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Test your content on the live display regularly</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Use appropriate file formats (MP4 for videos, JPG/PNG for images)</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Organize content using categories</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-times-circle text-danger me-2"></i>Don'ts</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Don't upload extremely large files (over 100MB)</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Don't use copyrighted content without permission</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Don't create too many categories (keep it simple)</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Don't forget to set proper sort orders</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Don't leave content with empty or unclear titles</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support Information -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-question-circle me-2"></i>
                        Need Help?
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p>If you need additional assistance or encounter any issues:</p>
                            <ul>
                                <li>Contact your system administrator</li>
                                <li>Check the individual module guides for specific instructions</li>
                                <li>Use the "View Display" link to see how your changes appear</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-info mb-0">
                                <strong>Remember:</strong><br>
                                Changes appear on the display immediately after saving!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection