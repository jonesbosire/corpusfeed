@extends('admin.layouts.app')
@section('title', 'Tags')
@section('content')
<div class="form-row cols-2" style="align-items:start;">
    <div class="card">
        <div class="card-header"><h2>All Tags</h2></div>
        <div class="table-wrapper">
            <table>
                <thead><tr><th>Name</th><th>Slug</th><th>Posts</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($tags as $tag)
                    <tr>
                        <td style="font-weight:500;">{{ $tag->name }}</td>
                        <td><code>{{ $tag->slug }}</code></td>
                        <td>{{ $tag->posts_count }}</td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-secondary btn-sm btn-icon"><i class="fa-solid fa-pen"></i></a>
                                <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center" style="color:#888;padding:32px;">No tags yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h2>{{ isset($tag) ? 'Edit Tag' : 'New Tag' }}</h2></div>
        <div class="card-body">
            <form method="POST" action="{{ isset($tag) ? route('admin.tags.update', $tag) : route('admin.tags.store') }}">
                @csrf
                @if(isset($tag)) @method('PUT') @endif
                <div class="form-group">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $tag->name ?? '') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div style="display:flex;gap:10px;">
                    <button type="submit" class="btn btn-primary">{{ isset($tag) ? 'Update' : 'Create' }}</button>
                    @if(isset($tag))
                    <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Cancel</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
