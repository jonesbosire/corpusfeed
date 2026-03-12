@extends('layouts.app')

@section('title', 'Our Team')

@section('content')

    @include('layouts.partials.page-header', [
        'pageTitle' => 'Our Team',
        'breadcrumbs' => [['label' => 'Our Team', 'url' => route('team')]]
    ])

    <div style="padding: 80px 0;">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Our Team</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Skilled experts dedicated to excellence</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($teamMembers as $i => $member)
                <div class="col-xl-3 col-md-6 mb-4">
                    @include('layouts.partials.team-card', ['member' => $member, 'delay' => ($i % 4) * 0.2])
                </div>
                @empty
                <div class="col-12">
                    <p class="text-center">No team members found.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
