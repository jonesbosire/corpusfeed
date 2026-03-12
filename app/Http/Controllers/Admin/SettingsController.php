<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SettingsController extends Controller {
    protected array $groups = ['general', 'homepage', 'contact', 'social', 'seo'];
    public function index(string $group = 'general') {
        $activeGroup = in_array($group, $this->groups) ? $group : 'general';
        $settingItems = Setting::where('group', $activeGroup)->orderBy('id')->get();
        return view('admin.settings.index', [
            'settingItems' => $settingItems,
            'groups'       => $this->groups,
            'activeGroup'  => $activeGroup,
        ]);
    }
    public function update(Request $request) {
        $group = $request->input('group', 'general');
        foreach ($request->input('settings', []) as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if (!$setting) continue;
            if ($setting->type === 'image') continue;
            $setting->update(['value' => $value]);
        }
        foreach ($request->allFiles()['settings'] ?? [] as $key => $file) {
            $setting = Setting::where('key', $key)->first();
            if (!$setting || $setting->type !== 'image') continue;
            if ($setting->value) Storage::disk('public')->delete($setting->value);
            $path = $file->store('settings', 'public');
            $setting->update(['value' => $path]);
        }
        return redirect()->route('admin.settings.index', $group)->with('success', 'Settings saved!');
    }
}
