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
        .message-bubble { padding: 12px 16px; font-size: 14px; line-height: 1.55; border: 1px solid; white-space: pre-wrap; word-break: break-word; }
        .message-group.rm .message-bubble { background: rgba(220,38,38,0.12); border-color: rgba(220,38,38,0.3); color: #fecaca; }
        .message-group.buyer .message-bubble { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); color: #e5e7eb; }
        .message-time { font-size: 10px; color: #374151; padding: 0 4px; }

        .chat-input-area { border-top: 1px solid rgba(255,255,255,0.06); padding: 16px 24px; background: rgba(6,6,9,0.9); display: flex; gap: 12px; align-items: flex-end; }
        .chat-input { flex: 1; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); padding: 12px 16px; color: white; font-size: 14px; font-family: 'Inter', sans-serif; resize: none; outline: none; max-height: 120px; transition: border-color 0.2s; }
        .chat-input:focus { border-color: rgba(220,38,38,0.5); }
        .chat-input::placeholder { color: #374151; }
        .chat-send-btn { background: #dc2626; color: white; border: none; padding: 12px 20px; cursor: pointer; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; transition: background 0.2s; display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
        .chat-send-btn:hover { background: #b91c1c; }
        .chat-send-btn:disabled { background: #374151; cursor: not-allowed; }
        .chat-hint { font-size: 11px; color: #374151; padding: 0 28px 8px; background: rgba(6,6,9,0.9); }
    </style>
</head>
<body>
    <nav class="admin-nav">
        <a href="{{ route('admin.inquiries.index') }}" class="nav-back">
            <i class="fa-solid fa-arrow-left"></i> Semua Inquiry
        </a>
        <span class="admin-badge">RM Panel</span>
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
                                <p class="detail-label">NIK (KTP)</p>
                                <p class="detail-value" style="font-size:12px;">{{ $inquiry->user->nik ?? '—' }}</p>
                            </div>
                            <div class="detail-row" style="padding:4px 0;">
                                <p class="detail-label">NPWP</p>
                                <p class="detail-value" style="font-size:12px;">{{ $inquiry->user->npwp ?? '—' }}</p>
                            </div>
                            <div class="detail-row" style="padding:4px 0; border:none;">
                                <p class="detail-label">Alamat STNK / Pengiriman</p>
                                <p class="detail-value" style="font-size:12px;">{{ $inquiry->user->address }}, {{ $inquiry->user->city }}, {{ $inquiry->user->province }} ({{ $inquiry->user->postal_code }})</p>
                            </div>
                        @else
                            <div style="font-size: 11px; color: #fbbf24; font-family: monospace; font-weight: 700;">
                                <i class="fa-solid fa-triangle-exclamation"></i> Belum Lengkap / Pending Upload
                            </div>
                        @endif
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
                        <div class="message-group {{ $msg->sender_type }}" data-id="{{ $msg->id }}">
                            <span class="message-sender">
                                @if($msg->sender_type === 'rm')
                                    <i class="fa-solid fa-headset" style="color:#dc2626;"></i>
                                @else
                                    <i class="fa-solid fa-user" style="color:#6b7280;"></i>
                                @endif
                                {{ $msg->sender_name }}
                            </span>
                            <div class="message-bubble">{{ $msg->message }}</div>
                            <span class="message-time">{{ $msg->created_at->format('d M, H:i') }}</span>
                        </div>
                    @endforeach
                @endif
                <div id="typingIndicator" style="display:none; align-self:flex-start; padding:10px 16px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); font-size:12px; color:#6b7280; font-style:italic;">Pembeli sedang mengetik…</div>
            </div>
            <p class="chat-hint">Tekan Enter untuk kirim, Shift+Enter untuk baris baru</p>
            <div class="chat-input-area">
                <textarea id="messageInput" class="chat-input" placeholder="Tulis balasan kepada pembeli…" rows="2"></textarea>
                <button id="sendBtn" class="chat-send-btn" onclick="sendMessage()">
                    <i class="fa-solid fa-paper-plane"></i> KIRIM
                </button>
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

        function renderMessage(msg) {
            const group = document.createElement('div');
            group.className = `message-group ${msg.sender_type}`;
            group.dataset.id = msg.id;
            const rmIcon = msg.sender_type === 'rm'
                ? '<i class="fa-solid fa-headset" style="color:#dc2626;"></i> '
                : '<i class="fa-solid fa-user" style="color:#6b7280;"></i> ';
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
                const typing = document.getElementById('typingIndicator');
                if (data.messages && data.messages.length > 0) {
                    data.messages.forEach(msg => {
                        if (!container.querySelector(`[data-id="${msg.id}"]`)) {
                            container.insertBefore(renderMessage(msg), typing);
                            lastId = msg.id;
                        }
                    });
                    scrollBottom();
                }
            } catch (e) {}
        }

        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const btn   = document.getElementById('sendBtn');
            const text  = input.value.trim();
            if (!text) return;

            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim…';

            try {
                const res = await fetch(SEND_URL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                    body: JSON.stringify({ message: text })
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

        setInterval(pollMessages, 3000);
    </script>
</body>
</html>
