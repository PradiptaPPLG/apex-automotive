<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi VIP — {{ $inquiry->car_model ?? 'Kendaraan VIP' }} — Apex Automotive</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .portal-nav {
            background: rgba(8, 8, 16, 0.98);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            z-index: 50;
        }
        .nav-back {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #9ca3af;
            font-size: 13px;
            transition: color 0.2s;
        }
        .nav-back:hover { color: white; }
        .nav-title {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.1em;
            color: #6b7280;
            text-transform: uppercase;
        }
        .nav-title strong { color: white; }
        .consultation-layout {
            display: flex;
            flex: 1;
            overflow: hidden;
        }
        /* Left sidebar: inquiry details */
        .sidebar {
            width: 320px;
            flex-shrink: 0;
            border-right: 1px solid rgba(255,255,255,0.06);
            background: rgba(255,255,255,0.015);
            padding: 24px 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .sidebar-section-label {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: #4b5563;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .status-badge {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 6px 12px;
            border: 1px solid;
            display: inline-block;
        }
        .car-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 800;
            color: white;
            line-height: 1.2;
        }
        .detail-row {
            display: flex;
            flex-direction: column;
            gap: 3px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .detail-label {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: #4b5563;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .detail-value {
            font-size: 13px;
            color: #d1d5db;
        }
        .phase-timeline {
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        .phase-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 0;
        }
        .phase-dot {
            width: 16px; height: 16px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
            flex-shrink: 0;
            margin-top: 2px;
            position: relative;
        }
        .phase-dot.active {
            border-color: #dc2626;
            background: #dc2626;
        }
        .phase-dot.done {
            border-color: #16a34a;
            background: #16a34a;
        }
        .phase-dot.active::after {
            content: '';
            position: absolute;
            inset: 3px;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
        }
        .phase-label {
            font-size: 11px;
            color: #6b7280;
            padding-top: 1px;
        }
        .phase-item.active .phase-label { color: #fca5a5; font-weight: 600; }
        .phase-item.done .phase-label { color: #86efac; }

        /* Main chat area */
        .chat-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .messages-container {
            flex: 1;
            overflow-y: auto;
            padding: 24px 28px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .message-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
            max-width: 70%;
        }
        .message-group.buyer { align-self: flex-end; align-items: flex-end; }
        .message-group.rm { align-self: flex-start; align-items: flex-start; }
        .message-sender {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: #4b5563;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0 4px;
        }
        .message-bubble {
            padding: 12px 16px;
            font-size: 14px;
            line-height: 1.55;
            border: 1px solid;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .message-group.buyer .message-bubble {
            background: rgba(220, 38, 38, 0.15);
            border-color: rgba(220, 38, 38, 0.3);
            color: #fecaca;
        }
        .message-group.rm .message-bubble {
            background: rgba(255,255,255,0.06);
            border-color: rgba(255,255,255,0.1);
            color: #e5e7eb;
        }
        .message-time {
            font-size: 10px;
            color: #374151;
            padding: 0 4px;
        }
        .chat-input-area {
            border-top: 1px solid rgba(255,255,255,0.06);
            padding: 12px 24px;
            background: rgba(8, 8, 16, 0.95);
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .chat-input-row {
            display: flex;
            gap: 10px;
            align-items: flex-end;
        }
        .chat-input {
            flex: 1;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 12px 16px;
            color: white;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            resize: none;
            outline: none;
            max-height: 120px;
            transition: border-color 0.2s;
        }
        .chat-input:focus { border-color: rgba(220, 38, 38, 0.5); }
        .chat-input::placeholder { color: #374151; }
        .chat-send-btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            flex-shrink: 0;
            align-self: stretch;
        }
        .chat-send-btn:hover { background: #b91c1c; }
        .chat-send-btn:disabled { background: #374151; cursor: not-allowed; }
        .attach-btn {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            color: #6b7280;
            padding: 0 14px;
            cursor: pointer;
            transition: color 0.2s, border-color 0.2s;
            flex-shrink: 0;
            align-self: stretch;
            display: flex;
            align-items: center;
        }
        .attach-btn:hover { color: #e5e7eb; border-color: rgba(255,255,255,0.25); }
        .attachment-preview {
            display: none;
            align-items: center;
            justify-content: space-between;
            background: rgba(96, 165, 250, 0.08);
            border: 1px solid rgba(96, 165, 250, 0.25);
            padding: 6px 12px;
            font-size: 11px;
            font-family: 'Space Mono', monospace;
            color: #60a5fa;
        }
        .attachment-preview button {
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            font-size: 12px;
            padding: 0;
        }
        .chat-hint {
            font-size: 11px;
            color: #374151;
            padding: 0 28px 8px;
            background: rgba(8,8,16,0.95);
        }
        .no-messages {
            text-align: center;
            padding: 4rem;
            color: #374151;
        }
        .no-messages i { font-size: 2.5rem; margin-bottom: 12px; }
        .no-messages p { font-size: 13px; }
        .typing-indicator {
            display: none;
            align-self: flex-start;
            padding: 10px 16px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            font-size: 12px;
            color: #6b7280;
            font-style: italic;
        }
        /* Dark scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: rgba(255,255,255,0.02); }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
        * { scrollbar-width: thin; scrollbar-color: rgba(255,255,255,0.1) transparent; }
    </style>
</head>
<body>
    <nav class="portal-nav">
        <a href="{{ route('portal.dashboard') }}" class="nav-back">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Portal Saya</span>
        </a>
        <div class="nav-title">
            Konsultasi VIP &nbsp;·&nbsp; <strong>{{ $inquiry->car_model ?? 'Kendaraan VIP' }}</strong>
        </div>
        <div class="flex items-center space-x-2">
            <button onclick="toggleHelpModal()" class="text-neutral-400 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 w-7 h-7 rounded-full flex items-center justify-center transition-colors text-xs cursor-pointer" title="Petunjuk Alur Purchase & Dokumen">
                <i class="fa-solid fa-circle-question text-red-500"></i>
            </button>
            <span class="status-badge {{ $inquiry->statusColor() }}" id="statusBadge">{{ $inquiry->statusLabel() }}</span>
        </div>
    </nav>

    {{-- Help & Guidance Modal --}}
    <div id="helpModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-black/80 backdrop-blur-md p-4">
        <div class="glass-card max-w-lg w-full p-6 border border-white/20 shadow-2xl relative bg-[#0c0c12]">
            <button onclick="toggleHelpModal()" class="absolute top-4 right-4 text-neutral-400 hover:text-white text-lg cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="flex items-center space-x-2 mb-3">
                <i class="fa-solid fa-compass text-red-500 text-base"></i>
                <h3 class="text-base font-serif font-bold text-white uppercase tracking-wider">Petunjuk Alur Transaksi (Phase 1–6)</h3>
            </div>
            <p class="text-xs text-neutral-400 mb-4 font-sans leading-relaxed">
                Berikut adalah panduan langkah yang dilakukan Sales RM dan dokumen yang perlu disiapkan oleh Pembeli:
            </p>
            <div class="space-y-3 text-xs font-mono max-h-[60vh] overflow-y-auto pr-2">
                <div class="p-3 bg-white/5 border-l-2 border-yellow-500">
                    <p class="text-yellow-400 font-bold">1. Phase 1 & 2: Lead & Konsultasi Aktif</p>
                    <p class="text-neutral-300 text-[11px] mt-1">Sales RM mendiskusikan rincian opsi kustomisasi unit & menyusun draft SPK via chat / pertemuan privat.</p>
                </div>
                <div class="p-3 bg-white/5 border-l-2 border-purple-500">
                    <p class="text-purple-400 font-bold">2. Penerbitan SPK (Surat Pemesanan Kendaraan)</p>
                    <p class="text-neutral-300 text-[11px] mt-1">Sales RM memperbarui status ke <strong>SPK Issued</strong>. Rincian VIN/Production Slot & estimasi pengiriman terlampir di portal.</p>
                </div>
                <div class="p-3 bg-white/5 border-l-2 border-orange-500">
                    <p class="text-orange-400 font-bold">3. Phase 3: Upload Dokumen Legalitas (KYC)</p>
                    <p class="text-neutral-300 text-[11px] mt-1">Pembeli mengunggah KTP, KK, NPWP (Perorangan) atau NIB & Akta PT (Korporasi) melalui menu <strong>Profil & Alamat VIP</strong>.</p>
                </div>
                <div class="p-3 bg-white/5 border-l-2 border-cyan-500">
                    <p class="text-cyan-400 font-bold">4. Phase 4 & 5: Kontrak E-Sign & Pembayaran Escrow</p>
                    <p class="text-neutral-300 text-[11px] mt-1">Pembeli menandatangani E-Sign bermeterai digital & melakukan transfer Booking Fee/DP ke Rekening Escrow Terproteksi.</p>
                </div>
                <div class="p-3 bg-white/5 border-l-2 border-red-500">
                    <p class="text-red-400 font-bold">5. Phase 6: White-Glove Delivery Ceremony</p>
                    <p class="text-neutral-300 text-[11px] mt-1">Pengiriman unit menggunakan Enclosed Flatbed Tow Truck tertutup dan seremoni penyerahan kunci.</p>
                </div>
            </div>
            <div class="mt-5 text-right">
                <button onclick="toggleHelpModal()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-mono text-xs font-bold uppercase tracking-wider cursor-pointer">
                    Saya Mengerti
                </button>
            </div>
        </div>
    </div>

    {{-- Phase 4: E-Sign Contract SPA Modal --}}
    <div id="contractModal" style="position: fixed; inset: 0; z-index: 100; display: none; align-items: center; justify-content: center; background: rgba(0, 0, 0, 0.88); backdrop-filter: blur(12px); padding: 20px;">
        <div style="width: 100%; max-width: 640px; background: #0c0c12; border: 1px solid rgba(239, 68, 68, 0.4); padding: 28px; border-radius: 4px; position: relative; box-shadow: 0 25px 60px rgba(0,0,0,0.9); font-family: 'Inter', sans-serif;">
            <button onclick="toggleContractModal()" style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: #9ca3af; font-size: 18px; cursor: pointer;">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- Modal Header -->
            <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                <div style="width: 42px; height: 42px; border-radius: 50%; background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 18px; flex-shrink: 0;">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
                <div>
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 800; color: #ffffff; text-transform: uppercase; margin: 0; letter-spacing: 1px;">Sales &amp; Purchase Agreement (SPA)</h3>
                    <p style="font-size: 11px; font-family: monospace; color: #9ca3af; margin-top: 4px;">No: SPA/APEX/2026/0{{ $inquiry->id }} &nbsp;·&nbsp; Unit: {{ $inquiry->car_model }}</p>
                </div>
            </div>

            <!-- Contract Articles Body -->
            <div style="max-height: 220px; overflow-y: auto; padding: 14px; background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.06); border-radius: 2px; margin-bottom: 20px; line-height: 1.6; font-size: 13px; color: #d1d5db;">
                <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); padding: 12px; margin-bottom: 16px; border-radius: 2px;">
                    <div style="font-family: monospace; font-size: 11px; font-weight: 700; color: #f87171; text-transform: uppercase; margin-bottom: 4px;">
                        <i class="fa-solid fa-shield-halved"></i> Dokumen Resmi &amp; Mengikat Hukum
                    </div>
                    <p style="font-size: 12px; color: #e5e7eb; margin: 0;">Dokumen ini diterbitkan oleh PT Apex Automotive Indonesia dan dilindungi meterai elektronik sah (e-Meterai Republik Indonesia).</p>
                </div>

                <div style="margin-bottom: 14px;">
                    <h4 style="font-family: monospace; font-size: 11px; font-weight: 700; color: #ffffff; text-transform: uppercase; margin: 0 0 4px 0;">PASAL 1 — HAK &amp; KEWAJIBAN PEMBELI</h4>
                    <p style="margin: 0; color: #9ca3af;">Pembeli berhak menerima unit kendaraan <strong style="color: #ffffff;">{{ $inquiry->car_model }}</strong> sesuai spesifikasi kustomisasi yang telah disepakati. Pembeli berkewajiban melakukan pelunasan pembayaran sesuai skema penawaran resmi.</p>
                </div>

                <div style="margin-bottom: 14px;">
                    <h4 style="font-family: monospace; font-size: 11px; font-weight: 700; color: #ffffff; text-transform: uppercase; margin: 0 0 4px 0;">PASAL 2 — GARANSI RESMI &amp; CONCIERGE SERVICE</h4>
                    <p style="margin: 0; color: #9ca3af;">PT Apex Automotive Indonesia memberikan Garansi Manufactory 7 Tahun, Bebas Biaya Servis Berkala 5 Tahun, dan Layanan Emergency Towing Concierge 24/7 di seluruh Indonesia.</p>
                </div>

                <div>
                    <h4 style="font-family: monospace; font-size: 11px; font-weight: 700; color: #ffffff; text-transform: uppercase; margin: 0 0 4px 0;">PASAL 3 — UNVEILING DELIVERY CEREMONY</h4>
                    <p style="margin: 0; color: #9ca3af;">Serah terima unit dilakukan menggunakan armada Enclosed Flatbed Towing tertutup dengan seremoni penyerahan kunci dan pembukaan kain beludru merah.</p>
                </div>
            </div>

            <!-- Signature Form -->
            <form method="POST" action="{{ route('portal.contract.sign', $inquiry) }}" id="esignForm" onsubmit="saveCanvasSignature()">
                @csrf
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <span style="font-family: monospace; font-size: 11px; font-weight: 700; color: #ffffff; text-transform: uppercase;"><i class="fa-solid fa-signature" style="color: #ef4444;"></i> Tanda Tangan Digital Pembeli:</span>
                    <span style="font-size: 10px; font-family: monospace; color: #6b7280;">Tarik garis di box hitam</span>
                </div>

                <div style="position: relative; height: 100px; width: 100%; background: #000000; border: 1px solid rgba(255,255,255,0.2); border-radius: 2px; margin-bottom: 16px;">
                    <canvas id="signatureCanvas" style="width: 100%; height: 100%; display: block; cursor: crosshair;"></canvas>
                    <button type="button" onclick="clearCanvas()" style="position: absolute; top: 8px; right: 8px; background: rgba(255,255,255,0.1); border: none; color: #d1d5db; padding: 4px 10px; font-size: 10px; font-family: monospace; cursor: pointer; border-radius: 2px;">
                        <i class="fa-solid fa-rotate-left"></i> Reset
                    </button>
                </div>
                <input type="hidden" name="buyer_signature_svg" id="signatureInput">

                <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px;">
                    <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #d1d5db; cursor: pointer;">
                        <input type="checkbox" required style="accent-color: #dc2626; width: 16px; height: 16px;">
                        <span>Saya menyetujui seluruh pasal &amp; ketentuan di atas.</span>
                    </label>
                    <button type="submit" style="padding: 12px 24px; background: #dc2626; color: #ffffff; border: none; font-size: 11px; font-weight: 700; font-family: monospace; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; border-radius: 2px; display: flex; align-items: center; gap: 8px; shrink: 0; transition: background 0.2s;">
                        <i class="fa-solid fa-stamp"></i>
                        <span>Bubuhi E-Sign</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Phase 5: Payment Escrow Modal --}}
    <div id="paymentModal" style="position: fixed; inset: 0; z-index: 100; display: none; align-items: center; justify-content: center; background: rgba(0, 0, 0, 0.88); backdrop-filter: blur(12px); padding: 20px;">
        <div style="width: 100%; max-width: 580px; background: #0c0c12; border: 1px solid rgba(59, 130, 246, 0.4); padding: 28px; border-radius: 4px; position: relative; box-shadow: 0 25px 60px rgba(0,0,0,0.9); font-family: 'Inter', sans-serif;">
            <button onclick="togglePaymentModal()" style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: #9ca3af; font-size: 18px; cursor: pointer;">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- Modal Header -->
            <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                <div style="width: 42px; height: 42px; border-radius: 50%; background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.4); display: flex; align-items: center; justify-content: center; color: #60a5fa; font-size: 18px; flex-shrink: 0;">
                    <i class="fa-solid fa-vault"></i>
                </div>
                <div>
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 800; color: #ffffff; text-transform: uppercase; margin: 0; letter-spacing: 1px;">Apex Escrow Financial Settlement</h3>
                    <p style="font-size: 11px; font-family: monospace; color: #9ca3af; margin-top: 4px;">Instruksi Rekening Terproteksi &nbsp;·&nbsp; Unit: {{ $inquiry->car_model }}</p>
                </div>
            </div>

            <!-- Escrow Details -->
            <div style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(59, 130, 246, 0.3); padding: 16px; border-radius: 4px; margin-bottom: 20px;">
                <div style="font-size: 11px; font-family: monospace; font-weight: 700; color: #60a5fa; text-transform: uppercase; margin-bottom: 10px;">
                    <i class="fa-solid fa-building-columns"></i> Rekening Escrow Resmi Apex Automotive
                </div>
                <div style="font-size: 12px; color: #cbd5e1; line-height: 1.8;">
                    <div><strong>Bank:</strong> Bank Central Asia (BCA) — Cabang Pondok Indah</div>
                    <div><strong>Nama Rekening:</strong> PT APEX AUTOMOTIVE INDONESIA (ESCROW ACCOUNT)</div>
                    <div><strong>Nomor Rekening:</strong> <span style="font-family: monospace; font-size: 14px; font-weight: 700; color: #ffffff; background: rgba(255,255,255,0.1); padding: 2px 8px; border-radius: 2px;">8890-1299-8800</span></div>
                </div>
            </div>

            <!-- Payment Options -->
            <div style="margin-bottom: 20px; font-size: 12px; color: #9ca3af; line-height: 1.6;">
                <p style="margin-bottom: 8px;"><strong style="color: #ffffff;">Metode Pembayaran:</strong></p>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); padding: 10px; border-radius: 2px;">
                        <span style="font-weight: 700; color: #ffffff; display: block;">Booking Fee (Lock Slot)</span>
                        <span style="font-size: 11px; color: #64748b;">Rp 100.000.000</span>
                    </div>
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); padding: 10px; border-radius: 2px;">
                        <span style="font-weight: 700; color: #ffffff; display: block;">Pelunasan OTR / DP</span>
                        <span style="font-size: 11px; color: #64748b;">Sesuai SPK Rincian Penawaran</span>
                    </div>
                </div>
            </div>

            <!-- Instructions -->
            <div style="font-size: 11px; color: #9ca3af; background: rgba(255,255,255,0.02); padding: 12px; border-left: 2px solid #2563eb; margin-bottom: 20px;">
                Setelah melakukan transfer, konfirmasikan bukti transfer kepada Sales RM Anda via thread chat konsultasi di samping ini. Status akan diperbarui ke <strong>PAYMENT_VERIFIED</strong>.
            </div>

            <div style="text-align: right;">
                <button onclick="togglePaymentModal()" style="padding: 10px 24px; background: #2563eb; color: #ffffff; border: none; font-size: 11px; font-weight: 700; font-family: monospace; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; border-radius: 2px;">
                    Saya Mengerti
                </button>
            </div>
        </div>
    </div>

    <div class="consultation-layout">
        {{-- Sidebar: Inquiry details --}}
        <aside class="sidebar">
            <div>
                <p class="sidebar-section-label">Kendaraan Pilihan</p>
                <p class="car-title">{{ $inquiry->car_model ?? '—' }}</p>
            </div>

            @if($inquiry->selected_config)
                <div>
                    <p class="sidebar-section-label">Konfigurasi Pilihan</p>
                    <p class="detail-value" style="font-size:12px; color:#9ca3af;">{{ $inquiry->selected_config }}</p>
                </div>
            @endif

            <div>
                <div class="detail-row">
                    <span class="detail-label">Nama</span>
                    <span class="detail-value">{{ $inquiry->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">No. HP / WhatsApp</span>
                    <span class="detail-value">{{ $inquiry->phone }}</span>
                </div>
                @if($inquiry->assigned_rm_name)
                    <div class="detail-row">
                        <span class="detail-label">Sales RM</span>
                        <span class="detail-value">{{ $inquiry->assigned_rm_name }}</span>
                    </div>
                @endif
                <div class="detail-row" style="border-bottom:none;">
                    <span class="detail-label">Dibuat</span>
                    <span class="detail-value">{{ $inquiry->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            {{-- KYC Status Box --}}
            <div style="background: rgba(20, 20, 28, 0.7); border: 1px solid rgba(255, 255, 255, 0.1); padding: 16px; border-radius: 4px; margin-top: 6px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-shield-halved" style="color: #ef4444; font-size: 14px;"></i>
                        <span style="font-size: 11px; font-weight: 700; color: #ef4444; letter-spacing: 1px; text-transform: uppercase;">Legalitas KYC</span>
                    </div>
                    <a href="{{ route('profile.complete') }}" style="font-size: 11px; color: #fbbf24; text-decoration: underline; font-weight: 600;">Edit Profil</a>
                </div>

                @if(auth()->user()->hasCompletedProfile())
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #4ade80; margin-bottom: 10px;">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Tersimpan &amp; Lengkap</span>
                    </div>
                    <div style="font-size: 12px; color: #9ca3af; border-top: 1px solid rgba(255, 255, 255, 0.08); padding-top: 10px; line-height: 1.6;">
                        <div style="margin-bottom: 4px;">
                            <strong style="color: #d1d5db;">NIK:</strong> <span style="color: #e5e7eb;">{{ auth()->user()->nik ?? '—' }}</span>
                        </div>
                        <div>
                            <strong style="color: #d1d5db;">Alamat:</strong>
                            <p style="color: #9ca3af; margin-top: 2px; word-break: break-word;">{{ auth()->user()->address ?? '—' }}</p>
                        </div>
                    </div>
                @else
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #fbbf24; margin-bottom: 12px;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>Belum Lengkap</span>
                    </div>
                    <a href="{{ route('profile.complete') }}" style="display: block; text-align: center; width: 100%; padding: 10px; background: rgba(251, 191, 36, 0.15); border: 1px solid rgba(251, 191, 36, 0.4); color: #fde047; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; border-radius: 2px;">
                        ISI DATA LEGALITAS
                    </a>
                @endif
            </div>

            {{-- Phase 4: SPA Contract E-Sign Box --}}
            <div style="background: rgba(20, 20, 28, 0.7); border: 1px solid rgba(239, 68, 68, 0.3); padding: 16px; border-radius: 4px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                    <i class="fa-solid fa-file-signature" style="color: #ef4444; font-size: 14px;"></i>
                    <span style="font-size: 11px; font-weight: 700; color: #ef4444; letter-spacing: 1px; text-transform: uppercase;">Phase 4: Kontrak Jual Beli</span>
                </div>

                @if($inquiry->buyer_signed)
                    <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); padding: 12px; border-radius: 4px;">
                        <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 700; color: #4ade80; margin-bottom: 6px;">
                            <i class="fa-solid fa-certificate"></i>
                            <span>SPA E-Sign Completed</span>
                        </div>
                        <p style="font-size: 11px; color: #9ca3af; margin-bottom: 10px;">
                            Ditandatangani pada: <span style="color: #e5e7eb;">{{ $inquiry->buyer_signed_at?->format('d M Y, H:i') }}</span>
                        </p>
                        <div style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.4); color: #86efac; font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border-radius: 2px; margin-bottom: 12px;">
                            <i class="fa-solid fa-stamp"></i> e-Meterai Sah
                        </div>
                        <a href="{{ route('portal.contract.download', $inquiry) }}" target="_blank" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 10px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: #ffffff; font-size: 11px; font-weight: 700; font-family: monospace; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; border-radius: 2px;">
                            <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i>
                            <span>Lihat / Cetak Dokumen SPA</span>
                        </a>
                    </div>
                @else
                    <p style="font-size: 12px; color: #9ca3af; line-height: 1.5; margin-bottom: 14px;">
                        Dokumen Perjanjian Jual Beli (Sales &amp; Purchase Agreement) telah siap ditinjau dan ditandatangani secara digital.
                    </p>
                    <button onclick="toggleContractModal()" style="width: 100%; padding: 12px; background: #dc2626; color: #ffffff; border: none; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; border-radius: 2px; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.2s;">
                        <i class="fa-solid fa-pen-nib"></i>
                        <span>Review &amp; E-Sign SPA</span>
                    </button>
                @endif
            {{-- Phase 5: Financial Settlement (Payment Escrow Box) --}}
            <div style="background: rgba(20, 20, 28, 0.7); border: 1px solid rgba(59, 130, 246, 0.4); padding: 16px; border-radius: 4px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                    <i class="fa-solid fa-vault" style="color: #60a5fa; font-size: 14px;"></i>
                    <span style="font-size: 11px; font-weight: 700; color: #60a5fa; letter-spacing: 1px; text-transform: uppercase;">Phase 5: Pembayaran Escrow</span>
                </div>

                @if($inquiry->status === 'payment_verified' || $inquiry->status === 'scheduled_delivery' || $inquiry->status === 'delivered_completed')
                    <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); padding: 12px; border-radius: 4px;">
                        <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 700; color: #4ade80; margin-bottom: 4px;">
                            <i class="fa-solid fa-shield-check"></i>
                            <span>Pembayaran Terverifikasi Escrow</span>
                        </div>
                        <p style="font-size: 11px; color: #9ca3af;">Dana aman tersimpan di Rekening Terproteksi Apex Automotive Indonesia.</p>
                    </div>
                @elseif($inquiry->buyer_signed)
                    <p style="font-size: 12px; color: #9ca3af; line-height: 1.5; margin-bottom: 14px;">
                        Kontrak SPA telah sah. Silakan lakukan pembayaran Booking Fee / Pelunasan ke Rekening Escrow Terproteksi.
                    </p>
                    <button onclick="togglePaymentModal()" style="width: 100%; padding: 12px; background: #2563eb; color: #ffffff; border: none; font-size: 11px; font-weight: 700; font-family: monospace; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; border-radius: 2px; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.2s;">
                        <i class="fa-solid fa-credit-card"></i>
                        <span>Bayar via Escrow Terproteksi</span>
                    </button>
                @else
                    <p style="font-size: 11px; color: #6b7280; font-style: italic;">
                        Instruksi pembayaran akan aktif setelah Dokumen SPA ditandatangani (Phase 4).
                    </p>
                @endif
            </div>

            @if($inquiry->notes)
                <div>
                    <p class="sidebar-section-label">Catatan Awal</p>
                    <p style="font-size: 13px; color: #9ca3af; line-height: 1.55;">{{ $inquiry->notes }}</p>
                </div>
            @endif

            {{-- Phase Timeline --}}
            <div>
                <p class="sidebar-section-label">Progress Fase Pembelian</p>
                @php
                    $statusOrder = ['inquiry_received','consultation_active','spk_issued','kyc_pending','kyc_approved','contract_signed','payment_verified','scheduled_delivery','delivered_completed'];
                    $currentIdx = array_search($inquiry->status, $statusOrder);
                    $phaseStatuses = [
                        0 => ['inquiry_received','consultation_active'],
                        1 => ['consultation_active','spk_issued'],
                        2 => ['kyc_pending','kyc_approved'],
                        3 => ['contract_signed'],
                        4 => ['payment_verified'],
                        5 => ['scheduled_delivery','delivered_completed'],
                    ];
                    $phaseNames = ['Phase 1 — Discovery','Phase 2 — Konsultasi & SPK','Phase 3 — KYC & Dokumen','Phase 4 — Kontrak E-Sign','Phase 5 — Pembayaran','Phase 6 — Pengiriman'];
                    $phaseThresholds = [0,2,4,5,6,7]; // min statusOrder index to be "done"
                @endphp
                <div class="phase-timeline">
                    @foreach($phaseNames as $pi => $pname)
                        @php
                            $pStatuses = $phaseStatuses[$pi];
                            $isActive = in_array($inquiry->status, $pStatuses);
                            $isDone = $currentIdx > $phaseThresholds[$pi];
                        @endphp
                        <div class="phase-item {{ $isActive ? 'active' : ($isDone ? 'done' : '') }}">
                            <div class="phase-dot {{ $isActive ? 'active' : ($isDone ? 'done' : '') }}"></div>
                            <span class="phase-label">{{ $pname }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>

        {{-- Main chat --}}
        <div class="chat-area">
            <div class="messages-container" id="messagesContainer">
                @if($messages->isEmpty())
                    <div class="no-messages">
                        <i class="fa-regular fa-comments"></i>
                        <p>Belum ada pesan. Sales RM kami akan segera menghubungi Anda.<br>Anda juga bisa mulai mengirim pesan di bawah.</p>
                    </div>
                @else
                    @foreach($messages as $msg)
                        <div class="message-group {{ $msg->sender_type }}" data-id="{{ $msg->id }}">
                            <span class="message-sender">
                                @if($msg->sender_type === 'rm')
                                    <i class="fa-solid fa-headset" style="color:#dc2626;"></i>
                                @endif
                                {{ $msg->sender_name }}
                            </span>
                            <div class="message-bubble">{{ $msg->message }}</div>
                            <span class="message-time">{{ $msg->created_at->format('d M, H:i') }}</span>
                        </div>
                    @endforeach
                @endif
                <div class="typing-indicator" id="typingIndicator">Sales RM sedang mengetik…</div>
            </div>
            <div class="chat-input-area">
                <div id="attachmentPreview" class="attachment-preview">
                    <span id="attachmentFileName"><i class="fa-solid fa-paperclip"></i> File terlampir</span>
                    <button type="button" onclick="removeAttachment()"><i class="fa-solid fa-xmark"></i> Batal</button>
                </div>
                <div class="chat-input-row">
                    <input type="file" id="fileInput" accept="image/*,application/pdf" style="display: none;" onchange="handleFileSelect(this)">
                    <button type="button" class="attach-btn" onclick="document.getElementById('fileInput').click()" title="Lampirkan Foto / PDF">
                        <i class="fa-solid fa-paperclip" style="font-size: 15px;"></i>
                    </button>
                    <textarea
                        id="messageInput"
                        class="chat-input"
                        placeholder="Tulis pesan atau lampirkan bukti transfer..."
                        rows="2"
                    ></textarea>
                    <button id="sendBtn" class="chat-send-btn" onclick="sendMessage()">
                        <i class="fa-solid fa-paper-plane"></i> KIRIM
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const INQUIRY_ID = {{ $inquiry->id }};
        const POLL_URL = '{{ route('portal.message.poll', $inquiry) }}';
        const SEND_URL = '{{ route('portal.message.store', $inquiry) }}';
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let lastId = {{ $messages->last()?->id ?? 0 }};
        let selectedFile = null;

        function scrollBottom() {
            const c = document.getElementById('messagesContainer');
            c.scrollTop = c.scrollHeight;
        }
        scrollBottom();

        function handleFileSelect(input) {
            if (input.files && input.files[0]) {
                selectedFile = input.files[0];
                document.getElementById('attachmentFileName').innerHTML = `<i class="fa-solid fa-file text-blue-400 mr-1"></i> ${selectedFile.name} (${Math.round(selectedFile.size/1024)} KB)`;
                document.getElementById('attachmentPreview').style.display = 'flex';
            }
        }

        function removeAttachment() {
            selectedFile = null;
            document.getElementById('fileInput').value = '';
            document.getElementById('attachmentPreview').style.display = 'none';
        }

        function renderMessage(msg) {
            const group = document.createElement('div');
            group.className = `message-group ${msg.sender_type}`;
            group.dataset.id = msg.id;

            const rmIcon = msg.sender_type === 'rm'
                ? '<i class="fa-solid fa-headset" style="color:#dc2626;"></i> '
                : '';

            const time = new Date(msg.created_at).toLocaleString('id-ID', {day:'numeric', month:'short', hour:'2-digit', minute:'2-digit'});

            let attachmentHtml = '';
            const fileUrl = msg.attachment_url || (msg.attachment ? `/storage/${msg.attachment}` : null);
            if (fileUrl) {
                const isImg = fileUrl.match(/\.(jpeg|jpg|gif|png|webp)$/i);
                if (isImg) {
                    attachmentHtml = `<div style="margin-top:6px;"><a href="${fileUrl}" target="_blank"><img src="${fileUrl}" style="max-width:240px; max-height:180px; border-radius:4px; border:1px solid rgba(255,255,255,0.2);"></a></div>`;
                } else {
                    attachmentHtml = `<div style="margin-top:6px;"><a href="${fileUrl}" target="_blank" style="display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); padding:6px 12px; border-radius:2px; color:#60a5fa; text-decoration:underline; font-size:11px; font-family:monospace;"><i class="fa-solid fa-file-pdf"></i> Lihat File Lampiran</a></div>`;
                }
            }

            const messageText = msg.message ? msg.message.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>') : '';

            group.innerHTML = `
                <span class="message-sender">${rmIcon}${msg.sender_name}</span>
                <div class="message-bubble">${messageText}${attachmentHtml}</div>
                <span class="message-time">${time}</span>
            `;
            return group;
        }

        async function pollMessages() {
            try {
                const res = await fetch(`${POLL_URL}?after=${lastId}`, {
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
                });
                const data = await res.json();

                const container = document.getElementById('messagesContainer');
                const noMsg = container.querySelector('.no-messages');

                if (data.messages && data.messages.length > 0) {
                    if (noMsg) noMsg.remove();
                    const typing = document.getElementById('typingIndicator');
                    data.messages.forEach(msg => {
                        const exists = container.querySelector(`[data-id="${msg.id}"]`);
                        if (!exists) {
                            container.insertBefore(renderMessage(msg), typing);
                            lastId = msg.id;
                        }
                    });
                    scrollBottom();
                }

                // Update status badge
                if (data.status_label) {
                    document.getElementById('statusBadge').textContent = data.status_label;
                }
            } catch (e) {
                // silent
            }
        }

        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const text = input.value.trim();
            if (!text && !selectedFile) return;

            const btn = document.getElementById('sendBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim…';

            const formData = new FormData();
            if (text) formData.append('message', text);
            if (selectedFile) formData.append('attachment', selectedFile);

            try {
                const res = await fetch(SEND_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                const data = await res.json();

                if (data.success) {
                    const container = document.getElementById('messagesContainer');
                    const noMsg = container.querySelector('.no-messages');
                    if (noMsg) noMsg.remove();
                    const typing = document.getElementById('typingIndicator');
                    container.insertBefore(renderMessage(data.message), typing);
                    lastId = data.message.id;
                    input.value = '';
                    input.style.height = 'auto';
                    removeAttachment();
                    scrollBottom();
                }
            } catch (e) {
                alert('Gagal mengirim pesan / file. Coba lagi.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> KIRIM';
            }
        }

        // Enter to send, Shift+Enter for newline
        document.getElementById('messageInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Auto-resize textarea
        document.getElementById('messageInput').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        function toggleHelpModal() {
            const modal = document.getElementById('helpModal');
            modal.classList.toggle('hidden');
        }

        function toggleContractModal() {
            const modal = document.getElementById('contractModal');
            if (modal.style.display === 'none' || modal.style.display === '') {
                modal.style.display = 'flex';
                initSignatureCanvas();
            } else {
                modal.style.display = 'none';
            }
        }

        function togglePaymentModal() {
            const modal = document.getElementById('paymentModal');
            if (modal.style.display === 'none' || modal.style.display === '') {
                modal.style.display = 'flex';
            } else {
                modal.style.display = 'none';
            }
        }

        let isDrawing = false;
        let canvas, ctx;

        function initSignatureCanvas() {
            canvas = document.getElementById('signatureCanvas');
            if (!canvas) return;
            ctx = canvas.getContext('2d');
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
            ctx.lineWidth = 2.5;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#dc2626';

            canvas.onmousedown = startDrawing;
            canvas.onmousemove = draw;
            canvas.onmouseup = stopDrawing;

            canvas.ontouchstart = (e) => { startDrawing(e.touches[0]); };
            canvas.ontouchmove = (e) => { draw(e.touches[0]); e.preventDefault(); };
            canvas.ontouchend = stopDrawing;
        }

        function startDrawing(e) {
            isDrawing = true;
            const rect = canvas.getBoundingClientRect();
            ctx.beginPath();
            ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
        }

        function draw(e) {
            if (!isDrawing) return;
            const rect = canvas.getBoundingClientRect();
            ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
            ctx.stroke();
        }

        function stopDrawing() { isDrawing = false; }

        function clearCanvas() {
            if (ctx && canvas) {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            }
        }

        function saveCanvasSignature() {
            if (canvas) {
                document.getElementById('signatureInput').value = canvas.toDataURL();
            }
        }

        // Poll every 3 seconds
        setInterval(pollMessages, 3000);
    </script>
</body>
</html>
