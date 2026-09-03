<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lengkapi Profil VIP — APEX AUTOMOTIVE</title>
    <meta name="description" content="Lengkapi data diri Anda sebelum melakukan pemesanan kendaraan.">
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
        .glass-card {
            background: rgba(14, 14, 18, 0.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.08);
        }
        .input-apex {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            width: 100%;
            padding: 0.8rem 1rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
            border-radius: 0;
        }
        .input-apex:focus {
            border-color: #e50914;
            background: rgba(229,9,20,0.04);
            box-shadow: 0 0 0 3px rgba(229,9,20,0.12);
        }
        .input-apex::placeholder { color: rgba(255,255,255,0.25); }
        .input-apex.error { border-color: rgba(239,68,68,0.6); }

        .step-indicator { transition: all 0.4s ease; }
        .step-active { background: #e50914 !important; border-color: #e50914 !important; color: white !important; }
        .step-done { background: rgba(229,9,20,0.2) !important; border-color: rgba(229,9,20,0.5) !important; color: #e50914 !important; }

        .form-section { display: none; }
        .form-section.active { display: block; }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .form-section.active { animation: fadeSlideIn 0.35s cubic-bezier(0.16,1,0.3,1) both; }

        .btn-red {
            background: linear-gradient(135deg, #e50914, #b80710);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            padding: 0.85rem 2rem;
            border: none;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 18px rgba(229,9,20,0.3);
        }
        .btn-red:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(229,9,20,0.4); }
        .btn-outline {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.7);
            font-family: 'Outfit', sans-serif;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 0.85rem 2rem;
            cursor: pointer;
            transition: border-color 0.2s, color 0.2s;
        }
        .btn-outline:hover { border-color: rgba(255,255,255,0.5); color: white; }

        /* Progress bar */
        .progress-bar { transition: width 0.5s cubic-bezier(0.16,1,0.3,1); }
    </style>
</head>
<body class="bg-[#09090c] text-white font-sans min-h-screen">

    <!-- TOP NAV -->
    <div class="sticky top-0 z-40 bg-[#0a0a0e]/95 backdrop-blur border-b border-white/5 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Apex" class="h-7 w-auto object-contain">
            <span class="font-serif text-sm font-black tracking-widest uppercase text-white">APEX AUTOMOTIVE</span>
        </div>
        <div class="text-[10px] font-mono text-neutral-400 tracking-widest uppercase hidden sm:block">
            <i class="fa-solid fa-lock text-red-500 mr-1.5"></i>
            {{ auth()->user()->email }}
        </div>
    </div>

    <!-- PROGRESS BAR -->
    <div class="h-0.5 bg-neutral-900">
        <div id="progressBar" class="h-full bg-gradient-to-r from-red-700 to-red-500 progress-bar" style="width: 33%"></div>
    </div>

    <div class="max-w-3xl mx-auto px-4 py-12">

        <!-- SECTION HEADER -->
        <div class="text-center space-y-2 mb-10">
            <div class="flex items-center justify-center space-x-2 mb-3">
                <span class="h-px w-8 bg-red-600"></span>
                <span class="text-[10px] font-mono tracking-[0.35em] text-red-500 uppercase font-bold">Langkah Pertama</span>
                <span class="h-px w-8 bg-red-600"></span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-serif font-black uppercase tracking-tight">
                Lengkapi Profil VIP
            </h1>
            <p class="text-sm text-neutral-400 font-light max-w-md mx-auto">
                Data ini diperlukan untuk proses KYC, penerbitan SPK, dan legalitas STNK/BPKB kendaraan Anda.
            </p>
        </div>

        <!-- STEP INDICATORS -->
        <div class="flex items-center justify-center mb-10">
            <div class="flex items-center space-x-2 sm:space-x-4">
                <!-- Step 1 -->
                <div class="flex flex-col items-center space-y-1.5">
                    <div id="step1-circle" class="step-indicator step-active w-9 h-9 rounded-full border-2 flex items-center justify-center text-xs font-bold font-mono">1</div>
                    <span class="text-[9px] font-mono text-red-500 tracking-widest uppercase hidden sm:block">Data Diri</span>
                </div>
                <div class="w-12 sm:w-20 h-px bg-white/10 mx-1"></div>
                <!-- Step 2 -->
                <div class="flex flex-col items-center space-y-1.5">
                    <div id="step2-circle" class="step-indicator w-9 h-9 rounded-full border-2 border-white/20 flex items-center justify-center text-xs font-bold font-mono text-neutral-500">2</div>
                    <span class="text-[9px] font-mono text-neutral-600 tracking-widest uppercase hidden sm:block">Legalitas</span>
                </div>
                <div class="w-12 sm:w-20 h-px bg-white/10 mx-1"></div>
                <!-- Step 3 -->
                <div class="flex flex-col items-center space-y-1.5">
                    <div id="step3-circle" class="step-indicator w-9 h-9 rounded-full border-2 border-white/20 flex items-center justify-center text-xs font-bold font-mono text-neutral-500">3</div>
                    <span class="text-[9px] font-mono text-neutral-600 tracking-widest uppercase hidden sm:block">Alamat</span>
                </div>
            </div>
        </div>

        <!-- VALIDATION ERRORS (global) -->
        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-mono p-4 mb-6 space-y-1">
                @foreach ($errors->all() as $error)
                    <div class="flex items-start space-x-2">
                        <i class="fa-solid fa-triangle-exclamation mt-0.5 shrink-0"></i>
                        <span>{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- MAIN FORM CARD -->
        <div class="glass-card p-8 sm:p-10 shadow-2xl">
            <form action="{{ route('profile.save') }}" method="POST" id="profileForm">
                @csrf

                <!-- ── STEP 1: DATA DIRI ──────────────── -->
                <div id="section-1" class="form-section active space-y-5">
                    <div class="flex items-center space-x-2 mb-6">
                        <i class="fa-solid fa-user-tie text-red-500"></i>
                        <h3 class="text-sm font-bold font-mono tracking-widest uppercase text-neutral-300">Data Diri Pembeli</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2 space-y-1.5">
                            <label class="text-[11px] font-mono tracking-widest uppercase text-neutral-400 font-semibold block">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                   placeholder="Sesuai KTP"
                                   class="input-apex @error('name') error @enderror" required>
                            @error('name')<p class="text-red-500 text-[10px] font-mono">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[11px] font-mono tracking-widest uppercase text-neutral-400 font-semibold block">
                                Nomor HP / WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-neutral-500 text-sm font-mono">+62</span>
                                <input type="tel" name="phone" value="{{ old('phone') }}"
                                       placeholder="812 XXXX XXXX"
                                       class="input-apex pl-12 @error('phone') error @enderror" required>
                            </div>
                            @error('phone')<p class="text-red-500 text-[10px] font-mono">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[11px] font-mono tracking-widest uppercase text-neutral-400 font-semibold block">
                                Alamat Email
                            </label>
                            <input type="email" value="{{ auth()->user()->email }}"
                                   class="input-apex opacity-50 cursor-not-allowed" disabled>
                            <p class="text-[10px] font-mono text-neutral-600">Terverifikasi via OTP</p>
                        </div>
                    </div>
                </div>

                <!-- ── STEP 2: LEGALITAS (NIK & NPWP) ──── -->
                <div id="section-2" class="form-section space-y-5">
                    <div class="flex items-center space-x-2 mb-6">
                        <i class="fa-solid fa-id-card text-red-500"></i>
                        <h3 class="text-sm font-bold font-mono tracking-widest uppercase text-neutral-300">Data Legalitas & Identitas</h3>
                    </div>

                    <!-- KYC Info -->
                    <div class="bg-amber-500/8 border border-amber-500/20 p-4 flex items-start space-x-3 mb-2">
                        <i class="fa-solid fa-circle-info text-amber-400 mt-0.5 shrink-0"></i>
                        <p class="text-xs text-amber-300/80 font-light leading-relaxed">
                            Data NIK dan NPWP diperlukan untuk proses KYC (Know Your Customer), penerbitan Faktur Pajak, dan legalitas kepemilikan kendaraan bermotor di Indonesia.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2 space-y-1.5">
                            <label class="text-[11px] font-mono tracking-widest uppercase text-neutral-400 font-semibold block">
                                Nomor Induk Kependudukan (NIK) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nik" value="{{ old('nik') }}"
                                   placeholder="16 digit sesuai KTP"
                                   maxlength="16"
                                   inputmode="numeric"
                                   class="input-apex @error('nik') error @enderror" required>
                            @error('nik')<p class="text-red-500 text-[10px] font-mono">{{ $message }}</p>@enderror
                        </div>

                        <div class="sm:col-span-2 space-y-1.5">
                            <label class="text-[11px] font-mono tracking-widest uppercase text-neutral-400 font-semibold block">
                                Nomor Pokok Wajib Pajak (NPWP)
                                <span class="text-neutral-600 font-normal">(Opsional)</span>
                            </label>
                            <input type="text" name="npwp" value="{{ old('npwp') }}"
                                   placeholder="XX.XXX.XXX.X-XXX.XXX"
                                   class="input-apex @error('npwp') error @enderror">
                            @error('npwp')<p class="text-red-500 text-[10px] font-mono">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- ── STEP 3: ALAMAT PENGIRIMAN ──────── -->
                <div id="section-3" class="form-section space-y-5">
                    <div class="flex items-center space-x-2 mb-6">
                        <i class="fa-solid fa-location-dot text-red-500"></i>
                        <h3 class="text-sm font-bold font-mono tracking-widest uppercase text-neutral-300">Alamat Domisili & Pengiriman</h3>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[11px] font-mono tracking-widest uppercase text-neutral-400 font-semibold block">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea name="address" rows="2"
                                  placeholder="Nama jalan, nomor, RT/RW, kelurahan, kecamatan"
                                  class="input-apex resize-none @error('address') error @enderror" required>{{ old('address') }}</textarea>
                        @error('address')<p class="text-red-500 text-[10px] font-mono">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-mono tracking-widest uppercase text-neutral-400 font-semibold block">
                                Kota / Kabupaten <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="city" value="{{ old('city') }}"
                                   placeholder="Jakarta Selatan"
                                   class="input-apex @error('city') error @enderror" required>
                            @error('city')<p class="text-red-500 text-[10px] font-mono">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[11px] font-mono tracking-widest uppercase text-neutral-400 font-semibold block">
                                Provinsi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="province" value="{{ old('province') }}"
                                   placeholder="DKI Jakarta"
                                   class="input-apex @error('province') error @enderror" required>
                            @error('province')<p class="text-red-500 text-[10px] font-mono">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[11px] font-mono tracking-widest uppercase text-neutral-400 font-semibold block">
                                Kode Pos <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                                   placeholder="12240"
                                   maxlength="6"
                                   inputmode="numeric"
                                   class="input-apex @error('postal_code') error @enderror" required>
                            @error('postal_code')<p class="text-red-500 text-[10px] font-mono">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- SUBMIT on final step -->
                    <div class="pt-4 border-t border-white/5 flex items-center justify-between">
                        <button type="button" onclick="prevStep()" class="btn-outline">
                            <i class="fa-solid fa-arrow-left mr-2"></i> KEMBALI
                        </button>
                        <button type="submit" class="btn-red">
                            <i class="fa-solid fa-check-double mr-2"></i>
                            SIMPAN & MULAI ORDER
                        </button>
                    </div>
                </div>

                <!-- NAVIGATION (Steps 1 & 2 have next button at bottom) -->
                <div id="stepNavNext" class="pt-6 flex justify-end border-t border-white/5 mt-6">
                    <button type="button" onclick="nextStep()" class="btn-red">
                        LANJUT <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>

            </form>
        </div>

        <!-- PRIVACY NOTE -->
        <p class="text-center text-[10px] font-mono text-neutral-600 mt-6">
            <i class="fa-solid fa-lock mr-1 text-neutral-700"></i>
            Data Anda dienkripsi dan hanya digunakan untuk keperluan proses pembelian kendaraan & kewajiban perpajakan di Indonesia.
        </p>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 3;

        const steps = {
            1: { section: 'section-1', circle: 'step1-circle', progress: '33%' },
            2: { section: 'section-2', circle: 'step2-circle', progress: '66%' },
            3: { section: 'section-3', circle: 'step3-circle', progress: '100%' },
        };

        const stepNavNext = document.getElementById('stepNavNext');

        function showStep(step) {
            // Hide all sections
            document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
            // Show target section
            document.getElementById(steps[step].section).classList.add('active');

            // Update circles
            for (let i = 1; i <= totalSteps; i++) {
                const circle = document.getElementById(`step${i}-circle`);
                circle.className = 'step-indicator w-9 h-9 rounded-full border-2 flex items-center justify-center text-xs font-bold font-mono';
                if (i < step) {
                    circle.classList.add('step-done');
                    circle.innerHTML = '<i class="fa-solid fa-check text-[10px]"></i>';
                } else if (i === step) {
                    circle.classList.add('step-active');
                    circle.textContent = i;
                } else {
                    circle.classList.add('border-white/20', 'text-neutral-500');
                    circle.textContent = i;
                }
            }

            // Update progress bar
            document.getElementById('progressBar').style.width = steps[step].progress;

            // Hide "next" nav on last step (it has its own submit row)
            stepNavNext.style.display = step === totalSteps ? 'none' : 'flex';

            currentStep = step;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function nextStep() {
            if (currentStep < totalSteps) {
                showStep(currentStep + 1);
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        }

        // If there are validation errors, show the correct step based on error fields
        @if ($errors->any())
            @if ($errors->hasAny(['name', 'phone']))
                showStep(1);
            @elseif ($errors->hasAny(['nik', 'npwp']))
                showStep(2);
            @else
                showStep(3);
            @endif
        @endif

        // Initialize
        showStep(1);
    </script>
</body>
</html>
