<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Apex Automotive - Official Luxury Supercar & Hypercar Dealer in Jakarta. Exclusive inventory of BMW Motorsport, Lamborghini, McLaren, Ferrari, Porsche, Audi, Koenigsegg, Bugatti, Chevrolet Corvette, Pagani, Zenvo, and Jeep.">
    <title>APEX AUTOMOTIVE | Official Luxury Showroom & Hypercar Dealer</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800;900&family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind / Vite -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            apex: {
                                red: '#e50914',
                                dark: '#0a0a0c',
                                card: '#121216',
                                border: 'rgba(255, 255, 255, 0.1)'
                            }
                        },
                        fontFamily: {
                            sans: ['Outfit', 'Inter', 'sans-serif'],
                            serif: ['Cinzel', 'serif']
                        }
                    }
                }
            }
        </script>
        <style>
            .reveal-on-scroll {
                opacity: 0;
                transform: translateY(30px);
                transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            }
            .reveal-on-scroll.is-visible {
                opacity: 1;
                transform: translateY(0);
            }
            .red-divider-line {
                height: 2px;
                width: 36px;
                background: linear-gradient(90deg, #e50914, #ff4d4d);
            }
            .glass-nav {
                background: rgba(10, 10, 12, 0.9);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }
            html:not(.dark) .glass-nav {
                background: rgba(255, 255, 255, 0.96);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            }
            .glass-card {
                background: rgba(18, 18, 22, 0.85);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.08);
            }
            html:not(.dark) .glass-card {
                background: #ffffff;
                border: 1px solid rgba(0, 0, 0, 0.1);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            }
            @keyframes logoFlicker {
                0%, 100% { opacity: 1; filter: drop-shadow(0 0 25px rgba(229,9,20,0.9)) brightness(1.2); }
                15% { opacity: 0.4; filter: drop-shadow(0 0 5px rgba(229,9,20,0.2)) brightness(0.8); }
                20% { opacity: 1; filter: drop-shadow(0 0 35px rgba(229,9,20,1)) brightness(1.4); }
                45% { opacity: 0.6; filter: drop-shadow(0 0 10px rgba(229,9,20,0.4)) brightness(0.9); }
                50% { opacity: 1; filter: drop-shadow(0 0 30px rgba(229,9,20,0.85)) brightness(1.3); }
                80% { opacity: 0.8; filter: drop-shadow(0 0 18px rgba(229,9,20,0.6)) brightness(1.1); }
            }
            .logo-flicker {
                animation: logoFlicker 2.2s infinite ease-in-out;
            }
            .pixel-tile {
                transform: scale(0);
                opacity: 0;
                transition: transform 0.28s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.28s ease;
            }
            .pixel-tile.active {
                transform: scale(1.06);
                opacity: 1;
            }
            .car-inspect-img {
                transition: opacity 0.25s ease, transform 0.4s ease;
            }
        </style>
    @endif
