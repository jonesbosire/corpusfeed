@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="page-404 bg-section dark-section" style="min-height:60vh; display:flex; align-items:center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="error-box wow fadeInUp">
                    <h1 style="font-size:120px; font-weight:800; color:var(--primary-color, #5a9e3a);">404</h1>
                    <h2>Oops! Page Not Found</h2>
                    <p>The page you are looking for doesn't exist or has been moved.</p>
                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn-default btn-highlighted me-3">Go Home</a>
                        <a href="{{ route('contact') }}" class="btn-default">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
