<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
class FaqController extends Controller {
    public function index() { return view('admin.faqs.index', ['faqs' => Faq::orderBy('order')->get()]); }
    public function create() { return view('admin.faqs.form', ['faq' => new Faq]); }
    public function store(Request $request) {
        $data = $request->validate(['question' => 'required|max:255', 'answer' => 'required', 'category' => 'nullable|max:100', 'order' => 'nullable|integer', 'status' => 'nullable|in:active,inactive']);
        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created.');
    }
    public function edit(Faq $faq) { return view('admin.faqs.form', compact('faq')); }
    public function update(Request $request, Faq $faq) {
        $data = $request->validate(['question' => 'required|max:255', 'answer' => 'required', 'category' => 'nullable|max:100', 'order' => 'nullable|integer', 'status' => 'nullable|in:active,inactive']);
        $faq->update($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated.');
    }
    public function destroy(Faq $faq) { $faq->delete(); return back()->with('success', 'FAQ deleted.'); }
    public function show(Faq $faq) { return redirect()->route('admin.faqs.index'); }
    public function toggle(Faq $faq) {
        $faq->update(['status' => $faq->status === 'active' ? 'inactive' : 'active']);
        return response()->json(['status' => $faq->status]);
    }
}
