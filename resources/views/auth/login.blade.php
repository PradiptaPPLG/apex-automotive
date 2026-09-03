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

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: { sans: ['Outfit', 'sans-serif'], serif: ['Cinzel', 'serif'] }
                    }
                }
            }
        </script>
    @endif

    <style>
        * { box-sizing: border-box; }
        body, html { margin: 0; padding: 0; height: 100%; font-family: 'Outfit', sans-serif; background-color: #050505; color: #fff; overflow-x: hidden; }

        .bg-container {
            position: fixed;
            inset: 0;
            z-index: 1;
            overflow: hidden;
        }
        .bg-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            animation: bgZoom 20s ease-in-out infinite alternate;
        }
        @keyframes bgZoom {
            0% { transform: scale(1.0); }
            100% { transform: scale(1.08); }
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
        .stat-lbl { font-size: 10px; font-family: monospace; color: rgba(255,255,255,0.4); tracking-widest: 2px; text-transform: uppercase; margin-top: 2px; }

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
            margin: 0 0 28px 0;
            line-height: 1.4;
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
            margin: 24px 0;
        }
        .divider-line { flex: 1; height: 1px; background: rgba(255,255,255,0.1); }
        .divider-text { font-size: 9px; font-family: monospace; color: rgba(255,255,255,0.4); letter-spacing: 2px; text-transform: uppercase; }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            text-align: center;
            margin-bottom: 24px;
        }
        .feat-box {
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(255,255,255,0.06);
            padding: 12px 6px;
            border-radius: 2px;
        }
        .feat-icon { color: #e50914; font-size: 14px; margin-bottom: 6px; }
        .feat-text { font-size: 9px; font-family: monospace; color: rgba(255,255,255,0.5); line-height: 1.2; }

        .terms-text {
            font-size: 10px;
            color: rgba(255,255,255,0.35);
            text-align: center;
            line-height: 1.5;
            margin: 0;
        }
        .terms-text a { color: rgba(255,255,255,0.6); text-decoration: underline; }

        @media (max-width: 992px) {
            .left-content { display: none; }
            .main-wrapper { justify-content: center; padding: 20px; }
            .top-nav { top: 16px; left: 16px; }
        }
    </style>
</head>
<body>

    <!-- BACKGROUND IMAGE & OVERLAY -->
    <div class="bg-container">
        <img src="{{ asset('images/carousell/carousell1.png') }}" alt="Apex Automotive Showroom" class="bg-img">
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
                <p class="card-subtitle">Kami akan mengirimkan kode OTP ke email Anda. Tanpa password.</p>

                @if (session('info'))
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; font-size: 11px; font-family: monospace; padding: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('info') }}</span>
                    </div>
                @endif

                <form action="{{ route('auth.send-otp') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Alamat Email</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="email@example.com"
                                class="custom-input"
                                required
                                autofocus
                            >
                        </div>
                        @error('email')
                            <p style="color: #ef4444; font-size: 11px; font-family: monospace; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-paper-plane"></i>
                        Kirim Kode OTP
                    </button>
                </form>

                <div class="divider">
                    <div class="divider-line"></div>
                    <div class="divider-text">Keamanan & Privasi</div>
                    <div class="divider-line"></div>
                </div>

                <div class="features-grid">
                    <div class="feat-box">
                        <i class="fa-solid fa-shield-halved feat-icon"></i>
                        <div class="feat-text">Terenkripsi<br>End-to-End</div>
                    </div>
                    <div class="feat-box">
                        <i class="fa-solid fa-key feat-icon"></i>
                        <div class="feat-text">OTP Sekali<br>Pakai</div>
                    </div>
                    <div class="feat-box">
                        <i class="fa-solid fa-user-secret feat-icon"></i>
                        <div class="feat-text">Zero<br>Password</div>
                    </div>
                </div>

                <p class="terms-text">
                    Dengan masuk, Anda menyetujui <a href="#">Syarat & Ketentuan</a> serta <a href="#">Kebijakan Privasi</a> PT Apex Automotive.
                </p>

            </div>
        </div>

    </div>

</body>
</html>

