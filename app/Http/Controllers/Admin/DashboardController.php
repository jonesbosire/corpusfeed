<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Post, ContactMessage, NewsletterSubscriber, Service, TeamMember, Testimonial, Faq};
class DashboardController extends Controller {
    public function index() {
        return view("admin.dashboard", [
            "stats" => [
                "posts"           => Post::where("status", "published")->count(),
                "drafts"          => Post::where("status", "draft")->count(),
                "services"        => Service::where("status", "active")->count(),
                "team"            => TeamMember::where("status", "active")->count(),
                "testimonials"    => Testimonial::where("status", "active")->count(),
                "faqs"            => Faq::where("status", "active")->count(),
                "unread_messages" => ContactMessage::where("status", "unread")->count(),
                "total_messages"  => ContactMessage::count(),
                "subscribers"     => NewsletterSubscriber::where("status", "active")->count(),
            ],
            "recentPosts"    => Post::with("author")->latest()->take(5)->get(),
            "recentMessages" => ContactMessage::latest()->take(5)->get(),
        ]);
    }
}
