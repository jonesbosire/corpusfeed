<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeamMember extends Model {
    protected $fillable = ['name', 'role', 'bio', 'photo', 'email', 'linkedin', 'twitter', 'order', 'status'];
    public function scopeActive($query) { return $query->where('status', 'active')->orderBy('order'); }
    public function getPhotoUrlAttribute(): string { return $this->photo ? asset('storage/' . $this->photo) : asset('images/team-default.jpg'); }
}
