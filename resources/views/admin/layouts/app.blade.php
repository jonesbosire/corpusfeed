<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') &mdash; {{ config('app.name') }} Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome via CDN for reliable icon rendering -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --sidebar-w: 260px;
            --primary: #0d401c;
            --primary-mid: #155c28;
            --primary-light: #1e7a35;
            --accent: #f8c32c;
            --accent-dark: #d9a820;
            --sidebar-bg: #091a0d;
            --sidebar-border: rgba(248,195,44,0.12);
            --sidebar-text: #93c9a0;
            --sidebar-text-hover: #fff;
            --sidebar-active-bg: rgba(248,195,44,0.12);
            --sidebar-active-border: #f8c32c;
            --body-bg: #f3f5f2;
            --card-bg: #fff;
            --border: #e2e8df;
            --text: #1a2e1e;
            --text-muted: #6b7c6f;
        }
        body { font-family: 'Bricolage Grotesque', sans-serif; background: var(--body-bg); color: var(--text); font-size: 15px; display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            position: fixed; top: 0; left: 0;
            height: 100vh; overflow-y: auto;
            z-index: 100;
            display: flex; flex-direction: column;
            border-right: 1px solid var(--sidebar-border);
        }
        .sidebar-header {
            padding: 20px 20px 18px;
            border-bottom: 1px solid var(--sidebar-border);
        }
        .sidebar-logo {
            color: #fff; font-size: 19px; font-weight: 700;
            text-decoration: none;
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-logo .logo-icon {
            width: 36px; height: 36px;
            background: var(--accent);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: var(--primary); font-size: 16px; flex-shrink: 0;
        }
        .sidebar-logo .logo-text em {
            font-style: normal; color: var(--accent);
        }
        .sidebar-subtitle {
            font-size: 11px; color: var(--sidebar-text);
            margin-top: 2px; padding-left: 46px; font-weight: 400;
        }

        .sidebar-nav { padding: 12px 0; flex: 1; }
        .nav-section {
            padding: 14px 20px 5px;
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1.2px;
            color: #3d6647;
        }
        .nav-item {
            display: flex; align-items: center; gap: 11px;
            padding: 9px 20px;
            color: var(--sidebar-text);
            text-decoration: none; font-size: 14px; font-weight: 500;
            transition: all .15s;
            border-left: 3px solid transparent;
            margin: 1px 0;
        }
        .nav-item i {
            width: 17px; text-align: center; font-size: 14px;
            flex-shrink: 0;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.04);
            color: var(--sidebar-text-hover);
            border-left-color: rgba(248,195,44,0.4);
        }
        .nav-item.active {
            background: var(--sidebar-active-bg);
            color: var(--accent);
            border-left-color: var(--sidebar-active-border);
            font-weight: 600;
        }
        .nav-item.active i { color: var(--accent); }

        .sidebar-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--sidebar-border);
        }
        .user-info { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
        .user-avatar {
            width: 34px; height: 34px;
            background: var(--accent);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--primary); font-weight: 800; font-size: 13px;
            flex-shrink: 0;
        }
        .user-name { color: #fff; font-size: 13px; font-weight: 600; line-height: 1.3; }
        .user-role {
            color: var(--sidebar-text); font-size: 11px;
            text-transform: capitalize;
        }
        .logout-form button {
            display: flex; align-items: center; gap: 8px;
            background: none; border: none; cursor: pointer;
            color: #f87171; font-size: 13px; font-family: inherit;
            padding: 4px 0; font-weight: 500;
            transition: color .15s;
        }
        .logout-form button:hover { color: #fca5a5; }

        /* ── Main wrapper ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1; display: flex; flex-direction: column; min-height: 100vh;
        }
        .topbar {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border);
            padding: 0 28px; height: 58px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .topbar-left { display: flex; align-items: center; gap: 12px; }
        .topbar-title { font-size: 17px; font-weight: 600; color: var(--text); }
        .topbar-actions { display: flex; align-items: center; gap: 10px; }
        .main-content { padding: 28px; flex: 1; }

        /* ── Cards ── */
        .card {
            background: var(--card-bg); border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            border: 1px solid var(--border); overflow: hidden;
        }
        .card-header {
            padding: 16px 22px; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header h2 { font-size: 15px; font-weight: 600; color: var(--text); }
        .card-body { padding: 22px; }

        /* ── Stats ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 18px; margin-bottom: 24px;
        }
        .stat-card {
            background: var(--card-bg); border-radius: 12px;
            padding: 20px 22px; border: 1px solid var(--border);
            display: flex; align-items: center; gap: 16px;
            transition: box-shadow .15s;
        }
        .stat-card:hover { box-shadow: 0 4px 16px rgba(13,64,28,0.08); }
        .stat-icon {
            width: 48px; height: 48px; border-radius: 10px;
            background: linear-gradient(135deg, #0d401c, #1e7a35);
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; color: var(--accent); flex-shrink: 0;
        }
        .stat-value { font-size: 28px; font-weight: 700; line-height: 1; color: var(--primary); }
        .stat-label { font-size: 13px; color: var(--text-muted); margin-top: 3px; }

        /* ── Table ── */
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th {
            background: #f7faf6; font-weight: 600; font-size: 11px;
            text-transform: uppercase; letter-spacing: 0.5px;
            color: var(--text-muted); padding: 11px 16px;
            border-bottom: 1px solid var(--border); text-align: left;
        }
        td { padding: 13px 16px; border-bottom: 1px solid #f0f3ef; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fdf8; }

        /* ── Badges ── */
        .badge {
            display: inline-flex; align-items: center;
            padding: 3px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 600; letter-spacing: 0.2px;
        }
        .badge-success { background: #dcfce7; color: #14532d; }
        .badge-warning { background: #fef9c3; color: #713f12; }
        .badge-danger  { background: #fee2e2; color: #7f1d1d; }
        .badge-info    { background: #dbeafe; color: #1e3a8a; }
        .badge-secondary { background: #f1f5f9; color: #475569; }
        .badge-accent  { background: #fef3c7; color: #78350f; }

        /* ── Buttons ── */
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 18px; border-radius: 8px;
            font-size: 14px; font-weight: 500;
            text-decoration: none; border: none; cursor: pointer;
            font-family: inherit; transition: all .15s; white-space: nowrap;
        }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-mid); color: #fff; }
        .btn-accent { background: var(--accent); color: var(--primary); font-weight: 600; }
        .btn-accent:hover { background: var(--accent-dark); color: var(--primary); }
        .btn-secondary { background: #f1f5f0; color: #374151; border: 1px solid var(--border); }
        .btn-secondary:hover { background: #e5ebe3; }
        .btn-danger { background: #fee2e2; color: #7f1d1d; }
        .btn-danger:hover { background: #fecaca; }
        .btn-sm { padding: 5px 12px; font-size: 13px; }
        .btn-icon { padding: 6px 10px; }

        /* ── Forms ── */
        .form-label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #374151; }
        .form-control {
            width: 100%; padding: 10px 14px;
            border: 1.5px solid var(--border); border-radius: 8px;
            font-size: 14px; font-family: inherit;
            transition: border-color .2s, box-shadow .2s; outline: none; background: #fff;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(13,64,28,0.08); }
        .form-control.is-invalid { border-color: #ef4444; }
        .invalid-feedback { color: #ef4444; font-size: 12px; margin-top: 4px; }
        .form-text { font-size: 12px; color: var(--text-muted); margin-top: 4px; }
        .form-group { margin-bottom: 20px; }
        .form-row { display: grid; gap: 20px; }
        .form-row.cols-2 { grid-template-columns: 1fr 1fr; }
        .form-row.cols-3 { grid-template-columns: 1fr 1fr 1fr; }
        select.form-control { cursor: pointer; }
        textarea.form-control { resize: vertical; min-height: 120px; }

        /* ── Alerts ── */
        .alert {
            padding: 12px 16px; border-radius: 8px; font-size: 14px;
            margin-bottom: 20px; display: flex; align-items: flex-start; gap: 10px;
        }
        .alert-success { background: #f0fdf4; color: #14532d; border: 1px solid #bbf7d0; }
        .alert-danger  { background: #fef2f2; color: #7f1d1d; border: 1px solid #fecaca; }
        .alert-info    { background: #eff6ff; color: #1e3a8a; border: 1px solid #bfdbfe; }

        /* ── Pagination ── */
        .pagination { display: flex; align-items: center; gap: 4px; list-style: none; flex-wrap: wrap; }
        .page-item .page-link {
            display: flex; align-items: center; justify-content: center;
            min-width: 34px; height: 34px; padding: 0 8px;
            border-radius: 7px; text-decoration: none; font-size: 13px;
            color: var(--text); border: 1px solid var(--border); transition: all .15s;
        }
        .page-item.active .page-link { background: var(--primary); color: #fff; border-color: var(--primary); }
        .page-item .page-link:hover { background: var(--primary); color: #fff; border-color: var(--primary); }
        .page-item.disabled .page-link { opacity: .4; pointer-events: none; }

        /* ── Image preview ── */
        .image-preview { max-width: 200px; max-height: 150px; border-radius: 8px; border: 2px solid var(--border); object-fit: cover; }
        .image-preview-wrap { margin-top: 10px; }

        /* ── Empty state ── */
        .empty-state { text-align: center; padding: 56px 20px; color: var(--text-muted); }
        .empty-state i { font-size: 44px; margin-bottom: 14px; display: block; color: #c5d9c8; }
        .empty-state h3 { font-size: 17px; color: var(--text); margin-bottom: 6px; font-weight: 600; }

        /* ── Accent topbar stripe ── */
        .topbar::after {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0;
            height: 2px; background: linear-gradient(90deg, var(--primary), var(--accent));
        }
        .topbar { position: relative; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform .25s; }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .form-row.cols-2, .form-row.cols-3 { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                <div class="logo-icon"><i class="fa-solid fa-seedling"></i></div>
                <div>
                    <div class="logo-text">{{ config('app.name') }}</div>
                </div>
            </a>
            <div class="sidebar-subtitle">Admin Panel</div>
        </div>

        <nav class="sidebar-nav">
            <span class="nav-section">Main</span>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>

            <span class="nav-section">Content</span>
            <a href="{{ route('admin.posts.index') }}" class="nav-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <i class="fa-solid fa-newspaper"></i> Blog Posts
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fa-solid fa-folder-open"></i> Categories
            </a>
            <a href="{{ route('admin.tags.index') }}" class="nav-item {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                <i class="fa-solid fa-tags"></i> Tags
            </a>
            <a href="{{ route('admin.services.index') }}" class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase"></i> Services
            </a>
            <a href="{{ route('admin.team.index') }}" class="nav-item {{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Team Members
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="nav-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="fa-solid fa-star"></i> Testimonials
            </a>
            <a href="{{ route('admin.faqs.index') }}" class="nav-item {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                <i class="fa-solid fa-circle-question"></i> FAQs
            </a>
            <a href="{{ route('admin.partners.index') }}" class="nav-item {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                <i class="fa-solid fa-handshake"></i> Partners
            </a>

            <span class="nav-section">Communications</span>
            <a href="{{ route('admin.messages.index') }}" class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <i class="fa-solid fa-envelope"></i> Messages
            </a>
            <a href="{{ route('admin.subscribers.index') }}" class="nav-item {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
                <i class="fa-solid fa-at"></i> Subscribers
            </a>

            <span class="nav-section">System</span>
            <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
            @can('manage-users')
            <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-shield"></i> Users
            </a>
            @endcan
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('admin.profile.edit') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;margin-bottom:12px;padding:8px;border-radius:8px;transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='transparent'">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">{{ str_replace('_', ' ', auth()->user()->role) }}</div>
                </div>
            </a>
            <form method="POST" action="{{ route('admin.logout') }}" class="logout-form">
                @csrf
                <button type="submit">
                    <i class="fa-solid fa-right-from-bracket"></i> Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-wrapper">
        <div class="topbar">
            <div class="topbar-left">
                <div class="topbar-title">@yield('title', 'Dashboard')</div>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary btn-sm">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> View Site
                </a>
            </div>
        </div>

        <div class="main-content">
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
