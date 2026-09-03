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
            padding: 16px 24px;
            background: rgba(8, 8, 16, 0.8);
            display: flex;
            gap: 12px;
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
        }
        .chat-send-btn:hover { background: #b91c1c; }
        .chat-send-btn:disabled { background: #374151; cursor: not-allowed; }
        .chat-hint {
            font-size: 11px;
            color: #374151;
            padding: 0 28px 8px;
            background: rgba(8,8,16,0.8);
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
    <div id="contractModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-black/85 backdrop-blur-md p-4">
        <div class="glass-card max-w-2xl w-full p-6 border border-white/20 shadow-2xl relative bg-[#0c0c12] text-xs font-mono max-h-[90vh] flex flex-col">
            <button onclick="toggleContractModal()" class="absolute top-4 right-4 text-neutral-400 hover:text-white text-lg cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="flex items-center space-x-2 mb-2 pb-3 border-b border-white/10 shrink-0">
                <i class="fa-solid fa-file-signature text-red-500 text-lg"></i>
                <div>
                    <h3 class="text-sm font-serif font-bold text-white uppercase tracking-wider">Sales &amp; Purchase Agreement (SPA)</h3>
                    <p class="text-[10px] text-neutral-400 font-mono">No. Kontrak: SPA/APEX/2026/0{{ $inquiry->id }} &nbsp;·&nbsp; Unit: {{ $inquiry->car_model }}</p>
                </div>
            </div>

            <!-- Contract Content Body -->
            <div class="overflow-y-auto pr-2 space-y-4 my-3 text-neutral-300 font-sans text-xs leading-relaxed shrink" style="max-height: 45vh;">
                <div class="p-3 bg-red-600/10 border border-red-600/30 rounded-sm">
                    <p class="text-red-400 font-mono font-bold text-[11px]"><i class="fa-solid fa-shield-halved mr-1"></i> RESMI &amp; MENGIKAT HUKUM</p>
                    <p class="text-[11px] text-neutral-300 mt-0.5">Dokumen ini diterbitkan oleh PT Apex Automotive Indonesia dan dilindungi meterai elektronik sah (e-Meterai Republik Indonesia).</p>
                </div>

                <div>
                    <h4 class="font-bold text-white uppercase font-mono text-[11px] mb-1">PASAL 1 — HAK &amp; KEWAJIBAN PEMBELI</h4>
                    <p class="text-neutral-400 text-[11px]">Pembeli berhak menerima unit kendaraan <strong>{{ $inquiry->car_model }}</strong> sesuai spesifikasi kustomisasi yang telah disepakati. Pembeli berkewajiban melakukan pelunasan pembayaran sesuai skema penawaran resmi.</p>
                </div>

                <div>
                    <h4 class="font-bold text-white uppercase font-mono text-[11px] mb-1">PASAL 2 — GARANSI RESMI &amp; WHITE-GLOVE SERVICE</h4>
                    <p class="text-neutral-400 text-[11px]">PT Apex Automotive Indonesia memberikan Garansi Manufactory 7 Tahun, Bebas Biaya Servis Berkala 5 Tahun, dan Layanan Emergency Towing Concierge 24/7 di seluruh wilayah Indonesia.</p>
                </div>

                <div>
                    <h4 class="font-bold text-white uppercase font-mono text-[11px] mb-1">PASAL 3 — KETENTUAN SERAH TERIMA VEHICLE UNVEILING</h4>
                    <p class="text-neutral-400 text-[11px]">Serah terima unit dilakukan menggunakan pengangkut tertutup (Enclosed Flatbed Towing) dengan seremoni pembukaan kain penutup beludru merah di lokasi tujuan yang ditentukan pembeli.</p>
                </div>
            </div>

            <!-- Signature Area -->
            <div class="border-t border-white/10 pt-3 shrink-0">
                <form method="POST" action="{{ route('portal.contract.sign', $inquiry) }}" id="esignForm" onsubmit="saveCanvasSignature()">
                    @csrf
                    <p class="text-[11px] font-mono text-white font-bold mb-2 uppercase flex items-center justify-between">
                        <span><i class="fa-solid fa-signature text-red-500 mr-1"></i> Tanda Tangan Digital Pembeli:</span>
                        <span class="text-[9px] text-neutral-500 font-normal">Tarik garis tanda tangan di bawah ini</span>
                    </p>
                    <div class="border border-white/20 bg-neutral-950 rounded-sm relative" style="height: 90px;">
                        <canvas id="signatureCanvas" class="w-full h-full cursor-crosshair"></canvas>
                        <button type="button" onclick="clearCanvas()" class="absolute top-2 right-2 text-[9px] font-mono bg-white/10 hover:bg-white/20 px-2 py-1 text-neutral-300 rounded-sm">
                            <i class="fa-solid fa-rotate-left"></i> Reset
                        </button>
                    </div>
                    <input type="hidden" name="buyer_signature_svg" id="signatureInput">

                    <div class="flex items-center justify-between mt-4">
                        <label class="flex items-center space-x-2 text-[10px] text-neutral-300 font-sans cursor-pointer">
                            <input type="checkbox" required class="accent-red-600">
                            <span>Saya menyetujui seluruh pasal &amp; ketentuan di atas.</span>
                        </label>
                        <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-mono text-xs font-bold uppercase tracking-wider transition-all shadow-lg flex items-center space-x-2 cursor-pointer">
                            <i class="fa-solid fa-stamp"></i>
                            <span>Bubuhi E-Sign &amp; Meterai</span>
                        </button>
                    </div>
                </form>
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
            <div class="p-3 bg-white/5 border border-white/10 rounded-sm">
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-[9px] font-mono text-red-500 uppercase tracking-widest font-bold">Data Legalitas KYC</span>
                    <a href="{{ route('profile.complete') }}" class="text-[9px] font-mono text-amber-400 hover:text-amber-300 underline font-bold">Edit Profil</a>
                </div>
                @if(auth()->user()->hasCompletedProfile())
                    <p class="text-xs text-green-400 font-mono font-semibold flex items-center gap-1"><i class="fa-solid fa-circle-check text-[10px]"></i> Tersimpan &amp; Lengkap</p>
                    <p class="text-[10px] text-neutral-400 mt-1 font-mono">NIK: {{ auth()->user()->nik ?? '—' }}</p>
                    <p class="text-[10px] text-neutral-400 font-mono truncate">Alamat: {{ auth()->user()->address ?? '—' }}</p>
                @else
                    <p class="text-xs text-amber-400 font-mono font-semibold flex items-center gap-1"><i class="fa-solid fa-triangle-exclamation text-[10px]"></i> Belum Lengkap</p>
                    <a href="{{ route('profile.complete') }}" class="mt-1.5 inline-block px-2.5 py-1 bg-amber-500/20 border border-amber-500/40 text-amber-300 text-[10px] font-mono font-bold tracking-wider hover:bg-amber-500/30">ISI DATA LEGALITAS</a>
                @endif
            </div>

            {{-- Phase 4: SPA Contract E-Sign Box --}}
            <div class="p-3.5 bg-neutral-900 border border-red-600/30 rounded-sm">
                <div class="flex items-center space-x-2 mb-2">
                    <i class="fa-solid fa-file-signature text-red-500 text-sm"></i>
                    <span class="text-[10px] font-mono text-red-500 uppercase tracking-widest font-bold">Phase 4: Kontrak Jual Beli (SPA)</span>
                </div>
                @if($inquiry->buyer_signed)
                    <div class="bg-green-500/10 border border-green-500/30 p-2.5 rounded-sm">
                        <p class="text-xs text-green-400 font-mono font-bold flex items-center gap-1.5"><i class="fa-solid fa-certificate"></i> SPA E-Sign Completed</p>
                        <p class="text-[10px] text-neutral-400 font-mono mt-1">Ditandatangani pada: {{ $inquiry->buyer_signed_at?->format('d M Y, H:i') }}</p>
                        <span class="inline-block mt-2 px-2 py-0.5 bg-green-500/20 text-green-300 text-[9px] font-mono font-bold tracking-wider uppercase border border-green-500/40"><i class="fa-solid fa-stamp mr-1"></i> Terbubuhi e-Meterai Sah</span>
                    </div>
                @else
                    <p class="text-xs text-neutral-300 font-sans leading-relaxed mb-3">
                        Dokumen Perjanjian Jual Beli (Sales &amp; Purchase Agreement) telah siap ditinjau dan ditandatangani secara digital bermeterai e-Meterai.
                    </p>
                    <button onclick="toggleContractModal()" class="w-full py-2 bg-red-600 hover:bg-red-700 text-white font-mono text-[11px] font-bold tracking-wider uppercase transition-all shadow-md flex items-center justify-center space-x-2 cursor-pointer">
                        <i class="fa-solid fa-pen-nib"></i>
                        <span>Review &amp; E-Sign SPA</span>
                    </button>
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
            <p class="chat-hint">Tekan Enter untuk kirim, Shift+Enter untuk baris baru</p>
            <div class="chat-input-area">
                <textarea
                    id="messageInput"
                    class="chat-input"
                    placeholder="Tulis pesan Anda kepada Sales RM…"
                    rows="2"
                ></textarea>
                <button id="sendBtn" class="chat-send-btn" onclick="sendMessage()">
                    <i class="fa-solid fa-paper-plane"></i> KIRIM
                </button>
            </div>
        </div>
    </div>

    <script>
        const INQUIRY_ID = {{ $inquiry->id }};
        const POLL_URL = '{{ route('portal.message.poll', $inquiry) }}';
        const SEND_URL = '{{ route('portal.message.store', $inquiry) }}';
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let lastId = {{ $messages->last()?->id ?? 0 }};

        function scrollBottom() {
            const c = document.getElementById('messagesContainer');
            c.scrollTop = c.scrollHeight;
        }
        scrollBottom();

        function renderMessage(msg) {
            const group = document.createElement('div');
            group.className = `message-group ${msg.sender_type}`;
            group.dataset.id = msg.id;

            const rmIcon = msg.sender_type === 'rm'
                ? '<i class="fa-solid fa-headset" style="color:#dc2626;"></i> '
                : '';

            const time = new Date(msg.created_at).toLocaleString('id-ID', {day:'numeric', month:'short', hour:'2-digit', minute:'2-digit'});

            group.innerHTML = `
                <span class="message-sender">${rmIcon}${msg.sender_name}</span>
                <div class="message-bubble">${msg.message.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>')}</div>
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
                // Network error — silently ignore
            }
        }

        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const btn = document.getElementById('sendBtn');
            const text = input.value.trim();
            if (!text) return;

            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim…';

            try {
                const res = await fetch(SEND_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: text })
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
                    scrollBottom();
                }
            } catch (e) {
                alert('Gagal mengirim pesan. Coba lagi.');
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
            modal.classList.toggle('hidden');
            if (!modal.classList.contains('hidden')) {
                initSignatureCanvas();
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
