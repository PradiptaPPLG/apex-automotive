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
        <span class="status-badge {{ $inquiry->statusColor() }}" id="statusBadge">{{ $inquiry->statusLabel() }}</span>
    </nav>

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
                    $phases = [
                        ['inquiry_received', 'consultation_active'] => 'Phase 1 — Discovery',
                        ['consultation_active', 'spk_issued'] => 'Phase 2 — Konsultasi & SPK',
                        ['kyc_pending', 'kyc_approved'] => 'Phase 3 — KYC & Dokumen',
                        ['contract_signed'] => 'Phase 4 — Tanda Tangan Kontrak',
                        ['payment_verified'] => 'Phase 5 — Pembayaran',
                        ['scheduled_delivery', 'delivered_completed'] => 'Phase 6 — Pengiriman',
                    ];
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

        // Poll every 3 seconds
        setInterval(pollMessages, 3000);
    </script>
</body>
</html>
