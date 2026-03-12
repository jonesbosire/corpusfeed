@extends('admin.layouts.app')

@section('title', 'Blog Posts')

@section('content')

<div class="card">
    <div class="card-header">
        <h2>Blog Posts</h2>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-plus"></i> New Post
        </a>
    </div>
    <div class="card-body" style="padding:0;">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td style="font-weight:500;">{{ Str::limit($post->title, 50) }}</td>
                        <td>{{ $post->category?->name ?? '—' }}</td>
                        <td>
                            @if($post->status === 'published')
                                <span class="badge badge-success">Published</span>
                            @elseif($post->status === 'draft')
                                <span class="badge badge-secondary">Draft</span>
                            @else
                                <span class="badge badge-warning">Scheduled</span>
                            @endif
                        </td>
                        <td>{{ $post->views }}</td>
                        <td>{{ $post->published_at?->format('M d, Y') ?? '—' }}</td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-secondary btn-sm btn-icon" title="View">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fa-solid fa-newspaper"></i>
                                <h3>No posts yet</h3>
                                <p>Create your first blog post</p>
                                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary" style="margin-top:12px;">New Post</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($posts->hasPages())
        <div style="padding:16px 24px;">{{ $posts->links() }}</div>
        @endif
    </div>
</div>

@endsection
