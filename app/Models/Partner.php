<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name', 'logo', 'url', 'order', 'status'];

    public function scopeActive($query) {
        return $query->where('status', 'active')->orderBy('order');
    }
}
