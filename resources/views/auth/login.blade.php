<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — APEX AUTOMOTIVE</title>
    <meta name="description" content="Sign in to your Apex Automotive VIP Buyer account.">
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
                theme: {
                    extend: {
                        fontFamily: { sans: ['Outfit', 'sans-serif'], serif: ['Cinzel', 'serif'] }
                    }
                }
            }
        </script>
    @endif

    <style>
        @keyframes bgPan {
            0% { transform: scale(1.08) translateX(0); }
            100% { transform: scale(1.12) translateX(-2%); }
        }
        .bg-pan { animation: bgPan 12s ease-in-out infinite alternate; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both; }
        .fade-up-1 { animation-delay: 0.05s; }
        .fade-up-2 { animation-delay: 0.15s; }
        .fade-up-3 { animation-delay: 0.25s; }
        .fade-up-4 { animation-delay: 0.35s; }

        .glass-form {
            background: rgba(10, 10, 14, 0.82);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border: 1px solid rgba(255,255,255,0.09);
        }
        .input-apex {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.12);
            color: white;
            width: 100%;
            padding: 0.85rem 1rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }
        .input-apex:focus {
            border-color: #e50914;
            background: rgba(229,9,20,0.05);
            box-shadow: 0 0 0 3px rgba(229,9,20,0.15);
        }
        .input-apex::placeholder { color: rgba(255,255,255,0.3); }
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
        .btn-apex-red:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(229,9,20,0.45);
        }
        .btn-apex-red:active { transform: translateY(0); }
        .noise-overlay {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-black text-white font-sans min-h-screen overflow-hidden">

    <!-- FULL-SCREEN CINEMATIC BACKGROUND -->
    <div class="fixed inset-0 z-0">
        <img src="{{ asset('images/carousell/carousell1.png') }}"
             alt="Apex Automotive Showroom"
             class="bg-pan w-full h-full object-cover">
        <!-- Multi-layer dark gradient -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/70 to-black/30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/50"></div>
        <div class="absolute inset-0 noise-overlay"></div>
    </div>

    <!-- BACK TO SHOWROOM LINK -->
    <a href="/" class="fixed top-6 left-6 z-50 flex items-center space-x-2 text-xs font-mono tracking-widest text-white/60 hover:text-white transition-colors group">
        <i class="fa-solid fa-arrow-left text-red-500 group-hover:-translate-x-1 transition-transform"></i>
        <span>KEMBALI KE SHOWROOM</span>
    </a>

    <!-- MAIN LAYOUT: LEFT BRANDING + RIGHT FORM -->
    <div class="relative z-10 min-h-screen flex items-center justify-end pr-0 lg:pr-16 xl:pr-24">

        <!-- LEFT: Branding visible on large screens -->
        <div class="hidden lg:flex flex-col justify-center flex-1 pl-16 xl:pl-24 space-y-6">
            <div class="space-y-3 fade-up fade-up-1">
                <div class="flex items-center space-x-3">
                    <span class="h-px w-8 bg-red-600"></span>
                    <span class="text-xs font-mono tracking-[0.35em] text-red-500 uppercase font-bold">VIP Buyer Portal</span>
                </div>
                <h1 class="text-4xl xl:text-6xl font-serif font-black uppercase leading-none text-white drop-shadow-2xl">
                    The Finest<br>Hypercars.<br>
                    <span class="text-red-600">Reserved<br>for You.</span>
                </h1>
            </div>
            <p class="text-sm text-neutral-400 max-w-xs font-light leading-relaxed fade-up fade-up-2">
                Masuk ke akun VIP Apex Automotive Anda untuk mengakses konfigurasi eksklusif, mengajukan SPK, dan menjadwalkan serah terima kendaraan impian Anda.
            </p>
            <div class="flex items-center space-x-6 pt-4 fade-up fade-up-3">
                <div class="text-center">
                    <div class="text-2xl font-serif font-black text-white">10+</div>
                    <div class="text-[10px] font-mono text-neutral-400 tracking-widest uppercase">Brand Eksklusif</div>
                </div>
                <div class="w-px h-8 bg-white/10"></div>
                <div class="text-center">
                    <div class="text-2xl font-serif font-black text-white">Rp 6B+</div>
                    <div class="text-[10px] font-mono text-neutral-400 tracking-widest uppercase">Harga Mulai</div>
                </div>
                <div class="w-px h-8 bg-white/10"></div>
                <div class="text-center">
                    <div class="text-2xl font-serif font-black text-white">WGD</div>
                    <div class="text-[10px] font-mono text-neutral-400 tracking-widest uppercase">White-Glove Delivery</div>
                </div>
            </div>
        </div>

        <!-- RIGHT: Login Form Panel -->
        <div class="w-full lg:w-auto lg:min-w-[420px] xl:min-w-[460px] min-h-screen lg:min-h-0 flex items-center justify-center p-6 lg:p-0">
            <div class="glass-form w-full max-w-md p-8 sm:p-10 space-y-8 shadow-2xl">

                <!-- LOGO -->
                <div class="space-y-1 fade-up fade-up-1">
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive Logo" class="h-9 w-auto object-contain">
                        <div>
                            <div class="font-serif text-base font-black tracking-widest text-white uppercase">APEX</div>
                            <div class="text-[9px] font-mono tracking-[0.3em] text-neutral-400 -mt-0.5 uppercase">Automotive</div>
                        </div>
                    </div>
                    <h2 class="text-2xl font-serif font-black text-white uppercase tracking-wide leading-tight">
                        Masuk ke Akun<br>VIP Anda
                    </h2>
                    <p class="text-xs text-neutral-400 font-light pt-1">
                        Kami akan mengirimkan kode OTP ke email Anda. Tanpa password diperlukan.
                    </p>
                </div>

                <!-- FLASH INFO MESSAGE -->
                @if (session('info'))
                    <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono p-3 flex items-start space-x-2">
                        <i class="fa-solid fa-circle-check mt-0.5 shrink-0"></i>
                        <span>{{ session('info') }}</span>
                    </div>
                @endif

                <!-- EMAIL FORM -->
                <form action="{{ route('auth.send-otp') }}" method="POST" class="space-y-5 fade-up fade-up-2">
                    @csrf

                    <div class="space-y-1.5">
                        <label for="email" class="block text-[11px] font-mono tracking-widest uppercase text-neutral-400 font-semibold">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <i class="fa-regular fa-envelope text-neutral-500 text-sm"></i>
                            </div>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="email@example.com"
                                autocomplete="email"
                                class="input-apex pl-10"
                                required
                            >
                        </div>
                        @error('email')
                            <p class="text-red-500 text-[11px] font-mono mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-apex-red">
                        <i class="fa-solid fa-paper-plane mr-2"></i>
                        KIRIM KODE OTP
                    </button>
                </form>

                <!-- DIVIDER -->
                <div class="flex items-center space-x-3 fade-up fade-up-3">
                    <div class="flex-1 h-px bg-white/10"></div>
                    <span class="text-[10px] font-mono text-neutral-600 uppercase tracking-widest">Keamanan & Privasi</span>
                    <div class="flex-1 h-px bg-white/10"></div>
                </div>

                <!-- SECURITY BADGES -->
                <div class="grid grid-cols-3 gap-3 text-center fade-up fade-up-4">
                    <div class="space-y-1.5">
                        <div class="w-9 h-9 mx-auto bg-white/5 border border-white/10 flex items-center justify-center">
                            <i class="fa-solid fa-shield-halved text-red-500 text-sm"></i>
                        </div>
                        <p class="text-[10px] font-mono text-neutral-500 leading-tight">Terenkripsi<br>End-to-End</p>
                    </div>
                    <div class="space-y-1.5">
                        <div class="w-9 h-9 mx-auto bg-white/5 border border-white/10 flex items-center justify-center">
                            <i class="fa-solid fa-key text-red-500 text-sm"></i>
                        </div>
                        <p class="text-[10px] font-mono text-neutral-500 leading-tight">OTP Sekali<br>Pakai</p>
                    </div>
                    <div class="space-y-1.5">
                        <div class="w-9 h-9 mx-auto bg-white/5 border border-white/10 flex items-center justify-center">
                            <i class="fa-solid fa-user-secret text-red-500 text-sm"></i>
                        </div>
                        <p class="text-[10px] font-mono text-neutral-500 leading-tight">Zero<br>Password</p>
                    </div>
                </div>

                <!-- FOOTER NOTE -->
                <p class="text-[10px] font-mono text-neutral-600 text-center fade-up fade-up-4">
                    Dengan masuk, Anda menyetujui
                    <span class="text-neutral-400 underline cursor-pointer">Syarat & Ketentuan</span>
                    serta
                    <span class="text-neutral-400 underline cursor-pointer">Kebijakan Privasi</span>
                    PT Apex Automotive Indonesia.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
