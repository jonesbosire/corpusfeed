<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
class SubscriberController extends Controller {
    public function index(Request $request) {
        $query = NewsletterSubscriber::latest();
        if ($request->status) $query->where('status', $request->status);
        return view('admin.subscribers.index', ['subscribers' => $query->paginate(20)]);
    }
    public function export() {
        $subscribers = NewsletterSubscriber::active()->get();
        $csv = "Name,Email,Subscribed At\n";
        foreach ($subscribers as $s) {
            $csv .= "\"{$s->name}\",\"{$s->email}\",\"{$s->confirmed_at}\"\n";
        }
        return Response::make($csv, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="subscribers.csv"',
        ]);
    }
    public function destroy(NewsletterSubscriber $subscriber) { $subscriber->delete(); return back()->with('success', 'Subscriber removed.'); }
}
