@extends('admin.layouts.app')
@section('title', 'Team Members')
@section('content')

<div class="card-header" style="background:#fff;border-radius:12px;border:1px solid var(--border);padding:16px 22px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h2 style="font-size:16px;font-weight:700;color:var(--text);margin-bottom:2px;">Team Members</h2>
        <p style="font-size:13px;color:var(--text-muted);margin:0;">{{ $members->count() }} member{{ $members->count() !== 1 ? 's' : '' }}</p>
    </div>
    <a href="{{ route('admin.team.create') }}" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus"></i> Add Member
    </a>
</div>

@if($members->isEmpty())
<div class="card">
    <div class="empty-state">
        <i class="fa-solid fa-users"></i>
        <h3>No team members yet</h3>
        <p style="margin-bottom:16px;font-size:14px;">Add your first team member to get started.</p>
        <a href="{{ route('admin.team.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add Member
        </a>
    </div>
</div>
@else
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;">
    @foreach($members as $member)
    <div style="background:#fff;border-radius:14px;border:1px solid var(--border);box-shadow:0 1px 3px rgba(0,0,0,0.05);overflow:hidden;display:flex;flex-direction:column;transition:box-shadow .2s;" onmouseover="this.style.boxShadow='0 6px 20px rgba(13,64,28,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)'">

        {{-- Top stripe --}}
        <div style="height:5px;background:linear-gradient(90deg,var(--primary),var(--primary-light));"></div>

        <div style="padding:24px 22px 20px;flex:1;display:flex;flex-direction:column;">

            {{-- Avatar + Status --}}
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;">
                @if($member->photo)
                    <img src="{{ asset('storage/'.$member->photo) }}"
                         style="width:68px;height:68px;border-radius:50%;object-fit:cover;border:3px solid var(--border);">
                @else
                    <div style="width:68px;height:68px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--primary-light));display:flex;align-items:center;justify-content:center;font-size:26px;font-weight:700;color:var(--accent);flex-shrink:0;border:3px solid var(--border);">
                        {{ strtoupper(substr($member->name, 0, 1)) }}
                    </div>
                @endif
                <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px;">
                    <span class="badge {{ $member->status === 'active' ? 'badge-success' : 'badge-secondary' }}">
                        <i class="fa-solid fa-circle" style="font-size:7px;margin-right:4px;"></i>
                        {{ ucfirst($member->status) }}
                    </span>
                    <span style="font-size:11px;color:var(--text-muted);background:#f7faf6;border:1px solid var(--border);border-radius:6px;padding:2px 8px;">
                        #{{ $member->order }}
                    </span>
                </div>
            </div>

            {{-- Name & Role --}}
            <div style="margin-bottom:10px;">
                <h3 style="font-size:15px;font-weight:700;color:var(--text);margin-bottom:3px;line-height:1.3;">{{ $member->name }}</h3>
                <p style="font-size:12px;font-weight:600;color:var(--primary-light);text-transform:uppercase;letter-spacing:0.5px;">{{ $member->role }}</p>
            </div>

            {{-- Bio --}}
            @if($member->bio)
            <p style="font-size:13px;color:var(--text-muted);line-height:1.6;margin-bottom:14px;flex:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $member->bio }}</p>
            @else
            <p style="font-size:13px;color:#c5d9c8;font-style:italic;margin-bottom:14px;flex:1;">No bio added.</p>
            @endif

            {{-- Social + Email --}}
            <div style="display:flex;gap:8px;margin-bottom:18px;flex-wrap:wrap;">
                @if($member->email)
                <a href="mailto:{{ $member->email }}" title="{{ $member->email }}"
                   style="width:32px;height:32px;border-radius:8px;background:#f1f5f0;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:14px;text-decoration:none;transition:all .15s;"
                   onmouseover="this.style.background='var(--primary)';this.style.color='#fff';this.style.borderColor='var(--primary)'"
                   onmouseout="this.style.background='#f1f5f0';this.style.color='var(--text-muted)';this.style.borderColor='var(--border)'">
                    <i class="fa-solid fa-envelope"></i>
                </a>
                @endif
                @if($member->linkedin)
                <a href="{{ $member->linkedin }}" target="_blank"
                   style="width:32px;height:32px;border-radius:8px;background:#f1f5f0;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:14px;text-decoration:none;transition:all .15s;"
                   onmouseover="this.style.background='#0077b5';this.style.color='#fff';this.style.borderColor='#0077b5'"
                   onmouseout="this.style.background='#f1f5f0';this.style.color='var(--text-muted)';this.style.borderColor='var(--border)'">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
                @endif
                @if($member->twitter)
                <a href="{{ $member->twitter }}" target="_blank"
                   style="width:32px;height:32px;border-radius:8px;background:#f1f5f0;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:14px;text-decoration:none;transition:all .15s;"
                   onmouseover="this.style.background='#000';this.style.color='#fff';this.style.borderColor='#000'"
                   onmouseout="this.style.background='#f1f5f0';this.style.color='var(--text-muted)';this.style.borderColor='var(--border)'">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                @endif
            </div>

            {{-- Actions --}}
            <div style="display:flex;gap:8px;border-top:1px solid var(--border);padding-top:16px;">
                <a href="{{ route('admin.team.edit', $member) }}" class="btn btn-secondary btn-sm" style="flex:1;justify-content:center;">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                <form method="POST" action="{{ route('admin.team.destroy', $member) }}" onsubmit="return confirm('Delete {{ addslashes($member->name) }}?')">
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
