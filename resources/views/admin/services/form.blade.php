@extends('admin.layouts.app')
@section('title', isset($service) ? 'Edit Service' : 'New Service')

@push('styles')
<style>
#bodyInput { width:100%; min-height:320px; padding:12px; border:1px solid #ddd; border-radius:6px; font-size:14px; line-height:1.6; font-family:inherit; resize:vertical; }
</style>
@endpush

@section('content')
<form method="POST" action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" enctype="multipart/form-data" id="svcForm">
    @csrf
    @if(isset($service)) @method('PUT') @endif

    <div class="form-row cols-2" style="align-items:start;">
        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="card">
                <div class="card-header"><h2>Service Details</h2></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $service->title ?? '') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Icon Class <span style="font-weight:400;color:#888;">(Font Awesome, e.g. fa-leaf)</span></label>
                        <input type="text" name="icon" class="form-control" placeholder="fa-leaf"
                            value="{{ old('icon', $service->icon ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $service->short_description ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Full Description</label>
                        <textarea name="body" id="bodyInput" placeholder="Enter full description here...">{{ old('body', $service->body ?? '') }}</textarea>
                    </div>
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
                            <option value="active" {{ old('status', $service->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $service->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $service->order ?? 0) }}" min="0">
                    </div>
                    <div style="display:flex;gap:10px;margin-top:8px;">
                        <button type="submit" class="btn btn-primary" style="flex:1;">
                            <i class="fa-solid fa-floppy-disk"></i> {{ isset($service) ? 'Update' : 'Save' }}
                        </button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2>Featured Image</h2></div>
                <div class="card-body">
                    @if(isset($service) && $service->featured_image)
                    <img src="{{ asset('storage/'.$service->featured_image) }}" class="image-preview" id="imgPreview">
                    <label style="display:flex;align-items:center;gap:8px;margin-top:10px;font-size:13px;cursor:pointer;">
                        <input type="checkbox" name="remove_featured_image" value="1"> Remove image
                    </label>
                    @else
                    <div id="previewWrap" style="display:none;margin-bottom:10px;">
                        <img id="imgPreview" class="image-preview">
                    </div>
                    @endif
                    <input type="file" name="featured_image" class="form-control" accept="image/*" onchange="previewImg(this)">
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
