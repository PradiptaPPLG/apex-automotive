<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Service Bookings — Apex Automotive</title>
    <meta name="description" content="Daftar booking service & modifikasi kendaraan Anda di Apex Automotive.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #080810; color: #e5e7eb; min-height: 100vh; }
        .portal-nav { background: rgba(8,8,16,.96); border-bottom: 1px solid rgba(255,255,255,.08); padding: 0 2rem; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; backdrop-filter: blur(12px); }
        .nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .nav-logo img { height: 32px; }
        .nav-logo span { font-family: 'Space Mono', monospace; font-size: 11px; color: #dc2626; letter-spacing: .15em; font-weight: 700; text-transform: uppercase; }
        .btn-ghost { font-family: 'Space Mono', monospace; font-size: 10px; color: #6b7280; background: none; border: 1px solid rgba(255,255,255,.1); padding: 6px 12px; cursor: pointer; text-transform: uppercase; letter-spacing: .1em; text-decoration: none; transition: all .2s; }
        .btn-ghost:hover { color: #ef4444; border-color: rgba(239,68,68,.3); }
        .btn-primary { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #dc2626; color: white; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; text-decoration: none; transition: background .2s; border: none; cursor: pointer; }
        .btn-primary:hover { background: #b91c1c; }

        .main { max-width: 1000px; margin: 0 auto; padding: 3rem 2rem; }
        .page-label { font-family: 'Space Mono', monospace; font-size: 10px; color: #dc2626; letter-spacing: .2em; text-transform: uppercase; font-weight: 700; margin-bottom: 8px; }
        .page-title { font-family: 'Playfair Display', serif; font-size: 2.25rem; font-weight: 800; color: white; line-height: 1.15; }
        .page-sub { font-size: 14px; color: #6b7280; margin-top: 6px; }

        .header-row { display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; margin-bottom: 2.5rem; flex-wrap: wrap; }

        /* Booking Cards */
        .bookings-list { display: flex; flex-direction: column; gap: 14px; }
        .booking-row {
            display: flex; align-items: center; gap: 18px;
            background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.07);
            padding: 18px 22px; text-decoration: none; transition: all .2s; position: relative;
        }
        .booking-row:hover { border-color: rgba(220,38,38,.35); background: rgba(220,38,38,.04); }
        .booking-icon { width: 46px; height: 46px; border: 1px solid rgba(220,38,38,.3); background: rgba(220,38,38,.08); display: flex; align-items: center; justify-content: center; color: #dc2626; font-size: 17px; flex-shrink: 0; }
        .booking-info { flex: 1; min-width: 0; }
        .booking-title-text { font-family: 'Space Mono', monospace; font-size: 13px; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 4px; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .booking-meta-text { font-size: 12px; color: #6b7280; margin-top: 2px; }
        .booking-meta-text strong { color: #9ca3af; }
        .status-pill { font-family: 'Space Mono', monospace; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; padding: 4px 10px; border: 1px solid; flex-shrink: 0; }
        .unread-dot { width: 8px; height: 8px; border-radius: 50%; background: #ef4444; box-shadow: 0 0 6px #ef4444; display: inline-block; }
        .msg-count { font-family: 'Space Mono', monospace; font-size: 11px; color: #6b7280; text-align: right; flex-shrink: 0; }
        .msg-count span { display: block; font-size: 18px; font-weight: 700; color: white; }

        .empty-state { text-align: center; padding: 5rem 2rem; border: 1px dashed rgba(255,255,255,.1); }
        .empty-state-icon { font-size: 3rem; color: #374151; margin-bottom: 1rem; }
        .empty-state-title { font-family: 'Playfair Display', serif; font-size: 1.5rem; color: white; margin-bottom: 8px; }
        .empty-state-text { font-size: 14px; color: #6b7280; margin-bottom: 1.5rem; }
    </style>
</head>
<body>
    <nav class="portal-nav">
        <a href="{{ route('portal.dashboard') }}" class="nav-logo">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive">
            <span>Service & Modification</span>
        </a>
        <div style="display:flex; align-items:center; gap:10px;">
            <a href="{{ route('portal.dashboard') }}" class="btn-ghost"><i class="fa-solid fa-car mr-1"></i> Purchase Portal</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-ghost"><i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> Keluar</button>
            </form>
        </div>
    </nav>

    <main class="main">
        <div class="header-row">
            <div>
                <p class="page-label">// Service & Modification</p>
                <h1 class="page-title">My Service Bookings</h1>
                <p class="page-sub">Kelola seluruh booking servis dan modifikasi kendaraan Anda.</p>
            </div>
            <a href="{{ route('service.create') }}" class="btn-primary">
                <i class="fa-solid fa-plus"></i> Book New Service
            </a>
        </div>

        @if($bookings->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                <h2 class="empty-state-title">Belum Ada Booking Service</h2>
                <p class="empty-state-text">Ajukan booking servis berkala, performance tuning, atau modifikasi kendaraan Anda sekarang.</p>
                <a href="{{ route('service.create') }}" class="btn-primary">
                    <i class="fa-solid fa-calendar-plus"></i> Buat Booking Pertama
                </a>
            </div>
        @else
            <div class="bookings-list">
                @foreach($bookings as $booking)
                    @php $hasUnread = ($booking->unread_count ?? 0) > 0; @endphp
                    <a href="{{ route('service.show', $booking) }}" class="booking-row">
                        @if($hasUnread)
                            <span style="position:absolute;top:10px;left:10px;width:9px;height:9px;border-radius:50%;background:#ef4444;box-shadow:0 0 7px #ef4444;"></span>
                        @endif
                        <div class="booking-icon"><i class="fa-solid {{ $booking->serviceTypeIcon() }}"></i></div>
                        <div class="booking-info">
                            <div class="booking-title-text">
                                {{ $booking->title }}
                                <span style="font-size:9px;padding:2px 7px;background:rgba(220,38,38,.15);color:#fca5a5;border:1px solid rgba(220,38,38,.3);">
                                    {{ strtoupper(str_replace('_', ' ', $booking->service_type)) }}
                                </span>
                            </div>
                            <div class="booking-meta-text">
                                <strong>Kendaraan:</strong> {{ $booking->vehicle->displayName() }}
                                &nbsp;·&nbsp;
                                <strong>Jadwal:</strong> {{ $booking->preferred_date?->format('d M Y') }} pukul {{ $booking->preferred_time }}
                                @if($booking->assigned_mechanic_name)
                                    &nbsp;·&nbsp; <strong>Teknisi:</strong> {{ $booking->assigned_mechanic_name }}
                                @endif
                                &nbsp;·&nbsp; {{ $booking->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <span class="status-pill {{ $booking->statusColor() }}">{{ $booking->statusLabel() }}</span>
                        <div class="msg-count">
                            <span>{{ $booking->messages_count }}</span>
                            pesan
                            @if($hasUnread) <span class="unread-dot" style="display:inline-block;margin-left:4px;"></span> @endif
                        </div>
                        <i class="fa-solid fa-chevron-right" style="color:#374151; font-size:12px;"></i>
                    </a>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>
