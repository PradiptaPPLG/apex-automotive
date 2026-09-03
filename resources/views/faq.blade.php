<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertanyaan Umum (FAQ) — PT Apex Automotive Indonesia</title>
    <meta name="description" content="Informasi lengkap mengenai alur konsultasi VIP, pembuatan SPK, verifikasi dokumen legalitas KYC, skema pembayaran escrow, hingga pengiriman serah terima supercar.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #080810;
            color: #e5e7eb;
            min-height: 100vh;
        }
        .faq-nav {
            background: rgba(8, 8, 16, 0.95);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(12px);
        }
        .faq-nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .faq-nav-logo img { height: 32px; }
        .faq-nav-logo span {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            color: #dc2626;
            letter-spacing: 0.15em;
            font-weight: 700;
            text-transform: uppercase;
        }
        .main-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }
        .page-label {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #dc2626;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            line-height: 1.15;
            margin-bottom: 1rem;
        }
        .page-subtitle {
            font-size: 15px;
            color: #9ca3af;
            line-height: 1.6;
            margin-bottom: 3rem;
        }
        .faq-category {
            margin-bottom: 3rem;
        }
        .category-title {
            font-family: 'Space Mono', monospace;
            font-size: 12px;
            color: #dc2626;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 700;
            border-bottom: 1px solid rgba(220, 38, 38, 0.3);
            padding-bottom: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .faq-item {
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(255,255,255,0.07);
            margin-bottom: 12px;
            border-radius: 2px;
            overflow: hidden;
        }
        .faq-question {
            padding: 18px 24px;
            font-weight: 600;
            font-size: 15px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            user-select: none;
            transition: background 0.2s;
        }
        .faq-question:hover {
            background: rgba(255,255,255,0.03);
        }
        .faq-answer {
            padding: 0 24px 20px;
            font-size: 14px;
            color: #9ca3af;
            line-height: 1.6;
            display: none;
        }
        .faq-item.active .faq-answer {
            display: block;
        }
        .faq-item.active .faq-icon {
            transform: rotate(180deg);
            color: #dc2626;
        }
        .faq-icon {
            transition: transform 0.2s;
            color: #6b7280;
            font-size: 12px;
        }
        .nav-link-btn {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            color: #d1d5db;
            text-decoration: none;
            border: 1px solid rgba(255,255,255,0.15);
            padding: 8px 16px;
            transition: all 0.2s;
        }
        .nav-link-btn:hover {
            color: white;
            border-color: #dc2626;
            background: rgba(220,38,38,0.1);
        }
    </style>
</head>
<body>
    <nav class="faq-nav">
        <a href="{{ route('home') }}" class="faq-nav-logo">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Apex Automotive">
            <span>Showroom &amp; Consultation</span>
        </a>
        <div>
            @auth
                <a href="{{ route('portal.dashboard') }}" class="nav-link-btn">
                    <i class="fa-solid fa-user-shield mr-1"></i> Portal VIP Saya
                </a>
            @else
                <a href="{{ route('login') }}" class="nav-link-btn">
                    <i class="fa-solid fa-arrow-right-to-bracket mr-1"></i> Masuk Akun
                </a>
            @endauth
        </div>
    </nav>

    <main class="main-content">
        <div>
            <p class="page-label">// FAQ &amp; Acquiring Guidance</p>
            <h1 class="page-title">Pertanyaan Sering Diajukan</h1>
            <p class="page-subtitle">Panduan lengkap mengenai alur akusisi supercar, kepatuhan legalitas hukum, transaksi escrow terproteksi, hingga penyerahan kunci kendaraan di PT Apex Automotive Indonesia.</p>
        </div>

        <!-- CATEGORY 1 -->
        <div class="faq-category">
            <h3 class="category-title"><i class="fa-solid fa-comments"></i> Phase 1 &amp; 2: Discovery &amp; Consultation</h3>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Bagaimana alur awal konsultasi pemesanan unit mobil mewah?</span>
                    <i class="fa-solid fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Anda dapat memilih varian warna dan paket kustomisasi aero/bodykit melalui mode <strong>Car Configurator</strong> di etalase kami, lalu menekan tombol <strong>"REQUEST VIP VIEWING"</strong>. Data Anda akan terisi otomatis jika sudah masuk ke akun VIP. Tim dedicated Sales Relationship Manager (RM) akan langsung menghubungi Anda dalam waktu 2 jam kerja.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Apakah saya bisa melakukan Test Drive atau Private Lounge Consultation?</span>
                    <i class="fa-solid fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Ya, Sales RM kami memfasilitasi inspeksi unit &amp; konsultasi privat di Apex Private Lounge Pondok Indah, Jakarta Selatan, atau pengiriman unit peninjauan khusus ke kediaman Anda.
                </div>
            </div>
        </div>

        <!-- CATEGORY 2 -->
        <div class="faq-category">
            <h3 class="category-title"><i class="fa-solid fa-file-contract"></i> Phase 3 &amp; 4: Legal Verified (KYC &amp; E-Sign)</h3>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Dokumen apa saja yang wajib diunggah untuk verifikasi KYC?</span>
                    <i class="fa-solid fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <strong>Atas Nama Perorangan:</strong> KTP/Paspor Pembeli &amp; Nama STNK, Kartu Keluarga (KK), dan NPWP.<br><br>
                    <strong>Atas Nama PT/Korporasi:</strong> KTP Direksi, NPWP Perusahaan &amp; NIB, Akta Pendirian Perusahaan beserta SK Menkumham.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Bagaimana penandatanganan dokumen SPK dan SPA dilakukan?</span>
                    <i class="fa-solid fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Seluruh dokumen kesepakatan jual beli (Sales &amp; Purchase Agreement) diterbitkan secara sah dan dilindungi meterai elektronik (e-Meterai). Anda dapat membubuhkan tanda tangan digital (E-Sign) secara aman langsung dari Portal VIP Pembeli Anda.
                </div>
            </div>
        </div>

        <!-- CATEGORY 3 -->
        <div class="faq-category">
            <h3 class="category-title"><i class="fa-solid fa-shield-halved"></i> Phase 5 &amp; 6: Escrow Settlement &amp; Delivery</h3>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Bagaimana skema pembayaran dan keamanan dana escrow?</span>
                    <i class="fa-solid fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Seluruh transaksi Booking Fee, Down Payment (DP), maupun Pelunasan dilakukan melalui Rekening Escrow Terproteksi PT Apex Automotive Indonesia. Faktur Pajak Resmi dan Digital Official Receipt diterbitkan secara otomatis setelah verifikasi oleh Finance Officer kami.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Bagaimana proses pengiriman White-Glove Enclosed Delivery?</span>
                    <i class="fa-solid fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Kendaraan dikirimkan menggunakan armada <em>Enclosed Flatbed Tow Truck</em> tertutup untuk menjaga kerahasiaan dan keamanan fisik mobil. Pembeli dapat menentukan jadwal pengiriman, lokasi serah terima (Garasi/Penthouse), serta permintaan khusus seremoni <em>VIP Ribbon Unveiling</em>.
                </div>
            </div>
        </div>

    </main>

    <script>
        function toggleFaq(element) {
            const item = element.parentElement;
            item.classList.toggle('active');
        }
    </script>
</body>
</html>
