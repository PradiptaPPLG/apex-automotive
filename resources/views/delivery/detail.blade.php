<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPS Live Tracking — {{ $delivery->inquiry->car_model }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #080810; color: #e5e7eb; height: 100vh; display: flex; flex-direction: column; }
        .nav { background: rgba(8,8,16,0.98); border-bottom: 1px solid rgba(255,255,255,0.08); padding: 0 1.5rem; height: 60px; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
        .nav-back { color: #9ca3af; text-decoration: none; font-size: 13px; display: flex; align-items: center; gap: 8px; font-family: 'Space Mono', monospace; }
        .layout { display: flex; flex: 1; overflow: hidden; }
        .sidebar { width: 340px; border-right: 1px solid rgba(255,255,255,0.08); padding: 20px; display: flex; flex-direction: column; gap: 16px; overflow-y: auto; background: rgba(255,255,255,0.015); }
        .map-area { flex: 1; position: relative; }
        #driverMap { width: 100%; height: 100%; }
        .btn-gps { background: #dc2626; color: white; border: none; padding: 14px; width: 100%; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.2s; }
        .btn-gps:hover { background: #b91c1c; }
        .btn-gps:disabled { background: #374151; cursor: not-allowed; }
        .form-select, .form-input { width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.12); color: white; padding: 10px 12px; font-size: 13px; font-family: 'Inter', sans-serif; outline: none; }
        .form-select option { background: #080810; color: white; }
        .label { font-family: 'Space Mono', monospace; font-size: 9px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 4px; display: block; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #080810; }
        ::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 3px; }
    </style>
</head>
<body>
    <nav class="nav">
        <a href="{{ route('delivery.portal') }}" class="nav-back">
            <i class="fa-solid fa-arrow-left"></i> KEMBALI KE PORTAL DRIVER
        </a>
        <div style="font-family: 'Space Mono', monospace; font-size: 11px; color: #dc2626;">
            LIVE DRIVER GPS CONSOLE
        </div>
    </nav>

    <div class="layout">
        <div class="sidebar">
            <div>
                <span class="label">UNIT PENGIRIMAN</span>
                <h2 style="font-family: 'Playfair Display', serif; font-size: 18px; color: white; margin-top: 2px;">
                    {{ $delivery->inquiry->car_model }}
                </h2>
                <div style="font-size: 12px; color: #9ca3af; margin-top: 4px;">
                    Pembeli: <strong style="color: white;">{{ $delivery->inquiry->name }}</strong>
                </div>
            </div>

            <div style="border-top: 1px solid rgba(255,255,255,0.06); padding-top: 16px;">
                <span class="label">STATUS PENGIRIMAN</span>
                <select id="statusSelect" class="form-select">
                    <option value="pending" {{ $delivery->status === 'pending' ? 'selected' : '' }}>PENDING (Menunggu Berangkat)</option>
                    <option value="in_transit" {{ $delivery->status === 'in_transit' ? 'selected' : '' }}>IN TRANSIT (Dalam Perjalanan Towing)</option>
                    <option value="delivered" {{ $delivery->status === 'delivered' ? 'selected' : '' }}>DELIVERED (Sampai & Serah Terima)</option>
                </select>
            </div>

            <div>
                <span class="label">FASE / CATATAN LOKASI</span>
                <input type="text" id="phaseInput" class="form-input" placeholder="e.g. Melewati Tol Cikampek / 5km lagi..." value="Armada Menuju Lokasi Pembeli">
            </div>

            <button id="sendGpsBtn" class="btn-gps" onclick="updateGpsLocation()">
                <i class="fa-solid fa-location-crosshairs"></i> UPDATE LOKASI GPS SAYA SEKARANG
            </button>

            <div style="border-top: 1px solid rgba(255,255,255,0.06); padding-top: 16px; flex: 1;">
                <span class="label">RIWAYAT LOKASI DIKIRIM</span>
                <div id="trackingHistory" style="display: flex; flex-direction: column; gap: 8px; margin-top: 8px; max-height: 220px; overflow-y: auto;">
                    @foreach($delivery->trackings as $t)
                        <div style="font-size: 11px; background: rgba(255,255,255,0.03); padding: 8px; border-left: 2px solid #dc2626;">
                            <div style="color: #e5e7eb; font-weight: 600;">{{ $t->phase_label }}</div>
                            <div style="color: #6b7280; font-family: 'Space Mono', monospace; font-size: 9px; margin-top: 2px;">
                                {{ $t->created_at->format('H:i:s') }} — {{ $t->lat }}, {{ $t->lng }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="map-area">
            <div id="driverMap"></div>
        </div>
    </div>

    <script>
        const UPDATE_URL = '{{ route('delivery.update-location', $delivery) }}';
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let map, driverMarker, polyline;
        const trackingPoints = [
            @foreach($delivery->trackings as $t)
                [{{ $t->lat }}, {{ $t->lng }}],
            @endforeach
        ];

        document.addEventListener('DOMContentLoaded', () => {
            const initialCenter = trackingPoints.length > 0 ? trackingPoints[trackingPoints.length - 1] : [-6.200000, 106.816666];
            map = L.map('driverMap').setView(initialCenter, 14);

            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri', maxZoom: 19
            }).addTo(map);

            polyline = L.polyline(trackingPoints, { color: '#dc2626', weight: 4, opacity: 0.8 }).addTo(map);

            if (trackingPoints.length > 0) {
                const last = trackingPoints[trackingPoints.length - 1];
                driverMarker = L.marker(last).addTo(map).bindPopup('<b>Posisi Terakhir Armada Towing</b>').openPopup();
            }
        });

        function updateGpsLocation() {
            const btn = document.getElementById('sendGpsBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> MENGAMBIL SINYAL GPS...';

            if (!navigator.geolocation) {
                alert('Browser tidak mendukung Geolocation.');
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> UPDATE LOKASI GPS SAYA SEKARANG';
                return;
            }

            navigator.geolocation.getCurrentPosition(
                async (pos) => {
                    const lat = pos.coords.latitude;
                    const lng = pos.coords.longitude;
                    const status = document.getElementById('statusSelect').value;
                    const phase = document.getElementById('phaseInput').value.trim();

                    try {
                        const res = await fetch(UPDATE_URL, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': CSRF,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ lat, lng, status, phase_label: phase })
                        });
                        const data = await res.json();

                        if (data.success) {
                            const newPoint = [lat, lng];
                            trackingPoints.push(newPoint);
                            polyline.setLatLngs(trackingPoints);

                            if (driverMarker) {
                                driverMarker.setLatLng(newPoint);
                            } else {
                                driverMarker = L.marker(newPoint).addTo(map);
                            }
                            map.setView(newPoint, 16);

                            const hist = document.getElementById('trackingHistory');
                            const div = document.createElement('div');
                            div.style.cssText = 'font-size:11px; background:rgba(255,255,255,0.03); padding:8px; border-left:2px solid #dc2626;';
                            div.innerHTML = `<div style="color:#e5e7eb;font-weight:600;">${phase || 'Lokasi Diperbarui'}</div><div style="color:#6b7280;font-family:monospace;font-size:9px;margin-top:2px;">Sekarang — ${lat.toFixed(6)}, ${lng.toFixed(6)}</div>`;
                            hist.insertBefore(div, hist.firstChild);

                            alert('✅ Lokasi GPS berhasil dikirim ke Pembeli!');
                        }
                    } catch (e) {
                        alert('Gagal mengirim koordinat GPS.');
                    } finally {
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> UPDATE LOKASI GPS SAYA SEKARANG';
                    }
                },
                (err) => {
                    alert('Gagal mengambil sinyal GPS: ' + err.message);
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> UPDATE LOKASI GPS SAYA SEKARANG';
                },
                { enableHighAccuracy: true, timeout: 15000 }
            );
        }
    </script>
</body>
</html>
