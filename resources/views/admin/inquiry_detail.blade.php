<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RM — {{ $inquiry->name }} — Apex Admin</title>
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
        body {
            font-family: 'Inter', sans-serif;
            background: #060609;
            color: #e5e7eb;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .admin-nav {
            background: rgba(6, 6, 9, 0.98);
            border-bottom: 1px solid rgba(220, 38, 38, 0.2);
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            z-index: 50;
        }
        .nav-back { display: flex; align-items: center; gap: 10px; text-decoration: none; color: #9ca3af; font-size: 13px; transition: color 0.2s; }
        .nav-back:hover { color: white; }
        .admin-badge { font-family: 'Space Mono', monospace; font-size: 9px; color: #dc2626; border: 1px solid rgba(220,38,38,0.4); padding: 3px 8px; letter-spacing: 0.15em; font-weight: 700; text-transform: uppercase; }
        .layout {
            display: flex;
            flex: 1;
            overflow: hidden;
        }
        .sidebar {
            width: 340px;
            flex-shrink: 0;
            border-right: 1px solid rgba(255,255,255,0.06);
            background: rgba(255,255,255,0.01);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .sidebar-inner { padding: 24px 20px; display: flex; flex-direction: column; gap: 18px; }
        .section-label { font-family: 'Space Mono', monospace; font-size: 9px; color: #4b5563; letter-spacing: 0.15em; text-transform: uppercase; margin-bottom: 8px; }
        .buyer-name { font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 800; color: white; }
        .detail-row { padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.04); }
        .detail-label { font-family: 'Space Mono', monospace; font-size: 9px; color: #4b5563; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 3px; }
        .detail-value { font-size: 13px; color: #d1d5db; }
        .status-form { display: flex; flex-direction: column; gap: 8px; }
        .status-select {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            padding: 8px 12px;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            width: 100%;
            outline: none;
        }
        .status-select option { background: #1a1a24; }
        .btn-update {
            background: #dc2626;
            color: white;
            border: none;
            padding: 10px 16px;
            cursor: pointer;
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            transition: background 0.2s;
        }
        .btn-update:hover { background: #b91c1c; }
        .alert-success { background: rgba(22,163,74,0.1); border: 1px solid rgba(22,163,74,0.3); color: #86efac; padding: 10px 14px; font-size: 12px; margin: 12px 20px 0; }

        /* Chat */
        .chat-area { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .messages-container { flex: 1; overflow-y: auto; padding: 24px 28px; display: flex; flex-direction: column; gap: 14px; }
        .message-group { display: flex; flex-direction: column; gap: 4px; max-width: 68%; }
        .message-group.rm { align-self: flex-end; align-items: flex-end; }
        .message-group.buyer { align-self: flex-start; align-items: flex-start; }
        .message-sender { font-family: 'Space Mono', monospace; font-size: 9px; color: #4b5563; text-transform: uppercase; letter-spacing: 0.1em; padding: 0 4px; }
        .message-bubble { padding: 12px 16px; font-size: 14px; line-height: 1.55; border: 1px solid; word-break: break-word; display: flex; flex-direction: column; gap: 6px; }
        .message-bubble .msg-text { white-space: pre-wrap; }
        .message-group.rm .message-bubble { background: rgba(220,38,38,0.12); border-color: rgba(220,38,38,0.3); color: #fecaca; }
        .message-group.buyer .message-bubble { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); color: #e5e7eb; }
        .message-time { font-size: 10px; color: #374151; padding: 0 4px; }

        .chat-input-area { border-top: 1px solid rgba(255,255,255,0.06); padding: 12px 24px; background: rgba(6,6,9,0.95); display: flex; flex-direction: column; gap: 8px; }
        .chat-input-row { display: flex; gap: 10px; align-items: flex-end; }
        .chat-input { flex: 1; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); padding: 12px 16px; color: white; font-size: 14px; font-family: 'Inter', sans-serif; resize: none; outline: none; max-height: 120px; transition: border-color 0.2s; }
        .chat-input:focus { border-color: rgba(220,38,38,0.5); }
        .chat-input::placeholder { color: #374151; }
        .chat-send-btn { background: #dc2626; color: white; border: none; padding: 12px 20px; cursor: pointer; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; transition: background 0.2s; display: flex; align-items: center; gap: 8px; flex-shrink: 0; align-self: stretch; }
        .chat-send-btn:hover { background: #b91c1c; }
        .chat-send-btn:disabled { background: #374151; cursor: not-allowed; }
        .attach-btn { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: #6b7280; padding: 0 14px; cursor: pointer; flex-shrink: 0; align-self: stretch; display: flex; align-items: center; transition: color 0.2s, border-color 0.2s; }
        .attach-btn:hover { color: #e5e7eb; border-color: rgba(255,255,255,0.25); }
        .loc-btn { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: #6b7280; padding: 0 14px; cursor: pointer; flex-shrink: 0; align-self: stretch; display: flex; align-items: center; transition: color 0.2s, border-color 0.2s; }
        .loc-btn:hover { color: #22d3ee; border-color: rgba(34,211,238,0.35); }
        .location-card { background: rgba(34,211,238,0.05); border: 1px solid rgba(34,211,238,0.2); padding: 8px; display: flex; flex-direction: column; gap: 6px; max-width: 260px; }
        .loc-map-render { width: 244px; height: 150px; }
        .loc-open-btn { display: inline-flex; align-items: center; gap: 5px; font-size: 10px; font-family: 'Space Mono', monospace; color: #22d3ee; text-decoration: none; letter-spacing: 0.05em; }
        .loc-open-btn:hover { text-decoration: underline; }
        .loc-label { font-family: 'Space Mono', monospace; font-size: 9px; color: #22d3ee; letter-spacing: 0.12em; text-transform: uppercase; }
        .attachment-preview { display: none; align-items: center; justify-content: space-between; background: rgba(96,165,250,0.08); border: 1px solid rgba(96,165,250,0.25); padding: 6px 12px; font-size: 11px; font-family: 'Space Mono', monospace; color: #60a5fa; }
        .attachment-preview button { background: none; border: none; color: #ef4444; cursor: pointer; font-size: 12px; padding: 0; }
        .chat-hint { font-size: 11px; color: #374151; padding: 0 28px 8px; background: rgba(6,6,9,0.95); }
        /* Dark scrollbar — track black, thumb red */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #06060a; }
        ::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #b91c1c; }
        * { scrollbar-width: thin; scrollbar-color: #dc2626 #06060a; }
    </style>
</head>
<body>
    <nav class="admin-nav">
        <a href="{{ route('admin.inquiries.index') }}" class="nav-back">
            <i class="fa-solid fa-arrow-left"></i> Semua Inquiry
        </a>
        <div style="display:flex; align-items:center; gap:12px;">
            <a href="{{ route('admin.profile.show') }}" style="color:#e5e7eb; text-decoration:none; font-family:'Space Mono', monospace; font-size:10px; text-transform:uppercase; border:1px solid rgba(220,38,38,0.4); padding:4px 10px; border-radius:4px; transition:all 0.2s; background:rgba(220,38,38,0.1);">
                <i class="fa-solid fa-id-card mr-1" style="color:#dc2626;"></i> Profil & ID Card
            </a>
            <span class="admin-badge">RM Panel</span>
        </div>
    </nav>

    <div class="layout">
        <aside class="sidebar">
            @if(session('success'))
                <div class="alert-success"><i class="fa-solid fa-circle-check mr-1"></i> {{ session('success') }}</div>
            @endif

            <div class="sidebar-inner">
                <div>
                    <p class="section-label">Pembeli</p>
                    <p class="buyer-name">{{ $inquiry->name }}</p>
                </div>

                <div>
                    <div class="detail-row">
                        <p class="detail-label">Email</p>
                        <p class="detail-value">{{ $inquiry->email ?? '—' }}</p>
                    </div>
                    <div class="detail-row">
                        <p class="detail-label">No. HP / WhatsApp</p>
                        <p class="detail-value">{{ $inquiry->phone }}</p>
                    </div>
                    <div class="detail-row">
                        <p class="detail-label">Kendaraan</p>
                        <p class="detail-value" style="font-weight:600; color:white;">{{ $inquiry->car_model ?? '—' }}</p>
                    </div>
                    @if($inquiry->selected_config)
                        <div class="detail-row">
                            <p class="detail-label">Konfigurasi</p>
                            <p class="detail-value" style="font-size:12px;">{{ $inquiry->selected_config }}</p>
                        </div>
                    @endif
                    @if($inquiry->notes)
                        <div class="detail-row">
                            <p class="detail-label">Catatan Pembeli</p>
                            <p class="detail-value" style="font-size:12px; color:#9ca3af;">{{ $inquiry->notes }}</p>
                        </div>
                    @endif
                    <div class="detail-row" style="border:none;">
                        <p class="detail-label">Diterima</p>
                        <p class="detail-value">{{ $inquiry->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                {{-- Buyer KYC Profile for Sales RM --}}
                @if($inquiry->user)
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); padding: 12px; border-radius: 2px;">
                        <p class="section-label" style="color: #dc2626; margin-bottom: 6px;">Berkas Legalitas KYC Pembeli</p>
                        @if($inquiry->user->hasCompletedProfile())
                            <div style="font-size: 11px; color: #86efac; font-family: monospace; font-weight: 700; margin-bottom: 6px;">
                                <i class="fa-solid fa-circle-check"></i> PROFIL VERIFIED
                            </div>
                            <div class="detail-row" style="padding:4px 0;">
                                <p class="detail-label">Kepemilikan</p>
                                <p class="detail-value" style="font-size:12px; text-transform:uppercase; font-weight:600;">{{ $inquiry->user->ownership_type === 'company' ? 'PT / Korporasi' : 'Perorangan' }}</p>
                            </div>
                            <div class="detail-row" style="padding:4px 0;">
                                <p class="detail-label">NIK (KTP)</p>
                                <p class="detail-value" style="font-size:12px;">{{ $inquiry->user->nik ?? '—' }}</p>
                            </div>
                            <div class="detail-row" style="padding:4px 0;">
                                <p class="detail-label">NPWP</p>
                                <p class="detail-value" style="font-size:12px;">{{ $inquiry->user->npwp ?? '—' }}</p>
                            </div>
                            <div class="detail-row" style="padding:4px 0;">
                                <p class="detail-label">Alamat STNK / Pengiriman</p>
                                <p class="detail-value" style="font-size:12px;">{{ $inquiry->user->address }}, {{ $inquiry->user->city }}, {{ $inquiry->user->province }} ({{ $inquiry->user->postal_code }})</p>
                            </div>

                            {{-- FILE LINKS --}}
                            <div style="margin-top: 8px; pt: 8px; border-t: 1px dashed rgba(255,255,255,0.1); display: flex; flex-direction: column; gap: 4px;">
                                <p class="detail-label" style="color: #dc2626;">File Berkas Dokumen:</p>
                                @if($inquiry->user->ktp_file)
                                    <a href="{{ asset('storage/'.$inquiry->user->ktp_file) }}" target="_blank" style="font-size: 11px; font-family: monospace; color: #60a5fa; text-decoration: underline;"><i class="fa-solid fa-file-pdf"></i> Lihat File KTP / Passport</a>
                                @endif
                                @if($inquiry->user->kk_file)
                                    <a href="{{ asset('storage/'.$inquiry->user->kk_file) }}" target="_blank" style="font-size: 11px; font-family: monospace; color: #60a5fa; text-decoration: underline;"><i class="fa-solid fa-file-pdf"></i> Lihat File Kartu Keluarga</a>
                                @endif
                                @if($inquiry->user->nib_file)
                                    <a href="{{ asset('storage/'.$inquiry->user->nib_file) }}" target="_blank" style="font-size: 11px; font-family: monospace; color: #60a5fa; text-decoration: underline;"><i class="fa-solid fa-file-pdf"></i> Lihat File NIB Perusahaan</a>
                                @endif
                                @if($inquiry->user->akta_file)
                                    <a href="{{ asset('storage/'.$inquiry->user->akta_file) }}" target="_blank" style="font-size: 11px; font-family: monospace; color: #60a5fa; text-decoration: underline;"><i class="fa-solid fa-file-pdf"></i> Lihat File Akta Pendirian</a>
                                @endif
                                @if(!$inquiry->user->ktp_file && !$inquiry->user->kk_file && !$inquiry->user->nib_file && !$inquiry->user->akta_file)
                                    <p style="font-size: 10px; color: #9ca3af; font-family: monospace;">Belum ada lampiran file fisik diunggah.</p>
                                @endif
                            </div>
                        @else
                            <div style="font-size: 11px; color: #fbbf24; font-family: monospace; font-weight: 700;">
                                <i class="fa-solid fa-triangle-exclamation"></i> Belum Lengkap / Pending Upload
                            </div>
                        @endif
                    </div>
                @endif

                @if($inquiry->buyer_signed)
                    <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); padding: 12px; border-radius: 4px; margin-bottom: 16px;">
                        <div style="font-size: 11px; font-weight: 700; color: #4ade80; font-family: monospace; text-transform: uppercase; margin-bottom: 4px;">
                            <i class="fa-solid fa-file-signature text-green-400"></i> Kontrak Jual Beli (SPA) E-Sign
                        </div>
                        <p style="font-size: 10px; color: #9ca3af; font-family: monospace; margin-bottom: 8px;">Ditandatangani oleh Pembeli: {{ $inquiry->buyer_signed_at?->format('d M Y, H:i') }}</p>
                        <a href="{{ route('admin.inquiries.contract.download', $inquiry) }}" target="_blank" style="display: block; text-align: center; padding: 8px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #ffffff; font-size: 10px; font-family: monospace; font-weight: 700; text-decoration: none; border-radius: 2px;">
                            <i class="fa-solid fa-print text-red-500 mr-1"></i> CETAK / DOKUMEN RESMI SPA
                        </a>
                    </div>
                @endif

                {{-- Status Update Form --}}
                <div>
                    <p class="section-label">Update Status</p>
                    <form method="POST" action="{{ route('admin.inquiries.status', $inquiry) }}" class="status-form">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="status-select">
                            @foreach(\App\Models\Inquiry::statusLabels() as $code => $label)
                                <option value="{{ $code }}" {{ $inquiry->status === $code ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn-update"><i class="fa-solid fa-arrows-rotate mr-1"></i> Update Status</button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Chat Area --}}
        <div class="chat-area">
            <div class="messages-container" id="messagesContainer">
                @if($inquiry->messages->isEmpty())
                    <div style="text-align:center; padding:4rem; color:#374151; font-size:14px;">
                        <i class="fa-regular fa-comments" style="font-size:2.5rem; margin-bottom:12px; display:block;"></i>
                        Belum ada pesan. Kirim pesan pertama kepada pembeli.
                    </div>
                @else
                    @foreach($inquiry->messages as $msg)
                        @php $isLoc = $msg->message && str_starts_with($msg->message, '__LOCATION__:'); @endphp
                        <div class="message-group {{ $msg->sender_type }}" data-id="{{ $msg->id }}">
                            <span class="message-sender">
                                @if($msg->sender_type === 'rm')
                                    <i class="fa-solid fa-headset" style="color:#dc2626;"></i>
                                @else
                                    <i class="fa-solid fa-user" style="color:#6b7280;"></i>
                                @endif
                                {{ $msg->sender_name }}
                            </span>
                            <div class="message-bubble">
                                @if($isLoc)
                                    @php
                                        [$lat,$lng] = explode(',', str_replace('__LOCATION__:','',$msg->message));
                                        $mapId = 'loc-map-'.$msg->id;
                                    @endphp
                                    <div class="location-card" data-location="{{ trim($lat) }},{{ trim($lng) }}" data-mapid="{{ $mapId }}">
                                        <div style="display:flex; justify-content:space-between; align-items:center;">
                                            <div class="loc-label"><i class="fa-solid fa-location-dot"></i> LOKASI DIKIRIM</div>
                                            <div class="loc-menu-wrap" style="position:relative;">
                                                <button type="button" onclick="toggleLocMenu(event, '{{ $msg->id }}')" style="background:none; border:none; color:#9ca3af; cursor:pointer; padding:2px 6px;"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                                <div id="loc-dropdown-{{ $msg->id }}" class="loc-dropdown" style="display:none; position:absolute; right:0; top:20px; background:#0d0d18; border:1px solid rgba(255,255,255,0.15); border-radius:4px; z-index:99; width:170px; box-shadow:0 10px 25px rgba(0,0,0,0.8);">
                                                    <button type="button" onclick="verifyLocationAction('{{ trim($lat) }},{{ trim($lng) }}')" style="width:100%; text-align:left; padding:8px 12px; background:none; border:none; color:#22d3ee; font-size:11px; font-family:'Space Mono',monospace; cursor:pointer; display:flex; align-items:center; gap:8px;"><i class="fa-solid fa-circle-check"></i> Verifikasi Lokasi</button>
                                                    <button type="button" onclick="rejectLocationAction()" style="width:100%; text-align:left; padding:8px 12px; background:none; border:none; color:#ef4444; font-size:11px; font-family:'Space Mono',monospace; cursor:pointer; display:flex; align-items:center; gap:8px; border-top:1px solid rgba(255,255,255,0.05);"><i class="fa-solid fa-circle-xmark"></i> Tolak Lokasi</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="{{ $mapId }}" class="loc-map-render"></div>
                                        <a href="https://www.google.com/maps?q={{ trim($lat) }},{{ trim($lng) }}" target="_blank" class="loc-open-btn">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka di Google Maps
                                        </a>
                                    </div>
                                @else
                                    <span class="msg-text">{{ $msg->message }}</span>
                                    @if($msg->attachment)
                                        @php $attachPath = str_replace('\\', '/', $msg->attachment); $ext = strtolower(pathinfo($attachPath, PATHINFO_EXTENSION)); @endphp
                                        @if(in_array($ext, ['jpg','jpeg','png','webp','gif']))
                                            <a href="{{ asset('storage/'.$attachPath) }}" target="_blank">
                                                <img src="{{ asset('storage/'.$attachPath) }}" style="max-width:240px; max-height:180px; border-radius:4px; border:1px solid rgba(255,255,255,0.2); display:block;">
                                            </a>
                                        @else
                                            <a href="{{ asset('storage/'.$attachPath) }}" target="_blank" style="display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); padding:6px 12px; color:#60a5fa; text-decoration:underline; font-size:11px; font-family:monospace;">
                                                <i class="fa-solid fa-file-pdf"></i> Lihat File Lampiran
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            </div>
                            <span class="message-time">{{ $msg->created_at->format('j M, H:i') }}</span>
                        </div>
                    @endforeach
                @endif
                <div id="typingIndicator" style="display:none; align-self:flex-start; padding:10px 16px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); font-size:12px; color:#6b7280; font-style:italic;">Pembeli sedang mengetik…</div>
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
                    <button type="button" class="loc-btn" onclick="openLocationModal()" title="Kirim Lokasi">
                        <i class="fa-solid fa-location-dot" style="font-size: 15px;"></i>
                    </button>
                    <textarea id="messageInput" class="chat-input" placeholder="Tulis balasan atau lampirkan file..." rows="2"></textarea>
                    <button id="sendBtn" class="chat-send-btn" onclick="sendMessage()">
                        <i class="fa-solid fa-paper-plane"></i> KIRIM
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const POLL_URL  = '{{ route('admin.inquiries.poll', $inquiry) }}';
        const SEND_URL  = '{{ route('admin.inquiries.message', $inquiry) }}';
        const CSRF      = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let lastId      = {{ $inquiry->messages->last()?->id ?? 0 }};

        function scrollBottom() {
            const c = document.getElementById('messagesContainer');
            c.scrollTop = c.scrollHeight;
        }
        scrollBottom();

        let selectedFile = null;

        function handleFileSelect(input) {
            if (input.files && input.files[0]) {
                selectedFile = input.files[0];
                document.getElementById('attachmentFileName').innerHTML = `<i class="fa-solid fa-file"></i> ${selectedFile.name} (${Math.round(selectedFile.size/1024)} KB)`;
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
                : '<i class="fa-solid fa-user" style="color:#6b7280;"></i> ';
            const time = new Date(msg.created_at).toLocaleString('id-ID', {day:'numeric', month:'short', hour:'2-digit', minute:'2-digit'});
            let contentHtml = '';
            if (msg.message && msg.message.startsWith('__LOCATION__:')) {
                const parts = msg.message.replace('__LOCATION__:', '').split(',');
                const lat = parseFloat(parts[0]), lng = parseFloat(parts[1]);
                const mapDivId = `loc-map-${msg.id}`;
                contentHtml = `
                    <div class="location-card" data-location="${lat},${lng}" data-mapid="${mapDivId}">
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <div class="loc-label"><i class="fa-solid fa-location-dot"></i> LOKASI DIKIRIM</div>
                            <div class="loc-menu-wrap" style="position:relative;">
                                <button type="button" onclick="toggleLocMenu(event, '${msg.id}')" style="background:none; border:none; color:#9ca3af; cursor:pointer; padding:2px 6px;"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                <div id="loc-dropdown-${msg.id}" class="loc-dropdown" style="display:none; position:absolute; right:0; top:20px; background:#0d0d18; border:1px solid rgba(255,255,255,0.15); border-radius:4px; z-index:99; width:170px; box-shadow:0 10px 25px rgba(0,0,0,0.8);">
                                    <button type="button" onclick="verifyLocationAction('${lat},${lng}')" style="width:100%; text-align:left; padding:8px 12px; background:none; border:none; color:#22d3ee; font-size:11px; font-family:'Space Mono',monospace; cursor:pointer; display:flex; align-items:center; gap:8px;"><i class="fa-solid fa-circle-check"></i> Verifikasi Lokasi</button>
                                    <button type="button" onclick="rejectLocationAction()" style="width:100%; text-align:left; padding:8px 12px; background:none; border:none; color:#ef4444; font-size:11px; font-family:'Space Mono',monospace; cursor:pointer; display:flex; align-items:center; gap:8px; border-top:1px solid rgba(255,255,255,0.05);"><i class="fa-solid fa-circle-xmark"></i> Tolak Lokasi</button>
                                </div>
                            </div>
                        </div>
                        <div id="${mapDivId}" class="loc-map-render"></div>
                        <a href="https://www.google.com/maps?q=${lat},${lng}" target="_blank" class="loc-open-btn">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka di Google Maps
                        </a>
                    </div>`;
            } else {
                const fileUrl = msg.attachment_url || (msg.attachment ? `/storage/${msg.attachment}` : null);
                let attachHtml = '';
                if (fileUrl) {
                    const isImg = fileUrl.match(/\.(jpeg|jpg|gif|png|webp)$/i);
                    attachHtml = isImg
                        ? `<a href="${fileUrl}" target="_blank"><img src="${fileUrl}" style="max-width:240px;max-height:180px;border-radius:4px;border:1px solid rgba(255,255,255,0.2);display:block;"></a>`
                        : `<a href="${fileUrl}" target="_blank" style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);padding:6px 12px;color:#60a5fa;text-decoration:underline;font-size:11px;font-family:monospace;"><i class="fa-solid fa-file-pdf"></i> Lihat File Lampiran</a>`;
                }
                const msgText = msg.message ? `<span class="msg-text">${msg.message.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>')}</span>` : '';
                contentHtml = msgText + attachHtml;
            }
            group.innerHTML = `
                <span class="message-sender">${rmIcon}${msg.sender_name}</span>
                <div class="message-bubble">${contentHtml}</div>
                <span class="message-time">${time}</span>`;
            return group;
        }

        async function pollMessages() {
            try {
                const res = await fetch(`${POLL_URL}?after=${lastId}`, {
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
                });
                const data = await res.json();
                const container = document.getElementById('messagesContainer');
                const typing = document.getElementById('typingIndicator');
                if (data.messages && data.messages.length > 0) {
                    data.messages.forEach(msg => {
                        if (!container.querySelector(`[data-id="${msg.id}"]`)) {
                            container.insertBefore(renderMessage(msg), typing);
                            lastId = msg.id;
                        }
                    });
                    scrollBottom();
                    setTimeout(initLocationMaps, 120);
                }
            } catch (e) {}
        }

        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const btn   = document.getElementById('sendBtn');
            const text  = input.value.trim();
            if (!text && !selectedFile) return;

            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim…';

            const formData = new FormData();
            if (text) formData.append('message', text);
            if (selectedFile) formData.append('attachment', selectedFile);

            try {
                const res = await fetch(SEND_URL, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                    body: formData
                });
                const data = await res.json();
                if (data.success) {
                    const container = document.getElementById('messagesContainer');
                    const noMsg = container.querySelector('div[style*="text-align:center"]');
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
                alert('Gagal mengirim. Coba lagi.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> KIRIM';
            }
        }

        document.getElementById('messageInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        document.getElementById('messageInput').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        // === LOCATION FEATURE ===
        let locationMap = null, locationMarker = null, selectedLat = null, selectedLng = null;
        const initializedMaps = new Set();

        function initLocationMaps() {
            document.querySelectorAll('[data-location]').forEach(el => {
                const mapId = el.dataset.mapid;
                if (!mapId || initializedMaps.has(mapId)) return;
                const mapEl = document.getElementById(mapId);
                if (!mapEl || mapEl.offsetWidth === 0) return;
                initializedMaps.add(mapId);
                const [lat, lng] = el.dataset.location.split(',').map(Number);
                try {
                    const m = L.map(mapEl, { zoomControl: false, dragging: false, scrollWheelZoom: false, attributionControl: false });
                    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', { maxZoom: 19 }).addTo(m);
                    m.setView([lat, lng], 16);
                    L.marker([lat, lng]).addTo(m);
                } catch(e) {}
            });
        }

        function openLocationModal() {
            document.getElementById('locationModal').style.display = 'flex';
            if (!locationMap) {
                setTimeout(() => {
                    locationMap = L.map('locationPickerMap');
                    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                        attribution: 'Tiles &copy; Esri', maxZoom: 19
                    }).addTo(locationMap);
                    locationMap.setView([-2.5, 118], 5);
                    locationMap.on('click', (e) => setLocationPin(e.latlng.lat, e.latlng.lng));
                }, 150);
            } else { locationMap.invalidateSize(); }
        }

        function closeLocationModal() { document.getElementById('locationModal').style.display = 'none'; }

        function setLocationPin(lat, lng) {
            selectedLat = lat; selectedLng = lng;
            if (locationMarker) { locationMarker.setLatLng([lat, lng]); }
            else { locationMarker = L.marker([lat, lng]).addTo(locationMap); }
            locationMap.setView([lat, lng], 17);
            document.getElementById('locationCoords').textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            const btn = document.getElementById('sendLocationBtn');
            btn.disabled = false; btn.style.opacity = '1'; btn.style.cursor = 'pointer';
        }

        function locateMe() {
            const btn = document.getElementById('locateMeBtn');
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mencari...';
            btn.disabled = true;
            if (!navigator.geolocation) {
                alert('Browser tidak mendukung GPS.'); btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> LOKASI SAYA'; btn.disabled = false; return;
            }
            navigator.geolocation.getCurrentPosition(
                (pos) => { btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> LOKASI SAYA'; btn.disabled = false; setLocationPin(pos.coords.latitude, pos.coords.longitude); },
                (err) => { btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i> LOKASI SAYA'; btn.disabled = false; alert('Gagal: ' + err.message); },
                { enableHighAccuracy: true, timeout: 15000 }
            );
        }

        async function sendLocationMessage() {
            if (selectedLat === null) return;
            closeLocationModal();
            const formData = new FormData();
            formData.append('message', `__LOCATION__:${selectedLat},${selectedLng}`);
            try {
                const res = await fetch(SEND_URL, { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }, body: formData });
                const data = await res.json();
                if (data.success) {
                    const container = document.getElementById('messagesContainer');
                    container.insertBefore(renderMessage(data.message), document.getElementById('typingIndicator'));
                    lastId = data.message.id;
                    scrollBottom();
                    setTimeout(initLocationMaps, 150);
                }
            } catch(e) { alert('Gagal mengirim lokasi.'); }
        }

        // === LOCATION VERIFICATION ACTIONS FOR RM ===
        const VERIFY_LOC_URL = '{{ route('admin.inquiries.verify-location', $inquiry) }}';
        const REJECT_LOC_URL = '{{ route('admin.inquiries.reject-location', $inquiry) }}';

        function toggleLocMenu(e, id) {
            e.stopPropagation();
            document.querySelectorAll('.loc-dropdown').forEach(el => {
                if (el.id !== 'loc-dropdown-' + id) el.style.display = 'none';
            });
            const dd = document.getElementById('loc-dropdown-' + id);
            if (dd) {
                dd.style.display = (dd.style.display === 'none' || !dd.style.display) ? 'block' : 'none';
            }
        }

        document.addEventListener('click', function() {
            document.querySelectorAll('.loc-dropdown').forEach(el => el.style.display = 'none');
        });

        async function verifyLocationAction(coords) {
            if (!confirm('Verifikasi titik lokasi pengiriman ini dan langsung jadwalkan pengiriman armada Towing ke Driver Escort?')) return;
            try {
                const res = await fetch(VERIFY_LOC_URL, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ location: coords })
                });
                const data = await res.json();
                if (data.success) {
                    alert('✅ ' + (data.message ? 'Lokasi berhasil diverifikasi! Pengiriman otomatis dijadwalkan.' : 'Lokasi diverifikasi.'));
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal memverifikasi lokasi.');
                }
            } catch (e) {
                alert('Terjadi kesalahan koneksi.');
            }
        }

        async function rejectLocationAction() {
            const reason = prompt('Masukkan alasan penolakan titik lokasi pengiriman:', 'Lokasi tidak dapat dijangkau oleh armada Flatbed Towing Apex.');
            if (reason === null) return;
            try {
                const res = await fetch(REJECT_LOC_URL, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ reason: reason })
                });
                const data = await res.json();
                if (data.success) {
                    alert('Pemberitahuan penolakan lokasi dikirim ke pembeli.');
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal menolak lokasi.');
                }
            } catch (e) {
                alert('Terjadi kesalahan koneksi.');
            }
        }

        setTimeout(initLocationMaps, 400);
        setInterval(pollMessages, 3000);
    </script>

    <!-- LOCATION PICKER MODAL -->
    <div id="locationModal" style="display:none; position:fixed; inset:0; z-index:9998; background:rgba(0,0,0,0.88); align-items:center; justify-content:center;">
        <div style="background:#0d0d18; border:1px solid rgba(255,255,255,0.1); width:min(620px,95vw); overflow:hidden; box-shadow:0 25px 60px rgba(0,0,0,0.6);">
            <div style="display:flex; align-items:center; justify-content:space-between; padding:14px 20px; border-bottom:1px solid rgba(255,255,255,0.07);">
                <span style="font-family:'Space Mono',monospace; font-size:11px; letter-spacing:0.12em; text-transform:uppercase; color:#e5e7eb;">
                    <i class="fa-solid fa-location-dot" style="color:#dc2626; margin-right:8px;"></i>KIRIM LOKASI
                </span>
                <button onclick="closeLocationModal()" style="background:none; border:none; color:#6b7280; cursor:pointer; font-size:18px; padding:0;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div id="locationPickerMap" style="height:340px; width:100%;"></div>
            <div style="padding:12px 20px; display:flex; gap:10px; align-items:center; border-top:1px solid rgba(255,255,255,0.07); background:#0d0d18; flex-wrap:wrap;">
                <button id="locateMeBtn" onclick="locateMe()" style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.18); color:#e5e7eb; padding:10px 16px; cursor:pointer; font-family:'Space Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; display:flex; align-items:center; gap:8px; flex-shrink:0;">
                    <i class="fa-solid fa-location-crosshairs"></i> LOKASI SAYA
                </button>
                <span id="locationCoords" style="flex:1; font-size:11px; color:#6b7280; font-family:'Space Mono',monospace; min-width:120px;">Klik peta atau tekan tombol untuk memilih lokasi</span>
                <button id="sendLocationBtn" onclick="sendLocationMessage()" disabled style="background:#dc2626; color:white; border:none; padding:10px 20px; cursor:not-allowed; font-family:'Space Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; display:flex; align-items:center; gap:8px; opacity:0.4; flex-shrink:0;">
                    <i class="fa-solid fa-paper-plane"></i> KIRIM LOKASI
                </button>
            </div>
        </div>
    </div>
</body>
</html>
