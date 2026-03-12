<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TestimonialController extends Controller {
    public function index() { return view('admin.testimonials.index', ['testimonials' => Testimonial::latest()->get()]); }
    public function create() { return view('admin.testimonials.form', ['testimonial' => new Testimonial]); }
    public function store(Request $request) {
        $data = $request->validate(['name' => 'required|max:100', 'role' => 'nullable|max:100', 'company' => 'nullable|max:100', 'content' => 'required', 'rating' => 'nullable|integer|min:1|max:5', 'photo' => 'nullable|image|max:2048', 'status' => 'nullable|in:active,inactive']);
        if ($request->hasFile('photo')) $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added.');
    }
    public function edit(Testimonial $testimonial) { return view('admin.testimonials.form', compact('testimonial')); }
    public function update(Request $request, Testimonial $testimonial) {
        $data = $request->validate(['name' => 'required|max:100', 'role' => 'nullable|max:100', 'company' => 'nullable|max:100', 'content' => 'required', 'rating' => 'nullable|integer|min:1|max:5', 'photo' => 'nullable|image|max:2048', 'status' => 'nullable|in:active,inactive']);
        if ($request->hasFile('photo')) { if ($testimonial->photo) Storage::disk('public')->delete($testimonial->photo); $data['photo'] = $request->file('photo')->store('testimonials', 'public'); }
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated.');
    }
    public function destroy(Testimonial $testimonial) { $testimonial->delete(); return back()->with('success', 'Testimonial deleted.'); }
    public function show(Testimonial $t) { return redirect()->route('admin.testimonials.index'); }
    public function toggle(Testimonial $testimonial) {
        $testimonial->update(['status' => $testimonial->status === 'active' ? 'inactive' : 'active']);
        return response()->json(['status' => $testimonial->status]);
    }
}
