@extends('admin.layouts.app')
@section('title', isset($faq) ? 'Edit FAQ' : 'New FAQ')
@section('content')
<div class="card" style="max-width:760px;">
    <div class="card-header"><h2>{{ isset($faq) ? 'Edit FAQ' : 'New FAQ' }}</h2></div>
    <div class="card-body">
        <form method="POST" action="{{ isset($faq) ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}">
            @csrf
            @if(isset($faq)) @method('PUT') @endif
            <div class="form-group">
                <label class="form-label">Question *</label>
                <input type="text" name="question" class="form-control @error('question') is-invalid @enderror"
                    value="{{ old('question', $faq->question ?? '') }}" required>
                @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Answer *</label>
                <textarea name="answer" class="form-control @error('answer') is-invalid @enderror" rows="5" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-row cols-3">
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $faq->category ?? '') }}" placeholder="e.g. General">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ old('status', $faq->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $faq->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $faq->order ?? 0) }}" min="0">
                </div>
            </div>
            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> {{ isset($faq) ? 'Update' : 'Save' }}</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
