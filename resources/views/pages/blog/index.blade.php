@extends('layouts.app')

@section('title', 'Blog')

@section('content')

    @include('layouts.partials.page-header', [
        'pageTitle' => 'Our Blog',
        'breadcrumbs' => [['label' => 'Blog', 'url' => route('blog.index')]]
    ])

    <div class="page-blog">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="row">
                        @forelse($posts as $i => $post)
                        <div class="col-md-6">
                            <div class="post-item wow fadeInUp" data-wow-delay="{{ ($i % 2) * 0.2 }}s">
                                <div class="post-item-box">
                                    <div class="post-featured-image">
                                        <a href="{{ route('blog.show', $post->slug) }}" data-cursor-text="View">
                                            <figure class="image-anime">
                                                @if($post->featured_image)
                                                    <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}">
                                                @else
                                                    <img src="{{ asset('images/post-1.jpg') }}" alt="{{ $post->title }}">
                                                @endif
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="post-item-content">
                                        <div class="post-meta">
                                            @if($post->category)
                                            <span class="post-cat">{{ $post->category->name }}</span>
                                            @endif
                                            <span class="post-date">{{ $post->published_at?->format('M d, Y') }}</span>
                                        </div>
                                        <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                                        <p>{{ Str::limit($post->excerpt, 120) }}</p>
                                    </div>
                                </div>
                                <div class="post-item-btn">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="readmore-btn">read more</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <p class="text-center">No posts published yet.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="pagination-wrapper mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>

                <div class="col-xl-4">
                    <!-- Sidebar -->
                    <div class="blog-sidebar">
                        <!-- Categories -->
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

                        <!-- Recent Posts -->
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
