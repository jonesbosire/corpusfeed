<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Testimonial extends Model {
    protected $fillable = ['name', 'role', 'company', 'photo', 'content', 'rating', 'status'];
    public function scopeActive($query) { return $query->where('status', 'active'); }
    public function getPhotoUrlAttribute(): string { return $this->photo ? asset('storage/' . $this->photo) : asset('images/author-default.jpg'); }
}
