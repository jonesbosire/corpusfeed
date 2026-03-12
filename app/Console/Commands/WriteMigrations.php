<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WriteMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:write-files {type=migrations}';
    protected $description = 'Write CMS source files';

    public function handle()
    {
        $type = $this->argument('type');
        if ($type === 'models') { $this->writeModels(); return; }
        if ($type === 'controllers') { $this->writeControllers(); return; }

        $base = database_path('migrations');

        $migrations = [

'2026_03_06_085428_create_settings_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'settings\', function (Blueprint $table) {
            $table->id();
            $table->string(\'key\')->unique();
            $table->longText(\'value\')->nullable();
            $table->string(\'type\')->default(\'text\');
            $table->string(\'group\')->default(\'general\');
            $table->string(\'label\')->nullable();
            $table->string(\'help_text\')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'settings\'); }
};
',

'2026_03_06_085428_create_post_categories_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'post_categories\', function (Blueprint $table) {
            $table->id();
            $table->string(\'name\');
            $table->string(\'slug\')->unique();
            $table->string(\'description\')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'post_categories\'); }
};
',

'2026_03_06_085429_create_post_tags_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'post_tags\', function (Blueprint $table) {
            $table->id();
            $table->string(\'name\');
            $table->string(\'slug\')->unique();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'post_tags\'); }
};
',

'2026_03_06_085429_create_posts_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'posts\', function (Blueprint $table) {
            $table->id();
            $table->string(\'title\');
            $table->string(\'slug\')->unique();
            $table->text(\'excerpt\')->nullable();
            $table->longText(\'body\');
            $table->string(\'featured_image\')->nullable();
            $table->foreignId(\'category_id\')->nullable()->constrained(\'post_categories\')->nullOnDelete();
            $table->foreignId(\'author_id\')->nullable()->constrained(\'users\')->nullOnDelete();
            $table->enum(\'status\', [\'draft\', \'published\', \'scheduled\'])->default(\'draft\');
            $table->timestamp(\'published_at\')->nullable();
            $table->string(\'meta_title\')->nullable();
            $table->text(\'meta_description\')->nullable();
            $table->unsignedBigInteger(\'views\')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void { Schema::dropIfExists(\'posts\'); }
};
',

'2026_03_06_085430_create_post_tag_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'post_tag\', function (Blueprint $table) {
            $table->foreignId(\'post_id\')->constrained()->cascadeOnDelete();
            $table->foreignId(\'post_tag_id\')->constrained(\'post_tags\')->cascadeOnDelete();
            $table->primary([\'post_id\', \'post_tag_id\']);
        });
    }
    public function down(): void { Schema::dropIfExists(\'post_tag\'); }
};
',

'2026_03_06_085430_create_services_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'services\', function (Blueprint $table) {
            $table->id();
            $table->string(\'title\');
            $table->string(\'slug\')->unique();
            $table->text(\'short_description\')->nullable();
            $table->longText(\'body\')->nullable();
            $table->string(\'icon\')->nullable();
            $table->string(\'featured_image\')->nullable();
            $table->unsignedInteger(\'order\')->default(0);
            $table->boolean(\'status\')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void { Schema::dropIfExists(\'services\'); }
};
',

'2026_03_06_085431_create_team_members_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'team_members\', function (Blueprint $table) {
            $table->id();
            $table->string(\'name\');
            $table->string(\'role\');
            $table->text(\'bio\')->nullable();
            $table->string(\'photo\')->nullable();
            $table->string(\'email\')->nullable();
            $table->string(\'linkedin\')->nullable();
            $table->string(\'twitter\')->nullable();
            $table->unsignedInteger(\'order\')->default(0);
            $table->boolean(\'status\')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'team_members\'); }
};
',

'2026_03_06_085431_create_testimonials_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'testimonials\', function (Blueprint $table) {
            $table->id();
            $table->string(\'name\');
            $table->string(\'role\')->nullable();
            $table->string(\'company\')->nullable();
            $table->string(\'photo\')->nullable();
            $table->text(\'content\');
            $table->unsignedTinyInteger(\'rating\')->default(5);
            $table->boolean(\'status\')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'testimonials\'); }
};
',

'2026_03_06_085432_create_faqs_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'faqs\', function (Blueprint $table) {
            $table->id();
            $table->string(\'question\');
            $table->text(\'answer\');
            $table->string(\'category\')->nullable();
            $table->unsignedInteger(\'order\')->default(0);
            $table->boolean(\'status\')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'faqs\'); }
};
',

'2026_03_06_085433_create_contact_messages_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'contact_messages\', function (Blueprint $table) {
            $table->id();
            $table->string(\'name\');
            $table->string(\'email\');
            $table->string(\'phone\')->nullable();
            $table->string(\'subject\')->nullable();
            $table->text(\'message\');
            $table->enum(\'status\', [\'unread\', \'read\', \'replied\'])->default(\'unread\');
            $table->string(\'ip_address\', 45)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'contact_messages\'); }
};
',

'2026_03_06_085433_create_newsletter_subscribers_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create(\'newsletter_subscribers\', function (Blueprint $table) {
            $table->id();
            $table->string(\'email\')->unique();
            $table->string(\'name\')->nullable();
            $table->enum(\'status\', [\'active\', \'unsubscribed\'])->default(\'active\');
            $table->timestamp(\'confirmed_at\')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists(\'newsletter_subscribers\'); }
};
',

'2026_03_06_085434_add_role_to_users_table.php' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::table(\'users\', function (Blueprint $table) {
            $table->enum(\'role\', [\'super_admin\', \'editor\'])->default(\'editor\')->after(\'email\');
        });
    }
    public function down(): void {
        Schema::table(\'users\', function (Blueprint $table) {
            $table->dropColumn(\'role\');
        });
    }
};
',

        ];

        foreach ($migrations as $filename => $content) {
            file_put_contents($base . DIRECTORY_SEPARATOR . $filename, $content);
            $this->info("Written: $filename");
        }

        $this->info('All migrations written successfully!');
    }

    protected function writeModels()
    {
        $base = app_path('Models');
        $models = [

'Setting.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model {
    protected $fillable = [\'key\', \'value\', \'type\', \'group\', \'label\', \'help_text\'];
    public static function get(string $key, $default = null) {
        $s = static::where(\'key\', $key)->first();
        return $s ? $s->value : $default;
    }
    public static function set(string $key, $value): void {
        static::updateOrCreate([\'key\' => $key], [\'value\' => $value]);
    }
}
',

'PostCategory.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class PostCategory extends Model {
    use Sluggable;
    protected $fillable = [\'name\', \'slug\', \'description\'];
    public function sluggable(): array { return [\'slug\' => [\'source\' => \'name\']]; }
    public function posts() { return $this->hasMany(Post::class, \'category_id\'); }
}
',

'PostTag.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class PostTag extends Model {
    use Sluggable;
    protected $fillable = [\'name\', \'slug\'];
    public function sluggable(): array { return [\'slug\' => [\'source\' => \'name\']]; }
    public function posts() { return $this->belongsToMany(Post::class, \'post_tag\', \'post_tag_id\', \'post_id\'); }
}
',

'Post.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model {
    use SoftDeletes, Sluggable;
    protected $fillable = [\'title\', \'slug\', \'excerpt\', \'body\', \'featured_image\', \'category_id\', \'author_id\', \'status\', \'published_at\', \'meta_title\', \'meta_description\'];
    protected $casts = [\'published_at\' => \'datetime\'];
    public function sluggable(): array { return [\'slug\' => [\'source\' => \'title\']]; }
    public function category() { return $this->belongsTo(PostCategory::class, \'category_id\'); }
    public function author() { return $this->belongsTo(User::class, \'author_id\'); }
    public function tags() { return $this->belongsToMany(PostTag::class, \'post_tag\', \'post_id\', \'post_tag_id\'); }
    public function scopePublished($query) { return $query->where(\'status\', \'published\')->where(\'published_at\', \'<=\', now()); }
    public function incrementViews() { $this->increment(\'views\'); }
    public function getReadingTimeAttribute(): int { return max(1, (int) ceil(str_word_count(strip_tags($this->body)) / 200)); }
    public function getFeaturedImageUrlAttribute(): string { return $this->featured_image ? asset(\'storage/\' . $this->featured_image) : asset(\'images/post-default.jpg\'); }
}
',

'Service.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
class Service extends Model {
    use SoftDeletes, Sluggable;
    protected $fillable = [\'title\', \'slug\', \'short_description\', \'body\', \'icon\', \'featured_image\', \'order\', \'status\'];
    public function sluggable(): array { return [\'slug\' => [\'source\' => \'title\']]; }
    public function scopeActive($query) { return $query->where(\'status\', true)->orderBy(\'order\'); }
    public function getFeaturedImageUrlAttribute(): string { return $this->featured_image ? asset(\'storage/\' . $this->featured_image) : asset(\'images/service-default.jpg\'); }
}
',

'TeamMember.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeamMember extends Model {
    protected $fillable = [\'name\', \'role\', \'bio\', \'photo\', \'email\', \'linkedin\', \'twitter\', \'order\', \'status\'];
    public function scopeActive($query) { return $query->where(\'status\', true)->orderBy(\'order\'); }
    public function getPhotoUrlAttribute(): string { return $this->photo ? asset(\'storage/\' . $this->photo) : asset(\'images/team-default.jpg\'); }
}
',

'Testimonial.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Testimonial extends Model {
    protected $fillable = [\'name\', \'role\', \'company\', \'photo\', \'content\', \'rating\', \'status\'];
    public function scopeActive($query) { return $query->where(\'status\', true); }
    public function getPhotoUrlAttribute(): string { return $this->photo ? asset(\'storage/\' . $this->photo) : asset(\'images/author-default.jpg\'); }
}
',

'Faq.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Faq extends Model {
    protected $fillable = [\'question\', \'answer\', \'category\', \'order\', \'status\'];
    public function scopeActive($query) { return $query->where(\'status\', true)->orderBy(\'order\'); }
}
',

'ContactMessage.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ContactMessage extends Model {
    protected $fillable = [\'name\', \'email\', \'phone\', \'subject\', \'message\', \'status\', \'ip_address\'];
    public function markAsRead(): void { $this->update([\'status\' => \'read\']); }
    public function markAsReplied(): void { $this->update([\'status\' => \'replied\']); }
}
',

'NewsletterSubscriber.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class NewsletterSubscriber extends Model {
    protected $fillable = [\'email\', \'name\', \'status\', \'confirmed_at\'];
    protected $casts = [\'confirmed_at\' => \'datetime\'];
    public function scopeActive($query) { return $query->where(\'status\', \'active\'); }
}
',

        ];

        foreach ($models as $filename => $content) {
            file_put_contents($base . DIRECTORY_SEPARATOR . $filename, $content);
            $this->info("Written: $filename");
        }
        $this->info("All models written!");
    }

    protected function writeControllers()
    {
        $base = app_path('Http/Controllers');

        $controllers = [

'HomeController.php' => '<?php
namespace App\Http\Controllers;
use App\Models\{Post, Service, TeamMember, Testimonial, Setting};
class HomeController extends Controller {
    public function index() {
        return view(\'pages.home\', [
            \'latestPosts\'   => Post::published()->with(\'category\')->latest(\'published_at\')->take(3)->get(),
            \'services\'      => Service::active()->take(6)->get(),
            \'teamMembers\'   => TeamMember::active()->take(4)->get(),
            \'testimonials\'  => Testimonial::active()->inRandomOrder()->take(6)->get(),
        ]);
    }
}
',

'PageController.php' => '<?php
namespace App\Http\Controllers;
use App\Models\{TeamMember, Faq, Post, Service, Setting};
use Illuminate\Support\Facades\Response;
class PageController extends Controller {
    public function about() {
        return view(\'pages.about\', [
            \'teamMembers\' => TeamMember::active()->take(8)->get(),
        ]);
    }
    public function team() {
        return view(\'pages.team\', [
            \'teamMembers\' => TeamMember::active()->get(),
        ]);
    }
    public function faqs() {
        return view(\'pages.faqs\', [
            \'faqs\' => Faq::active()->get(),
        ]);
    }
    public function sitemap() {
        $posts    = Post::published()->latest(\'published_at\')->get();
        $services = Service::active()->get();
        $content  = view(\'sitemap\', compact(\'posts\', \'services\'))->render();
        return Response::make($content, 200, [\'Content-Type\' => \'application/xml\']);
    }
    public function robots() {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: " . url(\'/sitemap.xml\');
        return Response::make($content, 200, [\'Content-Type\' => \'text/plain\']);
    }
}
',

'PostController.php' => '<?php
namespace App\Http\Controllers;
use App\Models\{Post, PostCategory, PostTag};
use Illuminate\Http\Request;
class PostController extends Controller {
    public function index(Request $request) {
        $query = Post::published()->with([\'category\', \'author\'])->latest(\'published_at\');
        if ($request->category) {
            $query->whereHas(\'category\', fn($q) => $q->where(\'slug\', $request->category));
        }
        if ($request->tag) {
            $query->whereHas(\'tags\', fn($q) => $q->where(\'slug\', $request->tag));
        }
        if ($request->search) {
            $query->where(\'title\', \'like\', \'%\' . $request->search . \'%\');
        }
        return view(\'pages.blog.index\', [
            \'posts\'      => $query->paginate(9),
            \'categories\' => PostCategory::withCount([\'posts\' => fn($q) => $q->published()])->having(\'posts_count\', \'>\', 0)->get(),
            \'tags\'       => PostTag::has(\'posts\')->get(),
        ]);
    }
    public function show(Post $post) {
        abort_unless($post->status === \'published\' && $post->published_at <= now(), 404);
        $related = Post::published()
            ->where(\'id\', \'!=\', $post->id)
            ->where(\'category_id\', $post->category_id)
            ->latest(\'published_at\')->take(3)->get();
        return view(\'pages.blog.show\', compact(\'post\', \'related\'));
    }
}
',

'ServiceController.php' => '<?php
namespace App\Http\Controllers;
use App\Models\Service;
class ServiceController extends Controller {
    public function index() {
        return view(\'pages.services.index\', [
            \'services\' => Service::active()->get(),
        ]);
    }
    public function show(Service $service) {
        abort_unless($service->status, 404);
        $related = Service::active()->where(\'id\', \'!=\', $service->id)->take(3)->get();
        return view(\'pages.services.show\', compact(\'service\', \'related\'));
    }
}
',

'ContactController.php' => '<?php
namespace App\Http\Controllers;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller {
    public function index() {
        return view(\'pages.contact\');
    }
    public function send(Request $request) {
        $data = $request->validate([
            \'name\'    => \'required|string|max:100\',
            \'email\'   => \'required|email|max:100\',
            \'phone\'   => \'nullable|string|max:20\',
            \'subject\' => \'nullable|string|max:150\',
            \'message\' => \'required|string|min:10|max:2000\',
        ]);
        ContactMessage::create([...$data, \'ip_address\' => $request->ip()]);
        return back()->with(\'success\', \'Thank you! Your message has been received. We will get back to you shortly.\');
    }
}
',

'NewsletterController.php' => '<?php
namespace App\Http\Controllers;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
class NewsletterController extends Controller {
    public function subscribe(Request $request) {
        $request->validate([\'email\' => \'required|email|max:100\']);
        $existing = NewsletterSubscriber::where(\'email\', $request->email)->first();
        if ($existing) {
            if ($existing->status === \'unsubscribed\') {
                $existing->update([\'status\' => \'active\', \'confirmed_at\' => now()]);
                return back()->with(\'newsletter_success\', \'Welcome back! You have been re-subscribed.\');
            }
            return back()->with(\'newsletter_info\', \'You are already subscribed!\');
        }
        NewsletterSubscriber::create([
            \'email\'        => $request->email,
            \'name\'         => $request->name,
            \'status\'       => \'active\',
            \'confirmed_at\' => now(),
        ]);
        return back()->with(\'newsletter_success\', \'Thank you for subscribing to our newsletter!\');
    }
}
',

        ];

        foreach ($controllers as $filename => $content) {
            file_put_contents($base . DIRECTORY_SEPARATOR . $filename, $content);
            $this->info("Written: $filename");
        }

        // Admin controllers
        $adminBase = $base . '/Admin';

        $adminControllers = [

'AuthController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
    public function showLogin() {
        if (Auth::check()) return redirect()->route(\'admin.dashboard\');
        return view(\'admin.auth.login\');
    }
    public function login(Request $request) {
        $credentials = $request->validate([
            \'email\'    => \'required|email\',
            \'password\' => \'required\',
        ]);
        if (Auth::attempt($credentials, $request->boolean(\'remember\'))) {
            if (!Auth::user()->isEditor()) {
                Auth::logout();
                return back()->withErrors([\'email\' => \'You do not have admin access.\']);
            }
            $request->session()->regenerate();
            return redirect()->route(\'admin.dashboard\');
        }
        return back()->withErrors([\'email\' => \'The provided credentials do not match our records.\'])->onlyInput(\'email\');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route(\'admin.login\');
    }
}
',

'DashboardController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Post, ContactMessage, NewsletterSubscriber, Service, TeamMember};
class DashboardController extends Controller {
    public function index() {
        return view(\'admin.dashboard\', [
            \'totalPosts\'       => Post::count(),
            \'publishedPosts\'   => Post::where(\'status\', \'published\')->count(),
            \'draftPosts\'       => Post::where(\'status\', \'draft\')->count(),
            \'unreadMessages\'   => ContactMessage::where(\'status\', \'unread\')->count(),
            \'totalSubscribers\' => NewsletterSubscriber::active()->count(),
            \'totalServices\'    => Service::count(),
            \'totalTeam\'        => TeamMember::count(),
            \'recentMessages\'   => ContactMessage::latest()->take(5)->get(),
            \'recentPosts\'      => Post::with(\'author\')->latest()->take(5)->get(),
        ]);
    }
}
',

'PostController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Post, PostCategory, PostTag};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller {
    public function index(Request $request) {
        $query = Post::with([\'category\', \'author\'])->latest();
        if ($request->status) $query->where(\'status\', $request->status);
        if ($request->search) $query->where(\'title\', \'like\', \'%\' . $request->search . \'%\');
        return view(\'admin.posts.index\', [
            \'posts\'      => $query->paginate(15),
            \'categories\' => PostCategory::all(),
        ]);
    }
    public function create() {
        return view(\'admin.posts.form\', [
            \'post\'       => new Post,
            \'categories\' => PostCategory::orderBy(\'name\')->get(),
            \'tags\'       => PostTag::orderBy(\'name\')->get(),
        ]);
    }
    public function store(Request $request) {
        $data = $this->validatePost($request);
        $data[\'author_id\'] = auth()->id();
        if ($request->hasFile(\'featured_image\')) {
            $data[\'featured_image\'] = $request->file(\'featured_image\')->store(\'posts\', \'public\');
        }
        $post = Post::create($data);
        if ($request->tags) $post->tags()->sync($request->tags);
        return redirect()->route(\'admin.posts.index\')->with(\'success\', \'Post created successfully!\');
    }
    public function edit(Post $post) {
        return view(\'admin.posts.form\', [
            \'post\'       => $post->load(\'tags\'),
            \'categories\' => PostCategory::orderBy(\'name\')->get(),
            \'tags\'       => PostTag::orderBy(\'name\')->get(),
        ]);
    }
    public function update(Request $request, Post $post) {
        $data = $this->validatePost($request, $post->id);
        if ($request->hasFile(\'featured_image\')) {
            if ($post->featured_image) Storage::disk(\'public\')->delete($post->featured_image);
            $data[\'featured_image\'] = $request->file(\'featured_image\')->store(\'posts\', \'public\');
        }
        $post->update($data);
        if ($request->has(\'tags\')) $post->tags()->sync($request->tags ?? []);
        return redirect()->route(\'admin.posts.index\')->with(\'success\', \'Post updated successfully!\');
    }
    public function destroy(Post $post) {
        if ($post->featured_image) Storage::disk(\'public\')->delete($post->featured_image);
        $post->delete();
        return back()->with(\'success\', \'Post deleted.\');
    }
    protected function validatePost(Request $request, $id = null): array {
        return $request->validate([
            \'title\'            => \'required|string|max:255\',
            \'excerpt\'          => \'nullable|string|max:500\',
            \'body\'             => \'required|string\',
            \'category_id\'      => \'nullable|exists:post_categories,id\',
            \'status\'           => \'required|in:draft,published,scheduled\',
            \'published_at\'     => \'nullable|date\',
            \'featured_image\'   => \'nullable|image|max:2048\',
            \'meta_title\'       => \'nullable|string|max:255\',
            \'meta_description\' => \'nullable|string|max:300\',
            \'tags\'             => \'nullable|array\',
            \'tags.*\'           => \'exists:post_tags,id\',
        ]);
    }
}
',

'CategoryController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
class CategoryController extends Controller {
    public function index() { return view(\'admin.categories.index\', [\'categories\' => PostCategory::withCount(\'posts\')->get()]); }
    public function store(Request $request) {
        $request->validate([\'name\' => \'required|string|max:100|unique:post_categories,name\']);
        PostCategory::create($request->only(\'name\', \'description\'));
        return back()->with(\'success\', \'Category created.\');
    }
    public function update(Request $request, PostCategory $category) {
        $request->validate([\'name\' => \'required|string|max:100|unique:post_categories,name,\' . $category->id]);
        $category->update($request->only(\'name\', \'description\'));
        return back()->with(\'success\', \'Category updated.\');
    }
    public function destroy(PostCategory $category) {
        $category->delete();
        return back()->with(\'success\', \'Category deleted.\');
    }
    public function create() { return view(\'admin.categories.index\', [\'categories\' => PostCategory::withCount(\'posts\')->get()]); }
    public function edit(PostCategory $category) { return view(\'admin.categories.index\', [\'categories\' => PostCategory::withCount(\'posts\')->get(), \'editing\' => $category]); }
    public function show(PostCategory $category) { return redirect()->route(\'admin.categories.index\'); }
}
',

'TagController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PostTag;
use Illuminate\Http\Request;
class TagController extends Controller {
    public function index() { return view(\'admin.tags.index\', [\'tags\' => PostTag::withCount(\'posts\')->get()]); }
    public function store(Request $request) {
        $request->validate([\'name\' => \'required|string|max:100|unique:post_tags,name\']);
        PostTag::create($request->only(\'name\'));
        return back()->with(\'success\', \'Tag created.\');
    }
    public function update(Request $request, PostTag $tag) {
        $request->validate([\'name\' => \'required|string|max:100|unique:post_tags,name,\' . $tag->id]);
        $tag->update($request->only(\'name\'));
        return back()->with(\'success\', \'Tag updated.\');
    }
    public function destroy(PostTag $tag) { $tag->delete(); return back()->with(\'success\', \'Tag deleted.\'); }
    public function create() { return redirect()->route(\'admin.tags.index\'); }
    public function edit(PostTag $tag) { return redirect()->route(\'admin.tags.index\'); }
    public function show(PostTag $tag) { return redirect()->route(\'admin.tags.index\'); }
}
',

'ServiceController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ServiceController extends Controller {
    public function index() { return view(\'admin.services.index\', [\'services\' => Service::withTrashed()->orderBy(\'order\')->get()]); }
    public function create() { return view(\'admin.services.form\', [\'service\' => new Service]); }
    public function store(Request $request) {
        $data = $request->validate([\'title\' => \'required|max:255\', \'short_description\' => \'nullable\', \'body\' => \'nullable\', \'icon\' => \'nullable|max:100\', \'featured_image\' => \'nullable|image|max:2048\', \'order\' => \'integer\', \'status\' => \'boolean\']);
        if ($request->hasFile(\'featured_image\')) $data[\'featured_image\'] = $request->file(\'featured_image\')->store(\'services\', \'public\');
        Service::create($data);
        return redirect()->route(\'admin.services.index\')->with(\'success\', \'Service created.\');
    }
    public function edit(Service $service) { return view(\'admin.services.form\', compact(\'service\')); }
    public function update(Request $request, Service $service) {
        $data = $request->validate([\'title\' => \'required|max:255\', \'short_description\' => \'nullable\', \'body\' => \'nullable\', \'icon\' => \'nullable|max:100\', \'featured_image\' => \'nullable|image|max:2048\', \'order\' => \'integer\', \'status\' => \'boolean\']);
        if ($request->hasFile(\'featured_image\')) { if ($service->featured_image) Storage::disk(\'public\')->delete($service->featured_image); $data[\'featured_image\'] = $request->file(\'featured_image\')->store(\'services\', \'public\'); }
        $service->update($data);
        return redirect()->route(\'admin.services.index\')->with(\'success\', \'Service updated.\');
    }
    public function destroy(Service $service) { $service->delete(); return back()->with(\'success\', \'Service deleted.\'); }
    public function show(Service $service) { return redirect()->route(\'admin.services.index\'); }
}
',

'TeamMemberController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TeamMemberController extends Controller {
    public function index() { return view(\'admin.team.index\', [\'members\' => TeamMember::orderBy(\'order\')->get()]); }
    public function create() { return view(\'admin.team.form\', [\'member\' => new TeamMember]); }
    public function store(Request $request) {
        $data = $request->validate([\'name\' => \'required|max:100\', \'role\' => \'required|max:100\', \'bio\' => \'nullable\', \'email\' => \'nullable|email\', \'linkedin\' => \'nullable|url\', \'twitter\' => \'nullable\', \'photo\' => \'nullable|image|max:2048\', \'order\' => \'integer\', \'status\' => \'boolean\']);
        if ($request->hasFile(\'photo\')) $data[\'photo\'] = $request->file(\'photo\')->store(\'team\', \'public\');
        TeamMember::create($data);
        return redirect()->route(\'admin.team.index\')->with(\'success\', \'Team member added.\');
    }
    public function edit(TeamMember $team) { return view(\'admin.team.form\', [\'member\' => $team]); }
    public function update(Request $request, TeamMember $team) {
        $data = $request->validate([\'name\' => \'required|max:100\', \'role\' => \'required|max:100\', \'bio\' => \'nullable\', \'email\' => \'nullable|email\', \'linkedin\' => \'nullable|url\', \'twitter\' => \'nullable\', \'photo\' => \'nullable|image|max:2048\', \'order\' => \'integer\', \'status\' => \'boolean\']);
        if ($request->hasFile(\'photo\')) { if ($team->photo) Storage::disk(\'public\')->delete($team->photo); $data[\'photo\'] = $request->file(\'photo\')->store(\'team\', \'public\'); }
        $team->update($data);
        return redirect()->route(\'admin.team.index\')->with(\'success\', \'Team member updated.\');
    }
    public function destroy(TeamMember $team) { if ($team->photo) Storage::disk(\'public\')->delete($team->photo); $team->delete(); return back()->with(\'success\', \'Member deleted.\'); }
    public function show(TeamMember $team) { return redirect()->route(\'admin.team.index\'); }
}
',

'TestimonialController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TestimonialController extends Controller {
    public function index() { return view(\'admin.testimonials.index\', [\'testimonials\' => Testimonial::latest()->get()]); }
    public function create() { return view(\'admin.testimonials.form\', [\'testimonial\' => new Testimonial]); }
    public function store(Request $request) {
        $data = $request->validate([\'name\' => \'required|max:100\', \'role\' => \'nullable|max:100\', \'company\' => \'nullable|max:100\', \'content\' => \'required\', \'rating\' => \'integer|min:1|max:5\', \'photo\' => \'nullable|image|max:2048\', \'status\' => \'boolean\']);
        if ($request->hasFile(\'photo\')) $data[\'photo\'] = $request->file(\'photo\')->store(\'testimonials\', \'public\');
        Testimonial::create($data);
        return redirect()->route(\'admin.testimonials.index\')->with(\'success\', \'Testimonial added.\');
    }
    public function edit(Testimonial $testimonial) { return view(\'admin.testimonials.form\', compact(\'testimonial\')); }
    public function update(Request $request, Testimonial $testimonial) {
        $data = $request->validate([\'name\' => \'required|max:100\', \'role\' => \'nullable|max:100\', \'company\' => \'nullable|max:100\', \'content\' => \'required\', \'rating\' => \'integer|min:1|max:5\', \'photo\' => \'nullable|image|max:2048\', \'status\' => \'boolean\']);
        if ($request->hasFile(\'photo\')) { if ($testimonial->photo) Storage::disk(\'public\')->delete($testimonial->photo); $data[\'photo\'] = $request->file(\'photo\')->store(\'testimonials\', \'public\'); }
        $testimonial->update($data);
        return redirect()->route(\'admin.testimonials.index\')->with(\'success\', \'Testimonial updated.\');
    }
    public function destroy(Testimonial $testimonial) { $testimonial->delete(); return back()->with(\'success\', \'Testimonial deleted.\'); }
    public function show(Testimonial $t) { return redirect()->route(\'admin.testimonials.index\'); }
}
',

'FaqController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
class FaqController extends Controller {
    public function index() { return view(\'admin.faqs.index\', [\'faqs\' => Faq::orderBy(\'order\')->get()]); }
    public function create() { return view(\'admin.faqs.form\', [\'faq\' => new Faq]); }
    public function store(Request $request) {
        $request->validate([\'question\' => \'required|max:255\', \'answer\' => \'required\', \'category\' => \'nullable|max:100\', \'order\' => \'integer\', \'status\' => \'boolean\']);
        Faq::create($request->all());
        return redirect()->route(\'admin.faqs.index\')->with(\'success\', \'FAQ created.\');
    }
    public function edit(Faq $faq) { return view(\'admin.faqs.form\', compact(\'faq\')); }
    public function update(Request $request, Faq $faq) {
        $request->validate([\'question\' => \'required|max:255\', \'answer\' => \'required\', \'category\' => \'nullable|max:100\', \'order\' => \'integer\', \'status\' => \'boolean\']);
        $faq->update($request->all());
        return redirect()->route(\'admin.faqs.index\')->with(\'success\', \'FAQ updated.\');
    }
    public function destroy(Faq $faq) { $faq->delete(); return back()->with(\'success\', \'FAQ deleted.\'); }
    public function show(Faq $faq) { return redirect()->route(\'admin.faqs.index\'); }
}
',

'MessageController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
class MessageController extends Controller {
    public function index(Request $request) {
        $query = ContactMessage::latest();
        if ($request->status) $query->where(\'status\', $request->status);
        return view(\'admin.messages.index\', [\'messages\' => $query->paginate(20)]);
    }
    public function show(ContactMessage $message) {
        $message->markAsRead();
        return view(\'admin.messages.show\', compact(\'message\'));
    }
    public function updateStatus(Request $request, ContactMessage $message) {
        $request->validate([\'status\' => \'required|in:unread,read,replied\']);
        $message->update([\'status\' => $request->status]);
        return back()->with(\'success\', \'Status updated.\');
    }
    public function destroy(ContactMessage $message) { $message->delete(); return back()->with(\'success\', \'Message deleted.\'); }
}
',

'SubscriberController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
class SubscriberController extends Controller {
    public function index(Request $request) {
        $query = NewsletterSubscriber::latest();
        if ($request->status) $query->where(\'status\', $request->status);
        return view(\'admin.subscribers.index\', [\'subscribers\' => $query->paginate(20)]);
    }
    public function export() {
        $subscribers = NewsletterSubscriber::active()->get();
        $csv = "Name,Email,Subscribed At\n";
        foreach ($subscribers as $s) {
            $csv .= "\"{$s->name}\",\"{$s->email}\",\"{$s->confirmed_at}\"\n";
        }
        return Response::make($csv, 200, [
            \'Content-Type\'        => \'text/csv\',
            \'Content-Disposition\' => \'attachment; filename="subscribers.csv"\',
        ]);
    }
    public function destroy(NewsletterSubscriber $subscriber) { $subscriber->delete(); return back()->with(\'success\', \'Subscriber removed.\'); }
}
',

'SettingsController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SettingsController extends Controller {
    protected array $groups = [\'general\', \'homepage\', \'contact\', \'social\', \'seo\'];
    public function index(string $group = \'general\') {
        $group = in_array($group, $this->groups) ? $group : \'general\';
        $settings = Setting::where(\'group\', $group)->orderBy(\'id\')->get()->keyBy(\'key\');
        return view(\'admin.settings.index\', compact(\'settings\', \'group\'));
    }
    public function update(Request $request) {
        $group = $request->input(\'_group\', \'general\');
        foreach ($request->except([\'_token\', \'_method\', \'_group\']) as $key => $value) {
            $setting = Setting::where(\'key\', $key)->first();
            if (!$setting) continue;
            if ($setting->type === \'image\' && $request->hasFile($key)) {
                if ($setting->value) Storage::disk(\'public\')->delete($setting->value);
                $value = $request->file($key)->store(\'settings\', \'public\');
            } elseif ($setting->type === \'image\') {
                continue;
            }
            $setting->update([\'value\' => $value]);
        }
        return redirect()->route(\'admin.settings.index\', $group)->with(\'success\', \'Settings saved successfully!\');
    }
}
',

'MediaController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class MediaController extends Controller {
    public function upload(Request $request) {
        $request->validate([\'file\' => \'required|file|mimes:jpg,jpeg,png,gif,webp,svg,pdf|max:5120\']);
        $path = $request->file(\'file\')->store(\'media\', \'public\');
        return response()->json([\'url\' => Storage::disk(\'public\')->url($path), \'path\' => $path]);
    }
}
',

'UserController.php' => '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
class UserController extends Controller {
    public function index() { return view(\'admin.users.index\', [\'users\' => User::latest()->get()]); }
    public function create() { return view(\'admin.users.form\', [\'user\' => new User]); }
    public function store(Request $request) {
        $request->validate([\'name\' => \'required|max:100\', \'email\' => \'required|email|unique:users\', \'password\' => \'required|min:8|confirmed\', \'role\' => \'required|in:super_admin,editor\']);
        User::create([...$request->only(\'name\', \'email\', \'role\'), \'password\' => bcrypt($request->password), \'email_verified_at\' => now()]);
        return redirect()->route(\'admin.users.index\')->with(\'success\', \'User created.\');
    }
    public function edit(User $user) { return view(\'admin.users.form\', compact(\'user\')); }
    public function update(Request $request, User $user) {
        $request->validate([\'name\' => \'required|max:100\', \'email\' => \'required|email|unique:users,email,\' . $user->id, \'role\' => \'required|in:super_admin,editor\', \'password\' => \'nullable|min:8|confirmed\']);
        $data = $request->only(\'name\', \'email\', \'role\');
        if ($request->filled(\'password\')) $data[\'password\'] = bcrypt($request->password);
        $user->update($data);
        return redirect()->route(\'admin.users.index\')->with(\'success\', \'User updated.\');
    }
    public function destroy(User $user) {
        abort_if($user->id === auth()->id(), 403, \'Cannot delete yourself.\');
        $user->delete();
        return back()->with(\'success\', \'User deleted.\');
    }
    public function show(User $user) { return redirect()->route(\'admin.users.index\'); }
}
',

        ];

        foreach ($adminControllers as $filename => $content) {
            file_put_contents($adminBase . DIRECTORY_SEPARATOR . $filename, $content);
            $this->info("Written admin: $filename");
        }

        $this->info("All controllers written!");
    }
}
