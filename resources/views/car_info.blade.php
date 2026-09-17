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
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="px-4 py-2 border border-red-600 text-red-500 hover:bg-red-600 hover:text-white rounded-none text-xs font-mono font-bold uppercase tracking-widest transition-all inline-flex items-center gap-2 no-underline" style="text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i> KEMBALI KE SHOWROOM
            </a>
        </div>

        @php
            $descData = [
                'title' => strtoupper($car->name),
                'subtitle' => 'OFFICIAL MANUFACTURER SPECIFICATION',
                'intro' => 'No description available.',
                'history' => 'No history available.'
            ];
            if ($car->description) {
                $parsed = json_decode($car->description, true);
                if(json_last_error() === JSON_ERROR_NONE) {
                    $descData = array_merge($descData, $parsed);
                } else {
                    $descData['intro'] = $car->description;
                }
            }
            $engineSpecs = is_array($car->specs) ? $car->specs : [];
        @endphp

        <div class="doc-card">
            <div class="doc-header">
                <div class="doc-section-title"><i class="fa-solid fa-file-lines mr-1.5"></i> OFFICIAL TECHNICAL DOSSIER</div>
                <h1 class="doc-car-title">{{ $descData['title'] ?: strtoupper($car->name) }}</h1>
                <p class="text-xs font-mono text-neutral-400 mt-2 uppercase tracking-wider font-bold">{{ $descData['subtitle'] }}</p>
            </div>

            <div class="space-y-6">
                @if(!empty($descData['intro']))
                <div>
                    <h3 class="font-mono text-xs font-bold text-red-500 uppercase tracking-widest mb-2"><i class="fa-solid fa-circle-info mr-1"></i> OVERVIEW & RINGKASAN DESAIN</h3>
                    <p class="doc-text-block">{{ $descData['intro'] }}</p>
                </div>
                @endif

                @if(!empty($descData['history']))
                <div>
                    <h3 class="font-mono text-xs font-bold text-red-500 uppercase tracking-widest mb-2"><i class="fa-solid fa-layer-group mr-1"></i> ARSITEKTUR BALAP & WARISAN TEKNOLOGI</h3>
                    <p class="doc-text-block">{{ $descData['history'] }}</p>
                </div>
                @endif

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
                            @foreach($engineSpecs as $param => $val)
                                @php
                                    $specVal = is_array($val) ? ($val['val'] ?? '') : $val;
                                    $specIcon = is_array($val) ? ($val['icon'] ?? 'fa-circle-info') : 'fa-circle-info';
                                @endphp
                                <tr>
                                    <td class="font-mono font-bold text-neutral-300"><i class="fa-solid {{ $specIcon }} text-red-500 mr-2 text-[10px]"></i>{{ $param }}</td>
                                    <td class="font-mono text-red-400 font-semibold">{{ $specVal }}</td>
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
