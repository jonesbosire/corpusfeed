<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
class Service extends Model {
    use SoftDeletes, Sluggable;
    protected $fillable = ['title', 'slug', 'short_description', 'body', 'icon', 'featured_image', 'order', 'status'];
    public function sluggable(): array { return ['slug' => ['source' => 'title']]; }
    public function scopeActive($query) { return $query->where('status', 'active')->orderBy('order'); }
    public function getFeaturedImageUrlAttribute(): string { return $this->featured_image ? asset('storage/' . $this->featured_image) : asset('images/service-default.jpg'); }
}
