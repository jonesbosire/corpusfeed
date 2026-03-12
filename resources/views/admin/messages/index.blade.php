@extends('admin.layouts.app')
@section('title', 'Messages')
@section('content')
<div class="card">
    <div class="card-header"><h2>Contact Messages</h2></div>
    <div class="table-wrapper">
        <table>
            <thead><tr><th>From</th><th>Email</th><th>Subject</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($messages as $msg)
                <tr style="{{ $msg->status === 'unread' ? 'font-weight:600;' : '' }}">
                    <td>{{ $msg->name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ Str::limit($msg->subject ?? 'No subject', 40) }}</td>
                    <td>
                        @if($msg->status === 'unread')
                            <span class="badge badge-danger">Unread</span>
                        @elseif($msg->status === 'read')
                            <span class="badge badge-info">Read</span>
                        @else
                            <span class="badge badge-success">Replied</span>
                        @endif
                    </td>
                    <td>{{ $msg->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-secondary btn-sm btn-icon" title="View">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-envelope"></i><h3>No messages yet</h3></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div style="padding:16px 24px;">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
