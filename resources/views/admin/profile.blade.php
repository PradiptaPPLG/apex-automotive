<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Profil Saya & VIP ID Card — Apex Automotive</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #060609;
            color: #e5e7eb;
            min-height: 100vh;
        }
        .admin-nav {
            background: rgba(6, 6, 9, 0.98);
            border-bottom: 1px solid rgba(220, 38, 38, 0.2);
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .admin-nav-left { display: flex; align-items: center; gap: 16px; }
        .admin-nav-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .admin-nav-logo img { height: 28px; }
        .admin-badge {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: #dc2626;
            border: 1px solid rgba(220,38,38,0.4);
            padding: 3px 8px;
            letter-spacing: 0.15em;
            font-weight: 700;
            text-transform: uppercase;
        }
        .admin-nav-right { display: flex; align-items: center; gap: 16px; font-size: 13px; color: #9ca3af; }
        .nav-link {
            color: #9ca3af;
            text-decoration: none;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: color 0.2s;
        }
        .nav-link:hover, .nav-link.active { color: #dc2626; }
        .logout-btn {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #6b7280;
            background: none;
            border: 1px solid rgba(255,255,255,0.1);
            padding: 6px 12px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.2s;
        }
        .logout-btn:hover { color: #ef4444; border-color: rgba(239, 68, 68, 0.3); }
        .main { max-width: 1200px; margin: 0 auto; padding: 2.5rem 2rem; }
        .page-header { margin-bottom: 2rem; }
        .page-label {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #dc2626;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 800;
            color: white;
        }
        
        .profile-grid {
            display: grid;
            grid-template-columns: 340px 1fr;
            gap: 28px;
            align-items: start;
        }

        /* VIP Access Card */
        .vip-card-box {
            background: rgba(18, 18, 24, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(12px);
        }
        .card-header-slot {
            height: 120px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }
        .card-slot-notch {
            width: 50px;
            height: 10px;
            background: #060609;
            border-radius: 6px;
            margin-top: 12px;
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.5);
        }
        .card-avatar-wrapper {
            position: relative;
            margin: -50px auto 14px;
            text-align: center;
            z-index: 10;
        }
        .card-avatar-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #060609;
            box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
            display: inline-block;
        }
        .card-avatar-fallback {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #18181b 0%, #27272a 100%);
            color: #dc2626;
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 4px solid #060609;
            box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
        }
        .card-user-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 800;
            color: #ffffff;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
            padding: 0 16px;
        }
        .card-user-role {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #dc2626;
            text-align: center;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .card-details-list {
            padding: 0 24px;
            margin-bottom: 24px;
            font-size: 12px;
        }
        .card-detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed rgba(255,255,255,0.06);
        }
        .card-detail-label { color: #6b7280; font-family: 'Space Mono', monospace; font-size: 10px; text-transform: uppercase; }
        .card-detail-val { color: #e5e7eb; font-weight: 600; font-family: 'Space Mono', monospace; font-size: 11px; }

        .qr-wrapper {
            background: #ffffff;
            padding: 12px;
            border-radius: 12px;
            display: inline-block;
            box-shadow: 0 0 20px rgba(220,38,38,0.2);
            margin-bottom: 20px;
        }

        .download-btn {
            width: 100%;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
        }
        .download-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.6);
        }

        /* Form Card */
        .form-card {
            background: rgba(18, 18, 24, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 28px;
            backdrop-filter: blur(12px);
        }
        .form-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: span 2; }
        .form-label {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        .form-input, .form-select {
            background: rgba(6, 6, 9, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 8px;
            padding: 10px 14px;
            color: white;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.2s;
        }
        .form-input:focus, .form-select:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.2);
        }
        .save-btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
        }
        .save-btn:hover { background: #b91c1c; }

        @media (max-width: 900px) {
            .profile-grid { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: span 1; }
        }
    </style>
</head>
<body>
    <nav class="admin-nav">
        <div class="admin-nav-left">
            <a href="{{ route('home') }}" class="admin-nav-logo">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Apex">
            </a>
            <span class="admin-badge">RM Panel</span>
        </div>
        <div class="admin-nav-right">
            <a href="{{ route('admin.inquiries.index') }}" class="nav-link">Dashboard Inquiry</a>
            <a href="{{ route('admin.profile.show') }}" class="nav-link active">Profil & ID Card</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>
        </div>
    </nav>

    <main class="main">
        <div class="page-header">
            <p class="page-label">// Executive Identity & Access Control</p>
            <h1 class="page-title">Profil Saya & VIP Pass</h1>
        </div>

        @if(session('success'))
            <div style="background: rgba(22,163,74,0.15); border: 1px solid rgba(22,163,74,0.4); color: #86efac; padding: 14px 18px; margin-bottom: 24px; border-radius: 8px; font-size: 13px;">
                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="profile-grid">
            
            {{-- Left Column: VIP Access ID Card --}}
            <div>
                <div class="vip-card-box" style="padding-bottom: 24px;">
                    
                    {{-- Header with Notch --}}
                    <div class="card-header-slot" style="{!! $user->card_theme_style !!}">
                        <div class="card-slot-notch"></div>
                    </div>

                    {{-- Avatar --}}
                    <div class="card-avatar-wrapper">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="card-avatar-img" alt="{{ $user->name }}">
                        @else
                            <div class="card-avatar-fallback">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    {{-- User Meta --}}
                    <h3 class="card-user-name">{{ $user->name }}</h3>
                    <div class="card-user-role">
                        <i class="fa-solid fa-shield-halved mr-1"></i>
                        {{ $user->isRm() ? 'Sales Relationship Manager' : ($user->isDelivery() ? 'Escort Specialist' : 'VIP Member') }}
                    </div>

                    {{-- Card Fields --}}
                    <div class="card-details-list">
                        <div class="card-detail-row">
                            <span class="card-detail-label">NIP / NIK</span>
                            <span class="card-detail-val">{{ $user->nik ?? 'APX-' . str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="card-detail-row">
                            <span class="card-detail-label">EMAIL</span>
                            <span class="card-detail-val" style="font-size: 10px;">{{ $user->email }}</span>
                        </div>
                        <div class="card-detail-row">
                            <span class="card-detail-label">NO. HP</span>
                            <span class="card-detail-val">{{ $user->phone ?? '—' }}</span>
                        </div>
                        <div class="card-detail-row">
                            <span class="card-detail-label">STATUS AKSES</span>
                            <span class="card-detail-val" style="color: #22c55e;">
                                <i class="fa-solid fa-circle text-[8px] mr-1"></i> VERIFIED
                            </span>
                        </div>
                    </div>

                    {{-- QR Code Display --}}
                    <div style="text-align: center;">
                        <div class="qr-wrapper">
                            {!! $user->qr_code_svg !!}
                        </div>
                        <p style="font-size: 10px; color: #6b7280; font-family: 'Space Mono', monospace; margin-bottom: 20px; padding: 0 20px;">
                            Gunakan QR Code ini untuk login instan tanpa password via <strong>Sign in with ID Card</strong>.
                        </p>
                    </div>

                    {{-- Action Button --}}
                    <div style="padding: 0 24px;">
                        <button type="button" onclick="downloadIDCard()" class="download-btn">
                            <i class="fa-solid fa-download"></i> Unduh VIP ID Card
                        </button>
                    </div>

                </div>
            </div>

            {{-- Right Column: Edit Profile Form --}}
            <div>
                <div class="form-card">
                    <h2 class="form-section-title">
                        <i class="fa-solid fa-user-gear" style="color:#dc2626;"></i> Informasional Profil & Pengaturan ID Card
                    </h2>

                    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-grid">
                            {{-- Nama --}}
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap <span style="color:#dc2626;">*</span></label>
                                <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                            </div>

                            {{-- Email (Readonly) --}}
                            <div class="form-group">
                                <label class="form-label">Alamat Email (Tetap)</label>
                                <input type="email" class="form-input" value="{{ $user->email }}" readonly style="opacity: 0.6; cursor: not-allowed;">
                            </div>

                            {{-- NIK --}}
                            <div class="form-group">
                                <label class="form-label">NIK / Nomor Identitas</label>
                                <input type="text" name="nik" class="form-input" value="{{ old('nik', $user->nik) }}" placeholder="3201xxxxxxxxxxxx">
                            </div>

                            {{-- Phone --}}
                            <div class="form-group">
                                <label class="form-label">Nomor Telepon / WhatsApp</label>
                                <input type="text" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}" placeholder="+62 812 xxxx xxxx">
                            </div>

                            {{-- Avatar File --}}
                            <div class="form-group">
                                <label class="form-label">Foto Profil (Avatar)</label>
                                <input type="file" name="avatar" class="form-input" accept="image/*">
                            </div>

                            {{-- ID Card Theme --}}
                            <div class="form-group">
                                <label class="form-label">Tema Warna ID Card</label>
                                <select name="id_card_theme" class="form-select">
                                    <option value="1" {{ (old('id_card_theme', $user->id_card_theme) == 1) ? 'selected' : '' }}>Carbon Stealth (Hitam Apex)</option>
                                    <option value="2" {{ (old('id_card_theme', $user->id_card_theme) == 2) ? 'selected' : '' }}>Indigo Luxury (Biru Gelap)</option>
                                    <option value="3" {{ (old('id_card_theme', $user->id_card_theme) == 3) ? 'selected' : '' }}>Emerald Executive (Hijau Dark)</option>
                                    <option value="4" {{ (old('id_card_theme', $user->id_card_theme) == 4) ? 'selected' : '' }}>Cyber Amber (Emas Gelap)</option>
                                    <option value="5" {{ (old('id_card_theme', $user->id_card_theme) == 5) ? 'selected' : '' }}>Crimson Speed (Merah Apex)</option>
                                </select>
                            </div>

                            {{-- Address --}}
                            <div class="form-group full">
                                <label class="form-label">Alamat Domisili / Kantor</label>
                                <input type="text" name="address" class="form-input" value="{{ old('address', $user->address) }}" placeholder="Jl. Sudirman No. 88, Jakarta Selatan">
                            </div>

                            {{-- City & Province --}}
                            <div class="form-group">
                                <label class="form-label">Kota / Kabupaten</label>
                                <input type="text" name="city" class="form-input" value="{{ old('city', $user->city) }}" placeholder="Jakarta Selatan">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Provinsi</label>
                                <input type="text" name="province" class="form-input" value="{{ old('province', $user->province) }}" placeholder="DKI Jakarta">
                            </div>
                        </div>

                        <div style="margin-top: 24px; text-align: right;">
                            <button type="submit" class="save-btn">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Perubahan Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

    {{-- Element ID Card Tersembunyi Khusus untuk Export html2canvas --}}
    <div style="position: absolute; left: -9999px; top: -9999px;">
        <div id="exportIdCardElement" style="width: 320px; background: #060609; border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.15); position: relative; color: #fff; font-family: 'Inter', sans-serif;">
            
            {{-- Top Banner --}}
            <div style="height: 110px; {!! $user->card_theme_style !!} position: relative; display: flex; justify-content: center; align-items: flex-start;">
                <div style="width: 50px; height: 10px; background: #060609; border-radius: 6px; margin-top: 10px; border: 1px solid rgba(255,255,255,0.2);"></div>
            </div>

            {{-- Avatar --}}
            <div style="position: relative; margin: -45px auto 10px; text-align: center; width: 100%;">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 4px solid #060609; box-shadow: 0 4px 12px rgba(0,0,0,0.5); display: inline-block;">
                @else
                    <div style="width: 90px; height: 90px; border-radius: 50%; background: #18181b; color: #dc2626; font-size: 32px; font-weight: 800; display: inline-flex; align-items: center; justify-content: center; border: 4px solid #060609; box-shadow: 0 4px 12px rgba(0,0,0,0.5); font-family: 'Playfair Display', serif;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            {{-- User Info --}}
            <div style="text-align: center; padding: 0 16px;">
                <h3 style="font-size: 15px; font-weight: 800; color: #ffffff; text-transform: uppercase; margin-bottom: 2px; font-family: 'Playfair Display', serif;">{{ $user->name }}</h3>
                <div style="font-size: 9px; font-weight: 700; color: #dc2626; font-family: 'Space Mono', monospace; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 14px;">
                    {{ $user->isRm() ? 'Sales Relationship Manager' : ($user->isDelivery() ? 'Escort Specialist' : 'VIP Member') }}
                </div>

                <div style="font-size: 11px; font-family: 'Space Mono', monospace; color: #9ca3af; margin-bottom: 14px;">
                    ID: {{ $user->nik ?? 'APX-' . str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                </div>
            </div>

            {{-- QR Code --}}
            <div style="margin-bottom: 16px; display: flex; justify-content: center;">
                <div style="background: #ffffff; padding: 10px; border-radius: 10px;">
                    {!! $user->qr_code_svg !!}
                </div>
            </div>

            {{-- Footer --}}
            <div style="background: #dc2626; color: #ffffff; font-size: 9px; font-weight: 700; padding: 8px; text-transform: uppercase; text-align: center; font-family: 'Space Mono', monospace; letter-spacing: 0.15em;">
                APEX AUTOMOTIVE VIP ACCESS PASS
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function downloadIDCard() {
            const element = document.getElementById('exportIdCardElement');
            const parent = element.parentElement;

            // Shift temporarily into view for canvas capture
            const origPos = parent.style.position;
            const origLeft = parent.style.left;
            const origTop = parent.style.top;

            parent.style.position = 'fixed';
            parent.style.left = '0';
            parent.style.top = '0';
            parent.style.zIndex = '-9999';

            html2canvas(element, { scale: 3, useCORS: true, logging: false, backgroundColor: null })
                .then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'Apex-VIP-Card-{{ Str::slug($user->name) }}.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();

                    parent.style.position = origPos;
                    parent.style.left = origLeft;
                    parent.style.top = origTop;
                })
                .catch(err => {
                    console.error("Gagal mengunduh ID Card:", err);
                    parent.style.position = origPos;
                    parent.style.left = origLeft;
                    parent.style.top = origTop;
                });
        }
    </script>
</body>
</html>
