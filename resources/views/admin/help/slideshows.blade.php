@extends('layouts.admin')

@section('title', 'Slideshows Management Guide')
@section('page-title', 'Slideshows Management Guide')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('admin.help.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Help Center
                </a>
                <a href="{{ route('admin.slideshows.index') }}" class="btn btn-warning">
                    <i class="fas fa-images me-2"></i>Go to Slideshows
                </a>
            </div>

            <!-- Introduction -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-images me-2"></i>
                        Slideshows Management Overview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>What are Slideshows?</h6>
                            <p>Slideshows are full-screen images or videos that appear periodically over your main display, capturing viewer attention for important announcements, highlights, or promotional content.</p>
                            
                            <h6>Perfect Uses:</h6>
                            <ul>
                                <li><strong>Important Announcements:</strong> Emergency alerts, critical updates</li>
                                <li><strong>Event Promotion:</strong> Upcoming conferences, seminars, workshops</li>
                                <li><strong>Research Highlights:</strong> Latest discoveries, publications, achievements</li>
                                <li><strong>Institutional Branding:</strong> Logo displays, mission statements</li>
                                <li><strong>Visual Instructions:</strong> Safety guidelines, procedures</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-warning">
                                <h6><i class="fas fa-tv me-2"></i>Display Behavior</h6>
                                <p class="mb-1">Slideshows appear:</p>
                                <ul class="mb-0 small">
                                    <li>Full-screen overlay</li>
                                    <li>Automatic timing (5-10 seconds each)</li>
                                    <li>Periodic interruption of main display</li>
                                    <li>Supports images and videos</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- File Types and Requirements -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-image me-2"></i>
                        Supported File Types & Requirements
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-image me-2 text-primary"></i>Image Files</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Format</th>
                                            <th>Extension</th>
                                            <th>Best For</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-success">
                                            <td>JPEG</td>
                                            <td>.jpg, .jpeg</td>
                                            <td>Photos, complex images</td>
                                        </tr>
                                        <tr class="table-success">
                                            <td>PNG</td>
                                            <td>.png</td>
                                            <td>Graphics, transparent backgrounds</td>
                                        </tr>
                                        <tr>
                                            <td>GIF</td>
                                            <td>.gif</td>
                                            <td>Simple animations</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="alert alert-info alert-sm">
                                <strong>Image Specs:</strong>
                                <ul class="mb-0 small">
                                    <li>Maximum size: 10 MB</li>
                                    <li>Recommended: 1920x1080 pixels</li>
                                    <li>Display time: 5 seconds</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-video me-2 text-danger"></i>Video Files</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Format</th>
                                            <th>Extension</th>
                                            <th>Best For</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-success">
                                            <td>MP4</td>
                                            <td>.mp4</td>
                                            <td>Most compatible</td>
                                        </tr>
                                        <tr>
                                            <td>AVI</td>
                                            <td>.avi</td>
                                            <td>High quality</td>
                                        </tr>
                                        <tr>
                                            <td>MOV</td>
                                            <td>.mov</td>
                                            <td>Apple format</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="alert alert-warning alert-sm">
                                <strong>Video Specs:</strong>
                                <ul class="mb-0 small">
                                    <li>Maximum size: 100 MB</li>
                                    <li>Duration: 10-30 seconds recommended</li>
                                    <li>Plays once, then moves to next slide</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How to Add Slideshow Content -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-plus me-2"></i>
                        How to Add Slideshow Content
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <h6>Upload Process:</h6>
                            <div class="timeline">
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-marker bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">1</div>
                                    <div>
                                        <strong>Navigate to Slideshows</strong>
                                        <p class="mb-1 small text-muted">Click "Slideshows" in the left sidebar menu</p>
                                    </div>
                                </div>
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-marker bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">2</div>
                                    <div>
                                        <strong>Click "Add New Slideshow"</strong>
                                        <p class="mb-1 small text-muted">Orange button at the top of the page</p>
                                    </div>
                                </div>
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-marker bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">3</div>
                                    <div>
                                        <strong>Enter Descriptive Title</strong>
                                        <p class="mb-1 small text-muted">Choose a name that helps you identify the content later</p>
                                    </div>
                                </div>
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-marker bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">4</div>
                                    <div>
                                        <strong>Select Your File</strong>
                                        <p class="mb-1 small text-muted">Click "Choose File" and pick image or video from your computer</p>
                                    </div>
                                </div>
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-marker bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;">5</div>
                                    <div>
                                        <strong>Set Display Order (Optional)</strong>
                                        <p class="mb-1 small text-muted">Lower numbers appear first in the slideshow sequence</p>
                                    </div>
                                </div>
                                <div class="timeline-item d-flex">
                                    <div class="timeline-marker bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; min-width: 30px;"><i class="fas fa-upload"></i></div>
                                    <div>
                                        <strong>Upload & Save</strong>
                                        <p class="mb-1 small text-muted">Click "Upload Slideshow" - it will appear in the next slideshow cycle!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-clock me-2"></i>Timing Information</h6>
                                </div>
                                <div class="card-body">
                                    <p class="small"><strong>How Slideshow Timing Works:</strong></p>
                                    <ul class="small mb-3">
                                        <li><strong>Images:</strong> Display for 5 seconds each</li>
                                        <li><strong>Videos:</strong> Play once at normal speed</li>
                                        <li><strong>Cycle:</strong> Slideshow runs every few minutes</li>
                                        <li><strong>Loop:</strong> Returns to first slide after last one</li>
                                    </ul>
                                    
                                    <div class="alert alert-info alert-sm mb-0">
                                        <strong>Pro Tip:</strong> Test timing with a few slides first before adding many items.
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-success mt-3">
                                <h6><i class="fas fa-lightbulb me-2"></i>Content Tips</h6>
                                <ul class="mb-0 small">
                                    <li>Use high-contrast text on images</li>
                                    <li>Keep text large and readable</li>
                                    <li>Avoid cluttered designs</li>
                                    <li>Test visibility from viewing distance</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Managing Slideshow Content -->
            <div class="card mb-4">
                <div class="card-header" style="background: #6f42c1; color: white;">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Managing Your Slideshow Content
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-edit text-warning me-2"></i>Editing Slideshow Items</h6>
                            <p>You can modify slideshow information without re-uploading:</p>
                            
                            <div class="card border-warning">
                                <div class="card-body">
                                    <h6>Editable Fields:</h6>
                                    <ul class="mb-3">
                                        <li><strong>Title:</strong> Change the descriptive name</li>
                                        <li><strong>Sort Order:</strong> Adjust display sequence</li>
                                    </ul>
                                    
                                    <h6>Edit Process:</h6>
                                    <ol class="mb-0">
                                        <li>Find item in slideshow list</li>
                                        <li>Click yellow "Edit" button</li>
                                        <li>Make changes</li>
                                        <li>Click "Update Slideshow"</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-sort-numeric-down text-info me-2"></i>Managing Display Order</h6>
                            <p>Control the sequence in which your slides appear:</p>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sort Order</th>
                                            <th>Display Position</th>
                                            <th>Use Case</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-danger">
                                            <td>1-5</td>
                                            <td>First to show</td>
                                            <td>Urgent alerts</td>
                                        </tr>
                                        <tr class="table-warning">
                                            <td>10-20</td>
                                            <td>High priority</td>
                                            <td>Important news</td>
                                        </tr>
                                        <tr class="table-info">
                                            <td>30-50</td>
                                            <td>Normal priority</td>
                                            <td>Regular content</td>
                                        </tr>
                                        <tr class="table-light">
                                            <td>No number</td>
                                            <td>End of sequence</td>
                                            <td>General info</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deleting Slideshow Content -->
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-trash me-2"></i>
                        Deleting Slideshow Content
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Safe Deletion Process:</h6>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <strong>Step 1: Identify Content</strong>
                                    <p class="mb-0 small text-muted">Locate the slideshow item you want to remove</p>
                                </div>
                                <div class="list-group-item">
                                    <strong>Step 2: Click Delete</strong>
                                    <p class="mb-0 small text-muted">Click the red "Delete" button next to the item</p>
                                </div>
                                <div class="list-group-item">
                                    <strong>Step 3: Password Verification</strong>
                                    <p class="mb-0 small text-muted">Enter your admin password in the popup</p>
                                </div>
                                <div class="list-group-item">
                                    <strong>Step 4: Confirm Removal</strong>
                                    <p class="mb-0 small text-muted">Click "Yes, Delete" to permanently remove</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-danger">
                                <h6><i class="fas fa-exclamation-triangle me-2"></i>Deletion Warnings</h6>
                                <ul class="mb-3">
                                    <li><strong>Permanent:</strong> Cannot be undone</li>
                                    <li><strong>Immediate:</strong> Stops appearing in slideshow right away</li>
                                    <li><strong>File Removal:</strong> Original file is deleted from server</li>
                                </ul>
                                
                                <h6><i class="fas fa-shield-alt me-2"></i>Security Feature</h6>
                                <p class="mb-0 small">Password requirement prevents accidental deletions and ensures only authorized users can remove content.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Best Practices -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-star me-2"></i>
                        Slideshow Best Practices
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-palette text-info me-2"></i>Design Guidelines</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>High Contrast:</strong> Use dark text on light backgrounds or vice versa</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Large Text:</strong> Minimum 48pt font size for visibility</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Simple Layout:</strong> Avoid cluttered designs</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Readable Colors:</strong> Test from viewing distance</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Professional Look:</strong> Use institutional colors and fonts</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-clock text-warning me-2"></i>Content Strategy</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i><strong>Timely Content:</strong> Remove outdated information regularly</li>
                                <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i><strong>Balanced Mix:</strong> Combine images and videos for variety</li>
                                <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i><strong>Priority Order:</strong> Put urgent content first</li>
                                <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i><strong>Regular Updates:</strong> Refresh content weekly</li>
                                <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i><strong>Test Everything:</strong> Preview before going live</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-thumbs-up me-2 text-success"></i>Good Examples</h6>
                                <ul class="mb-0 small">
                                    <li>Emergency weather alerts</li>
                                    <li>Conference announcements with dates</li>
                                    <li>Research achievement highlights</li>
                                    <li>Safety procedure reminders</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-thumbs-down me-2 text-danger"></i>Avoid These</h6>
                                <ul class="mb-0 small">
                                    <li>Blurry or low-resolution images</li>
                                    <li>Text too small to read</li>
                                    <li>Outdated event information</li>
                                    <li>Personal or inappropriate content</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Troubleshooting -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-wrench me-2"></i>
                        Troubleshooting Slideshow Issues
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="slideshowAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#slideshow1">
                                    Slideshow doesn't appear on display
                                </button>
                            </h2>
                            <div id="slideshow1" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Troubleshooting steps:</strong>
                                    <ol>
                                        <li>Check if slideshow items are listed in the admin panel</li>
                                        <li>Verify files uploaded successfully (check file sizes)</li>
                                        <li>Wait for next slideshow cycle (may take a few minutes)</li>
                                        <li>Refresh the display browser if needed</li>
                                        <li>Check if other slideshow content is working</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#slideshow2">
                                    Image appears blurry or pixelated
                                </button>
                            </h2>
                            <div id="slideshow2" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Image quality solutions:</strong>
                                    <ul>
                                        <li>Use higher resolution images (1920x1080 recommended)</li>
                                        <li>Avoid enlarging small images</li>
                                        <li>Save images in high quality format (PNG for graphics, JPEG for photos)</li>
                                        <li>Check original image quality before uploading</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#slideshow3">
                                    Video doesn't play in slideshow
                                </button>
                            </h2>
                            <div id="slideshow3" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Video playback issues:</strong>
                                    <ul>
                                        <li>Ensure video is in supported format (MP4 recommended)</li>
                                        <li>Check if video file uploaded completely</li>
                                        <li>Verify video plays correctly on your computer first</li>
                                        <li>Try re-uploading in MP4 format if using other formats</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#slideshow4">
                                    Upload fails or takes too long
                                </button>
                            </h2>
                            <div id="slideshow4" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Upload optimization:</strong>
                                    <ul>
                                        <li>Compress large files before uploading (use online tools or image editors)</li>
                                        <li>Ensure stable internet connection</li>
                                        <li>Try uploading during off-peak hours</li>
                                        <li>Break large uploads into smaller files if possible</li>
                                        <li>Clear browser cache and try again</li>
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