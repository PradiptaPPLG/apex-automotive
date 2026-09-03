<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIP Buyer Portal — Apex Automotive</title>
    <meta name="description" content="Portal VIP Pembeli Apex Automotive — Lacak status pembelian supercar Anda.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #080810;
            color: #e5e7eb;
            min-height: 100vh;
        }
        .portal-nav {
            background: rgba(8, 8, 16, 0.95);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(12px);
        }
        .portal-nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .portal-nav-logo img { height: 32px; }
        .portal-nav-logo span {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            color: #dc2626;
            letter-spacing: 0.15em;
            font-weight: 700;
            text-transform: uppercase;
        }
        .nav-user {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            color: #9ca3af;
        }
        .nav-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: white;
            font-family: 'Space Mono', monospace;
        }
        .main-content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }
        .page-header {
            margin-bottom: 2.5rem;
        }
        .page-label {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #dc2626;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.25rem;
            font-weight: 800;
            color: white;
            line-height: 1.15;
        }
        .page-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-top: 6px;
        }
        .status-pipeline {
            display: flex;
            gap: 0;
            margin-bottom: 3rem;
            overflow-x: auto;
            padding-bottom: 4px;
        }
        .pipeline-step {
            flex: 1;
            min-width: 120px;
            padding: 12px 16px;
            border: 1px solid rgba(255,255,255,0.06);
            border-right: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
            background: rgba(255,255,255,0.02);
        }
        .pipeline-step:last-child { border-right: 1px solid rgba(255,255,255,0.06); }
        .pipeline-step-num {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: #4b5563;
            letter-spacing: 0.1em;
        }
        .pipeline-step-label {
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
        }
        .pipeline-step.active {
            border-color: rgba(220, 38, 38, 0.4);
            background: rgba(220, 38, 38, 0.06);
        }
        .pipeline-step.active .pipeline-step-num { color: #dc2626; }
        .pipeline-step.active .pipeline-step-label { color: #fca5a5; }
        .inquiries-grid {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .inquiry-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }
        .inquiry-card:hover {
            border-color: rgba(220, 38, 38, 0.4);
            background: rgba(220, 38, 38, 0.04);
        }
        .inquiry-icon {
            width: 48px; height: 48px;
            border: 1px solid rgba(220, 38, 38, 0.3);
            background: rgba(220, 38, 38, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dc2626;
            font-size: 18px;
            flex-shrink: 0;
        }
        .inquiry-info { flex: 1; min-width: 0; }
        .inquiry-car {
            font-family: 'Space Mono', monospace;
            font-size: 13px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .inquiry-meta {
            font-size: 12px;
            color: #6b7280;
            margin-top: 3px;
        }
        .inquiry-status {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 4px 10px;
            border: 1px solid;
        }
        .inquiry-msgs {
            font-size: 12px;
            color: #6b7280;
            text-align: right;
            flex-shrink: 0;
        }
        .inquiry-msgs-count {
            font-family: 'Space Mono', monospace;
            font-size: 18px;
            font-weight: 700;
            color: white;
            display: block;
        }
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            border: 1px dashed rgba(255,255,255,0.1);
        }
        .empty-state-icon {
            font-size: 3rem;
            color: #374151;
            margin-bottom: 1rem;
        }
        .empty-state-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 8px;
        }
        .empty-state-text { font-size: 14px; color: #6b7280; }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 1.5rem;
            padding: 12px 24px;
            background: #dc2626;
            color: white;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-primary:hover { background: #b91c1c; }
        .logout-btn {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #6b7280;
            background: none;
            border: 1px solid rgba(255,255,255,0.1);
            padding: 6px 12px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.2s;
            text-decoration: none;
        }
        .logout-btn:hover { color: #ef4444; border-color: rgba(239, 68, 68, 0.3); }
    </style>
</head>
<body>
    <nav class="portal-nav">
        <a href="{{ route('home') }}" class="portal-nav-logo">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive">
            <span>VIP Buyer Portal</span>
        </a>
        <div class="nav-user">
            @if(auth()->user()->isRm())
                <a href="{{ route('admin.inquiries.index') }}" class="logout-btn">
                    <i class="fa-solid fa-shield-halved mr-1"></i> Admin Panel
                </a>
            @endif
            <div class="nav-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <span>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket mr-1"></i>Keluar</button>
            </form>
        </div>
    </nav>

    <main class="main-content">
        <div class="page-header">
            <p class="page-label">// Portal VIP Pembeli</p>
            <h1 class="page-title">Selamat Datang, {{ explode(' ', auth()->user()->name)[0] }}</h1>
            <p class="page-subtitle">Lacak seluruh status konsultasi dan pemesanan kendaraan eksklusif Anda.</p>
        </div>

        @if($inquiries->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon"><i class="fa-solid fa-car-side"></i></div>
                <h2 class="empty-state-title">Belum Ada Inquiry</h2>
                <p class="empty-state-text">Anda belum mengajukan konsultasi pembelian. Kunjungi showroom dan pilih kendaraan impian Anda.</p>
                <a href="{{ route('home') }}" class="btn-primary"><i class="fa-solid fa-arrow-left"></i> Kunjungi Showroom</a>
            </div>
        @else
            <div class="inquiries-grid">
                @foreach($inquiries as $inquiry)
                    <a href="{{ route('portal.consultation', $inquiry) }}" class="inquiry-card">
                        <div class="inquiry-icon"><i class="fa-solid fa-car"></i></div>
                        <div class="inquiry-info">
                            <div class="inquiry-car">{{ $inquiry->car_model ?? 'Kendaraan VIP' }}</div>
                            <div class="inquiry-meta">
                                Diajukan {{ $inquiry->created_at->diffForHumans() }}
                                @if($inquiry->assigned_rm_name)
                                    &nbsp;·&nbsp; RM: {{ $inquiry->assigned_rm_name }}
                                @endif
                            </div>
                        </div>
                        <span class="inquiry-status {{ $inquiry->statusColor() }}">{{ $inquiry->statusLabel() }}</span>
                        <div class="inquiry-msgs">
                            <span class="inquiry-msgs-count">{{ $inquiry->messages_count }}</span>
                            pesan
                        </div>
                        <i class="fa-solid fa-chevron-right" style="color: #374151; font-size: 12px;"></i>
                    </a>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>
