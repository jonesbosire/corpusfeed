<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Post, PostCategory, PostTag};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller {
    public function index(Request $request) {
        $query = Post::with(['category', 'author'])->latest();
        if ($request->status) $query->where('status', $request->status);
        if ($request->search) $query->where('title', 'like', '%' . $request->search . '%');
        return view('admin.posts.index', [
            'posts'      => $query->paginate(15),
            'categories' => PostCategory::all(),
        ]);
    }

    public function create() {
        return view('admin.posts.form', [
            'post'       => new Post,
            'categories' => PostCategory::orderBy('name')->get(),
            'tags'       => PostTag::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request) {
        $data = $this->validatePost($request);
        $data['author_id'] = auth()->id();
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }
        $post = Post::create($data);
        if ($request->has('tags')) $post->tags()->sync($request->tags ?? []);
        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post) {
        return view('admin.posts.form', [
            'post'       => $post->load('tags'),
            'categories' => PostCategory::orderBy('name')->get(),
            'tags'       => PostTag::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Post $post) {
        $data = $this->validatePost($request, $post->id);
        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) Storage::disk('public')->delete($post->featured_image);
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        } elseif ($request->boolean('remove_featured_image') && $post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
            $data['featured_image'] = null;
        }
        $post->update($data);
        if ($request->has('tags')) $post->tags()->sync($request->tags ?? []);
        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post) {
        if ($post->featured_image) Storage::disk('public')->delete($post->featured_image);
        $post->delete();
        return back()->with('success', 'Post deleted.');
    }

    public function show(Post $post) { return redirect()->route('admin.posts.index'); }

    protected function validatePost(Request $request, $id = null): array {
        return $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => ['nullable', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($id)],
            'excerpt'          => 'nullable|string|max:500',
            'body'             => 'required|string',
            'category_id'      => 'nullable|exists:post_categories,id',
            'status'           => 'required|in:draft,published,scheduled',
            'published_at'     => 'nullable|date',
            'featured_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'tags'             => 'nullable|array',
            'tags.*'           => 'exists:post_tags,id',
        ]);
    }
}
