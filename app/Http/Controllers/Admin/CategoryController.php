<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
class CategoryController extends Controller {
    private function list() { return PostCategory::withCount('posts')->get(); }
    public function index() { return view('admin.categories.index', ['categories' => $this->list()]); }
    public function create() { return view('admin.categories.index', ['categories' => $this->list()]); }
    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:100|unique:post_categories,name']);
        PostCategory::create($request->only('name', 'description'));
        return back()->with('success', 'Category created.');
    }
    public function edit(PostCategory $category) {
        return view('admin.categories.index', ['categories' => $this->list(), 'category' => $category]);
    }
    public function update(Request $request, PostCategory $category) {
        $request->validate(['name' => 'required|string|max:100|unique:post_categories,name,' . $category->id]);
        $category->update($request->only('name', 'description'));
        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }
    public function destroy(PostCategory $category) {
        $category->delete();
        return back()->with('success', 'Category deleted.');
    }
    public function show(PostCategory $category) { return redirect()->route('admin.categories.index'); }
}
