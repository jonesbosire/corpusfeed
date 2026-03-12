@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')

<!-- Stats Grid -->
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:16px;margin-bottom:24px;">

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-newspaper"></i></div>
        <div>
            <div class="stat-value">{{ $stats['posts'] }}</div>
            <div class="stat-label">Published Posts</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:linear-gradient(135deg,#374151,#6b7280);"><i class="fa-solid fa-file-pen"></i></div>
        <div>
            <div class="stat-value">{{ $stats['drafts'] }}</div>
            <div class="stat-label">Draft Posts</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-briefcase"></i></div>
        <div>
            <div class="stat-value">{{ $stats['services'] }}</div>
            <div class="stat-label">Active Services</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
        <div>
            <div class="stat-value">{{ $stats['team'] }}</div>
            <div class="stat-label">Team Members</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:linear-gradient(135deg,#92400e,#d97706);"><i class="fa-solid fa-star"></i></div>
        <div>
            <div class="stat-value">{{ $stats['testimonials'] }}</div>
            <div class="stat-label">Testimonials</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:linear-gradient(135deg,#1e3a8a,#3b82f6);"><i class="fa-solid fa-circle-question"></i></div>
        <div>
            <div class="stat-value">{{ $stats['faqs'] }}</div>
            <div class="stat-label">Active FAQs</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background:linear-gradient(135deg,#7f1d1d,#ef4444);"><i class="fa-solid fa-envelope"></i></div>
        <div>
            <div class="stat-value">{{ $stats['unread_messages'] }}</div>
            <div class="stat-label">Unread Messages</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-at"></i></div>
        <div>
            <div class="stat-value">{{ $stats['subscribers'] }}</div>
            <div class="stat-label">Subscribers</div>
        </div>
    </div>

</div>

<!-- Quick Actions -->
<div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:24px;">
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> New Post</a>
    <a href="{{ route('admin.services.create') }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-plus"></i> New Service</a>
    <a href="{{ route('admin.team.create') }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-plus"></i> Add Team Member</a>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-plus"></i> Add Testimonial</a>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-plus"></i> Add FAQ</a>
    <a href="{{ route('admin.settings.index') }}" class="btn btn-accent btn-sm"><i class="fa-solid fa-gear"></i> Site Settings</a>
</div>

<!-- Content Tables -->
<div class="form-row cols-2">
    <!-- Recent Posts -->
    <div class="card">
        <div class="card-header">
            <h2>Recent Posts</h2>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPosts as $post)
                    <tr>
                        <td><a href="{{ route('admin.posts.edit', $post) }}" style="color:inherit;text-decoration:none;font-weight:500;">{{ Str::limit($post->title, 38) }}</a></td>
                        <td>
                            @if($post->status === 'published') <span class="badge badge-success">Live</span>
                            @elseif($post->status === 'draft') <span class="badge badge-secondary">Draft</span>
                            @else <span class="badge badge-warning">Scheduled</span>
                            @endif
                        </td>
                        <td>{{ number_format($post->views) }}</td>
                        <td style="color:var(--text-muted);font-size:13px;">{{ $post->published_at?->format('M d') ?? '—' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;padding:32px;color:var(--text-muted);">No posts yet. <a href="{{ route('admin.posts.create') }}">Create one</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="card">
        <div class="card-header">
            <h2>
                Recent Messages
                @if($stats['unread_messages'] > 0)
                <span class="badge badge-danger" style="margin-left:6px;">{{ $stats['unread_messages'] }} unread</span>
                @endif
            </h2>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMessages as $msg)
                    <tr>
                        <td><a href="{{ route('admin.messages.show', $msg) }}" style="color:inherit;text-decoration:none;font-weight:{{ $msg->status === 'unread' ? '700' : '400' }};">{{ $msg->name }}</a></td>
                        <td style="font-size:13px;">{{ Str::limit($msg->subject ?? 'No subject', 28) }}</td>
                        <td>
                            @if($msg->status === 'unread') <span class="badge badge-danger">New</span>
                            @elseif($msg->status === 'read') <span class="badge badge-info">Read</span>
                            @else <span class="badge badge-success">Replied</span>
                            @endif
                        </td>
                        <td style="color:var(--text-muted);font-size:13px;">{{ $msg->created_at->format('M d') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;padding:32px;color:var(--text-muted);">No messages yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
