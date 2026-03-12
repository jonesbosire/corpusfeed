@extends('layouts.app')

@section('title', 'Our Services')

@section('content')

    @include('layouts.partials.page-header', [
        'pageTitle' => 'Our Services',
        'breadcrumbs' => [['label' => 'Services', 'url' => route('services.index')]]
    ])

    <div class="page-services">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Our Services</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Delivering quality services with trusted expertise</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($services as $i => $service)
                <div class="col-xl-4 col-md-6">
                    <div class="service-item-gold wow fadeInUp" data-wow-delay="{{ ($i % 3) * 0.2 }}s">
                        <div class="service-item-image-gold">
                            <a href="{{ route('services.show', $service->slug) }}" data-cursor-text="View">
                                <figure>
                                    @if($service->featured_image)
                                        <img src="{{ asset('storage/'.$service->featured_image) }}" alt="{{ $service->title }}">
                                    @else
                                        <img src="{{ asset('images/service-image-1-gold.jpg') }}" alt="{{ $service->title }}">
                                    @endif
                                </figure>
                            </a>
                        </div>
                        <div class="service-item-body-gold">
                            <div class="service-item-content-gold">
                                <h3><a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a></h3>
                                <p>{{ Str::limit($service->short_description, 120) }}</p>
                            </div>
                            <div class="service-item-btn-gold">
                                <a href="{{ route('services.show', $service->slug) }}" class="readmore-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-center">No services available yet.</p>
                </div>
                @endforelse
            </div>
            {{ $services->links() }}
        </div>
    </div>

@endsection
