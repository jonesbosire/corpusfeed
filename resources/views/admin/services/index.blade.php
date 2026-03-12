@extends('admin.layouts.app')
@section('title', 'Services')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Services</h2>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> New Service</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead><tr><th>Title</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td style="font-weight:500;">{{ $service->title }}</td>
                    <td><span class="badge {{ $service->status === 'active' ? 'badge-success' : 'badge-secondary' }}">{{ ucfirst($service->status) }}</span></td>
                    <td>{{ $service->order }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-secondary btn-sm btn-icon"><i class="fa-solid fa-pen"></i></a>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4"><div class="empty-state"><i class="fa-solid fa-briefcase"></i><h3>No services</h3><a href="{{ route('admin.services.create') }}" class="btn btn-primary" style="margin-top:12px;">Add Service</a></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
