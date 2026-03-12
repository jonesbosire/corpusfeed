@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

    @include('layouts.partials.page-header', [
        'pageTitle' => 'Contact Us',
        'breadcrumbs' => [['label' => 'Contact Us', 'url' => route('contact')]]
    ])

    <div class="page-contact-us">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Contact Us Today!</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Let's talk about how we can help you</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="contact-us-image-box wow fadeInUp" data-wow-delay="0.2s">
                        <div class="contact-us-image">
                            <figure class="image-anime">
                                <img src="{{ asset('images/contact-page.jpg') }}" alt="Contact Us">
                            </figure>
                        </div>
                        <div class="contact-info-list">
                            @if(!empty($settings['contact_phone']))
                            <div class="contact-info-item">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-phone-primary.svg') }}" alt="">
                                </div>
                                <div class="contact-info-item-content">
                                    <h3>Phone Number</h3>
                                    <p><a href="tel:{{ $settings['contact_phone'] }}">{{ $settings['contact_phone'] }}</a></p>
                                </div>
                            </div>
                            @endif
                            @if(!empty($settings['contact_email']))
                            <div class="contact-info-item">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-mail-primary.svg') }}" alt="">
                                </div>
                                <div class="contact-info-item-content">
                                    <h3>Email Address</h3>
                                    <p><a href="mailto:{{ $settings['contact_email'] }}">{{ $settings['contact_email'] }}</a></p>
                                </div>
                            </div>
                            @endif
                            @if(!empty($settings['contact_address']))
                            <div class="contact-info-item">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-phone-primary.svg') }}" alt="">
                                </div>
                                <div class="contact-info-item-content">
                                    <h3>Address</h3>
                                    <p>{{ $settings['contact_address'] }}</p>
                                </div>
                            </div>
                            @endif
                            @if(!empty($settings['contact_hours']))
                            <div class="contact-info-item">
                                <div class="icon-box">
                                    <img src="{{ asset('images/icon-phone-primary.svg') }}" alt="">
                                </div>
                                <div class="contact-info-item-content">
                                    <h3>Business Hours</h3>
                                    <p>{{ $settings['contact_hours'] }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="contact-us-form">
                        <div class="section-title">
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Get In Touch</h2>
                        </div>

                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                        @endif

                        <div class="contact-form">
                            <form id="contactForm" action="{{ route('contact.send') }}" method="POST" class="wow fadeInUp" data-wow-delay="0.2s">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Your Name *" value="{{ old('name') }}" required>
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Email Address *" value="{{ old('email') }}" required>
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Phone Number" value="{{ old('phone') }}">
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="subject" class="form-control"
                                            placeholder="Subject" value="{{ old('subject') }}">
                                    </div>
                                    <div class="form-group col-md-12 mb-5">
                                        <textarea name="message" class="form-control @error('message') is-invalid @enderror"
                                            rows="6" placeholder="Your Message..." required>{{ old('message') }}</textarea>
                                        @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-form-btn">
                                            <button type="submit" class="btn-default"><span>Send Message</span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

