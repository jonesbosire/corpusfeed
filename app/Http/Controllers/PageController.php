<?php
namespace App\Http\Controllers;
use App\Models\{TeamMember, Faq, Post, Service, Setting};
use Illuminate\Support\Facades\Response;
class PageController extends Controller {
    public function about() {
        return view('pages.about', [
            'teamMembers' => TeamMember::active()->take(8)->get(),
        ]);
    }
    public function team() {
        return view('pages.team', [
            'teamMembers' => TeamMember::active()->get(),
        ]);
    }
    public function faqs() {
        return view('pages.faqs', [
            'faqs' => Faq::active()->get(),
        ]);
    }
    public function sitemap() {
        $posts    = Post::published()->latest('published_at')->get();
        $services = Service::active()->get();
        $content  = view('pages.sitemap', compact('posts', 'services'))->render();
        return Response::make($content, 200, ['Content-Type' => 'application/xml']);
    }
    public function robots() {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: " . url('/sitemap.xml');
        return Response::make($content, 200, ['Content-Type' => 'text/plain']);
    }
}
