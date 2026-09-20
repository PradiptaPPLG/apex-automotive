@extends('manager.layout')
@section('title', 'Profil Saya — Apex Manager')
@section('page_header', 'Profil & ID Card Saya')

@section('content')
<style>
    .profile-grid {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 28px;
        align-items: start;
    }

    /* VIP Access Card */
    .vip-card-box {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
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
        background: rgba(0,0,0,0.4);
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
        border: 4px solid var(--bg-main);
        box-shadow: 0 8px 20px rgba(220,38,38,0.35);
        display: inline-block;
    }
    .card-avatar-fallback {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1e1e2a 0%, #27272a 100%);
        color: #dc2626;
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 4px solid var(--bg-main);
        box-shadow: 0 8px 20px rgba(220,38,38,0.3);
    }
    .card-user-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--text-heading);
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
        margin-bottom: 20px;
        font-size: 12px;
    }
    .card-detail-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px dashed var(--border);
    }
    .card-detail-label {
        color: var(--text-dim);
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        text-transform: uppercase;
    }
    .card-detail-val {
        color: var(--text-base);
        font-weight: 600;
        font-family: 'Space Mono', monospace;
        font-size: 11px;
        text-align: right;
        max-width: 160px;
        word-break: break-all;
    }

    .qr-wrapper {
        background: #ffffff;
        padding: 12px;
        border-radius: 10px;
        display: inline-block;
        box-shadow: 0 0 20px rgba(220,38,38,0.2);
        margin-bottom: 16px;
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
        box-shadow: 0 4px 15px rgba(220,38,38,0.4);
    }
    .download-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(220,38,38,0.6);
    }

    /* Form card */
    .form-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 28px;
        backdrop-filter: blur(12px);
    }
    .form-section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text-heading);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border);
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
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
    .form-input, .form-select {
        background: var(--bg-main);
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 10px 14px;
        color: var(--text-heading);
        font-size: 13px;
        font-family: 'Inter', sans-serif;
        outline: none;
        transition: border-color 0.2s;
        width: 100%;
    }
    .form-input:focus, .form-select:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 2px rgba(220,38,38,0.18);
    }
    .save-btn {
        background: #dc2626;
        color: white;
        border: none;
        padding: 11px 28px;
        border-radius: 6px;
        font-family: 'Space Mono', monospace;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        cursor: pointer;
        transition: background 0.2s;
        margin-top: 10px;
    }
    .save-btn:hover { background: #b91c1c; }

    /* Theme picker */
    .theme-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
        margin-top: 8px;
    }
    .theme-swatch {
        height: 44px;
        border-radius: 6px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.2s;
        position: relative;
    }
    .theme-swatch.selected,
    .theme-swatch:hover { border-color: #ffffff; transform: scale(1.06); }
    .theme-swatch input[type=radio] { display: none; }

    @media (max-width: 900px) {
        .profile-grid { grid-template-columns: 1fr; }
        .form-grid { grid-template-columns: 1fr; }
        .form-group.full { grid-column: span 1; }
    }
</style>

<div class="profile-grid">

    {{-- ======================== LEFT: ID CARD ======================== --}}
    <div>
        <div class="vip-card-box" style="padding-bottom: 24px;">

            {{-- Gradient Header --}}
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

            {{-- Name & Role --}}
            <h3 class="card-user-name">{{ $user->name }}</h3>
            <div class="card-user-role">
                <i class="fa-solid fa-star mr-1"></i> Manager Executive
            </div>

            {{-- Details --}}
            <div class="card-details-list">
                <div class="card-detail-row">
                    <span class="card-detail-label">ID Akun</span>
                    <span class="card-detail-val">APX-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="card-detail-row">
                    <span class="card-detail-label">Email</span>
                    <span class="card-detail-val" style="font-size:9px;">{{ $user->email }}</span>
                </div>
                <div class="card-detail-row">
                    <span class="card-detail-label">No. HP</span>
                    <span class="card-detail-val">{{ $user->phone ?? '—' }}</span>
                </div>
                <div class="card-detail-row">
                    <span class="card-detail-label">Status</span>
                    <span class="card-detail-val" style="color:#22c55e;">
                        <i class="fa-solid fa-circle" style="font-size:7px;"></i> VERIFIED
                    </span>
                </div>
            </div>

            {{-- QR Code --}}
            <div style="text-align: center;">
                <div class="qr-wrapper">
                    {!! $user->qr_code_svg !!}
                </div>
                <p style="font-size:10px; color:var(--text-dim); font-family:'Space Mono',monospace; margin-bottom:20px; padding:0 20px; line-height:1.5;">
                    Gunakan QR Code ini untuk login instan via <strong>Staff ID Card Login</strong> di halaman masuk.
                </p>
            </div>

            {{-- Download Buttons --}}
            <div style="padding: 0 24px; display: flex; gap: 10px;">
                <button type="button" onclick="downloadIDCard()" class="download-btn" style="flex:1; font-size:10px; padding:10px;">
                    <i class="fa-solid fa-id-card"></i> Unduh Kartu
                </button>
                <button type="button" onclick="downloadQRCodeOnly()" class="download-btn" style="flex:1; font-size:10px; padding:10px; background:linear-gradient(135deg, #1f2937 0%, #111827 100%);">
                    <i class="fa-solid fa-qrcode"></i> Unduh QR Saja
                </button>
            </div>

        </div>
    </div>

    {{-- ======================== RIGHT: EDIT FORM ======================== --}}
    <div>
        <div class="form-card">
            <h2 class="form-section-title">
                <i class="fa-solid fa-user-gear" style="color:#dc2626;"></i>
                Informasi Profil & Pengaturan ID Card
            </h2>

            <form method="POST" action="{{ route('manager.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-grid">

                    {{-- Nama --}}
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                        @error('name')<p style="color:#ef4444;font-size:11px;margin-top:4px;">{{ $message }}</p>@enderror
                    </div>

                    {{-- Email (readonly) --}}
                    <div class="form-group">
                        <label class="form-label">Alamat Email (Tetap)</label>
                        <input type="email" class="form-input" value="{{ $user->email }}" readonly style="opacity:0.5;cursor:not-allowed;">
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

                    {{-- Foto Profil --}}
                    <div class="form-group">
                        <label class="form-label">Foto Profil (Avatar)</label>
                        <input type="file" name="avatar" class="form-input" accept="image/*" style="padding:7px 14px;">
                        @if($user->avatar)
                            <p style="font-size:10px;color:var(--text-dim);margin-top:4px;">
                                <i class="fa-solid fa-image" style="color:#dc2626;"></i>
                                Foto saat ini sudah ada. Upload baru untuk mengganti.
                            </p>
                        @endif
                        @error('avatar')<p style="color:#ef4444;font-size:11px;margin-top:4px;">{{ $message }}</p>@enderror
                    </div>

                    {{-- Kota --}}
                    <div class="form-group">
                        <label class="form-label">Kota / Kabupaten</label>
                        <input type="text" name="city" class="form-input" value="{{ old('city', $user->city) }}" placeholder="Jakarta Selatan">
                    </div>

                    {{-- Address --}}
                    <div class="form-group full">
                        <label class="form-label">Alamat Domisili / Kantor</label>
                        <input type="text" name="address" class="form-input" value="{{ old('address', $user->address) }}" placeholder="Jl. Sudirman No. 88, Jakarta Selatan">
                    </div>



                </div>

                <div style="margin-top: 24px; text-align: right;">
                    <button type="submit" class="save-btn">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

{{-- ======================== HIDDEN ID CARD FOR DOWNLOAD ======================== --}}
<div style="position: absolute; left: -9999px; top: -9999px;">
    <div id="exportIdCardElement" style="width:300px; background:#060609; border-radius:0; overflow:hidden; border:1px solid rgba(255,255,255,0.15); position:relative; color:#fff; font-family:'Inter',sans-serif;">

        {{-- Top Banner --}}
        <div style="height:110px; {!! $user->card_theme_style !!} position:relative; display:flex; justify-content:center; align-items:flex-start;">
            <div style="width:50px; height:10px; background:#060609; border-radius:6px; margin-top:10px; border:1px solid rgba(255,255,255,0.2);"></div>
        </div>

        {{-- Avatar --}}
        <div style="position:relative; margin:-45px auto 10px; text-align:center; width:100%;">
            @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" style="width:90px; height:90px; border-radius:50%; object-fit:cover; border:4px solid #060609; box-shadow:0 4px 12px rgba(0,0,0,0.5); display:inline-block;">
            @else
                <div style="width:90px; height:90px; border-radius:50%; background:#18181b; color:#dc2626; font-size:32px; font-weight:800; display:inline-flex; align-items:center; justify-content:center; border:4px solid #060609; box-shadow:0 4px 12px rgba(0,0,0,0.5); font-family:'Playfair Display',serif;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif
        </div>

        {{-- User Info --}}
        <div style="text-align:center; padding:0 16px;">
            <h3 style="font-size:14px; font-weight:800; color:#ffffff; text-transform:uppercase; margin-bottom:2px; font-family:'Playfair Display',serif;">{{ $user->name }}</h3>
            <div style="font-size:9px; font-weight:700; color:#dc2626; font-family:'Space Mono',monospace; letter-spacing:0.1em; text-transform:uppercase; margin-bottom:12px;">
                Manager Executive
            </div>
            <div style="font-size:11px; font-family:'Space Mono',monospace; color:#9ca3af; margin-bottom:14px;">
                ID: APX-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
            </div>
        </div>

        {{-- QR Code --}}
        <div style="margin-bottom:16px; display:flex; justify-content:center;">
            <div style="background:#ffffff; padding:10px; border-radius:10px;">
                {!! $user->qr_code_svg !!}
            </div>
        </div>

        {{-- Footer --}}
        <div style="background:#dc2626; color:#ffffff; font-size:9px; font-weight:700; padding:8px; text-transform:uppercase; text-align:center; font-family:'Space Mono',monospace; letter-spacing:0.15em;">
            APEX AUTOMOTIVE — MANAGER ACCESS
        </div>
    </div>

    {{-- Export just QR Code --}}
    <div id="exportQrOnlyElement" style="width:240px; height:240px; background:#ffffff; display:flex; align-items:center; justify-content:center; padding:15px; border-radius:10px;">
        {!! $user->qr_code_svg !!}
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadIDCard() {
        const element = document.getElementById('exportIdCardElement');
        const parent  = element.parentElement;

        const origPos  = parent.style.position;
        const origLeft = parent.style.left;
        const origTop  = parent.style.top;

        parent.style.position = 'fixed';
        parent.style.left     = '0';
        parent.style.top      = '0';
        parent.style.zIndex   = '-9999';

        html2canvas(element, { scale: 3, useCORS: true, logging: false, backgroundColor: null })
            .then(canvas => {
                const link     = document.createElement('a');
                link.download  = 'Apex-Manager-Card-{{ Str::slug($user->name) }}.png';
                link.href      = canvas.toDataURL('image/png');
                link.click();

                parent.style.position = origPos;
                parent.style.left     = origLeft;
                parent.style.top      = origTop;
            })
            .catch(err => {
                console.error('Gagal mengunduh ID Card:', err);
                parent.style.position = origPos;
                parent.style.left     = origLeft;
                parent.style.top      = origTop;
            });
    }

    function downloadQRCodeOnly() {
        const element = document.getElementById('exportQrOnlyElement');
        const parent  = element.parentElement;

        const origPos  = parent.style.position;
        const origLeft = parent.style.left;
        const origTop  = parent.style.top;

        parent.style.position = 'fixed';
        parent.style.left     = '0';
        parent.style.top      = '0';
        parent.style.zIndex   = '-9999';

        html2canvas(element, { scale: 3, useCORS: true, logging: false, backgroundColor: '#ffffff' })
            .then(canvas => {
                const link     = document.createElement('a');
                link.download  = 'Apex-Manager-QR-{{ Str::slug($user->name) }}.png';
                link.href      = canvas.toDataURL('image/png');
                link.click();

                parent.style.position = origPos;
                parent.style.left     = origLeft;
                parent.style.top      = origTop;
            })
            .catch(err => {
                console.error('Gagal mengunduh QR Code:', err);
                parent.style.position = origPos;
                parent.style.left     = origLeft;
                parent.style.top      = origTop;
            });
    }
</script>
@endsection
