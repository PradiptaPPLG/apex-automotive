<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service & Modification Booking — Apex Automotive</title>
    <meta name="description" content="Booking servis berkala & modifikasi performa kendaraan Anda di Apex Automotive Workshop.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #080810; color: #e5e7eb; min-height: 100vh; }
        .portal-nav {
            background: rgba(8,8,16,0.96); border-bottom: 1px solid rgba(255,255,255,0.08);
            padding: 0 2rem; height: 64px; display: flex; align-items: center;
            justify-content: space-between; position: sticky; top: 0; z-index: 50; backdrop-filter: blur(12px);
        }
        .nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .nav-logo img { height: 32px; }
        .nav-logo span { font-family: 'Space Mono', monospace; font-size: 11px; color: #dc2626; letter-spacing: .15em; font-weight: 700; text-transform: uppercase; }
        .nav-actions { display: flex; align-items: center; gap: 12px; }
        .btn-ghost { font-family: 'Space Mono', monospace; font-size: 10px; color: #6b7280; background: none; border: 1px solid rgba(255,255,255,0.1); padding: 6px 12px; cursor: pointer; text-transform: uppercase; letter-spacing: .1em; text-decoration: none; transition: all .2s; }
        .btn-ghost:hover { color: #ef4444; border-color: rgba(239,68,68,.3); }

        .main { max-width: 900px; margin: 0 auto; padding: 3rem 2rem; }
        .page-label { font-family: 'Space Mono', monospace; font-size: 10px; color: #dc2626; letter-spacing: .2em; text-transform: uppercase; font-weight: 700; margin-bottom: 8px; }
        .page-title { font-family: 'Playfair Display', serif; font-size: 2.25rem; font-weight: 800; color: white; line-height: 1.15; }
        .page-sub { font-size: 14px; color: #6b7280; margin-top: 6px; margin-bottom: 2.5rem; }

        /* ── Service Type Cards ── */
        .service-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 2rem; }
        @media(max-width:640px){ .service-grid{ grid-template-columns: repeat(2,1fr); } }
        .service-card {
            border: 2px solid rgba(255,255,255,0.07); background: rgba(255,255,255,0.02);
            padding: 18px 16px; cursor: pointer; transition: all .2s; position: relative;
        }
        .service-card:hover { border-color: rgba(220,38,38,.4); background: rgba(220,38,38,.04); }
        .service-card.selected { border-color: #dc2626; background: rgba(220,38,38,.08); }
        .service-card .icon { font-size: 22px; color: #dc2626; margin-bottom: 10px; }
        .service-card .label { font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 4px; }
        .service-card .desc { font-size: 11px; color: #6b7280; line-height: 1.5; }
        .service-card .checkmark { position: absolute; top: 10px; right: 10px; width: 18px; height: 18px; background: #dc2626; border-radius: 50%; display: none; align-items: center; justify-content: center; font-size: 9px; color: white; }
        .service-card.selected .checkmark { display: flex; }

        /* ── Form ── */
        .form-section { margin-bottom: 2rem; }
        .form-section-title { font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: .1em; margin-bottom: 14px; padding-bottom: 8px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        @media(max-width:600px){ .form-row{ grid-template-columns: 1fr; } }
        .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 14px; }
        .form-group label { font-family: 'Space Mono', monospace; font-size: 10px; color: #9ca3af; text-transform: uppercase; letter-spacing: .1em; font-weight: 700; }
        .form-group input, .form-group select, .form-group textarea {
            background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);
            color: #e5e7eb; padding: 10px 14px; font-size: 14px; font-family: 'Inter', sans-serif;
            width: 100%; outline: none; transition: border-color .2s;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: rgba(220,38,38,.5); }
        .form-group select option { background: #1a1a2e; color: #e5e7eb; }
        .form-group textarea { resize: vertical; min-height: 100px; }

        /* ── Method toggle ── */
        .method-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .method-card { border: 2px solid rgba(255,255,255,0.07); background: rgba(255,255,255,0.02); padding: 16px; cursor: pointer; transition: all .2s; display: flex; align-items: flex-start; gap: 12px; }
        .method-card:hover { border-color: rgba(220,38,38,.3); }
        .method-card.selected { border-color: #dc2626; background: rgba(220,38,38,.06); }
        .method-card .m-icon { font-size: 20px; color: #dc2626; flex-shrink: 0; margin-top: 2px; }
        .method-card .m-label { font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 4px; }
        .method-card .m-desc { font-size: 12px; color: #6b7280; }

        /* ── Garage quick-add ── */
        .garage-add-toggle { font-family: 'Space Mono', monospace; font-size: 11px; color: #dc2626; cursor: pointer; text-decoration: underline; letter-spacing: .05em; margin-bottom: 14px; display: inline-block; background: none; border: none; }
        .garage-add-panel { display: none; background: rgba(220,38,38,.04); border: 1px solid rgba(220,38,38,.2); padding: 16px; margin-bottom: 16px; }
        .garage-add-panel.open { display: block; }

        .btn-submit {
            width: 100%; padding: 16px 24px; background: #dc2626; color: white;
            font-family: 'Space Mono', monospace; font-size: 12px; font-weight: 700;
            letter-spacing: .15em; text-transform: uppercase; border: none; cursor: pointer;
            transition: background .2s; margin-top: 1rem; display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .btn-submit:hover { background: #b91c1c; }
        .alert-success { background: rgba(34,197,94,.1); border: 1px solid rgba(34,197,94,.3); color: #86efac; padding: 12px 16px; font-size: 13px; margin-bottom: 1.5rem; }
    </style>
</head>
<body>
    <nav class="portal-nav">
        <a href="{{ route('portal.dashboard') }}" class="nav-logo">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive">
            <span>Service & Modification</span>
        </a>
        <div class="nav-actions">
            <a href="{{ route('portal.dashboard') }}" class="btn-ghost"><i class="fa-solid fa-arrow-left mr-1"></i> Portal</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-ghost"><i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> Keluar</button>
            </form>
        </div>
    </nav>

    <main class="main">
        <div>
            <p class="page-label">// Book Service & Modification</p>
            <h1 class="page-title">Ajukan Booking Baru</h1>
            <p class="page-sub">Pilih layanan, kendaraan, dan jadwal yang diinginkan. Tim teknisi kami siap melayani.</p>
        </div>

        @if(session('success'))
            <div class="alert-success"><i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('service.store') }}" id="bookingForm">
            @csrf

            {{-- STEP 1: Choose Service Type --}}
            <div class="form-section">
                <div class="form-section-title"><i class="fa-solid fa-wrench mr-2"></i>01. Pilih Jenis Layanan</div>
                <div class="service-grid" id="serviceGrid">
                    @php
                        $serviceTypes = [
                            'periodic_service' => ['icon' => 'fa-oil-can', 'label' => 'Periodic Service', 'desc' => 'Ganti oli, filter, tune-up, inspeksi 360°'],
                            'performance_tuning' => ['icon' => 'fa-gauge-high', 'label' => 'Performance Tuning', 'desc' => 'ECU Remap, Stage 1–3, power upgrade'],
                            'exhaust' => ['icon' => 'fa-fire', 'label' => 'Exhaust System', 'desc' => 'Titanium / custom exhaust fabrication'],
                            'bodywork' => ['icon' => 'fa-car-side', 'label' => 'Bodywork & Aero', 'desc' => 'Carbon kit, diffuser, splitter, wrap'],
                            'suspension' => ['icon' => 'fa-sliders', 'label' => 'Suspension', 'desc' => 'Coilover, airsuspension, alignment'],
                            'custom' => ['icon' => 'fa-screwdriver-wrench', 'label' => 'Custom Modification', 'desc' => 'Diskusikan kebutuhan spesifik Anda'],
                        ];
                    @endphp
                    @foreach($serviceTypes as $key => $type)
                        <div class="service-card {{ old('service_type', 'periodic_service') === $key ? 'selected' : '' }}"
                             onclick="selectService('{{ $key }}', this)">
                            <div class="icon"><i class="fa-solid {{ $type['icon'] }}"></i></div>
                            <div class="label">{{ $type['label'] }}</div>
                            <div class="desc">{{ $type['desc'] }}</div>
                            <div class="checkmark"><i class="fa-solid fa-check"></i></div>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="service_type" id="service_type" value="{{ old('service_type', 'periodic_service') }}">
                @error('service_type')
                    <p style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            {{-- STEP 2: Select Vehicle --}}
            <div class="form-section">
                <div class="form-section-title"><i class="fa-solid fa-car mr-2"></i>02. Pilih Kendaraan</div>

                @if($vehicles->isNotEmpty())
                    <div class="form-group">
                        <label>Kendaraan dari My Garage</label>
                        <select name="vehicle_id" id="vehicle_id" required>
                            @foreach($vehicles as $v)
                                <option value="{{ $v->id }}" {{ old('vehicle_id') == $v->id ? 'selected' : '' }}>
                                    {{ $v->displayName() }}{{ $v->license_plate ? ' — ' . $v->license_plate : '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('vehicle_id')
                            <p style="color:#f87171; font-size:12px;">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <p style="font-size:13px; color:#6b7280; margin-bottom:12px;">Belum ada kendaraan di garage Anda. Daftarkan kendaraan terlebih dahulu.</p>
                    <input type="hidden" name="vehicle_id" id="vehicle_id" value="">
                @endif

                <button type="button" class="garage-add-toggle" onclick="toggleGarageAdd()">
                    <i class="fa-solid fa-plus mr-1"></i> Tambah Kendaraan Baru ke Garage
                </button>

                <div class="garage-add-panel" id="garageAddPanel">
                    <div style="font-family:'Space Mono',monospace; font-size:10px; color:#dc2626; text-transform:uppercase; letter-spacing:.1em; font-weight:700; margin-bottom:12px;">
                        <i class="fa-solid fa-garage mr-1"></i> Daftarkan Kendaraan Baru
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Brand *</label>
                            <input type="text" name="new_brand" placeholder="BMW, Lamborghini, Audi...">
                        </div>
                        <div class="form-group">
                            <label>Model *</label>
                            <input type="text" name="new_model" placeholder="M4 Competition, Urus, R8 GT4...">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" name="new_year" placeholder="2024" min="1980" max="{{ date('Y')+1 }}">
                        </div>
                        <div class="form-group">
                            <label>Warna</label>
                            <input type="text" name="new_color" placeholder="Frozen Black, Grigio Telesto...">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nomor Polisi</label>
                            <input type="text" name="new_license_plate" placeholder="B 1234 XXX">
                        </div>
                        <div class="form-group">
                            <label>Kilometer (KM)</label>
                            <input type="number" name="new_mileage_km" placeholder="12500" min="0">
                        </div>
                    </div>
                    <button type="button" onclick="submitVehicleFirst()" style="background:#dc2626; color:white; border:none; padding:10px 20px; font-family:'Space Mono',monospace; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.1em; cursor:pointer;">
                        <i class="fa-solid fa-plus mr-1"></i> Tambah & Lanjutkan Booking
                    </button>
                </div>
            </div>

            {{-- STEP 3: Booking Details --}}
            <div class="form-section">
                <div class="form-section-title"><i class="fa-solid fa-clipboard-list mr-2"></i>03. Detail Pengerjaan</div>
                <div class="form-group">
                    <label>Judul / Ringkasan *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           placeholder="cth: Ganti Oli + Inspeksi 360° atau ECU Stage 2 Remap">
                    @error('title')
                        <p style="color:#f87171; font-size:12px;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi Keluhan / Keinginan Modifikasi</label>
                    <textarea name="description" placeholder="Ceritakan kondisi kendaraan, keluhan, atau target modifikasi secara detail...">{{ old('description') }}</textarea>
                </div>
            </div>

            {{-- STEP 4: Schedule --}}
            <div class="form-section">
                <div class="form-section-title"><i class="fa-solid fa-calendar-days mr-2"></i>04. Pilih Jadwal</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Pilihan *</label>
                        <input type="date" name="preferred_date" value="{{ old('preferred_date') }}"
                               min="{{ date('Y-m-d') }}" required>
                        @error('preferred_date')
                            <p style="color:#f87171; font-size:12px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Waktu Pilihan *</label>
                        <select name="preferred_time" required>
                            @foreach(['08:00','09:00','10:00','11:00','13:00','14:00','15:00','16:00'] as $t)
                                <option value="{{ $t }}" {{ old('preferred_time') === $t ? 'selected' : '' }}>{{ $t }} WIB</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- STEP 5: Delivery Method --}}
            <div class="form-section">
                <div class="form-section-title"><i class="fa-solid fa-truck-ramp-box mr-2"></i>05. Metode Kedatangan Kendaraan</div>
                <div class="method-cards">
                    <div class="method-card selected" id="method-drop_off" onclick="selectMethod('drop_off')">
                        <div class="m-icon"><i class="fa-solid fa-car-on"></i></div>
                        <div>
                            <div class="m-label">Drop-off ke Workshop</div>
                            <div class="m-desc">Bawa langsung kendaraan Anda ke Workshop APEX Pondok Indah.</div>
                        </div>
                    </div>
                    <div class="method-card" id="method-vip_pickup" onclick="selectMethod('vip_pickup')">
                        <div class="m-icon"><i class="fa-solid fa-truck-monster"></i></div>
                        <div>
                            <div class="m-label">VIP Flatbed Pick-up</div>
                            <div class="m-desc">Armada Flatbed Enclosed Towing APEX menjemput kendaraan Anda.</div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="delivery_method" id="delivery_method" value="{{ old('delivery_method', 'drop_off') }}">
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
                <i class="fa-solid fa-paper-plane"></i>
                AJUKAN BOOKING SERVICE
            </button>
        </form>
    </main>

    <script>
        function selectService(key, el) {
            document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            document.getElementById('service_type').value = key;
        }

        function selectMethod(method) {
            document.querySelectorAll('.method-card').forEach(c => c.classList.remove('selected'));
            document.getElementById('method-' + method).classList.add('selected');
            document.getElementById('delivery_method').value = method;
        }

        function toggleGarageAdd() {
            const panel = document.getElementById('garageAddPanel');
            panel.classList.toggle('open');
        }

        function submitVehicleFirst() {
            const brand = document.querySelector('[name=new_brand]').value.trim();
            const model = document.querySelector('[name=new_model]').value.trim();
            if (!brand || !model) {
                alert('Brand dan Model kendaraan wajib diisi.');
                return;
            }

            // Temporarily submit to garage store, then redirect back
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("garage.vehicles.store") }}';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            ['new_brand','new_model','new_year','new_color','new_license_plate','new_mileage_km'].forEach(n => {
                const el = document.querySelector('[name=' + n + ']');
                if (el && el.value) {
                    const inp = document.createElement('input');
                    inp.type = 'hidden';
                    inp.name = n.replace('new_', '');
                    inp.value = el.value;
                    form.appendChild(inp);
                }
            });

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html>
