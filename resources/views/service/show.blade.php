<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Detail — {{ $booking->title }} — Apex Automotive</title>
    <meta name="description" content="Pantau status dan chat layanan servis kendaraan Anda di Apex Automotive.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #080810; color: #e5e7eb; min-height: 100vh; display: flex; flex-direction: column; }
        .portal-nav {
            background: rgba(8,8,16,0.96); border-bottom: 1px solid rgba(255,255,255,0.08);
            padding: 0 2rem; height: 64px; display: flex; align-items: center;
            justify-content: space-between; position: sticky; top: 0; z-index: 50; backdrop-filter: blur(12px);
        }
        .nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .nav-logo img { height: 32px; }
        .nav-badge { font-family: 'Space Mono', monospace; font-size: 10px; color: #dc2626; letter-spacing: .15em; font-weight: 700; text-transform: uppercase; }
        .btn-ghost { font-family: 'Space Mono', monospace; font-size: 10px; color: #6b7280; background: none; border: 1px solid rgba(255,255,255,0.1); padding: 6px 12px; cursor: pointer; text-transform: uppercase; letter-spacing: .1em; text-decoration: none; transition: all .2s; }
        .btn-ghost:hover { color: #ef4444; border-color: rgba(239,68,68,.3); }

        /* Layout */
        .layout { display: grid; grid-template-columns: 340px 1fr; height: calc(100vh - 64px); overflow: hidden; }
        @media(max-width:900px){ .layout{ grid-template-columns: 1fr; grid-template-rows: auto 1fr; height: auto; } }

        /* ── Left Panel ── */
        .left-panel { border-right: 1px solid rgba(255,255,255,0.07); overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 16px; background: rgba(255,255,255,0.01); }
        .booking-card { background: rgba(220,38,38,.06); border: 1px solid rgba(220,38,38,.2); padding: 16px; }
        .booking-type-icon { width: 40px; height: 40px; background: rgba(220,38,38,.12); border: 1px solid rgba(220,38,38,.3); display: flex; align-items: center; justify-content: center; color: #dc2626; font-size: 16px; margin-bottom: 12px; }
        .booking-title { font-family: 'Space Mono', monospace; font-size: 13px; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 6px; }
        .booking-meta { font-size: 12px; color: #6b7280; line-height: 1.8; }
        .status-badge { display: inline-flex; align-items: center; gap: 6px; font-family: 'Space Mono', monospace; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; padding: 4px 10px; border: 1px solid; margin-top: 10px; }

        /* ── Progress Timeline ── */
        .section-title { font-family: 'Space Mono', monospace; font-size: 10px; font-weight: 700; color: #4b5563; text-transform: uppercase; letter-spacing: .12em; margin-bottom: 12px; }
        .timeline { display: flex; flex-direction: column; gap: 0; }
        .timeline-item { display: flex; gap: 12px; padding-bottom: 16px; position: relative; }
        .timeline-item:last-child { padding-bottom: 0; }
        .timeline-dot { width: 10px; height: 10px; border-radius: 50%; background: #dc2626; flex-shrink: 0; margin-top: 4px; position: relative; z-index: 1; }
        .timeline-line { position: absolute; left: 4px; top: 14px; bottom: 0; width: 1px; background: rgba(255,255,255,0.08); }
        .timeline-item:last-child .timeline-line { display: none; }
        .timeline-content { flex: 1; }
        .timeline-label { font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; color: white; margin-bottom: 2px; }
        .timeline-note { font-size: 12px; color: #6b7280; line-height: 1.5; }
        .timeline-time { font-size: 10px; color: #374151; font-family: 'Space Mono', monospace; margin-top: 3px; }
        .timeline-photo { margin-top: 8px; max-width: 100%; border: 1px solid rgba(255,255,255,0.1); }

        /* Job Steps */
        .job-steps { display: flex; flex-direction: column; gap: 6px; }
        .job-step { display: flex; align-items: center; gap: 10px; padding: 8px 10px; border: 1px solid rgba(255,255,255,0.05); font-size: 12px; }
        .job-step.done { background: rgba(34,197,94,.06); border-color: rgba(34,197,94,.2); }
        .job-step.active { background: rgba(220,38,38,.06); border-color: rgba(220,38,38,.25); }
        .job-step .step-icon { width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-size: 10px; flex-shrink: 0; }
        .job-step.done .step-icon { color: #22c55e; }
        .job-step.active .step-icon { color: #dc2626; }
        .job-step.pending .step-icon { color: #374151; }
        .job-step-label { font-family: 'Space Mono', monospace; font-size: 10px; text-transform: uppercase; letter-spacing: .05em; }
        .job-step.done .job-step-label { color: #22c55e; }
        .job-step.active .job-step-label { color: #fca5a5; }
        .job-step.pending .job-step-label { color: #374151; }

        /* ── Right Panel: Chat ── */
        .chat-panel { display: flex; flex-direction: column; }
        .chat-header { padding: 14px 20px; border-bottom: 1px solid rgba(255,255,255,0.07); display: flex; align-items: center; gap: 12px; background: rgba(255,255,255,0.01); flex-shrink: 0; }
        .chat-header-title { font-family: 'Space Mono', monospace; font-size: 12px; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: .06em; }
        .chat-header-sub { font-size: 11px; color: #6b7280; }
        .chat-icon { width: 36px; height: 36px; background: rgba(220,38,38,.1); border: 1px solid rgba(220,38,38,.3); display: flex; align-items: center; justify-content: center; color: #dc2626; font-size: 14px; flex-shrink: 0; }
        .chat-messages { flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 14px; }
        .msg-row { display: flex; flex-direction: column; max-width: 75%; }
        .msg-row.mine { align-self: flex-end; align-items: flex-end; }
        .msg-row.theirs { align-self: flex-start; align-items: flex-start; }
        .msg-sender { font-family: 'Space Mono', monospace; font-size: 9px; color: #4b5563; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 4px; }
        .msg-bubble { padding: 10px 14px; font-size: 13px; line-height: 1.6; white-space: pre-wrap; word-break: break-word; }
        .msg-row.mine .msg-bubble { background: rgba(220,38,38,.15); border: 1px solid rgba(220,38,38,.25); color: #fecaca; }
        .msg-row.theirs .msg-bubble { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #e5e7eb; }
        .msg-time { font-size: 10px; color: #374151; font-family: 'Space Mono', monospace; margin-top: 4px; }
        .msg-attachment { margin-top: 8px; }
        .msg-attachment img { max-width: 200px; border: 1px solid rgba(255,255,255,0.1); }
        .msg-attachment a { font-size: 12px; color: #60a5fa; text-decoration: none; }

        /* Chat Input */
        .chat-input-area { border-top: 1px solid rgba(255,255,255,0.07); padding: 16px 20px; background: rgba(255,255,255,0.01); flex-shrink: 0; }
        .chat-input-row { display: flex; gap: 10px; align-items: flex-end; }
        .chat-textarea { flex: 1; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); color: #e5e7eb; padding: 10px 14px; font-size: 13px; font-family: 'Inter', sans-serif; resize: none; min-height: 44px; max-height: 120px; outline: none; transition: border-color .2s; }
        .chat-textarea:focus { border-color: rgba(220,38,38,.5); }
        .btn-send { width: 44px; height: 44px; background: #dc2626; border: none; color: white; font-size: 15px; cursor: pointer; flex-shrink: 0; transition: background .2s; display: flex; align-items: center; justify-content: center; }
        .btn-send:hover { background: #b91c1c; }
        .btn-attach { width: 44px; height: 44px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #9ca3af; font-size: 14px; cursor: pointer; flex-shrink: 0; transition: all .2s; display: flex; align-items: center; justify-content: center; }
        .btn-attach:hover { color: white; background: rgba(255,255,255,0.1); }
        .attach-name { font-size: 11px; color: #6b7280; font-family: 'Space Mono', monospace; margin-top: 6px; }
        .alert-success { background: rgba(34,197,94,.1); border: 1px solid rgba(34,197,94,.3); color: #86efac; padding: 10px 14px; font-size: 12px; margin-bottom: 14px; }
    </style>
</head>
<body>
    <nav class="portal-nav">
        <a href="{{ route('portal.dashboard') }}" class="nav-logo">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive">
            <span class="nav-badge">Service Detail</span>
        </a>
        <div style="display:flex; align-items:center; gap:10px;">
            <a href="{{ route('service.index') }}" class="btn-ghost"><i class="fa-solid fa-arrow-left mr-1"></i> My Bookings</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-ghost"><i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> Keluar</button>
            </form>
        </div>
    </nav>

    <div class="layout">
        {{-- LEFT PANEL: Booking Info + Progress --}}
        <aside class="left-panel">
            @if(session('success'))
                <div class="alert-success"><i class="fa-solid fa-check mr-1"></i> {{ session('success') }}</div>
            @endif

            {{-- Booking Card --}}
            <div class="booking-card">
                <div class="booking-type-icon"><i class="fa-solid {{ $booking->serviceTypeIcon() }}"></i></div>
                <div class="booking-title">{{ $booking->title }}</div>
                <div class="booking-meta">
                    <strong style="color:#9ca3af;">Kendaraan:</strong> {{ $booking->vehicle->displayName() }}<br>
                    <strong style="color:#9ca3af;">Plat:</strong> {{ $booking->vehicle->license_plate ?? '—' }}<br>
                    <strong style="color:#9ca3af;">Layanan:</strong> {{ $booking->serviceTypeLabel() }}<br>
                    <strong style="color:#9ca3af;">Jadwal:</strong>
                    {{ $booking->preferred_date?->format('d M Y') }} pukul {{ $booking->preferred_time }}<br>
                    <strong style="color:#9ca3af;">Metode:</strong>
                    {{ $booking->delivery_method === 'drop_off' ? 'Drop-off ke Workshop' : 'VIP Flatbed Pick-up' }}<br>
                    @if($booking->assigned_mechanic_name)
                        <strong style="color:#9ca3af;">Teknisi:</strong> {{ $booking->assigned_mechanic_name }}<br>
                    @endif
                    @if($booking->estimated_cost)
                        <strong style="color:#9ca3af;">Estimasi:</strong>
                        <span style="color:#22c55e;">Rp {{ number_format($booking->estimated_cost, 0, ',', '.') }}</span>
                    @endif
                </div>
                <div class="status-badge {{ $booking->statusColor() }}" id="statusBadge">
                    <i class="fa-solid fa-circle" style="font-size:7px;"></i>
                    {{ $booking->statusLabel() }}
                </div>
            </div>

            {{-- Job Pipeline Steps --}}
            <div>
                <div class="section-title"><i class="fa-solid fa-list-check mr-1"></i> Progress Pengerjaan</div>
                @php
                    $steps = ['pending' => 'Booking Masuk', 'confirmed' => 'Dikonfirmasi', 'in_progress' => 'Sedang Dikerjakan', 'qc_check' => 'Quality Control', 'ready' => 'Siap Diserahkan', 'completed' => 'Selesai'];
                    $statusOrder = array_keys($steps);
                    $currentIdx = array_search($booking->status, $statusOrder) ?? 0;
                @endphp
                <div class="job-steps">
                    @foreach($steps as $key => $label)
                        @php
                            $idx = array_search($key, $statusOrder);
                            $state = $idx < $currentIdx ? 'done' : ($idx === $currentIdx ? 'active' : 'pending');
                        @endphp
                        <div class="job-step {{ $state }}">
                            <div class="step-icon">
                                @if($state === 'done') <i class="fa-solid fa-circle-check"></i>
                                @elseif($state === 'active') <i class="fa-solid fa-circle-dot fa-spin" style="animation-duration:2s;"></i>
                                @else <i class="fa-regular fa-circle"></i>
                                @endif
                            </div>
                            <span class="job-step-label">{{ $label }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Progress Timeline Updates --}}
            @if($booking->progressUpdates->isNotEmpty())
                <div>
                    <div class="section-title"><i class="fa-solid fa-camera mr-1"></i> Update dari Bengkel</div>
                    <div class="timeline" id="progressTimeline">
                        @foreach($booking->progressUpdates as $p)
                            <div class="timeline-item">
                                <div>
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-line"></div>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-label">{{ $p->phase_label }}</div>
                                    @if($p->note)<div class="timeline-note">{{ $p->note }}</div>@endif
                                    @if($p->photo_url)
                                        <img src="{{ asset('storage/'.$p->photo_url) }}" class="timeline-photo" alt="Progress Photo">
                                    @endif
                                    <div class="timeline-time">{{ $p->created_at->format('d M Y H:i') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div style="font-size:12px; color:#374151; text-align:center; padding:1rem 0; font-family:'Space Mono',monospace; letter-spacing:.05em;">
                    Belum ada update dari bengkel.
                </div>
            @endif
        </aside>

        {{-- RIGHT PANEL: Chat --}}
        <section class="chat-panel">
            <div class="chat-header">
                <div class="chat-icon"><i class="fa-solid fa-comments"></i></div>
                <div>
                    <div class="chat-header-title">Chat dengan Service Advisor</div>
                    <div class="chat-header-sub">Booking #{{ $booking->id }} — {{ $booking->vehicle->displayName() }}</div>
                </div>
            </div>

            <div class="chat-messages" id="chatMessages">
                @foreach($booking->messages as $msg)
                    @php $isMine = $msg->sender_type === 'customer'; @endphp
                    <div class="msg-row {{ $isMine ? 'mine' : 'theirs' }}" data-id="{{ $msg->id }}">
                        <div class="msg-sender">{{ $msg->sender_name }}</div>
                        <div class="msg-bubble">{{ $msg->message }}</div>
                        @if($msg->attachment)
                            <div class="msg-attachment">
                                @if(preg_match('/\.(jpg|jpeg|png|webp)$/i', $msg->attachment))
                                    <img src="{{ asset('storage/'.$msg->attachment) }}" alt="Attachment">
                                @else
                                    <a href="{{ asset('storage/'.$msg->attachment) }}" target="_blank"><i class="fa-solid fa-file-pdf mr-1"></i> Lihat Lampiran</a>
                                @endif
                            </div>
                        @endif
                        <div class="msg-time">{{ $msg->created_at->format('d M Y H:i') }}</div>
                    </div>
                @endforeach
            </div>

            <div class="chat-input-area">
                <div id="attachName" class="attach-name" style="display:none;"></div>
                <div class="chat-input-row">
                    <label class="btn-attach" for="attachFile" title="Lampirkan Foto / File">
                        <i class="fa-solid fa-paperclip"></i>
                    </label>
                    <input type="file" id="attachFile" style="display:none;" accept="image/*,.pdf" onchange="handleAttach(this)">
                    <textarea class="chat-textarea" id="chatInput" placeholder="Ketik pesan..." rows="1"
                              onkeydown="handleKey(event)"></textarea>
                    <button class="btn-send" onclick="sendMessage()" title="Kirim"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </div>
        </section>
    </div>

    <script>
        const BOOKING_ID = {{ $booking->id }};
        const POLL_URL = '{{ route("service.poll", $booking) }}';
        const MSG_URL = '{{ route("service.message", $booking) }}';
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;
        let lastId = {{ $booking->messages->last()?->id ?? 0 }};
        let pollInterval;

        function scrollBottom() {
            const c = document.getElementById('chatMessages');
            c.scrollTop = c.scrollHeight;
        }
        scrollBottom();

        function renderMsg(msg) {
            const isMine = msg.sender_type === 'customer';
            const div = document.createElement('div');
            div.className = 'msg-row ' + (isMine ? 'mine' : 'theirs');
            div.dataset.id = msg.id;

            let attachHtml = '';
            if (msg.attachment_url) {
                if (/\.(jpg|jpeg|png|webp)$/i.test(msg.attachment_url)) {
                    attachHtml = `<div class="msg-attachment"><img src="${msg.attachment_url}" alt="Attachment" style="max-width:200px;border:1px solid rgba(255,255,255,.1);"></div>`;
                } else {
                    attachHtml = `<div class="msg-attachment"><a href="${msg.attachment_url}" target="_blank"><i class="fa-solid fa-file-pdf mr-1"></i> Lihat Lampiran</a></div>`;
                }
            }

            const time = new Date(msg.created_at.replace(' ', 'T'));
            const formattedTime = time.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) + ' ' + time.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

            div.innerHTML = `
                <div class="msg-sender">${msg.sender_name}</div>
                <div class="msg-bubble">${msg.message}</div>
                ${attachHtml}
                <div class="msg-time">${formattedTime}</div>
            `;
            document.getElementById('chatMessages').appendChild(div);
            if (msg.id > lastId) lastId = msg.id;
            scrollBottom();
        }

        function sendMessage() {
            const input = document.getElementById('chatInput');
            const fileInput = document.getElementById('attachFile');
            const text = input.value.trim();
            if (!text && !fileInput.files.length) return;

            const form = new FormData();
            form.append('_token', CSRF);
            if (text) form.append('message', text);
            if (fileInput.files.length) form.append('attachment', fileInput.files[0]);

            input.value = '';
            document.getElementById('attachName').style.display = 'none';
            fileInput.value = '';

            fetch(MSG_URL, { method: 'POST', body: form })
                .then(r => r.json())
                .then(data => { if (data.success) renderMsg(data.message); });
        }

        function handleKey(e) {
            if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
        }

        function handleAttach(input) {
            const name = document.getElementById('attachName');
            if (input.files.length) {
                name.textContent = '📎 ' + input.files[0].name;
                name.style.display = 'block';
            }
        }

        // Poll for new messages and progress
        function doPoll() {
            fetch(`${POLL_URL}?after=${lastId}`)
                .then(r => r.json())
                .then(data => {
                    data.messages.forEach(renderMsg);
                    // Update progress if any new items
                    if (data.progress && data.progress.length) {
                        // Reload to reflect progress updates cleanly
                        const timeline = document.getElementById('progressTimeline');
                        if (timeline) {
                            // Add new items without full reload
                        }
                    }
                    // Update status badge
                    if (data.booking_status_label) {
                        const badge = document.getElementById('statusBadge');
                        if (badge) badge.innerHTML = `<i class="fa-solid fa-circle" style="font-size:7px;"></i> ${data.booking_status_label}`;
                    }
                })
                .catch(() => {});
        }
        pollInterval = setInterval(doPoll, 4000);
    </script>
</body>
</html>
