<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ContactMessage extends Model {
    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'status', 'ip_address'];
    public function markAsRead(): void { $this->update(['status' => 'read']); }
    public function markAsReplied(): void { $this->update(['status' => 'replied']); }
}
