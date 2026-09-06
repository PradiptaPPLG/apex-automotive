<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Comprehensive Technical Specifications & Documentation — Apex Automotive</title>
    <meta name="description" content="All Info & Detailed Specifications Document for Luxury Supercars & Hypercars.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @include('partials.theme-head')
    <style>
        body {
            background-color: var(--bg-main, #080810);
            color: var(--text-base, #e5e7eb);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }
        .doc-container {
            max-width: 960px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
        }
        .doc-card {
            background: var(--bg-surface, rgba(12, 12, 20, 0.95));
            border: 1px solid var(--border, rgba(255,255,255,0.1));
            padding: 2.5rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
        }
        .doc-header {
            border-bottom: 1px solid var(--border);
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }
        .doc-section-title {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            font-weight: 700;
            color: #ef4444;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .doc-car-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-heading, #ffffff);
            line-height: 1.15;
        }
        .doc-text-block {
            font-size: 14px;
            line-height: 1.8;
            color: var(--text-base);
            margin-bottom: 1.5rem;
        }
        .spec-table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            font-size: 13px;
        }
        .spec-table th, .spec-table td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-soft);
            text-align: left;
        }
        .spec-table th {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            background: var(--bg-hover);
        }
    </style>
</head>
<body>

    <div class="doc-container">
        <!-- BACK NAV -->
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('home') }}" class="px-4 py-2 border border-neutral-300 dark:border-white/20 hover:border-red-500 rounded text-xs font-mono font-bold text-neutral-300 hover:text-white transition-colors inline-flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> KEMBALI KE SHOWROOM
            </a>
            <button onclick="toggleGlobalTheme()" class="apex-theme-btn">
                <i class="fa-solid fa-sun"></i> MODE
            </button>
        </div>

        @php
            $carDocs = [
                'audi_r8' => [
                    'brand' => 'AUDI MOTORSPORT',
                    'title' => 'AUDI R8 V10 PERFORMANCE GT4 SPEC',
                    'subtitle' => 'Comprehensive Technical Blueprint & Official Manufacturer Specification Documentation',
                    'intro' => 'Audi R8 V10 Performance adalah puncak rekayasa supercar bermesin Naturally Aspirated V12/V10 buatan Neckarsulm, Jerman. Menggabungkan arsitektur bodi Audi Space Frame (ASF) berbahan aluminium dan Carbon Fiber Reinforced Polymer (CFRP), kendaraan ini menghadirkan rasio kekakuan torsi tertinggi di kelasnya.',
                    'history' => 'Dikembangkan secara langsung di sasar balap GT4 oleh divisi Audi Sport GmbH, sistem penggerak All-Wheel Drive Quattro permanen memberikan traksi ekstrem dan diferensial belakang mekanis terlunci secara terukur. Dapur pacu 5.2 Litre V10 mampu meraung hingga 8.700 RPM tanpa bantuan turbocharger.',
                    'engine_specs' => [
                        'Mesin & Konfigurasi' => '5.2L (5,204 cc) 90° V10 FSI Direct Injection',
                        'Tenaga Maksimum' => '620 HP @ 8,000 RPM',
                        'Torsi Maksimum' => '580 Nm @ 6,600 RPM',
                        'Transmisi' => '7-Speed S-Tronic Dual-Clutch Transmission',
                        'Penggerak' => 'Quattro Permanent All-Wheel Drive',
                        'Akselerasi 0-100 km/j' => '3.1 Detik',
                        'Kecepatan Maksimum' => '331 KM/H (205 MPH)',
                        'Bobot Kosong' => '1,595 KG (Rasio 2.57 kg/HP)'
                    ]
                ],
                'bmw_m4' => [
                    'brand' => 'BMW MOTORSPORT',
                    'title' => 'BMW M4 COMPETITION COUPE M XDRIVE',
                    'subtitle' => 'Official M Performance Technical Dossier',
                    'intro' => 'BMW M4 Competition Coupe merepresentasikan tradisi divisi M Motorsport dalam memadukan performa lintasan balap sirkuit dengan kenyamanan berkendara harian tingkat tinggi.',
                    'history' => 'Didukung oleh mesin S58 3.0-liter Twin-Turbo Inline-6 bertekanan injeksi 350 bar, mobil ini dilengkapi manifold cetak 3D untuk efisiensi pendinginan termal optimal.',
                    'engine_specs' => [
                        'Mesin' => '3.0L M TwinPower Turbo Inline-6 (S58)',
                        'Tenaga' => '510 HP @ 6,250 RPM',
                        'Torsi' => '650 Nm @ 2,750 - 5,500 RPM',
                        'Transmisi' => '8-Speed M Steptronic dengan Drivelogic',
                        'Drivetrain' => 'M xDrive AWD dengan Mode 2WD Drift Pure Rear',
                        '0-100 km/j' => '3.5 Detik',
                        'Kecepatan Maksimum' => '290 KM/H (M Driver\'s Package)'
                    ]
                ],
                'lamborghini_revuelto' => [
                    'brand' => 'AUTOMOBILI LAMBORGHINI',
                    'title' => 'LAMBORGHINI REVUELTO V12 HPEV HYBRID',
                    'subtitle' => 'High Performance Electrified Vehicle Technical Manual',
                    'intro' => 'Revuelto adalah supercar High Performance Electrified Vehicle (HPEV) pertama buatan Sant\'Agata Bolognese, menetapkan tolok ukur baru dalam hal performa, teknologi, dan kenikmatan berkendara.',
                    'history' => 'Jantung mekanisnya merupakan mesin V12 6.5 liter yang dipadukan secara harmonis dengan 3 motor listrik bertenaga baterai lithium-ion berdensitas daya tinggi.',
                    'engine_specs' => [
                        'Mesin Utama' => '6.5L Mid-Mounted Naturally Aspirated V12 (L545)',
                        'Sistem Elektrik' => '3x Axial Flux Electric Motors (150 HP each)',
                        'Output Kombinasi' => '1,015 HP Total Power Output',
                        'Transmisi' => '8-Speed Transverse Dual Clutch Automatic',
                        '0-100 km/j' => '2.5 Detik',
                        'Kecepatan Maksimum' => '> 350 KM/H'
                    ]
                ],
                'mclaren_senna' => [
                    'brand' => 'MCLAREN AUTOMOTIVE',
                    'title' => 'MCLAREN SENNA GTR TRACK SPECIFICATION',
                    'subtitle' => 'Ultimate Series Aerodynamic & Engineering Document',
                    'intro' => 'Dinamai dari pembalap legenda Formula 1 Ayrton Senna, McLaren Senna GTR adalah mahakarya lintasan balap paling ekstrem yang pernah dirancang tanpa batasan regulasi jalan raya.',
                    'history' => 'Menggunakan monokok serat karbon Monocage III, Senna GTR menghasilkan beban downforce aktif sebesar 800 kg pada kecepatan 250 km/j.',
                    'engine_specs' => [
                        'Mesin' => '4.0L M840TR Twin-Turbocharged V8',
                        'Tenaga' => '825 PS (814 HP) @ 7,250 RPM',
                        'Downforce' => '800 KG Active Aero Load',
                        'Bobot Kering' => '1,188 KG (Power-to-weight 694 PS/tonne)',
                        '0-100 km/j' => '2.8 Detik'
                    ]
                ]
            ];

            $doc = $carDocs[$carKey] ?? $carDocs['audi_r8'];
        @endphp

        <div class="doc-card">
            <div class="doc-header">
                <div class="doc-section-title"><i class="fa-solid fa-file-lines mr-1.5"></i> OFFICIAL TECHNICAL DOSSIER</div>
                <h1 class="doc-car-title">{{ $doc['title'] }}</h1>
                <p class="text-xs font-mono text-neutral-400 mt-2 uppercase tracking-wider font-bold">{{ $doc['subtitle'] }}</p>
            </div>

            <div class="space-y-6">
                <div>
                    <h3 class="font-mono text-xs font-bold text-red-500 uppercase tracking-widest mb-2"><i class="fa-solid fa-circle-info mr-1"></i> OVERVIEW & RINGKASAN DESAIN</h3>
                    <p class="doc-text-block">{{ $doc['intro'] }}</p>
                </div>

                <div>
                    <h3 class="font-mono text-xs font-bold text-red-500 uppercase tracking-widest mb-2"><i class="fa-solid fa-layer-group mr-1"></i> ARSITEKTUR BALAP & WARISAN TEKNOLOGI</h3>
                    <p class="doc-text-block">{{ $doc['history'] }}</p>
                </div>

                <div>
                    <h3 class="font-mono text-xs font-bold text-red-500 uppercase tracking-widest mb-3"><i class="fa-solid fa-sliders mr-1"></i> SPESIFIKASI TEKNIS & PERFORMA LENGKAP</h3>
                    <table class="spec-table">
                        <thead>
                            <tr>
                                <th>KOMPONEN / PARAMETER</th>
                                <th>SPESIFIKASI PABRIKAN (OEM SPEC)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doc['engine_specs'] as $param => $val)
                                <tr>
                                    <td class="font-mono font-bold text-neutral-300">{{ $param }}</td>
                                    <td class="font-mono text-red-400 font-semibold">{{ $val }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono text-neutral-400">
                    <div>Dikeluarkan secara resmi oleh: <strong class="text-white">PT Apex Automotive Indonesia</strong></div>
                    <div>Dokumen Terverifikasi &copy; 2026</div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
