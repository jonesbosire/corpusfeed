@extends('admin.layouts.app')
@section('title', 'Testimonials')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Testimonials</h2>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add Testimonial</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead><tr><th>Name</th><th>Role / Company</th><th>Rating</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($testimonials as $t)
                <tr>
                    <td style="font-weight:500;">{{ $t->name }}</td>
                    <td>{{ $t->role }}@if($t->company), {{ $t->company }}@endif</td>
                    <td>
                        @for($s=1;$s<=5;$s++)
                            <i class="fa-{{ $s <= $t->rating ? 'solid' : 'regular' }} fa-star" style="color:#f59e0b;font-size:12px;"></i>
                        @endfor
                    </td>
                    <td><span class="badge {{ $t->status === 'active' ? 'badge-success' : 'badge-secondary' }}">{{ ucfirst($t->status) }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-secondary btn-sm btn-icon"><i class="fa-solid fa-pen"></i></a>
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-star"></i><h3>No testimonials</h3><a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary" style="margin-top:12px;">Add Testimonial</a></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
