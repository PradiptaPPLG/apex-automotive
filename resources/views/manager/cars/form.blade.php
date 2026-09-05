@extends('manager.layout')

@section('title', $car->exists ? 'Edit Mobil Showroom' : 'Tambah Mobil Showroom Baru')
@section('page_header', $car->exists ? 'Edit Mobil: '.$car->name : 'Tambah Mobil Showroom Baru')

@section('content')
<div style="max-width: 800px;">
    <div class="card-panel">
        <form method="POST" action="{{ $car->exists ? route('manager.cars.update', $car) : route('manager.cars.store') }}" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf
            @if($car->exists)
                @method('PUT')
            @endif

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Nama Unit / Model <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $car->name) }}" required placeholder="Contoh: McLaren Senna GTR" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                    @error('name')
                        <span style="color: #f87171; font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Brand / Manufacturer</label>
                    <input type="text" name="brand" value="{{ old('brand', $car->brand) }}" placeholder="Contoh: McLaren Automotive" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Kategori <span style="color:#ef4444;">*</span></label>
                    <select name="category" required style="width: 100%; background: #0c0c12; border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                        <option value="Hypercar" {{ old('category', $car->category) == 'Hypercar' ? 'selected' : '' }}>Hypercar</option>
                        <option value="Supercar" {{ old('category', $car->category) == 'Supercar' ? 'selected' : '' }}>Supercar</option>
                        <option value="Luxury SUV" {{ old('category', $car->category) == 'Luxury SUV' ? 'selected' : '' }}>Luxury SUV</option>
                        <option value="Grand Tourer" {{ old('category', $car->category) == 'Grand Tourer' ? 'selected' : '' }}>Grand Tourer</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Harga Estimasi (IDR) <span style="color:#ef4444;">*</span></label>
                    <input type="number" name="price" value="{{ old('price', $car->price) }}" required placeholder="Contoh: 25000000000" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Tahun</label>
                    <input type="number" name="year" value="{{ old('year', $car->year ?? date('Y')) }}" placeholder="2026" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Transmisi</label>
                    <input type="text" name="transmission" value="{{ old('transmission', $car->transmission) }}" placeholder="7-Speed Dual Clutch" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Bahan Bakar</label>
                    <input type="text" name="fuel_type" value="{{ old('fuel_type', $car->fuel_type) }}" placeholder="V8 Twin-Turbo / Hybrid" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                </div>

                <div>
                    <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Status Ketersediaan <span style="color:#ef4444;">*</span></label>
                    <select name="status" required style="width: 100%; background: #0c0c12; border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                        <option value="available" {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>Available (Tersedia)</option>
                        <option value="reserved" {{ old('status', $car->status) == 'reserved' ? 'selected' : '' }}>Reserved (Dipesan)</option>
                        <option value="sold" {{ old('status', $car->status) == 'sold' ? 'selected' : '' }}>Sold (Terjual)</option>
                    </select>
                </div>
            </div>

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">URL Gambar Kendaraan</label>
                <input type="url" name="image_url" value="{{ old('image_url', $car->image_url) }}" placeholder="https://..." style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
            </div>

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Deskripsi Unit</label>
                <textarea name="description" rows="4" placeholder="Keterangan spesifikasi & keunggulan mobil..." style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px; resize: vertical;">{{ old('description', $car->description) }}</textarea>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; margin-top: 10px; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 16px;">
                <a href="{{ route('manager.cars.index') }}" style="padding: 10px 18px; background: rgba(255,255,255,0.06); color: #9ca3af; text-decoration: none; border-radius: 4px; font-size: 13px;">Batal</a>
                <button type="submit" style="padding: 10px 24px; background: #dc2626; color: #fff; border: none; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; text-transform: uppercase; border-radius: 4px; cursor: pointer;">
                    {{ $car->exists ? 'Simpan Perubahan' : 'Tambah Mobil' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
