@extends('layouts.app')

@section('title', $service->title)
@section('meta_description', $service->short_description)

@section('content')

    @include('layouts.partials.page-header', [
        'pageTitle' => $service->title,
        'breadcrumbs' => [
            ['label' => 'Services', 'url' => route('services.index')],
            ['label' => $service->title, 'url' => route('services.show', $service->slug)]
        ]
    ])

    <div class="page-service-single">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="service-single-content wow fadeInUp">

                        {{-- Featured image --}}
                        @if($service->featured_image)
                        <div class="service-single-image" style="margin-bottom: 32px;">
                            <figure class="image-anime reveal" style="margin: 0; border-radius: 12px; overflow: hidden;">
                                <img src="{{ asset('storage/'.$service->featured_image) }}" alt="{{ $service->title }}"
                                     style="width: 100%; max-height: 420px; object-fit: cover; display: block;">
                            </figure>
                        </div>
                        @endif

                        {{-- Service title --}}
                        <h1 style="font-size: 32px; font-weight: 700; color: #1a1a1a; margin: 0 0 16px;">{{ $service->title }}</h1>

                        {{-- Short description --}}
                        @if($service->short_description)
                        <p style="font-size: 17px; color: #555; line-height: 1.7; border-left: 4px solid #2d6a4f; padding-left: 16px; margin: 0 0 32px;">
                            {{ $service->short_description }}
                        </p>
                        @endif

                        {{-- Divider --}}
                        <hr style="border: none; border-top: 1px solid #eee; margin: 0 0 32px;">

                        {{-- Full body content --}}
                        @if($service->body)
                        <div class="service-single-body">
                            {!! $service->body !!}
                        </div>
                        @else
                        <p style="color: #999; font-style: italic;">Detailed content coming soon.</p>
                        @endif

                    </div>
                </div>

                <div class="col-xl-4">
                    <!-- Sidebar -->
                    <div class="service-sidebar wow fadeInUp" data-wow-delay="0.2s">
                        <!-- All Services -->
                        @if($allServices->count())
                        <div class="sidebar-widget">
                            <h3 class="widget-title">All Services</h3>
                            <ul class="services-list">
                                @foreach($allServices as $s)
                                <li class="{{ $s->id === $service->id ? 'active' : '' }}">
                                    <a href="{{ route('services.show', $s->slug) }}">{{ $s->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Contact Box -->
                        <div class="sidebar-widget sidebar-contact-box">
                            <h3>Need Help?</h3>
                            <p>Contact us for more information about our services.</p>
                            <a href="{{ route('contact') }}" class="btn-default">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
