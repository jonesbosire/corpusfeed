@extends('admin.layouts.app')
@section('title', 'Message from ' . $message->name)
@section('content')
<div class="card" style="max-width:760px;">
    <div class="card-header">
        <h2>Message Details</h2>
        <div style="display:flex;gap:8px;">
            @if($message->status !== 'replied')
            <form method="POST" action="{{ route('admin.messages.updateStatus', $message) }}">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="replied">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-check-double"></i> Mark Replied</button>
            </form>
            @endif
            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">Back</a>
        </div>
    </div>
    <div class="card-body">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px;padding-bottom:24px;border-bottom:1px solid var(--border);">
            <div>
                <div class="form-text">From</div>
                <strong>{{ $message->name }}</strong>
            </div>
            <div>
                <div class="form-text">Email</div>
                <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
            </div>
            @if($message->phone)
            <div>
                <div class="form-text">Phone</div>
                <span>{{ $message->phone }}</span>
            </div>
            @endif
            <div>
                <div class="form-text">Date</div>
                <span>{{ $message->created_at->format('F d, Y H:i') }}</span>
            </div>
            <div>
                <div class="form-text">Status</div>
                @if($message->status === 'unread')
                    <span class="badge badge-danger">Unread</span>
                @elseif($message->status === 'read')
                    <span class="badge badge-info">Read</span>
                @else
                    <span class="badge badge-success">Replied</span>
                @endif
            </div>
            @if($message->subject)
            <div>
                <div class="form-text">Subject</div>
                <strong>{{ $message->subject }}</strong>
            </div>
            @endif
        </div>

        <div>
            <div class="form-text" style="margin-bottom:8px;">Message</div>
            <div style="background:#f9fafb;border-radius:8px;padding:16px;font-size:15px;line-height:1.6;white-space:pre-wrap;">{{ $message->message }}</div>
        </div>

        <div style="margin-top:24px;">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject ?? 'Your message' }}" class="btn btn-primary">
                <i class="fa-solid fa-reply"></i> Reply via Email
            </a>
        </div>
    </div>
</div>
@endsection
