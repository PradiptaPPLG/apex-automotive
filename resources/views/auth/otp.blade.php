<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi OTP — APEX AUTOMOTIVE</title>
    <meta name="description" content="Masukkan kode OTP yang dikirim ke email Anda.">
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
            background: rgba(5,5,5,0.78);
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
            justify-content: center;
            padding: 20px;
        }

        .otp-card {
            width: 100%;
            max-width: 440px;
            background: rgba(12, 12, 16, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-top: 3px solid #e50914;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.8);
            text-align: center;
        }

        .brand-header {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        .brand-logo { height: 32px; width: auto; }
        .brand-name { font-family: 'Cinzel', serif; font-size: 14px; font-weight: 900; letter-spacing: 3px; color: #fff; line-height: 1; text-align: left; }
        .brand-sub { font-size: 9px; font-family: monospace; letter-spacing: 3px; color: rgba(255,255,255,0.5); text-transform: uppercase; margin-top: 2px; text-align: left; }

        .shield-icon-wrapper {
            position: relative;
            width: 56px;
            height: 56px;
            margin: 0 auto 16px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(229,9,20,0.1);
            border: 1px solid rgba(229,9,20,0.3);
            border-radius: 50%;
        }

        .card-title {
            font-family: 'Cinzel', serif;
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0 0 6px 0;
            letter-spacing: 1px;
        }
        .card-subtitle {
            color: rgba(255,255,255,0.6);
            font-size: 13px;
            margin: 0 0 24px 0;
            line-height: 1.5;
        }

        /* OTP Grid */
        .otp-boxes {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 16px;
        }
        .otp-digit {
            width: 48px;
            height: 58px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.15);
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            outline: none;
            border-radius: 2px;
            transition: all 0.2s ease;
            caret-color: #e50914;
        }
        .otp-digit:focus {
            border-color: #e50914;
            background: rgba(229,9,20,0.08);
            box-shadow: 0 0 0 3px rgba(229,9,20,0.15);
        }
        .otp-digit.filled {
            border-color: rgba(229,9,20,0.5);
            background: rgba(229,9,20,0.06);
        }

        .timer-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 11px;
            font-family: monospace;
            color: rgba(255,255,255,0.4);
            margin-bottom: 24px;
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
        .btn-submit:hover:not(:disabled) {
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 6px 25px rgba(229,9,20,0.6);
        }
        .btn-submit:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            box-shadow: none;
        }

        .resend-box {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.08);
            font-size: 12px;
            color: rgba(255,255,255,0.5);
        }
        .btn-resend {
            background: none;
            border: none;
            color: #e50914;
            font-family: monospace;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: underline;
            margin-top: 6px;
        }
        .btn-resend:hover { color: #ff4d4d; }
    </style>
</head>
<body>

    <!-- BACKGROUND IMAGE & OVERLAY -->
    <div class="bg-container">
        <img src="{{ asset('images/carousell/carousell2.png') }}" alt="Apex Automotive" class="bg-img">
        <div class="bg-overlay"></div>
    </div>

    <!-- BACK LINK -->
    <a href="{{ route('login') }}" class="top-nav">
        <i class="fa-solid fa-arrow-left text-red-500"></i>
        <span>GANTI EMAIL</span>
    </a>

    <!-- MAIN SECTION -->
    <div class="main-wrapper">
        <div class="otp-card">

            <div class="brand-header">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Logo" class="brand-logo">
                <div>
                    <div class="brand-name">APEX</div>
                    <div class="brand-sub">Automotive</div>
                </div>
            </div>

            <div class="shield-icon-wrapper">
                <i class="fa-solid fa-shield-halved" style="color: #e50914; font-size: 20px;"></i>
            </div>

            <h2 class="card-title">Verifikasi Identitas</h2>
            <p class="card-subtitle">
                Kode 6 digit telah dikirimkan ke<br>
                <strong style="color: #fff;">{{ $email }}</strong>
            </p>

            @if ($errors->has('otp'))
                <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; font-size: 11px; font-family: monospace; padding: 10px; margin-bottom: 20px; text-align: left; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>{{ $errors->first('otp') }}</span>
                </div>
            @endif

            <form action="{{ route('auth.verify-otp') }}" method="POST" id="otpForm">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="otp" id="otpHidden">

                <div class="otp-boxes">
                    @for ($i = 0; $i < 6; $i++)
                        <input
                            type="text"
                            inputmode="numeric"
                            maxlength="1"
                            class="otp-digit"
                            id="otp-{{ $i }}"
                            autocomplete="off"
                        >
                    @endfor
                </div>

                <div class="timer-row">
                    <i class="fa-regular fa-clock"></i>
                    <span>Berlaku selama <strong id="countdown" style="color: #fff;">10:00</strong></span>
                </div>

                <button type="submit" id="verifyBtn" class="btn-submit" disabled>
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Verifikasi & Masuk
                </button>
            </form>

            <div class="resend-box">
                Tidak menerima kode?
                <form action="{{ route('auth.send-otp') }}" method="POST" style="margin: 0;">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <button type="submit" class="btn-resend">Kirim Ulang OTP</button>
                </form>
            </div>

        </div>
    </div>

    <script>
        const digits = Array.from(document.querySelectorAll('.otp-digit'));
        const hidden = document.getElementById('otpHidden');
        const verifyBtn = document.getElementById('verifyBtn');

        function syncHidden() {
            const val = digits.map(d => d.value).join('');
            hidden.value = val;
            verifyBtn.disabled = val.length < 6;
        }

        digits.forEach((el, idx) => {
            el.addEventListener('input', (e) => {
                el.value = el.value.replace(/\D/g, '').slice(-1);
                if (el.value) {
                    el.classList.add('filled');
                    if (idx < 5) digits[idx + 1].focus();
                } else {
                    el.classList.remove('filled');
                }
                syncHidden();
            });

            el.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !el.value && idx > 0) {
                    digits[idx - 1].focus();
                    digits[idx - 1].value = '';
                    digits[idx - 1].classList.remove('filled');
                    syncHidden();
                }
            });

            el.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
                pasted.split('').forEach((ch, i) => {
                    if (digits[i]) {
                        digits[i].value = ch;
                        digits[i].classList.add('filled');
                    }
                });
                if (pasted.length === 6) verifyBtn.focus();
                syncHidden();
            });
        });

        digits[0]?.focus();

        let timeLeft = 600;
        const countdownEl = document.getElementById('countdown');

        function updateCountdown() {
            const min = String(Math.floor(timeLeft / 60)).padStart(2, '0');
            const sec = String(timeLeft % 60).padStart(2, '0');
            countdownEl.textContent = `${min}:${sec}`;
            if (timeLeft <= 60) countdownEl.style.color = '#ef4444';
            if (timeLeft <= 0) {
                countdownEl.textContent = 'Kadaluarsa';
                verifyBtn.disabled = true;
            } else {
                timeLeft--;
            }
        }
        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script>
</body>
</html>

