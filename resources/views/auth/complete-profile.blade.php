<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lengkapi Profil VIP — APEX AUTOMOTIVE</title>
    <meta name="description" content="Lengkapi data diri Anda sebelum melakukan pemesanan kendaraan.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;900&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { box-sizing: border-box; }
        body, html { margin: 0; padding: 0; min-height: 100%; font-family: 'Outfit', sans-serif; background-color: #08080a; color: #fff; }

        /* Top Nav */
        .top-navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(10, 10, 14, 0.94);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand-logo-group {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .brand-logo-img { height: 32px; width: auto; }
        .brand-title { font-family: 'Cinzel', serif; font-size: 15px; font-weight: 900; letter-spacing: 3px; color: #fff; line-height: 1; }
        .brand-subtitle { font-size: 9px; font-family: monospace; letter-spacing: 3px; color: rgba(255,255,255,0.5); text-transform: uppercase; margin-top: 2px; }

        /* User Dropdown */
        .user-menu-wrapper { position: relative; }
        .user-menu-btn {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.15);
            padding: 8px 16px;
            color: #fff;
            font-size: 12px;
            font-family: monospace;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            border-radius: 2px;
            transition: all 0.2s ease;
        }
        .user-menu-btn:hover { border-color: #e50914; background: rgba(229,9,20,0.08); }
        .avatar-circle {
            width: 24px;
            height: 24px;
            background: #e50914;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 11px;
        }

        .user-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            width: 220px;
            background: #0f0f14;
            border: 1px solid rgba(255,255,255,0.12);
            border-top: 2px solid #e50914;
            box-shadow: 0 15px 35px rgba(0,0,0,0.8);
            display: none;
            z-index: 100;
        }
        .user-menu-wrapper:hover .user-dropdown { display: block; }
        .dropdown-header { padding: 12px 16px; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .dropdown-email { font-size: 11px; font-family: monospace; color: rgba(255,255,255,0.6); overflow: hidden; text-overflow: ellipsis; }
        .dropdown-btn-logout {
            width: 100%;
            background: none;
            border: none;
            color: #f87171;
            padding: 12px 16px;
            font-size: 11px;
            font-family: monospace;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }
        .dropdown-btn-logout:hover { background: rgba(239, 68, 68, 0.1); }

        /* Main Container */
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-title-box { text-align: center; margin-bottom: 36px; }
        .badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #e50914;
            font-size: 11px;
            font-family: monospace;
            letter-spacing: 4px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .page-h1 {
            font-family: 'Cinzel', serif;
            font-size: 36px;
            font-weight: 900;
            text-transform: uppercase;
            margin: 0 0 10px 0;
            letter-spacing: 1px;
        }
        .page-subtitle { color: rgba(255,255,255,0.5); font-size: 13px; max-width: 460px; margin: 0 auto; line-height: 1.5; }

        /* Form Card */
        .form-card {
            background: rgba(14, 14, 18, 0.92);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-left: 3px solid #e50914;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.8);
        }

        /* Step Tabs */
        .step-tabs {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .step-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,0.4);
            font-size: 12px;
            font-family: monospace;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .step-item.active { color: #fff; font-weight: 700; }
        .step-item.active .step-num { background: #e50914; border-color: #e50914; color: #fff; }
        .step-item.done .step-num { background: rgba(229,9,20,0.2); border-color: #e50914; color: #e50914; }

        .step-num {
            width: 28px;
            height: 28px;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
        }

        /* Form Inputs */
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .full-width { grid-column: span 2; }
        
        .field-group { margin-bottom: 4px; }
        .field-label {
            display: block;
            font-size: 10px;
            font-family: monospace;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.6);
            margin-bottom: 8px;
            font-weight: 600;
        }
        .req { color: #e50914; }

        .input-box {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.15);
            color: #fff;
            padding: 13px 16px;
            font-size: 14px;
            outline: none;
            border-radius: 2px;
            transition: all 0.2s ease;
        }
        .input-box:focus {
            border-color: #e50914;
            background: rgba(229,9,20,0.05);
            box-shadow: 0 0 0 3px rgba(229,9,20,0.15);
        }
        .input-box:disabled { opacity: 0.5; cursor: not-allowed; }
        textarea.input-box { resize: none; height: 90px; }

        /* Buttons */
        .btn-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .btn-red {
            background: linear-gradient(135deg, #e50914 0%, #b80710 100%);
            color: #fff;
            border: none;
            padding: 14px 28px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            border-radius: 2px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 20px rgba(229,9,20,0.4);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-red:hover { opacity: 0.95; transform: translateY(-1px); }
        .btn-outline {
            background: none;
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.7);
            padding: 14px 24px;
            font-size: 11px;
            font-family: monospace;
            cursor: pointer;
            border-radius: 2px;
            transition: all 0.2s ease;
        }
        .btn-outline:hover { border-color: #fff; color: #fff; }

        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
            .full-width { grid-column: span 1; }
            .form-card { padding: 24px; }
            .top-navbar { padding: 14px 20px; }
        }
    </style>
</head>
<body>

    <!-- TOP NAVBAR WITH LOGO AND USER DROPDOWN -->
    <div class="top-navbar">
        <a href="/" class="brand-logo-group">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Logo" class="brand-logo-img">
            <div>
                <div class="brand-title">APEX</div>
                <div class="brand-subtitle">Automotive</div>
            </div>
        </a>

        <!-- USER PROFILE & LOGOUT DROPDOWN RIGHT CORNER -->
        <div class="user-menu-wrapper">
            <div class="user-menu-btn">
                <div class="avatar-circle">
                    {{ strtoupper(substr(auth()->user()->name ?? 'V', 0, 1)) }}
                </div>
                <span>{{ auth()->user()->name ?? 'VIP Buyer' }}</span>
                <i class="fa-solid fa-chevron-down" style="font-size: 10px; color: rgba(255,255,255,0.5);"></i>
            </div>
            <div class="user-dropdown">
                <div class="dropdown-header">
                    <div style="font-size: 9px; font-family: monospace; color: #e50914; text-transform: uppercase; font-weight: 700;">Akun VIP Terverifikasi</div>
                    <div class="dropdown-email">{{ auth()->user()->email }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="dropdown-btn-logout">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>Keluar / Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- MAIN FORM CONTAINER -->
    <div class="container">
        <div class="page-title-box">
            <div class="badge-tag">
                <span>Registrasi Legalitas VIP</span>
            </div>
            <h1 class="page-h1">Lengkapi Profil Anda</h1>
            <p class="page-subtitle">
                Data ini diperlukan untuk penerbitan SPK, legalitas STNK/BPKB, dan konfirmasi pengiriman kendaraan VIP.
            </p>
        </div>

        <div class="form-card">
            <!-- STEP TABS -->
            <div class="step-tabs">
                <div class="step-item active" id="tab-1">
                    <div class="step-num">1</div>
                    <span>Data Diri</span>
                </div>
                <div class="step-item" id="tab-2">
                    <div class="step-num">2</div>
                    <span>Legalitas</span>
                </div>
                <div class="step-item" id="tab-3">
                    <div class="step-num">3</div>
                    <span>Alamat Pengiriman</span>
                </div>
            </div>

            <!-- FORM -->
            <form action="{{ route('profile.save') }}" method="POST" id="profileForm">
                @csrf

                <!-- STEP 1: DATA DIRI -->
                <div id="step-section-1">
                    <div class="form-grid">
                        <div class="field-group full-width">
                            <label class="field-label">Nama Lengkap Sesuai KTP <span class="req">*</span></label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="input-box" required placeholder="Contoh: Pradipta Endra">
                        </div>

                        <div class="field-group">
                            <label class="field-label">Nomor WhatsApp <span class="req">*</span></label>
                            <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="input-box" required placeholder="08123456789">
                        </div>

                        <div class="field-group">
                            <label class="field-label">Alamat Email Terverifikasi</label>
                            <input type="email" value="{{ auth()->user()->email }}" class="input-box" disabled>
                        </div>
                    </div>

                    <div class="btn-row" style="justify-content: flex-end;">
                        <button type="button" class="btn-red" onclick="goToStep(2)">
                            <span>Lanjut Ke Legalitas</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: LEGALITAS (NIK & NPWP) -->
                <div id="step-section-2" style="display: none;">
                    <div class="form-grid">
                        <div class="field-group full-width">
                            <label class="field-label">Nomor Induk Kependudukan (NIK) <span class="req">*</span></label>
                            <input type="text" name="nik" value="{{ old('nik', auth()->user()->nik) }}" maxlength="16" class="input-box" required placeholder="16 Digit Angka KTP">
                        </div>

                        <div class="field-group full-width">
                            <label class="field-label">Nomor Pokok Wajib Pajak (NPWP)</label>
                            <input type="text" name="npwp" value="{{ old('npwp', auth()->user()->npwp) }}" class="input-box" placeholder="Opsional untuk Faktur Pajak">
                        </div>
                    </div>

                    <div class="btn-row">
                        <button type="button" class="btn-outline" onclick="goToStep(1)">&larr; Kembali</button>
                        <button type="button" class="btn-red" onclick="goToStep(3)">
                            <span>Lanjut Ke Alamat</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 3: ALAMAT PENGIRIMAN -->
                <div id="step-section-3" style="display: none;">
                    <div class="form-grid">
                        <div class="field-group full-width">
                            <label class="field-label">Alamat Domisili Lengkap <span class="req">*</span></label>
                            <textarea name="address" class="input-box" required placeholder="Nama jalan, gedung, nomor rumah, RT/RW">{{ old('address', auth()->user()->address) }}</textarea>
                        </div>

                        <div class="field-group">
                            <label class="field-label">Kota / Kabupaten <span class="req">*</span></label>
                            <input type="text" name="city" value="{{ old('city', auth()->user()->city) }}" class="input-box" required placeholder="Contoh: Cijeungjing Selatan">
                        </div>

                        <div class="field-group">
                            <label class="field-label">Provinsi <span class="req">*</span></label>
                            <input type="text" name="province" value="{{ old('province', auth()->user()->province) }}" class="input-box" required placeholder="Contoh: Jawa Barat">
                        </div>

                        <div class="field-group full-width">
                            <label class="field-label">Kode Pos <span class="req">*</span></label>
                            <input type="text" name="postal_code" value="{{ old('postal_code', auth()->user()->postal_code) }}" maxlength="6" class="input-box" required placeholder="12240">
                        </div>
                    </div>

                    <div class="btn-row">
                        <button type="button" class="btn-outline" onclick="goToStep(2)">&larr; Kembali</button>
                        <button type="submit" class="btn-red">
                            <i class="fa-solid fa-check"></i>
                            <span>Simpan & Selesai</span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        function goToStep(step) {
            document.getElementById('step-section-1').style.display = step === 1 ? 'block' : 'none';
            document.getElementById('step-section-2').style.display = step === 2 ? 'block' : 'none';
            document.getElementById('step-section-3').style.display = step === 3 ? 'block' : 'none';

            for (let i = 1; i <= 3; i++) {
                const tab = document.getElementById('tab-' + i);
                tab.className = 'step-item';
                if (i === step) {
                    tab.classList.add('active');
                } else if (i < step) {
                    tab.classList.add('done');
                }
            }
        }
    </script>

</body>
</html>

