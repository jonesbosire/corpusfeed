@extends('admin.layouts.app')
@section('title', 'Categories')
@section('content')
<div class="form-row cols-2" style="align-items:start;">
    <div class="card">
        <div class="card-header"><h2>All Categories</h2></div>
        <div class="table-wrapper">
            <table>
                <thead><tr><th>Name</th><th>Slug</th><th>Posts</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($categories as $cat)
                    <tr>
                        <td style="font-weight:500;">{{ $cat->name }}</td>
                        <td><code>{{ $cat->slug }}</code></td>
                        <td>{{ $cat->posts_count }}</td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-secondary btn-sm btn-icon"><i class="fa-solid fa-pen"></i></a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center" style="color:#888;padding:32px;">No categories yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h2>{{ isset($category) ? 'Edit Category' : 'New Category' }}</h2></div>
        <div class="card-body">
            <form method="POST" action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
                @csrf
                @if(isset($category)) @method('PUT') @endif
                <div class="form-group">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $category->name ?? '') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description ?? '') }}</textarea>
                </div>
                <div style="display:flex;gap:10px;">
                    <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Create' }}</button>
                    @if(isset($category))
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
