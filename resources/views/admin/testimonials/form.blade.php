@extends('admin.layouts.app')
@section('title', isset($testimonial) ? 'Edit Testimonial' : 'New Testimonial')
@section('content')
<form method="POST" action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($testimonial)) @method('PUT') @endif

    <div class="form-row cols-2" style="align-items:start;">
        <div class="card">
            <div class="card-header"><h2>Testimonial</h2></div>
            <div class="card-body">
                <div class="form-row cols-2">
                    <div class="form-group">
                        <label class="form-label">Client Name *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $testimonial->name ?? '') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <input type="text" name="role" class="form-control" value="{{ old('role', $testimonial->role ?? '') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Company</label>
                    <input type="text" name="company" class="form-control" value="{{ old('company', $testimonial->company ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Testimonial Content *</label>
                    <textarea name="content" class="form-control" rows="5" required>{{ old('content', $testimonial->content ?? '') }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Rating (1-5)</label>
                    <select name="rating" class="form-control">
                        @for($i=5;$i>=1;$i--)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="card">
                <div class="card-header"><h2>Settings</h2></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="active" {{ old('status', $testimonial->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $testimonial->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div style="display:flex;gap:10px;">
                        <button type="submit" class="btn btn-primary" style="flex:1;">
                            <i class="fa-solid fa-floppy-disk"></i> {{ isset($testimonial) ? 'Update' : 'Save' }}
                        </button>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2>Client Photo</h2></div>
                <div class="card-body">
                    @if(isset($testimonial) && $testimonial->photo)
                    <img src="{{ asset('storage/'.$testimonial->photo) }}" class="image-preview" id="imgPreview">
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
