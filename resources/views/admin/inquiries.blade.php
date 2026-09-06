<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Semua Inquiry — Apex Automotive</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme-head')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-main);
            color: var(--text-base);
            min-height: 100vh;
        }
        .admin-nav {
            background: var(--bg-surface);
            border-bottom: 1px solid rgba(220, 38, 38, 0.2);
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
            backdrop-filter: blur(12px);
        }
        .admin-nav-left { display: flex; align-items: center; gap: 16px; }
        .admin-nav-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .admin-nav-logo img { height: 28px; }
        .admin-badge {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: #dc2626;
            border: 1px solid rgba(220,38,38,0.4);
            padding: 3px 8px;
            letter-spacing: 0.15em;
            font-weight: 700;
            text-transform: uppercase;
        }
        .admin-nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            color: var(--text-muted);
        }
        .logout-btn {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--text-dim);
            background: none;
            border: 1px solid var(--border);
            padding: 6px 12px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.2s;
        }
        .logout-btn:hover { color: #ef4444; border-color: rgba(239, 68, 68, 0.3); }
        .main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 2rem;
        }
        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
        .page-label {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #dc2626;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-heading);
        }
        .filter-tabs { display: flex; gap: 4px; flex-wrap: wrap; }
        .filter-tab {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            padding: 6px 14px;
            border: 1px solid var(--border);
            color: var(--text-dim);
            text-decoration: none;
            transition: all 0.2s;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .filter-tab:hover, .filter-tab.active {
            border-color: #dc2626;
            color: #fca5a5;
            background: rgba(220,38,38,0.08);
        }
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            padding: 16px 20px;
        }
        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-heading);
        }
        .stat-label {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: var(--text-dimmer);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-top: 2px;
        }
        .inquiries-table { width: 100%; border-collapse: collapse; }
        .inquiries-table thead th {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: var(--text-dimmer);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 10px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-soft);
        }
        .inquiries-table tbody tr {
            border-bottom: 1px solid var(--border-soft);
            transition: background 0.15s;
            cursor: pointer;
        }
        .inquiries-table tbody tr:hover { background: var(--bg-hover); }
        .inquiries-table tbody td { padding: 14px 16px; font-size: 13px; vertical-align: middle; }
        .td-name { font-weight: 600; color: var(--text-heading); }
        .td-car  { font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); }
        .td-phone{ font-size: 12px; color: var(--text-dim); }
        .td-date { font-size: 11px; color: var(--text-dimmer); }
        .status-pill {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 4px 10px;
            border: 1px solid;
            white-space: nowrap;
        }
        .unread-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #dc2626;
            color: white;
            font-size: 10px;
            font-weight: 700;
            font-family: 'Space Mono', monospace;
            padding: 0 5px;
        }
        .pagination-area { margin-top: 2rem; }
        .empty-row td {
            text-align: center;
            padding: 4rem;
            color: var(--text-dim);
            font-size: 14px;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-main); }
        ::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 3px; }
    </style>
</head>
<body>
    <nav class="admin-nav">
        <div class="admin-nav-left">
            <a href="{{ route('home') }}" class="admin-nav-logo">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Apex">
            </a>
            <span class="admin-badge">RM Panel</span>
        </div>
        <div class="admin-nav-right">
            <button onclick="toggleGlobalTheme()" class="apex-theme-btn">
                <i class="fa-solid fa-moon" style="color:#818cf8;"></i> DARK MODE
            </button>
            <i class="fa-solid fa-circle" style="color:#dc2626; font-size:8px;"></i>
            <span>{{ auth()->user()->name }}</span>
            <a href="{{ route('admin.profile.show') }}" style="color:var(--text-base); text-decoration:none; font-family:'Space Mono', monospace; font-size:10px; text-transform:uppercase; border:1px solid rgba(220,38,38,0.4); padding:4px 10px; border-radius:4px; transition:all 0.2s; background:rgba(220,38,38,0.1);">
                <i class="fa-solid fa-id-card mr-1" style="color:#dc2626;"></i> Profil & ID Card
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>
        </div>
    </nav>

    <main class="main">
        <div class="page-header">
            <div>
                <p class="page-label">// Sales RM Dashboard</p>
                <h1 class="page-title">Semua Inquiry VIP</h1>
            </div>
            <div class="filter-tabs">
                <a href="{{ route('admin.inquiries.index') }}" class="filter-tab {{ !$status ? 'active' : '' }}">Semua</a>
                @foreach(\App\Models\Inquiry::statusLabels() as $code => $label)
                    <a href="{{ route('admin.inquiries.index', ['status' => $code]) }}" class="filter-tab {{ $status === $code ? 'active' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        @php $allInquiries = \App\Models\Inquiry::all(); @endphp
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-num">{{ $allInquiries->count() }}</div>
                <div class="stat-label">Total Inquiry</div>
            </div>
            <div class="stat-card">
                <div class="stat-num">{{ $allInquiries->where('status','inquiry_received')->count() }}</div>
                <div class="stat-label">Lead Baru</div>
            </div>
            <div class="stat-card">
                <div class="stat-num">{{ $allInquiries->where('status','consultation_active')->count() }}</div>
                <div class="stat-label">Konsultasi Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-num">{{ $allInquiries->whereIn('status',['payment_verified','delivered_completed'])->count() }}</div>
                <div class="stat-label">Transaksi Selesai</div>
            </div>
        </div>

        @if(session('success'))
            <div style="background: rgba(22,163,74,0.1); border: 1px solid rgba(22,163,74,0.3); color: #86efac; padding: 12px 16px; margin-bottom: 16px; font-size: 13px;">
                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <table class="inquiries-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pembeli</th>
                    <th>Kendaraan</th>
                    <th>No. HP</th>
                    <th>Status</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($inquiries as $inquiry)
                    <tr onclick="window.location='{{ route('admin.inquiries.show', $inquiry) }}'">
                        <td class="td-date">{{ $inquiry->id }}</td>
                        <td>
                            <div class="td-name">{{ $inquiry->name }}</div>
                            <div class="td-phone">{{ $inquiry->email }}</div>
                        </td>
                        <td class="td-car">{{ $inquiry->car_model ?? '—' }}</td>
                        <td class="td-phone">{{ $inquiry->phone }}</td>
                        <td><span class="status-pill {{ $inquiry->statusColor() }}">{{ $inquiry->statusLabel() }}</span></td>
                        <td style="color: var(--text-base);">
                            {{ $inquiry->messages_count }}
                            @if($inquiry->unread_count > 0)
                                <span class="unread-badge">{{ $inquiry->unread_count }}</span>
                            @endif
                        </td>
                        <td class="td-date">{{ $inquiry->created_at->format('d M Y') }}</td>
                        <td><i class="fa-solid fa-chevron-right" style="color: var(--text-dimmer); font-size:12px;"></i></td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="8">Belum ada inquiry masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-area">
            {{ $inquiries->links() }}
        </div>
    </main>
</body>
</html>
