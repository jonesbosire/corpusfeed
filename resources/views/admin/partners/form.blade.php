@extends('admin.layouts.app')
@section('title', $partner->exists ? 'Edit Partner' : 'New Partner')
@section('content')

<form method="POST"
      action="{{ $partner->exists ? route('admin.partners.update', $partner) : route('admin.partners.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($partner->exists) @method('PUT') @endif

    <div class="form-row cols-2" style="align-items:start;">

        {{-- Left: main details --}}
        <div class="card">
            <div class="card-header"><h2>Partner Details</h2></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Partner / Organisation Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $partner->name ?? '') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Website URL <span style="font-weight:400;color:#888;">(optional)</span></label>
                    <input type="url" name="url" class="form-control @error('url') is-invalid @enderror"
                           placeholder="https://example.com"
                           value="{{ old('url', $partner->url ?? '') }}">
                    @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Right: settings + logo --}}
        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="card">
                <div class="card-header"><h2>Settings</h2></div>
                <div class="card-body">
                    <div class="form-row cols-2">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="active"   {{ old('status', $partner->status ?? 'active')   === 'active'   ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $partner->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="order" class="form-control"
                                   value="{{ old('order', $partner->order ?? 0) }}" min="0">
                        </div>
                    </div>
                    <div style="display:flex;gap:10px;">
                        <button type="submit" class="btn btn-primary" style="flex:1;">
                            <i class="fa-solid fa-floppy-disk"></i> {{ $partner->exists ? 'Update' : 'Save' }}
                        </button>
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2>Logo</h2></div>
                <div class="card-body">
                    @if($partner->exists && $partner->logo)
                    <div style="background:#f7faf6;border-radius:8px;padding:16px;text-align:center;margin-bottom:12px;border:1px solid var(--border);">
                        <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}"
                             id="imgPreview" style="max-height:80px;max-width:100%;object-fit:contain;">
                    </div>
                    @else
                    <div id="previewWrap" style="display:none;background:#f7faf6;border-radius:8px;padding:16px;text-align:center;margin-bottom:12px;border:1px solid var(--border);">
                        <img id="imgPreview" style="max-height:80px;max-width:100%;object-fit:contain;">
                    </div>
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*"
                           onchange="previewImg(this)"
                           {{ $partner->exists ? '' : 'required' }}>
                    <p style="font-size:12px;color:var(--text-muted);margin-top:6px;">
                        PNG, SVG or WebP recommended. Transparent background works best.
                    </p>
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
