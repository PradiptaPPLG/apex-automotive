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
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #080810;
            color: #e5e7eb;
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 260px;
            background: rgba(12, 12, 18, 0.98);
            border-right: 1px solid rgba(255,255,255,0.08);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            z-index: 40;
        }
        .brand-header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            color: #ffffff;
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
            color: #4b5563;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 8px 12px 4px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: #9ca3af;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        .nav-item:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
        }
        .nav-item.active {
            color: #ffffff;
            background: rgba(220, 38, 38, 0.15);
            border: 1px solid rgba(220, 38, 38, 0.3);
        }
        .nav-item.active i {
            color: #ef4444;
        }
        .user-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(0,0,0,0.2);
        }
        .user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: #ffffff;
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
            background: rgba(12, 12, 18, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
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
            color: #ffffff;
        }
        .content-body {
            padding: 32px;
            flex: 1;
        }
        .card-panel {
            background: rgba(17, 17, 26, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
            border-radius: 8px;
            padding: 24px;
        }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #080810; }
        ::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 3px; }
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
                <span>Dashboard & Analytics</span>
            </a>

            <a href="{{ route('manager.cars.index') }}" class="nav-item {{ request()->routeIs('manager.cars.*') ? 'active' : '' }}">
                <i class="fa-solid fa-car"></i>
                <span>Kelola Showroom Mobil</span>
            </a>

            <a href="{{ route('manager.team.index') }}" class="nav-item {{ request()->routeIs('manager.team.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span>Kelola Tim Sales & Delivery</span>
            </a>

            <span class="nav-label" style="margin-top: 14px;">Preview & Sistem</span>
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
                <span class="text-xs font-mono text-neutral-400">
                    <i class="fa-regular fa-clock text-red-500 mr-1"></i> {{ date('d M Y') }}
                </span>
                <span style="padding: 6px 12px; background: rgba(220, 38, 38, 0.12); border: 1px solid rgba(220, 38, 38, 0.3); color: #fca5a5; font-family: 'Space Mono', monospace; font-size: 11px; border-radius: 4px; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-user-shield text-red-500"></i>
                    <span>{{ auth()->user()->email }}</span>
                </span>
            </div>
        </header>

        <main class="content-body">
            @if(session('success'))
                <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #4ade80; padding: 12px 18px; border-radius: 6px; font-size: 13px; margin-bottom: 24px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; padding: 12px 18px; border-radius: 6px; font-size: 13px; margin-bottom: 24px; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
