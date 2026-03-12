@extends('layouts.app')

@section('title', 'FAQs')

@section('content')

    @include('layouts.partials.page-header', [
        'pageTitle' => 'FAQs',
        'breadcrumbs' => [['label' => 'FAQs', 'url' => route('faqs')]]
    ])

    <div class="page-faq">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">FAQs</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Frequently asked questions</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    @forelse($faqs as $i => $faq)
                    <div class="faq-item wow fadeInUp" data-wow-delay="{{ ($i % 5) * 0.1 }}s">
                        <div class="accordion" id="faqAccordion{{ $faq->id }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $faq->id }}"
                                        aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}">
                                    <div class="accordion-body">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center">No FAQs available yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-12 text-center">
                    <div class="section-footer-text wow fadeInUp">
                        <p>Still have questions? <a href="{{ route('contact') }}">Contact Us</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
