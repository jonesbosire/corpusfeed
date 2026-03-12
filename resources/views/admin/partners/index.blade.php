@extends('admin.layouts.app')
@section('title', 'Partners')
@section('content')

<div class="card-header" style="background:#fff;border-radius:12px;border:1px solid var(--border);padding:16px 22px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h2 style="font-size:16px;font-weight:700;color:var(--text);margin-bottom:2px;">Partners</h2>
        <p style="font-size:13px;color:var(--text-muted);margin:0;">{{ $partners->count() }} partner{{ $partners->count() !== 1 ? 's' : '' }}</p>
    </div>
    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus"></i> Add Partner
    </a>
</div>

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:20px;">{{ session('success') }}</div>
@endif

@if($partners->isEmpty())
<div class="card">
    <div class="empty-state">
        <i class="fa-solid fa-handshake"></i>
        <h3>No partners yet</h3>
        <p style="margin-bottom:16px;font-size:14px;">Add your first partner logo to get started.</p>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add Partner
        </a>
    </div>
</div>
@else
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:20px;">
    @foreach($partners as $partner)
    <div style="background:#fff;border-radius:14px;border:1px solid var(--border);box-shadow:0 1px 3px rgba(0,0,0,0.05);overflow:hidden;display:flex;flex-direction:column;transition:box-shadow .2s;"
         onmouseover="this.style.boxShadow='0 6px 20px rgba(13,64,28,0.1)'"
         onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)'">

        <div style="height:5px;background:linear-gradient(90deg,var(--primary),var(--primary-light));"></div>

        <div style="padding:24px 22px 20px;flex:1;display:flex;flex-direction:column;">

            {{-- Logo preview --}}
            <div style="background:#f7faf6;border-radius:10px;padding:20px;display:flex;align-items:center;justify-content:center;min-height:100px;margin-bottom:16px;border:1px solid var(--border);">
                <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}"
                     style="max-height:70px;max-width:100%;object-fit:contain;">
            </div>

            {{-- Name & status --}}
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <h3 style="font-size:15px;font-weight:700;color:var(--text);">{{ $partner->name }}</h3>
                <span class="badge {{ $partner->status === 'active' ? 'badge-success' : 'badge-secondary' }}">
                    <i class="fa-solid fa-circle" style="font-size:7px;margin-right:4px;"></i>
                    {{ ucfirst($partner->status) }}
                </span>
            </div>

            {{-- URL --}}
            @if($partner->url)
            <p style="font-size:12px;color:var(--text-muted);margin-bottom:6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                <i class="fa-solid fa-link" style="margin-right:4px;"></i>{{ $partner->url }}
            </p>
            @endif

            <p style="font-size:12px;color:var(--text-muted);margin-bottom:18px;">
                <i class="fa-solid fa-sort" style="margin-right:4px;"></i>Order: {{ $partner->order }}
            </p>

            {{-- Actions --}}
            <div style="display:flex;gap:8px;border-top:1px solid var(--border);padding-top:16px;margin-top:auto;">
                <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-secondary btn-sm" style="flex:1;justify-content:center;">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}"
                      onsubmit="return confirm('Delete {{ addslashes($partner->name) }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
