@extends('layouts.app')

@section('title', $post->title)
@section('meta_description', $post->meta_description ?: $post->excerpt)

@section('content')

    @include('layouts.partials.page-header', [
        'pageTitle' => $post->title,
        'breadcrumbs' => [
            ['label' => 'Blog', 'url' => route('blog.index')],
            ['label' => $post->title, 'url' => route('blog.show', $post->slug)]
        ]
    ])

    <div class="page-blog-single">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="blog-single-content wow fadeInUp">
                        <!-- Featured Image -->
                        @if($post->featured_image)
                        <div class="blog-single-image mb-4">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid rounded">
                            </figure>
                        </div>
                        @endif

                        <!-- Post Meta -->
                        <div class="blog-post-meta mb-3">
                            @if($post->category)
                            <span class="post-cat me-3">
                                <i class="fa-solid fa-folder"></i>
                                {{ $post->category->name }}
                            </span>
                            @endif
                            <span class="post-date me-3">
                                <i class="fa-regular fa-calendar"></i>
                                {{ $post->published_at?->format('F d, Y') }}
                            </span>
                            <span class="post-views me-3">
                                <i class="fa-regular fa-eye"></i>
                                {{ $post->views }} views
                            </span>
                            <span class="post-read-time">
                                <i class="fa-regular fa-clock"></i>
                                {{ $post->reading_time }} min read
                            </span>
                        </div>

                        <!-- Post Body -->
                        <div class="blog-single-body">
                            {!! $post->body !!}
                        </div>

                        <!-- Tags -->
                        @if($post->tags->count())
                        <div class="post-tags mt-4">
                            <strong>Tags:</strong>
                            @foreach($post->tags as $tag)
                            <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="tag-badge">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Related Posts -->
                    @if($relatedPosts->count())
                    <div class="related-posts mt-5 wow fadeInUp">
                        <h3 class="section-subtitle">Related Posts</h3>
                        <div class="row">
                            @foreach($relatedPosts as $rp)
                            <div class="col-md-6">
                                <div class="post-item">
                                    <div class="post-item-box">
                                        <div class="post-featured-image">
                                            <a href="{{ route('blog.show', $rp->slug) }}">
                                                <figure class="image-anime">
                                                    @if($rp->featured_image)
                                                        <img src="{{ asset('storage/'.$rp->featured_image) }}" alt="{{ $rp->title }}">
                                                    @else
                                                        <img src="{{ asset('images/post-1.jpg') }}" alt="{{ $rp->title }}">
                                                    @endif
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="post-item-content">
                                            <h2><a href="{{ route('blog.show', $rp->slug) }}">{{ $rp->title }}</a></h2>
                                        </div>
                                    </div>
                                    <div class="post-item-btn">
                                        <a href="{{ route('blog.show', $rp->slug) }}" class="readmore-btn">read more</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-xl-4">
                    <div class="blog-sidebar">
                        @if($categories->count())
                        <div class="sidebar-widget wow fadeInUp">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="category-list">
                                @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('blog.index', ['category' => $cat->slug]) }}">
                                        {{ $cat->name }}
                                        <span>({{ $cat->posts_count }})</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if($recentPosts->count())
                        <div class="sidebar-widget wow fadeInUp" data-wow-delay="0.2s">
                            <h3 class="widget-title">Recent Posts</h3>
                            <ul class="recent-posts-list">
                                @foreach($recentPosts as $rp)
                                <li>
                                    @if($rp->featured_image)
                                    <img src="{{ asset('storage/'.$rp->featured_image) }}" alt="{{ $rp->title }}">
                                    @endif
                                    <div>
                                        <a href="{{ route('blog.show', $rp->slug) }}">{{ Str::limit($rp->title, 50) }}</a>
                                        <span>{{ $rp->published_at?->format('M d, Y') }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
