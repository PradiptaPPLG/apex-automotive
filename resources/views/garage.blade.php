<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apex Garage Customization Studio — Audi R8 GT4 Rims & Performance Tuning</title>
    <meta name="description" content="Garasi Modifikasi Audi R8 GT4 — Kustomisasi Velg & Custom Rims Studio.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Inter:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @include('partials.theme-head')
    <style>
        body {
            background-color: var(--bg-main, #080810);
            color: var(--text-base, #e5e7eb);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }
        .garage-canvas-box {
            position: relative;
            width: 100%;
            height: calc(100vh - 70px);
            background: radial-gradient(circle at center, rgba(30, 30, 45, 0.4) 0%, rgba(8, 8, 16, 0.98) 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }
        .garage-topbar {
            padding: 16px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 20;
            background: rgba(12, 12, 20, 0.6);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }
        .garage-title {
            font-family: 'Cinzel', serif;
            font-size: 1.4rem;
            font-weight: 900;
            color: var(--text-heading);
            letter-spacing: 0.05em;
        }
        .garage-subtitle {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #ef4444;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 700;
        }
        .car-viewport {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 20px;
        }
        .car-stage-img {
            max-width: 90%;
            max-height: 65vh;
            object-fit: contain;
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.8));
            transition: opacity 0.3s ease, transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .rim-badge-overlay {
            position: absolute;
            top: 24px;
            left: 32px;
            background: rgba(12, 12, 20, 0.85);
            backdrop-filter: blur(10px);
            padding: 12px 18px;
            border: 1px solid var(--border);
            border-left: 3px solid #ef4444;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            z-index: 10;
        }
        .garage-bottom-panel {
            padding: 20px 32px;
            background: rgba(12, 12, 20, 0.92);
            backdrop-filter: blur(16px);
            border-top: 1px solid var(--border);
            z-index: 20;
        }
        .category-tab-btn {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 4px;
            border: 1px solid var(--border);
            background: var(--bg-input);
            color: var(--text-muted);
            cursor: pointer;
            text-transform: uppercase;
            transition: all 0.2s;
        }
        .category-tab-btn.active {
            background: #ef4444;
            color: #ffffff;
            border-color: #ef4444;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }
        .category-tab-btn.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            background: transparent;
        }
        .rim-thumb-card {
            width: 130px;
            height: 105px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            flex-shrink: 0;
        }
        .rim-thumb-card:hover {
            border-color: #ef4444;
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.2);
        }
        .rim-thumb-card.active {
            border-color: #ef4444;
            background: rgba(239, 68, 68, 0.08);
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.4);
        }
        .rim-thumb-card img {
            width: 58px;
            height: 58px;
            object-fit: contain;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.5));
        }
    </style>
