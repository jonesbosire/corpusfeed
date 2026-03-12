<?php
namespace App\Http\Controllers;
use App\Models\{Post, Service, TeamMember, Testimonial, Setting, Partner};
class HomeController extends Controller {
    public function index() {
        return view('pages.home', [
            'latestPosts'   => Post::published()->with('category')->latest('published_at')->take(3)->get(),
            'services'      => Service::active()->take(6)->get(),
            'teamMembers'   => TeamMember::active()->take(4)->get(),
            'testimonials'  => Testimonial::active()->inRandomOrder()->take(6)->get(),
            'partners'      => Partner::active()->get(),
        ]);
    }
}
