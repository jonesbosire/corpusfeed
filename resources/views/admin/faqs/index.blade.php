@extends('admin.layouts.app')
@section('title', 'FAQs')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>FAQs</h2>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add FAQ</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead><tr><th>Question</th><th>Category</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($faqs as $faq)
                <tr>
                    <td style="font-weight:500;">{{ Str::limit($faq->question, 60) }}</td>
                    <td>{{ $faq->category ?? '—' }}</td>
                    <td><span class="badge {{ $faq->status === 'active' ? 'badge-success' : 'badge-secondary' }}">{{ ucfirst($faq->status) }}</span></td>
                    <td>{{ $faq->order }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-secondary btn-sm btn-icon"><i class="fa-solid fa-pen"></i></a>
                            <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-circle-question"></i><h3>No FAQs</h3><a href="{{ route('admin.faqs.create') }}" class="btn btn-primary" style="margin-top:12px;">Add FAQ</a></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
