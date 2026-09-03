<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi OTP — APEX AUTOMOTIVE</title>
    <meta name="description" content="Masukkan kode OTP yang dikirim ke email Anda.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: { extend: { fontFamily: { sans: ['Outfit', 'sans-serif'], serif: ['Cinzel', 'serif'] } } }
            }
        </script>
    @endif

    <style>
        @keyframes bgPan {
            0% { transform: scale(1.08); }
            100% { transform: scale(1.12) translateX(-1.5%); }
        }
        .bg-pan { animation: bgPan 14s ease-in-out infinite alternate; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both; }
        .fade-up-1 { animation-delay: 0.05s; }
        .fade-up-2 { animation-delay: 0.15s; }
        .fade-up-3 { animation-delay: 0.25s; }

        .glass-form {
            background: rgba(10, 10, 14, 0.85);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border: 1px solid rgba(255,255,255,0.09);
        }

        /* OTP Digit Inputs */
        .otp-digit {
            width: 56px;
            height: 64px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.15);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            text-align: center;
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s, transform 0.15s;
            caret-color: #e50914;
        }
        .otp-digit:focus {
            border-color: #e50914;
            background: rgba(229,9,20,0.07);
            box-shadow: 0 0 0 3px rgba(229,9,20,0.18);
            transform: scale(1.05);
        }
        .otp-digit.filled {
            border-color: rgba(229,9,20,0.6);
            background: rgba(229,9,20,0.08);
        }
        .otp-digit.shake {
            animation: shake 0.4s ease;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-5px); }
            40% { transform: translateX(5px); }
            60% { transform: translateX(-4px); }
            80% { transform: translateX(4px); }
        }

        .btn-apex-red {
            background: linear-gradient(135deg, #e50914 0%, #b80710 100%);
            color: white;
            border: none;
            width: 100%;
            padding: 0.9rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 20px rgba(229,9,20,0.35);
        }
        .btn-apex-red:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 8px 28px rgba(229,9,20,0.45); }
        .btn-apex-red:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

        /* Countdown ring */
        @keyframes countdown { from { stroke-dashoffset: 0; } to { stroke-dashoffset: 188.5; } }
        .countdown-ring { animation: countdown 600s linear forwards; }
    </style>
</head>
<body class="bg-black text-white font-sans min-h-screen overflow-hidden">

    <!-- FULL-SCREEN CINEMATIC BACKGROUND -->
    <div class="fixed inset-0 z-0">
        <img src="{{ asset('images/carousell/carousell2.png') }}"
             alt="Apex Automotive"
             class="bg-pan w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/75 to-black/40"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/50"></div>
    </div>

    <!-- BACK LINK -->
    <a href="{{ route('login') }}" class="fixed top-6 left-6 z-50 flex items-center space-x-2 text-xs font-mono tracking-widest text-white/60 hover:text-white transition-colors group">
        <i class="fa-solid fa-arrow-left text-red-500 group-hover:-translate-x-1 transition-transform"></i>
        <span>GANTI EMAIL</span>
    </a>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-6">
        <div class="glass-form w-full max-w-md p-8 sm:p-10 space-y-8 shadow-2xl">

            <!-- HEADER -->
            <div class="space-y-2 text-center fade-up fade-up-1">
                <div class="flex items-center justify-center space-x-3 mb-5">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive Logo" class="h-8 w-auto object-contain">
                </div>

                <!-- Lock Icon with pulse ring -->
                <div class="relative inline-flex items-center justify-center w-16 h-16 mx-auto mb-2">
                    <div class="absolute inset-0 bg-red-600/20 rounded-full animate-ping"></div>
                    <div class="relative w-14 h-14 bg-red-600/15 border border-red-600/30 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-shield-halved text-red-500 text-xl"></i>
                    </div>
                </div>

                <h2 class="text-2xl font-serif font-black text-white uppercase tracking-wide">
                    Verifikasi Identitas
                </h2>
                <p class="text-xs text-neutral-400 font-light leading-relaxed">
                    Kami telah mengirimkan kode 6 digit ke<br>
                    <strong class="text-white font-semibold">{{ $email }}</strong>
                </p>
            </div>

            <!-- ERROR MESSAGE -->
            @if ($errors->has('otp'))
                <div class="bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-mono p-3 flex items-start space-x-2">
                    <i class="fa-solid fa-triangle-exclamation mt-0.5 shrink-0"></i>
                    <span>{{ $errors->first('otp') }}</span>
                </div>
            @endif

            <!-- OTP ENTRY FORM -->
            <form action="{{ route('auth.verify-otp') }}" method="POST" id="otpForm" class="space-y-6 fade-up fade-up-2">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <!-- Hidden combined input that gets submitted -->
                <input type="hidden" name="otp" id="otpHidden">

                <div class="space-y-3">
                    <label class="block text-[11px] font-mono tracking-widest uppercase text-neutral-400 font-semibold text-center">
                        Masukkan Kode OTP
                    </label>

                    <!-- 6 digit boxes -->
                    <div class="flex items-center justify-center gap-2 sm:gap-3" id="otpBoxes">
                        @for ($i = 0; $i < 6; $i++)
                            <input
                                type="text"
                                inputmode="numeric"
                                maxlength="1"
                                class="otp-digit @error('otp') shake @enderror"
                                id="otp-{{ $i }}"
                                autocomplete="off"
                                aria-label="Digit {{ $i + 1 }} dari 6"
                            >
                        @endfor
                    </div>

                    <!-- Countdown Timer -->
                    <div class="flex items-center justify-center space-x-2 pt-1">
                        <i class="fa-regular fa-clock text-neutral-600 text-xs"></i>
                        <span class="text-[11px] font-mono text-neutral-500">
                            Berlaku selama <span id="countdown" class="text-white font-bold">10:00</span>
                        </span>
                    </div>
                </div>

                <button type="submit" id="verifyBtn" class="btn-apex-red" disabled>
                    <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i>
                    VERIFIKASI & MASUK
                </button>
            </form>

            <!-- RESEND OTP -->
            <div class="text-center space-y-2 fade-up fade-up-3">
                <p class="text-xs text-neutral-500">
                    Tidak menerima kode?
                </p>
                <form action="{{ route('auth.send-otp') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <button type="submit"
                            class="text-xs font-mono font-bold text-red-500 hover:text-red-400 tracking-widest uppercase underline underline-offset-4 transition-colors">
                        KIRIM ULANG OTP
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // ── OTP BOX CONTROLLER ──────────────────────────────────────
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
                // Only allow numbers
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

            // Allow paste of full OTP into first box
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

        // Focus first box on load
        digits[0]?.focus();

        // ── 10-MINUTE COUNTDOWN ────────────────────────────────────
        let timeLeft = 600; // 10 min in seconds
        const countdownEl = document.getElementById('countdown');

        function updateCountdown() {
            const min = String(Math.floor(timeLeft / 60)).padStart(2, '0');
            const sec = String(timeLeft % 60).padStart(2, '0');
            countdownEl.textContent = `${min}:${sec}`;
            if (timeLeft <= 60) countdownEl.classList.add('text-red-500');
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
