@extends('layouts.app')
@section('title', 'APEX AUTOMOTIVE | Official Luxury Showroom & Hypercar Dealer')
@section('meta_description', 'Apex Automotive - Official Luxury Supercar & Hypercar Dealer in Cijeungjing. Exclusive inventory of BMW Motorsport, Lamborghini, McLaren, Ferrari, Porsche, Audi, Koenigsegg, Bugatti, Chevrolet Corvette, Pagani, Zenvo, and Jeep.')

@section('styles')
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
            /* Ferrari-Style Floating Scroll Section Navigator */
            .apex-scroll-navigator {
                position: fixed;
                left: 28px;
                top: auto;
                bottom: 20px;
                z-index: 999999;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 16px;
                pointer-events: none;
                user-select: none;
                opacity: 0;
                transform: translateX(-15px);
                transition: opacity 0.35s ease, transform 0.35s ease;
            }
            .apex-scroll-navigator.visible {
                opacity: 1;
                pointer-events: auto;
                transform: translateX(0);
            }
            .nav-section-row {
                display: flex;
                align-items: center;
                gap: 14px;
                cursor: pointer;
            }
            .nav-ring-wrapper {
                position: relative;
                width: 28px;
                height: 28px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                flex-shrink: 0;
            }
            .nav-ring-svg {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                transform: rotate(-90deg);
            }
            .nav-ring-bg {
                stroke: rgba(255, 255, 255, 0.2);
                stroke-width: 2;
            }
            html:not(.dark) .nav-ring-bg {
                stroke: rgba(0, 0, 0, 0.2);
            }
            .nav-ring-progress {
                stroke: var(--text-heading, #ffffff);
                stroke-width: 2;
                stroke-linecap: round;
                stroke-dasharray: 75.39; /* 2 * PI * 12 */
                stroke-dashoffset: 75.39;
                transition: stroke-dashoffset 0.15s ease-out;
            }
            html:not(.dark) .nav-ring-progress {
                stroke: #111827;
            }
            .nav-ring-center-dot {
                width: 5px;
                height: 5px;
                background-color: var(--text-heading, #ffffff);
                border-radius: 50%;
            }
            html:not(.dark) .nav-ring-center-dot {
                background-color: #111827;
            }

            .nav-inactive-dots {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 28px;
                gap: 14px;
            }
            .nav-dot-item {
                width: 5px;
                height: 5px;
                border-radius: 50%;
                background-color: var(--text-heading, #ffffff);
                opacity: 0.7;
                cursor: pointer;
                transition: all 0.25s ease;
            }
            html:not(.dark) .nav-dot-item {
                background-color: #111827;
            }
            .nav-dot-item:hover {
                opacity: 1;
                transform: scale(1.4);
            }
            .nav-back-to-top {
                width: 28px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--text-heading, #ffffff);
                font-size: 14px;
                cursor: pointer;
                background: transparent;
                border: none;
                transition: transform 0.25s ease;
            }
            html:not(.dark) .nav-back-to-top {
                color: #111827;
            }
            .nav-back-to-top:hover {
                transform: translateY(-3px);
            }
        </style>
@endsection

@section('content')

@php
    // Fetch coordinates securely for frontend
    $dealer_lat = \App\Models\Setting::where('key', 'dealer_latitude')->value('value') ?? '-7.32740000';
    $dealer_lng = \App\Models\Setting::where('key', 'dealer_longitude')->value('value') ?? '108.32250000';
@endphp

    <div id="pixel-transition-overlay" class="fixed inset-0 z-[9998] pointer-events-none hidden grid grid-cols-12 grid-rows-8 w-full h-full"></div>

    <!-- FERRARI-STYLE FLOATING SCROLL SECTION NAVIGATOR -->
    <div class="apex-scroll-navigator" id="apexScrollNavigator">
        <!-- Active Section Row (Ring Progress + Label Inline) -->
        <div class="nav-section-row" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
            <div class="nav-ring-wrapper" title="Scroll Progress">
                <svg class="nav-ring-svg" viewBox="0 0 28 28">
                    <circle class="nav-ring-bg" cx="14" cy="14" r="12" fill="none"></circle>
                    <circle class="nav-ring-progress" id="scrollProgressRing" cx="14" cy="14" r="12" fill="none"></circle>
                </svg>
                <div class="nav-ring-center-dot"></div>
            </div>
        </div>

        <!-- Inactive Section Dots -->
        <div class="nav-inactive-dots" id="navInactiveDots">
            <div class="nav-dot-item" data-target="#certified-suggestions" onclick="scrollToSection('#certified-suggestions')" title="PRE-OWNED"></div>
            <div class="nav-dot-item" data-target="#spotlight" onclick="scrollToSection('#spotlight')" title="EXOTIC MODELS"></div>
            <div class="nav-dot-item" data-target="#services" onclick="scrollToSection('#services')" title="AFTER SALES"></div>
            <div class="nav-dot-item" data-target="#dealer-location" onclick="scrollToSection('#dealer-location')" title="DEALER LOCATOR"></div>
        </div>

        <!-- Back to Top Chevron Button -->
        <button class="nav-back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Kembali ke Atas">
            <i class="fa-solid fa-chevron-up"></i>
        </button>
    </div>


    <!-- ==========================================
         0. CINEMATIC BLACK INTRO SCREEN WITH LOGO FLICKER
         ========================================== -->
    <div id="intro-screen" class="fixed inset-0 bg-black flex flex-col items-center justify-center transition-all duration-1000" style="z-index: 2147483647;">
        <div class="relative flex flex-col items-center">
            <!-- Pulsing/Flickering Custom Logo -->
            <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive Logo" class="w-36 sm:w-48 h-auto object-contain logo-flicker mb-6">
            
            <div class="flex items-center space-x-3 mt-4">
                <span class="red-divider-line w-8"></span>
                <span class="font-serif tracking-[0.4em] text-xs text-neutral-300 uppercase font-bold">APEX AUTOMOTIVE</span>
                <span class="red-divider-line w-8"></span>
            </div>
            
            <p class="text-[10px] font-mono text-neutral-500 tracking-[0.3em] uppercase mt-2">
                CIJEUNGJING LUXURY SHOWROOM
            </p>
        </div>
    </div>
    <script>
        (function() {
            try {
                const isFreshAuth = {{ (session('welcome') || session('logged_out') || session('email_sent')) ? 'true' : 'false' }};
                const hasSeen = sessionStorage.getItem('apex_intro_seen');
                if (hasSeen && !isFreshAuth) {
                    const el = document.getElementById('intro-screen');
                    if (el) el.style.display = 'none';
                }
            } catch (e) {}
        })();
    </script>


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
                    <span class="font-bold text-neutral-200">CIJEUNGJING SHOWROOM:</span>
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
                <span class="cursor-pointer hover:text-white text-red-400 font-bold transition-colors underline underline-offset-4" onclick="window.location.href='/inquire'">
                    REQUEST VIP CATALOG
                </span>
                <span class="text-red-500 font-bold">///</span>
            </div>

            <!-- MARQUEE TRACK BLOCK 2 (DUPLICATE FOR SEAMLESS INFINITE LOOP) -->
            <div class="flex items-center space-x-8 shrink-0">
                <span class="flex items-center space-x-2 text-neutral-300">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="font-bold text-neutral-200">CIJEUNGJING SHOWROOM:</span>
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
                <span class="cursor-pointer hover:text-white text-red-400 font-bold transition-colors underline underline-offset-4" onclick="window.location.href='/inquire'">
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
                    {{-- AUTHENTICATED: Show user profile badge & dropdown --}}
                    <div class="relative inline-block text-left" id="userDropdownWrapper">
                        <button type="button" id="userDropdownToggle" onclick="toggleUserDropdown()" class="flex items-center space-x-2 px-3 py-2 border border-red-600/40 bg-[#0c0c14] hover:bg-red-600/10 transition-all duration-200 text-xs font-mono font-semibold text-white cursor-pointer rounded-sm shadow-md">
                            <span class="inline-flex w-6 h-6 items-center justify-center rounded-full bg-red-600 text-white text-[11px] font-extrabold uppercase shrink-0">
                                {{ strtoupper(substr(auth()->user()->name ?? 'V', 0, 1)) }}
                            </span>
                            <span class="uppercase tracking-wider max-w-[120px] sm:max-w-[160px] truncate text-[11px] font-bold">{{ auth()->user()->name ?? 'VIP Buyer' }}</span>
                            <i id="userDropdownChevron" class="fa-solid fa-chevron-down text-[9px] text-red-500 ml-1 transition-transform duration-200"></i>
                        </button>
                        {{-- Dropdown Menu — solid background, click trigger --}}
                        <div id="userDropdownMenu" class="absolute right-0 top-full mt-2 w-64 z-[100] hidden rounded-sm overflow-hidden" style="background: #0c0c14; border: 1px solid rgba(255,255,255,0.12); box-shadow: 0 20px 60px rgba(0,0,0,0.85);">
                            <div class="p-3.5 border-b" style="background: #111118; border-color: rgba(255,255,255,0.08);">
                                <p class="text-[9px] font-mono text-red-500 uppercase tracking-widest font-bold">AKUN VIP TERVERIFIKASI</p>
                                <p class="text-xs font-semibold text-white truncate mt-1">{{ auth()->user()->email }}</p>
                                @if (! auth()->user()->hasCompletedProfile())
                                    <a href="{{ route('profile.complete') }}" class="inline-flex items-center mt-2 text-[10px] font-mono text-amber-400 hover:text-amber-300 font-bold tracking-wider">
                                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> LENGKAPI PROFIL
                                    </a>
                                @endif
                            </div>
                            <div class="py-1" style="background: #0c0c14;">
                                @if(auth()->user()->isManager())
                                    <a href="{{ route('manager.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 text-xs font-mono text-red-400 hover:text-red-300 transition-colors" style="background: rgba(220,38,38,0.15);">
                                        <i class="fa-solid fa-chart-line w-4 text-center text-red-500"></i>
                                        <span>Dashboard Manager Executive</span>
                                    </a>
                                @elseif(auth()->user()->isRm())
                                    <a href="{{ route('admin.inquiries.index') }}" class="flex items-center space-x-3 px-4 py-2.5 text-xs font-mono text-amber-400 hover:text-amber-300 transition-colors" style="background: rgba(234,179,8,0.15);">
                                        <i class="fa-solid fa-shield-halved w-4 text-center text-amber-400"></i>
                                        <span>Sales RM Panel Admin</span>
                                    </a>
                                @elseif(auth()->user()->isDelivery())
                                    <a href="{{ route('delivery.portal') }}" class="flex items-center space-x-3 px-4 py-2.5 text-xs font-mono text-cyan-400 hover:text-cyan-300 transition-colors" style="background: rgba(34,211,238,0.15);">
                                        <i class="fa-solid fa-truck-fast w-4 text-center text-cyan-400"></i>
                                        <span>Delivery Driver Console</span>
                                    </a>
                                @elseif(auth()->user()->isMechanic())
                                    <a href="{{ route('mechanic.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 text-xs font-mono text-orange-500 hover:text-orange-400 transition-colors" style="background: rgba(249,115,22,0.15);">
                                        <i class="fa-solid fa-wrench w-4 text-center text-orange-500"></i>
                                        <span>Mechanic Dashboard</span>
                                    </a>
                                @endif

                                @if(!auth()->user()->isManager())
                                    <a href="{{ route('portal.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 text-xs font-mono text-neutral-200 hover:text-white transition-colors" style="background: transparent;" onmouseover="this.style.background='rgba(255,255,255,0.07)'" onmouseout="this.style.background='transparent'">
                                        <i class="fa-solid fa-headset text-red-500 w-4 text-center"></i>
                                        <span>Portal VIP &amp; Konsultasi (Chat)</span>
                                    </a>
                                @endif
                                    <a href="{{ route('profile.complete') }}" class="flex items-center space-x-3 px-4 py-2.5 text-xs font-mono text-neutral-200 hover:text-white transition-colors" style="background: transparent;" onmouseover="this.style.background='rgba(255,255,255,0.07)'" onmouseout="this.style.background='transparent'">
                                        <i class="fa-solid fa-user-pen text-red-500 w-4 text-center"></i>
                                        <span>Profil &amp; Alamat VIP</span>
                                    </a>
                                <a href="{{ route('faq') }}" class="flex items-center space-x-3 px-4 py-2.5 text-xs font-mono text-neutral-200 hover:text-white transition-colors" style="background: transparent;" onmouseover="this.style.background='rgba(255,255,255,0.07)'" onmouseout="this.style.background='transparent'">
                                    <i class="fa-solid fa-circle-question text-red-500 w-4 text-center"></i>
                                    <span>Bantuan &amp; FAQ</span>
                                </a>
                                <div class="border-t my-1" style="border-color: rgba(255,255,255,0.08);"></div>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center space-x-3 px-4 py-2.5 text-xs font-mono text-red-400 hover:text-red-300 transition-colors cursor-pointer text-left" style="background: transparent;" onmouseover="this.style.background='rgba(220,38,38,0.08)'" onmouseout="this.style.background='transparent'">
                                        <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i>
                                        <span>KELUAR / LOGOUT</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- GUEST: Show login button --}}
                    <a href="{{ route('login') }}" id="navLoginBtn" class="inline-flex items-center justify-center px-4 py-2 text-xs tracking-widest font-bold uppercase border border-red-600 text-red-500 hover:bg-red-600 hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> LOGIN / REGISTER
                    </a>
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
                            <button onclick="window.location.href='/inquire'" class="px-8 py-3.5 border border-white/30 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 backdrop-blur-sm">
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
                            <button onclick="window.location.href='/inquire'" class="px-8 py-3.5 border border-white/30 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 backdrop-blur-sm">
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
                            <button onclick="window.location.href='/inquire'" class="px-8 py-3.5 border border-white/30 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 backdrop-blur-sm">
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
                            <button onclick="window.location.href='/inquire'" class="px-8 py-3.5 border border-white/30 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 backdrop-blur-sm">
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
                            <button onclick="window.location.href='/inquire'" class="px-8 py-3.5 border border-white/30 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 backdrop-blur-sm">
                                REQUEST QUOTE
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 6: CHEVROLET CAMARO -->
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0" data-index="5">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0c] via-black/40 to-black/60 z-10"></div>
                <img src="{{ asset('images/carousell/carousell6.webp') }}" alt="Chevrolet Camaro" class="w-full h-full object-cover object-center transform scale-100 transition-transform duration-[8000ms] ease-out hero-img">
                <div class="absolute inset-0 z-20 flex flex-col justify-end max-w-7xl mx-auto px-6 lg:px-8 pb-16 lg:pb-24">
                    <div class="space-y-4 max-w-3xl">
                        <div class="flex items-center space-x-3">
                            <span class="red-divider-line"></span>
                            <span class="text-xs font-mono tracking-[0.3em] uppercase text-red-500 font-bold">AMERICAN MUSCLE LEGACY</span>
                        </div>
                        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black font-serif tracking-tight text-white uppercase leading-none drop-shadow-2xl">
                            CHEVROLET CAMARO
                        </h1>
                        <p class="text-base sm:text-lg text-neutral-300 font-light max-w-xl">
                            Raw American muscle power with bold styling. An icon of performance and aggressive road presence.
                        </p>
                        <div class="pt-4 flex flex-wrap gap-4 items-center">
                            <button onclick="openCarDetails('Chevrolet Camaro')" class="px-8 py-3.5 bg-red-600 hover:bg-red-700 text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 flex items-center shadow-lg shadow-red-600/30">
                                EXPLORE MODEL <i class="fa-solid fa-arrow-right ml-3"></i>
                            </button>
                            <button onclick="window.location.href='/inquire'" class="px-8 py-3.5 border border-white/30 hover:border-white text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 backdrop-blur-sm">
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
                        <button onclick="setSlide(5)" class="w-4 h-1 bg-white/30 hover:bg-white transition-all rounded-full dot-indicator" aria-label="Slide 6"></button>
                    </div>
                    <span class="text-xs font-mono text-neutral-400 pl-2" id="slide-counter">01 / 06</span>
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
             HERO CAROUSEL LOGIC
             ========================================== -->
        <script>
            let currentSlide = 0;
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.dot-indicator');
            const counter = document.getElementById('slide-counter');
            const totalSlides = slides.length;
            let slideInterval;

            function updateCarousel() {
                // Update slides
                slides.forEach((slide, index) => {
                    const img = slide.querySelector('img.hero-img');
                    if (index === currentSlide) {
                        slide.classList.remove('opacity-0', 'z-0');
                        slide.classList.add('opacity-100', 'z-10');
                        if (img) {
                            img.classList.remove('scale-100');
                            img.classList.add('scale-105');
                        }
                    } else {
                        slide.classList.remove('opacity-100', 'z-10');
                        slide.classList.add('opacity-0', 'z-0');
                        if (img) {
                            img.classList.remove('scale-105');
                            img.classList.add('scale-100');
                        }
                    }
                });

                // Update dots
                dots.forEach((dot, index) => {
                    if (index === currentSlide) {
                        dot.className = 'w-10 h-1 bg-red-600 transition-all rounded-full dot-indicator';
                    } else {
                        dot.className = 'w-4 h-1 bg-white/30 hover:bg-white transition-all rounded-full dot-indicator';
                    }
                });

                // Update counter
                if (counter) {
                    counter.innerText = `0${currentSlide + 1} / 0${totalSlides}`;
                }
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateCarousel();
                resetInterval();
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateCarousel();
                resetInterval();
            }

            function setSlide(index) {
                currentSlide = index;
                updateCarousel();
                resetInterval();
            }

            function resetInterval() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 8000);
            }

            // Initialize auto slide
            if(totalSlides > 0) {
                resetInterval();
            }
        </script>


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
                    @php
                        $sortedCars = $cars->sortBy(function($car) {
                            if ($car->status === 'available') return 0;
                            if ($car->status === 'sold') return 2;
                            return 1; // reserved, coming_soon, etc
                        });
                    @endphp
                    @foreach($sortedCars as $car)
                    <div class="car-card glass-card group cursor-pointer overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="{{ $car->brand }}" data-price="{{ $car->price }}" data-condition="{{ $car->category }}" onclick="openCarInspector('{{ $car->id }}')">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ $car->image_url ? asset(ltrim($car->image_url, '/')) : asset('images/no-image.png') }}" alt="{{ $car->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            @php
                                $statusColor = 'bg-red-600 text-white';
                                $statusText = 'AVAILABLE';
                                if ($car->status === 'sold') {
                                    $statusColor = 'bg-neutral-900/80 text-neutral-400 border border-neutral-500/50 backdrop-blur-sm';
                                    $statusText = 'SOLD OUT';
                                } elseif ($car->status !== 'available') {
                                    $statusColor = 'bg-amber-500/20 text-amber-400 border border-amber-500/50 backdrop-blur-sm';
                                    $statusText = 'COMING SOON';
                                }
                            @endphp
                            <div class="absolute top-3 left-3 {{ $statusColor }} text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md flex items-center space-x-1">
                                <span>{{ $statusText }}</span>
                            </div>

                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                {{ $car->year }}
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white text-xs font-mono font-bold tracking-widest flex items-center">
                                    <i class="fa-solid fa-eye text-red-500 mr-2"></i> INSPECT COLORS & BODYKITS
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">{{ $car->year }} • {{ $car->brand }}</span>
                                    <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                        {{ $car->name }}
                                    </h4>
                                </div>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3">
                                <div class="text-[10px] font-mono text-neutral-600 dark:text-neutral-400">ESTIMATED PRICE</div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500">
                                    IDR {{ number_format($car->price, 0, ',', '.') }}
                                </div>
                            </div>

                            @if(is_array($car->specs) && count($car->specs) > 0)
                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                @php
                                    $specKeys = array_keys($car->specs);
                                    $showSpecs = array_slice($specKeys, 0, 2);
                                @endphp
                                @foreach($showSpecs as $key)
                                    @php
                                        $specVal = is_array($car->specs[$key]) ? ($car->specs[$key]['val'] ?? '') : $car->specs[$key];
                                    @endphp
                                    <div><i class="fa-solid fa-check mr-1 text-red-600"></i> {{ \Illuminate\Support\Str::limit($specVal, 15) }}</div>
                                @endforeach
                            </div>
                            @endif

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="event.stopPropagation(); openCarInspector('{{ $car->id }}');" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE & INSPECT
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach

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
                        <img src="{{ asset('images/limited-edition.webp') }}" alt="Ferrari Roma Spider" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent p-6 flex flex-col justify-end">
                            <span class="text-[10px] font-mono text-red-500 tracking-widest uppercase font-bold">LIMITED EDITION</span>
                            <h3 class="text-xl font-bold font-serif text-white">Ferrari Roma Spider</h3>
                            <p class="text-xs text-neutral-300 font-light">La Nuova Dolce Vita in Italy</p>
                        </div>
                    </div>

                    <!-- SPOTLIGHT ITEM 2 -->
                    <div class="group relative overflow-hidden bg-neutral-900 h-64 border border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll">
                        <img src="{{ asset('images/hybrid-innovation.webp') }}" alt="Ferrari 296 GTS" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent p-6 flex flex-col justify-end">
                            <span class="text-[10px] font-mono text-red-500 tracking-widest uppercase font-bold">HYBRID INNOVATION</span>
                            <h3 class="text-xl font-bold font-serif text-white">Ferrari 296 GTS</h3>
                            <p class="text-xs text-neutral-300 font-light">Fun to drive redefined with V6 Turbo</p>
                        </div>
                    </div>

                    <!-- SPOTLIGHT ITEM 3 -->
                    <div class="group relative overflow-hidden bg-neutral-900 h-64 border border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll">
                        <img src="{{ asset('images/exclusivity.webp') }}" alt="Ferrari Portofino M" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent p-6 flex flex-col justify-end">
                            <span class="text-[10px] font-mono text-red-500 tracking-widest uppercase font-bold">EXCLUSIVITY</span>
                            <h3 class="text-xl font-bold font-serif text-white">Ferrari Portofino M</h3>
                            <p class="text-xs text-neutral-300 font-light">Evolution of grand touring open top</p>
                        </div>
                    </div>

                </div>

                <div class="text-right">
                    <button onclick="window.location.href='/inquire'" class="inline-flex items-center text-xs font-mono tracking-widest text-neutral-300 hover:text-red-500 transition-colors uppercase font-bold">
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
                            <img src="{{ asset('images/book_a_service.webp') }}" alt="Book a Service" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
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
                            <img src="{{ asset('images/a-long-term-plan.webp') }}" alt="Long Term Plan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
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
                            <img src="{{ asset('images/service.webp') }}" alt="Performance Tuning" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
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
                                <a href="{{ route('service.create') }}" class="inline-flex items-center text-xs font-mono text-neutral-900 dark:text-neutral-300 hover:text-red-600 font-semibold tracking-wider">
                                    <i class="fa-solid fa-chevron-right text-red-600 mr-2 text-[10px]"></i> INQUIRE ACCESSORIES / SERVICE
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
                        <span class="text-xs font-mono tracking-[0.3em] uppercase text-red-500 font-bold">CIJEUNGJING HEADQUARTERS</span>
                        <span class="red-divider-line"></span>
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-serif font-black text-white uppercase tracking-tight">
                        PT Apex Automotive Indonesia
                    </h2>
                    <p class="text-sm font-mono text-red-500 font-bold uppercase tracking-widest">
                        OFFICIAL LUXURY SHOWROOM & HYPERCAR DEALER IN CIJEUNGJING
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    
                    <!-- LEFT COLUMN: ADDRESS & DETAILS -->
                    <div class="relative h-[380px] rounded-none border border-white/10 overflow-hidden reveal-on-scroll">
                        <!-- Dealer Leaflet Map (Full Background) -->
                        <div id="dealerMap" class="absolute inset-0 z-0 bg-neutral-900 map-dark-filter"></div>

                        <!-- Permanent Dark Gradient Overlay for readability -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/70 to-transparent z-10 pointer-events-none"></div>

                        <!-- Content always visible -->
                        <div class="absolute inset-0 z-20 flex flex-col justify-end p-6 bg-transparent pointer-events-none">
                            
                            <div class="space-y-2 pointer-events-auto">
                                <h3 class="text-lg font-bold font-serif text-white tracking-wide flex items-center drop-shadow-md">
                                    <i class="fa-solid fa-location-dot text-red-500 mr-2"></i> APEX AUTOMOTIVE
                                </h3>
                                <p class="text-[10px] text-neutral-300 font-mono leading-relaxed drop-shadow-md">
                                    Jl. Raya Banjar - Dsn. Kidul RT09 RW04 Cijeungjing, Ciamis, Jawa Barat
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-4 pt-4 mt-4 border-t border-white/20 text-[10px] font-mono drop-shadow-md pointer-events-auto">
                                <div>
                                    <span class="text-neutral-400 block font-semibold mb-1">OPERATING HOURS:</span>
                                    <span class="text-white block">Mon-Sat: 08:30-20:00</span>
                                    <span class="text-neutral-400 block">Sun: By Appointment</span>
                                </div>
                                <div>
                                    <span class="text-neutral-400 block font-semibold mb-1">HOTLINE:</span>
                                    <span class="text-red-500 font-bold block">+62 21 555 9988</span>
                                    <span class="text-white font-bold block">+62 811 8888 999</span>
                                </div>
                            </div>

                            <div class="pt-4 mt-2 flex gap-3 pointer-events-auto">
                                <a href="{{ route('service.create') }}" class="flex-1 px-3 py-3 bg-red-600 hover:bg-red-700 text-white text-[9px] tracking-widest font-bold uppercase transition-all duration-300 flex items-center justify-center shadow-lg shadow-red-600/30">
                                    <i class="fa-solid fa-calendar-check mr-2"></i> BOOK APPT
                                </a>
                                <a href="https://maps.google.com/?q={{ $dealer_lat ?? '-7.3274' }},{{ $dealer_lng ?? '108.3225' }}" target="_blank" class="flex-1 px-3 py-3 border border-white/30 hover:border-white text-white text-[9px] tracking-widest font-bold uppercase transition-all duration-300 flex items-center justify-center backdrop-blur-md bg-black/50">
                                    <i class="fa-solid fa-map-location mr-2"></i> DIRECTIONS
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN: 360 VIRTUAL TOUR CARD -->
                    <div id="showroom360Card" class="relative h-[380px] rounded-none overflow-hidden border border-white/10 group reveal-on-scroll" style="cursor:pointer;">
                        <img src="{{ asset('images/experience-showroom.webp') }}"
                             alt="Showroom Exterior"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                             draggable="false">
                        <!-- Gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                        <!-- Content layer -->
                        <div class="absolute inset-0 p-8 flex flex-col justify-between">
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
                                <span class="mt-2 text-xs font-mono tracking-widest text-red-500 font-bold uppercase inline-flex items-center">
                                    LAUNCH VIRTUAL EXPERIENCE <i class="fa-solid fa-arrow-right ml-2"></i>
                                </span>
                            </div>
                        </div>
                        {{-- Transparent clickable button — sits on top of all content, guaranteed to catch clicks --}}
                        <button type="button"
                                onclick="console.log('Card button clicked'); open360ShowroomModal();"
                                aria-label="Launch 360 Virtual Showroom Tour"
                                style="position:absolute;inset:0;width:100%;height:100%;background:transparent;border:none;cursor:pointer;z-index:20;"></button>
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
                        {{ \App\Models\Setting::where('key', 'footer_desc')->value('value') ?? 'Official Cijeungjing luxury supercar showroom. Authorized partner for high-performance exotics, certified pre-owned supercars, and factory-trained racing maintenance.' }}
                    </p>
                    <div class="flex space-x-4 pt-2 text-base text-neutral-400">
                        <a href="{{ \App\Models\Setting::where('key', 'social_instagram')->value('value') ?? '#' }}" class="hover:text-red-500 transition-colors"><i class="fa-brands fa-instagram"></i></a>
                        <a href="{{ \App\Models\Setting::where('key', 'social_youtube')->value('value') ?? '#' }}" class="hover:text-red-500 transition-colors"><i class="fa-brands fa-youtube"></i></a>
                        <a href="{{ \App\Models\Setting::where('key', 'social_facebook')->value('value') ?? '#' }}" class="hover:text-red-500 transition-colors"><i class="fa-brands fa-facebook"></i></a>
                        <a href="{{ \App\Models\Setting::where('key', 'social_linkedin')->value('value') ?? '#' }}" class="hover:text-red-500 transition-colors"><i class="fa-brands fa-linkedin"></i></a>
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
                        <li><a href="#" class="hover:text-white transition-colors">Chevrolet Camaro</a></li>
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
    <div id="carInspectorModal" onclick="if(event.target === this) toggleModal('carInspectorModal')" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/90 backdrop-blur-xl p-4 sm:p-6 transition-all duration-300">
        <div onclick="event.stopPropagation()" class="glass-card max-w-5xl w-full p-6 sm:p-8 border border-neutral-300 dark:border-white/20 shadow-2xl relative max-h-[92vh] overflow-y-auto">
            
            <!-- CLOSE BUTTON -->
            <button onclick="toggleModal('carInspectorModal')" class="absolute top-5 right-5 text-neutral-500 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white text-xl z-20">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- LEFT COLUMN: CAR EXTERIOR PREVIEW CANVAS & INTERIOR PREVIEW BELOW IT -->
                <div class="lg:col-span-7 space-y-3">
                    <!-- MAIN INSPECT CAR IMAGE CANVAS -->
                    <div class="relative h-64 sm:h-80 rounded-lg overflow-hidden bg-neutral-950 border border-neutral-300 dark:border-white/10 group shadow-2xl">
                        <img id="inspectCarImg" src="" alt="Car Inspection Preview" class="car-inspect-img w-full h-full object-cover cursor-zoom-in transition-transform duration-300" onclick="openZoomModal(this.src, 'CAR EXTERIOR INSPECTION')">
                        
                        <!-- BADGE TOP LEFT -->
                        <div class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-mono font-bold px-3 py-1 uppercase tracking-widest shadow-lg flex items-center space-x-1.5 z-10">
                            <span id="inspectCondition">BRAND NEW</span>
                            <span id="inspectDiscountBadge" class="bg-black/50 text-amber-300 px-1.5 py-0.5 rounded text-[9px] font-extrabold hidden">-10% OFF</span>
                        </div>

                        <!-- BADGE TOP RIGHT (YEAR ONLY) -->
                        <div class="absolute top-4 right-4 z-10 font-mono text-xs">
                            <span id="inspectYear" class="bg-black/80 backdrop-blur-md text-neutral-200 px-3 py-1 border border-white/20 rounded">2025</span>
                        </div>

                        <!-- COLOR & SPEC OVERLAY BOTTOM LEFT (SUBTLE) -->
                        <div class="absolute bottom-3 left-3 pointer-events-none bg-black/40 backdrop-blur-sm px-2.5 py-1.5 border border-white/10 rounded font-mono text-[9px] leading-relaxed space-y-0.5 z-10 max-w-[220px]">
                            <div class="text-neutral-300 tracking-wider truncate">
                                COLOR: <span id="inspectColorOverlay" class="font-bold uppercase text-white/90">--</span>
                            </div>
                            <div class="text-neutral-400 tracking-wider truncate">
                                SPEC: <span id="inspectSpecOverlay" class="font-bold uppercase text-white/90">FACTORY STOCK SPEC</span>
                            </div>
                        </div>

                    </div>

                    <!-- GRID COLLAGE BELOW MAIN CAR: INTERIOR & ENGINE -->
                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <!-- INTERIOR CABIN -->
                        <div class="rounded-lg overflow-hidden border border-neutral-300 dark:border-white/10 bg-neutral-950 p-1.5 relative">
                            <div class="h-28 sm:h-36 rounded overflow-hidden relative cursor-zoom-in">
                                <img id="inspectInteriorImg" src="" alt="Interior View" class="w-full h-full object-cover" onclick="openZoomModal(this.src, 'INTERIOR CABIN')">
                                <span class="absolute bottom-1.5 left-2 text-[9px] font-mono font-bold text-white/90 bg-black/70 px-1.5 py-0.5 rounded shadow-md border border-white/10 uppercase tracking-wider pointer-events-none">INTERIOR CABIN</span>
                            </div>
                        </div>

                        <!-- ENGINE BAY -->
                        <div class="rounded-lg overflow-hidden border border-neutral-300 dark:border-white/10 bg-neutral-950 p-1.5 relative">
                            <div class="h-28 sm:h-36 rounded overflow-hidden relative cursor-zoom-in">
                                <img id="inspectEngineImg" src="" alt="Engine Bay View" class="w-full h-full object-cover" onclick="openZoomModal(this.src, 'ENGINE BAY')">
                                <span class="absolute bottom-1.5 left-2 text-[9px] font-mono font-bold text-white/90 bg-black/70 px-1.5 py-0.5 rounded shadow-md border border-white/10 uppercase tracking-wider pointer-events-none">ENGINE BAY</span>
                            </div>
                        </div>
                    </div>

                    <!-- FULL PERFORMANCE SPECS GRID WITH ALL INFO LINK AT BOTTOM -->
                    <div class="space-y-2 pt-3 border-t border-neutral-200 dark:border-white/10">
                        <span class="text-xs font-mono font-bold uppercase tracking-wider text-neutral-700 dark:text-neutral-300 block">KEY PERFORMANCE SPECS:</span>
                        <div id="inspectSpecsGrid" class="grid grid-cols-2 gap-2 text-[11px] font-mono">
                            <!-- Dynamic specs injected by JS -->
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




                    <!-- ACTION BUTTONS INCLUDING MODIFY GARAGE BUTTON -->
                    <div class="pt-2 w-full space-y-2">
                        <!-- CUSTOMIZE / MODIFY GARAGE BUTTON -->
                        <button id="inspectModifyGarageBtn" onclick="openGarageStudio()" class="w-full py-3 bg-neutral-900 hover:bg-neutral-800 text-white font-bold text-xs tracking-widest uppercase transition-all flex items-center justify-center gap-2 border border-neutral-700 dark:border-white/20">
                            <i class="fa-solid fa-wrench text-neutral-400"></i>
                            <span>MODIFY (GARAGE STUDIO)</span>
                            <i class="fa-solid fa-arrow-right ml-1"></i>
                        </button>

                        @if(auth()->check() && (auth()->user()->isRm() || auth()->user()->isManager() || auth()->user()->isDelivery()))
                            <button type="button" disabled class="w-full py-3.5 bg-neutral-900/90 text-neutral-400 font-bold text-xs tracking-widest uppercase cursor-not-allowed flex items-center justify-center border border-red-900/50 shadow-lg">
                                <i class="fa-solid fa-lock mr-2 text-red-500"></i> BOOKING DINONAKTIFKAN (AKUN STAFF)
                            </button>
                        @else
                            <div id="inspectActionButtonsContainer" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <button onclick="bookCarWithSelectedConfig()" class="py-3 bg-red-600 hover:bg-red-700 text-white font-bold text-xs tracking-widest uppercase transition-all shadow-lg shadow-red-600/30 flex items-center justify-center">
                                    <i class="fa-solid fa-calendar-check mr-2"></i> BOOK THIS SPEC
                                </button>
                                <button onclick="window.location.href='/inquire'" class="py-3 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 font-bold text-xs tracking-widest uppercase transition-colors flex items-center justify-center">
                                    REQUEST QUOTE
                                </button>
                            </div>
                            <div id="inspectComingSoonContainer" class="hidden">
                                <button type="button" disabled class="w-full py-3 bg-neutral-900/80 text-amber-500 font-bold text-[10px] sm:text-xs tracking-widest uppercase cursor-not-allowed flex items-center justify-center border border-amber-500/30 shadow-lg">
                                    <i class="fa-solid fa-clock mr-2"></i> VEHICLE COMING SOON - NOT YET AVAILABLE
                                </button>
                            </div>
                            <div id="inspectSoldContainer" class="hidden">
                                <button type="button" disabled class="w-full py-3 bg-neutral-900/80 text-neutral-500 font-bold text-[10px] sm:text-xs tracking-widest uppercase cursor-not-allowed flex items-center justify-center border border-neutral-500/30 shadow-lg">
                                    <i class="fa-solid fa-ban mr-2"></i> VEHICLE SOLD OUT
                                </button>
                            </div>
                        @endif
                    </div>


    <!-- ==========================================
         FULLSCREEN IMAGE ZOOM & INSPECT LIGHTBOX MODAL (SIMPLE LIGHTBOX)
         ========================================== -->
    <div id="imageZoomModal" onclick="closeZoomModal()" class="fixed inset-0 hidden flex flex-col items-center justify-center bg-black/90 backdrop-blur-md p-4 sm:p-8 cursor-pointer select-none overflow-hidden" style="z-index: 99999;">
        <!-- IMAGE CANVAS CONTAINER -->
        <div class="w-full h-full flex items-center justify-center p-2 sm:p-6">
            <img id="zoomModalImg" src="" alt="Inspect Preview" class="max-w-full max-h-[90vh] object-contain shadow-2xl rounded-lg border border-white/20 transition-transform duration-200">
        </div>
    </div>


    <!-- ==========================================`n         JAVASCRIPT CONTROLLER
         ========================================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('inquireForm');
            if (form) {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const btn = document.getElementById('inquireSubmitBtn');
                    const successDiv = document.getElementById('inquireSuccess');
                    
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>MENGIRIM...</span>';

                    const formData = new FormData(form);

                    try {
                        const response = await fetch('{{ route('inquire.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const result = await response.json();

                        if (result.success) {
                            successDiv.classList.remove('hidden');
                            btn.classList.add('hidden');
                            setTimeout(() => {
                                toggleModal('inquireModal');
                                @auth
                                    window.location.href = "{{ route('portal.dashboard') }}";
                                @else
                                    successDiv.classList.add('hidden');
                                    btn.classList.remove('hidden');
                                    btn.disabled = false;
                                    btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> <span>SUBMIT REQUEST</span>';
                                @endauth
                            }, 1500);
                        } else {
                            alert(result.message || 'Gagal mengirim permintaan.');
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> <span>SUBMIT REQUEST</span>';
                        }
                    } catch (err) {
                        alert('Terjadi kesalahan koneksi.');
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> <span>SUBMIT REQUEST</span>';
                    }
                });
            }
        });

        // 0. COMPREHENSIVE CAR DATABASE (STRICT SEPARATION: ONLY FILES WITH bodykit_ ARE BODYKITS)
        const CAR_DATABASE = {
            @foreach($cars as $car)
            '{{ $car->id }}': {
                brand: '{{ addslashes($car->brand) }}',
                model: '{{ addslashes($car->name) }}',
                year: '{{ $car->year }}',
                originalPriceNum: {{ $car->price + ($car->price * 0.10) }},
                finalPriceNum: {{ $car->price }},
                discountPct: '10%',
                condition: '{{ $car->category ?? "NEW" }}',
                status: '{{ $car->status }}',
                interior: "{{ asset('images/interior/interior_bmw.webp') }}",
                engine: "{{ asset('images/mesin/mesin_bmw.webp') }}",
                specs: [
                    @if(is_array($car->specs) && count($car->specs) > 0)
                        @foreach($car->specs as $label => $v)
                            @php
                                $specVal = is_array($v) ? ($v['val'] ?? '') : $v;
                                $specIcon = is_array($v) ? ($v['icon'] ?? 'fa-circle-info') : 'fa-circle-info';
                            @endphp
                            { label: '{{ addslashes(strtoupper($label)) }}', val: '{{ addslashes($specVal) }}', icon: '{{ addslashes($specIcon) }}' },
                        @endforeach
                    @else
                        { label: 'ENGINE', val: 'Standard', icon: 'fa-gears' }
                    @endif
                ],
                colors: [
                    @foreach($car->variants->whereIn('type', ['color', 'primer']) as $v)
                        { name: '{{ addslashes($v->name ?? "Color") }}', hex: '{{ $v->hex }}', img: "{{ $v->image_url ? asset(ltrim($v->image_url, '/')) : asset('images/no-image.png') }}" },
                    @endforeach
                ],
                bodykits: [
                    @php $kCount = 1; @endphp
                    @foreach($car->variants->where('type', 'bodykit') as $index => $v)
                        { num: 'KIT 0{{ $kCount++ }}', name: '{{ addslashes($v->name ?? "Bodykit") }}', img: "{{ $v->image_url ? asset(ltrim($v->image_url, '/')) : asset('images/no-image.png') }}" },
                    @endforeach
                ]
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        };

        let currentInspectedCarKey = null;
        let currentSelectedColorName = null;
        let currentSelectedBodykitName = null;

        // 1. INTRO SCREEN DISMISSAL & PRICE DROPDOWN ANIMATION OBSERVER
        window.addEventListener('DOMContentLoaded', () => {
            const intro = document.getElementById('intro-screen');
            if (intro) {
                const hasSeenIntro = sessionStorage.getItem('apex_intro_seen');
                const isFreshAuthAction = {{ (session('welcome') || session('logged_out') || session('profile_success') || session('info')) ? 'true' : 'false' }};

                if (hasSeenIntro && !isFreshAuthAction) {
                    intro.style.display = 'none';
                    intro.remove();
                } else {
                    sessionStorage.setItem('apex_intro_seen', 'true');
                    setTimeout(() => {
                        intro.classList.add('opacity-0', 'pointer-events-none');
                        setTimeout(() => {
                            intro.remove();
                        }, 1000);
                    }, 2400);
                }
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


        // MODAL HANDLER
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');

                // Lock background body scroll when any modal popup is open
                const activeModals = document.querySelectorAll('#carInspectorModal:not(.hidden), #inquireModal:not(.hidden)');
                if (activeModals.length > 0) {
                    if (document.body.style.overflow !== 'hidden') {
                        const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
                        document.body.style.paddingRight = scrollbarWidth + 'px';
                        document.body.style.overflow = 'hidden';
                    }
                } else {
                    document.body.style.paddingRight = '';
                    document.body.style.overflow = '';
                }
            }
        }
        function openCarDetails(carName) {
            window.location.href = '/inquire?car_model=' + encodeURIComponent(carName);
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

            // Set link to ALL INFO & Full Docs Page
            const allInfoBtn = document.getElementById('inspectAllInfoBtn');
            if (allInfoBtn) {
                allInfoBtn.href = `/car-info/${carKey}`;
            }

            // Set Modify Garage Button visibility / behavior
            const garageBtn = document.getElementById('inspectModifyGarageBtn');
            if (garageBtn) {
                if (carKey === 'audi_r8') {
                    garageBtn.innerHTML = '<i class="fa-solid fa-wrench text-neutral-400"></i> <span>MODIFY (GARAGE STUDIO)</span> <i class="fa-solid fa-arrow-right ml-1"></i>';
                    garageBtn.className = "w-full py-3 bg-neutral-900 hover:bg-neutral-800 text-white font-bold text-xs tracking-widest uppercase transition-all flex items-center justify-center gap-2 border border-neutral-700 dark:border-white/20 cursor-pointer";
                    garageBtn.disabled = false;
                } else {
                    garageBtn.innerHTML = '<i class="fa-solid fa-lock text-neutral-500"></i> <span>MODIFY WHEELS (UNAVAILABLE FOR THIS MODEL)</span>';
                    garageBtn.className = "w-full py-3 bg-neutral-950 text-neutral-500 font-bold text-xs tracking-widest uppercase flex items-center justify-center gap-2 border border-white/5 cursor-not-allowed opacity-60";
                    garageBtn.disabled = true;
                }
            }

            // Handle Booking Button Visibility based on Status
            const btnAvailable = document.getElementById('inspectActionButtonsContainer');
            const btnComingSoon = document.getElementById('inspectComingSoonContainer');
            const btnSold = document.getElementById('inspectSoldContainer');

            if (btnAvailable && btnComingSoon && btnSold) {
                btnAvailable.classList.add('hidden');
                btnComingSoon.classList.add('hidden');
                btnSold.classList.add('hidden');

                if (car.status === 'sold') {
                    btnSold.classList.remove('hidden');
                } else if (car.status === 'available') {
                    btnAvailable.classList.remove('hidden');
                } else {
                    // Treat 'reserved', 'coming_soon', etc as COMING SOON
                    btnComingSoon.classList.remove('hidden');
                }
            }

            // Set Interior & Engine Image Preview directly below main car card
            const interiorImg = document.getElementById('inspectInteriorImg');
            if (interiorImg && car.interior) {
                interiorImg.src = car.interior;
            }
            const engineImg = document.getElementById('inspectEngineImg');
            if (engineImg && car.engine) {
                engineImg.src = car.engine;
            }

            // Set Handle Discount & Strikethrough Price in Modal
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

            const specsGrid = document.getElementById('inspectSpecsGrid');
            specsGrid.innerHTML = car.specs.slice(0, 5).map(s => `
                <div class="bg-neutral-100 dark:bg-neutral-900/60 p-2 border border-neutral-200 dark:border-white/5">
                    <span class="text-neutral-500 text-[9px] flex items-center uppercase"><i class="fa-solid ${s.icon || 'fa-circle-info'} text-red-500 mr-1.5 text-[10px]"></i>${s.label}</span>
                    <span class="font-bold text-neutral-900 dark:text-neutral-200 mt-0.5 block">${s.val}</span>
                </div>
            `).join('');
            
            specsGrid.innerHTML += `
                <a href="/car-info/${carKey}" class="bg-neutral-200/50 dark:bg-neutral-900/30 p-2 border border-neutral-300/50 dark:border-white/5 flex items-center justify-center text-neutral-500 hover:text-neutral-600 dark:hover:text-neutral-400 transition-colors opacity-75 hover:opacity-100" style="text-decoration: none;">
                    <span class="text-[10px] font-bold tracking-widest text-neutral-500">Read all description</span>
                </a>
            `;

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

            if (img) {
                img.style.opacity = '0.2';
                img.style.transform = 'scale(0.97)';
                setTimeout(() => {
                    img.src = selectedColor.img;
                    img.style.opacity = '1';
                    img.style.transform = 'scale(1)';
                }, 150);
            }

            const colorOverlay = document.getElementById('inspectColorOverlay');
            const specOverlay = document.getElementById('inspectSpecOverlay');

            if (colorOverlay) {
                colorOverlay.innerText = selectedColor.name;
            }

            if (specOverlay) {
                specOverlay.innerText = 'FACTORY STOCK SPEC';
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
            if (img) {
                img.style.opacity = '0.2';
                img.style.transform = 'scale(0.97)';
                setTimeout(() => {
                    img.src = selectedKit.img;
                    img.style.opacity = '1';
                    img.style.transform = 'scale(1)';
                }, 150);
            }

            const colorOverlay = document.getElementById('inspectColorOverlay');
            const specOverlay = document.getElementById('inspectSpecOverlay');

            if (specOverlay) {
                specOverlay.innerText = `${selectedKit.num}: ${selectedKit.name}`;
            }

            if (colorOverlay) {
                colorOverlay.innerText = 'MODIFIED AERO FINISH';
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

        function openGarageStudio() {
            if (currentInspectedCarKey !== 'audi_r8') return;

            // Trigger Peak Wave transition animation then redirect to garage studio
            triggerPixelWaveTransition();
            setTimeout(() => {
                window.location.href = "{{ route('garage') }}";
            }, 500);
        }

                function bookCarWithSelectedConfig() {
            @if(auth()->check() && (auth()->user()->isRm() || auth()->user()->isManager() || auth()->user()->isDelivery()))
                alert('Akun Staff (Sales RM / Delivery Driver) tidak dapat melakukan booking unit kendaraan.');
                return;
            @endif

            const car = CAR_DATABASE[currentInspectedCarKey];
            if (!car) return;

            let selectedConfig = 'Selected Spec: ';
            if (currentSelectedBodykitName) {
                selectedConfig += 'Bodykit Package (' + currentSelectedBodykitName + ') for ' + car.brand + ' ' + car.model;
            } else if (currentSelectedColorName) {
                selectedConfig += 'Exterior Paint (' + currentSelectedColorName + ') for ' + car.brand + ' ' + car.model;
            } else {
                selectedConfig += 'Standard Factory Spec for ' + car.brand + ' ' + car.model;
            }
            
            const carModel = car.brand + ' ' + car.model;
            window.location.href = '/inquire?car_model=' + encodeURIComponent(carModel) + '&config=' + encodeURIComponent(selectedConfig);
        }

        // 9. USER ACCOUNT DROPDOWN (click-based, solid background)
        function toggleUserDropdown() {
            const menu = document.getElementById('userDropdownMenu');
            const chevron = document.getElementById('userDropdownChevron');
            if (!menu) return;
            const isOpen = !menu.classList.contains('hidden');
            if (isOpen) {
                menu.classList.add('hidden');
                if (chevron) chevron.style.transform = 'rotate(0deg)';
            } else {
                menu.classList.remove('hidden');
                if (chevron) chevron.style.transform = 'rotate(180deg)';
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const wrapper = document.getElementById('userDropdownWrapper');
            const menu = document.getElementById('userDropdownMenu');
            const chevron = document.getElementById('userDropdownChevron');
            if (wrapper && menu && !wrapper.contains(e.target)) {
                menu.classList.add('hidden');
                if (chevron) chevron.style.transform = 'rotate(0deg)';
            }
        });

        // 10. FERRARI-STYLE SCROLL SECTION NAVIGATOR JS
        function scrollToSection(selector) {
            const el = document.querySelector(selector);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth' });
            }
        }

        function updateScrollNavVisibility() {
            const navEl = document.getElementById('apexScrollNavigator');
            const etalaseSec = document.getElementById('certified-suggestions');
            if (navEl) {
                if (etalaseSec) {
                    const etalaseTop = etalaseSec.getBoundingClientRect().top;
                    if (etalaseTop <= window.innerHeight * 0.75) {
                        navEl.classList.add('visible');
                    } else {
                        navEl.classList.remove('visible');
                    }
                } else {
                    const scrollTop = window.scrollY || document.documentElement.scrollTop;
                    if (scrollTop > 300) {
                        navEl.classList.add('visible');
                    } else {
                        navEl.classList.remove('visible');
                    }
                }
            }
        }

        window.addEventListener('scroll', function() {
            updateScrollNavVisibility();

            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollPercent = scrollHeight > 0 ? (scrollTop / scrollHeight) : 0;

            // 1. Update SVG Progress Ring (Radius 12 => Circumference ~ 75.39)
            const ring = document.getElementById('scrollProgressRing');
            if (ring) {
                const circumference = 75.39;
                const offset = circumference - (scrollPercent * circumference);
                ring.style.strokeDashoffset = offset;
            }

            // 2. Dynamic Section Detection & Inline Active Label Sync
            const sections = [
                { id: '#hero-carousel', label: 'SHOWROOM' },
                { id: '#certified-suggestions', label: 'PRE-OWNED' },
                { id: '#spotlight', label: 'EXOTIC MODELS' },
                { id: '#services', label: 'AFTER SALES' },
                { id: '#dealer-location', label: 'DEALER LOCATOR' }
            ];

            let currentActiveIndex = 0;
            const viewThreshold = window.innerHeight * 0.35;

            sections.forEach((sec, idx) => {
                const el = document.querySelector(sec.id);
                if (el) {
                    const rect = el.getBoundingClientRect();
                    if (rect.top <= viewThreshold && rect.bottom >= 0) {
                        currentActiveIndex = idx;
                    }
                }
            });

            // Re-render dots list, highlighting active
            const dotsContainer = document.getElementById('navInactiveDots');
            if (dotsContainer) {
                dotsContainer.innerHTML = sections
                    .map((sec, idx) => {
                        const isActive = idx === currentActiveIndex;
                        const opacityStyle = isActive ? 'opacity: 1; transform: scale(1.4); background-color: #dc2626;' : '';
                        return `<div class="nav-dot-item" style="${opacityStyle}" onclick="scrollToSection('${sec.id}')" title="${sec.label}"></div>`;
                    })
                    .join('');
            }
        });

        // Initialize visibility on page load
        document.addEventListener('DOMContentLoaded', updateScrollNavVisibility);
        updateScrollNavVisibility();

        // 11. FULLSCREEN IMAGE ZOOM & INSPECT LIGHTBOX SCRIPT WITH MOUSE WHEEL ZOOM & PAN
        // 11. FULLSCREEN LIGHTBOX IMAGE PREVIEW (SIMPLE WHATSAPP / IDE STYLE WITH ZOOM)
        let modalZoomScale = 1;

        function openZoomModal(imageSrc) {
            if (!imageSrc) return;
            const modal = document.getElementById('imageZoomModal');
            const img = document.getElementById('zoomModalImg');

            if (img) {
                img.src = imageSrc;
                modalZoomScale = 1; // Reset scale
                img.style.transform = `scale(${modalZoomScale})`;
            }

            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeZoomModal() {
            const modal = document.getElementById('imageZoomModal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        // Mouse Wheel Zoom
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('imageZoomModal');
            if (!modal) return;

            modal.addEventListener('wheel', function(e) {
                // Prevent page scroll when modal is open
                if (!modal.classList.contains('hidden')) {
                    e.preventDefault();
                    
                    const img = document.getElementById('zoomModalImg');
                    if (img) {
                        const delta = e.deltaY < 0 ? 0.2 : -0.2;
                        modalZoomScale = Math.min(Math.max(0.5, modalZoomScale + delta), 4.0);
                        img.style.transform = `scale(${modalZoomScale})`;
                    }
                }
            }, { passive: false });
        });

        // Close on ESC key press
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeZoomModal();
            }
        });

        // Theme Toggle Logic - Grid Wave Animation
        function triggerPixelWaveTransition() {
            const overlay = document.getElementById('pixel-transition-overlay');
            if (!overlay) {
                // Fallback if overlay doesn't exist
                document.documentElement.classList.toggle('dark');
                const toggleThumb = document.getElementById('toggleThumb');
                if (toggleThumb) {
                    toggleThumb.style.transform = document.documentElement.classList.contains('dark') ? 'translateX(32px)' : 'translateX(0)';
                }
                return;
            }
            
            overlay.classList.remove('hidden');
            overlay.innerHTML = ''; // Clear old tiles
            
            const cols = 12;
            const rows = 8;
            const totalTiles = cols * rows;
            const isDark = document.documentElement.classList.contains('dark');
            const tileColor = isDark ? '#f5f5f5' : '#0a0a0a';
            
            for (let i = 0; i < totalTiles; i++) {
                const tile = document.createElement('div');
                tile.style.backgroundColor = tileColor;
                // Add grid outline
                tile.style.border = isDark ? '1px solid rgba(0, 0, 0, 0.15)' : '1px solid rgba(255, 255, 255, 0.15)';
                tile.style.opacity = '0';
                tile.style.transform = 'scale(0.5)';
                tile.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                
                // Calculate column for wave delay from left to right
                const col = i % cols;
                tile.style.transitionDelay = `${col * 0.05}s`;
                
                overlay.appendChild(tile);
            }
            
            // Trigger in animation
            setTimeout(() => {
                const tiles = overlay.children;
                for (let i = 0; i < tiles.length; i++) {
                    tiles[i].style.opacity = '1';
                    tiles[i].style.transform = 'scale(1.05)';
                }
            }, 10);
            
            // Toggle theme when screen is mostly covered
            setTimeout(() => {
                document.documentElement.classList.toggle('dark');
                const toggleThumb = document.getElementById('toggleThumb');
                if (toggleThumb) {
                    toggleThumb.style.transform = document.documentElement.classList.contains('dark') ? 'translateX(32px)' : 'translateX(0)';
                }
            }, 600);
            
            // Trigger out animation
            setTimeout(() => {
                const tiles = overlay.children;
                for (let i = 0; i < tiles.length; i++) {
                    tiles[i].style.opacity = '0';
                    tiles[i].style.transform = 'scale(0)';
                }
            }, 700);
            
            // Cleanup
            setTimeout(() => {
                overlay.classList.add('hidden');
                overlay.innerHTML = '';
            }, 1500);
        }

    
        // SCROLL ANIMATION OBSERVER
        const scrollObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.reveal-on-scroll').forEach(el => {
            scrollObserver.observe(el);
        });
</script>
    <style>
    :root {
        --v-pri: #dc2626;     
        --v-sec: #b91c1c;
        --v-bg: #0f111a;
        --v-txt: #e5e7eb;
        --v-shd: 0 10px 30px rgba(0, 0, 0, 0.5);
        --v-font: 'Inter', sans-serif;
    }

    .v-wrap {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 9999;
        pointer-events: none;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .v-orb-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 2147483647;
    }

    @media (max-width: 768px) {
        .v-orb-container {
            bottom: 20px;
            right: 20px;
        }
    }

    .v-bubble {
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

    .v-bubble::after {
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

    .v-bubble.show {
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

    .v-bubble.hide-bounce {
        animation: vBounceOut 0.4s cubic-bezier(0.600, -0.280, 0.735, 0.045) forwards;
    }

    @keyframes vBounceOut {
        0% { opacity: 1; transform: translateY(0) scale(1); }
        30% { transform: translateY(-10px) scale(1.05); }
        100% { opacity: 0; transform: translateY(15px) scale(0); }
    }

    .v-cursor {
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

    .v-orb {
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
        .v-orb {
            width: 68px;
            height: 68px;
        }
    }

    .v-orb:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 35px rgba(220, 38, 38, 0.2);
        border-color: #dc2626;
    }
    
    .v-orb:active {
        cursor: grabbing;
    }

    .v-orb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .v-pane {
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

    .v-pane.active {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: all;
    }

    @media (max-width: 768px) {
        .v-pane {
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

    /* Pannellum 360 Viewer Custom Overrides */
    #pannellum360Viewer {
        width: 100%;
        height: 100%;
    }
    #pannellum360Viewer .pnlm-container {
        background: #0a0a0c !important;
    }
    .pnlm-hot-spot-debug-indicator { display: none; }
    .pnlm-info-hotspot .pnlm-tooltip span {
        background: rgba(12,12,20,0.95);
        border: 1px solid rgba(229,9,20,0.5);
        color: #fff;
        font-size: 11px;
        font-family: 'Space Mono', monospace;
        border-radius: 0;
        padding: 6px 12px;
    }
</style>

{{-- 360° VIRTUAL SHOWROOM TOUR MODAL --}}
<div id="virtualTourModal"
     style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:2147483647;align-items:center;justify-content:center;background:rgba(0,0,0,0.93);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);padding:1rem;"
     onclick="if(event.target===this)close360ShowroomModal()">
    <div style="position:relative;width:100%;max-width:1100px;height:85vh;background:#0c0c14;border:1px solid rgba(255,255,255,0.12);box-shadow:0 30px 80px rgba(0,0,0,0.9);display:flex;flex-direction:column;overflow:hidden;">
        <!-- Modal Header -->
        <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 22px;border-bottom:1px solid rgba(255,255,255,0.08);background:#0a0a0c;flex-shrink:0;">
            <div style="display:flex;align-items:center;gap:12px;">
                <span style="width:9px;height:9px;border-radius:50%;background:#e50914;display:inline-block;"></span>
                <div>
                    <p style="font-family:'Cinzel',serif;font-weight:700;font-size:13px;color:#fff;letter-spacing:.15em;text-transform:uppercase;margin:0;">APEX VIRTUAL SHOWROOM 360&deg;</p>
                    <p style="font-family:'Space Mono',monospace;font-size:10px;color:#6b7280;margin:0;">Pondok Indah VIP &bull; Drag &amp; scroll to explore</p>
                </div>
            </div>
            <div style="display:flex;gap:8px;align-items:center;">
                <button id="autoRotateBtn" onclick="toggle360AutoRotate()"
                    style="display:flex;align-items:center;gap:6px;padding:6px 12px;background:#111118;border:1px solid rgba(255,255,255,0.12);color:#d1d5db;font-family:'Space Mono',monospace;font-size:10px;cursor:pointer;">
                    <i class="fa-solid fa-rotate" style="color:#e50914;"></i> AUTO ROTATE
                </button>
                <button onclick="close360ShowroomModal()"
                    style="width:32px;height:32px;border-radius:50%;background:#111118;border:1px solid rgba(255,255,255,0.12);color:#9ca3af;cursor:pointer;display:flex;align-items:center;justify-content:center;"
                    onmouseover="this.style.background='#e50914'" onmouseout="this.style.background='#111118'">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
        <!-- ROOM NAVIGATION TABS -->
        <div style="background:#0a0a0c;border-bottom:1px solid rgba(255,255,255,0.05);display:flex;padding:10px 22px;gap:12px;overflow-x:auto;">
            <button onclick="change360Room('showroom')" id="tab-showroom" class="room-tab-btn active" style="padding:6px 16px;background:rgba(229,9,20,0.15);border:1px solid #e50914;color:#fff;font-size:11px;font-family:'Space Mono',monospace;cursor:pointer;white-space:nowrap;transition:all 0.3s;">MAIN SHOWROOM</button>
            <button onclick="change360Room('garage')" id="tab-garage" class="room-tab-btn" style="padding:6px 16px;background:transparent;border:1px solid rgba(255,255,255,0.2);color:#9ca3af;font-size:11px;font-family:'Space Mono',monospace;cursor:pointer;white-space:nowrap;transition:all 0.3s;">LUXURY GARAGE</button>
            <button onclick="change360Room('lounge')" id="tab-lounge" class="room-tab-btn" style="padding:6px 16px;background:transparent;border:1px solid rgba(255,255,255,0.2);color:#9ca3af;font-size:11px;font-family:'Space Mono',monospace;cursor:pointer;white-space:nowrap;transition:all 0.3s;">VIP LOUNGE</button>
            <button onclick="change360Room('front')" id="tab-front" class="room-tab-btn" style="padding:6px 16px;background:transparent;border:1px solid rgba(255,255,255,0.2);color:#9ca3af;font-size:11px;font-family:'Space Mono',monospace;cursor:pointer;white-space:nowrap;transition:all 0.3s;">EXTERIOR FRONT</button>
        </div>
        <!-- Viewer Area -->
        <div style="flex:1;position:relative;overflow:hidden;background:#000;">
            <div id="pannellum360Viewer" style="width:100%;height:100%;"></div>
            <div id="tourHint"
                 style="position:absolute;bottom:18px;left:18px;z-index:10;background:rgba(0,0,0,0.8);border:1px solid rgba(255,255,255,0.1);padding:8px 14px;display:flex;align-items:center;gap:10px;transition:opacity .6s;pointer-events:none;">
                <i class="fa-solid fa-hand-pointer" style="color:#e50914;"></i>
                <span style="font-family:'Space Mono',monospace;font-size:10px;color:#d1d5db;">Geser / Drag untuk rotasi 360&deg; &bull; Scroll = zoom</span>
            </div>
            <div id="tourLoading"
                 style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:#0a0a0c;z-index:5;">
                <div style="text-align:center;">
                    <div style="width:48px;height:48px;border:3px solid rgba(229,9,20,0.3);border-top:3px solid #e50914;border-radius:50%;animation:spin360 1s linear infinite;margin:0 auto 12px;"></div>
                    <p style="font-family:'Space Mono',monospace;font-size:11px;color:#9ca3af;">Loading 360&deg; view...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes spin360 {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<script>
    // Global variables for 360 viewer
    var _360viewer = null;
    var _360rotating = false;
    var _360loaded = false;

    // Plain global function
    function open360ShowroomModal() {
        console.log('[360Tour] open360ShowroomModal called');
        
        var modal = document.getElementById('virtualTourModal');
        if (!modal) {
            console.error('[360Tour] Modal not found');
            alert('Error: Modal element not found!');
            return;
        }
        
        // Break out of any hiding parent containers by moving modal directly to body
        if (modal.parentNode !== document.body) {
            document.body.appendChild(modal);
        }
        
        // Show modal immediately with high priority
        modal.style.setProperty('display', 'flex', 'important');

        if (!_360loaded) {
            _360loaded = true;
            console.log('[360Tour] Dynamically loading Pannellum scripts');
            
            var css = document.createElement('link');
            css.rel = 'stylesheet';
            css.href = 'https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css';
            document.head.appendChild(css);

            var js = document.createElement('script');
            js.src = 'https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js';
            js.onload = function() {
                console.log('[360Tour] Pannellum script loaded successfully');
                _init360Viewer();
            };
            js.onerror = function() {
                console.error('[360Tour] Failed to load Pannellum JS');
                var el = document.getElementById('tourLoading');
                if (el) el.innerHTML = '<p style="color:#e50914;font-family:monospace;font-size:12px;padding:20px;">Failed to load viewer.<br>Check your internet connection.</p>';
            };
            document.body.appendChild(js);
        } else if (_360viewer) {
            var el = document.getElementById('tourLoading');
            if (el) el.style.display = 'none';
        }
    }

    function _init360Viewer() {
        if (_360viewer) return;
        try {
            console.log('[360Tour] Initializing viewer...');
            _360viewer = pannellum.viewer('pannellum360Viewer', {
                default: {
                    firstScene: "showroom",
                    autoLoad: true,
                    autoRotate: -2,
                    autoRotateInactivityDelay: 1000,
                    compass: false,
                    showControls: true
                },
                scenes: {
                    showroom: {
                        type: 'equirectangular',
                        panorama: '{{ asset("images/showroom_360.png") }}',
                        hotSpots: [
                            { pitch: -2, yaw:  20, type: 'info', text: 'Ferrari & Hypercar Lounge Zone' },
                            { pitch: -4, yaw: -75, type: 'info', text: 'Lamborghini Revuelto Display' },
                            { pitch:  0, yaw: 125, type: 'info', text: 'VIP Concierge & Reception Desk' }
                        ]
                    },
                    garage: {
                        type: 'equirectangular',
                        panorama: '{{ asset("images/garage_360.png") }}',
                        hotSpots: [
                            { pitch: 0, yaw: 0, type: 'info', text: 'Supercar Storage & Tuning' }
                        ]
                    },
                    lounge: {
                        type: 'equirectangular',
                        panorama: '{{ asset("images/lounge_360.png") }}',
                        hotSpots: [
                            { pitch: -5, yaw: 45, type: 'info', text: 'VIP Negotiation Table' }
                        ]
                    },
                    front: {
                        type: 'equirectangular',
                        panorama: '{{ asset("images/front_360.png") }}',
                        hotSpots: [
                            { pitch: 0, yaw: 0, type: 'info', text: 'Dealership Exterior' }
                        ]
                    }
                }
            });
            _360rotating = true;

            var checkLoaded = setInterval(function() {
                try {
                    if (_360viewer && _360viewer.isLoaded()) {
                        clearInterval(checkLoaded);
                        console.log('[360Tour] Viewer fully loaded and rendering');
                        var el = document.getElementById('tourLoading');
                        if (el) el.style.display = 'none';
                        setTimeout(function() {
                            var hint = document.getElementById('tourHint');
                            if (hint) hint.style.opacity = '0';
                        }, 5000);
                    }
                } catch(e) { clearInterval(checkLoaded); }
            }, 300);

        } catch(e) {
            console.error('[360Tour] Init error:', e);
            alert('Error initializing 360 viewer.');
        }
    }

    function change360Room(roomId) {
        if (!_360viewer) return;
        
        var loading = document.getElementById('tourLoading');
        if (loading) loading.style.display = 'flex';
        
        try {
            _360viewer.loadScene(roomId);
        } catch(e) {
            console.error('Error loading scene:', e);
        }
        
        var tabs = document.querySelectorAll('.room-tab-btn');
        tabs.forEach(function(t) {
            t.style.background = 'transparent';
            t.style.border = '1px solid rgba(255,255,255,0.2)';
            t.style.color = '#9ca3af';
        });
        var active = document.getElementById('tab-' + roomId);
        if (active) {
            active.style.background = 'rgba(229,9,20,0.15)';
            active.style.border = '1px solid #e50914';
            active.style.color = '#fff';
        }

        setTimeout(function() {
            var checkLoaded = setInterval(function() {
                try {
                    if (_360viewer && _360viewer.isLoaded()) {
                        clearInterval(checkLoaded);
                        if (loading) loading.style.display = 'none';
                    }
                } catch(e) { clearInterval(checkLoaded); }
            }, 300);
        }, 150);
    }

    function close360ShowroomModal() {
        console.log('[360Tour] close360ShowroomModal called');
        var modal = document.getElementById('virtualTourModal');
        if (modal) modal.style.setProperty('display', 'none', 'important');
    }

    function toggle360AutoRotate() {
        if (!_360viewer) return;
        var btn = document.getElementById('autoRotateBtn');
        if (_360rotating) {
            _360viewer.stopAutoRotate();
            _360rotating = false;
            if (btn) { btn.style.opacity = '0.45'; btn.title = 'Auto Rotate: OFF'; }
        } else {
            _360viewer.startAutoRotate(-2);
            _360rotating = true;
            if (btn) { btn.style.opacity = '1'; btn.title = 'Auto Rotate: ON'; }
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') close360ShowroomModal();
    });

    // Explicitly expose functions to window just in case
    window.open360ShowroomModal = open360ShowroomModal;
    window.close360ShowroomModal = close360ShowroomModal;
    window.toggle360AutoRotate = toggle360AutoRotate;
    window.change360Room = change360Room;
</script>

@endsection

@section('scripts')
<!-- Leaflet Map JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var mapEl = document.getElementById('dealerMap');
        if (mapEl) {
            var lat = {{ $dealer_lat }};
            var lng = {{ $dealer_lng }};
            
            // Initialize map
            var map = L.map('dealerMap', {
                center: [lat, lng],
                zoom: 15,
                scrollWheelZoom: false
            });
            
            // Fix Leaflet rendering issue when container is initially off-screen or animating
            setTimeout(function() {
                map.invalidateSize();
            }, 500);
            setTimeout(function() {
                map.invalidateSize();
            }, 1500);
            
            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            
            // Custom red marker icon
            var redIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            
            // Add marker
            var marker = L.marker([lat, lng], {icon: redIcon}).addTo(map);
            marker.bindPopup("<b>APEX AUTOMOTIVE</b><br>Official Showroom").openPopup();
            
            // Robust fix for Leaflet rendering issues on scroll animations/resizing
            if ('ResizeObserver' in window) {
                var ro = new ResizeObserver(function() {
                    map.invalidateSize();
                });
                ro.observe(mapEl);
            }
            if ('IntersectionObserver' in window) {
                var io = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if(entry.isIntersecting) {
                            setTimeout(function() { map.invalidateSize(); }, 100);
                        }
                    });
                });
                io.observe(mapEl);
            }
            
            // Fallback for older browsers
            setTimeout(function() { map.invalidateSize(); }, 1500);
        }
    });
</script>
<style>
    /* CSS Trick to make OpenStreetMap dark mode without API keys */
    .map-dark-filter .leaflet-layer,
    .map-dark-filter .leaflet-control-zoom-in,
    .map-dark-filter .leaflet-control-zoom-out,
    .map-dark-filter .leaflet-control-attribution {
        filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
    }
</style>
@endsection
