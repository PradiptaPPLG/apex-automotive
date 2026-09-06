<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manager Dashboard') — Apex Automotive</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme-head')
    <style>
        /* Manager-specific overrides using CSS variables from theme-head */
        :root {
            --bg-sidebar: rgba(12, 12, 20, 0.98);
            --bg-topbar:  rgba(12, 12, 20, 0.85);
            --nav-hover:  rgba(255, 255, 255, 0.05);
            --table-hover:rgba(255, 255, 255, 0.03);
            --input-bg:   rgba(255, 255, 255, 0.05);
            --input-bdr:  rgba(255, 255, 255, 0.1);
        }
        html.light {
            --bg-sidebar: #ffffff;
            --bg-topbar:  rgba(255, 255, 255, 0.92);
            --nav-hover:  #f3f4f6;
            --table-hover:#f9fafb;
            --input-bg:   #f9fafb;
            --input-bdr:  #d1d5db;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-main);
            color: var(--text-base);
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 260px;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            z-index: 40;
        }
        .brand-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            color: var(--text-heading);
        }
        .brand-badge {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: #ef4444;
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 2px 6px;
            border-radius: 2px;
            text-transform: uppercase;
        }
        .nav-menu {
            padding: 20px 14px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1;
        }
        .nav-label {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: var(--text-dim);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 8px 12px 4px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }
        .nav-item:hover {
            color: var(--text-heading);
            background: var(--nav-hover);
        }
        .nav-item.active {
            color: #ef4444;
            background: rgba(220, 38, 38, 0.15);
            border: 1px solid rgba(220, 38, 38, 0.3);
        }
        .nav-item.active i { color: #ef4444; }
        .user-footer {
            padding: 16px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--bg-topbar);
        }
        .user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-heading);
        }
        .user-role {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #ef4444;
        }
        .main-wrapper {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .topbar {
            height: 64px;
            background: var(--bg-topbar);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 30;
        }
        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-heading);
        }
        .content-body {
            padding: 32px;
            flex: 1;
        }
        .card-panel {
            background: var(--bg-card);
            border: 1px solid var(--border);
            backdrop-filter: blur(8px);
            border-radius: 8px;
            padding: 24px;
        }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-main); }
        ::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 3px; }

        /* table helpers using CSS vars */
        .mgr-table-header-row {
            border-bottom: 1px solid var(--border);
            color: var(--text-muted);
            font-family: 'Space Mono', monospace;
            font-size: 11px;
        }
        .mgr-table-body-row {
            border-bottom: 1px solid var(--border-soft);
            color: var(--text-base);
        }
        .mgr-table-body-row:hover { background: var(--table-hover); }
        .mgr-cell-heading { font-weight: 700; color: var(--text-heading); }
        .mgr-cell-muted   { font-size: 11px; color: var(--text-muted); }
        .mgr-input {
            background: var(--input-bg);
            border: 1px solid var(--input-bdr);
            color: var(--text-heading);
            border-radius: 4px;
            padding: 10px 14px;
            font-size: 13px;
            width: 100%;
        }
        .mgr-input:focus { outline: none; border-color: #ef4444; }
        .mgr-select {
            background: var(--bg-card);
            border: 1px solid var(--input-bdr);
            color: var(--text-heading);
            border-radius: 4px;
            padding: 10px 14px;
            font-size: 13px;
            width: 100%;
        }
        .mgr-card-heading { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; color: var(--text-heading); }
        .mgr-card-sub     { font-size: 12px; color: var(--text-muted); margin-top: 4px; }
        .mgr-metric-num   { font-size: 1.8rem; font-weight: 800; font-family: 'Playfair Display', serif; color: var(--text-heading); }
        .mgr-stat-label   { font-family: 'Space Mono', monospace; font-size: 10px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 8px; }
        .mgr-dropdown {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 6px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        }
        .mgr-dropdown-link {
            display: flex; align-items: center; gap: 8px;
            padding: 8px 12px;
            color: #60a5fa;
            text-decoration: none;
            font-size: 12px;
        }
        .mgr-dropdown-link:hover { background: var(--bg-hover); }
        .alert-success-panel {
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #4ade80;
            padding: 12px 18px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-error-panel {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
            padding: 12px 18px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="brand-header">
            <div>
                <div class="brand-title">APEX MANAGER</div>
                <div class="brand-badge">Executive Portal</div>
            </div>
        </div>

        <div class="nav-menu">
            <span class="nav-label">Menu utama</span>
            <a href="{{ route('manager.dashboard') }}" class="nav-item {{ request()->routeIs('manager.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard &amp; Analytics</span>
            </a>

            <a href="{{ route('manager.cars.index') }}" class="nav-item {{ request()->routeIs('manager.cars.*') ? 'active' : '' }}">
                <i class="fa-solid fa-car"></i>
                <span>Kelola Showroom Mobil</span>
            </a>

            <a href="{{ route('manager.team.index') }}" class="nav-item {{ request()->routeIs('manager.team.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span>Kelola Tim Sales &amp; Delivery</span>
            </a>

            <span class="nav-label" style="margin-top: 14px;">Preview &amp; Sistem</span>
            <a href="{{ route('manager.preview') }}" class="nav-item {{ request()->routeIs('manager.preview') ? 'active' : '' }}">
                <i class="fa-solid fa-eye"></i>
                <span>Preview Website</span>
            </a>

            <a href="{{ route('home') }}" target="_blank" class="nav-item">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>Buka Landing Page</span>
            </a>
        </div>

        <div class="user-footer">
            <div class="user-info">
                <span class="user-name">{{ auth()->user()->name }}</span>
                <span class="user-role">MANAGER EXEC</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background:none; border:none; color:#ef4444; cursor:pointer; font-size:14px;" title="Keluar">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <h1 class="topbar-title">@yield('page_header', 'Manager Portal')</h1>
            <div class="flex items-center gap-4">
                <span style="font-size: 12px; font-family: 'Space Mono', monospace; color: var(--text-muted);">
                    <i class="fa-regular fa-clock text-red-500 mr-1"></i> {{ date('d M Y') }}
                </span>
                <button onclick="toggleGlobalTheme()" class="apex-theme-btn" id="managerThemeBtn">
                    <i class="fa-solid fa-moon" style="color:#818cf8;"></i> DARK MODE
                </button>
                <span style="padding: 6px 12px; background: rgba(220, 38, 38, 0.12); border: 1px solid rgba(220, 38, 38, 0.3); color: #fca5a5; font-family: 'Space Mono', monospace; font-size: 11px; border-radius: 4px; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-user-shield text-red-500"></i>
                    <span>{{ auth()->user()->email }}</span>
                </span>
            </div>
        </header>

        <main class="content-body">
            @if(session('success'))
                <div class="alert-success-panel">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error-panel">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
