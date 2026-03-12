@extends('admin.layouts.app')
@section('title', 'Subscribers')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Newsletter Subscribers</h2>
        <a href="{{ route('admin.subscribers.export') }}" class="btn btn-secondary btn-sm">
            <i class="fa-solid fa-download"></i> Export CSV
        </a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead><tr><th>Email</th><th>Name</th><th>Status</th><th>Subscribed</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($subscribers as $sub)
                <tr>
                    <td style="font-weight:500;">{{ $sub->email }}</td>
                    <td>{{ $sub->name ?? '—' }}</td>
                    <td><span class="badge {{ $sub->status === 'active' ? 'badge-success' : 'badge-secondary' }}">{{ ucfirst($sub->status) }}</span></td>
                    <td>{{ $sub->created_at->format('M d, Y') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.subscribers.destroy', $sub) }}" onsubmit="return confirm('Remove this subscriber?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm btn-icon"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-at"></i><h3>No subscribers yet</h3></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($subscribers->hasPages())
    <div style="padding:16px 24px;">{{ $subscribers->links() }}</div>
    @endif
</div>
@endsection
