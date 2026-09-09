@extends('manager.layout')

@section('title', $car->exists ? 'Edit Mobil Showroom' : 'Tambah Mobil Showroom Baru')
@section('page_header', $car->exists ? 'Edit Mobil: '.$car->name : 'Tambah Mobil Showroom Baru')

@section('content')
<div style="max-width: 850px;">
    <div class="card-panel">
        <form method="POST" action="{{ $car->exists ? route('manager.cars.update', $car) : route('manager.cars.store') }}" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf
            @if($car->exists)
                @method('PUT')
            @endif

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div style="position: relative;">
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Nama Unit / Model <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" id="carNameInput" value="{{ old('name', $car->name) }}" required placeholder="Contoh: McLaren Senna GTR" class="mgr-input" autocomplete="off">
                    <div id="carSuggestions" style="position: absolute; top: 100%; left: 0; right: 0; background: var(--bg-panel, #ffffff); border: 1px solid var(--border); border-radius: 4px; z-index: 50; display: none; max-height: 200px; overflow-y: auto; margin-top: 4px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"></div>
                    @error('name')
                        <span style="color: #f87171; font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Brand / Manufacturer</label>
                    <input type="text" name="brand" id="carBrandInput" value="{{ old('brand', $car->brand) }}" placeholder="Contoh: McLaren Automotive" class="mgr-input">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Kategori <span style="color:#ef4444;">*</span></label>
                    <select name="category" required class="mgr-select">
                        <option value="Hypercar"   {{ old('category', $car->category) == 'Hypercar'    ? 'selected' : '' }}>Hypercar</option>
                        <option value="Supercar"   {{ old('category', $car->category) == 'Supercar'    ? 'selected' : '' }}>Supercar</option>
                        <option value="Luxury SUV" {{ old('category', $car->category) == 'Luxury SUV'  ? 'selected' : '' }}>Luxury SUV</option>
                        <option value="Grand Tourer" {{ old('category', $car->category) == 'Grand Tourer' ? 'selected' : '' }}>Grand Tourer</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Harga Estimasi (IDR) <span style="color:#ef4444;">*</span></label>
                    <input type="number" name="price" value="{{ old('price', $car->price) }}" required placeholder="Contoh: 25000000000" class="mgr-input">
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Tahun</label>
                    <input type="number" name="year" value="{{ old('year', $car->year ?? date('Y')) }}" placeholder="2026" class="mgr-input">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Transmisi</label>
                    <input type="text" name="transmission" value="{{ old('transmission', $car->transmission) }}" placeholder="7-Speed Dual Clutch" class="mgr-input">
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Bahan Bakar</label>
                    <input type="text" name="fuel_type" value="{{ old('fuel_type', $car->fuel_type) }}" placeholder="V8 Twin-Turbo / Hybrid" class="mgr-input">
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Status Ketersediaan <span style="color:#ef4444;">*</span></label>
                    <select name="status" required class="mgr-select">
                        <option value="available" {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>Available (Tersedia)</option>
                        <option value="reserved"  {{ old('status', $car->status) == 'reserved'  ? 'selected' : '' }}>Reserved (Dipesan)</option>
                        <option value="sold"      {{ old('status', $car->status) == 'sold'      ? 'selected' : '' }}>Sold (Terjual)</option>
                    </select>
                </div>
            </div>

            <!-- Upload Gambar Section -->
            <div style="background: var(--bg-hover); border: 1px dashed var(--border); padding: 18px; border-radius: 6px;">
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 8px; font-weight: 700;">
                    <i class="fa-solid fa-image" style="color: #ef4444; margin-right: 4px;"></i> Upload Foto Utama Kendaraan
                </label>
                
                <div style="display: grid; grid-template-columns: 1fr 140px; gap: 16px; align-items: start;">
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div>
                            <span style="font-size: 11px; color: var(--text-muted); display: block; margin-bottom: 4px;">Option 1: Upload File Berkas Gambar</span>
                            <input type="file" name="image_file" accept="image/*" class="mgr-input" onchange="previewImageFile(this)" style="padding: 8px;">
                            @error('image_file')
                                <span style="color: #f87171; font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <span style="font-size: 11px; color: var(--text-muted); display: block; margin-bottom: 4px;">Option 2: Atau Tautkan URL Gambar Direct (Opsional)</span>
                            <input type="url" name="image_url" id="imageUrlInput" value="{{ old('image_url', $car->image_url) }}" placeholder="https://..." class="mgr-input" oninput="previewImageUrl(this.value)">
                        </div>
                    </div>

                    <div>
                        <span style="font-size: 10px; font-family: 'Space Mono', monospace; color: var(--text-muted); display: block; margin-bottom: 4px;">PREVIEW FOTO:</span>
                        <div id="imagePreviewContainer" style="width: 140px; height: 95px; border-radius: 6px; overflow: hidden; background: #000; border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; position: relative;">
                            @if($car->image_url)
                                <img id="imagePreviewImg" src="{{ $car->image_url }}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div id="imagePreviewPlaceholder" style="text-align: center; color: var(--text-dim); font-size: 11px;">
                                    <i class="fa-solid fa-cloud-arrow-up" style="font-size: 20px; display: block; margin-bottom: 4px; color: #ef4444;"></i>
                                    Format JPG/PNG/WEBP
                                </div>
                                <img id="imagePreviewImg" src="" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Varian Warna & Palet Warna Section -->
            <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--border); padding: 18px; border-radius: 6px; margin-top: 4px;">
                <div style="margin-bottom: 14px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <label style="font-family: 'Space Mono', monospace; font-size: 12px; color: var(--text-heading); text-transform: uppercase; font-weight: 700;">
                            <i class="fa-solid fa-palette" style="color: #ef4444; margin-right: 6px;"></i> Palet Warna & Varian Warna Kendaraan
                        </label>
                        <button type="button" onclick="addColorRow('', '#dc2626')" style="padding: 6px 14px; background: #dc2626; color: #fff; border: none; border-radius: 4px; font-size: 11px; cursor: pointer; font-family: 'Space Mono', monospace; font-weight: 700;">
                            <i class="fa-solid fa-plus"></i> Tambah Warna
                        </button>
                    </div>
                    <p style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">Kelola pilihan varian warna mobil. Palet warna ini akan otomatis muncul sebagai tombol lingkaran warna interaktif pada popup inspector buyer.</p>

                    <!-- Quick Preset Buttons -->
                    <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 10px;">
                        <span style="font-size: 10px; font-family: 'Space Mono', monospace; color: var(--text-muted); align-self: center; margin-right: 4px;">PRESET WARNA:</span>
                        <button type="button" onclick="addColorRow('Rosso Corsa Red', '#dc2626')" style="padding: 3px 8px; background: rgba(220,38,38,0.2); border: 1px solid #dc2626; color: #f87171; border-radius: 3px; font-size: 10px; cursor: pointer;">🔴 Rosso Corsa</button>
                        <button type="button" onclick="addColorRow('Obsidian Black', '#111827')" style="padding: 3px 8px; background: rgba(17,24,39,0.5); border: 1px solid #4b5563; color: #d1d5db; border-radius: 3px; font-size: 10px; cursor: pointer;">⚫ Obsidian Black</button>
                        <button type="button" onclick="addColorRow('Pearl White', '#f9fafb')" style="padding: 3px 8px; background: rgba(249,250,251,0.1); border: 1px solid #e5e7eb; color: #ffffff; border-radius: 3px; font-size: 10px; cursor: pointer;">⚪ Pearl White</button>
                        <button type="button" onclick="addColorRow('Giallo Auge Yellow', '#f59e0b')" style="padding: 3px 8px; background: rgba(245,158,11,0.2); border: 1px solid #f59e0b; color: #fbbf24; border-radius: 3px; font-size: 10px; cursor: pointer;">🟡 Giallo Yellow</button>
                        <button type="button" onclick="addColorRow('Blu Nethuns', '#2563eb')" style="padding: 3px 8px; background: rgba(37,99,235,0.2); border: 1px solid #2563eb; color: #60a5fa; border-radius: 3px; font-size: 10px; cursor: pointer;">🔵 Blu Nethuns</button>
                        <button type="button" onclick="addColorRow('Verde Mantis Green', '#16a34a')" style="padding: 3px 8px; background: rgba(22,163,74,0.2); border: 1px solid #16a34a; color: #4ade80; border-radius: 3px; font-size: 10px; cursor: pointer;">🟢 Verde Green</button>
                    </div>
                </div>

                <div id="colorsContainer" style="display: flex; flex-direction: column; gap: 10px;">
                    @php
                        $existingColors = old('color_names')
                            ? array_map(function($n, $h) { return ['name' => $n, 'hex' => $h]; }, old('color_names'), old('color_hexes'))
                            : ($car->specs['colors'] ?? []);

                        // Default sample color if none exist
                        if (empty($existingColors)) {
                            $existingColors = [
                                ['name' => 'Rosso Corsa Red', 'hex' => '#dc2626'],
                                ['name' => 'Obsidian Black', 'hex' => '#111827'],
                            ];
                        }
                    @endphp

                    @foreach($existingColors as $c)
                        <div class="color-row" style="display: grid; grid-template-columns: 50px 1fr 40px; gap: 10px; align-items: center;">
                            <input type="color" name="color_hexes[]" value="{{ $c['hex'] ?? '#dc2626' }}" onchange="updatePalettePreview()" style="width: 100%; height: 38px; padding: 2px; border: 1px solid var(--border); background: var(--bg-hover); border-radius: 4px; cursor: pointer;">
                            <input type="text" name="color_names[]" value="{{ $c['name'] ?? '' }}" oninput="updatePalettePreview()" placeholder="Nama Warna (misal: Rosso Corsa Red)" class="mgr-input">
                            <button type="button" onclick="removeColorRow(this)" style="height: 38px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #f87171; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    @endforeach
                </div>

                <!-- Live Color Palette Dots Preview -->
                <div style="margin-top: 14px; padding-top: 12px; border-top: 1px border-dashed var(--border); display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 10px; font-family: 'Space Mono', monospace; color: var(--text-muted);">PREVIEW PALET DI POPUP:</span>
                    <div id="livePalettePreview" style="display: flex; gap: 8px; align-items: center;">
                        <!-- Injected live by JS -->
                    </div>
                </div>
            </div>

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Deskripsi Unit</label>
                <textarea name="description" rows="4" placeholder="Keterangan spesifikasi & keunggulan mobil..." class="mgr-input" style="resize: vertical;">{{ old('description', $car->description) }}</textarea>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; margin-top: 10px; border-top: 1px solid var(--border); padding-top: 16px;">
                <a href="{{ route('manager.cars.index') }}" style="padding: 10px 18px; background: var(--bg-hover); color: var(--text-muted); text-decoration: none; border-radius: 4px; font-size: 13px; border: 1px solid var(--border);">Batal</a>
                <button type="submit" style="padding: 10px 24px; background: #dc2626; color: #fff; border: none; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; text-transform: uppercase; border-radius: 4px; cursor: pointer;">
                    {{ $car->exists ? 'Simpan Perubahan' : 'Tambah Mobil' }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImageFile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('imagePreviewImg');
                const placeholder = document.getElementById('imagePreviewPlaceholder');
                img.src = e.target.result;
                img.style.display = 'block';
                if (placeholder) placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewImageUrl(url) {
        if (url && url.trim() !== '') {
            const img = document.getElementById('imagePreviewImg');
            const placeholder = document.getElementById('imagePreviewPlaceholder');
            img.src = url;
            img.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        }
    }

    function addColorRow(colorName = '', hexCode = '#dc2626') {
        const container = document.getElementById('colorsContainer');
        const row = document.createElement('div');
        row.className = 'color-row';
        row.style.cssText = 'display: grid; grid-template-columns: 50px 1fr 40px; gap: 10px; align-items: center;';
        row.innerHTML = `
            <input type="color" name="color_hexes[]" value="${hexCode}" onchange="updatePalettePreview()" style="width: 100%; height: 38px; padding: 2px; border: 1px solid var(--border); background: var(--bg-hover); border-radius: 4px; cursor: pointer;">
            <input type="text" name="color_names[]" value="${colorName}" oninput="updatePalettePreview()" placeholder="Nama Warna (misal: Rosso Corsa)" class="mgr-input">
            <button type="button" onclick="removeColorRow(this)" style="height: 38px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #f87171; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        `;
        container.appendChild(row);
        updatePalettePreview();
    }

    function removeColorRow(button) {
        const rows = document.querySelectorAll('.color-row');
        if (rows.length > 1) {
            button.closest('.color-row').remove();
        } else {
            const inputs = button.closest('.color-row').querySelectorAll('input');
            inputs[0].value = '#dc2626';
            inputs[1].value = '';
        }
        updatePalettePreview();
    }

    function updatePalettePreview() {
        const previewContainer = document.getElementById('livePalettePreview');
        if (!previewContainer) return;

        const hexInputs = document.querySelectorAll('input[name="color_hexes[]"]');
        const nameInputs = document.querySelectorAll('input[name="color_names[]"]');
        
        let html = '';
        hexInputs.forEach((hexIn, idx) => {
            const nameVal = nameInputs[idx] ? nameInputs[idx].value : 'Warna';
            const hexVal = hexIn.value;
            html += `<div title="${nameVal}" style="width: 22px; height: 22px; border-radius: 50%; background-color: ${hexVal}; border: 2px solid rgba(255,255,255,0.4); box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>`;
        });
        
        previewContainer.innerHTML = html;
    }

    document.addEventListener('DOMContentLoaded', () => {
        updatePalettePreview();
        
        // Autocomplete & Auto-fill Brand Logic
        const commonCars = [
            { model: "McLaren Senna GTR", brand: "McLaren Automotive" },
            { model: "McLaren 720S", brand: "McLaren Automotive" },
            { model: "McLaren 765LT", brand: "McLaren Automotive" },
            { model: "McLaren P1", brand: "McLaren Automotive" },
            { model: "Ferrari SF90 Stradale", brand: "Ferrari" },
            { model: "Ferrari F8 Tributo", brand: "Ferrari" },
            { model: "Ferrari 812 Superfast", brand: "Ferrari" },
            { model: "Ferrari LaFerrari", brand: "Ferrari" },
            { model: "Lamborghini Aventador SVJ", brand: "Lamborghini" },
            { model: "Lamborghini Huracan EVO", brand: "Lamborghini" },
            { model: "Lamborghini Urus", brand: "Lamborghini" },
            { model: "Lamborghini Revuelto", brand: "Lamborghini" },
            { model: "Porsche 911 GT3 RS", brand: "Porsche" },
            { model: "Porsche 911 Turbo S", brand: "Porsche" },
            { model: "Porsche Taycan Turbo S", brand: "Porsche" },
            { model: "Porsche 918 Spyder", brand: "Porsche" },
            { model: "Aston Martin Valkyrie", brand: "Aston Martin" },
            { model: "Aston Martin DB11", brand: "Aston Martin" },
            { model: "Aston Martin DBS Superleggera", brand: "Aston Martin" },
            { model: "Rolls-Royce Phantom", brand: "Rolls-Royce" },
            { model: "Rolls-Royce Cullinan", brand: "Rolls-Royce" },
            { model: "Rolls-Royce Ghost", brand: "Rolls-Royce" },
            { model: "Bentley Continental GT", brand: "Bentley" },
            { model: "Bentley Bentayga", brand: "Bentley" },
            { model: "Bugatti Chiron", brand: "Bugatti" },
            { model: "Bugatti Veyron", brand: "Bugatti" },
            { model: "Bugatti Divo", brand: "Bugatti" },
            { model: "Koenigsegg Jesko", brand: "Koenigsegg" },
            { model: "Koenigsegg Gemera", brand: "Koenigsegg" },
            { model: "Pagani Huayra", brand: "Pagani" },
            { model: "Pagani Zonda", brand: "Pagani" },
            { model: "Mercedes-AMG GT Black Series", brand: "Mercedes-Benz" },
            { model: "Mercedes-Benz G63 AMG", brand: "Mercedes-Benz" },
            { model: "BMW M5 CS", brand: "BMW" },
            { model: "BMW M4 Competition", brand: "BMW" },
            { model: "Audi R8 V10 Plus", brand: "Audi" },
            { model: "Nissan GT-R Nismo", brand: "Nissan" },
            { model: "Maserati MC20", brand: "Maserati" },
            { model: "Lexus LFA", brand: "Lexus" },
            { model: "Ford GT", brand: "Ford" }
        ];

        const nameInput = document.getElementById('carNameInput');
        const brandInput = document.getElementById('carBrandInput');
        const suggestionsBox = document.getElementById('carSuggestions');
        let selectedFromList = false;

        nameInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            suggestionsBox.innerHTML = '';
            selectedFromList = false;
            
            let filtered = [];
            if (query.length === 0) {
                // If empty, show first 15 default options
                filtered = commonCars.slice(0, 15);
            } else {
                filtered = commonCars.filter(car => car.model.toLowerCase().includes(query) || car.brand.toLowerCase().includes(query));
            }

            if (filtered.length > 0) {
                suggestionsBox.style.display = 'block';
                filtered.forEach(car => {
                    const item = document.createElement('div');
                    item.style.cssText = 'padding: 10px 14px; cursor: pointer; border-bottom: 1px solid var(--border); font-size: 13px; color: var(--text-heading); display: flex; justify-content: space-between; align-items: center; transition: background 0.2s;';
                    
                    let modelHtml = car.model;
                    if (query.length > 0) {
                        const regex = new RegExp(`(${query})`, 'gi');
                        modelHtml = car.model.replace(regex, '<span style="color: #ef4444; font-weight: 700;">$1</span>');
                    }
                    
                    item.innerHTML = `<span>${modelHtml}</span> <span style="font-size: 11px; color: var(--text-muted); background: var(--bg-hover, rgba(0,0,0,0.05)); padding: 2px 6px; border-radius: 4px;">${car.brand}</span>`;
                    
                    item.addEventListener('mouseenter', () => item.style.background = 'var(--bg-hover, rgba(0,0,0,0.05))');
                    item.addEventListener('mouseleave', () => item.style.background = 'transparent');
                    
                    item.addEventListener('click', (e) => {
                        e.stopPropagation();
                        nameInput.value = car.model;
                        brandInput.value = car.brand;
                        suggestionsBox.style.display = 'none';
                        selectedFromList = true;
                    });
                    
                    suggestionsBox.appendChild(item);
                });
            } else {
                suggestionsBox.style.display = 'none';
            }
        });

        // Close suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target !== nameInput && !suggestionsBox.contains(e.target)) {
                suggestionsBox.style.display = 'none';
            }
        });

        // Show suggestions on focus or click
        nameInput.addEventListener('focus', function() {
            this.dispatchEvent(new Event('input'));
        });
        nameInput.addEventListener('click', function() {
            this.dispatchEvent(new Event('input'));
        });
    });
</script>
@endsection
