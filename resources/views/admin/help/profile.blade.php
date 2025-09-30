@extends('layouts.admin')

@section('title', 'Profile Management Guide')
@section('page-title', 'Profile Management Guide')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('admin.help.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Help Center
                </a>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-secondary">
                    <i class="fas fa-user me-2"></i>Go to Profile
                </a>
            </div>

            <!-- Introduction -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user me-2"></i>
                        Profile Management Overview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>What is Profile Management?</h6>
                            <p>The Profile Management section allows you to manage your personal admin account settings, including updating your personal information and changing your login password for security purposes.</p>
                            
                            <h6>What You Can Manage:</h6>
                            <ul>
                                <li><strong>Personal Information:</strong> Update your name and contact details</li>
                                <li><strong>Login Credentials:</strong> Change your email address and password</li>
                                <li><strong>Account Security:</strong> Strengthen password protection</li>
                                <li><strong>Profile Display:</strong> Update how your name appears in the system</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-shield-alt me-2"></i>Security Note</h6>
                                <p class="mb-1">Important reminders:</p>
                                <ul class="mb-0 small">
                                    <li>Keep your password secure</li>
                                    <li>Use a strong, unique password</li>
                                    <li>Update password regularly</li>
                                    <li>Don't share login credentials</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Updating Personal Information -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Updating Personal Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>How to Update Your Profile:</h6>
                            <div class="list-group">
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">1</span>
                                    <div>
                                        <strong>Navigate to Profile</strong>
                                        <p class="mb-0 small text-muted">Click "Profile" in the left sidebar menu</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">2</span>
                                    <div>
                                        <strong>Review Current Information</strong>
                                        <p class="mb-0 small text-muted">Check your current name and email address</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">3</span>
                                    <div>
                                        <strong>Make Changes</strong>
                                        <p class="mb-0 small text-muted">Update any information that needs to be changed</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-start">
                                    <span class="badge bg-success rounded-pill me-3 mt-1">4</span>
                                    <div>
                                        <strong>Save Changes</strong>
                                        <p class="mb-0 small text-muted">Click "Save" to update your profile</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Profile Fields</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Full Name</strong> <span class="badge bg-danger">Required</span>
                                        <p class="small mb-1 text-muted">Your display name in the admin system</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Email Address</strong> <span class="badge bg-danger">Required</span>
                                        <p class="small mb-1 text-muted">Used for login and system communications</p>
                                    </div>
                                    <div class="alert alert-warning alert-sm">
                                        <strong>Note:</strong> Email changes take effect immediately. Use the new email for future logins.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Changing Password -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-key me-2"></i>
                        Changing Your Password
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Password Change Process:</h6>
                            <ol>
                                <li class="mb-2">
                                    <strong>Current Password:</strong> Enter your existing password to verify identity
                                </li>
                                <li class="mb-2">
                                    <strong>New Password:</strong> Type your desired new password
                                </li>
                                <li class="mb-2">
                                    <strong>Confirm Password:</strong> Retype the new password to ensure accuracy
                                </li>
                                <li class="mb-2">
                                    <strong>Save Changes:</strong> Click "Update Password" to activate the new password
                                </li>
                            </ol>

                            <div class="alert alert-info">
                                <h6><i class="fas fa-lightbulb me-2"></i>Password Tips</h6>
                                <ul class="mb-0 small">
                                    <li>Write down your new password in a secure place</li>
                                    <li>Test the new password immediately after changing</li>
                                    <li>Change passwords every 3-6 months for security</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0"><i class="fas fa-shield-alt me-2"></i>Strong Password Guidelines</h6>
                                </div>
                                <div class="card-body">
                                    <h6>Requirements:</h6>
                                    <ul class="mb-3">
                                        <li>At least 8 characters long</li>
                                        <li>Mix of uppercase and lowercase letters</li>
                                        <li>Include numbers (0-9)</li>
                                        <li>Add special characters (!@#$%)</li>
                                    </ul>
                                    
                                    <h6>Good Examples:</h6>
                                    <div class="bg-light p-2 rounded mb-3">
                                        <code class="text-success">WeatherData2024!</code><br>
                                        <code class="text-success">IitmAdmin#789</code><br>
                                        <code class="text-success">MySecure$Pass2024</code>
                                    </div>
                                    
                                    <h6>Avoid These:</h6>
                                    <div class="bg-light p-2 rounded">
                                        <code class="text-danger">password123</code><br>
                                        <code class="text-danger">admin</code><br>
                                        <code class="text-danger">123456</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Security Best Practices -->
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-lock me-2"></i>
                        Account Security Best Practices
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-check-circle text-success me-2"></i>Security Do's</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Regular Updates:</strong> Change password every 3-6 months</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Strong Passwords:</strong> Use complex passwords with mixed characters</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Secure Storage:</strong> Keep login details in a safe place</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Logout Properly:</strong> Always click "Logout" when finished</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i><strong>Monitor Access:</strong> Report any suspicious activity</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-times-circle text-danger me-2"></i>Security Don'ts</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i><strong>Don't Share:</strong> Never give your password to others</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i><strong>Don't Reuse:</strong> Avoid using the same password everywhere</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i><strong>Don't Write Down:</strong> Avoid writing passwords on sticky notes</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i><strong>Don't Use Public WiFi:</strong> Avoid admin access on public networks</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i><strong>Don't Stay Logged In:</strong> Log out from shared computers</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning mt-3">
                        <div class="row">
                            <div class="col-md-8">
                                <h6><i class="fas fa-exclamation-triangle me-2"></i>If You Suspect Unauthorized Access</h6>
                                <ol class="mb-0">
                                    <li>Change your password immediately</li>
                                    <li>Review recent changes made in the system</li>
                                    <li>Contact your system administrator</li>
                                    <li>Monitor the system for any unusual activity</li>
                                </ol>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <i class="fas fa-shield-alt fa-3x text-warning"></i>
                                    <p class="mb-0 small mt-2"><strong>Security First!</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Troubleshooting Login Issues -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-question-circle me-2"></i>
                        Troubleshooting Login Issues
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Common Login Problems:</h6>
                            
                            <div class="card border-warning mb-3">
                                <div class="card-header bg-warning text-dark">
                                    <strong><i class="fas fa-exclamation-triangle me-2"></i>Forgot Password</strong>
                                </div>
                                <div class="card-body">
                                    <p class="small">If you can't remember your password:</p>
                                    <ul class="small mb-0">
                                        <li>Try common passwords you typically use</li>
                                        <li>Check if Caps Lock is on</li>
                                        <li>Contact your system administrator for reset</li>
                                        <li>Use the password recovery feature if available</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card border-danger">
                                <div class="card-header bg-danger text-white">
                                    <strong><i class="fas fa-ban me-2"></i>Account Locked</strong>
                                </div>
                                <div class="card-body">
                                    <p class="small">If login attempts are blocked:</p>
                                    <ul class="small mb-0">
                                        <li>Wait 15-30 minutes before trying again</li>
                                        <li>Clear your browser cache and cookies</li>
                                        <li>Try using a different browser</li>
                                        <li>Contact administrator if problem persists</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Prevention Tips:</h6>
                            
                            <div class="list-group">
                                <div class="list-group-item">
                                    <strong><i class="fas fa-bookmark me-2 text-primary"></i>Save Credentials Securely</strong>
                                    <p class="mb-0 small text-muted">Use a password manager or secure note-taking app</p>
                                </div>
                                <div class="list-group-item">
                                    <strong><i class="fas fa-test me-2 text-success"></i>Test New Passwords</strong>
                                    <p class="mb-0 small text-muted">Immediately after changing, test login with new password</p>
                                </div>
                                <div class="list-group-item">
                                    <strong><i class="fas fa-backup me-2 text-info"></i>Keep Recovery Options</strong>
                                    <p class="mb-0 small text-muted">Ensure you have administrator contact information</p>
                                </div>
                                <div class="list-group-item">
                                    <strong><i class="fas fa-browser me-2 text-warning"></i>Use Reliable Browser</strong>
                                    <p class="mb-0 small text-muted">Chrome or Firefox recommended for best compatibility</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Maintenance -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tools me-2"></i>
                        Profile Maintenance Schedule
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Recommended Maintenance Tasks:</h6>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Task</th>
                                            <th>Frequency</th>
                                            <th>Purpose</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Review Profile Info</td>
                                            <td>Monthly</td>
                                            <td>Keep information current</td>
                                        </tr>
                                        <tr class="table-warning">
                                            <td>Change Password</td>
                                            <td>Every 3-6 months</td>
                                            <td>Maintain security</td>
                                        </tr>
                                        <tr>
                                            <td>Check Email Access</td>
                                            <td>Monthly</td>
                                            <td>Ensure communications work</td>
                                        </tr>
                                        <tr>
                                            <td>Test Login</td>
                                            <td>After any changes</td>
                                            <td>Verify access works</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Quick Checklist</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check1">
                                        <label class="form-check-label small" for="check1">
                                            Profile information up to date
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check2">
                                        <label class="form-check-label small" for="check2">
                                            Password is strong and recent
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check3">
                                        <label class="form-check-label small" for="check3">
                                            Email address is accessible
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check4">
                                        <label class="form-check-label small" for="check4">
                                            Login credentials are secure
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check5">
                                        <label class="form-check-label small" for="check5">
                                            Administrator contact available
                                        </label>
                                    </div>
                                </div>
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
                        Troubleshooting Profile Issues
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="profileAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profile1">
                                    Cannot update profile information
                                </button>
                            </h2>
                            <div id="profile1" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Possible solutions:</strong>
                                    <ul>
                                        <li>Ensure all required fields are filled out</li>
                                        <li>Check internet connection is stable</li>
                                        <li>Try refreshing the page and entering information again</li>
                                        <li>Clear browser cache and try again</li>
                                        <li>Contact administrator if problem persists</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profile2">
                                    Password change not working
                                </button>
                            </h2>
                            <div id="profile2" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Password change troubleshooting:</strong>
                                    <ul>
                                        <li>Verify current password is entered correctly</li>
                                        <li>Ensure new password meets minimum requirements</li>
                                        <li>Check that both new password fields match exactly</li>
                                        <li>Make sure Caps Lock is not accidentally on</li>
                                        <li>Try using a different browser</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profile3">
                                    "Current password incorrect" error
                                </button>
                            </h2>
                            <div id="profile3" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Current password verification issues:</strong>
                                    <ul>
                                        <li>Double-check you're typing the current password correctly</li>
                                        <li>Verify Caps Lock and Num Lock settings</li>
                                        <li>Try typing the password in a text editor first to verify</li>
                                        <li>Log out and log back in to confirm current password</li>
                                        <li>Contact administrator if you believe the password is correct</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profile4">
                                    Email address won't update
                                </button>
                            </h2>
                            <div id="profile4" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>Email update issues:</strong>
                                    <ul>
                                        <li>Ensure the email format is correct (example@domain.com)</li>
                                        <li>Check that the email address is not already in use</li>
                                        <li>Verify you have access to the new email address</li>
                                        <li>Make sure there are no spaces before or after the email</li>
                                        <li>Contact administrator if the email should be available</li>
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