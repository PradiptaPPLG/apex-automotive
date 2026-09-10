<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Detail #{{ $booking->id }} — Mechanic Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #060610; color: #e5e7eb; min-height: 100vh; display: flex; flex-direction: column; }
        .nav { background: rgba(6,6,16,.97); border-bottom: 1px solid rgba(249,115,22,.12); padding: 0 2rem; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; backdrop-filter: blur(12px); }
        .nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .nav-logo img { height: 30px; }
        .nav-badge { font-family: 'Space Mono', monospace; font-size: 10px; color: #f97316; letter-spacing: .15em; font-weight: 700; text-transform: uppercase; }
        .btn-ghost { font-family: 'Space Mono', monospace; font-size: 10px; color: #6b7280; background: none; border: 1px solid rgba(255,255,255,.1); padding: 6px 12px; cursor: pointer; text-transform: uppercase; letter-spacing: .1em; text-decoration: none; transition: all .2s; }
        .btn-ghost:hover { color: #f97316; border-color: rgba(249,115,22,.3); }

        /* Layout */
        .layout { display: grid; grid-template-columns: 360px 1fr; height: calc(100vh - 64px); overflow: hidden; }
        @media(max-width:960px){ .layout{ grid-template-columns: 1fr; height: auto; overflow: visible; } }

        /* ── Left Panel ── */
        .left-panel { border-right: 1px solid rgba(255,255,255,.06); overflow-y: auto; padding: 18px; display: flex; flex-direction: column; gap: 14px; background: rgba(255,255,255,.01); }
        .info-card { background: rgba(249,115,22,.05); border: 1px solid rgba(249,115,22,.2); padding: 16px; }
        .info-card-icon { width: 38px; height: 38px; background: rgba(249,115,22,.1); border: 1px solid rgba(249,115,22,.3); display: flex; align-items: center; justify-content: center; color: #f97316; font-size: 15px; margin-bottom: 10px; }
        .info-title { font-family: 'Space Mono', monospace; font-size: 12px; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 8px; }
        .info-meta { font-size: 12px; color: #6b7280; line-height: 1.9; }
        .info-meta strong { color: #9ca3af; }
        .status-badge { display: inline-flex; align-items: center; gap: 6px; font-family: 'Space Mono', monospace; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; padding: 4px 10px; border: 1px solid; margin-top: 10px; }

        .section-hdr { font-family: 'Space Mono', monospace; font-size: 10px; font-weight: 700; color: #4b5563; text-transform: uppercase; letter-spacing: .12em; margin-bottom: 10px; }

        /* Status Update Panel */
        .status-form { background: rgba(255,255,255,.02); border: 1px solid rgba(255,255,255,.07); padding: 14px; }
        .status-form select { width: 100%; background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1); color: #e5e7eb; padding: 9px 12px; font-size: 13px; font-family: 'Inter', sans-serif; margin-bottom: 10px; outline: none; }
        .status-form select option { background: #1a1a2e; }
        .btn-orange { width: 100%; padding: 10px; background: #f97316; color: white; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; border: none; cursor: pointer; transition: background .2s; }
        .btn-orange:hover { background: #ea580c; }

        /* Quote Form */
        .quote-form { background: rgba(255,255,255,.02); border: 1px solid rgba(255,255,255,.07); padding: 14px; }
        .quote-form input, .quote-form textarea { width: 100%; background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1); color: #e5e7eb; padding: 9px 12px; font-size: 13px; font-family: 'Inter', sans-serif; margin-bottom: 8px; outline: none; }
        .quote-form label { font-family: 'Space Mono', monospace; font-size: 9px; color: #6b7280; text-transform: uppercase; letter-spacing: .1em; display: block; margin-bottom: 4px; }
        .btn-green { width: 100%; padding: 10px; background: #16a34a; color: white; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; border: none; cursor: pointer; transition: background .2s; }
        .btn-green:hover { background: #15803d; }

        /* Progress Form */
        .progress-form { background: rgba(255,255,255,.02); border: 1px solid rgba(255,255,255,.07); padding: 14px; }
        .progress-form input, .progress-form textarea { width: 100%; background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1); color: #e5e7eb; padding: 9px 12px; font-size: 13px; font-family: 'Inter', sans-serif; margin-bottom: 8px; outline: none; }
        .progress-form label { font-family: 'Space Mono', monospace; font-size: 9px; color: #6b7280; text-transform: uppercase; letter-spacing: .1em; display: block; margin-bottom: 4px; }
        .btn-blue { width: 100%; padding: 10px; background: #1d4ed8; color: white; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; border: none; cursor: pointer; transition: background .2s; }
        .btn-blue:hover { background: #1e40af; }

        /* Timeline */
        .timeline { display: flex; flex-direction: column; gap: 0; }
        .timeline-item { display: flex; gap: 10px; padding-bottom: 14px; position: relative; }
        .timeline-item:last-child { padding-bottom: 0; }
        .timeline-dot { width: 10px; height: 10px; border-radius: 50%; background: #f97316; flex-shrink: 0; margin-top: 4px; position: relative; z-index: 1; }
        .timeline-line { position: absolute; left: 4px; top: 14px; bottom: 0; width: 1px; background: rgba(255,255,255,.08); }
        .timeline-item:last-child .timeline-line { display: none; }
        .timeline-content { flex: 1; }
        .timeline-label { font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; color: white; margin-bottom: 2px; }
        .timeline-note { font-size: 12px; color: #6b7280; }
        .timeline-time { font-size: 10px; color: #374151; margin-top: 3px; font-family: 'Space Mono', monospace; }
        .timeline-photo { margin-top: 6px; max-width: 100%; border: 1px solid rgba(255,255,255,.1); }

        /* ── Right Panel: Chat ── */
        .chat-panel { display: flex; flex-direction: column; }
        .chat-header { padding: 14px 20px; border-bottom: 1px solid rgba(255,255,255,.06); display: flex; align-items: center; gap: 12px; background: rgba(255,255,255,.01); flex-shrink: 0; }
        .chat-icon { width: 36px; height: 36px; background: rgba(249,115,22,.1); border: 1px solid rgba(249,115,22,.3); display: flex; align-items: center; justify-content: center; color: #f97316; font-size: 14px; flex-shrink: 0; }
        .chat-header-title { font-family: 'Space Mono', monospace; font-size: 12px; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: .06em; }
        .chat-header-sub { font-size: 11px; color: #6b7280; }

        .chat-messages { flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 14px; }
        .msg-row { display: flex; flex-direction: column; max-width: 78%; }
        .msg-row.mine { align-self: flex-end; align-items: flex-end; }
        .msg-row.theirs { align-self: flex-start; align-items: flex-start; }
        .msg-sender { font-family: 'Space Mono', monospace; font-size: 9px; color: #4b5563; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 4px; }
        .msg-bubble { padding: 10px 14px; font-size: 13px; line-height: 1.6; white-space: pre-wrap; word-break: break-word; }
        .msg-row.mine .msg-bubble { background: rgba(249,115,22,.12); border: 1px solid rgba(249,115,22,.25); color: #fed7aa; }
        .msg-row.theirs .msg-bubble { background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1); color: #e5e7eb; }
        .msg-time { font-size: 10px; color: #374151; font-family: 'Space Mono', monospace; margin-top: 4px; }
        .msg-attachment img { max-width: 200px; border: 1px solid rgba(255,255,255,.1); margin-top: 6px; }
        .msg-attachment a { font-size: 12px; color: #60a5fa; text-decoration: none; }

        .chat-input-area { border-top: 1px solid rgba(255,255,255,.06); padding: 14px 18px; background: rgba(255,255,255,.01); flex-shrink: 0; }
        .chat-input-row { display: flex; gap: 8px; align-items: flex-end; }
        .chat-textarea { flex: 1; background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1); color: #e5e7eb; padding: 10px 12px; font-size: 13px; font-family: 'Inter', sans-serif; resize: none; min-height: 42px; max-height: 120px; outline: none; transition: border-color .2s; }
        .chat-textarea:focus { border-color: rgba(249,115,22,.5); }
        .btn-send { width: 42px; height: 42px; background: #f97316; border: none; color: white; font-size: 14px; cursor: pointer; flex-shrink: 0; transition: background .2s; display: flex; align-items: center; justify-content: center; }
        .btn-send:hover { background: #ea580c; }
        .btn-attach { width: 42px; height: 42px; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1); color: #9ca3af; font-size: 13px; cursor: pointer; flex-shrink: 0; transition: all .2s; display: flex; align-items: center; justify-content: center; }
        .attach-name { font-size: 11px; color: #6b7280; font-family: 'Space Mono', monospace; margin-bottom: 6px; }

        .alert-success { background: rgba(34,197,94,.1); border: 1px solid rgba(34,197,94,.3); color: #86efac; padding: 10px 14px; font-size: 12px; margin-bottom: 12px; }
    </style>
</head>
<body>
    <nav class="nav">
        <a href="{{ route('mechanic.dashboard') }}" class="nav-logo">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Apex">
            <span class="nav-badge"><i class="fa-solid fa-wrench mr-1"></i> Mechanic Panel</span>
        </a>
        <div style="display:flex; gap:8px; align-items:center;">
            <a href="{{ route('mechanic.dashboard') }}" class="btn-ghost"><i class="fa-solid fa-arrow-left mr-1"></i> All Bookings</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-ghost"><i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> Keluar</button>
            </form>
        </div>
    </nav>

    <div class="layout">
        {{-- LEFT: Info + Tools --}}
        <aside class="left-panel">
            @if(session('success'))
                <div class="alert-success"><i class="fa-solid fa-check mr-1"></i> {{ session('success') }}</div>
            @endif

            {{-- Booking Info --}}
            <div class="info-card">
                <div class="info-card-icon"><i class="fa-solid {{ $booking->serviceTypeIcon() }}"></i></div>
                <div class="info-title">{{ $booking->title }}</div>
                <div class="info-meta">
                    <strong>Customer:</strong> {{ $booking->user->name }}<br>
                    <strong>Email:</strong> {{ $booking->user->email }}<br>
                    <strong>Kendaraan:</strong> {{ $booking->vehicle->displayName() }}<br>
                    <strong>Plat:</strong> {{ $booking->vehicle->license_plate ?? '—' }}<br>
                    @if($booking->vehicle->mileage_km)
                        <strong>KM:</strong> {{ number_format($booking->vehicle->mileage_km) }} km<br>
                    @endif
                    <strong>Layanan:</strong> {{ $booking->serviceTypeLabel() }}<br>
                    <strong>Jadwal:</strong> {{ $booking->preferred_date?->format('d M Y') }} pukul {{ $booking->preferred_time }}<br>
                    <strong>Metode:</strong> {{ $booking->delivery_method === 'drop_off' ? 'Drop-off' : 'VIP Flatbed Pick-up' }}<br>
                    @if($booking->description)
                        <strong>Keterangan:</strong> {{ Str::limit($booking->description, 120) }}<br>
                    @endif
                    @if($booking->estimated_cost)
                        <strong>Estimasi:</strong>
                        <span style="color:#22c55e;">Rp {{ number_format($booking->estimated_cost, 0, ',', '.') }}</span>
                    @endif
                </div>
                <div class="status-badge {{ $booking->statusColor() }}">
                    <i class="fa-solid fa-circle" style="font-size:7px;"></i>
                    {{ $booking->statusLabel() }}
                </div>
            </div>

            {{-- Update Status --}}
            <div>
                <div class="section-hdr"><i class="fa-solid fa-arrows-rotate mr-1"></i> Update Status Booking</div>
                <form class="status-form" method="POST" action="{{ route('mechanic.status', $booking) }}">
                    @csrf @method('PATCH')
                    <select name="status">
                        @foreach(\App\Models\ServiceBooking::statusLabels() as $key => $label)
                            <option value="{{ $key }}" {{ $booking->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-orange">
                        <i class="fa-solid fa-pen-to-square mr-1"></i> Simpan Status
                    </button>
                </form>
            </div>

            {{-- Send Quote --}}
            <div>
                <div class="section-hdr"><i class="fa-solid fa-file-invoice-dollar mr-1"></i> Kirim Estimasi Biaya</div>
                <div class="quote-form">
                    <label>Estimasi Total (Rp)</label>
                    <input type="number" id="quoteAmount" value="{{ $booking->estimated_cost ?? '' }}" min="0" placeholder="cth: 15000000">
                    <label>Catatan Tambahan</label>
                    <textarea id="quoteNote" rows="2" placeholder="Termasuk sparepart, jasa, dll..."></textarea>
                    <button class="btn-green" onclick="sendQuote()">
                        <i class="fa-solid fa-paper-plane mr-1"></i> Kirim Estimasi ke Customer
                    </button>
                </div>
            </div>

            {{-- Add Progress --}}
            <div>
                <div class="section-hdr"><i class="fa-solid fa-camera mr-1"></i> Tambah Progress Update</div>
                <div class="progress-form" id="progressForm">
                    <label>Label Fase *</label>
                    <input type="text" id="progressLabel" placeholder="cth: Kendaraan Diterima, ECU Flashed...">
                    <label>Catatan</label>
                    <textarea id="progressNote" rows="2" placeholder="Deskripsi singkat pengerjaan..."></textarea>
                    <label>Foto (Opsional)</label>
                    <input type="file" id="progressPhoto" accept="image/*" style="color:#9ca3af; margin-bottom: 8px;">
                    <button class="btn-blue" onclick="addProgress()">
                        <i class="fa-solid fa-circle-plus mr-1"></i> Tambah Update
                    </button>
                </div>
            </div>

            {{-- Progress Timeline --}}
            @if($booking->progressUpdates->isNotEmpty())
                <div>
                    <div class="section-hdr"><i class="fa-solid fa-timeline mr-1"></i> Progress Timeline</div>
                    <div class="timeline">
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
                                        <img src="{{ asset('storage/'.$p->photo_url) }}" class="timeline-photo" alt="Progress">
                                    @endif
                                    <div class="timeline-time">{{ $p->created_at->format('d M Y H:i') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>

        {{-- RIGHT: Chat --}}
        <section class="chat-panel">
            <div class="chat-header">
                <div class="chat-icon"><i class="fa-solid fa-comments"></i></div>
                <div>
                    <div class="chat-header-title">Chat dengan Customer</div>
                    <div class="chat-header-sub">Booking #{{ $booking->id }} — {{ $booking->user->name }}</div>
                </div>
            </div>

            <div class="chat-messages" id="chatMessages">
                @foreach($booking->messages as $msg)
                    @php $isMine = $msg->sender_type === 'mechanic'; @endphp
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
                    <label class="btn-attach" for="attachFile" title="Lampirkan Foto">
                        <i class="fa-solid fa-paperclip"></i>
                    </label>
                    <input type="file" id="attachFile" style="display:none;" accept="image/*,.pdf" onchange="handleAttach(this)">
                    <textarea class="chat-textarea" id="chatInput" placeholder="Ketik pesan ke customer..." rows="1"
                              onkeydown="handleKey(event)"></textarea>
                    <button class="btn-send" onclick="sendMessage()"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </div>
        </section>
    </div>

    <script>
        const POLL_URL = '{{ route("mechanic.poll", $booking) }}';
        const MSG_URL = '{{ route("mechanic.message", $booking) }}';
        const QUOTE_URL = '{{ route("mechanic.quote", $booking) }}';
        const PROGRESS_URL = '{{ route("mechanic.progress", $booking) }}';
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;
        let lastId = {{ $booking->messages->last()?->id ?? 0 }};

        function scrollBottom() {
            const c = document.getElementById('chatMessages');
            c.scrollTop = c.scrollHeight;
        }
        scrollBottom();

        function renderMsg(msg) {
            const isMine = msg.sender_type === 'mechanic';
            const div = document.createElement('div');
            div.className = 'msg-row ' + (isMine ? 'mine' : 'theirs');
            div.dataset.id = msg.id;

            let attachHtml = '';
            if (msg.attachment_url) {
                if (/\.(jpg|jpeg|png|webp)$/i.test(msg.attachment_url)) {
                    attachHtml = `<div class="msg-attachment"><img src="${msg.attachment_url}" alt="Attachment" style="max-width:200px;border:1px solid rgba(255,255,255,.1);margin-top:6px;"></div>`;
                } else {
                    attachHtml = `<div class="msg-attachment"><a href="${msg.attachment_url}" target="_blank"><i class="fa-solid fa-file-pdf mr-1"></i> Lihat Lampiran</a></div>`;
                }
            }
            const time = new Date(msg.created_at.replace(' ', 'T'));
            const formattedTime = time.toLocaleDateString('id-ID', {day:'2-digit',month:'short',year:'numeric'}) + ' ' + time.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'});

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
            if (input.files.length) { name.textContent = '📎 ' + input.files[0].name; name.style.display = 'block'; }
        }

        function sendQuote() {
            const amount = document.getElementById('quoteAmount').value;
            const note = document.getElementById('quoteNote').value;
            if (!amount) { alert('Masukkan nominal estimasi biaya.'); return; }

            const form = new FormData();
            form.append('_token', CSRF);
            form.append('estimated_cost', amount);
            form.append('quote_note', note);

            fetch(QUOTE_URL, { method: 'POST', body: form })
                .then(r => r.json())
                .then(data => { if (data.success) { alert('Estimasi biaya berhasil dikirim ke customer!'); location.reload(); } });
        }

        function addProgress() {
            const label = document.getElementById('progressLabel').value.trim();
            const note = document.getElementById('progressNote').value.trim();
            const photo = document.getElementById('progressPhoto').files[0];
            if (!label) { alert('Label fase progress wajib diisi.'); return; }

            const form = new FormData();
            form.append('_token', CSRF);
            form.append('phase_label', label);
            form.append('note', note);
            if (photo) form.append('photo', photo);

            fetch(PROGRESS_URL, { method: 'POST', body: form })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('progressLabel').value = '';
                        document.getElementById('progressNote').value = '';
                        document.getElementById('progressPhoto').value = '';
                        alert('Progress update berhasil ditambahkan & dikirim ke customer!');
                        location.reload();
                    }
                });
        }

        // Poll for new customer messages
        setInterval(() => {
            fetch(`${POLL_URL}?after=${lastId}`)
                .then(r => r.json())
                .then(data => data.messages.forEach(renderMsg))
                .catch(() => {});
        }, 4000);
    </script>
</body>
</html>