</head>
<body class="bg-neutral-50 dark:bg-[#0a0a0c] text-neutral-900 dark:text-neutral-100 font-sans antialiased selection:bg-red-600 selection:text-white min-h-screen flex flex-col transition-colors duration-300">

    <!-- ==========================================
         0. CINEMATIC BLACK INTRO SCREEN WITH LOGO FLICKER
         ========================================== -->
    <div id="intro-screen" class="fixed inset-0 z-[9999] bg-black flex flex-col items-center justify-center transition-all duration-1000">
        <div class="relative flex flex-col items-center">
            <!-- Pulsing/Flickering Custom Logo -->
            <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive Logo" class="w-36 sm:w-48 h-auto object-contain logo-flicker mb-6">
            
            <div class="flex items-center space-x-3 mt-4">
                <span class="red-divider-line w-8"></span>
                <span class="font-serif tracking-[0.4em] text-xs text-neutral-300 uppercase font-bold">APEX AUTOMOTIVE</span>
                <span class="red-divider-line w-8"></span>
            </div>
            
            <p class="text-[10px] font-mono text-neutral-500 tracking-[0.3em] uppercase mt-2">
                JAKARTA LUXURY SHOWROOM
            </p>
        </div>
    </div>


    <!-- ==========================================
         PIXEL WAVE TRANSITION OVERLAY CONTAINER
         ========================================== -->
    <div id="pixel-transition-overlay" class="fixed inset-0 z-[9998] pointer-events-none hidden grid grid-cols-12 grid-rows-8 w-full h-full">
        <!-- Dynamic pixel tiles injected by JS -->
    </div>


    <!-- TOP ANNOUNCEMENT MARQUEE BAR -->
    <div class="bg-neutral-900 dark:bg-neutral-950 text-neutral-300 dark:text-neutral-300 text-xs py-2.5 border-b border-neutral-800 dark:border-white/5 font-mono overflow-hidden relative cursor-default select-none z-40">
        <div class="flex animate-marquee items-center space-x-12">
            
            <!-- MARQUEE TRACK BLOCK 1 -->
            <div class="flex items-center space-x-8 shrink-0">
                <span class="flex items-center space-x-2 text-neutral-300">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="font-bold text-neutral-200">JAKARTA SHOWROOM:</span>
                    <span class="text-neutral-400">OPEN TODAY UNTIL 20:00 WIB</span>
                </span>
                <span class="text-red-500 font-bold">///</span>
                <span class="font-sans font-semibold text-neutral-100 tracking-wider">
                    ⚡ PRIVATE PREVIEW: THE ALL-NEW 2026 HYPERCAR LINEUP HAS ARRIVED
                </span>
                <span class="text-red-500 font-bold">///</span>
                <a href="tel:+62215559988" class="hover:text-red-500 transition-colors flex items-center">
                    <i class="fa-solid fa-phone text-red-500 mr-2"></i> +62 21 555 9988
                </a>
                <span class="text-white/20">|</span>
                <span class="cursor-pointer hover:text-white text-red-400 font-bold transition-colors underline underline-offset-4" onclick="toggleModal('inquireModal')">
                    REQUEST VIP CATALOG
                </span>
                <span class="text-red-500 font-bold">///</span>
            </div>

            <!-- MARQUEE TRACK BLOCK 2 (DUPLICATE FOR SEAMLESS INFINITE LOOP) -->
            <div class="flex items-center space-x-8 shrink-0">
                <span class="flex items-center space-x-2 text-neutral-300">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="font-bold text-neutral-200">JAKARTA SHOWROOM:</span>
                    <span class="text-neutral-400">OPEN TODAY UNTIL 20:00 WIB</span>
                </span>
                <span class="text-red-500 font-bold">///</span>
                <span class="font-sans font-semibold text-neutral-100 tracking-wider">
                    ⚡ PRIVATE PREVIEW: THE ALL-NEW 2026 HYPERCAR LINEUP HAS ARRIVED
                </span>
                <span class="text-red-500 font-bold">///</span>
                <a href="tel:+62215559988" class="hover:text-red-500 transition-colors flex items-center">
                    <i class="fa-solid fa-phone text-red-500 mr-2"></i> +62 21 555 9988
                </a>
                <span class="text-white/20">|</span>
                <span class="cursor-pointer hover:text-white text-red-400 font-bold transition-colors underline underline-offset-4" onclick="toggleModal('inquireModal')">
                    REQUEST VIP CATALOG
                </span>
                <span class="text-red-500 font-bold">///</span>
            </div>

        </div>
    </div>

    <!-- MAIN NAVIGATION HEADER -->
    <header class="sticky top-0 z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- BRAND LOGO (Using logo.png) -->
            <a href="/" class="flex items-center space-x-3 group">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive Logo" class="h-10 sm:h-12 w-auto object-contain group-hover:scale-105 transition-transform">
                <div class="flex flex-col">
                    <span class="font-serif tracking-widest text-xl font-black text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors uppercase">APEX</span>
                    <span class="text-[9px] font-mono tracking-[0.3em] text-neutral-500 dark:text-neutral-400 -mt-1 uppercase">Automotive</span>
                </div>
            </a>

            <!-- NAVIGATION LINKS -->
            <nav class="hidden lg:flex items-center space-x-8 text-xs font-bold tracking-widest text-neutral-900 dark:text-neutral-300">
                <a href="#hero-carousel" class="hover:text-red-600 dark:hover:text-red-500 transition-colors py-2 border-b-2 border-transparent hover:border-red-600">SHOWROOM</a>
                <a href="#certified-suggestions" class="hover:text-red-600 dark:hover:text-red-500 transition-colors py-2 border-b-2 border-transparent hover:border-red-600">PRE-OWNED</a>
                <a href="#spotlight" class="hover:text-red-600 dark:hover:text-red-500 transition-colors py-2 border-b-2 border-transparent hover:border-red-600">EXOTIC MODELS</a>
                <a href="#services" class="hover:text-red-600 dark:hover:text-red-500 transition-colors py-2 border-b-2 border-transparent hover:border-red-600">AFTER SALES</a>
                <a href="#dealer-location" class="hover:text-red-600 dark:hover:text-red-500 transition-colors py-2 border-b-2 border-transparent hover:border-red-600">DEALER LOCATOR</a>
            </nav>

            <!-- RIGHT ACTIONS (THEME TOGGLE + AUTH BUTTON) -->
            <div class="flex items-center space-x-4">

                <!-- PREMIUM CAPSULE THEME TOGGLE SWITCH -->
                <button onclick="triggerPixelWaveTransition()" id="themeToggleBtn" title="Toggle Light / Dark Mode" class="relative flex items-center justify-between w-16 h-8 rounded-full p-1 border border-neutral-300 dark:border-white/20 bg-neutral-200/90 dark:bg-neutral-900/90 shadow-inner cursor-pointer transition-all duration-300 group hover:border-red-500">
                    <span class="w-6 h-6 flex items-center justify-center text-amber-500 text-xs z-0"><i class="fa-solid fa-sun"></i></span>
                    <span class="w-6 h-6 flex items-center justify-center text-indigo-400 text-xs z-0"><i class="fa-solid fa-moon"></i></span>
                    <div id="toggleThumb" class="absolute top-1 left-1 w-6 h-6 rounded-full bg-gradient-to-br from-red-600 to-red-800 text-white shadow-md flex items-center justify-center transition-all duration-300 z-10 group-hover:scale-105">
                        <i class="fa-solid fa-bolt text-[9px]"></i>
                    </div>
                </button>

                @auth
                    {{-- AUTHENTICATED: Show user name + dropdown --}}
                    <div class="relative group hidden sm:block" id="userDropdownWrapper">
                        <button class="flex items-center space-x-2 px-3 py-2 border border-neutral-300 dark:border-white/15 bg-neutral-100 dark:bg-white/5 hover:border-red-600 transition-all duration-200 text-xs font-mono font-semibold text-neutral-800 dark:text-neutral-200">
                            <span class="inline-flex w-6 h-6 items-center justify-center rounded-full bg-red-600 text-white text-[10px] font-extrabold uppercase">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </span>
                            <span class="hidden md:inline max-w-[120px] truncate uppercase tracking-wider">{{ auth()->user()->name }}</span>
                            <i class="fa-solid fa-chevron-down text-[9px] text-neutral-500 group-hover:text-red-600 transition-colors"></i>
                        </button>
                        {{-- Dropdown --}}
                        <div class="absolute right-0 top-full mt-1 w-52 bg-neutral-900 dark:bg-neutral-950 border border-white/10 shadow-2xl z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-y-1 group-hover:translate-y-0">
                            <div class="p-3 border-b border-white/10">
                                <p class="text-[10px] font-mono text-neutral-500 uppercase tracking-widest">VIP Buyer</p>
                                <p class="text-xs font-semibold text-white truncate mt-0.5">{{ auth()->user()->email }}</p>
                                @if (! auth()->user()->hasCompletedProfile())
                                    <a href="{{ route('profile.complete') }}" class="inline-flex items-center mt-2 text-[10px] font-mono text-amber-400 hover:text-amber-300 font-bold tracking-wider">
                                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> LENGKAPI PROFIL
                                    </a>
                                @endif
                            </div>
                            <div class="py-1">
                                @if (auth()->user()->hasCompletedProfile())
                                    <a href="{{ route('profile.complete') }}" class="flex items-center space-x-2.5 px-4 py-2.5 text-[11px] font-mono text-neutral-300 hover:text-white hover:bg-white/5 transition-colors">
                                        <i class="fa-solid fa-user-pen text-red-500 w-4"></i>
                                        <span>Edit Profil</span>
                                    </a>
                                @endif
                                <button onclick="toggleModal('inquireModal')" class="flex w-full items-center space-x-2.5 px-4 py-2.5 text-[11px] font-mono text-neutral-300 hover:text-white hover:bg-white/5 transition-colors">
                                    <i class="fa-solid fa-calendar-check text-red-500 w-4"></i>
                                    <span>Book Private Viewing</span>
                                </button>
                                <div class="border-t border-white/5 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center space-x-2.5 px-4 py-2.5 text-[11px] font-mono text-red-400 hover:text-red-300 hover:bg-red-500/5 transition-colors">
                                        <i class="fa-solid fa-arrow-right-from-bracket w-4"></i>
                                        <span>KELUAR</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- GUEST: Show login button --}}
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center justify-center px-5 py-2.5 text-xs tracking-widest font-bold uppercase border border-red-600 text-red-600 dark:text-red-500 hover:bg-red-600 hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> MASUK / DAFTAR
                    </a>
                    <button onclick="toggleModal('inquireModal')" class="hidden lg:inline-flex items-center justify-center px-5 py-2.5 text-xs tracking-widest font-semibold uppercase bg-red-600 hover:bg-red-700 text-white rounded-none shadow-lg shadow-red-600/25 hover:shadow-red-600/50 transition-all duration-300 transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-calendar-check mr-2"></i> BOOK VIEWING
                    </button>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-grow">
        <!-- ==========================================
             HERO CAROUSEL SECTION (5 DYNAMIC SLIDES ACCURATELY NAMED)
             ========================================== -->
        <section id="hero-carousel" class="relative w-full h-[85vh] min-h-[550px] max-h-[900px] overflow-hidden bg-black">
            
            <!-- SLIDE 1: BMW MOTORSPORT -->
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100 z-10" data-index="0">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0c] via-black/40 to-black/60 z-10"></div>
                <img src="{{ asset('images/carousell/carousell1.png') }}" alt="BMW Motorsport" class="w-full h-full object-cover object-center transform scale-105 transition-transform duration-[8000ms] ease-out hero-img">
                <div class="absolute inset-0 z-20 flex flex-col justify-end max-w-7xl mx-auto px-6 lg:px-8 pb-16 lg:pb-24">
                    <div class="space-y-4 max-w-3xl reveal-on-scroll is-visible">
                        <div class="flex items-center space-x-3">
                            <span class="red-divider-line"></span>
                            <span class="text-xs font-mono tracking-[0.3em] uppercase text-red-500 font-bold">M PERFORMANCE HERITAGE</span>
                        </div>
                        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black font-serif tracking-tight text-white uppercase leading-none drop-shadow-2xl">
                            BMW MOTORSPORT
                        </h1>
                        <p class="text-base sm:text-lg text-neutral-300 font-light max-w-xl">
                            Engineered for victory. Precision German dynamics combined with track-proven twin-turbo power.
                        </p>
                        <div class="pt-4 flex flex-wrap gap-4 items-center">
                            <button onclick="openCarInspector('bmw_m4')" class="px-8 py-3.5 bg-red-600 hover:bg-red-700 text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 flex items-center shadow-lg shadow-red-600/30">
                                EXPLORE MODEL <i class="fa-solid fa-arrow-right ml-3"></i>
                            </button>
                            <button onclick="toggleModal('inquireModal')" class="px-8 py-3.5 border border-white/30 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 backdrop-blur-sm">
                                REQUEST QUOTE
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 2: LAMBORGHINI AVENTADOR SVJ -->
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0" data-index="1">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0c] via-black/40 to-black/60 z-10"></div>
                <img src="{{ asset('images/carousell/carousell2.png') }}" alt="Lamborghini Aventador SVJ" class="w-full h-full object-cover object-center transform scale-100 transition-transform duration-[8000ms] ease-out hero-img">
                <div class="absolute inset-0 z-20 flex flex-col justify-end max-w-7xl mx-auto px-6 lg:px-8 pb-16 lg:pb-24">
                    <div class="space-y-4 max-w-3xl">
                        <div class="flex items-center space-x-3">
                            <span class="red-divider-line"></span>
                            <span class="text-xs font-mono tracking-[0.3em] uppercase text-red-500 font-bold">SUPERVELOCE JOTA EDITION</span>
                        </div>
                        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black font-serif tracking-tight text-white uppercase leading-none drop-shadow-2xl">
                            LAMBORGHINI REVUELTO V12
                        </h1>
                        <p class="text-base sm:text-lg text-neutral-300 font-light max-w-xl">
                            1,015 HP naturally aspirated V12 hybrid monster with active aerodynamics ALA 2.0.
                        </p>
                        <div class="pt-4 flex flex-wrap gap-4 items-center">
                            <button onclick="openCarInspector('lamborghini_revuelto')" class="px-8 py-3.5 bg-red-600 hover:bg-red-700 text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 flex items-center shadow-lg shadow-red-600/30">
                                EXPLORE MODEL <i class="fa-solid fa-arrow-right ml-3"></i>
                            </button>
                            <button onclick="toggleModal('inquireModal')" class="px-8 py-3.5 border border-white/30 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 backdrop-blur-sm">
                                REQUEST QUOTE
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 3: MCLAREN SENNA -->
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0" data-index="2">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0c] via-black/40 to-black/60 z-10"></div>
                <img src="{{ asset('images/carousell/carousell3.png') }}" alt="McLaren Senna" class="w-full h-full object-cover object-center transform scale-100 transition-transform duration-[8000ms] ease-out hero-img">
                <div class="absolute inset-0 z-20 flex flex-col justify-end max-w-7xl mx-auto px-6 lg:px-8 pb-16 lg:pb-24">
                    <div class="space-y-4 max-w-3xl">
                        <div class="flex items-center space-x-3">
                            <span class="red-divider-line"></span>
                            <span class="text-xs font-mono tracking-[0.3em] uppercase text-red-500 font-bold">THE ULTIMATE HYPERCAR</span>
                        </div>
                        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black font-serif tracking-tight text-white uppercase leading-none drop-shadow-2xl">
                            MCLAREN SENNA GTR
                        </h1>
                        <p class="text-base sm:text-lg text-neutral-300 font-light max-w-xl">
                            Unforgiving track focus. 800KG downforce, carbon monocage III, and pure racing DNA.
                        </p>
                        <div class="pt-4 flex flex-wrap gap-4 items-center">
                            <button onclick="openCarInspector('mclaren_senna')" class="px-8 py-3.5 bg-red-600 hover:bg-red-700 text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 flex items-center shadow-lg shadow-red-600/30">
                                EXPLORE MODEL <i class="fa-solid fa-arrow-right ml-3"></i>
                            </button>
                            <button onclick="toggleModal('inquireModal')" class="px-8 py-3.5 border border-white/30 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 backdrop-blur-sm">
                                REQUEST QUOTE
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 4: FERRARI SF90 XX STRADALE (F90XX) -->
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0" data-index="3">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0c] via-black/40 to-black/60 z-10"></div>
                <img src="{{ asset('images/carousell/carousell4.png') }}" alt="Ferrari SF90 XX Stradale" class="w-full h-full object-cover object-center transform scale-100 transition-transform duration-[8000ms] ease-out hero-img">
                <div class="absolute inset-0 z-20 flex flex-col justify-end max-w-7xl mx-auto px-6 lg:px-8 pb-16 lg:pb-24">
                    <div class="space-y-4 max-w-3xl">
                        <div class="flex items-center space-x-3">
                            <span class="red-divider-line"></span>
                            <span class="text-xs font-mono tracking-[0.3em] uppercase text-red-500 font-bold">XX PROGRAMME TRACK HYBRID</span>
                        </div>
                        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black font-serif tracking-tight text-white uppercase leading-none drop-shadow-2xl">
                            FERRARI SF90 XX STRADALE
                        </h1>
                        <p class="text-base sm:text-lg text-neutral-300 font-light max-w-xl">
                            1,030 HP twin-turbo V12/V8 hybrid hypercar with fixed rear wing and racing telemetry.
                        </p>
                        <div class="pt-4 flex flex-wrap gap-4 items-center">
                            <button onclick="openCarDetails('Ferrari SF90 XX')" class="px-8 py-3.5 bg-red-600 hover:bg-red-700 text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 flex items-center shadow-lg shadow-red-600/30">
                                EXPLORE MODEL <i class="fa-solid fa-arrow-right ml-3"></i>
                            </button>
                            <button onclick="toggleModal('inquireModal')" class="px-8 py-3.5 border border-white/30 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 backdrop-blur-sm">
                                REQUEST QUOTE
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 5: JEEP GLADIATOR RUBICON -->
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0" data-index="4">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0c] via-black/40 to-black/60 z-10"></div>
                <img src="{{ asset('images/carousell/carousell5.png') }}" alt="Jeep Gladiator Rubicon" class="w-full h-full object-cover object-center transform scale-100 transition-transform duration-[8000ms] ease-out hero-img">
                <div class="absolute inset-0 z-20 flex flex-col justify-end max-w-7xl mx-auto px-6 lg:px-8 pb-16 lg:pb-24">
                    <div class="space-y-4 max-w-3xl">
                        <div class="flex items-center space-x-3">
                            <span class="red-divider-line"></span>
                            <span class="text-xs font-mono tracking-[0.3em] uppercase text-red-500 font-bold">EXTREME OFF-ROAD RUBICON</span>
                        </div>
                        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black font-serif tracking-tight text-white uppercase leading-none drop-shadow-2xl">
                            JEEP GLADIATOR RUBICON
                        </h1>
                        <p class="text-base sm:text-lg text-neutral-300 font-light max-w-xl">
                            3.6L Pentastar V6 with Tru-Lok lockers, Fox performance shocks, and heavy-duty steel bumpers.
                        </p>
                        <div class="pt-4 flex flex-wrap gap-4 items-center">
                            <button onclick="openCarDetails('Jeep Gladiator Rubicon')" class="px-8 py-3.5 bg-red-600 hover:bg-red-700 text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 flex items-center shadow-lg shadow-red-600/30">
                                EXPLORE MODEL <i class="fa-solid fa-arrow-right ml-3"></i>
                            </button>
                            <button onclick="toggleModal('inquireModal')" class="px-8 py-3.5 border border-white/30 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 backdrop-blur-sm">
                                REQUEST QUOTE
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTROLS & PAGINATION -->
            <div class="absolute bottom-6 left-0 right-0 z-30 max-w-7xl mx-auto px-6 lg:px-8 flex items-center justify-between">
                <!-- INDICATOR DOTS & PROGRESS BAR -->
                <div class="flex items-center space-x-3">
                    <div class="flex space-x-2" id="carousel-dots">
                        <button onclick="setSlide(0)" class="w-10 h-1 bg-red-600 transition-all rounded-full dot-indicator" aria-label="Slide 1"></button>
                        <button onclick="setSlide(1)" class="w-4 h-1 bg-white/30 hover:bg-white transition-all rounded-full dot-indicator" aria-label="Slide 2"></button>
                        <button onclick="setSlide(2)" class="w-4 h-1 bg-white/30 hover:bg-white transition-all rounded-full dot-indicator" aria-label="Slide 3"></button>
                        <button onclick="setSlide(3)" class="w-4 h-1 bg-white/30 hover:bg-white transition-all rounded-full dot-indicator" aria-label="Slide 4"></button>
                        <button onclick="setSlide(4)" class="w-4 h-1 bg-white/30 hover:bg-white transition-all rounded-full dot-indicator" aria-label="Slide 5"></button>
                    </div>
                    <span class="text-xs font-mono text-neutral-400 pl-2" id="slide-counter">01 / 05</span>
                </div>

                <!-- PREV / NEXT BUTTONS -->
                <div class="flex items-center space-x-3">
                    <button onclick="prevSlide()" class="w-11 h-11 border border-white/20 hover:border-white bg-black/50 hover:bg-red-600 text-white flex items-center justify-center transition-all duration-300 rounded-full" aria-label="Previous Slide">
                        <i class="fa-solid fa-chevron-left text-sm"></i>
                    </button>
                    <button onclick="nextSlide()" class="w-11 h-11 border border-white/20 hover:border-white bg-black/50 hover:bg-red-600 text-white flex items-center justify-center transition-all duration-300 rounded-full" aria-label="Next Slide">
                        <i class="fa-solid fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>
        </section>


        <!-- ==========================================
             SECTION 1: CERTIFIED SUGGESTIONS (CLEAN SHOWCASE CATALOG)
             PURE WHITE BACKGROUND IN LIGHT MODE
             ========================================== -->
        <section id="certified-suggestions" class="py-20 bg-white dark:bg-[#0a0a0c] text-neutral-900 dark:text-neutral-100 border-b border-neutral-200 dark:border-white/5 relative transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- SECTION HEADER -->
                <div class="text-center space-y-3 mb-12 reveal-on-scroll">
                    <div class="flex items-center justify-center space-x-2">
                        <span class="red-divider-line"></span>
                        <span class="text-xs font-mono tracking-[0.3em] uppercase text-red-600 font-bold">PRE-OWNED & CERTIFIED</span>
                        <span class="red-divider-line"></span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-serif font-extrabold text-neutral-900 dark:text-white tracking-wider uppercase">
                        PT Apex Automotive Indonesia
                    </h2>
                    <h3 class="text-xl sm:text-3xl font-light text-neutral-700 dark:text-neutral-300">
                        Our Certified Suggestions
                    </h3>
                </div>

                <!-- FILTER CONTROLS BAR -->
                <div class="glass-card p-4 sm:p-6 mb-12 border border-neutral-300 dark:border-white/10 shadow-xl reveal-on-scroll">
                    <form id="filterForm" onsubmit="event.preventDefault(); applyFilters();" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                        
                        <!-- FILTER 1: MODEL BRAND -->
                        <div class="space-y-1.5">
                            <label class="block text-[11px] font-mono tracking-widest uppercase text-neutral-700 dark:text-neutral-400 font-semibold">MODEL / MAKE</label>
                            <select id="filterModel" class="w-full bg-neutral-100 dark:bg-neutral-900 text-neutral-900 dark:text-white text-xs border border-neutral-300 dark:border-white/15 px-3 py-2.5 focus:border-red-600 focus:outline-none rounded-none font-medium">
                                <option value="ALL">ALL BRANDS</option>
                                <option value="BMW">BMW MOTORSPORT</option>
                                <option value="Lamborghini">LAMBORGHINI</option>
                                <option value="McLaren">MCLAREN</option>
                                <option value="Porsche">PORSCHE</option>
                                <option value="Audi">AUDI</option>
                                <option value="Koenigsegg">KOENIGSEGG</option>
                                <option value="Bugatti">BUGATTI</option>
                                <option value="Chevrolet">CHEVROLET CORVETTE</option>
                                <option value="Pagani">PAGANI</option>
                                <option value="Zenvo">ZENVO</option>
                            </select>
                        </div>

                        <!-- FILTER 2: PRICE RANGE -->
                        <div class="space-y-1.5">
                            <label class="block text-[11px] font-mono tracking-widest uppercase text-neutral-700 dark:text-neutral-400 font-semibold">PRICE RANGE</label>
                            <select id="filterPrice" class="w-full bg-neutral-100 dark:bg-neutral-900 text-neutral-900 dark:text-white text-xs border border-neutral-300 dark:border-white/15 px-3 py-2.5 focus:border-red-600 focus:outline-none rounded-none font-medium">
                                <option value="ALL">ALL PRICES</option>
                                <option value="BELOW_10B">UNDER IDR 10,000,000,000</option>
                                <option value="10B_20B">IDR 10B - IDR 20B</option>
                                <option value="ABOVE_20B">IDR 20,000,000,000+</option>
                            </select>
                        </div>

                        <!-- FILTER 3: CONDITION -->
                        <div class="space-y-1.5">
                            <label class="block text-[11px] font-mono tracking-widest uppercase text-neutral-700 dark:text-neutral-400 font-semibold">CONDITION / YEAR</label>
                            <select id="filterCondition" class="w-full bg-neutral-100 dark:bg-neutral-900 text-neutral-900 dark:text-white text-xs border border-neutral-300 dark:border-white/15 px-3 py-2.5 focus:border-red-600 focus:outline-none rounded-none font-medium">
                                <option value="ALL">ALL CONDITIONS</option>
                                <option value="CERTIFIED">APEX CERTIFIED</option>
                                <option value="PRE-OWNED">PRE-OWNED</option>
                                <option value="NEW">BRAND NEW</option>
                            </select>
                        </div>

                        <!-- SEARCH BUTTON -->
                        <div>
                            <button type="submit" class="w-full bg-neutral-900 hover:bg-red-600 dark:bg-neutral-800 text-white text-xs tracking-widest font-bold uppercase py-2.5 px-6 transition-all duration-300 border border-neutral-700 dark:border-white/20 hover:border-red-600 flex items-center justify-center">
                                <i class="fa-solid fa-magnifying-glass mr-2"></i> SEARCH CARS
                            </button>
                        </div>
                    </form>
                </div>

                <!-- CAR CATALOG GRID (CLEAN LUXURY GRID - CLICK ANY CAR TO INSPECT & TOGGLE COLORS/BODYKITS) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="carCatalog">
                    
                    <!-- CAR CARD 1: BMW M4 COMPETITION -->
                    <div class="car-card glass-card group cursor-pointer overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="BMW" data-price="7650" data-condition="NEW" onclick="openCarInspector('bmw_m4')">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/bmwm4competition_sao_paulo_yellow.png') }}" alt="BMW M4 Competition" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md flex items-center space-x-1">
                                <span>BRAND NEW</span>
                                <span class="bg-black/40 px-1 py-0.2 rounded text-amber-300 text-[9px] font-extrabold">-10% OFF</span>
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2025
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white text-xs font-mono font-bold tracking-widest flex items-center">
                                    <i class="fa-solid fa-eye text-red-500 mr-2"></i> INSPECT COLORS & BODYKITS
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2025 • BMW MOTORSPORT</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    M4 COMPETITION COUPE
                                </h4>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3 space-y-0.5">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-mono text-neutral-500">WAS: <span class="line-through font-semibold text-neutral-400">IDR 8,500,000,000</span></span>
                                    <span class="text-[9px] font-mono font-extrabold text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 px-1.5 py-0.5 rounded border border-emerald-500/20">SAVE 10%</span>
                                </div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500 flex items-center">
                                    <span class="mr-1">IDR</span>
                                    <span class="price-count-down tracking-tight" data-from="8500000000" data-to="7650000000">8,500,000,000</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-gauge-high mr-1 text-red-600"></i> 510 HP</div>
                                <div><i class="fa-solid fa-bolt mr-1 text-red-600"></i> 0-100: 3.5S</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="event.stopPropagation(); openCarInspector('bmw_m4');" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE & INSPECT
                                </button>
                                <button onclick="event.stopPropagation(); toggleModal('inquireModal');" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 2: LAMBORGHINI REVUELTO -->
                    <div class="car-card glass-card group cursor-pointer overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Lamborghini" data-price="20460" data-condition="NEW" onclick="openCarInspector('lamborghini_revuelto')">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/lamborghini_revuelto_arancio_apodis.png') }}" alt="Lamborghini Revuelto" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-neutral-900/90 text-emerald-400 border border-emerald-500/40 text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest flex items-center space-x-1">
                                <span>BRAND NEW</span>
                                <span class="bg-emerald-500/20 text-emerald-300 px-1 py-0.2 rounded text-[9px] font-extrabold">-7% PROMO</span>
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2025
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white text-xs font-mono font-bold tracking-widest flex items-center">
                                    <i class="fa-solid fa-eye text-red-500 mr-2"></i> INSPECT COLORS & BODYKITS
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2025 • LAMBORGHINI</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    REVUELTO V12 HYBRID
                                </h4>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3 space-y-0.5">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-mono text-neutral-500">WAS: <span class="line-through font-semibold text-neutral-400">IDR 22,000,000,000</span></span>
                                    <span class="text-[9px] font-mono font-extrabold text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 px-1.5 py-0.5 rounded border border-emerald-500/20">SAVE 7%</span>
                                </div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500 flex items-center">
                                    <span class="mr-1">IDR</span>
                                    <span class="price-count-down tracking-tight" data-from="22000000000" data-to="20460000000">22,000,000,000</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-fire mr-1 text-red-600"></i> 1,015 HP V12</div>
                                <div><i class="fa-solid fa-bolt mr-1 text-red-600"></i> 0-100: 2.5S</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="event.stopPropagation(); openCarInspector('lamborghini_revuelto');" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE & INSPECT
                                </button>
                                <button onclick="event.stopPropagation(); toggleModal('inquireModal');" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 3: MCLAREN SENNA GTR -->
                    <div class="car-card glass-card group cursor-pointer overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="McLaren" data-price="28000" data-condition="CERTIFIED" onclick="openCarInspector('mclaren_senna')">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/mclaren_senna_gtr_volcano_yellow.png') }}" alt="McLaren Senna GTR" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                CERTIFIED
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2024
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white text-xs font-mono font-bold tracking-widest flex items-center">
                                    <i class="fa-solid fa-eye text-red-500 mr-2"></i> INSPECT COLORS & BODYKITS
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2024 • MCLAREN</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    SENNA GTR EDITION
                                </h4>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3">
                                <div class="text-[10px] font-mono text-neutral-600 dark:text-neutral-400">STARTING FROM</div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500">IDR 28,000,000,000</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-bolt mr-1 text-red-600"></i> 825 HP V8</div>
                                <div><i class="fa-solid fa-wind mr-1 text-red-600"></i> 800KG DOWNFORCE</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="event.stopPropagation(); openCarInspector('mclaren_senna');" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE & INSPECT
                                </button>
                                <button onclick="event.stopPropagation(); toggleModal('inquireModal');" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 4: PORSCHE 911 GT3 RS -->
                    <div class="car-card glass-card group cursor-pointer overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Porsche" data-price="11500" data-condition="CERTIFIED" onclick="openCarInspector('porsche_911')">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/porsche_rubystone_red.png') }}" alt="Porsche 911 GT3 RS" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                CERTIFIED
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2024
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white text-xs font-mono font-bold tracking-widest flex items-center">
                                    <i class="fa-solid fa-eye text-red-500 mr-2"></i> INSPECT COLORS & BODYKITS
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2024 • PORSCHE</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    911 GT3 RS (992)
                                </h4>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3">
                                <div class="text-[10px] font-mono text-neutral-600 dark:text-neutral-400">STARTING FROM</div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500">IDR 11,500,000,000</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-gauge-high mr-1 text-red-600"></i> 525 HP FLAT-6</div>
                                <div><i class="fa-solid fa-gears mr-1 text-red-600"></i> 9,000 RPM</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="event.stopPropagation(); openCarInspector('porsche_911');" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE & INSPECT
                                </button>
                                <button onclick="event.stopPropagation(); toggleModal('inquireModal');" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 5: AUDI R8 V10 PERFORMANCE -->
                    <div class="car-card glass-card group cursor-pointer overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Audi" data-price="7800" data-condition="PRE-OWNED" onclick="openCarInspector('audi_r8')">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/audi_r8_tango_red_metallic.png') }}" alt="Audi R8 V10 Performance" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                PRE-OWNED
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2024
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white text-xs font-mono font-bold tracking-widest flex items-center">
                                    <i class="fa-solid fa-eye text-red-500 mr-2"></i> INSPECT COLORS & BODYKITS
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2024 • AUDI</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    R8 V10 PERFORMANCE
                                </h4>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3">
                                <div class="text-[10px] font-mono text-neutral-600 dark:text-neutral-400">STARTING FROM</div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500">IDR 7,800,000,000</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-gauge-high mr-1 text-red-600"></i> 620 HP V10</div>
                                <div><i class="fa-solid fa-road mr-1 text-red-600"></i> QUATTRO AWD</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="event.stopPropagation(); openCarInspector('audi_r8');" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE & INSPECT
                                </button>
                                <button onclick="event.stopPropagation(); toggleModal('inquireModal');" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 6: KOENIGSEGG JESKO ABSOLUT -->
                    <div class="car-card glass-card group cursor-pointer overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Koenigsegg" data-price="45000" data-condition="NEW" onclick="openCarInspector('koenigsegg_jesko')">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/koeningseg_jesko_absolut_crystal_white.png') }}" alt="Koenigsegg Jesko Absolut" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-purple-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                HYPERCAR SPECIAL
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2025
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white text-xs font-mono font-bold tracking-widest flex items-center">
                                    <i class="fa-solid fa-eye text-red-500 mr-2"></i> INSPECT COLORS & BODYKITS
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2025 • KOENIGSEGG</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    JESKO ABSOLUT
                                </h4>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3">
                                <div class="text-[10px] font-mono text-neutral-600 dark:text-neutral-400">STARTING FROM</div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500">IDR 45,000,000,000</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-fire mr-1 text-red-600"></i> 1,600 HP V8</div>
                                <div><i class="fa-solid fa-gauge-high mr-1 text-red-600"></i> 530+ KM/H</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="event.stopPropagation(); openCarInspector('koenigsegg_jesko');" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE & INSPECT
                                </button>
                                <button onclick="event.stopPropagation(); toggleModal('inquireModal');" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 7: BUGATTI CHIRON PUR SPORT (NEW CAR) -->
                    <div class="car-card glass-card group cursor-pointer overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Bugatti" data-price="52000" data-condition="NEW" onclick="openCarInspector('bugatti_chiron')">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/buggati_chiron_le_mans_blue.png') }}" alt="Bugatti Chiron" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-purple-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                ULTIMATE HYPERCAR
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2025
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white text-xs font-mono font-bold tracking-widest flex items-center">
                                    <i class="fa-solid fa-eye text-red-500 mr-2"></i> INSPECT COLORS & BODYKITS
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2025 • BUGATTI</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    CHIRON PUR SPORT W16
                                </h4>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3">
                                <div class="text-[10px] font-mono text-neutral-600 dark:text-neutral-400">STARTING FROM</div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500">IDR 52,000,000,000</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-fire mr-1 text-red-600"></i> 1,500 HP W16</div>
                                <div><i class="fa-solid fa-bolt mr-1 text-red-600"></i> 0-100: 2.4S</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="event.stopPropagation(); openCarInspector('bugatti_chiron');" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE & INSPECT
                                </button>
                                <button onclick="event.stopPropagation(); toggleModal('inquireModal');" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 8: CHEVROLET CORVETTE C8 Z06 (NEW CAR) -->
                    <div class="car-card glass-card group cursor-pointer overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Chevrolet" data-price="6800" data-condition="NEW" onclick="openCarInspector('chevrolet_corvette')">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/chevrolet_corvette_c8_torch_red.png') }}" alt="Chevrolet Corvette C8" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                BRAND NEW
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2025
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white text-xs font-mono font-bold tracking-widest flex items-center">
                                    <i class="fa-solid fa-eye text-red-500 mr-2"></i> INSPECT COLORS & BODYKITS
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2025 • CHEVROLET</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    CORVETTE C8 Z06 GT3
                                </h4>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3">
                                <div class="text-[10px] font-mono text-neutral-600 dark:text-neutral-400">STARTING FROM</div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500">IDR 6,800,000,000</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-gauge-high mr-1 text-red-600"></i> 670 HP V8</div>
                                <div><i class="fa-solid fa-gears mr-1 text-red-600"></i> 8,600 RPM</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="event.stopPropagation(); openCarInspector('chevrolet_corvette');" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE & INSPECT
                                </button>
                                <button onclick="event.stopPropagation(); toggleModal('inquireModal');" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 9: PAGANI HUAYRA BC (NEW CAR) -->
                    <div class="car-card glass-card group cursor-pointer overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Pagani" data-price="48000" data-condition="CERTIFIED" onclick="openCarInspector('pagani_huayra')">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/pagani_huayra_bc.png') }}" alt="Pagani Huayra BC" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                CERTIFIED
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2025
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white text-xs font-mono font-bold tracking-widest flex items-center">
                                    <i class="fa-solid fa-eye text-red-500 mr-2"></i> INSPECT COLORS & BODYKITS
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2025 • PAGANI</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    HUAYRA BC BENNY CAIOLA
                                </h4>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3">
                                <div class="text-[10px] font-mono text-neutral-600 dark:text-neutral-400">STARTING FROM</div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500">IDR 48,000,000,000</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-fire mr-1 text-red-600"></i> 800 HP AMG V12</div>
                                <div><i class="fa-solid fa-gem mr-1 text-red-600"></i> CARBO-TRIAX</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="event.stopPropagation(); openCarInspector('pagani_huayra');" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE & INSPECT
                                </button>
                                <button onclick="event.stopPropagation(); toggleModal('inquireModal');" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 10: ZENVO TSR-S (NEW CAR) -->
                    <div class="car-card glass-card group cursor-pointer overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Zenvo" data-price="38000" data-condition="NEW" onclick="openCarInspector('zenvo_tsr')">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/zenvo_tsr_s_viola_parsifae.png') }}" alt="Zenvo TSR-S" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-purple-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                HYPERCAR SPECIAL
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2025
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white text-xs font-mono font-bold tracking-widest flex items-center">
                                    <i class="fa-solid fa-eye text-red-500 mr-2"></i> INSPECT COLORS & BODYKITS
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2025 • ZENVO</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    TSR-S CENTRIPETAL WING
                                </h4>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3">
                                <div class="text-[10px] font-mono text-neutral-600 dark:text-neutral-400">STARTING FROM</div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500">IDR 38,000,000,000</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-bolt mr-1 text-red-600"></i> 1,177 HP V8</div>
                                <div><i class="fa-solid fa-wind mr-1 text-red-600"></i> ACTIVE AERO</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="event.stopPropagation(); openCarInspector('zenvo_tsr');" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE & INSPECT
                                </button>
                                <button onclick="event.stopPropagation(); toggleModal('inquireModal');" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- ==========================================
             SECTION 2: SPOTLIGHT EXOTIC MODELS ROW
             LUXURY DARK CONTRAST STRIP (MATCHES FERRARI REFERENCE)
             ========================================== -->
        <section id="spotlight" class="py-16 bg-neutral-950 dark:bg-neutral-950 text-white border-b border-white/5 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    
                    <!-- SPOTLIGHT ITEM 1 -->
                    <div class="group relative overflow-hidden bg-neutral-900 h-64 border border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll">
                        <img src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80" alt="Ferrari Roma Spider" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent p-6 flex flex-col justify-end">
                            <span class="text-[10px] font-mono text-red-500 tracking-widest uppercase font-bold">LIMITED EDITION</span>
                            <h3 class="text-xl font-bold font-serif text-white">Ferrari Roma Spider</h3>
                            <p class="text-xs text-neutral-300 font-light">La Nuova Dolce Vita in Jakarta</p>
                        </div>
                    </div>

                    <!-- SPOTLIGHT ITEM 2 -->
                    <div class="group relative overflow-hidden bg-neutral-900 h-64 border border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80" alt="Ferrari 296 GTS" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent p-6 flex flex-col justify-end">
                            <span class="text-[10px] font-mono text-red-500 tracking-widest uppercase font-bold">HYBRID INNOVATION</span>
                            <h3 class="text-xl font-bold font-serif text-white">Ferrari 296 GTS</h3>
                            <p class="text-xs text-neutral-300 font-light">Fun to drive redefined with V6 Turbo</p>
                        </div>
                    </div>

                    <!-- SPOTLIGHT ITEM 3 -->
                    <div class="group relative overflow-hidden bg-neutral-900 h-64 border border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll">
                        <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80" alt="Ferrari Portofino M" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent p-6 flex flex-col justify-end">
                            <span class="text-[10px] font-mono text-red-500 tracking-widest uppercase font-bold">EXCLUSIVITY</span>
                            <h3 class="text-xl font-bold font-serif text-white">Ferrari Portofino M</h3>
                            <p class="text-xs text-neutral-300 font-light">Evolution of grand touring open top</p>
                        </div>
                    </div>

                </div>

                <div class="text-right">
                    <button onclick="toggleModal('inquireModal')" class="inline-flex items-center text-xs font-mono tracking-widest text-neutral-300 hover:text-red-500 transition-colors uppercase font-bold">
                        VIEW ALL INVENTORY MODELS <i class="fa-solid fa-circle-arrow-right ml-2 text-red-500 text-sm"></i>
                    </button>
                </div>
            </div>
        </section>


        <!-- ==========================================
             SECTION 3: AFTER SALES SERVICES
             PURE WHITE BACKGROUND IN LIGHT MODE
             ========================================== -->
        <section id="services" class="py-24 bg-white dark:bg-[#0a0a0c] text-neutral-900 dark:text-neutral-100 border-b border-neutral-200 dark:border-white/5 relative transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- SECTION TITLE -->
                <div class="space-y-2 mb-14 reveal-on-scroll">
                    <div class="flex items-center space-x-2">
                        <span class="red-divider-line"></span>
                        <span class="text-xs font-mono tracking-[0.3em] uppercase text-red-600 font-bold">SERVICES & CARE</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-serif font-extrabold text-neutral-900 dark:text-white uppercase tracking-wide">
                        A Foretaste of Our After Sales Services
                    </h2>
                </div>

                <!-- SERVICE CARDS GRID -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <!-- SERVICE CARD 1 -->
                    <div class="glass-card group overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll">
                        <div class="h-64 overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=800&q=80" alt="Book a Service" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors"></div>
                        </div>
                        <div class="p-6 space-y-3 bg-white dark:bg-transparent">
                            <span class="text-[10px] font-mono text-red-600 font-bold uppercase tracking-widest">OFFICIAL SERVICE</span>
                            <h3 class="text-xl font-bold font-serif text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors uppercase">
                                BOOK A SERVICE
                            </h3>
                            <p class="text-xs text-neutral-600 dark:text-neutral-400 font-light leading-relaxed">
                                Experience master-certified supercar maintenance using state-of-the-art diagnostic telemetry and factory original components.
                            </p>
                            <div class="pt-2">
                                <a href="#dealer-location" class="inline-flex items-center text-xs font-mono text-neutral-900 dark:text-neutral-300 hover:text-red-600 font-semibold tracking-wider">
                                    <i class="fa-solid fa-chevron-right text-red-600 mr-2 text-[10px]"></i> SCHEDULE APPOINTMENT
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- SERVICE CARD 2 -->
                    <div class="glass-card group overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll">
                        <div class="h-64 overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=800&q=80" alt="Long Term Plan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors"></div>
                        </div>
                        <div class="p-6 space-y-3 bg-white dark:bg-transparent">
                            <span class="text-[10px] font-mono text-red-600 font-bold uppercase tracking-widest">WARRANTY & PROTECTION</span>
                            <h3 class="text-xl font-bold font-serif text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors uppercase">
                                A LONG TERM PLAN
                            </h3>
                            <p class="text-xs text-neutral-600 dark:text-neutral-400 font-light leading-relaxed">
                                Complete serenity for supercar ownership. Tailored extended warranties, 7-year genuine maintenance, and 24/7 roadside rescue.
                            </p>
                            <div class="pt-2">
                                <a href="#dealer-location" class="inline-flex items-center text-xs font-mono text-neutral-900 dark:text-neutral-300 hover:text-red-600 font-semibold tracking-wider">
                                    <i class="fa-solid fa-chevron-right text-red-600 mr-2 text-[10px]"></i> DISCOVER WARRANTY
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- SERVICE CARD 3 -->
                    <div class="glass-card group overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll">
                        <div class="h-64 overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=800&q=80" alt="Performance Tuning" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors"></div>
                        </div>
                        <div class="p-6 space-y-3 bg-white dark:bg-transparent">
                            <span class="text-[10px] font-mono text-red-600 font-bold uppercase tracking-widest">MOTORSPORT TUNING</span>
                            <h3 class="text-xl font-bold font-serif text-neutral-900 dark:text-white group-hover:text-red-600 transition-colors uppercase">
                                APEX PERFORMANCE & PARTS
                            </h3>
                            <p class="text-xs text-neutral-600 dark:text-neutral-400 font-light leading-relaxed">
                                Custom titanium exhaust systems, carbon aerodynamic upgrades, and track telemetry optimization straight from European racing engineers.
                            </p>
                            <div class="pt-2">
                                <a href="#dealer-location" class="inline-flex items-center text-xs font-mono text-neutral-900 dark:text-neutral-300 hover:text-red-600 font-semibold tracking-wider">
                                    <i class="fa-solid fa-chevron-right text-red-600 mr-2 text-[10px]"></i> INQUIRE ACCESSORIES
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- ==========================================
             SECTION 4: DEALER LOCATION & CONTACT
             LUXURY DARK CONTRAST SECTION (MATCHES FERRARI REFERENCE)
             ========================================== -->
        <section id="dealer-location" class="py-24 bg-neutral-950 dark:bg-neutral-950 text-white border-b border-white/5 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- SECTION HEADER -->
                <div class="text-center space-y-2 mb-16 reveal-on-scroll">
                    <div class="flex items-center justify-center space-x-2">
                        <span class="red-divider-line"></span>
                        <span class="text-xs font-mono tracking-[0.3em] uppercase text-red-500 font-bold">JAKARTA HEADQUARTERS</span>
                        <span class="red-divider-line"></span>
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-serif font-black text-white uppercase tracking-tight">
                        PT Apex Automotive Indonesia
                    </h2>
                    <p class="text-sm font-mono text-red-500 font-bold uppercase tracking-widest">
                        OFFICIAL LUXURY SHOWROOM & HYPERCAR DEALER IN JAKARTA
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    
                    <!-- LEFT COLUMN: ADDRESS & DETAILS -->
                    <div class="space-y-8 glass-card p-8 border border-white/10 reveal-on-scroll">
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold font-serif text-white tracking-wide flex items-center">
                                <i class="fa-solid fa-location-dot text-red-500 mr-3"></i> APEX AUTOMOTIVE JAKARTA
                            </h3>
                            <p class="text-xs text-neutral-300 font-mono leading-relaxed">
                                Jl. Sultan Iskandar Muda No. 88, Pondok Indah<br>
                                Jakarta Selatan 12240, Indonesia
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-white/10 text-xs font-mono">
                            <div>
                                <span class="text-neutral-400 block mb-1 font-semibold">OPERATING HOURS:</span>
                                <span class="text-white font-bold block">Mon - Sat: 08:30 - 20:00 WIB</span>
                                <span class="text-neutral-400 block">Sunday: By Private Appointment</span>
                            </div>
                            <div>
                                <span class="text-neutral-400 block mb-1 font-semibold">HOTLINE & WHATSAPP:</span>
                                <span class="text-red-500 font-bold block">+62 21 555 9988</span>
                                <span class="text-white font-bold block">+62 811 8888 999</span>
                            </div>
                        </div>

                        <div class="pt-4 flex flex-wrap gap-4">
                            <button onclick="toggleModal('inquireModal')" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 flex items-center">
                                <i class="fa-solid fa-calendar-check mr-2"></i> BOOK PRIVATE APPOINTMENT
                            </button>
                            <a href="https://maps.google.com" target="_blank" class="px-6 py-3 border border-white/20 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 inline-flex items-center">
                                <i class="fa-solid fa-map-location-dot mr-2"></i> GET DIRECTIONS
                            </a>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN: INTERACTIVE MAP PREVIEW CARD -->
                    <div class="relative h-[380px] rounded-none overflow-hidden border border-white/10 group reveal-on-scroll">
                        <img src="https://images.unsplash.com/photo-1562519819-016930ada31b?auto=format&fit=crop&w=1000&q=80" alt="Showroom Exterior" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent p-8 flex flex-col justify-between">
                            <div class="flex justify-between items-start">
                                <span class="bg-red-600 text-white text-[10px] font-mono font-bold px-3 py-1 uppercase tracking-widest shadow-lg">
                                    VIRTUAL TOUR READY
                                </span>
                                <div class="w-10 h-10 rounded-full bg-black/60 backdrop-blur-md flex items-center justify-center text-white border border-white/20">
                                    <i class="fa-solid fa-vr-cardboard text-lg text-red-500"></i>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <h4 class="text-2xl font-serif font-extrabold text-white">Experience Our 360° Showroom</h4>
                                <p class="text-xs font-mono text-neutral-300">Step inside Indonesia's premier luxury supercar lounge from anywhere.</p>
                                <button onclick="toggleModal('inquireModal')" class="mt-2 text-xs font-mono tracking-widest text-red-500 hover:text-white font-bold uppercase inline-flex items-center">
                                    LAUNCH VIRTUAL EXPERIENCE <i class="fa-solid fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>


    <!-- ==========================================
         FOOTER SECTION (MATCHES FERRARI REFERENCE)
         ========================================== -->
    <footer class="bg-black text-neutral-400 text-xs border-t border-white/10 pt-16 pb-12 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-16 border-b border-white/10">
                
                <!-- BRAND BRANDING -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive Logo" class="h-10 w-auto object-contain">
                        <span class="font-serif tracking-widest text-lg font-black text-white uppercase">APEX AUTOMOTIVE</span>
                    </div>
                    <p class="text-xs text-neutral-400 font-light max-w-sm leading-relaxed">
                        Official Jakarta luxury supercar showroom. Authorized partner for high-performance exotics, certified pre-owned supercars, and factory-trained racing maintenance.
                    </p>
                    <div class="flex space-x-4 pt-2 text-base text-neutral-400">
                        <a href="#" class="hover:text-red-500 transition-colors"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="hover:text-red-500 transition-colors"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="hover:text-red-500 transition-colors"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="hover:text-red-500 transition-colors"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>

                <!-- COL 1: NEW SHOWROOM -->
                <div class="space-y-3 font-mono">
                    <h4 class="text-white text-xs font-bold uppercase tracking-widest border-b border-white/10 pb-2">NEW SHOWROOM</h4>
                    <ul class="space-y-2 text-[11px] text-neutral-400">
                        <li><a href="#" class="hover:text-white transition-colors">BMW Motorsport Series</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Lamborghini Revuelto V12</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">McLaren Senna Hypercar</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Ferrari SF90 XX Stradale</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Jeep Gladiator Rubicon</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Porsche 911 GT3 RS</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Audi R8 V10 Performance</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Koenigsegg Jesko Absolut</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Bugatti Chiron Pur Sport</a></li>
                    </ul>
                </div>

                <!-- COL 2: PRE-OWNED -->
                <div class="space-y-3 font-mono">
                    <h4 class="text-white text-xs font-bold uppercase tracking-widest border-b border-white/10 pb-2">PRE-OWNED</h4>
                    <ul class="space-y-2 text-[11px] text-neutral-400">
                        <li><a href="#" class="hover:text-white transition-colors">Apex Certified Inventory</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">101-Point Inspection</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Consignment & Trade-In</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Valuation Assessment</a></li>
                    </ul>
                </div>

                <!-- COL 3: SERVICES & ABOUT -->
                <div class="space-y-3 font-mono">
                    <h4 class="text-white text-xs font-bold uppercase tracking-widest border-b border-white/10 pb-2">SERVICES & COMPANY</h4>
                    <ul class="space-y-2 text-[11px] text-neutral-400">
                        <li><a href="#" class="hover:text-white transition-colors">Book Maintenance</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Genuine Performance Parts</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Career Opportunities</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact Showroom</a></li>
                    </ul>
                </div>

            </div>

            <!-- COPYRIGHT & LEGAL -->
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between font-mono text-[11px] text-neutral-500">
                <div>
                    &copy; 2026 PT Apex Automotive Indonesia. All rights reserved.
                </div>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-neutral-300 transition-colors">PRIVACY POLICY</a>
                    <a href="#" class="hover:text-neutral-300 transition-colors">TERMS OF SERVICE</a>
                    <a href="#" class="hover:text-neutral-300 transition-colors">COOKIE SETTINGS</a>
                </div>
            </div>
        </div>
    </footer>


    <!-- ==========================================
         INTERACTIVE CAR INSPECTOR & COLOR/BODYKIT CONFIGURATOR MODAL
         ========================================== -->
    <div id="carInspectorModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/90 backdrop-blur-xl p-4 sm:p-6 transition-all duration-300">
        <div class="glass-card max-w-5xl w-full p-6 sm:p-8 border border-neutral-300 dark:border-white/20 shadow-2xl relative max-h-[92vh] overflow-y-auto">
            
            <!-- CLOSE BUTTON -->
            <button onclick="toggleModal('carInspectorModal')" class="absolute top-5 right-5 text-neutral-500 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white text-xl z-20">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- LEFT COLUMN: LARGE CAR PREVIEW CANVAS WITH ACTIVE COLOR BADGE -->
                <div class="lg:col-span-7 space-y-4">
                    <div class="relative h-72 sm:h-96 rounded-lg overflow-hidden bg-neutral-950 border border-neutral-300 dark:border-white/10 group shadow-2xl">
                        <!-- MAIN INSPECT CAR IMAGE -->
                        <img id="inspectCarImg" src="" alt="Car Inspection Preview" class="car-inspect-img w-full h-full object-cover">
                        
                        <!-- BADGE TOP LEFT -->
                        <div class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-mono font-bold px-3 py-1 uppercase tracking-widest shadow-lg flex items-center space-x-1.5">
                            <span id="inspectCondition">BRAND NEW</span>
                            <span id="inspectDiscountBadge" class="bg-black/50 text-amber-300 px-1.5 py-0.5 rounded text-[9px] font-extrabold hidden">-10% OFF</span>
                        </div>

                        <!-- BADGE TOP RIGHT (YEAR) -->
                        <div class="absolute top-4 right-4 bg-black/80 backdrop-blur-md text-neutral-200 text-xs font-mono px-3 py-1 border border-white/20">
                            <span id="inspectYear">2025</span>
                        </div>

                        <!-- ACTIVE COLOR & BODYKIT BADGE BOTTOM LEFT -->
                        <div class="absolute bottom-4 left-4 bg-black/85 backdrop-blur-md text-white text-xs font-mono px-3 py-2 border border-white/20 uppercase tracking-widest space-y-1">
                            <div class="flex items-center space-x-2">
                                <span class="inline-block w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                                <span>COLOR: <strong id="inspectColorBadge" class="text-red-500 font-extrabold">--</strong></span>
                            </div>
                            <div id="inspectBodykitBadgeRow" class="text-[10px] text-amber-400 font-bold border-t border-white/10 pt-1 flex items-center">
                                <i class="fa-solid fa-screwdriver-wrench mr-1.5 text-xs text-red-500"></i>
                                <span id="inspectBodykitBadge">STANDARD FACTORY SPEC</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: CAR SPECS & INTERACTIVE COLOR/BODYKIT TOGGLES -->
                <div class="lg:col-span-5 space-y-5 text-neutral-900 dark:text-white">
                    
                    <!-- BRAND & TITLE -->
                    <div class="space-y-1">
                        <span id="inspectBrand" class="text-xs font-mono text-red-600 dark:text-red-500 font-bold uppercase tracking-widest">BRAND</span>
                        <h3 id="inspectTitle" class="text-2xl sm:text-3xl font-serif font-black uppercase tracking-tight leading-tight">MODEL TITLE</h3>
                    </div>

                    <!-- PRICE TAG WITH STRIKETHROUGH ORIGINAL PRICE & ANIMATED COUNTDOWN -->
                    <div class="bg-neutral-100 dark:bg-neutral-900/80 p-3.5 border border-neutral-200 dark:border-white/10 space-y-1">
                        <div id="inspectOriginalPriceRow" class="hidden items-center justify-between text-xs font-mono">
                            <span class="text-neutral-500">ORIGINAL PRICE: <span id="inspectOriginalPrice" class="line-through font-semibold text-neutral-400">IDR --</span></span>
                            <span id="inspectSaveBadge" class="text-[9px] font-extrabold text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">SAVE --</span>
                        </div>

                        <span class="text-[10px] font-mono text-neutral-500 dark:text-neutral-400 block uppercase">FINAL OFFER PRICE</span>
                        <div class="text-2xl font-bold font-mono text-red-600 dark:text-red-500 flex items-center">
                            <span class="mr-1">IDR</span>
                            <span id="inspectPrice" class="price-count-down tracking-tight" data-from="0" data-to="0">0</span>
                        </div>
                    </div>

                    <!-- INTERACTIVE EXTERIOR COLOR CONFIGURATOR (MUTUALLY EXCLUSIVE WITH BODYKITS) -->
                    <div class="space-y-2 pt-1 border-t border-neutral-200 dark:border-white/10">
                        <div class="flex items-center justify-between text-xs font-mono">
                            <span class="font-bold uppercase tracking-wider text-neutral-700 dark:text-neutral-300">EXTERIOR PAINT FINISH:</span>
                            <span id="inspectColorCount" class="text-neutral-500 text-[11px]">4 VARIANTS</span>
                        </div>

                        <!-- ACCURATE COLOR DOTS CONTAINER -->
                        <div id="inspectColorDotsContainer" class="flex flex-wrap items-center gap-3 py-1">
                            <!-- Dynamic round color buttons injected by JS -->
                        </div>
                    </div>

                    <!-- INTERACTIVE BODYKITS / AERO STAGE CONFIGURATOR (STRICTLY ONLY FILES STARTING WITH bodykit_) -->
                    <div id="inspectBodykitSection" class="space-y-2 pt-2 border-t border-neutral-200 dark:border-white/10">
                        <div class="flex items-center justify-between text-xs font-mono">
                            <span class="font-bold uppercase tracking-wider text-neutral-700 dark:text-neutral-300">BODYKIT & AERO STAGE:</span>
                            <span id="inspectBodykitCount" class="text-neutral-500 text-[11px]">1 KIT</span>
                        </div>

                        <!-- NUMBERED BODYKIT BUTTONS CONTAINER (KIT 01, KIT 02, etc.) -->
                        <div id="inspectBodykitButtonsContainer" class="flex flex-wrap items-center gap-2 py-1">
                            <!-- Dynamic numbered buttons injected by JS -->
                        </div>
                    </div>

                    <!-- FULL PERFORMANCE SPECS GRID -->
                    <div class="space-y-2 pt-1 border-t border-neutral-200 dark:border-white/10">
                        <span class="text-xs font-mono font-bold uppercase tracking-wider text-neutral-700 dark:text-neutral-300 block">KEY PERFORMANCE SPECS:</span>
                        <div id="inspectSpecsGrid" class="grid grid-cols-2 gap-2 text-[11px] font-mono">
                            <!-- Dynamic specs injected by JS -->
                        </div>
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="pt-2 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <button onclick="bookCarWithSelectedConfig()" class="py-3 bg-red-600 hover:bg-red-700 text-white font-bold text-xs tracking-widest uppercase transition-all shadow-lg shadow-red-600/30 flex items-center justify-center">
                            <i class="fa-solid fa-calendar-check mr-2"></i> BOOK THIS SPEC
                        </button>
                        <button onclick="toggleModal('carInspectorModal'); toggleModal('inquireModal');" class="py-3 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 font-bold text-xs tracking-widest uppercase transition-colors flex items-center justify-center">
                            REQUEST QUOTE
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-- ==========================================
         INQUIRE & VIP MODAL
         ========================================== -->
    <div id="inquireModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/80 backdrop-blur-md p-4 transition-all duration-300">
        <div class="glass-card max-w-lg w-full p-8 border border-neutral-300 dark:border-white/20 shadow-2xl relative">
            <button onclick="toggleModal('inquireModal')" class="absolute top-4 right-4 text-neutral-500 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white text-lg">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="space-y-2 mb-6">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo/logo.png') }}" class="h-6 w-auto">
                    <span class="text-[10px] font-mono text-red-600 font-bold uppercase tracking-widest">APEX PRIVATE CONSULTATION</span>
                </div>
                <h3 class="text-2xl font-serif font-bold text-neutral-900 dark:text-white uppercase">Request VIP Viewing</h3>
                <p class="text-xs text-neutral-600 dark:text-neutral-400">Our luxury automotive advisor will contact you within 2 business hours.</p>
            </div>

            <form onsubmit="event.preventDefault(); alert('Thank you! Your private viewing request has been sent.'); toggleModal('inquireModal');" class="space-y-4 text-xs font-mono">
                <div>
                    <label class="block text-neutral-700 dark:text-neutral-400 font-semibold uppercase mb-1">FULL NAME</label>
                    <input type="text" required placeholder="e.g. Alexander Wright" class="w-full bg-neutral-100 dark:bg-neutral-900 border border-neutral-300 dark:border-white/15 px-3 py-2.5 text-neutral-900 dark:text-white focus:border-red-600 focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-neutral-700 dark:text-neutral-400 font-semibold uppercase mb-1">PHONE / WHATSAPP</label>
                        <input type="tel" required placeholder="+62 812 XXXX XXXX" class="w-full bg-neutral-100 dark:bg-neutral-900 border border-neutral-300 dark:border-white/15 px-3 py-2.5 text-neutral-900 dark:text-white focus:border-red-600 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-neutral-700 dark:text-neutral-400 font-semibold uppercase mb-1">PREFERRED MODEL</label>
                        <select id="modalCarSelect" class="w-full bg-neutral-100 dark:bg-neutral-900 border border-neutral-300 dark:border-white/15 px-3 py-2.5 text-neutral-900 dark:text-white focus:border-red-600 focus:outline-none">
                            <option value="BMW M4 Competition">BMW M4 Competition</option>
                            <option value="Lamborghini Revuelto">Lamborghini Revuelto V12</option>
                            <option value="McLaren Senna GTR">McLaren Senna GTR</option>
                            <option value="Ferrari SF90 XX Stradale">Ferrari SF90 XX Stradale</option>
                            <option value="Jeep Gladiator Rubicon">Jeep Gladiator Rubicon</option>
                            <option value="Porsche 911 GT3 RS">Porsche 911 GT3 RS</option>
                            <option value="Audi R8 V10">Audi R8 V10 Performance</option>
                            <option value="Koenigsegg Jesko Absolut">Koenigsegg Jesko Absolut</option>
                            <option value="Bugatti Chiron">Bugatti Chiron Pur Sport</option>
                            <option value="Chevrolet Corvette C8">Chevrolet Corvette C8 Z06</option>
                            <option value="Pagani Huayra BC">Pagani Huayra BC</option>
                            <option value="Zenvo TSR-S">Zenvo TSR-S</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-neutral-700 dark:text-neutral-400 font-semibold uppercase mb-1">SPECIAL REQUEST / NOTES</label>
                    <textarea id="modalNotes" rows="3" placeholder="Tell us about your schedule or trade-in inquiries..." class="w-full bg-neutral-100 dark:bg-neutral-900 border border-neutral-300 dark:border-white/15 px-3 py-2.5 text-neutral-900 dark:text-white focus:border-red-600 focus:outline-none"></textarea>
                </div>

                <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold tracking-widest uppercase transition-all shadow-lg shadow-red-600/30">
                    SUBMIT REQUEST
                </button>
            </form>
        </div>
    </div>


    <!-- ==========================================
         JAVASCRIPT CONTROLLER
         ========================================== -->
    <script>
        // 0. COMPREHENSIVE CAR DATABASE (STRICT SEPARATION: ONLY FILES WITH bodykit_ ARE BODYKITS)
        const CAR_DATABASE = {
            'bmw_m4': {
                brand: 'BMW MOTORSPORT',
                model: 'M4 COMPETITION COUPE',
                year: '2025',
                originalPriceNum: 8500000000,
                finalPriceNum: 7650000000,
                discountPct: '10%',
                condition: 'BRAND NEW',
                specs: [
                    { label: 'ENGINE', val: '3.0L Twin-Turbo Inline-6' },
                    { label: 'POWER', val: '510 HP @ 6,250 RPM' },
                    { label: 'ACCELERATION', val: '0-100 KM/H in 3.5s' },
                    { label: 'TOP SPEED', val: '290 KM/H (M Driver\'s)' },
                    { label: 'DRIVETRAIN', val: 'M xDrive AWD System' }
                ],
                colors: [
                    { name: 'SAO PAULO YELLOW', hex: '#d6e531', img: "{{ asset('images/brand/bmwm4competition_sao_paulo_yellow.png') }}" },
                    { name: 'VOODOO BLUE', hex: '#0055b8', img: "{{ asset('images/brand/bmwm4competition_voodoo_blue.png') }}" },
                    { name: 'ALPINE WHITE', hex: '#f0f4f8', img: "{{ asset('images/brand/bmwm4competition_alpine_white.png') }}" },
                    { name: 'BLACK SAPPHIRE METALLIC', hex: '#0d0d11', img: "{{ asset('images/brand/bmwm4competition_black_shapphire_metallic.png') }}" }
                ],
                bodykits: [
                    { num: 'KIT 01', name: 'M PERFORMANCE CARBON AEROKIT', img: "{{ asset('images/brand/bodykit_bmw_m4_competition.png') }}" }
                ]
            },
            'lamborghini_revuelto': {
                brand: 'LAMBORGHINI',
                model: 'REVUELTO V12 HYBRID',
                year: '2025',
                originalPriceNum: 22000000000,
                finalPriceNum: 20460000000,
                discountPct: '7%',
                condition: 'BRAND NEW',
                specs: [
                    { label: 'ENGINE', val: '6.5L V12 NA + 3 E-Motors' },
                    { label: 'POWER', val: '1,015 HP Total Output' },
                    { label: 'ACCELERATION', val: '0-100 KM/H in 2.5s' },
                    { label: 'TOP SPEED', val: '> 350 KM/H' },
                    { label: 'GEARBOX', val: '8-Speed Dual Clutch' }
                ],
                colors: [
                    { name: 'ARANCIO APODIS', hex: '#ff4e00', img: "{{ asset('images/brand/lamborghini_revuelto_arancio_apodis.png') }}" },
                    { name: 'VERDE CITRA', hex: '#84ff00', img: "{{ asset('images/brand/lamborghini_revuelto_verde_citra.png') }}" },
                    { name: 'BRONZO ZANTE', hex: '#9e7957', img: "{{ asset('images/brand/lamborghini_revuelto_bronzo_zante.png') }}" },
                    { name: 'BIANCO MONOCERUS', hex: '#f8f9fa', img: "{{ asset('images/brand/lamborghini_revuelto_bianco_monocerus.png') }}" }
                ],
                bodykits: [
                    { num: 'KIT 01', name: 'SUPERVELOCE STAGE 2 AERO', img: "{{ asset('images/brand/bodykit_lamborghini_revuelto_stage_2.png') }}" }
                ]
            },
            'mclaren_senna': {
                brand: 'MCLAREN',
                model: 'SENNA GTR EDITION',
                year: '2024',
                originalPriceNum: null,
                finalPriceNum: 28000000000,
                discountPct: null,
                condition: 'APEX CERTIFIED',
                specs: [
                    { label: 'ENGINE', val: '4.0L Twin-Turbo V8' },
                    { label: 'POWER', val: '825 HP / 800 Nm' },
                    { label: 'DOWNFORCE', val: '800 KG Aerodynamic Load' },
                    { label: 'WEIGHT', val: '1,188 KG Carbon Monocage III' },
                    { label: 'ACCELERATION', val: '0-100 KM/H in 2.8s' }
                ],
                colors: [
                    { name: 'VOLCANO YELLOW', hex: '#ffd000', img: "{{ asset('images/brand/mclaren_senna_gtr_volcano_yellow.png') }}" },
                    { name: 'PAPAYA SHARK', hex: '#ff8800', img: "{{ asset('images/brand/mclaren_senna_gtr_papaya_shark.png') }}" },
                    { name: 'SILICA WHITE', hex: '#f4f6f9', img: "{{ asset('images/brand/mclaren_senna_gtr_silica_white.png') }}" }
                ],
                bodykits: [
                    { num: 'KIT 01', name: 'STANDARD GTR TRACK SPEC', img: "{{ asset('images/brand/bodykit_mclaren_senna_gtr.png') }}" },
                    { num: 'KIT 02', name: 'GTR CHASSIS #12 LIVERY', img: "{{ asset('images/brand/bodykit_mclaren_senna_gtr_chassis_12.png') }}" },
                    { num: 'KIT 03', name: 'HARRODS MOTORSPORT EDITION', img: "{{ asset('images/brand/bodykit_mclaren_senna_gtr_harrods.png') }}" }
                ]
            },
            'porsche_911': {
                brand: 'PORSCHE',
                model: '911 GT3 RS (992)',
                year: '2024',
                originalPriceNum: null,
                finalPriceNum: 11500000000,
                discountPct: null,
                condition: 'APEX CERTIFIED',
                specs: [
                    { label: 'ENGINE', val: '4.0L Naturally Aspirated Flat-6' },
                    { label: 'POWER', val: '525 HP @ 9,000 RPM' },
                    { label: 'AERODYNAMICS', val: 'DRS Active Rear Wing' },
                    { label: 'ACCELERATION', val: '0-100 KM/H in 3.2s' },
                    { label: 'TRANSMISSION', val: '7-Speed PDK Dual-Clutch' }
                ],
                colors: [
                    { name: 'RUBYSTONE RED', hex: '#c2185b', img: "{{ asset('images/brand/porsche_rubystone_red.png') }}" },
                    { name: 'RACING YELLOW', hex: '#ffea00', img: "{{ asset('images/brand/porsche_racing_yellow.png') }}" },
                    { name: 'NATO OLIVE GREEN', hex: '#3b4728', img: "{{ asset('images/brand/porsche_nato_olive_green.png') }}" },
                    { name: 'ARCTIC GREY', hex: '#607d8b', img: "{{ asset('images/brand/porsche_artic_grey.png') }}" },
                    { name: 'CARRARA WHITE', hex: '#ffffff', img: "{{ asset('images/brand/porsche_carrara_white_metallic.png') }}" }
                ],
                bodykits: [
                    { num: 'KIT 01', name: 'WEISSACH PACKAGE RS AERO', img: "{{ asset('images/brand/bodykit_porsche_911_gt3_rs_992.png') }}" },
                    { num: 'KIT 02', name: 'GT3 R 992 MOTORSPORT SPEC', img: "{{ asset('images/brand/bodykit_porsche_911_gt3_r_992.png') }}" },
                    { num: 'KIT 03', name: 'GT3 R BLACK EDITION CARBON', img: "{{ asset('images/brand/bodykit_porsche_911_gt3_r_992_black.png') }}" }
                ]
            },
            'audi_r8': {
                brand: 'AUDI',
                model: 'R8 V10 PERFORMANCE',
                year: '2024',
                originalPriceNum: null,
                finalPriceNum: 7800000000,
                discountPct: null,
                condition: 'PRE-OWNED',
                specs: [
                    { label: 'ENGINE', val: '5.2L Naturally Aspirated V10' },
                    { label: 'POWER', val: '620 HP @ 8,000 RPM' },
                    { label: 'DRIVETRAIN', val: 'Quattro Permanent AWD' },
                    { label: 'ACCELERATION', val: '0-100 KM/H in 3.1s' },
                    { label: 'TOP SPEED', val: '331 KM/H' }
                ],
                colors: [
                    { name: 'TANGO RED METALLIC', hex: '#c62828', img: "{{ asset('images/brand/audi_r8_tango_red_metallic.png') }}" },
                    { name: 'VEGAS YELLOW', hex: '#fdd835', img: "{{ asset('images/brand/audi_r8_vegas_yellow.png') }}" },
                    { name: 'ARA BLUE CRYSTAL', hex: '#0277bd', img: "{{ asset('images/brand/audi_r8_ara_blue_crystal_effect.png') }}" },
                    { name: 'MYTHOS BLACK METALLIC', hex: '#121212', img: "{{ asset('images/brand/audi_r8_mythos_black_mettalic.png') }}" },
                    { name: 'IBIS WHITE', hex: '#f5f5f5', img: "{{ asset('images/brand/audi_r8_ibis_white.png') }}" }
                ],
                bodykits: [
                    { num: 'KIT 01', name: 'R8 GT4 LMS MOTORSPORT KIT', img: "{{ asset('images/brand/bodykit_audi_r8_gt4.png') }}" },
                    { num: 'KIT 02', name: 'LIBERTY WALK WIDEBODY KIT', img: "{{ asset('images/brand/bodykit_audi_r8_liberty_walk.png') }}" }
                ]
            },
            'koenigsegg_jesko': {
                brand: 'KOENIGSEGG',
                model: 'JESKO ABSOLUT',
                year: '2025',
                originalPriceNum: null,
                finalPriceNum: 45000000000,
                discountPct: null,
                condition: 'HYPERCAR SPECIAL',
                specs: [
                    { label: 'ENGINE', val: '5.0L Twin-Turbo Flat-Plane V8' },
                    { label: 'POWER', val: '1,600 HP (E85 Biofuel)' },
                    { label: 'TRANSMISSION', val: '9-Speed Light Speed Transmission' },
                    { label: 'TOP SPEED', val: '530+ KM/H (Theoretical)' },
                    { label: 'DRAG', val: '0.278 Cd Ultra Low Drag' }
                ],
                colors: [
                    { name: 'CRYSTAL WHITE', hex: '#ffffff', img: "{{ asset('images/brand/koeningseg_jesko_absolut_crystal_white.png') }}" },
                    { name: 'K2 CARBON', hex: '#1f262a', img: "{{ asset('images/brand/koeningseg_jesko_absolut_k2_carbon.png') }}" }
                ],
                bodykits: [
                    { num: 'KIT 01', name: 'ABSOLUT HIGH-SPEED AERO', img: "{{ asset('images/brand/bodykit_koenigsegg_jesko_absolut.png') }}" }
                ]
            },
            'bugatti_chiron': {
                brand: 'BUGATTI',
                model: 'CHIRON PUR SPORT W16',
                year: '2025',
                originalPriceNum: null,
                finalPriceNum: 52000000000,
                discountPct: null,
                condition: 'BRAND NEW',
                specs: [
                    { label: 'ENGINE', val: '8.0L Quad-Turbocharged W16' },
                    { label: 'POWER', val: '1,500 HP / 1,600 Nm' },
                    { label: 'ACCELERATION', val: '0-100 KM/H in 2.4s' },
                    { label: 'TOP SPEED', val: '350 KM/H (Pur Sport Limited)' },
                    { label: 'DRIVETRAIN', val: 'Permanent 4WD' }
                ],
                colors: [
                    { name: 'LE MANS BLUE', hex: '#0a3880', img: "{{ asset('images/brand/buggati_chiron_le_mans_blue.png') }}" },
                    { name: 'GRIS RAFALE', hex: '#616161', img: "{{ asset('images/brand/buggati_chiron_gris_rafale.png') }}" },
                    { name: 'NOIRE ELEGANCE', hex: '#111115', img: "{{ asset('images/brand/buggati_chiron_noire_elegance.png') }}" }
                ],
                bodykits: [
                    { num: 'KIT 01', name: 'HENNESSEY / PUR SPORT PACKAGE', img: "{{ asset('images/brand/bodykit_buggati_chiron_pur_sport.png') }}" },
                    { num: 'KIT 02', name: '110 ANS BUGATTI EDITION', img: "{{ asset('images/brand/bodykit_buggati_chiron_sport_110_ans.png') }}" },
                    { num: 'KIT 03', name: 'BOLIDE EXTREME TRACK CONCEPT', img: "{{ asset('images/brand/bodykit_buggati_chiron_bolide.png') }}" }
                ]
            },
            'chevrolet_corvette': {
                brand: 'CHEVROLET',
                model: 'CORVETTE C8 Z06 GT3',
                year: '2025',
                originalPriceNum: null,
                finalPriceNum: 6800000000,
                discountPct: null,
                condition: 'BRAND NEW',
                specs: [
                    { label: 'ENGINE', val: '5.5L Flat-Plane LT6 V8' },
                    { label: 'POWER', val: '670 HP @ 8,400 RPM' },
                    { label: 'ACCELERATION', val: '0-100 KM/H in 2.6s' },
                    { label: 'TRANSMISSION', val: '8-Speed Dual Clutch' },
                    { label: 'MAX RPM', val: '8,600 RPM Redline' }
                ],
                colors: [
                    { name: 'TORCH RED', hex: '#d50000', img: "{{ asset('images/brand/chevrolet_corvette_c8_torch_red.png') }}" },
                    { name: 'ACCELERATE YELLOW', hex: '#ffd600', img: "{{ asset('images/brand/chevrolet_corvette_c8_accelerate_yellow.png') }}" },
                    { name: 'RAPID BLUE', hex: '#0091ea', img: "{{ asset('images/brand/chevrolet_corvette_c8_rapid_blue.png') }}" },
                    { name: 'ARCTIC WHITE', hex: '#ffffff', img: "{{ asset('images/brand/chevrolet_corvette_c8_arctic_white.png') }}" }
                ],
                bodykits: [
                    { num: 'KIT 01', name: 'HENNESSEY H700 SUPERCHARGED', img: "{{ asset('images/brand/bodykit_hennessey_h700_corvette_c8.png') }}" },
                    { num: 'KIT 02', name: 'C8.R ENDURANCE RACING KIT', img: "{{ asset('images/brand/bodykit_chevrolet_corvette_c8_r.png') }}" },
                    { num: 'KIT 03', name: 'Z06 GT3.R MOTORSPORT PACKAGE', img: "{{ asset('images/brand/bodykit_chevrolet_corvette_c8_z06_gt3_r.png') }}" }
                ]
            },
            'pagani_huayra': {
                brand: 'PAGANI',
                model: 'HUAYRA BC BENNY CAIOLA',
                year: '2025',
                originalPriceNum: null,
                finalPriceNum: 48000000000,
                discountPct: null,
                condition: 'APEX CERTIFIED',
                specs: [
                    { label: 'ENGINE', val: '6.0L Mercedes-AMG Twin-Turbo V12' },
                    { label: 'POWER', val: '800 HP / 1,050 Nm' },
                    { label: 'WEIGHT', val: '1,218 KG Carbo-Triax HP62' },
                    { label: 'TRANSMISSION', val: '7-Speed Xtrac Transversal' },
                    { label: 'PRODUCTION', val: '1 of 20 Units Worldwide' }
                ],
                colors: [
                    { name: 'CARBON TITANIUM', hex: '#263238', img: "{{ asset('images/brand/pagani_huayra_bc.png') }}" },
                    { name: 'RADUNO SPEC', hex: '#37474f', img: "{{ asset('images/brand/pagani_huayra_raduno.png') }}" },
                    { name: 'ROADSTER BC SPEC', hex: '#eceff1', img: "{{ asset('images/brand/pagani_huayra_roadster_bc.png') }}" }
                ],
                bodykits: []
            },
            'zenvo_tsr': {
                brand: 'ZENVO AUTOMOTIVE',
                model: 'TSR-S CENTRIPETAL WING',
                year: '2025',
                originalPriceNum: null,
                finalPriceNum: 38000000000,
                discountPct: null,
                condition: 'HYPERCAR SPECIAL',
                specs: [
                    { label: 'ENGINE', val: '5.8L Twin-Centrifugal V8' },
                    { label: 'POWER', val: '1,177 HP @ 8,500 RPM' },
                    { label: 'ACCELERATION', val: '0-100 KM/H in 2.8s' },
                    { label: 'AERODYNAMICS', val: 'Patented Centripetal Rear Wing' },
                    { label: 'TOP SPEED', val: '325 KM/H (Track Limited)' }
                ],
                colors: [
                    { name: 'VIOLA PARSIFAE', hex: '#7b1fa2', img: "{{ asset('images/brand/zenvo_tsr_s_viola_parsifae.png') }}" },
                    { name: 'BALTIC BLUE', hex: '#0288d1', img: "{{ asset('images/brand/zenvo_ts1_gt_baltic_blue.png') }}" },
                    { name: 'CRYSTAL WHITE', hex: '#ffffff', img: "{{ asset('images/brand/zenvo_ts1_gt_crystal_white.png') }}" }
                ],
                bodykits: []
            }
        };

        let currentInspectedCarKey = null;
        let currentSelectedColorName = null;
        let currentSelectedBodykitName = null;

        // 1. INTRO SCREEN DISMISSAL & PRICE DROPDOWN ANIMATION OBSERVER
        window.addEventListener('DOMContentLoaded', () => {
            const intro = document.getElementById('intro-screen');
            if (intro) {
                setTimeout(() => {
                    intro.classList.add('opacity-0', 'pointer-events-none');
                    setTimeout(() => {
                        intro.remove();
                    }, 1000);
                }, 2400);
            }

            // Sync toggle button initial state
            updateToggleKnobPosition();

            // Observe price countdown elements for scroll animation
            initPriceDropObserver();
        });

        function updateToggleKnobPosition() {
            const knob = document.getElementById('toggleThumb');
            if (!knob) return;
            if (document.documentElement.classList.contains('dark')) {
                knob.style.transform = 'translateX(2rem)';
            } else {
                knob.style.transform = 'translateX(0rem)';
            }
        }


        // 2. SMOOTH NUMBER PRICE DROP COUNTER ANIMATION ENGINE
        function animatePriceDrop(el) {
            if (!el || el.getAttribute('data-animated') === 'true') return;
            el.setAttribute('data-animated', 'true');

            const fromVal = parseInt(el.getAttribute('data-from'));
            const toVal = parseInt(el.getAttribute('data-to'));

            if (isNaN(fromVal) || isNaN(toVal) || fromVal === toVal) {
                el.innerText = toVal.toLocaleString('id-ID');
                return;
            }

            const duration = 1800; // ms
            const startTime = performance.now();

            function step(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                // Ease out exponential curve for realistic price drop feel
                const easeProgress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                const currentVal = Math.round(fromVal - (fromVal - toVal) * easeProgress);

                el.innerText = currentVal.toLocaleString('id-ID');

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    el.innerText = toVal.toLocaleString('id-ID');
                }
            }

            requestAnimationFrame(step);
        }

        function initPriceDropObserver() {
            const priceObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animatePriceDrop(entry.target);
                    }
                });
            }, { threshold: 0.2 });

            document.querySelectorAll('.price-count-down').forEach(el => {
                priceObserver.observe(el);
            });
        }


        // 3. CAR INSPECTOR & COLOR/BODYKIT CONFIGURATOR MODAL ENGINE (STRICT BODYKIT SEPARATION)
        function openCarInspector(carKey) {
            const car = CAR_DATABASE[carKey];
            if (!car) return;

            currentInspectedCarKey = carKey;

            document.getElementById('inspectBrand').innerText = car.brand;
            document.getElementById('inspectTitle').innerText = car.model;
            document.getElementById('inspectYear').innerText = car.year;
            document.getElementById('inspectCondition').innerText = car.condition;

            // Handle Discount & Strikethrough Price in Modal
            const origPriceRow = document.getElementById('inspectOriginalPriceRow');
            const discountBadge = document.getElementById('inspectDiscountBadge');

            if (car.originalPriceNum && car.discountPct) {
                origPriceRow.classList.remove('hidden');
                origPriceRow.classList.add('flex');
                document.getElementById('inspectOriginalPrice').innerText = `IDR ${car.originalPriceNum.toLocaleString('id-ID')}`;
                document.getElementById('inspectSaveBadge').innerText = `SAVE ${car.discountPct}`;
                
                discountBadge.classList.remove('hidden');
                discountBadge.innerText = `-${car.discountPct} OFF`;
            } else {
                origPriceRow.classList.add('hidden');
                origPriceRow.classList.remove('flex');
                discountBadge.classList.add('hidden');
            }

            // Price Drop animation for Modal
            const modalPriceEl = document.getElementById('inspectPrice');
            modalPriceEl.removeAttribute('data-animated');
            const startPrice = car.originalPriceNum || (car.finalPriceNum * 1.05);
            modalPriceEl.setAttribute('data-from', startPrice.toString());
            modalPriceEl.setAttribute('data-to', car.finalPriceNum.toString());

            setTimeout(() => {
                animatePriceDrop(modalPriceEl);
            }, 150);

            // Populate Specs Grid
            const specsGrid = document.getElementById('inspectSpecsGrid');
            specsGrid.innerHTML = car.specs.map(s => `
                <div class="bg-neutral-100 dark:bg-neutral-900/60 p-2 border border-neutral-200 dark:border-white/5">
                    <span class="text-neutral-500 text-[9px] block uppercase">${s.label}</span>
                    <span class="font-bold text-neutral-900 dark:text-neutral-200">${s.val}</span>
                </div>
            `).join('');

            // Populate Color Dots
            document.getElementById('inspectColorCount').innerText = `${car.colors.length} VARIANTS`;
            const dotsContainer = document.getElementById('inspectColorDotsContainer');
            
            dotsContainer.innerHTML = car.colors.map((c, idx) => `
                <button type="button" 
                        onclick="setInspectorColor(${idx})"
                        class="inspect-color-dot w-7 h-7 rounded-full border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125 focus:outline-none"
                        style="background-color: ${c.hex};" 
                        title="${c.name}">
                </button>
            `).join('');

            // Populate Numbered Bodykit Buttons (ONLY IF STRICT bodykit_ FILES EXIST)
            const bodykitSection = document.getElementById('inspectBodykitSection');
            const bodykitContainer = document.getElementById('inspectBodykitButtonsContainer');
            const bodykitCountEl = document.getElementById('inspectBodykitCount');

            if (car.bodykits && car.bodykits.length > 0) {
                bodykitSection.classList.remove('hidden');
                bodykitCountEl.innerText = `${car.bodykits.length} KIT VARIANT${car.bodykits.length > 1 ? 'S' : ''}`;
                bodykitContainer.innerHTML = car.bodykits.map((b, idx) => `
                    <button type="button" 
                            onclick="setInspectorBodykit(${idx})"
                            class="inspect-bodykit-btn px-3 py-1.5 text-[11px] font-mono font-bold tracking-wider rounded border border-neutral-300 dark:border-white/20 bg-neutral-100 dark:bg-neutral-900 text-neutral-800 dark:text-neutral-200 hover:border-red-500 transition-all cursor-pointer">
                        ${b.num}
                    </button>
                `).join('');
            } else {
                bodykitSection.classList.add('hidden');
            }

            // Default select 1st color
            setInspectorColor(0);

            // Open Modal
            toggleModal('carInspectorModal');
        }

        // SELECTING A COLOR DEACTIVATES BODYKIT MODE
        function setInspectorColor(index) {
            const car = CAR_DATABASE[currentInspectedCarKey];
            if (!car || !car.colors[index]) return;

            const selectedColor = car.colors[index];
            currentSelectedColorName = selectedColor.name;
            currentSelectedBodykitName = null; // Clear Bodykit mode

            const img = document.getElementById('inspectCarImg');
            const colorBadge = document.getElementById('inspectColorBadge');
            const kitBadge = document.getElementById('inspectBodykitBadge');

            if (img) {
                img.style.opacity = '0.2';
                img.style.transform = 'scale(0.97)';
                setTimeout(() => {
                    img.src = selectedColor.img;
                    img.style.opacity = '1';
                    img.style.transform = 'scale(1)';
                }, 150);
            }

            if (colorBadge) {
                colorBadge.innerText = selectedColor.name;
                colorBadge.classList.remove('opacity-40');
            }

            if (kitBadge) {
                kitBadge.innerText = 'FACTORY STOCK SPEC';
                kitBadge.classList.add('opacity-40');
            }

            // Highlight active color dot, DEACTIVATE/CLEAR all bodykit buttons
            const dots = document.querySelectorAll('.inspect-color-dot');
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.className = "inspect-color-dot w-7 h-7 rounded-full border-2 border-red-500 ring-2 ring-red-500 scale-110 shadow-lg cursor-pointer transition-all focus:outline-none opacity-100";
                } else {
                    dot.className = "inspect-color-dot w-7 h-7 rounded-full border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125 focus:outline-none opacity-60 hover:opacity-100";
                }
            });

            const bodykitBtns = document.querySelectorAll('.inspect-bodykit-btn');
            bodykitBtns.forEach(btn => {
                btn.className = "inspect-bodykit-btn px-3 py-1.5 text-[11px] font-mono font-bold tracking-wider rounded border border-neutral-300 dark:border-white/20 bg-neutral-100 dark:bg-neutral-900 text-neutral-800 dark:text-neutral-200 hover:border-red-500 transition-all cursor-pointer opacity-30 hover:opacity-100";
            });
        }

        // SELECTING A BODYKIT DEACTIVATES COLOR MODE (ONLY LOADS REAL bodykit_ FILES)
        function setInspectorBodykit(index) {
            const car = CAR_DATABASE[currentInspectedCarKey];
            if (!car || !car.bodykits || !car.bodykits[index]) return;

            const selectedKit = car.bodykits[index];
            currentSelectedBodykitName = selectedKit.name;
            currentSelectedColorName = null; // Clear Color mode

            const img = document.getElementById('inspectCarImg');
            const colorBadge = document.getElementById('inspectColorBadge');
            const kitBadge = document.getElementById('inspectBodykitBadge');

            if (img) {
                img.style.opacity = '0.2';
                img.style.transform = 'scale(0.97)';
                setTimeout(() => {
                    img.src = selectedKit.img;
                    img.style.opacity = '1';
                    img.style.transform = 'scale(1)';
                }, 150);
            }

            if (kitBadge) {
                kitBadge.innerText = `${selectedKit.num}: ${selectedKit.name}`;
                kitBadge.classList.remove('opacity-40');
            }

            if (colorBadge) {
                colorBadge.innerText = 'MODIFIED AERO FINISH';
                colorBadge.classList.add('opacity-40');
            }

            // Highlight active bodykit button, DEACTIVATE/CLEAR all color dots
            const bodykitBtns = document.querySelectorAll('.inspect-bodykit-btn');
            bodykitBtns.forEach((btn, i) => {
                if (i === index) {
                    btn.className = "inspect-bodykit-btn px-3 py-1.5 text-[11px] font-mono font-bold tracking-wider rounded border-2 border-red-600 bg-red-600 text-white shadow-lg transition-all cursor-pointer opacity-100";
                } else {
                    btn.className = "inspect-bodykit-btn px-3 py-1.5 text-[11px] font-mono font-bold tracking-wider rounded border border-neutral-300 dark:border-white/20 bg-neutral-100 dark:bg-neutral-900 text-neutral-800 dark:text-neutral-200 hover:border-red-500 transition-all cursor-pointer opacity-30 hover:opacity-100";
                }
            });

            const dots = document.querySelectorAll('.inspect-color-dot');
            dots.forEach(dot => {
                dot.className = "inspect-color-dot w-7 h-7 rounded-full border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125 focus:outline-none opacity-30 hover:opacity-100";
            });
        }

        function bookCarWithSelectedConfig() {
            const car = CAR_DATABASE[currentInspectedCarKey];
            if (!car) return;

            toggleModal('carInspectorModal');
            
            const notesField = document.getElementById('modalNotes');
            if (notesField) {
                if (currentSelectedBodykitName) {
                    notesField.value = `Selected Spec: Bodykit Package (${currentSelectedBodykitName}) for ${car.brand} ${car.model}`;
                } else if (currentSelectedColorName) {
                    notesField.value = `Selected Spec: Exterior Paint (${currentSelectedColorName}) for ${car.brand} ${car.model}`;
                } else {
                    notesField.value = `Selected Spec: Standard Factory Spec for ${car.brand} ${car.model}`;
                }
            }

            openCarDetails(`${car.brand} ${car.model}`);
        }


        // 4. PIXEL WAVE DARK/LIGHT MODE TRANSITION (Left to Right Wave)
        let isTransitioningTheme = false;

        function triggerPixelWaveTransition() {
            if (isTransitioningTheme) return;
            isTransitioningTheme = true;

            const overlay = document.getElementById('pixel-transition-overlay');
            if (!overlay) return;

            const cols = 12;
            const rows = 8;
            overlay.innerHTML = '';
            overlay.classList.remove('hidden');

            const nextThemeDark = !document.documentElement.classList.contains('dark');
            const tileBgColor = nextThemeDark ? 'bg-neutral-950' : 'bg-white';

            // Create pixel tiles
            const tiles = [];
            for (let r = 0; r < rows; r++) {
                for (let c = 0; c < cols; c++) {
                    const tile = document.createElement('div');
                    tile.className = `pixel-tile ${tileBgColor} border border-neutral-400/20`;
                    overlay.appendChild(tile);
                    tiles.push({ el: tile, col: c, row: r });
                }
            }

            // Phase 1: Wipe IN from left to right
            tiles.forEach(({ el, col, row }) => {
                const delay = (col * 25) + (row * 6);
                setTimeout(() => {
                    el.classList.add('active');
                }, delay);
            });

            // Phase 2: At peak coverage, toggle theme class
            const totalInTime = (cols * 25) + (rows * 6) + 100;
            setTimeout(() => {
                if (nextThemeDark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
                updateToggleKnobPosition();
            }, totalInTime * 0.55);

            // Phase 3: Wipe OUT from left to right
            setTimeout(() => {
                tiles.forEach(({ el, col, row }) => {
                    const delay = (col * 25) + (row * 6);
                    setTimeout(() => {
                        el.classList.remove('active');
                    }, delay);
                });

                // Cleanup overlay after animation ends
                setTimeout(() => {
                    overlay.classList.add('hidden');
                    overlay.innerHTML = '';
                    isTransitioningTheme = false;
                }, totalInTime + 250);

            }, totalInTime);
        }


        // 5. DYNAMIC CAROUSEL ENGINE (SUPPORTING ALL 5 SLIDES)
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.dot-indicator');
        const counter = document.getElementById('slide-counter');
        let autoSlideInterval;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                const img = slide.querySelector('.hero-img');
                if (i === index) {
                    slide.classList.remove('opacity-0', 'z-0');
                    slide.classList.add('opacity-100', 'z-10');
                    if (img) img.classList.add('scale-105');
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0', 'z-0');
                    if (img) img.classList.remove('scale-105');
                }
            });

            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.className = "w-10 h-1 bg-red-600 transition-all rounded-full dot-indicator";
                } else {
                    dot.className = "w-4 h-1 bg-white/30 hover:bg-white transition-all rounded-full dot-indicator";
                }
            });

            if (counter) {
                counter.innerText = `0${index + 1} / 0${slides.length}`;
            }

            currentSlide = index;
        }

        function nextSlide() {
            let next = (currentSlide + 1) % slides.length;
            showSlide(next);
            resetAutoSlide();
        }

        function prevSlide() {
            let prev = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(prev);
            resetAutoSlide();
        }

        function setSlide(index) {
            showSlide(index);
            resetAutoSlide();
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(() => {
                nextSlide();
            }, 6000);
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        startAutoSlide();


        // 6. SCROLL ANIMATION OBSERVER
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        };

        const scrollObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal-on-scroll').forEach(el => {
            scrollObserver.observe(el);
        });


        // 7. CATALOG FILTER ENGINE
        function applyFilters() {
            const selectedModel = document.getElementById('filterModel').value;
            const selectedPrice = document.getElementById('filterPrice').value;
            const selectedCondition = document.getElementById('filterCondition').value;
            
            const carCards = document.querySelectorAll('#carCatalog .car-card');

            carCards.forEach(card => {
                const cardMake = card.getAttribute('data-make');
                const cardPrice = parseInt(card.getAttribute('data-price'));
                const cardCondition = card.getAttribute('data-condition');

                let matchMake = (selectedModel === 'ALL' || cardMake.toLowerCase().includes(selectedModel.toLowerCase()));
                let matchCondition = (selectedCondition === 'ALL' || cardCondition === selectedCondition);
                
                let matchPrice = true;
                if (selectedPrice === 'BELOW_10B') {
                    matchPrice = cardPrice < 10000;
                } else if (selectedPrice === '10B_20B') {
                    matchPrice = cardPrice >= 10000 && cardPrice <= 20000;
                } else if (selectedPrice === 'ABOVE_20B') {
                    matchPrice = cardPrice > 20000;
                }

                if (matchMake && matchCondition && matchPrice) {
                    card.style.display = 'block';
                    card.classList.add('is-visible');
                } else {
                    card.style.display = 'none';
                }
            });
        }


        // 8. MODAL HANDLER
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');
            }
        }

        function openCarDetails(carName) {
            const select = document.getElementById('modalCarSelect');
            if (select) {
                for (let option of select.options) {
                    if (option.value.toLowerCase().includes(carName.toLowerCase())) {
                        option.selected = true;
                        break;
                    }
                }
            }
            toggleModal('inquireModal');
        }
    </script>
</body>
</html>
