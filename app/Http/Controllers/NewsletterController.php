<?php
namespace App\Http\Controllers;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
class NewsletterController extends Controller {
    public function subscribe(Request $request) {
        $request->validate(['email' => 'required|email|max:100']);
        $existing = NewsletterSubscriber::where('email', $request->email)->first();
        if ($existing) {
            if ($existing->status === 'unsubscribed') {
                $existing->update(['status' => 'active', 'confirmed_at' => now()]);
                $msg = 'Welcome back! You have been re-subscribed.';
            } else {
                $msg = 'You are already subscribed!';
            }
        } else {
            NewsletterSubscriber::create([
                'email'        => $request->email,
                'name'         => $request->name ?? null,
                'status'       => 'active',
                'confirmed_at' => now(),
            ]);
            $msg = 'Thank you for subscribing!';
        }
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => $msg]);
        }
        return back()->with('newsletter_success', $msg);
    }
}
