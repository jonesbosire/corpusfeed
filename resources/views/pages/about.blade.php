@extends('layouts.app')

@section('title', 'About Us')

@section('content')

    @include('layouts.partials.page-header', [
        'pageTitle' => 'About Us',
        'breadcrumbs' => [['label' => 'About Us', 'url' => route('about')]]
    ])

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
                            <a href="{{ route('contact') }}" class="btn-default">Get In Touch</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
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
                <div class="col-xl-6">
                    <div class="why-choose-us-content-gold">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Why Choose Us</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Key Objectives</h2>
                        </div>
                        <div class="why-choose-item-list-gold wow fadeInUp" data-wow-delay="0.4s">
                            
                                <div class="why-choose-item-content-gold">
                                    <p>Promote circular economy practices by transforming organic waste into high-quality organic fertilizers and soil-enhancing inputs.</p>
                                </div>

                                <div class="why-choose-item-content-gold">
                                    <p>Establish a centre of excellence for the production of export-grade vegetables and herbs through innovation, quality assurance, and cold-chain solutions.</p>
                                </div>

                                <div class="why-choose-item-content-gold">
                                    <p>Ensure a reliable and consistent supply of premium-quality vegetables and herbs that meet international export standards, strengthening Kenya’s competitiveness in regional and global markets.</p>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            {{-- <div class="row mt-5">
                <div class="col-md-3 col-6">
                    <div class="about-counter-item-gold wow fadeInUp text-center">
                        <h2><span class="counter">{{ $settings['stat_clients'] ?? '500' }}</span>+</h2>
                        <p>Happy Clients</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="about-counter-item-gold wow fadeInUp text-center" data-wow-delay="0.2s">
                        <h2><span class="counter">{{ $settings['stat_farms'] ?? '50' }}</span>+</h2>
                        <p>Partner Farms</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="about-counter-item-gold wow fadeInUp text-center" data-wow-delay="0.4s">
                        <h2><span class="counter">{{ $settings['stat_years'] ?? '10' }}</span>+</h2>
                        <p>Years Experience</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="about-counter-item-gold wow fadeInUp text-center" data-wow-delay="0.6s">
                        <h2><span class="counter">{{ $settings['stat_deliveries'] ?? '1000' }}</span>+</h2>
                        <p>Deliveries Made</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Production and Sales Section -->
    <div class="about-us-gold" style="padding-top:0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 order-xl-2">
                    <div class="about-us-image-gold wow fadeInUp">
                        <figure class="image-anime reveal" style="border-radius:16px;overflow:hidden;">
                            <img src="{{ asset('images/about-us-img-gold.jpg') }}" alt="Herb Production">
                        </figure>
                    </div>
                </div>
                <div class="col-xl-6 order-xl-1">
                    <div class="why-choose-us-content-gold">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Production &amp; Sales</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">50+ tons supplied since 2023</h2>
                        </div>
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <p style="font-size:16px;color:#555;line-height:1.8;margin-bottom:20px;">
                                Since 2023, CorpusFeed Limited has successfully supplied over 50 tons of fresh herbs to domestic and international buyers. Our key export products include basil and chives, alongside a growing portfolio of specialty herbs such as rosemary, thyme, oregano, and mint.
                            </p>
                            <p style="font-size:16px;color:#555;line-height:1.8;margin-bottom:28px;">
                                With improved infrastructure and expanded outgrower partnerships, we are scaling production capacity toward 5 tons of herbs per week to meet growing demand in European and Middle Eastern markets.
                            </p>
                            <div style="display:flex;gap:24px;flex-wrap:wrap;">
                                <div style="text-align:center;padding:20px 28px;background:#f8faf7;border-radius:12px;border:1px solid #e8f5f0;">
                                    <h3 style="font-size:28px;font-weight:800;color:#2d6a4f;margin:0 0 4px;">50+</h3>
                                    <p style="font-size:13px;color:#777;margin:0;">Tons Supplied</p>
                                </div>
                                <div style="text-align:center;padding:20px 28px;background:#f8faf7;border-radius:12px;border:1px solid #e8f5f0;">
                                    <h3 style="font-size:28px;font-weight:800;color:#2d6a4f;margin:0 0 4px;">5 tons</h3>
                                    <p style="font-size:13px;color:#777;margin:0;">Per Week Target</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Production and Sales Section End -->

    <!-- Environmental Impact Section -->
    <div style="padding:80px 0;background:#0d401c;background-image:url('{{ asset('images/dark-section-bg-shape.png') }}');background-size:cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <div class="section-title wow fadeInUp" style="margin-bottom:32px;">
                        <h3 style="color:#f8c32c;font-size:14px;font-weight:700;text-transform:uppercase;letter-spacing:2px;margin-bottom:12px;">Environmental Impact</h3>
                        <h2 style="color:#fff;font-size:36px;font-weight:700;line-height:1.3;margin-bottom:20px;">Waste &amp; Carbon Reduction</h2>
                        <p style="color:rgba(255,255,255,0.75);font-size:16px;line-height:1.8;margin-bottom:16px;">
                            CorpusFeed contributes to climate action by transforming organic waste into productive agricultural inputs through circular economy systems. Since 2023, we have been collecting and processing over 100 tons of organic waste per month from local markets and farms.
                        </p>
                        <p style="color:rgba(255,255,255,0.75);font-size:16px;line-height:1.8;margin-bottom:16px;">
                            This waste is converted into organic fertilizer and insect protein through Black Soldier Fly systems and composting. By diverting organic waste from landfills, CorpusFeed helps reduce methane emissions — one of the most harmful greenhouse gases.
                        </p>
                        <p style="color:rgba(255,255,255,0.75);font-size:16px;line-height:1.8;">
                            Our goal is to scale waste recovery to 10,000 tons annually, significantly increasing our climate impact while supporting sustainable food production.
                        </p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="row wow fadeInUp" data-wow-delay="0.2s">
                        <div class="col-6 mb-4">
                            <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:14px;padding:28px 24px;text-align:center;">
                                <i class="fa-solid fa-recycle" style="font-size:28px;color:#52b788;margin-bottom:14px;display:block;"></i>
                                <h3 style="font-size:30px;font-weight:800;color:#fff;margin:0 0 6px;">100+</h3>
                                <p style="font-size:13px;color:rgba(255,255,255,0.6);margin:0;">Tons of Organic Waste<br>Recovered Monthly</p>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:14px;padding:28px 24px;text-align:center;">
                                <i class="fa-solid fa-bullseye" style="font-size:28px;color:#52b788;margin-bottom:14px;display:block;"></i>
                                <h3 style="font-size:30px;font-weight:800;color:#fff;margin:0 0 6px;">10,000</h3>
                                <p style="font-size:13px;color:rgba(255,255,255,0.6);margin:0;">Tons Target<br>Annually</p>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:14px;padding:28px 24px;text-align:center;">
                                <i class="fa-solid fa-bugs" style="font-size:28px;color:#52b788;margin-bottom:14px;display:block;"></i>
                                <h3 style="font-size:20px;font-weight:700;color:#fff;margin:0 0 6px;">BSF Systems</h3>
                                <p style="font-size:13px;color:rgba(255,255,255,0.6);margin:0;">Black Soldier Fly<br>Insect Protein</p>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:14px;padding:28px 24px;text-align:center;">
                                <i class="fa-solid fa-leaf" style="font-size:28px;color:#52b788;margin-bottom:14px;display:block;"></i>
                                <h3 style="font-size:20px;font-weight:700;color:#fff;margin:0 0 6px;">Regenerative</h3>
                                <p style="font-size:13px;color:rgba(255,255,255,0.6);margin:0;">Low-carbon<br>Agriculture</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Environmental Impact Section End -->

    <!-- Team Section Preview -->
    @if($teamMembers->count())
    <div style="padding: 80px 0; background: #f8f9f7;">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Meet Our Team</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">The people behind our success</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($teamMembers->take(4) as $i => $member)
                <div class="col-xl-3 col-md-6 mb-4">
                    @include('layouts.partials.team-card', ['member' => $member, 'delay' => $i * 0.2])
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt-2">
                    <a href="{{ route('team') }}" class="btn-default">View All Team Members</a>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection
