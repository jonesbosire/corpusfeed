<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
class MessageController extends Controller {
    public function index(Request $request) {
        $query = ContactMessage::latest();
        if ($request->status) $query->where('status', $request->status);
        return view('admin.messages.index', ['messages' => $query->paginate(20)]);
    }
    public function show(ContactMessage $message) {
        $message->markAsRead();
        return view('admin.messages.show', compact('message'));
    }
    public function updateStatus(Request $request, ContactMessage $message) {
        $request->validate(['status' => 'required|in:unread,read,replied']);
        $message->update(['status' => $request->status]);
        return back()->with('success', 'Status updated.');
    }
    public function destroy(ContactMessage $message) { $message->delete(); return back()->with('success', 'Message deleted.'); }
}
