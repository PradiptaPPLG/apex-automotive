<!DOCTYPE html>
<html lang="id" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request VIP Viewing - APEX AUTOMOTIVE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800;900&family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                        serif: ['Cinzel', 'serif'],
                        mono: ['Space Mono', 'monospace'],
                    },
                }
            }
        }
    </script>
    <style>
        body { background-color: #050505; color: #fff; font-family: 'Inter', sans-serif; }
        .glass-card {
            background: rgba(10, 10, 10, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col items-center justify-center bg-[url('https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center bg-fixed">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm z-0"></div>

    <div class="z-10 w-full max-w-lg px-4">
        <a href="/" class="block mb-8 text-center text-white/50 hover:text-white transition-colors text-xs font-mono tracking-widest uppercase">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back to Showroom
        </a>

        <div class="glass-card w-full p-8 border border-neutral-300 dark:border-white/20 shadow-2xl relative">
            <div class="text-center mb-6">
                <h3 class="text-[10px] tracking-[0.3em] text-red-600 font-bold uppercase mb-2">Apex Private Consultation</h3>
                <h2 class="text-2xl font-serif font-bold text-neutral-900 dark:text-white uppercase tracking-widest">REQUEST VIP VIEWING</h2>
                <p class="text-neutral-500 dark:text-neutral-400 text-xs mt-2 font-mono">Our luxury automotive advisor will contact you within 2 business hours.</p>
            </div>

            <form id="inquireForm" action="{{ route('inquire.store') }}" method="POST" class="space-y-4 text-xs font-mono">
                @csrf
                @auth
                    <input type="hidden" name="user_email" value="{{ auth()->user()->email }}">
                @endauth
                
                @if(session('success'))
                    <div class="bg-green-500/10 border border-green-500/30 px-4 py-3 text-center mb-4">
                        <i class="fa-solid fa-circle-check text-green-400 mr-2"></i>
                        <span class="text-green-400 text-xs font-mono">{{ session('success') }}</span>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="bg-red-500/10 border border-red-500/30 px-4 py-3 text-center mb-4">
                        <span class="text-red-400 text-xs font-mono">{{ $errors->first() }}</span>
                    </div>
                @endif

                <div>
                    <label class="block text-neutral-400 mb-1.5 uppercase tracking-wider">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full bg-neutral-100 dark:bg-white/5 border border-neutral-300 dark:border-white/10 text-neutral-900 dark:text-white px-4 py-3 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all placeholder:text-neutral-600"
                        placeholder="e.g. Alexander Wright"
                    >
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-neutral-400 mb-1.5 uppercase tracking-wider">Phone / WhatsApp</label>
                        <input
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            class="w-full bg-neutral-100 dark:bg-white/5 border border-neutral-300 dark:border-white/10 text-neutral-900 dark:text-white px-4 py-3 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all placeholder:text-neutral-600"
                            placeholder="+62 812 XXXX XXXX"
                        >
                    </div>
                    <div>
                        <label class="block text-neutral-400 mb-1.5 uppercase tracking-wider">Preferred Model</label>
                        <input
                            type="text"
                            name="car_model"
                            value="{{ old('car_model', request('car_model')) }}"
                            readonly
                            class="w-full bg-neutral-200 dark:bg-white/10 border border-neutral-300 dark:border-white/10 text-neutral-900 dark:text-white px-4 py-3 focus:outline-none focus:border-red-500 cursor-not-allowed transition-all"
                        >
                    </div>
                </div>
                <div>
                    <label class="block text-neutral-400 mb-1.5 uppercase tracking-wider">Special Request / Config / Notes</label>
                    <textarea
                        name="notes"
                        rows="3"
                        class="w-full bg-neutral-100 dark:bg-white/5 border border-neutral-300 dark:border-white/10 text-neutral-900 dark:text-white px-4 py-3 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all placeholder:text-neutral-600"
                        placeholder="Specify interior color, trim level, or other requests..."
                    >{{ old('notes', request('config')) }}</textarea>
                </div>

                <div class="pt-4">
                    @if(auth()->check() && (auth()->user()->isRm() || auth()->user()->isDelivery()))
                        <button type="button" class="w-full py-3 bg-neutral-600 text-white/50 font-bold tracking-widest uppercase cursor-not-allowed">
                            STAFF CANNOT REQUEST
                        </button>
                    @else
                        <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold tracking-widest uppercase transition-all shadow-lg shadow-red-600/30 flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>SUBMIT REQUEST</span>
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</body>
</html>