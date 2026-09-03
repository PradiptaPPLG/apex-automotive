<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales & Purchase Agreement — SPA/APEX/2026/0{{ $inquiry->id }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Inter:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @page { size: A4; margin: 20mm; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #0f172a;
            margin: 0;
            padding: 40px 20px;
        }
        .document-container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            padding: 48px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px double #0f172a;
            padding-bottom: 24px;
            margin-bottom: 32px;
        }
        .brand-title {
            font-family: 'Cinzel', serif;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #991b1b;
        }
        .brand-sub {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            letter-spacing: 1.5px;
            color: #64748b;
            text-transform: uppercase;
            margin-top: 4px;
        }
        .doc-no {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            text-align: right;
            color: #475569;
        }
        .doc-title {
            text-align: center;
            font-family: 'Cinzel', serif;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 24px;
            text-transform: uppercase;
            color: #0f172a;
        }
        .emeterai-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fef2f2;
            border: 1px dashed #ef4444;
            color: #991b1b;
            padding: 8px 16px;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 24px;
            width: 100%;
            box-sizing: border-box;
        }
        .section-title {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #991b1b;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 4px;
            margin-top: 24px;
            margin-bottom: 12px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            font-size: 12px;
            margin-bottom: 20px;
        }
        .info-item {
            display: flex;
            flex-direction: column;
        }
        .info-label {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
        }
        .info-val {
            font-weight: 600;
            color: #0f172a;
            margin-top: 2px;
        }
        .article-text {
            font-size: 12px;
            line-height: 1.7;
            color: #334155;
            margin-bottom: 16px;
            text-align: justify;
        }
        .signature-section {
            margin-top: 48px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .sig-box {
            text-align: center;
            width: 220px;
        }
        .sig-title {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 12px;
        }
        .sig-image-box {
            height: 90px;
            border-bottom: 1px solid #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
        }
        .sig-image-box img {
            max-height: 80px;
            max-width: 100%;
        }
        .sig-name {
            font-size: 12px;
            font-weight: 700;
            color: #0f172a;
        }
        .sig-date {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: #64748b;
        }
        .action-bar {
            max-width: 800px;
            margin: 0 auto 20px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-print {
            background: #991b1b;
            color: white;
            padding: 10px 20px;
            font-family: 'Space Mono', monospace;
            font-size: 12px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            border-radius: 2px;
        }
        .btn-print:hover { background: #7f1d1d; }
        @media print {
            .action-bar { display: none; }
            body { background: white; padding: 0; }
            .document-container { border: none; box-shadow: none; padding: 0; }
        }
    </style>
</head>
<body>

    <div class="action-bar">
        <a href="javascript:history.back()" style="color: #64748b; font-family: monospace; font-size: 12px; text-decoration: none;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        <button onclick="window.print()" class="btn-print">
            <i class="fa-solid fa-print"></i> Cetak / Simpan PDF Dokumen
        </button>
    </div>

    <div class="document-container">
        <div class="header">
            <div>
                <div class="brand-title">APEX AUTOMOTIVE</div>
                <div class="brand-sub">PT APEX AUTOMOTIVE INDONESIA — ULTRA LUXURY DIVISION</div>
            </div>
            <div class="doc-no">
                <strong>NO. KONTRAK:</strong><br>
                SPA/APEX/2026/0{{ $inquiry->id }}<br>
                <span style="font-size: 9px; color: #94a3b8;">TANGGAL: {{ $inquiry->buyer_signed_at?->format('d/m/Y') ?? date('d/m/Y') }}</span>
            </div>
        </div>

        <div class="doc-title">SALES & PURCHASE AGREEMENT (SPA)</div>

        <div class="emeterai-badge">
            <i class="fa-solid fa-stamp" style="font-size: 16px;"></i>
            <div>
                <span>DOKUMEN DILINDUNGI E-METERAI ELEKTRONIK REPUBLIK INDONESIA</span><br>
                <span style="font-size: 9px; font-weight: 400; color: #64748b;">SERIAL CODE: PERUM-PERURI-E-METERAI-2026-APEX-00{{ $inquiry->id }}987</span>
            </div>
        </div>

        <div class="section-title">I. PARA PIHAK YANG BERPERJANJIAN</div>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Pihak Pertama (Penjual)</span>
                <span class="info-val">PT Apex Automotive Indonesia</span>
                <span style="font-size: 11px; color: #64748b;">Showroom VIP Pondok Indah, Jakarta Selatan</span>
            </div>
            <div class="info-item">
                <span class="info-label">Pihak Kedua (Pembeli / Pemilik Legal)</span>
                <span class="info-val">{{ $inquiry->name }}</span>
                <span style="font-size: 11px; color: #64748b;">NIK: {{ $inquiry->user?->nik ?? '3207250203090001' }}</span>
                <span style="font-size: 11px; color: #64748b;">Alamat: {{ $inquiry->user?->address ?? 'Indonesia' }}</span>
            </div>
        </div>

        <div class="section-title">II. SPESIFIKASI KENDARAAN SUPERCAR</div>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Model Utama</span>
                <span class="info-val">{{ $inquiry->car_model }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Paket Kustomisasi</span>
                <span class="info-val">{{ $inquiry->selected_config ?? 'Standard Apex Track Spec' }}</span>
            </div>
        </div>

        <div class="section-title">III. PASAL & KETENTUAN PERJANJIAN</div>
        <div class="article-text">
            <strong>PASAL 1 — PENYERAHAN & HAK KEPEMILIKAN:</strong> Penjual berkewajiban menyerahkan unit kendaraan dalam kondisi baru 100% (Brand New) beserta dokumen STNK dan BPKB atas nama Pihak Kedua. Hak kepemilihan penuh berpindah setelah pelunasan Escrow diselesaikan.
        </div>
        <div class="article-text">
            <strong>PASAL 2 — GARANSI RESMI & CONCIERGE SERVICE:</strong> Unit dilindungi Garansi Resmi Manufactory 7 Tahun, Bebas Biaya Servis Berkala 5 Tahun, serta Layanan Concierge Towing Emergency 24 Jam di seluruh wilayah Republik Indonesia.
        </div>
        <div class="article-text">
            <strong>PASAL 3 — METODE SERAH TERIMA:</strong> Serah terima dilaksanakan menggunakan armada Enclosed Towing tertutup khusus dengan seremoni pembukaan kain penutup beludru merah (Unveiling Ceremony) di lokasi yang ditentukan Pembeli.
        </div>

        <div class="signature-section">
            <div class="sig-box">
                <div class="sig-title">Pihak Pertama (Penjual)</div>
                <div class="sig-image-box">
                    <span style="font-family: 'Cinzel', serif; font-size: 14px; font-weight: 700; color: #991b1b;">APEX AUTOMOTIVE</span>
                </div>
                <div class="sig-name">{{ $inquiry->assigned_rm_name ?? 'Sales Relationship Manager' }}</div>
                <div class="sig-date">PT Apex Automotive Indonesia</div>
            </div>

            <div class="sig-box">
                <div class="sig-title">Pihak Kedua (Pembeli Sah)</div>
                <div class="sig-image-box">
                    @if($inquiry->buyer_signature_svg)
                        <img src="{{ $inquiry->buyer_signature_svg }}" alt="Tanda Tangan Pembeli">
                    @else
                        <span style="font-size: 10px; color: #94a3b8; font-style: italic;">[Tanda Tangan Digital]</span>
                    @endif
                </div>
                <div class="sig-name">{{ $inquiry->name }}</div>
                <div class="sig-date">E-Signed: {{ $inquiry->buyer_signed_at?->format('d M Y, H:i') }} WIB</div>
            </div>
        </div>
    </div>

</body>
</html>
