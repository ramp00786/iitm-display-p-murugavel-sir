@extends('layouts.admin')

@section('title', 'Videos Management Guide')
@section('page-title', 'Videos Management Guide')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('admin.help.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Help Center
                </a>
                <a href="{{ route('admin.videos.index') }}" class="btn btn-danger">
                    <i class="fas fa-video me-2"></i>Go to Videos
                </a>
            </div>

            <!-- Introduction -->
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-video me-2"></i>
                        Videos Management Overview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>What are Background Videos?</h6>
                            <p>Background videos play continuously in the left section of your display screen, providing visual appeal and context to your content. These videos run on a loop and serve as the backdrop for your display system.</p>
                            
                            <h6>Perfect for:</h6>
                            <ul>
                                <li><strong>Institute Highlights:</strong> Showcase your facilities, research, and achievements</li>
                                <li><strong>Nature Scenes:</strong> Weather-related visuals, landscapes, time-lapse footage</li>
                                <li><strong>Informational Content:</strong> Visual explanations of concepts or processes</li>
                                <li><strong>Branding:</strong> Logo animations and institutional identity content</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-display me-2"></i>On the Display</h6>
                                <p class="mb-1">Videos appear as:</p>
                                <ul class="mb-0 small">
                                    <li>Continuous background playback</li>
                                    <li>Left side of display screen</li>
                                    <li>Automatic looping</li>
                                    <li>Muted audio (visual only)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- File Requirements -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-video me-2"></i>
                        Video File Requirements
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-check-circle text-success me-2"></i>Supported Formats</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Format</th>
                                            <th>Extension</th>
                                            <th>Recommended</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-success">
                                            <td>MP4</td>
                                            <td>.mp4</td>
                                            <td><i class="fas fa-star text-warning"></i> Best</td>
                                        </tr>
                                        <tr>
                                            <td>AVI</td>
                                            <td>.avi</td>
                                            <td><i class="fas fa-check text-success"></i> Good</td>
                                        </tr>
                                        <tr>
                                            <td>MOV</td>
                                            <td>.mov</td>
                                            <td><i class="fas fa-check text-success"></i> Good</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-cogs me-2"></i>Technical Specifications</h6>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <strong>Maximum File Size:</strong> 100 MB
                                    <small class="text-muted d-block">Larger files may cause slow loading</small>
                                </div>
                                <div class="list-group-item">
                                    <strong>Recommended Resolution:</strong> 1920x1080 (Full HD)
                                    <small class="text-muted d-block">For best display quality</small>
                                </div>
                                <div class="list-group-item">
                                    <strong>Frame Rate:</strong> 30 fps or lower
                                    <small class="text-muted d-block">Higher rates increase file size</small>
                                </div>
                                <div class="list-group-item">
                                    <strong>Duration:</strong> 30 seconds to 5 minutes
                                    <small class="text-muted d-block">Optimal for looping content</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How to Upload Videos -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-upload me-2"></i>
                        How to Upload Videos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Upload Process:</h6>
                            <div class="list-group">
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">1</span>
                                    <div>
                                        <strong>Go to Videos Section</strong>
                                        <p class="mb-0 small text-muted">Click "Videos" in the left sidebar</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">2</span>
                                    <div>
                                        <strong>Click "Add New Video"</strong>
                                        <p class="mb-0 small text-muted">Red button at the top of the page</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">3</span>
                                    <div>
                                        <strong>Enter Video Title</strong>
                                        <p class="mb-0 small text-muted">Give it a descriptive name for easy identification</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">4</span>
                                    <div>
                                        <strong>Select Video File</strong>
                                        <p class="mb-0 small text-muted">Click "Choose File" and select your video</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">5</span>
                                    <div>
                                        <strong>Set Display Order</strong>
                                        <p class="mb-0 small text-muted">Lower numbers play first (optional)</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-success rounded-pill me-3 mt-1">6</span>
                                    <div>
                                        <strong>Upload & Save</strong>
                                        <p class="mb-0 small text-muted">Click "Upload Video" and wait for completion</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Upload Process Details</h6>
                                </div>
                                <div class="card-body">
                                    <h6>What Happens During Upload:</h6>
                                    <ol class="small">
                                        <li>File is uploaded to server</li>
                                        <li>System checks file format and size</li>
                                        <li>Video is processed and stored</li>
                                        <li>Thumbnail is generated (if supported)</li>
                                        <li>Video becomes available on display</li>
                                    </ol>
                                    
                                    <div class="alert alert-warning alert-sm mt-3">
                                        <strong>Be Patient:</strong> Large files may take several minutes to upload. Don't close the browser!
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-success mt-3">
                                <h6><i class="fas fa-lightbulb me-2"></i>Pro Tips</h6>
                                <ul class="mb-0 small">
                                    <li>Test videos locally before uploading</li>
                                    <li>Use descriptive, unique titles</li>
                                    <li>Compress large files before uploading</li>
                                    <li>Ensure stable internet connection</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Managing Videos -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tasks me-2"></i>
                        Managing Your Videos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-edit text-warning me-2"></i>Editing Videos</h6>
                            <p>You can update video information without re-uploading:</p>
                            <ol>
                                <li>Find your video in the list</li>
                                <li>Click the yellow "Edit" button</li>
                                <li>Change the title or sort order</li>
                                <li>Click "Update Video" to save</li>
                            </ol>
                            
                            <div class="alert alert-info alert-sm">
                                <strong>Note:</strong> You cannot replace the video file through editing. To change the actual video, delete the old one and upload a new one.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-sort text-primary me-2"></i>Controlling Play Order</h6>
                            <p>Videos play in order based on their sort order number:</p>
                            
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sort Order</th>
                                            <th>When It Plays</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>First video</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Second video</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Third video</td>
                                        </tr>
                                        <tr>
                                            <td>No number</td>
                                            <td>Added to end</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deleting Videos -->
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-trash me-2"></i>
                        How to Delete Videos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Deletion Process:</h6>
                            <ol>
                                <li><strong>Locate Video:</strong> Find the video you want to remove</li>
                                <li><strong>Click Delete:</strong> Click the red "Delete" button</li>
                                <li><strong>Enter Password:</strong> Type your admin password for security</li>
                                <li><strong>Confirm:</strong> Click "Yes, Delete" to permanently remove</li>
                            </ol>
                            
                            <div class="alert alert-warning">
                                <h6><i class="fas fa-exclamation-triangle me-2"></i>Before Deleting</h6>
                                <ul class="mb-0">
                                    <li>Make sure it's the right video</li>
                                    <li>Check if you have a backup copy</li>
                                    <li>Consider if you might need it later</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-danger">
                                <h6><i class="fas fa-exclamation-circle me-2"></i>Important Warnings</h6>
                                <ul>
                                    <li><strong>Permanent Deletion:</strong> Once deleted, videos cannot be recovered</li>
                                    <li><strong>Display Impact:</strong> Video will immediately stop appearing on display</li>
                                    <li><strong>File Removal:</strong> The actual video file is deleted from the server</li>
                                </ul>
                            </div>
                            
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6><i class="fas fa-undo me-2 text-info"></i>Alternative to Deletion</h6>
                                    <p class="small mb-0">Instead of deleting, consider setting a very high sort order number (like 999) to move the video to the end of the playlist.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Best Practices -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-star me-2"></i>
                        Best Practices for Video Management
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-check-circle text-success me-2"></i>Content Guidelines</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>High Quality:</strong> Use HD resolution (1920x1080) when possible</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Appropriate Length:</strong> 30 seconds to 3 minutes works best</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Professional Content:</strong> Ensure videos are appropriate for public display</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Loop-Friendly:</strong> Choose content that looks good when repeated</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Silent Content:</strong> Remember audio won't be played</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-cog me-2 text-primary"></i>Technical Tips</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-compress me-2 text-info"></i><strong>File Size:</strong> Compress videos to reduce upload time</li>
                                <li class="mb-2"><i class="fas fa-file-video me-2 text-info"></i><strong>Format:</strong> MP4 provides best compatibility</li>
                                <li class="mb-2"><i class="fas fa-clock me-2 text-info"></i><strong>Frame Rate:</strong> 30fps is usually sufficient</li>
                                <li class="mb-2"><i class="fas fa-palette me-2 text-info"></i><strong>Colors:</strong> Use vibrant, contrasting colors for visibility</li>
                                <li class="mb-2"><i class="fas fa-save me-2 text-info"></i><strong>Backup:</strong> Keep original files as backup</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Troubleshooting -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-wrench me-2"></i>
                        Troubleshooting Video Issues
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="videoAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#video1">
                                    Video upload fails or gets stuck
                                </button>
                            </h2>
                            <div id="video1" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Common causes and solutions:</strong>
                                    <ul>
                                        <li><strong>File too large:</strong> Compress the video or use a smaller file (under 100MB)</li>
                                        <li><strong>Slow internet:</strong> Wait for better connection or try during off-peak hours</li>
                                        <li><strong>Unsupported format:</strong> Convert to MP4 format</li>
                                        <li><strong>Browser timeout:</strong> Refresh page and try again</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#video2">
                                    Video doesn't play on the display
                                </button>
                            </h2>
                            <div id="video2" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Troubleshooting steps:</strong>
                                    <ol>
                                        <li>Check if video appears in the videos list</li>
                                        <li>Verify the video uploaded completely (check file size)</li>
                                        <li>Try refreshing the display screen</li>
                                        <li>Check if other videos play correctly</li>
                                        <li>Ensure sort order is set appropriately</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#video3">
                                    Video quality looks poor on display
                                </button>
                            </h2>
                            <div id="video3" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Quality improvement tips:</strong>
                                    <ul>
                                        <li>Use higher resolution source video (1920x1080 recommended)</li>
                                        <li>Avoid over-compression when preparing the file</li>
                                        <li>Ensure original video has good quality</li>
                                        <li>Check display screen resolution settings</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#video4">
                                    Cannot delete video - password not working
                                </button>
                            </h2>
                            <div id="video4" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Password verification:</strong>
                                    <ul>
                                        <li>Use the same password you use to log into the admin panel</li>
                                        <li>Make sure Caps Lock is not on</li>
                                        <li>Try typing the password in a text editor first to verify</li>
                                        <li>If still not working, contact your system administrator</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush