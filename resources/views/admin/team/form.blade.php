@extends('admin.layouts.app')
@section('title', isset($member) ? 'Edit Team Member' : 'New Team Member')
@section('content')
<form method="POST" action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}" enctype="multipart/form-data">
    @csrf
    @if($member->exists) @method('PUT') @endif

    <div class="form-row cols-2" style="align-items:start;">
        <div class="card">
            <div class="card-header"><h2>Member Info</h2></div>
            <div class="card-body">
                <div class="form-row cols-2">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $member->name ?? '') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role / Title *</label>
                        <input type="text" name="role" class="form-control @error('role') is-invalid @enderror"
                            value="{{ old('role', $member->role ?? '') }}" required>
                        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="4">{{ old('bio', $member->bio ?? '') }}</textarea>
                </div>
                <div class="form-row cols-2">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $member->email ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $member->linkedin ?? '') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Twitter URL</label>
                    <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $member->twitter ?? '') }}">
                </div>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="card">
                <div class="card-header"><h2>Settings</h2></div>
                <div class="card-body">
                    <div class="form-row cols-2">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ old('status', $member->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $member->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="order" class="form-control" value="{{ old('order', $member->order ?? 0) }}" min="0">
                        </div>
                    </div>
                    <div style="display:flex;gap:10px;">
                        <button type="submit" class="btn btn-primary" style="flex:1;">
                            <i class="fa-solid fa-floppy-disk"></i> {{ isset($member) ? 'Update' : 'Save' }}
                        </button>
                        <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2>Photo</h2></div>
                <div class="card-body">
                    @if($member->exists && $member->photo)
                    <img src="{{ asset('storage/'.$member->photo) }}" class="image-preview" id="imgPreview">
                    <label style="display:flex;align-items:center;gap:8px;margin-top:10px;font-size:13px;cursor:pointer;">
                        <input type="checkbox" name="remove_photo" value="1"> Remove photo
                    </label>
                    @else
                    <div id="previewWrap" style="display:none;margin-bottom:10px;"><img id="imgPreview" class="image-preview"></div>
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*" style="margin-top:10px;" onchange="previewImg(this)">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('scripts')
<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('imgPreview');
            const wrap = document.getElementById('previewWrap');
            img.src = e.target.result;
            if (wrap) wrap.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
