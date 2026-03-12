@extends('admin.layouts.app')
@section('title', isset($user) ? 'Edit User' : 'New User')
@section('content')
<div class="card" style="max-width:560px;">
    <div class="card-header"><h2>{{ isset($user) ? 'Edit User' : 'New User' }}</h2></div>
    <div class="card-body">
        <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}">
            @csrf
            @if(isset($user)) @method('PUT') @endif
            <div class="form-group">
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name ?? '') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email ?? '') }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Role *</label>
                <select name="role" class="form-control">
                    <option value="editor" {{ old('role', $user->role ?? 'editor') === 'editor' ? 'selected' : '' }}>Editor</option>
                    <option value="super_admin" {{ old('role', $user->role ?? '') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Password {{ isset($user) ? '(leave blank to keep current)' : '*' }}</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    {{ isset($user) ? '' : 'required' }}>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> {{ isset($user) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
