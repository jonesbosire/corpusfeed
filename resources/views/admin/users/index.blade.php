@extends('admin.layouts.app')
@section('title', 'Admin Users')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Admin Users</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add User</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Joined</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td style="font-weight:500;">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge {{ $user->role === 'super_admin' ? 'badge-danger' : 'badge-info' }}">{{ str_replace('_', ' ', $user->role) }}</span></td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary btn-sm btn-icon"><i class="fa-solid fa-pen"></i></a>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center" style="padding:32px;color:#888;">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
