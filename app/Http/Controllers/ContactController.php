<?php
namespace App\Http\Controllers;
use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
class ContactController extends Controller {
    public function index() {
        return view('pages.contact');
    }
    public function send(Request $request) {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|min:10|max:2000',
        ]);
        ContactMessage::create([...$data, 'ip_address' => $request->ip()]);
        try {
            Mail::to('corpusfeed@gmail.com')->send(new ContactFormMail($data));
        } catch (\Exception $e) {
            Log::error('Contact form email failed: ' . $e->getMessage());
        }
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Thank you! Your message has been received. We will get back to you shortly.']);
        }
        return back()->with('success', 'Thank you! Your message has been received. We will get back to you shortly.');
    }
}
