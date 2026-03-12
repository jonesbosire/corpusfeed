<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller {
    public function index() {
        return view('admin.services.index', ['services' => Service::withTrashed()->orderBy('order')->get()]);
    }
    public function create() { return view('admin.services.form'); }
    public function store(Request $request) {
        $data = $request->validate([
            'title'             => 'required|max:255',
            'icon'              => 'nullable|max:100',
            'short_description' => 'nullable',
            'body'              => 'nullable',
            'featured_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'order'             => 'nullable|integer',
            'status'            => 'nullable|in:active,inactive',
        ]);
        if ($request->hasFile('featured_image'))
            $data['featured_image'] = $request->file('featured_image')->store('services', 'public');
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }
    public function edit(Service $service) { return view('admin.services.form', compact('service')); }
    public function update(Request $request, Service $service) {
        $data = $request->validate([
            'title'             => 'required|max:255',
            'icon'              => 'nullable|max:100',
            'short_description' => 'nullable',
            'body'              => 'nullable',
            'featured_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'order'             => 'nullable|integer',
            'status'            => 'nullable|in:active,inactive',
        ]);
        if ($request->hasFile('featured_image')) {
            if ($service->featured_image) Storage::disk('public')->delete($service->featured_image);
            $data['featured_image'] = $request->file('featured_image')->store('services', 'public');
        } elseif ($request->boolean('remove_featured_image') && $service->featured_image) {
            Storage::disk('public')->delete($service->featured_image);
            $data['featured_image'] = null;
        }
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }
    public function destroy(Service $service) { $service->delete(); return back()->with('success', 'Service deleted.'); }
    public function show(Service $service) { return redirect()->route('admin.services.index'); }
    public function toggle(Service $service) {
        $service->update(['status' => $service->status === 'active' ? 'inactive' : 'active']);
        return response()->json(['status' => $service->status]);
    }
}
