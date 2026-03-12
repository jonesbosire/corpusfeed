@extends('layouts.app')

@section('body-class', 'page-home')

@section('title', 'Home')

@section('content')

    <!-- Hero Section -->
    <div class="hero-gold bg-section">
        <div class="hero-box-gold">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero-content-gold">
                            <div class="section-title">
                                <h3 class="wow fadeInUp">{{ $settings['site_tagline'] ?? 'Healthy Farms, Healthy Lives' }}</h3>
                                <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $settings['hero_title'] ?? 'Growing pure organic goodness for a healthier tomorrow' }}</h1>
                                <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $settings['hero_subtitle'] ?? '' }}</p>
                            </div>
                            <div class="hero-btn-gold wow fadeInUp" data-wow-delay="0.4s">
                                <a href="{{ route('contact') }}" class="btn-default btn-highlighted">{{ $settings['hero_btn_text'] ?? 'Get In Touch' }}</a>
                                <a href="{{ route('services.index') }}" class="btn-default">View Our Services</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-image-box-gold wow fadeInUp">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero-image-title-gold">
                            <h2>{{ $settings['site_name'] ?? 'CorpusFeed' }}</h2>
                        </div>
                        <div class="hero-image-gold">
                            <figure>
                                @if(!empty($settings['hero_background']))
                                    <img src="{{ asset('storage/'.$settings['hero_background']) }}" alt="Hero">
                                @else
                                    <img src="{{ asset('images/hero-image-gold.png') }}" alt="">
                                @endif
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->

    <!-- About Us Section -->
    <div class="about-us-gold">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-xl-7">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">About Us</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ $settings['about_title'] ?? 'A deep commitment to pure, natural, and eco-friendly practices' }}</h2>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="section-content-btn">
                        <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                            <p>{{ $settings['about_body'] ?? '' }}</p>
                        </div>
                        <div class="section-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ route('about') }}" class="btn-default">More About Us</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6 order-xl-1 order-md-1">
                    <div class="about-us-item-box-gold mission-box-gold wow fadeInUp" data-wow-delay="0.2s">
                        <div class="about-us-item-gold">
                            <div class="about-us-item-header-gold">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-about-us-item-1-gold.svg') }}" alt="">
                                </div>
                                <div class="about-us-item-title-gold">
                                    <h3>Our Mission</h3>
                                </div>
                            </div>
                            <div class="about-us-item-content-gold">
                                <p>To be a modern centre of excellence in circular agribusiness, transforming organic waste into value, reducing post-harvest losses through cold-storage solutions, ensuring a reliable supply of vegetables and herbs, empowering farmers through training and innovation, and producing premium crops for sustainable agriculture and international markets.</p>
                            </div>
                        </div>
                        <div class="about-us-item-body-gold">
                            <div class="about-counter-item-gold">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-about-counter-item-1-gold.svg') }}" alt="">
                                </div>
                                <div class="about-counter-item-content-gold">
                                    <h2><span class="counter">{{ $settings['stat_years'] ?? '10' }}</span>+</h2>
                                    <p>Years of Experience</p>
                                </div>
                            </div>
                            <div class="about-counter-item-gold">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-about-counter-item-2-gold.svg') }}" alt="">
                                </div>
                                <div class="about-counter-item-content-gold">
                                    <h2><span class="counter">{{ $settings['stat_clients'] ?? '500' }}</span>+</h2>
                                    <p>Happy Clients</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-12 order-xl-2 order-md-3">
                    <div class="about-us-image-gold">
                        <figure class="image-anime reveal">
                            @if(!empty($settings['about_image']))
                                <img src="{{ asset('storage/'.$settings['about_image']) }}" alt="About Us">
                            @else
                                <img src="{{ asset('images/about-us-img-gold.jpg') }}" alt="About Us">
                            @endif
                        </figure>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 order-xl-3 order-md-2">
                    <div class="about-us-item-box-gold vision-box-gold wow fadeInUp" data-wow-delay="0.4s">
                        <div class="about-us-item-gold">
                            <div class="about-us-item-header-gold">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-about-us-item-2-gold.svg') }}" alt="">
                                </div>
                                <div class="about-us-item-title-gold">
                                    <h3>Our Vision</h3>
                                </div>
                            </div>
                            <div class="about-us-item-content-gold">
                                <p>To lead in building Kenya’s circular economy by producing organic fertilizers and export-grade vegetables and herbs—creating value from waste, strengthening farmer livelihoods, and protecting the planet.</p>
                            </div>
                        </div>
                        <div class="about-us-item-body-gold">
                            <div class="about-counter-item-gold">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-about-counter-item-1-gold.svg') }}" alt="">
                                </div>
                                <div class="about-counter-item-content-gold">
                                    <h2><span class="counter">{{ $settings['stat_farms'] ?? '50' }}</span>+</h2>
                                    <p>Smallholder Farmers in Network</p>
                                </div>
                            </div>
                            <div class="about-counter-item-gold">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-about-counter-item-2-gold.svg') }}" alt="">
                                </div>
                                <div class="about-counter-item-content-gold">
                                    <h2><span class="counter">{{ $settings['stat_deliveries'] ?? '1000' }}</span>+</h2>
                                    <p>Part-time Workers, Primarily Women</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 order-4">
                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.6s">
                        <p><span>Fresh</span> Where Nature Meets Quality &mdash; <a href="{{ route('services.index') }}">Discover our Key Objectives!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Section End -->

    <!-- Our Services Section -->
    @if($services->count())
    <div class="our-services-gold bg-section">
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
                @foreach($services as $i => $service)
                <div class="col-xl-4 col-md-6">
                    <div class="service-item-gold wow fadeInUp" data-wow-delay="{{ $i * 0.2 }}s">
                        <div class="service-item-image-gold">
                            <a href="{{ route('services.show', $service->slug) }}" data-cursor-text="View">
                                <figure>
                                    @if($service->featured_image)
                                        <img src="{{ asset('storage/'.$service->featured_image) }}" alt="{{ $service->title }}">
                                    @else
                                        <img src="{{ asset('images/service-image-'.($i+1).'-gold.jpg') }}" alt="{{ $service->title }}">
                                    @endif
                                </figure>
                            </a>
                        </div>
                        <div class="service-item-body-gold">
                            <div class="service-item-content-gold">
                                <h3><a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a></h3>
                                <p>{{ Str::limit($service->short_description, 100) }}</p>
                            </div>
                            <div class="service-item-btn-gold">
                                <a href="{{ route('services.show', $service->slug) }}" class="readmore-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="our-service-footer-gold">
                        <div class="section-footer-text wow fadeInUp" data-wow-delay="0.8s">
                            <p>Let's make something great together. <a href="{{ route('contact') }}">Get In Touch</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Our Services Section End -->

    <!-- Certifications Section -->
    <div class="our-services-gold bg-section">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Certifications &amp; Compliance</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Adhering to international agricultural and export standards</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @php
                $certifications = [
                    ['icon' => 'fa-seedling',       'title' => 'HCD Kenya',          'body' => "Horticultural Crops Directorate — the primary regulatory body for Kenya's horticultural export sector."],
                    ['icon' => 'fa-shield-halved',   'title' => 'KEPHIS',             'body' => 'Kenya Plant Health Inspectorate Service — ensuring plant health standards and phytosanitary compliance.'],
                    ['icon' => 'fa-earth-africa',    'title' => 'GlobalG.A.P.',       'body' => 'Certified production systems meeting globally recognised Good Agricultural Practices for export markets.'],
                    ['icon' => 'fa-leaf',            'title' => 'NEMA',               'body' => 'National Environment Management Authority — full environmental compliance in all our operations.'],
                    ['icon' => 'fa-building-columns','title' => 'County Government',  'body' => 'Valid operating licences issued by the County Government, ensuring full local regulatory compliance.'],
                ];
                @endphp
                @foreach($certifications as $i => $cert)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="wow fadeInUp" data-wow-delay="{{ $i * 0.15 }}s"
                         style="background:#fff;border-radius:14px;border:1px solid #e8f5f0;box-shadow:0 2px 16px rgba(45,106,79,0.06);padding:32px 28px;height:100%;transition:transform 0.3s,box-shadow 0.3s;"
                         onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 10px 32px rgba(45,106,79,0.13)'"
                         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 16px rgba(45,106,79,0.06)'">
                        <div style="width:54px;height:54px;border-radius:12px;background:linear-gradient(135deg,#2d6a4f,#52b788);display:flex;align-items:center;justify-content:center;margin-bottom:18px;">
                            <i class="fa-solid {{ $cert['icon'] }}" style="color:#fff;font-size:22px;"></i>
                        </div>
                        <h3 style="font-size:17px;font-weight:700;color:#1a1a1a;margin:0 0 10px;">{{ $cert['title'] }}</h3>
                        <p style="font-size:14px;color:#666;line-height:1.7;margin:0;">{{ $cert['body'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Certifications Section End -->

    <!-- Partners Section -->
    @if(isset($partners) && $partners->count())
    <div style="padding: 60px 0; background: #fff; border-top: 1px solid #f0f0f0;">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Our Partners</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Trusted by leading organisations</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                @foreach($partners as $i => $partner)
                <div class="col-lg-2 col-md-3 col-4 mb-4">
                    <div class="wow fadeInUp" data-wow-delay="{{ $i * 0.1 }}s" style="text-align:center; padding: 16px;">
                        @if($partner->url)
                        <a href="{{ $partner->url }}" target="_blank">
                        @endif
                            <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}"
                                 style="max-height: 60px; max-width: 100%; object-fit: contain; filter: grayscale(100%); opacity: 0.6; transition: all 0.3s;"
                                 onmouseover="this.style.filter='grayscale(0%)';this.style.opacity='1'"
                                 onmouseout="this.style.filter='grayscale(100%)';this.style.opacity='0.6'">
                        @if($partner->url)
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- Partners Section End -->

    <!-- Our Team Section -->
    @if($teamMembers->count())
    <div style="padding: 80px 0; background: #fff;">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Our Team</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Skilled experts dedicated to excellence and innovation</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($teamMembers->take(3) as $i => $member)
                <div class="col-lg-4 col-md-6 mb-4">
                    @include('layouts.partials.team-card', ['member' => $member, 'delay' => $i * 0.2])
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-2">
                    <a href="{{ route('team') }}" class="btn-default">View Full Team</a>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Our Team Section End -->

    <!-- Testimonials Section -->
    @if($testimonials->count())
    <div class="our-testimonials-gold">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Testimonials</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">What our clients say about us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonials-item-list-gold">
                        @foreach($testimonials as $i => $testimonial)
                        <div class="testimonials-item-gold wow fadeInUp" data-wow-delay="{{ $i * 0.2 }}s">
                            <div class="testimonials-item-header-gold">
                                <div class="testimonial-item-rating-gold">
                                    @for($s = 1; $s <= 5; $s++)
                                        <i class="fa-{{ $s <= $testimonial->rating ? 'solid' : 'regular' }} fa-star"></i>
                                    @endfor
                                </div>
                                <div class="testimonial-item-content-gold">
                                    <p>"{{ $testimonial->content }}"</p>
                                </div>
                            </div>
                            <div class="testimonial-item-body-gold">
                                <div class="testimonial-author-gold">
                                    <div class="testimonial-author-image-gold">
                                        <figure class="image-anime">
                                            @if($testimonial->photo)
                                                <img src="{{ asset('storage/'.$testimonial->photo) }}" alt="{{ $testimonial->name }}">
                                            @else
                                                <img src="{{ asset('images/author-'.($i+1).'.jpg') }}" alt="{{ $testimonial->name }}">
                                            @endif
                                        </figure>
                                    </div>
                                    <div class="testimonial-author-content-gold">
                                        <h3>{{ $testimonial->name }}</h3>
                                        <p>{{ $testimonial->role }}@if($testimonial->company), {{ $testimonial->company }}@endif</p>
                                    </div>
                                </div>
                                <div class="testimonial-item-quote-gold">
                                    <img src="{{ asset('images/testimonial-quote-gold.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Testimonials Section End -->

    <!-- Latest Blog Section -->
    @if($latestPosts->count())
    <div class="our-blog">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Latest Blogs</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Dive into educational, inspiring, and fresh content</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($latestPosts as $i => $post)
                <div class="col-xl-4 col-md-6">
                    <div class="post-item wow fadeInUp" data-wow-delay="{{ $i * 0.2 }}s">
                        <div class="post-item-box">
                            <div class="post-featured-image">
                                <a href="{{ route('blog.show', $post->slug) }}" data-cursor-text="View">
                                    <figure class="image-anime">
                                        @if($post->featured_image)
                                            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}">
                                        @else
                                            <img src="{{ asset('images/post-'.($i+1).'.jpg') }}" alt="{{ $post->title }}">
                                        @endif
                                    </figure>
                                </a>
                            </div>
                            <div class="post-item-content">
                                <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                                <p>{{ Str::limit($post->excerpt, 120) }}</p>
                            </div>
                        </div>
                        <div class="post-item-btn">
                            <a href="{{ route('blog.show', $post->slug) }}" class="readmore-btn">read more</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-4">
                    <a href="{{ route('blog.index') }}" class="btn-default">View All Posts</a>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Latest Blog Section End -->

@endsection
