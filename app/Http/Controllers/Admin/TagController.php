<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PostTag;
use Illuminate\Http\Request;
class TagController extends Controller {
    private function list() { return PostTag::withCount('posts')->get(); }
    public function index() { return view('admin.tags.index', ['tags' => $this->list()]); }
    public function create() { return view('admin.tags.index', ['tags' => $this->list()]); }
    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:100|unique:post_tags,name']);
        PostTag::create($request->only('name'));
        return back()->with('success', 'Tag created.');
    }
    public function edit(PostTag $tag) {
        return view('admin.tags.index', ['tags' => $this->list(), 'tag' => $tag]);
    }
    public function update(Request $request, PostTag $tag) {
        $request->validate(['name' => 'required|string|max:100|unique:post_tags,name,' . $tag->id]);
        $tag->update($request->only('name'));
        return redirect()->route('admin.tags.index')->with('success', 'Tag updated.');
    }
    public function destroy(PostTag $tag) {
        $tag->delete();
        return back()->with('success', 'Tag deleted.');
    }
    public function show(PostTag $tag) { return redirect()->route('admin.tags.index'); }
}
