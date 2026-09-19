<style>
    :root {
        --v-pri: #dc2626;     
        --v-sec: #b91c1c;
        --v-bg: #0f111a;
        --v-txt: #e5e7eb;
        --v-shd: 0 10px 30px rgba(0, 0, 0, 0.5);
        --v-font: 'Inter', sans-serif;
    }

    .ai-assist-box {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 2147483640;
    }

    @media (max-width: 768px) {
        .ai-assist-box {
            bottom: 20px;
            right: 20px;
        }
    }

    .ai-assist-bbl {
        position: absolute;
        bottom: 85px;
        right: -5px;
        background: rgba(15, 17, 26, 0.95);
        border: 1px solid rgba(220, 38, 38, 0.3);
        box-shadow: 0 10px 24px rgba(0,0,0,0.5);
        border-radius: 16px;
        padding: 10px 16px;
        font-family: 'Space Mono', monospace;
        font-size: 11px;
        font-weight: 700;
        color: #fca5a5;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        backdrop-filter: blur(8px);
        transform: translateY(15px) scale(0);
        transform-origin: calc(100% - 37px) 100%; 
        transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s;
        pointer-events: none;
        z-index: 10000;
    }

    .ai-assist-bbl::after {
        content: '';
        position: absolute;
        bottom: -7px;
        right: 30px;
        width: 14px;
        height: 14px;
        background: #0f111a;
        border-right: 1px solid rgba(220, 38, 38, 0.3);
        border-bottom: 1px solid rgba(220, 38, 38, 0.3);
        border-bottom-right-radius: 4px;
        transform: rotate(45deg);
    }

    .ai-assist-bbl.show {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        animation: vBounce 0.65s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    @keyframes vBounce {
        0% { opacity: 0; transform: translateY(20px) scale(0.2); }
        50% { opacity: 1; transform: translateY(-8px) scale(1.08); }
        75% { transform: translateY(2px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }

    .ai-assist-bbl.hide-bounce {
        animation: vBounceOut 0.4s cubic-bezier(0.600, -0.280, 0.735, 0.045) forwards;
    }

    @keyframes vBounceOut {
        0% { opacity: 1; transform: translateY(0) scale(1); }
        30% { transform: translateY(-10px) scale(1.05); }
        100% { opacity: 0; transform: translateY(15px) scale(0); }
    }

    .ai-assist-cursor {
        display: inline-block;
        width: 6px;
        height: 12px;
        background-color: #dc2626;
        vertical-align: text-bottom;
        margin-left: 4px;
        animation: vBlink 1s step-end infinite;
    }
    
    @keyframes vBlink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }

    .ai-assist-orb {
        position: relative;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #080810;
        box-shadow: var(--v-shd);
        cursor: grab;
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
        display: flex !important;
        align-items: center;
        justify-content: center;
        border: 2px solid rgba(220, 38, 38, 0.5);
        overflow: hidden;
        visibility: visible !important;
        opacity: 1 !important;
    }

    @media (max-width: 768px) {
        .ai-assist-orb {
            width: 68px;
            height: 68px;
        }
    }

    .ai-assist-orb:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 35px rgba(220, 38, 38, 0.2);
        border-color: #dc2626;
    }
    
    .ai-assist-orb:active {
        cursor: grabbing;
    }

    .ai-assist-orb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .ai-assist-pane {
        position: fixed;
        bottom: 120px; 
        right: 30px;
        width: 350px;
        max-height: 550px;
        background-color: var(--v-bg);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        box-shadow: var(--v-shd);
        z-index: 999999;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        opacity: 0;
        transform: translateY(20px) scale(0.95);
        pointer-events: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .ai-assist-pane.active {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: all;
    }

    @media (max-width: 768px) {
        .ai-assist-pane {
            width: calc(100% - 30px);
            right: 15px;
            bottom: 100px;
            height: calc(100vh - 170px);
            max-height: 600px;
        }
    }

    .v-hdr {
        background: rgba(8, 8, 16, 0.95);
        border-bottom: 1px solid rgba(255,255,255,0.08);
        color: white;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-family: var(--v-font);
    }

    .v-hdr-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .v-hdr-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid rgba(220, 38, 38, 0.5);
        overflow: hidden;
        background-color: #080810;
    }

    .v-hdr-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .v-title {
        margin: 0;
        font-family: 'Playfair Display', serif;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.2;
    }

    .v-stat {
        margin: 0;
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        text-transform: uppercase;
        color: #9ca3af;
        display: flex;
        align-items: center;
        gap: 5px;
        letter-spacing: 0.05em;
    }

    .v-stat::before {
        content: '';
        display: inline-block;
        width: 6px;
        height: 6px;
        background-color: #dc2626;
        border-radius: 50%;
        box-shadow: 0 0 5px #dc2626;
    }

    .v-close {
        background: none;
        border: none;
        color: #9ca3af;
        font-size: 20px;
        cursor: pointer;
        transition: color 0.2s;
        padding: 0;
        line-height: 1;
    }

    .v-close:hover {
        color: white;
    }

    .v-body {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 15px;
        background-color: #080810;
        font-family: var(--v-font);
        scroll-behavior: smooth;
        height: 350px;
    }

    .v-txt {
        max-width: 85%;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 13px;
        line-height: 1.5;
        word-wrap: break-word;
        animation: vTxtFade 0.3s ease forwards;
        border: 1px solid transparent;
    }

    @keyframes vTxtFade {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .v-txt.v-sys {
        align-self: flex-start;
        background-color: rgba(255,255,255,0.03);
        border-color: rgba(255,255,255,0.08);
        color: #e5e7eb;
        border-bottom-left-radius: 4px;
    }

    .v-txt.v-usr {
        align-self: flex-end;
        background-color: rgba(220, 38, 38, 0.15);
        border-color: rgba(220, 38, 38, 0.3);
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .v-load {
        display: none;
        align-self: flex-start;
        background-color: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        padding: 12px 16px;
        border-radius: 12px;
        border-bottom-left-radius: 4px;
    }
    
    .v-load.active {
        display: flex;
        gap: 4px;
        align-items: center;
    }

    .v-dot {
        width: 6px;
        height: 6px;
        background-color: #dc2626;
        border-radius: 50%;
        animation: vDot 1.4s infinite ease-in-out both;
    }
    
    .v-dot:nth-child(1) { animation-delay: -0.32s; }
    .v-dot:nth-child(2) { animation-delay: -0.16s; }

    @keyframes vDot {
        0%, 80%, 100% { transform: scale(0); opacity: 0.3; }
        40% { transform: scale(1); opacity: 1; }
    }

    .v-foot {
        padding: 15px;
        background-color: #080810;
        border-top: 1px solid rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .v-in {
        flex: 1;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.1);
        color: white;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 13px;
        font-family: var(--v-font);
        outline: none;
        transition: border-color 0.2s;
    }
    
    .v-in::placeholder {
        color: #6b7280;
    }
    
    .v-in:focus {
        border-color: var(--v-pri);
        background: rgba(255,255,255,0.05);
    }

    .v-snd {
        background-color: var(--v-pri);
        color: #fff;
        border: none;
        width: 42px;
        height: 42px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.2s;
        touch-action: manipulation; 
    }

    .v-snd:hover {
        background-color: var(--v-sec);
    }

    .v-snd:disabled {
        background-color: #374151;
        color: #6b7280;
        cursor: not-allowed;
    }
    
    .v-snd svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    /* Agentic UI Cyberpunk Focus Animations */
    .ai-global-overlay-active {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(4px);
        z-index: 99990;
        animation: aiOverlayFadeIn 0.3s ease forwards;
        pointer-events: none;
    }
    
    @keyframes aiOverlayFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .ai-focus-highlight {
        position: relative !important;
        z-index: 99995 !important;
        animation: aiFocusPulse 2.5s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
        border-radius: 8px;
        box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.5), 0 0 20px rgba(139, 92, 246, 0.8) !important;
        outline: 2px solid #8b5cf6 !important;
        outline-offset: 4px;
        transition: all 0.3s ease;
    }

    @keyframes aiFocusPulse {
        0%, 100% { box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.5), 0 0 20px rgba(139, 92, 246, 0.8); }
        50% { box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.8), 0 0 40px rgba(239, 68, 68, 1); outline-color: #ef4444; }
    }
</style>

<div class="ai-assist-box" id="navAssistWrapper" style="display:block;">
        <div class="ai-assist-bbl" id="aiAssistBbl">
            <span id="aiAssistBblTxt"></span><span class="ai-assist-cursor" id="aiAssistCursor"></span>
        </div>

        <div class="ai-assist-orb" id="aiAssistOrb" aria-label="Menu VIP">
            <link rel="preload" href="{{ asset('images/logo/staff/neura_ai_pose_1.webp') }}" as="image">
            <link rel="preload" href="{{ asset('images/logo/staff/neura_ai_pose_2.webp') }}" as="image">
            <link rel="preload" href="{{ asset('images/logo/staff/neura_ai_pose_3.webp') }}" as="image">
            <link rel="preload" href="{{ asset('images/logo/staff/neura_ai_pose_4.webp') }}" as="image">
            <link rel="preload" href="{{ asset('images/logo/staff/neura_ai_pose_5.webp') }}" as="image">
            <span style="position:absolute; z-index:1; font-weight:bold; font-size:24px; color:white; pointer-events:none; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">AI</span>
            <img src="{{ asset('images/logo/staff/neura_ai_pose_1.webp') }}" alt="STAFF" id="vAvatarBtn" style="position:relative; z-index:2;">
        </div>
</div>

<div class="ai-assist-pane" id="aiAssistPane">
    <div class="v-hdr">
        <div class="v-hdr-info">
            <div class="v-hdr-img">
                <img src="{{ asset('images/logo/staff/neura_ai_pose_1.webp') }}" alt="STAFF" id="vAvatarHdr">
            </div>
            <div>
                <h3 class="v-title">Neura 2b7t</h3>
                <p class="v-stat" id="vStat">VIP Automotive Staff</p>
            </div>
        </div>
        <button class="v-close" id="vClose" aria-label="Tutup"><i class="fa-solid fa-xmark"></i></button>
    </div>
    
    <div class="v-body" id="vBody">
        <div class="v-txt v-sys">Selamat datang di portal VIP Apex Automotive. Saya Neura, ada yang bisa saya bantu terkait kendaraan Anda?</div>
        <div class="v-load" id="vLoad">
            <div class="v-dot"></div>
            <div class="v-dot"></div>
            <div class="v-dot"></div>
        </div>
    </div>

    <div class="v-foot">
        <input type="text" class="v-in" id="vInp" placeholder="Ketik pesan..." autocomplete="off">
        <button class="v-snd" id="vSnd" aria-label="Kirim" disabled>
            <svg viewBox="0 0 24 24">
                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
            </svg>
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const vBtn = document.getElementById('aiAssistOrb');
        const aiAssistPane = document.getElementById('aiAssistPane');
        const vCls = document.getElementById('vClose');
        const vBdy = document.getElementById('vBody');
        const vInp = document.getElementById('vInp');
        const vSnd = document.getElementById('vSnd');
        const vLd = document.getElementById('vLoad');
        const vImgB = document.getElementById('vAvatarBtn');
        const vImgH = document.getElementById('vAvatarHdr');
        
        let isOpen = false;
        let isProc = false;

        if (vInp) {
            vInp.addEventListener('input', function() {
                 vSnd.disabled = this.value.trim() === '';
            });
        }

        const f1 = "{{ asset('images/logo/staff/neura_ai_pose_1.webp') }}";
        const f2 = "{{ asset('images/logo/staff/neura_ai_pose_2.webp') }}";
        const f3 = "{{ asset('images/logo/staff/neura_ai_pose_3.webp') }}";
        const f4 = "{{ asset('images/logo/staff/neura_ai_pose_4.webp') }}";
        const f5 = "{{ asset('images/logo/staff/neura_ai_pose_5.webp') }}";
        const fs = [f1, f2, f3, f4, f5];
        let fIdx = 0;
        
        setInterval(() => {
            fIdx = (fIdx + 1) % fs.length;
            if(vImgB && vImgB.src !== fs[fIdx]) {
                vImgB.src = fs[fIdx];
            }
            if (vImgH && vImgH.src !== fs[fIdx]) {
                vImgH.src = fs[fIdx];
            }
        }, 1500);

        // --- DRAG LOGIC FOR NEURA ORB ---
        const wrapper = document.getElementById('navAssistWrapper');
        let isDragging = false;
        let dragStartX, dragStartY;
        let initialX, initialY;
        let wasDragged = false;

        function dragStart(e) {
            if (e.target.tagName === 'IMG') e.preventDefault(); // Prevent native image drag
            if (e.type === "touchstart") {
                initialX = e.touches[0].clientX;
                initialY = e.touches[0].clientY;
            } else {
                initialX = e.clientX;
                initialY = e.clientY;
            }

            const rect = wrapper.getBoundingClientRect();
            dragStartX = initialX - rect.left;
            dragStartY = initialY - rect.top;
            
            wasDragged = false;

            document.addEventListener('mousemove', dragActive);
            document.addEventListener('touchmove', dragActive, {passive: false});
            document.addEventListener('mouseup', dragEnd);
            document.addEventListener('touchend', dragEnd);
        }

        function dragActive(e) {
            let currentX, currentY;
            if (e.type === "touchmove") {
                currentX = e.touches[0].clientX;
                currentY = e.touches[0].clientY;
            } else {
                currentX = e.clientX;
                currentY = e.clientY;
            }
            
            const dx = Math.abs(currentX - initialX);
            const dy = Math.abs(currentY - initialY);
            
            if (dx > 5 || dy > 5) {
                isDragging = true;
                wasDragged = true;
            }

            if (isDragging) {
                if (e.cancelable) e.preventDefault();
                let nx = currentX - dragStartX;
                let ny = currentY - dragStartY;
                
                nx = Math.max(0, Math.min(nx, window.innerWidth - wrapper.offsetWidth));
                ny = Math.max(0, Math.min(ny, window.innerHeight - wrapper.offsetHeight));
                
                wrapper.style.left = nx + 'px';
                wrapper.style.top = ny + 'px';
                wrapper.style.right = 'auto';
                wrapper.style.bottom = 'auto';
            }
        }

        function dragEnd(e) {
            isDragging = false;
            document.removeEventListener('mousemove', dragActive);
            document.removeEventListener('touchmove', dragActive);
            document.removeEventListener('mouseup', dragEnd);
            document.removeEventListener('touchend', dragEnd);
        }

        if (vBtn) {
            vBtn.addEventListener('mousedown', dragStart);
            vBtn.addEventListener('touchstart', dragStart, {passive: false});
            
            vBtn.addEventListener('click', (e) => {
                if (wasDragged) {
                    wasDragged = false;
                    e.preventDefault();
                    return;
                }
                if(!isOpen) {
                    isOpen = true;
                    aiAssistPane.classList.add('active');
                    vInp.focus();
                } else {
                    isOpen = false;
                    aiAssistPane.classList.remove('active');
                }
            });
        }
        
        if (vCls) {
            vCls.addEventListener('click', () => {
                isOpen = false;
                aiAssistPane.classList.remove('active');
            });
        }
        
        if (vInp) {
            vInp.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') vSend();
            });
        }
        
        if (vSnd) {
            vSnd.addEventListener('click', vSend);
        }
        
        function vSend() {
            const m = vInp.value.trim();
            if (m === '' || isProc) return;
            
            addM(m, 'v-usr');
            vInp.value = '';
            vInp.disabled = true;
            vSnd.disabled = true;
            
            isProc = true;
            vLd.classList.add('active');
            vBdy.scrollTop = vBdy.scrollHeight;
            
            // Periksa apakah ada kabel dataset yang tercabut (hanya berlaku di halaman Settings)
            let dataset1 = document.getElementById('dataset-1');
            let dataset2 = document.getElementById('dataset-2');
            
            if (dataset1 && dataset2) {
                let isD1Connected = dataset1.classList.contains('connected');
                let isD2Connected = dataset2.classList.contains('connected');
                
                if (!isD1Connected || !isD2Connected) {
                    setTimeout(() => {
                        let errMsg = "Mohon maaf, sistem layanan pelanggan saat ini sedang mengalami kendala teknis.<br><br>Silakan coba kembali dalam beberapa menit.";
                        addM(errMsg, 'v-sys');
                        isProc = false;
                        vLd.classList.remove('active');
                        vInp.disabled = false;
                        if(isOpen) vInp.focus();
                    }, 1000); // Sedikit delay agar terkesan sedang mengecek server
                    return;
                }
            }
            
            vAPI(m);
        }
        
        function addM(text, sender_class) {
            const div = document.createElement('div');
            div.className = 'v-txt ' + sender_class;
            div.innerHTML = text; // Allow strong tags for markdown
            vBdy.insertBefore(div, vLd);
            vBdy.scrollTop = vBdy.scrollHeight;
        }

        function esc(u) {
            return u.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }
        
        async function vAPI(m) {
            try {
                const u = "{{ route('api.chat') }}";
                const r = await fetch(u, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ message: m })
                });
                const d = await r.json();
                
                setTimeout(() => {
                    let replyHtml = (d.reply || "Error.").replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
                    addM(replyHtml, 'v-sys');
                    isProc = false;
                    vLd.classList.remove('active');
                    vInp.disabled = false;
                    if(isOpen) vInp.focus();
                    
                    if (d.action && d.action !== 'none') {
                        executeAgenticAction(d.action);
                    }
                }, 600);
            } catch (e) {
                addM("Koneksi terputus.", 'v-sys');
                isProc = false;
                vLd.classList.remove('active');
                vInp.disabled = false;
            }
        }

        function executeAgenticAction(action) {
            let target = null;
            let noOverlay = false;
            let noScroll = false;
            
            if (action === 'focus_login') {
                target = document.getElementById('navLoginBtn');
                noOverlay = true; // Navbar is fixed, overlay breaks it
                noScroll = true; // Don't scroll to fixed navbar
            } else if (action === 'focus_service') {
                target = document.getElementById('services');
            } else if (action === 'focus_search') {
                target = document.getElementById('filterForm');
                noOverlay = true; // Prevent stacking context z-index issues
            } else if (action === 'focus_dealer') {
                target = document.getElementById('dealer-location');
            } else if (action === 'open_account') {
                target = document.getElementById('userDropdownMenu');
                noOverlay = true;
                noScroll = true;
                if (target) target.classList.remove('hidden');
            }

            if (target) {
                if (!noScroll) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                
                let overlay = null;
                if (!noOverlay) {
                    overlay = document.createElement('div');
                    overlay.className = 'ai-global-overlay-active';
                    document.body.appendChild(overlay);
                }
                
                target.classList.add('ai-focus-highlight');
                
                if(window.innerWidth < 768 && typeof aiAssistPane !== 'undefined') {
                   aiAssistPane.classList.remove('active'); 
                   if (typeof isOpen !== 'undefined') isOpen = false;
                }
                
                setTimeout(() => {
                    target.classList.remove('ai-focus-highlight');
                    if (overlay) overlay.remove();
                }, 2500);
            }
        }

        const phs = [
            "// SISTEM ONLINE.", 
            "// MENGANALISA PREFERENSI...", 
            "// ADA YANG BISA NEURA BANTU?", 
            "// CEK STATUS KENDARAAN.", 
            "// KONSULTASI VIP TERSEDIA.", 
            "// JADWALKAN SERVIS ANDA.", 
            "// MENYIAPKAN DATA DEALER...", 
            "// NEURA STANDBY.",
            "// BUTUH REKOMENDASI?",
            "// AKSES DASHBOARD VIP.",
            "// MENGOPTIMALKAN PERFORMA...",
            "// KOLEKSI TERBARU TIBA.",
            "// KALIBRASI SISTEM SELESAI.",
            "// TEMUKAN KENDARAAN IMPIANMU.",
            "// AKSES EKSKLUSIF DIBUKA.",
            "// ADA JADWAL TEST DRIVE?",
            "// PANDUAN NAVIGASI AKTIF.",
            "// MENUNGGU PERINTAH...",
            "// SINKRONISASI DATA DEALER...",
            "// 24/7! SIAP..."
        ];
        const vBbl = document.getElementById('aiAssistBbl');
        const vBTxt = document.getElementById('aiAssistBblTxt');
        let tOut;
        let lastPhsIdx = -1;
        
        function hdBbl() {
            if(vBbl && vBbl.classList.contains('show')) {
                clearTimeout(tOut);
                vBbl.classList.add('hide-bounce');
                setTimeout(() => {
                    vBbl.classList.remove('show');
                    vBbl.classList.remove('hide-bounce');
                    vBTxt.innerHTML = ''; 
                }, 400); 
            }
        }

        function tWr(t, i, cb) {
            if (i < t.length) {
                vBTxt.innerHTML = t.substring(0, i+1);
                tOut = setTimeout(function() { tWr(t, i + 1, cb); }, 50);
            } else {
                if(cb) cb();
            }
        }

        function trBbl() {
            if (!vBbl || !vBtn) return;
            if (typeof isOpen !== 'undefined' && isOpen) return;
            if (vBtn.matches(':hover') || vBbl.classList.contains('show')) return; 
            
            let newIdx;
            do {
                newIdx = Math.floor(Math.random() * phs.length);
            } while (newIdx === lastPhsIdx);
            lastPhsIdx = newIdx;
            
            const p = phs[newIdx];
            vBTxt.innerHTML = '';
            vBbl.classList.add('show');
            
            clearTimeout(tOut);
            tWr(p, 0, function() {
                setTimeout(hdBbl, 3000);
            });
        }

        setTimeout(trBbl, 3000);
        setInterval(trBbl, 8000);
        
        if(vBtn) vBtn.addEventListener('mouseenter', hdBbl);
    });
</script>

