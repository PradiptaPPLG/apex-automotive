<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Escort Portal — Apex Automotive</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #080810; color: #e5e7eb; min-height: 100vh; display: flex; flex-direction: column; }
        .nav { background: rgba(8,8,16,0.98); border-bottom: 1px solid rgba(255,255,255,0.08); padding: 0 2rem; height: 60px; display: flex; align-items: center; justify-content: space-between; }
        .brand { font-family: 'Space Mono', monospace; font-size: 11px; letter-spacing: 0.15em; text-transform: uppercase; color: #dc2626; font-weight: 700; display: flex; align-items: center; gap: 8px; }
        .container { max-width: 1000px; margin: 0 auto; width: 100%; padding: 2rem; flex: 1; }
        .card { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.08); padding: 20px; border-radius: 4px; margin-bottom: 16px; transition: border-color 0.2s; }
        .card:hover { border-color: rgba(220,38,38,0.4); }
        .status-pill { font-family: 'Space Mono', monospace; font-size: 9px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; padding: 4px 10px; border: 1px solid; display: inline-block; }
        .status-pending { color: #f59e0b; border-color: rgba(245,158,11,0.3); background: rgba(245,158,11,0.1); }
        .status-in_transit { color: #3b82f6; border-color: rgba(59,130,246,0.3); background: rgba(59,130,246,0.1); }
        .status-delivered { color: #22c55e; border-color: rgba(34,197,94,0.3); background: rgba(34,197,94,0.1); }
        .btn-action { background: #dc2626; color: white; border: none; padding: 10px 18px; font-family: 'Space Mono', monospace; font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 700; transition: background 0.2s; }
        .btn-action:hover { background: #b91c1c; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #080810; }
        ::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 3px; }
    </style>
</head>
<body>
    <nav class="nav">
        <div class="brand">
            <i class="fa-solid fa-truck-ramp-box"></i> APEX WHITE-GLOVE ESCORT PORTAL
        </div>
        <div style="font-size: 12px; color: #9ca3af; font-family: 'Space Mono', monospace;">
            <i class="fa-solid fa-user-gear"></i> {{ auth()->user()->name }} (Driver)
        </div>
    </nav>

    <div class="container">
        <div style="margin-bottom: 24px;">
            <h1 style="font-family: 'Playfair Display', serif; font-size: 24px; color: white;">Tugas Pengiriman Kendaraan VIP</h1>
            <p style="font-size: 13px; color: #6b7280; margin-top: 4px;">Daftar tugas pengiriman armada Flatbed Towing Apex yang ditugaskan kepada Anda.</p>
        </div>

        @if($deliveries->isEmpty())
            <div style="text-align: center; padding: 4rem; color: #4b5563; background: rgba(255,255,255,0.01); border: 1px dashed rgba(255,255,255,0.08);">
                <i class="fa-solid fa-truck-clock" style="font-size: 3rem; margin-bottom: 12px; display: block;"></i>
                Belum ada penugasan pengiriman aktif saat ini.
            </div>
        @else
            @foreach($deliveries as $del)
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                        <div>
                            <span class="status-pill status-{{ $del->status }}">
                                STATUS: {{ strtoupper(str_replace('_', ' ', $del->status)) }}
                            </span>
                            <h2 style="font-size: 18px; font-weight: 700; color: white; margin-top: 8px;">
                                {{ $del->inquiry->car_model ?? 'Kendaraan VIP' }}
                            </h2>
                        </div>
                        <a href="{{ route('delivery.detail', $del) }}" class="btn-action">
                            <i class="fa-solid fa-location-crosshairs"></i> BUKA GPS TRACKER
                        </a>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; font-size: 12px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 12px; color: #9ca3af;">
                        <div><strong style="color:#d1d5db;">Pembeli:</strong> {{ $del->inquiry->name ?? '-' }} ({{ $del->inquiry->phone ?? '-' }})</div>
                        <div><strong style="color:#d1d5db;">Alamat:</strong> {{ $del->delivery_address ?? 'Lokasi Terverifikasi' }}</div>
                        <div><strong style="color:#d1d5db;">Update Terakhir:</strong> {{ $del->latestTracking?->created_at?->format('d M H:i') ?? 'Belum ada' }}</div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
