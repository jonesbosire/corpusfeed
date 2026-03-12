<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model {
    use SoftDeletes, Sluggable;
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'featured_image', 'category_id', 'author_id', 'status', 'published_at', 'meta_title', 'meta_description'];
    protected $casts = ['published_at' => 'datetime'];
    public function sluggable(): array { return ['slug' => ['source' => 'title']]; }
    public function category() { return $this->belongsTo(PostCategory::class, 'category_id'); }
    public function author() { return $this->belongsTo(User::class, 'author_id'); }
    public function tags() { return $this->belongsToMany(PostTag::class, 'post_tag', 'post_id', 'post_tag_id'); }
    public function scopePublished($query) { return $query->where('status', 'published')->where('published_at', '<=', now()); }
    public function incrementViews() { $this->increment('views'); }
    public function getReadingTimeAttribute(): int { return max(1, (int) ceil(str_word_count(strip_tags($this->body)) / 200)); }
    public function getFeaturedImageUrlAttribute(): string { return $this->featured_image ? asset('storage/' . $this->featured_image) : asset('images/post-default.jpg'); }
}
