{{-- Debug URL Generation - Remove this file after fixing issues --}}
@extends('layouts.admin')

@section('title', 'URL Debug')
@section('page-title', 'URL Generation Debug')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>URL Generation Debug Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6>Environment Info:</h6>
                <ul>
                    <li><strong>APP_URL:</strong> {{ config('app.url') }}</li>
                    <li><strong>Current Host:</strong> {{ request()->getHost() }}</li>
                    <li><strong>Current URI:</strong> {{ request()->getRequestUri() }}</li>
                    <li><strong>Current Port:</strong> {{ request()->getPort() }}</li>
                    <li><strong>Scheme:</strong> {{ request()->getScheme() }}</li>
                    <li><strong>Full URL:</strong> {{ request()->url() }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h6>Asset URL Generation:</h6>
                <ul>
                    <li><strong>asset('/'):</strong> {{ asset('/') }}</li>
                    <li><strong>asset('storage'):</strong> {{ asset('storage') }}</li>
                    <li><strong>asset('storage/slideshows'):</strong> {{ asset('storage/slideshows') }}</li>
                    <li><strong>url('/'):</strong> {{ url('/') }}</li>
                    <li><strong>Storage::url('test'):</strong> {{ \Storage::url('test') }}</li>
                </ul>
            </div>
        </div>
        
        @if($slideshows->count() > 0)
        <hr>
        <h6>Sample Slideshow URLs:</h6>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Path</th>
                        <th>Filename</th>
                        <th>Generated URL</th>
                        <th>Preview</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slideshows->take(5) as $slideshow)
                    <tr>
                        <td>{{ $slideshow->title }}</td>
                        <td>{{ $slideshow->path }}</td>
                        <td>{{ $slideshow->filename }}</td>
                        <td>
                            <small class="text-break">{{ $slideshow->url }}</small>
                        </td>
                        <td>
                            @if($slideshow->type === 'image')
                                <img src="{{ $slideshow->url }}" alt="Preview" 
                                     style="width: 40px; height: 30px; object-fit: cover;"
                                     onerror="this.style.border='2px solid red'; this.alt='FAILED';">
                            @else
                                <span class="badge bg-info">{{ $slideshow->type }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        
        <hr>
        <div class="alert alert-warning">
            <strong>Instructions:</strong>
            <ol>
                <li>Check if the generated URLs are correct for your server environment</li>
                <li>Verify that the storage symlink exists: <code>public/storage -> ../storage/app/public</code></li>
                <li>Ensure file permissions are correct on storage directory</li>
                <li>Remove this debug file once issues are resolved</li>
            </ol>
        </div>
    </div>
</div>
@endsection