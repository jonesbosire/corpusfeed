<div class="page-header bg-section dark-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $pageTitle ?? '' }}</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            @isset($breadcrumbs)
                                @foreach($breadcrumbs as $bc)
                                    @if($loop->last)
                                        <li class="breadcrumb-item active" aria-current="page">{{ $bc['label'] }}</li>
                                    @else
                                        <li class="breadcrumb-item"><a href="{{ $bc['url'] }}">{{ $bc['label'] }}</a></li>
                                    @endif
                                @endforeach
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? '' }}</li>
                            @endisset
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
