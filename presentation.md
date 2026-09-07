# Laporan Teknologi & Arsitektur Pemrograman Project Apex Automotive

Dokumen ini berisi penjelasan detail mengenai bahasa pemrograman, framework, pustaka, versi yang digunakan, serta alasan pemilihan teknologi dalam pengembangan aplikasi **Apex Automotive**.

---

## 1. Daftar Bahasa Pemrograman & Versi Utama

| No | Bahasa / Teknologi | Versi yang Digunakan | Peran / Fungsi |
|---|---|---|---|
| 1 | **PHP** | `8.5.5` (Requirement: `^8.3`) | **Backend Language** — Logika bisnis server, RESTful API, pengolahan database, autentikasi, dan otorisasi. |
| 2 | **JavaScript (JS)** | `ES6+` (Node/Vite `^8.0.0`) | **Frontend Interactivity & Bundler** — Interaktivitas UI client-side, penanganan event DOM, integrasi AJAX/Fetch, dan bundling aset via Vite. |
| 3 | **HTML5 & Blade** | `Blade (Laravel 13)` | **Templating Engine** — Penyusunan struktur tampilan visual (Views) dan komponen reusabel pada server-side. |
| 4 | **CSS3 & Tailwind CSS** | `v4.0.0` (`@tailwindcss/vite`) | **Styling & UI Framework** — Desain antarmuka responsif, tata letak modern, utilitas styling, dan visual aesthetics. |
| 5 | **SQL** | `SQLite / MySQL` | **Database Query Language** — Pengelolaan basis data relasional melalui ORM (Eloquent). |

---

## 2. Framework Backend: Laravel 13

### **Versi Spesifik:**
- **`laravel/framework`**: `13.30.1`

### **Alasan Menggunakan Laravel 13:**
1. **Performa & Fitur Terbaru PHP 8.3+ / 8.5:**
   Laravel 13 memanfaatkan fitur bahasa PHP paling modern (seperti type-hinting ketat, readonly properties, match expressions, dan peningkatan performa eksekusi).
2. **Struktur Aplikasi Ringkas & Efisien:**
   Versi 13 mengusung arsitektur aplikasi yang lebih bersih dengan konfigurasi terpusat di `bootstrap/app.php` dan `routes/web.php`, mengurangi overhead konfigurasi yang rumit.
3. **Keamanan Maksimal & Terintegrasi (Security First):**
   Memiliki perlindungan bawaan terhadap serangan web populer seperti CSRF (Cross-Site Request Forgery), SQL Injection, XSS, serta enkripsi data bawaan.
4. **Eloquent ORM yang Andal:**
   Mempermudah manipulasi data dan relasi antar tabel (seperti `Car`, `User`, `Inquiry`, `Team`, `RM`) dengan sintaks yang intuitif dan ekspresif.
5. **Ekosistem Modern & Integrasi Vite 8:**
   Laravel 13 terintegrasi secara otomatis dengan Vite (`laravel-vite-plugin` `v3.1`) dan Tailwind CSS v4, memungkinkan proses *Hot Module Replacement (HMR)* dan kompilasi aset yang sangat cepat.
6. **Dukungan Autentikasi OAuth (Socialite v5.31):**
   Memudahkan integrasi login sosial (Google SSO, dll) secara aman dan langsung terpasang dalam project.

---

## 3. Penggunaan JavaScript (JS) dalam Project

### **Apakah Project ini Menggunakan JavaScript?**
**Ya, project ini menggunakan JavaScript.** 

### **Peran dan Pengaplikasian JavaScript (JS):**
1. **Frontend Interactivity & DOM Manipulation:**
   - Mengelola modal interaktif (seperti modal tambah/edit mobil, modal detail tim, dll).
   - Pengaturan dropdown, toggle sidebar, dan switch tema (Dark/Light mode).
   - Penanganan input dinamis seperti countdown OTP dan format otomatis.
2. **AJAX & Asynchronous Data Fetching:**
   - Pengiriman data formulir tanpa reload halaman untuk pengalaman pengguna yang lebih cepat dan fleksibel.
3. **Module Bundling via Vite:**
   - `vite` (`^8.0.0`) dan `laravel-vite-plugin` (`^3.1`) digunakan untuk membundel berkas JavaScript (`resources/js/app.js`) dan CSS secara efisien untuk lingkungan produksi maupun dev.

---

## 4. Rincian Packages & Library Pendukung

### **Backend (Composer Packages):**
- `laravel/framework`: `13.30.1` — Core framework web aplikasi.
- `laravel/socialite`: `5.31.0` — Autentikasi OAuth sosial (Google/GitHub/dll).
- `laravel/tinker`: `3.0.2` — Interactive REPL untuk debugging PHP/Laravel.
- `laravel/boost`: `2.7.0` — Ekstensi konteks & optimasi AI development.
- `laravel/pint`: `1.30.5` — Code formatter PHP otomatis.
- `phpunit/phpunit`: `12.5.34` — Testing framework untuk Unit & Feature test.

### **Frontend (NPM Packages):**
- `vite`: `^8.0.0` — Frontend build tool & bundler.
- `tailwindcss`: `^4.0.0` & `@tailwindcss/vite`: `^4.0.0` — Utility-first CSS framework versi 4.
- `laravel-vite-plugin`: `^3.1` — Jembatan antara Laravel backend dan Vite frontend.

---

## 5. Kesimpulan Presentasi

Aplikasi **Apex Automotive** dibangun menggunakan kombinasi stack teknologi modern berbasis **Laravel 13 (PHP 8.5)** untuk backend yang kokoh, aman, dan efisien, dipadukan dengan **Blade, Tailwind CSS v4, dan JavaScript (JS)** via **Vite 8** untuk menghadirkan antarmuka pengguna yang responsif, dinamis, dan menarik secara visual.
