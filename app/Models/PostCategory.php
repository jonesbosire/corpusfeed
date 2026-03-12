<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class PostCategory extends Model {
    use Sluggable;
    protected $fillable = ['name', 'slug', 'description'];
    public function sluggable(): array { return ['slug' => ['source' => 'name']]; }
    public function posts() { return $this->hasMany(Post::class, 'category_id'); }
}
