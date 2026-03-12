<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class PostTag extends Model {
    use Sluggable;
    protected $fillable = ['name', 'slug'];
    public function sluggable(): array { return ['slug' => ['source' => 'name']]; }
    public function posts() { return $this->belongsToMany(Post::class, 'post_tag', 'post_tag_id', 'post_id'); }
}
