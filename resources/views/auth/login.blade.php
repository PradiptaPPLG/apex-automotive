<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login VIP — APEX AUTOMOTIVE</title>
    <meta name="description" content="Sign in to your Apex Automotive VIP Buyer account.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;900&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { box-sizing: border-box; }
        body, html { margin: 0; padding: 0; height: 100%; font-family: 'Outfit', sans-serif; background-color: #050505; color: #fff; overflow-x: hidden; }

        .bg-container {
            position: fixed;
            inset: 0;
            z-index: 1;
            overflow: hidden;
        }
        .bg-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .bg-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(5,5,5,0.92) 0%, rgba(5,5,5,0.7) 50%, rgba(5,5,5,0.4) 100%);
        }

        .top-nav {
            position: fixed;
            top: 24px;
            left: 32px;
            z-index: 50;
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 12px;
            font-family: monospace;
            letter-spacing: 2px;
            transition: color 0.2s ease;
        }
        .top-nav:hover { color: #ffffff; }

        .main-wrapper {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 40px 60px;
            max-width: 1440px;
            margin: 0 auto;
        }

        .left-content {
            flex: 1;
            max-width: 580px;
            padding-right: 40px;
        }

        .badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #e50914;
            font-size: 11px;
            font-family: monospace;
            letter-spacing: 4px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 16px;
        }
        .badge-line {
            width: 32px;
            height: 2px;
            background-color: #e50914;
        }

        .hero-title {
            font-family: 'Cinzel', serif;
            font-size: 56px;
            font-weight: 900;
            line-height: 1.05;
            text-transform: uppercase;
            margin: 0 0 20px 0;
            letter-spacing: 1px;
        }
        .hero-title span { color: #e50914; }

        .hero-desc {
            color: rgba(255,255,255,0.65);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 36px;
            max-width: 440px;
        }

        .stats-row {
            display: flex;
            align-items: center;
            gap: 32px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .stat-item { text-align: left; }
        .stat-val { font-family: 'Cinzel', serif; font-size: 24px; font-weight: 700; color: #fff; }
        .stat-lbl { font-size: 10px; font-family: monospace; color: rgba(255,255,255,0.4); text-transform: uppercase; margin-top: 2px; }

        .right-content {
            width: 100%;
            max-width: 440px;
            flex-shrink: 0;
        }

        .login-card {
            background: rgba(12, 12, 16, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-left: 3px solid #e50914;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.8);
            position: relative;
            overflow: hidden;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }
        .brand-logo { height: 32px; width: auto; }
        .brand-name { font-family: 'Cinzel', serif; font-size: 14px; font-weight: 900; letter-spacing: 3px; color: #fff; line-height: 1; }
        .brand-sub { font-size: 9px; font-family: monospace; letter-spacing: 3px; color: rgba(255,255,255,0.5); text-transform: uppercase; margin-top: 2px; }

        .card-title {
            font-family: 'Cinzel', serif;
            font-size: 22px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0 0 6px 0;
            letter-spacing: 1px;
        }
        .card-subtitle {
            color: rgba(255,255,255,0.5);
            font-size: 12px;
            margin: 0 0 24px 0;
            line-height: 1.4;
        }

        .btn-google {
            width: 100%;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.15);
            color: #fff;
            padding: 13px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.2s ease;
            margin-bottom: 20px;
        }
        .btn-google:hover {
            background: rgba(255,255,255,0.12);
            border-color: rgba(255,255,255,0.3);
        }

        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 10px;
            font-family: monospace;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.6);
            margin-bottom: 8px;
            font-weight: 600;
        }

        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.4);
            font-size: 14px;
        }
        .custom-input {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.15);
            color: #fff;
            padding: 14px 14px 14px 42px;
            font-size: 14px;
            outline: none;
            border-radius: 2px;
            transition: all 0.2s ease;
        }
        .custom-input:focus {
            border-color: #e50914;
            background: rgba(229,9,20,0.05);
            box-shadow: 0 0 0 3px rgba(229,9,20,0.15);
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #e50914 0%, #b80710 100%);
            color: #fff;
            border: none;
            padding: 15px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            cursor: pointer;
            border-radius: 2px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 20px rgba(229,9,20,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-submit:hover {
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 6px 25px rgba(229,9,20,0.6);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
        }
        .divider-line { flex: 1; height: 1px; background: rgba(255,255,255,0.1); }
        .divider-text { font-size: 9px; font-family: monospace; color: rgba(255,255,255,0.4); letter-spacing: 2px; text-transform: uppercase; }

        .terms-text {
            font-size: 10px;
            color: rgba(255,255,255,0.35);
            text-align: center;
            line-height: 1.5;
            margin: 20px 0 0 0;
        }
        .terms-text a { color: rgba(255,255,255,0.6); text-decoration: underline; }

        /* STEP 2 OTP POPUP / MODAL OVERLAY IN-CARD */
        .otp-modal {
            position: absolute;
            inset: 0;
            background: rgba(10, 10, 14, 0.97);
            backdrop-filter: blur(25px);
            z-index: 30;
            padding: 36px 30px;
            display: flex;
            flex-col;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            opacity: 0;
            pointer-events: none;
            transform: translateY(15px);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .otp-modal.active {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        .otp-boxes {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 20px 0 16px 0;
        }
        .otp-digit {
            width: 44px;
            height: 54px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-size: 22px;
            font-weight: 700;
            text-align: center;
            outline: none;
            border-radius: 2px;
            caret-color: #e50914;
            transition: all 0.2s ease;
        }
        .otp-digit:focus {
            border-color: #e50914;
            background: rgba(229,9,20,0.1);
            box-shadow: 0 0 0 3px rgba(229,9,20,0.2);
        }

        .back-step-btn {
            background: none;
            border: none;
            color: rgba(255,255,255,0.5);
            font-size: 11px;
            font-family: monospace;
            cursor: pointer;
            margin-top: 16px;
            text-decoration: underline;
        }
        .back-step-btn:hover { color: #fff; }

        @media (max-width: 992px) {
            .left-content { display: none; }
            .main-wrapper { justify-content: center; padding: 20px; }
            .top-nav { top: 16px; left: 16px; }
        }
    </style>
</head>
<body>

    <!-- BACKGROUND VIDEO & OVERLAY -->
    <div class="bg-container">
        <video class="bg-video" autoplay muted loop playsinline preload="auto">
            <source src="{{ asset('intro_login.mp4') }}" type="video/mp4">
        </video>
        <div class="bg-overlay"></div>
    </div>

    <!-- BACK TO SHOWROOM LINK -->
    <a href="/" class="top-nav">
        <i class="fa-solid fa-arrow-left text-red-500"></i>
        <span>KEMBALI KE SHOWROOM</span>
    </a>

    <!-- MAIN SECTION -->
    <div class="main-wrapper">

        <!-- LEFT BRANDING PANEL -->
        <div class="left-content">
            <div class="badge-tag">
                <span class="badge-line"></span>
                <span>VIP Buyer Portal</span>
            </div>
            <h1 class="hero-title">
                The Finest<br>Hypercars.<br>
                <span>Reserved<br>for You.</span>
            </h1>
            <p class="hero-desc">
                Masuk ke akun VIP Apex Automotive Anda untuk mengakses konfigurasi eksklusif, mengajukan SPK, dan menjadwalkan serah terima kendaraan impian Anda.
            </p>
            <div class="stats-row">
                <div class="stat-item">
                    <div class="stat-val">10+</div>
                    <div class="stat-lbl">Brand Eksklusif</div>
                </div>
                <div style="width: 1px; height: 28px; background: rgba(255,255,255,0.1);"></div>
                <div class="stat-item">
                    <div class="stat-val">Rp 6B+</div>
                    <div class="stat-lbl">Harga Mulai</div>
                </div>
                <div style="width: 1px; height: 28px; background: rgba(255,255,255,0.1);"></div>
                <div class="stat-item">
                    <div class="stat-val">WGD</div>
                    <div class="stat-lbl">White-Glove</div>
                </div>
            </div>
        </div>

        <!-- RIGHT LOGIN FORM PANEL -->
        <div class="right-content">
            <div class="login-card">

                <div class="brand-header">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Logo" class="brand-logo">
                    <div>
                        <div class="brand-name">APEX</div>
                        <div class="brand-sub">Automotive</div>
                    </div>
                </div>

                <h2 class="card-title">Masuk ke Akun VIP</h2>
                <p class="card-subtitle">Silakan pilih metode masuk atau masukkan email Anda.</p>

                <!-- SSO GOOGLE BUTTON -->
                <a href="{{ route('auth.google') }}" class="btn-google" style="text-decoration: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span>Sign in with Google</span>
                </a>

                <!-- SIGN IN WITH VIP ID CARD BUTTON -->
                <button type="button" onclick="openQrModal()" class="btn-google" style="margin-bottom: 20px; background: rgba(229, 9, 20, 0.12); border-color: rgba(229, 9, 20, 0.4); color: #fff;">
                    <i class="fa-solid fa-qrcode" style="color: #e50914; font-size: 16px;"></i>
                    <span>Sign in with VIP ID Card</span>
                </button>

                <div class="divider">
                    <div class="divider-line"></div>
                    <div class="divider-text">Atau dengan Email</div>
                    <div class="divider-line"></div>
                </div>

                @if (session('info'))
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; font-size: 11px; font-family: monospace; padding: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('info') }}</span>
                    </div>
                @endif

                <!-- EMAIL STEP FORM -->
                <form id="emailStepForm" action="{{ route('auth.send-otp') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Alamat Email VIP</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@domain.com"
                                class="custom-input"
                                required
                            >
                        </div>
                        @error('email')
                            <p style="color: #ef4444; font-size: 11px; font-family: monospace; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">
                        <span>Lanjutkan</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

                <!-- POPUP POP-OVER FOR OTP (STEP 2) -->
                <div class="otp-modal @if(request('verify') || session('email_sent')) active @endif" id="otpPopup">
                    <div style="width: 44px; height: 44px; background: rgba(229,9,20,0.15); border: 1px solid rgba(229,9,20,0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                        <i class="fa-solid fa-shield-halved text-red-500" style="color: #e50914;"></i>
                    </div>
                    <h3 style="font-family: 'Cinzel', serif; font-size: 18px; margin: 0 0 4px 0; text-transform: uppercase;">Kode Verifikasi OTP</h3>
                    <p style="font-size: 11px; color: rgba(255,255,255,0.6); margin: 0; line-height: 1.4;">
                        Kode OTP 6 digit telah dikirim ke<br>
                        <strong id="displayTargetEmail" style="color: #fff;">{{ session('email_sent', old('email')) }}</strong>
                    </p>

                    <form action="{{ route('auth.verify-otp') }}" method="POST" style="width: 100%;">
                        @csrf
                        <input type="hidden" name="email" id="modalOtpEmail" value="{{ session('email_sent', old('email')) }}">
                        <input type="hidden" name="otp" id="modalOtpHidden">

                        <div class="otp-boxes">
                            @for ($i = 0; $i < 6; $i++)
                                <input type="text" inputmode="numeric" maxlength="1" class="otp-digit modal-otp-box" id="modal-otp-{{ $i }}" autocomplete="off">
                            @endfor
                        </div>

                        <button type="submit" id="modalVerifyBtn" class="btn-submit" disabled>
                            <i class="fa-solid fa-check"></i>
                            Verifikasi & Masuk
                        </button>
                    </form>

                    <button type="button" class="back-step-btn" onclick="closeOtpPopup()">
                        &larr; Ubah Alamat Email
                    </button>
                </div>

                <p class="terms-text">
                    Dengan masuk, Anda menyetujui <a href="#">Syarat & Ketentuan</a> serta <a href="#">Kebijakan Privasi</a> PT Apex Automotive.
                </p>

            </div>
        </div>

    </div>

    <!-- QR CODE SCANNER MODAL -->
    <div id="qrModal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.85); backdrop-filter:blur(10px); align-items:center; justify-content:center; padding: 20px;">
        <div style="background:#0c0c10; border:1px solid rgba(255,255,255,0.15); border-left:3px solid #e50914; border-radius:8px; padding:32px 24px; text-align:center; max-width:400px; width:100%; box-shadow:0 25px 60px rgba(0,0,0,0.9);">
            <div style="width:48px; height:48px; background:rgba(229,9,20,0.15); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                <i class="fa-solid fa-qrcode" style="color:#e50914; font-size:22px;"></i>
            </div>
            <h3 style="font-family:'Cinzel', serif; font-size:18px; font-weight:700; color:#fff; margin-bottom:6px;">Scan VIP ID Card</h3>
            <p style="font-size:12px; color:rgba(255,255,255,0.6); margin-bottom:20px;">Arahkan QR Code pada ID Card Anda ke kamera komputer/smartphone Anda.</p>
            
            <div id="qr-reader" style="width:100%; margin-bottom:16px; border-radius:6px; overflow:hidden; border:1px solid rgba(255,255,255,0.1); background:#000;"></div>
            
            <div id="qrError" style="display:none; font-size:11px; font-family:monospace; color:#ef4444; margin-bottom:14px; padding:10px; background:rgba(239,68,68,0.1); border-radius:4px; border:1px solid rgba(239,68,68,0.3);">
            </div>

            <button type="button" onclick="closeQrModal()" style="font-family:monospace; font-size:11px; color:#fff; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); padding:10px 24px; border-radius:4px; cursor:pointer; text-transform:uppercase; letter-spacing:1px; transition:all 0.2s;">
                Tutup Pemindai
            </button>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        const emailInput = document.getElementById('email');
        const displayTargetEmail = document.getElementById('displayTargetEmail');
        const modalOtpEmail = document.getElementById('modalOtpEmail');
        const otpPopup = document.getElementById('otpPopup');

        function closeOtpPopup() {
            otpPopup.classList.remove('active');
        }

        // OTP Input Sync Logic for Modal
        const modalDigits = Array.from(document.querySelectorAll('.modal-otp-box'));
        const modalHidden = document.getElementById('modalOtpHidden');
        const modalVerifyBtn = document.getElementById('modalVerifyBtn');

        function syncModalHidden() {
            const val = modalDigits.map(d => d.value).join('');
            modalHidden.value = val;
            modalVerifyBtn.disabled = val.length < 6;
        }

        modalDigits.forEach((el, idx) => {
            el.addEventListener('input', (e) => {
                el.value = el.value.replace(/\D/g, '').slice(-1);
                if (el.value && idx < 5) modalDigits[idx + 1].focus();
                syncModalHidden();
            });

            el.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !el.value && idx > 0) {
                    modalDigits[idx - 1].focus();
                    modalDigits[idx - 1].value = '';
                    syncModalHidden();
                }
            });
        });

        /* ── QR CODE SCANNER LOGIC ── */
        let html5QrcodeScanner = null;

        function openQrModal() {
            const modal = document.getElementById('qrModal');
            modal.style.display = 'flex';
            document.getElementById('qrError').style.display = 'none';
            
            if (!html5QrcodeScanner) {
                html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: { width: 220, height: 220 } });
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            }
        }

        function closeQrModal() {
            document.getElementById('qrModal').style.display = 'none';
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear().catch(err => console.error("Gagal menghentikan kamera:", err));
                html5QrcodeScanner = null;
            }
        }

        async function onScanSuccess(decodedText) {
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear();
                html5QrcodeScanner = null;
            }

            try {
                const response = await fetch("{{ route('login.qr') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ qr_payload: decodedText })
                });

                const data = await response.json();

                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    const errDiv = document.getElementById('qrError');
                    errDiv.style.display = 'block';
                    errDiv.innerText = data.message || "Autentikasi QR Gagal.";
                    setTimeout(() => {
                        html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: { width: 220, height: 220 } });
                        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                    }, 3000);
                }
            } catch (e) {
                console.error("Gagal autentikasi via QR:", e);
                const errDiv = document.getElementById('qrError');
                errDiv.style.display = 'block';
                errDiv.innerText = "Terjadi kesalahan koneksi server.";
            }
        }

        function onScanFailure(error) {
            // Quietly continue scanning
        }
    </script>
</body>
</html>

