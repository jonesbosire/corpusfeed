<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin;

// ─── Public Frontend ─────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/team', [PageController::class, 'team'])->name('team');
Route::get('/faqs', [PageController::class, 'faqs'])->name('faqs');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])
    ->middleware(\App\Http\Middleware\TrackPostViews::class)
    ->name('blog.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])
    ->middleware('throttle:5,1')
    ->name('contact.send');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->middleware('throttle:3,1')
    ->name('newsletter.subscribe');

// SEO
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [PageController::class, 'robots'])->name('robots');

// ─── Admin Auth ───────────────────────────────────────────────────────────────
Route::get('/admin/login', [Admin\AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [Admin\AuthController::class, 'login'])
    ->middleware('throttle:6,1')
    ->name('admin.login.post');
Route::post('/admin/logout', [Admin\AuthController::class, 'logout'])->name('admin.logout');

// ─── Admin Panel ──────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('profile', [Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [Admin\ProfileController::class, 'update'])->name('profile.update');

    // Blog
    Route::resource('posts', Admin\PostController::class);
    Route::resource('categories', Admin\CategoryController::class);
    Route::resource('tags', Admin\TagController::class);

    // Content
    Route::resource('services', Admin\ServiceController::class);
    Route::resource('team', Admin\TeamMemberController::class);
    Route::resource('testimonials', Admin\TestimonialController::class);
    Route::resource('faqs', Admin\FaqController::class);
    Route::resource('partners', Admin\PartnerController::class)->except(['show']);

    // Quick status toggle (AJAX)
    Route::patch('services/{service}/toggle', [Admin\ServiceController::class, 'toggle'])->name('services.toggle');
    Route::patch('team/{team}/toggle', [Admin\TeamMemberController::class, 'toggle'])->name('team.toggle');
    Route::patch('testimonials/{testimonial}/toggle', [Admin\TestimonialController::class, 'toggle'])->name('testimonials.toggle');
    Route::patch('faqs/{faq}/toggle', [Admin\FaqController::class, 'toggle'])->name('faqs.toggle');

    // Communications
    Route::get('messages', [Admin\MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [Admin\MessageController::class, 'show'])->name('messages.show');
    Route::patch('messages/{message}/status', [Admin\MessageController::class, 'updateStatus'])->name('messages.updateStatus');
    Route::delete('messages/{message}', [Admin\MessageController::class, 'destroy'])->name('messages.destroy');

    // Subscribers (export must be before {subscriber} wildcard)
    Route::get('subscribers', [Admin\SubscriberController::class, 'index'])->name('subscribers.index');
    Route::get('subscribers/export', [Admin\SubscriberController::class, 'export'])->name('subscribers.export');
    Route::delete('subscribers/{subscriber}', [Admin\SubscriberController::class, 'destroy'])->name('subscribers.destroy');

    // Settings
    Route::get('settings/{group?}', [Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [Admin\SettingsController::class, 'update'])->name('settings.update');

    // Media
    Route::post('media/upload', [Admin\MediaController::class, 'upload'])->name('media.upload');

    // Users (super_admin only)
    Route::middleware('can:manage-users')->group(function () {
        Route::resource('users', Admin\UserController::class);
    });
});
