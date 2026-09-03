<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Apex Automotive - Official Luxury Supercar & Hypercar Dealer in Jakarta. Exclusive inventory of BMW Motorsport, Lamborghini, McLaren, Ferrari, Porsche, Audi, and Koenigsegg.">
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
            .car-main-img {
                transition: opacity 0.25s ease, transform 0.5s ease;
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

            <!-- RIGHT ACTIONS (LUXURY PILL THEME TOGGLE + BOOK BUTTON) -->
            <div class="flex items-center space-x-5">
                
                <!-- PREMIUM CAPSULE THEME TOGGLE SWITCH -->
                <button onclick="triggerPixelWaveTransition()" id="themeToggleBtn" title="Toggle Light / Dark Mode" class="relative flex items-center justify-between w-16 h-8 rounded-full p-1 border border-neutral-300 dark:border-white/20 bg-neutral-200/90 dark:bg-neutral-900/90 shadow-inner cursor-pointer transition-all duration-300 group hover:border-red-500">
                    <span class="w-6 h-6 flex items-center justify-center text-amber-500 text-xs z-0"><i class="fa-solid fa-sun"></i></span>
                    <span class="w-6 h-6 flex items-center justify-center text-indigo-400 text-xs z-0"><i class="fa-solid fa-moon"></i></span>
                    
                    <!-- Dynamic Sliding Capsule Knob -->
                    <div id="toggleThumb" class="absolute top-1 left-1 w-6 h-6 rounded-full bg-gradient-to-br from-red-600 to-red-800 text-white shadow-md flex items-center justify-center transition-all duration-300 z-10 group-hover:scale-105">
                        <i class="fa-solid fa-bolt text-[9px]"></i>
                    </div>
                </button>

                <button onclick="toggleModal('inquireModal')" class="hidden sm:inline-flex items-center justify-center px-5 py-2.5 text-xs tracking-widest font-semibold uppercase bg-red-600 hover:bg-red-700 text-white rounded-none shadow-lg shadow-red-600/25 hover:shadow-red-600/50 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-calendar-check mr-2"></i> BOOK PRIVATE VIEWING
                </button>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        <!-- ==========================================
             HERO CAROUSEL SECTION
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
                            <button onclick="openCarDetails('BMW Motorsport')" class="px-8 py-3.5 bg-red-600 hover:bg-red-700 text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 flex items-center shadow-lg shadow-red-600/30">
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
                            LAMBORGHINI AVENTADOR SVJ
                        </h1>
                        <p class="text-base sm:text-lg text-neutral-300 font-light max-w-xl">
                            770 HP naturally aspirated V12 beast with active aerodynamics ALA 2.0. Limited production masterpiece.
                        </p>
                        <div class="pt-4 flex flex-wrap gap-4 items-center">
                            <button onclick="openCarDetails('Lamborghini Aventador SVJ')" class="px-8 py-3.5 bg-red-600 hover:bg-red-700 text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 flex items-center shadow-lg shadow-red-600/30">
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
                            MCLAREN SENNA
                        </h1>
                        <p class="text-base sm:text-lg text-neutral-300 font-light max-w-xl">
                            Unforgiving track focus. 800KG downforce, carbon monocage III, and pure unadulterated racing DNA.
                        </p>
                        <div class="pt-4 flex flex-wrap gap-4 items-center">
                            <button onclick="openCarDetails('McLaren Senna')" class="px-8 py-3.5 bg-red-600 hover:bg-red-700 text-white text-xs tracking-widest font-bold uppercase transition-all duration-300 flex items-center shadow-lg shadow-red-600/30">
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
                    </div>
                    <span class="text-xs font-mono text-neutral-400 pl-2" id="slide-counter">01 / 03</span>
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
             SECTION 1: CERTIFIED SUGGESTIONS (CATALOG & COLOR TOGGLES)
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

                <!-- CAR CATALOG GRID WITH ROUND COLOR TOGGLES -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="carCatalog">
                    
                    <!-- CAR CARD 1: BMW M4 COMPETITION -->
                    <div class="car-card glass-card group overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="BMW" data-price="8500" data-condition="NEW">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/bmwm4competition_sao_paulo_yellow.png') }}" alt="BMW M4 Competition" class="car-main-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                BRAND NEW
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2025
                            </div>
                            <div class="absolute bottom-3 left-3 bg-black/80 backdrop-blur-md text-neutral-300 text-[10px] font-mono px-2 py-1 border border-white/10 uppercase tracking-wider">
                                COLOR: <span class="car-color-badge text-amber-400 font-bold">SAO PAULO YELLOW</span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2025 • BMW MOTORSPORT</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    M4 COMPETITION COUPE
                                </h4>
                            </div>

                            <!-- ROUND COLOR TOGGLE BUTTONS -->
                            <div class="space-y-1.5 pt-1">
                                <label class="text-[10px] font-mono uppercase tracking-widest text-neutral-500 dark:text-neutral-400 block font-semibold">SELECT EXTERIOR COLOR:</label>
                                <div class="flex items-center space-x-3">
                                    <!-- SAO PAULO YELLOW -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/bmwm4competition_sao_paulo_yellow.png') }}', 'SAO PAULO YELLOW')" class="color-dot w-6 h-6 rounded-full bg-[#d6e531] border-2 border-red-500 ring-2 ring-red-500 scale-110 shadow-md cursor-pointer transition-all hover:scale-125" title="Sao Paulo Yellow"></button>

                                    <!-- VOODOO BLUE -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/bmwm4competition_voodoo_blue.png') }}', 'VOODOO BLUE')" class="color-dot w-6 h-6 rounded-full bg-[#1e56a0] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Voodoo Blue"></button>

                                    <!-- ALPINE WHITE -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/bmwm4competition_alpine_white.png') }}', 'ALPINE WHITE')" class="color-dot w-6 h-6 rounded-full bg-[#f5f5f7] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Alpine White"></button>

                                    <!-- BLACK SAPPHIRE -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/bmwm4competition_black_shapphire_metallic.png') }}', 'BLACK SAPPHIRE METALLIC')" class="color-dot w-6 h-6 rounded-full bg-[#1c1c1e] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Black Sapphire Metallic"></button>
                                </div>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3">
                                <div class="text-[10px] font-mono text-neutral-600 dark:text-neutral-400">STARTING FROM</div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500">IDR 8,500,000,000</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-gauge-high mr-1 text-red-600"></i> 510 HP</div>
                                <div><i class="fa-solid fa-bolt mr-1 text-red-600"></i> 0-100: 3.5S</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE
                                </button>
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 2: LAMBORGHINI REVUELTO -->
                    <div class="car-card glass-card group overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Lamborghini" data-price="22000" data-condition="NEW">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/lamborghini_revuelto_arancio_apodis.png') }}" alt="Lamborghini Revuelto" class="car-main-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-neutral-900/90 text-emerald-400 border border-emerald-500/40 text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest">
                                BRAND NEW
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2025
                            </div>
                            <div class="absolute bottom-3 left-3 bg-black/80 backdrop-blur-md text-neutral-300 text-[10px] font-mono px-2 py-1 border border-white/10 uppercase tracking-wider">
                                COLOR: <span class="car-color-badge text-orange-400 font-bold">ARANCIO APODIS</span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2025 • LAMBORGHINI</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    REVUELTO V12 HYBRID
                                </h4>
                            </div>

                            <!-- ROUND COLOR TOGGLE BUTTONS -->
                            <div class="space-y-1.5 pt-1">
                                <label class="text-[10px] font-mono uppercase tracking-widest text-neutral-500 dark:text-neutral-400 block font-semibold">SELECT EXTERIOR COLOR:</label>
                                <div class="flex items-center space-x-3">
                                    <!-- ARANCIO APODIS (ORANGE) -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/lamborghini_revuelto_arancio_apodis.png') }}', 'ARANCIO APODIS')" class="color-dot w-6 h-6 rounded-full bg-[#ff5722] border-2 border-red-500 ring-2 ring-red-500 scale-110 shadow-md cursor-pointer transition-all hover:scale-125" title="Arancio Apodis"></button>

                                    <!-- VERDE CITRA (GREEN) -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/lamborghini_revuelto_verde_citra.png') }}', 'VERDE CITRA')" class="color-dot w-6 h-6 rounded-full bg-[#76ff03] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Verde Citra"></button>

                                    <!-- BRONZO ZANTE (BRONZE) -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/lamborghini_revuelto_bronzo_zante.png') }}', 'BRONZO ZANTE')" class="color-dot w-6 h-6 rounded-full bg-[#8d6e63] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Bronzo Zante"></button>

                                    <!-- BIANCO MONOCERUS (WHITE) -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/lamborghini_revuelto_bianco_monocerus.png') }}', 'BIANCO MONOCERUS')" class="color-dot w-6 h-6 rounded-full bg-[#ffffff] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Bianco Monocerus"></button>
                                </div>
                            </div>

                            <div class="border-t border-b border-neutral-200 dark:border-white/10 py-2.5 my-2 bg-neutral-50 dark:bg-neutral-950/60 px-3">
                                <div class="text-[10px] font-mono text-neutral-600 dark:text-neutral-400">STARTING FROM</div>
                                <div class="text-lg font-bold font-mono text-red-600 dark:text-red-500">IDR 22,000,000,000</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-[11px] font-mono text-neutral-700 dark:text-neutral-400">
                                <div><i class="fa-solid fa-fire mr-1 text-red-600"></i> 1,015 HP V12</div>
                                <div><i class="fa-solid fa-bolt mr-1 text-red-600"></i> 0-100: 2.5S</div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-2">
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE
                                </button>
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 3: MCLAREN SENNA GTR -->
                    <div class="car-card glass-card group overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="McLaren" data-price="28000" data-condition="CERTIFIED">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/mclaren_senna_gtr_volcano_yellow.png') }}" alt="McLaren Senna GTR" class="car-main-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                CERTIFIED
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2024
                            </div>
                            <div class="absolute bottom-3 left-3 bg-black/80 backdrop-blur-md text-neutral-300 text-[10px] font-mono px-2 py-1 border border-white/10 uppercase tracking-wider">
                                COLOR: <span class="car-color-badge text-yellow-400 font-bold">VOLCANO YELLOW</span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2024 • MCLAREN</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    SENNA GTR EDITION
                                </h4>
                            </div>

                            <!-- ROUND COLOR TOGGLE BUTTONS -->
                            <div class="space-y-1.5 pt-1">
                                <label class="text-[10px] font-mono uppercase tracking-widest text-neutral-500 dark:text-neutral-400 block font-semibold">SELECT EXTERIOR COLOR:</label>
                                <div class="flex items-center space-x-3">
                                    <!-- VOLCANO YELLOW -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/mclaren_senna_gtr_volcano_yellow.png') }}', 'VOLCANO YELLOW')" class="color-dot w-6 h-6 rounded-full bg-[#ffc107] border-2 border-red-500 ring-2 ring-red-500 scale-110 shadow-md cursor-pointer transition-all hover:scale-125" title="Volcano Yellow"></button>

                                    <!-- PAPAYA SHARK -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/mclaren_senna_gtr_papaya_shark.png') }}', 'PAPAYA SHARK')" class="color-dot w-6 h-6 rounded-full bg-[#ff9800] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Papaya Shark"></button>

                                    <!-- SILICA WHITE -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/mclaren_senna_gtr_silica_white.png') }}', 'SILICA WHITE')" class="color-dot w-6 h-6 rounded-full bg-[#f5f5f7] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Silica White"></button>
                                </div>
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
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE
                                </button>
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 4: PORSCHE 911 GT3 RS -->
                    <div class="car-card glass-card group overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Porsche" data-price="11500" data-condition="CERTIFIED">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/porsche_rubystone_red.png') }}" alt="Porsche 911 GT3 RS" class="car-main-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                CERTIFIED
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2024
                            </div>
                            <div class="absolute bottom-3 left-3 bg-black/80 backdrop-blur-md text-neutral-300 text-[10px] font-mono px-2 py-1 border border-white/10 uppercase tracking-wider">
                                COLOR: <span class="car-color-badge text-pink-400 font-bold">RUBYSTONE RED</span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2024 • PORSCHE</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    911 GT3 RS (992)
                                </h4>
                            </div>

                            <!-- ROUND COLOR TOGGLE BUTTONS -->
                            <div class="space-y-1.5 pt-1">
                                <label class="text-[10px] font-mono uppercase tracking-widest text-neutral-500 dark:text-neutral-400 block font-semibold">SELECT EXTERIOR COLOR:</label>
                                <div class="flex items-center space-x-3">
                                    <!-- RUBYSTONE RED -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/porsche_rubystone_red.png') }}', 'RUBYSTONE RED')" class="color-dot w-6 h-6 rounded-full bg-[#d81b60] border-2 border-red-500 ring-2 ring-red-500 scale-110 shadow-md cursor-pointer transition-all hover:scale-125" title="Rubystone Red"></button>

                                    <!-- RACING YELLOW -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/porsche_racing_yellow.png') }}', 'RACING YELLOW')" class="color-dot w-6 h-6 rounded-full bg-[#ffeb3b] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Racing Yellow"></button>

                                    <!-- NATO OLIVE GREEN -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/porsche_nato_olive_green.png') }}', 'NATO OLIVE GREEN')" class="color-dot w-6 h-6 rounded-full bg-[#4b5320] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Nato Olive Green"></button>

                                    <!-- ARCTIC GREY -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/porsche_artic_grey.png') }}', 'ARCTIC GREY')" class="color-dot w-6 h-6 rounded-full bg-[#78909c] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Arctic Grey"></button>

                                    <!-- CARRARA WHITE -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/porsche_carrara_white_metallic.png') }}', 'CARRARA WHITE')" class="color-dot w-6 h-6 rounded-full bg-[#ffffff] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Carrara White"></button>
                                </div>
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
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE
                                </button>
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 5: AUDI R8 V10 PERFORMANCE -->
                    <div class="car-card glass-card group overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Audi" data-price="7800" data-condition="PRE-OWNED">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/audi_r8_tango_red_metallic.png') }}" alt="Audi R8 V10 Performance" class="car-main-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                PRE-OWNED
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2024
                            </div>
                            <div class="absolute bottom-3 left-3 bg-black/80 backdrop-blur-md text-neutral-300 text-[10px] font-mono px-2 py-1 border border-white/10 uppercase tracking-wider">
                                COLOR: <span class="car-color-badge text-red-500 font-bold">TANGO RED METALLIC</span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2024 • AUDI</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    R8 V10 PERFORMANCE
                                </h4>
                            </div>

                            <!-- ROUND COLOR TOGGLE BUTTONS -->
                            <div class="space-y-1.5 pt-1">
                                <label class="text-[10px] font-mono uppercase tracking-widest text-neutral-500 dark:text-neutral-400 block font-semibold">SELECT EXTERIOR COLOR:</label>
                                <div class="flex items-center space-x-3">
                                    <!-- TANGO RED -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/audi_r8_tango_red_metallic.png') }}', 'TANGO RED METALLIC')" class="color-dot w-6 h-6 rounded-full bg-[#d32f2f] border-2 border-red-500 ring-2 ring-red-500 scale-110 shadow-md cursor-pointer transition-all hover:scale-125" title="Tango Red"></button>

                                    <!-- VEGAS YELLOW -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/audi_r8_vegas_yellow.png') }}', 'VEGAS YELLOW')" class="color-dot w-6 h-6 rounded-full bg-[#fbc02d] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Vegas Yellow"></button>

                                    <!-- ARA BLUE -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/audi_r8_ara_blue_crystal_effect.png') }}', 'ARA BLUE CRYSTAL')" class="color-dot w-6 h-6 rounded-full bg-[#0288d1] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Ara Blue Crystal"></button>

                                    <!-- MYTHOS BLACK -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/audi_r8_mythos_black_mettalic.png') }}', 'MYTHOS BLACK METALLIC')" class="color-dot w-6 h-6 rounded-full bg-[#212121] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Mythos Black"></button>

                                    <!-- IBIS WHITE -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/audi_r8_ibis_white.png') }}', 'IBIS WHITE')" class="color-dot w-6 h-6 rounded-full bg-[#fafafa] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="Ibis White"></button>
                                </div>
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
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE
                                </button>
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    INQUIRE
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- CAR CARD 6: KOENIGSEGG JESKO ABSOLUT -->
                    <div class="car-card glass-card group overflow-hidden border border-neutral-200 dark:border-white/10 hover:border-red-600 transition-all duration-300 reveal-on-scroll" data-make="Koenigsegg" data-price="45000" data-condition="NEW">
                        <div class="relative h-64 overflow-hidden bg-neutral-900">
                            <img src="{{ asset('images/brand/koeningseg_jesko_absolut_crystal_white.png') }}" alt="Koenigsegg Jesko Absolut" class="car-main-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-purple-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 uppercase tracking-widest shadow-md">
                                HYPERCAR SPECIAL
                            </div>
                            <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-md text-neutral-200 text-[10px] font-mono px-2.5 py-0.5 border border-white/10">
                                2025
                            </div>
                            <div class="absolute bottom-3 left-3 bg-black/80 backdrop-blur-md text-neutral-300 text-[10px] font-mono px-2 py-1 border border-white/10 uppercase tracking-wider">
                                COLOR: <span class="car-color-badge text-indigo-300 font-bold">CRYSTAL WHITE</span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 bg-white dark:bg-transparent">
                            <div>
                                <span class="text-[11px] font-mono text-neutral-600 dark:text-neutral-400 uppercase font-semibold">2025 • KOENIGSEGG</span>
                                <h4 class="text-lg font-bold font-serif text-neutral-900 dark:text-white tracking-wide group-hover:text-red-600 transition-colors">
                                    JESKO ABSOLUT
                                </h4>
                            </div>

                            <!-- ROUND COLOR TOGGLE BUTTONS -->
                            <div class="space-y-1.5 pt-1">
                                <label class="text-[10px] font-mono uppercase tracking-widest text-neutral-500 dark:text-neutral-400 block font-semibold">SELECT EXTERIOR COLOR:</label>
                                <div class="flex items-center space-x-3">
                                    <!-- CRYSTAL WHITE -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/koeningseg_jesko_absolut_crystal_white.png') }}', 'CRYSTAL WHITE')" class="color-dot w-6 h-6 rounded-full bg-[#ffffff] border-2 border-red-500 ring-2 ring-red-500 scale-110 shadow-md cursor-pointer transition-all hover:scale-125" title="Crystal White"></button>

                                    <!-- K2 CARBON -->
                                    <button type="button" onclick="changeCarColor(this, '{{ asset('images/brand/koeningseg_jesko_absolut_k2_carbon.png') }}', 'K2 CARBON')" class="color-dot w-6 h-6 rounded-full bg-[#2c3539] border-2 border-neutral-300 dark:border-white/30 shadow-md cursor-pointer transition-all hover:scale-125" title="K2 Carbon"></button>
                                </div>
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
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white text-[10px] tracking-widest font-bold uppercase transition-colors">
                                    EXPLORE
                                </button>
                                <button onclick="toggleModal('inquireModal')" class="w-full py-2.5 border border-neutral-300 dark:border-white/20 text-neutral-900 dark:text-white hover:bg-neutral-100 dark:hover:bg-white/10 text-[10px] tracking-widest font-bold uppercase transition-colors">
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
                        <li><a href="#" class="hover:text-white transition-colors">Lamborghini Aventador SVJ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">McLaren Senna Hypercar</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Ferrari SF90 & 296 GTS</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Porsche 911 GT3 RS</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Audi R8 V10 Performance</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Koenigsegg Jesko Absolut</a></li>
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
                            <option value="Porsche 911 GT3 RS">Porsche 911 GT3 RS</option>
                            <option value="Audi R8 V10">Audi R8 V10 Performance</option>
                            <option value="Koenigsegg Jesko Absolut">Koenigsegg Jesko Absolut</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-neutral-700 dark:text-neutral-400 font-semibold uppercase mb-1">SPECIAL REQUEST / NOTES</label>
                    <textarea rows="3" placeholder="Tell us about your schedule or trade-in inquiries..." class="w-full bg-neutral-100 dark:bg-neutral-900 border border-neutral-300 dark:border-white/15 px-3 py-2.5 text-neutral-900 dark:text-white focus:border-red-600 focus:outline-none"></textarea>
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
        // 0. INTRO SCREEN DISMISSAL (2.4 Seconds)
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


        // 1. CAR COLOR SWITCHER FUNCTION (FOR ROUND COLOR DOTS)
        function changeCarColor(button, imagePath, colorName) {
            const card = button.closest('.car-card');
            if (!card) return;

            const mainImg = card.querySelector('.car-main-img');
            const colorBadge = card.querySelector('.car-color-badge');

            // Smooth image cross-fade
            if (mainImg) {
                mainImg.style.opacity = '0.2';
                mainImg.style.transform = 'scale(0.97)';
                setTimeout(() => {
                    mainImg.src = imagePath;
                    mainImg.style.opacity = '1';
                    mainImg.style.transform = 'scale(1)';
                }, 150);
            }

            // Update Color Name Label
            if (colorBadge) {
                colorBadge.innerText = colorName;
            }

            // Update active ring indicator on round color dots
            const dots = card.querySelectorAll('.color-dot');
            dots.forEach(dot => {
                dot.classList.remove('ring-2', 'ring-red-500', 'scale-110', 'border-red-500');
                dot.classList.add('border-neutral-300', 'dark:border-white/30');
            });

            button.classList.remove('border-neutral-300', 'dark:border-white/30');
            button.classList.add('ring-2', 'ring-red-500', 'scale-110', 'border-red-500');
        }


        // 2. PIXEL WAVE DARK/LIGHT MODE TRANSITION (Left to Right Wave)
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


        // 3. CAROUSEL ENGINE
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


        // 4. SCROLL ANIMATION OBSERVER
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


        // 5. CATALOG FILTER ENGINE
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


        // 6. MODAL HANDLER
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
