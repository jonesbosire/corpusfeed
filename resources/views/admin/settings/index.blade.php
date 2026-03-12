@extends('admin.layouts.app')
@section('title', 'Settings')
@section('content')

<div style="display:flex;gap:24px;align-items:start;">
    <!-- Group Tabs -->
    <div class="card" style="min-width:200px;">
        <div class="card-header"><h2>Groups</h2></div>
        <div style="padding:8px 0;">
            @foreach($groups as $grp)
            <a href="{{ route('admin.settings.index', $grp) }}"
               style="display:block;padding:10px 20px;font-size:14px;text-decoration:none;color:{{ $activeGroup === $grp ? '#fff' : 'var(--text)' }};background:{{ $activeGroup === $grp ? 'var(--primary)' : 'transparent' }};transition:all .15s;">
                {{ ucfirst($grp) }}
            </a>
            @endforeach
        </div>
    </div>

    <!-- Settings Form -->
    <div class="card" style="flex:1;">
        <div class="card-header">
            <h2>{{ ucfirst($activeGroup) }} Settings</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf
                @foreach($settingItems as $setting)
                <div class="form-group">
                    <label class="form-label">{{ $setting->label }}</label>
                    @if($setting->type === 'image')
                        @if($setting->value)
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/'.$setting->value) }}" style="max-width:200px;max-height:100px;object-fit:contain;border:2px solid var(--border);border-radius:8px;padding:4px;">
                        </div>
                        @endif
                        <input type="file" name="settings[{{ $setting->key }}]" class="form-control" accept="image/*">
                    @elseif($setting->type === 'textarea')
                        <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="4">{{ old('settings.'.$setting->key, $setting->value) }}</textarea>
                    @elseif($setting->type === 'boolean')
                        <select name="settings[{{ $setting->key }}]" class="form-control">
                            <option value="1" {{ $setting->value ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$setting->value ? 'selected' : '' }}>No</option>
                        </select>
                    @else
                        <input type="text" name="settings[{{ $setting->key }}]" class="form-control"
                            value="{{ old('settings.'.$setting->key, $setting->value) }}">
                    @endif
                    @if($setting->help_text)
                    <div class="form-text">{{ $setting->help_text }}</div>
                    @endif
                </div>
                @endforeach

                <input type="hidden" name="group" value="{{ $activeGroup }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Save Settings
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
