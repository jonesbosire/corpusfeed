@extends('admin.layouts.app')

@section('title', isset($post) ? 'Edit Post' : 'New Post')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@toast-ui/editor@3/dist/toastui-editor.min.css">
<style>
    .toastui-editor-defaultUI { border-radius: 8px; border: 2px solid #e0e0e0; }
    .toastui-editor-defaultUI:focus-within { border-color: var(--primary); }
</style>
@endpush

@section('content')

<form method="POST" action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}" enctype="multipart/form-data" id="postForm">
    @csrf
    @if(isset($post)) @method('PUT') @endif

    <div class="form-row cols-2" style="align-items:start;">
        <!-- Left Column: Main Content -->
        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="card">
                <div class="card-header">
                    <h2>Post Content</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" id="titleInput" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $post->title ?? '') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" id="slugInput" class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug', $post->slug ?? '') }}" placeholder="Auto-generated from title">
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Excerpt</label>
                        <textarea name="excerpt" class="form-control" rows="3" placeholder="Short description for listings">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Body *</label>
                        <div id="editor"></div>
                        <input type="hidden" name="body" id="bodyInput">
                        @error('body')<div class="invalid-feedback" style="display:block;">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="card">
                <div class="card-header"><h2>SEO</h2></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $post->meta_title ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Settings -->
        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="card">
                <div class="card-header"><h2>Publish</h2></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="draft" {{ old('status', $post->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $post->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="scheduled" {{ old('status', $post->status ?? '') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Published At</label>
                        <input type="datetime-local" name="published_at" class="form-control"
                            value="{{ old('published_at', isset($post->published_at) ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                    </div>
                    <div style="display:flex;gap:10px;margin-top:8px;">
                        <button type="submit" class="btn btn-primary" style="flex:1;">
                            <i class="fa-solid fa-floppy-disk"></i>
                            {{ isset($post) ? 'Update Post' : 'Save Post' }}
                        </button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2>Category &amp; Tags</h2></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">No Category</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tags</label>
                        <select name="tags[]" class="form-control" multiple style="height:120px;">
                            @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ in_array($tag->id, old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                            @endforeach
                        </select>
                        <div class="form-text">Hold Ctrl/Cmd to select multiple</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2>Featured Image</h2></div>
                <div class="card-body">
                    @if(isset($post) && $post->featured_image)
                    <div class="image-preview-wrap">
                        <img src="{{ asset('storage/'.$post->featured_image) }}" class="image-preview" id="imgPreview">
                    </div>
                    <label style="display:flex;align-items:center;gap:8px;margin-top:10px;font-size:13px;cursor:pointer;">
                        <input type="checkbox" name="remove_featured_image" value="1"> Remove image
                    </label>
                    @else
                    <div class="image-preview-wrap" id="previewWrap" style="display:none;">
                        <img id="imgPreview" class="image-preview">
                    </div>
                    @endif
                    <input type="file" name="featured_image" class="form-control" accept="image/*" id="imgUpload" style="margin-top:10px;" onchange="previewImg(this)">
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@toast-ui/editor@3/dist/toastui-editor-all.min.js"></script>
<script>
const editor = new toastui.Editor({
    el: document.querySelector('#editor'),
    height: '400px',
    initialEditType: 'wysiwyg',
    previewStyle: 'tab',
    initialValue: {!! json_encode(old('body', $post->body ?? '')) !!},
    toolbarItems: [
        ['heading', 'bold', 'italic', 'strike'],
        ['hr', 'quote'],
        ['ul', 'ol', 'task'],
        ['table', 'image', 'link'],
        ['code', 'codeblock'],
        ['scrollSync'],
    ],
});

document.getElementById('postForm').addEventListener('submit', function() {
    document.getElementById('bodyInput').value = editor.getHTML();
});

// Auto-slug from title
const titleInput = document.getElementById('titleInput');
const slugInput = document.getElementById('slugInput');
let slugManuallyEdited = slugInput.value !== '';

titleInput.addEventListener('input', function() {
    if (!slugManuallyEdited) {
        slugInput.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    }
});
slugInput.addEventListener('input', function() {
    slugManuallyEdited = this.value !== '';
});

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
