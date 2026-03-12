<?php
namespace App\Http\Controllers;
use App\Models\{Post, PostCategory, PostTag};
use Illuminate\Http\Request;
class PostController extends Controller {
    public function index(Request $request) {
        $query = Post::published()->with(["category", "author"])->latest("published_at");
        if ($request->category) {
            $query->whereHas("category", fn($q) => $q->where("slug", $request->category));
        }
        if ($request->tag) {
            $query->whereHas("tags", fn($q) => $q->where("slug", $request->tag));
        }
        if ($request->search) {
            $query->where("title", "like", "%" . $request->search . "%");
        }
        $categories  = PostCategory::withCount(["posts" => fn($q) => $q->published()])->having("posts_count", ">", 0)->get();
        $recentPosts = Post::published()->latest("published_at")->take(5)->get();
        return view("pages.blog.index", [
            "posts"       => $query->paginate(9),
            "categories"  => $categories,
            "recentPosts" => $recentPosts,
        ]);
    }
    public function show(Post $post) {
        abort_unless($post->status === "published" && $post->published_at <= now(), 404);
        $relatedPosts = Post::published()
            ->where("id", "!=", $post->id)
            ->where("category_id", $post->category_id)
            ->latest("published_at")->take(2)->get();
        $categories  = PostCategory::withCount(["posts" => fn($q) => $q->published()])->having("posts_count", ">", 0)->get();
        $recentPosts = Post::published()->where("id", "!=", $post->id)->latest("published_at")->take(5)->get();
        return view("pages.blog.show", compact("post", "relatedPosts", "categories", "recentPosts"));
    }
}
