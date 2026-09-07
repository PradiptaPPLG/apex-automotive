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
                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Nama Unit / Model <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $car->name) }}" required placeholder="Contoh: McLaren Senna GTR" class="mgr-input">
                    @error('name')
                        <span style="color: #f87171; font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px;">Brand / Manufacturer</label>
                    <input type="text" name="brand" value="{{ old('brand', $car->brand) }}" placeholder="Contoh: McLaren Automotive" class="mgr-input">
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
                    <i class="fa-solid fa-image" style="color: #ef4444; margin-right: 4px;"></i> Upload Foto Kendaraan
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

            <!-- Custom Dynamic Specs Section -->
            <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--border); padding: 18px; border-radius: 6px; margin-top: 4px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                    <div>
                        <label style="font-family: 'Space Mono', monospace; font-size: 12px; color: var(--text-heading); text-transform: uppercase; font-weight: 700;">
                            <i class="fa-solid fa-sliders" style="color: #ef4444; margin-right: 6px;"></i> Spesifikasi & Custom Field
                        </label>
                        <p style="font-size: 12px; color: var(--text-muted); margin-top: 2px;">Default menyertakan field <strong>Warna</strong>. Anda juga dapat menambahkan field <strong>Bodykit</strong>, Velg, Interior, dll.</p>
                    </div>

                    <div style="display: flex; gap: 8px;">
                        <button type="button" onclick="addSpecField('Bodykit', 'Mansory Carbon Package')" style="padding: 6px 12px; background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); color: #f87171; border-radius: 4px; font-size: 11px; cursor: pointer; font-weight: 600;">
                            <i class="fa-solid fa-plus"></i> Field Bodykit
                        </button>
                        <button type="button" onclick="addSpecField('', '')" style="padding: 6px 12px; background: var(--bg-hover); border: 1px solid var(--border); color: var(--text-base); border-radius: 4px; font-size: 11px; cursor: pointer;">
                            <i class="fa-solid fa-plus"></i> Tambah Field Custom
                        </button>
                    </div>
                </div>

                <div id="specsContainer" style="display: flex; flex-direction: column; gap: 10px;">
                    @php
                        $existingSpecs = old('spec_keys') 
                            ? array_map(function($k, $v) { return ['label' => $k, 'value' => $v]; }, old('spec_keys'), old('spec_values'))
                            : ($car->specs ?? []);

                        // Ensure default Warna field exists if empty
                        if (empty($existingSpecs)) {
                            $existingSpecs = [
                                ['label' => 'Warna', 'value' => '']
                            ];
                        }
                    @endphp

                    @foreach($existingSpecs as $spec)
                        <div class="spec-row" style="display: grid; grid-template-columns: 180px 1fr 40px; gap: 10px; align-items: center;">
                            <input type="text" name="spec_keys[]" value="{{ is_array($spec) ? ($spec['label'] ?? '') : '' }}" placeholder="Nama Field (misal: Warna)" class="mgr-input" style="font-family: 'Space Mono', monospace; font-size: 12px;">
                            <input type="text" name="spec_values[]" value="{{ is_array($spec) ? ($spec['value'] ?? '') : '' }}" placeholder="Nilai / Detail (misal: Obsidian Black Metallic)" class="mgr-input">
                            <button type="button" onclick="removeSpecRow(this)" style="height: 38px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #f87171; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    @endforeach
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

    function addSpecField(keyName = '', valueName = '') {
        const container = document.getElementById('specsContainer');
        const row = document.createElement('div');
        row.className = 'spec-row';
        row.style.cssText = 'display: grid; grid-template-columns: 180px 1fr 40px; gap: 10px; align-items: center; margin-top: 2px;';
        row.innerHTML = `
            <input type="text" name="spec_keys[]" value="${keyName}" placeholder="Nama Field (misal: Bodykit)" class="mgr-input" style="font-family: 'Space Mono', monospace; font-size: 12px;">
            <input type="text" name="spec_values[]" value="${valueName}" placeholder="Nilai / Detail (misal: Mansory Aero Package)" class="mgr-input">
            <button type="button" onclick="removeSpecRow(this)" style="height: 38px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #f87171; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        `;
        container.appendChild(row);
    }

    function removeSpecRow(button) {
        const rows = document.querySelectorAll('.spec-row');
        if (rows.length > 1) {
            button.closest('.spec-row').remove();
        } else {
            // Clears inputs instead of removing if it's the last row
            const inputs = button.closest('.spec-row').querySelectorAll('input');
            inputs.forEach(i => i.value = '');
        }
    }
</script>
@endsection
