<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Dashboard — Apex Automotive Workshop</title>
    <meta name="description" content="Panel mekanik Apex Automotive — kelola semua service booking.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #060610; color: #e5e7eb; min-height: 100vh; }
        .nav {
            background: rgba(6,6,16,.97); border-bottom: 1px solid rgba(255,165,0,.12);
            padding: 0 2rem; height: 64px; display: flex; align-items: center;
            justify-content: space-between; position: sticky; top: 0; z-index: 50; backdrop-filter: blur(12px);
        }
        .nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .nav-logo img { height: 30px; }
        .nav-badge { font-family: 'Space Mono', monospace; font-size: 10px; color: #f97316; letter-spacing: .15em; font-weight: 700; text-transform: uppercase; }
        .nav-user { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #9ca3af; }
        .btn-ghost { font-family: 'Space Mono', monospace; font-size: 10px; color: #6b7280; background: none; border: 1px solid rgba(255,255,255,.1); padding: 6px 12px; cursor: pointer; text-transform: uppercase; letter-spacing: .1em; text-decoration: none; transition: all .2s; }
        .btn-ghost:hover { color: #f97316; border-color: rgba(249,115,22,.3); }

        .main { max-width: 1100px; margin: 0 auto; padding: 3rem 2rem; }
        .page-label { font-family: 'Space Mono', monospace; font-size: 10px; color: #f97316; letter-spacing: .2em; text-transform: uppercase; font-weight: 700; margin-bottom: 8px; }
        .page-title { font-family: 'Playfair Display', serif; font-size: 2.25rem; font-weight: 800; color: white; line-height: 1.15; }

        /* Stat Cards */
        .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin: 2rem 0; }
        @media(max-width:700px){ .stats-row{ grid-template-columns: repeat(2,1fr); } }
        .stat-card { background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.07); padding: 18px; }
        .stat-num { font-family: 'Space Mono', monospace; font-size: 2rem; font-weight: 700; color: white; margin-bottom: 4px; }
        .stat-label { font-size: 12px; color: #6b7280; }
        .stat-card.orange { border-color: rgba(249,115,22,.25); background: rgba(249,115,22,.05); }
        .stat-card.orange .stat-num { color: #f97316; }
        .stat-card.yellow { border-color: rgba(234,179,8,.2); background: rgba(234,179,8,.04); }
        .stat-card.yellow .stat-num { color: #eab308; }

        /* Filter tabs */
        .filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 1.5rem; }
        .filter-tab { font-family: 'Space Mono', monospace; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; padding: 6px 14px; border: 1px solid rgba(255,255,255,.1); background: transparent; color: #6b7280; cursor: pointer; text-decoration: none; transition: all .2s; }
        .filter-tab:hover, .filter-tab.active { color: #f97316; border-color: rgba(249,115,22,.4); background: rgba(249,115,22,.06); }

        /* Booking Rows */
        .bookings-list { display: flex; flex-direction: column; gap: 12px; }
        .booking-row {
            display: flex; align-items: center; gap: 16px;
            background: rgba(255,255,255,.02); border: 1px solid rgba(255,255,255,.06);
            padding: 16px 20px; text-decoration: none; transition: all .2s; position: relative;
        }
        .booking-row:hover { border-color: rgba(249,115,22,.3); background: rgba(249,115,22,.04); }
        .b-icon { width: 44px; height: 44px; border: 1px solid rgba(249,115,22,.3); background: rgba(249,115,22,.08); display: flex; align-items: center; justify-content: center; color: #f97316; font-size: 16px; flex-shrink: 0; }
        .b-info { flex: 1; min-width: 0; }
        .b-title { font-family: 'Space Mono', monospace; font-size: 12px; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 4px; }
        .b-meta { font-size: 12px; color: #6b7280; line-height: 1.6; }
        .b-meta strong { color: #9ca3af; }
        .status-pill { font-family: 'Space Mono', monospace; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; padding: 4px 10px; border: 1px solid; flex-shrink: 0; }
        .unread-badge { background: #ef4444; color: white; border-radius: 10px; padding: 2px 7px; font-size: 10px; font-weight: 700; font-family: 'Space Mono', monospace; }
        .msg-count { font-size: 12px; color: #6b7280; text-align: right; flex-shrink: 0; }
        .msg-count span { display: block; font-size: 16px; font-weight: 700; color: white; font-family: 'Space Mono', monospace; }

        .empty-state { text-align: center; padding: 4rem 2rem; border: 1px dashed rgba(255,255,255,.08); }
        .empty-state-icon { font-size: 2.5rem; color: #374151; margin-bottom: 1rem; }
        .empty-state-text { font-size: 14px; color: #6b7280; }
    </style>
</head>
<body>
    <nav class="nav">
        <a href="{{ route('mechanic.dashboard') }}" class="nav-logo">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive">
            <span class="nav-badge"><i class="fa-solid fa-wrench mr-1"></i> Mechanic Panel</span>
        </a>
        <div class="nav-user">
            <span>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-ghost"><i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> Keluar</button>
            </form>
        </div>
    </nav>

    <main class="main">
        <p class="page-label">// Workshop Control Center</p>
        <h1 class="page-title" style="margin-bottom: .5rem;">Service Booking Panel</h1>
        <p style="font-size:14px; color:#6b7280; margin-bottom:2rem;">Selamat datang, {{ auth()->user()->name }}. Kelola semua booking servis & modifikasi di bawah ini.</p>

        {{-- Stats --}}
        @php
            $statusGroups = $bookings->groupBy('status');
            $pending = $bookings->where('status','pending')->count();
            $inProgress = $bookings->whereIn('status',['confirmed','in_progress','qc_check'])->count();
            $ready = $bookings->where('status','ready')->count();
            $total = $bookings->total();
        @endphp
        <div class="stats-row">
            <div class="stat-card yellow">
                <div class="stat-num">{{ $pending }}</div>
                <div class="stat-label">Menunggu Konfirmasi</div>
            </div>
            <div class="stat-card orange">
                <div class="stat-num">{{ $inProgress }}</div>
                <div class="stat-label">Sedang Dikerjakan</div>
            </div>
            <div class="stat-card" style="border-color:rgba(20,184,166,.2);background:rgba(20,184,166,.04);">
                <div class="stat-num" style="color:#14b8a6;">{{ $ready }}</div>
                <div class="stat-label">Siap Diserahkan</div>
            </div>
            <div class="stat-card">
                <div class="stat-num">{{ $total }}</div>
                <div class="stat-label">Total Booking</div>
            </div>
        </div>

        {{-- List --}}
        @if($bookings->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon"><i class="fa-solid fa-calendar-xmark"></i></div>
                <p class="empty-state-text">Belum ada booking service masuk.</p>
            </div>
        @else
            <div class="bookings-list">
                @foreach($bookings as $b)
                    @php $hasUnread = ($b->unread_count ?? 0) > 0; @endphp
                    <a href="{{ route('mechanic.show', $b) }}" class="booking-row">
                        @if($hasUnread)
                            <span style="position:absolute;top:10px;left:10px;width:8px;height:8px;border-radius:50%;background:#ef4444;box-shadow:0 0 6px #ef4444;"></span>
                        @endif
                        <div class="b-icon"><i class="fa-solid {{ $b->serviceTypeIcon() }}"></i></div>
                        <div class="b-info">
                            <div class="b-title">
                                {{ $b->title }}
                                @if($hasUnread)
                                    <span class="unread-badge ml-2">{{ $b->unread_count }} BARU</span>
                                @endif
                            </div>
                            <div class="b-meta">
                                <strong>Customer:</strong> {{ $b->user->name }}
                                &nbsp;·&nbsp;
                                <strong>Kendaraan:</strong> {{ $b->vehicle->displayName() }}
                                @if($b->vehicle->license_plate) ({{ $b->vehicle->license_plate }}) @endif
                                &nbsp;·&nbsp;
                                <strong>Jadwal:</strong> {{ $b->preferred_date?->format('d M Y') }} {{ $b->preferred_time }}
                                &nbsp;·&nbsp;
                                {{ strtoupper(str_replace('_', ' ', $b->service_type)) }}
                            </div>
                        </div>
                        <span class="status-pill {{ $b->statusColor() }}">{{ $b->statusLabel() }}</span>
                        <div class="msg-count">
                            <span>{{ $b->messages_count }}</span>
                            pesan
                        </div>
                        <i class="fa-solid fa-chevron-right" style="color:#374151; font-size:12px;"></i>
                    </a>
                @endforeach
            </div>

            <div style="margin-top: 2rem;">
                {{ $bookings->links() }}
            </div>
        @endif
    </main>
</body>
</html>