</head>
<body>

    <div class="garage-canvas-box">
        <!-- TOPBAR NAV -->
        <div class="garage-topbar">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="px-3.5 py-1.5 border border-neutral-300 dark:border-white/20 hover:border-red-500 rounded text-xs font-mono font-bold text-neutral-300 hover:text-white transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> LANDING SHOWROOM
                </a>
                <div>
                    <span class="garage-subtitle"><i class="fa-solid fa-screwdriver-wrench mr-1"></i> APEX GARAGE STUDIO</span>
                    <h1 class="garage-title">AUDI R8 GT4 CUSTOMIZATION</h1>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="toggleGlobalTheme()" class="apex-theme-btn">
                    <i class="fa-solid fa-moon"></i> THEME
                </button>
                <a href="{{ route('car.info', ['car' => 'audi_r8']) }}" class="px-4 py-2 bg-neutral-900 hover:bg-neutral-800 border border-white/20 text-white text-xs font-mono font-bold uppercase rounded flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-red-500"></i> ALL INFO & DOCS
                </a>
            </div>
        </div>

        <!-- MAIN CAR VIEWPORT -->
        <div class="car-viewport">
            <div class="rim-badge-overlay">
                <div class="text-[9px] font-mono text-neutral-400 uppercase tracking-widest font-bold">SELECTED WHEELS</div>
                <div id="activeRimTitle" class="font-bold text-base text-white tracking-wide font-mono mt-0.5">3SDM 3.33 FX2</div>
                <div id="activeRimSpec" class="text-[10px] font-mono text-red-400 mt-0.5">20" FORGED COMPETITION SPEC</div>
            </div>

            <!-- AUDI R8 CAR STAGE -->
            <img id="garageCarStage" src="{{ asset('images/brand/velg_3SDM_3.33_fx2_audi_r8_gt4.webp') }}" alt="Audi R8 GT4 Custom Rims" class="car-stage-img">
        </div>

        <!-- BOTTOM CUSTOMIZATION TOOLBAR -->
        <div class="garage-bottom-panel space-y-4">
            <!-- CATEGORY SELECTOR TABS -->
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
                <div class="flex items-center gap-3">
                    <button class="category-tab-btn active"><i class="fa-solid fa-dharmachakra mr-1.5"></i> CUSTOM WHEELS / VELG (7)</button>
                    <button class="category-tab-btn disabled" title="Modifikasi Aero Kit hanya pada Audi R8 GT4"><i class="fa-solid fa-wing mr-1.5"></i> SPOILERS (UNAVAILABLE)</button>
                    <button class="category-tab-btn disabled" title="Modifikasi Exhaust"><i class="fa-solid fa-fire mr-1.5"></i> EXHAUST SYSTEM (UNAVAILABLE)</button>
                    <button class="category-tab-btn disabled" title="Modifikasi Suspens"><i class="fa-solid fa-sliders mr-1.5"></i> SUSPENSION (UNAVAILABLE)</button>
                </div>
                <span class="text-[11px] font-mono text-neutral-400 font-bold uppercase">MODEL: AUDI R8 GT4 COMPETITION</span>
            </div>

            <!-- RIMS CAROUSEL / GRID -->
            <div class="flex items-center gap-4 overflow-x-auto pb-2" id="rimsContainer">
                <!-- 1. 3SDM 3.33 fx2 -->
                <div class="rim-thumb-card active" onclick="selectGarageRim(0)">
                    <img src="{{ asset('images/modified/rims/3SDM 3.33 fx2.webp') }}" alt="3SDM 3.33 fx2">
                    <span class="text-[9px] font-mono font-bold text-neutral-200 text-center uppercase truncate w-full">3.33 FX2</span>
                </div>

                <!-- 2. 3SDM 3.84 Red -->
                <div class="rim-thumb-card" onclick="selectGarageRim(1)">
                    <img src="{{ asset('images/modified/rims/3SDM 3.84 Red.webp') }}" alt="3SDM 3.84 Red">
                    <span class="text-[9px] font-mono font-bold text-neutral-200 text-center uppercase truncate w-full">3.84 RED</span>
                </div>

                <!-- 3. 3SDM 3pc Alloy -->
                <div class="rim-thumb-card" onclick="selectGarageRim(2)">
                    <img src="{{ asset('images/modified/rims/3SDM 3pc Alloy.webp') }}" alt="3SDM 3pc Alloy">
                    <span class="text-[9px] font-mono font-bold text-neutral-200 text-center uppercase truncate w-full">3PC ALLOY</span>
                </div>

                <!-- 4. 3SDM 3pc forged -->
                <div class="rim-thumb-card" onclick="selectGarageRim(3)">
                    <img src="{{ asset('images/modified/rims/3SDM 3pc forged.webp') }}" alt="3SDM 3pc forged">
                    <span class="text-[9px] font-mono font-bold text-neutral-200 text-center uppercase truncate w-full">3PC FORGED</span>
                </div>

                <!-- 5. 3SDM 3pc pink -->
                <div class="rim-thumb-card" onclick="selectGarageRim(4)">
                    <img src="{{ asset('images/modified/rims/3SDM 3pc pink.webp') }}" alt="3SDM 3pc pink">
                    <span class="text-[9px] font-mono font-bold text-neutral-200 text-center uppercase truncate w-full">3PC PINK</span>
                </div>

                <!-- 6. 3SDM Street old -->
                <div class="rim-thumb-card" onclick="selectGarageRim(5)">
                    <img src="{{ asset('images/modified/rims/3SDM Street old.webp') }}" alt="3SDM Street old">
                    <span class="text-[9px] font-mono font-bold text-neutral-200 text-center uppercase truncate w-full">STREET OLD</span>
                </div>

                <!-- 7. Alloy gloss black -->
                <div class="rim-thumb-card" onclick="selectGarageRim(6)">
                    <img src="{{ asset('images/modified/rims/Alloy gloss black.webp') }}" alt="Alloy gloss black">
                    <span class="text-[9px] font-mono font-bold text-neutral-200 text-center uppercase truncate w-full">GLOSS BLACK</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        const RIMS_DATABASE = [
            { name: '3SDM 3.33 FX2 FORGED', spec: '20" SILVER / GUNMETAL COMPETITION', img: "{{ asset('images/brand/velg_3SDM_3.33_fx2_audi_r8_gt4.webp') }}" },
            { name: '3SDM 3.84 RED EDITION', spec: '20" MONOBLOCK RED ANODIZED', img: "{{ asset('images/brand/velg_3SDM_3.84_Red_audi_r8_gt4.webp') }}" },
            { name: '3SDM 3PC ALLOY CUSTOM', spec: '20" 3-PIECE BRUSHED ALLOY', img: "{{ asset('images/brand/velg_3SDM_3pc_Alloy_audi_r8_gt4.webp') }}" },
            { name: '3SDM 3PC FORGED ULTRA', spec: '20" LIGHTWEIGHT RACE FORGED', img: "{{ asset('images/brand/velg_3SDM_3pc_forged_audi_r8_gt4.webp') }}" },
            { name: '3SDM 3PC PINK MAGENTA', spec: '20" CUSTOM DRIFT PINK FINISH', img: "{{ asset('images/brand/velg_3SDM_3pc_pink_audi_r8_gt4.webp') }}" },
            { name: '3SDM STREET OLD SCHOOL', spec: '19" RETRO HERITAGE SPEC', img: "{{ asset('images/brand/velg_3SDM_Street_old_audi_r8_gt4.png') }}" },
            { name: 'ALLOY GLOSS BLACK TECH', spec: '20" PIANO GLOSS BLACK FORGED', img: "{{ asset('images/brand/velg_Alloy_gloss_black_audi_r8_gt4.webp') }}" }
        ];

        function selectGarageRim(index) {
            const rim = RIMS_DATABASE[index];
            if (!rim) return;

            const stage = document.getElementById('garageCarStage');
            const title = document.getElementById('activeRimTitle');
            const spec = document.getElementById('activeRimSpec');

            stage.style.opacity = '0.3';
            stage.style.transform = 'scale(0.97)';

            setTimeout(() => {
                stage.src = rim.img;
                stage.style.opacity = '1';
                stage.style.transform = 'scale(1)';
            }, 180);

            title.innerText = rim.name;
            spec.innerText = rim.spec;

            const cards = document.querySelectorAll('.rim-thumb-card');
            cards.forEach((card, i) => {
                if (i === index) {
                    card.classList.add('active');
                } else {
                    card.classList.remove('active');
                }
            });
        }
    </script>
</body>
</html>
