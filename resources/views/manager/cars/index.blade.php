@extends('manager.layout')

@section('title', 'Kelola Showroom Mobil')
@section('page_header', 'Manajemen Showroom & Catalog Unit Mobil')

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 700; color: #fff;">Catalog Mobil Showroom</h2>
            <p style="font-size: 13px; color: #9ca3af; margin-top: 4px;">Daftar unit hypercar & supercar yang tersedia di sistem Apex</p>
        </div>
        <a href="{{ route('manager.cars.create') }}" style="padding: 10px 18px; background: #dc2626; color: #fff; text-decoration: none; border-radius: 4px; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Mobil Baru</span>
        </a>
    </div>

    <div class="card-panel">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #9ca3af; font-family: 'Space Mono', monospace; font-size: 11px;">
                        <th style="padding: 12px 10px;">FOTO</th>
                        <th style="padding: 12px 10px;">NAMA MOBIL / BRAND</th>
                        <th style="padding: 12px 10px;">KATEGORI</th>
                        <th style="padding: 12px 10px;">HARGA EST.</th>
                        <th style="padding: 12px 10px;">STATUS</th>
                        <th style="padding: 12px 10px; text-align: right;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cars as $car)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); color: #d1d5db;">
                            <td style="padding: 12px 10px;">
                                <div style="width: 60px; height: 40px; border-radius: 4px; overflow: hidden; background: #000; border: 1px solid rgba(255,255,255,0.1);">
                                    @if($car->image_url)
                                        <img src="{{ $car->image_url }}" alt="{{ $car->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#4b5563; font-size:16px;">
                                            <i class="fa-solid fa-car"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td style="padding: 12px 10px;">
                                <div style="font-weight: 700; color: #fff;">{{ $car->name }}</div>
                                <div style="font-size: 11px; color: #9ca3af;">{{ $car->brand ?? '—' }} ({{ $car->year ?? '—' }})</div>
                            </td>
                            <td style="padding: 12px 10px;">
                                <span style="font-family: 'Space Mono', monospace; font-size: 10px; padding: 2px 8px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 2px;">
                                    {{ $car->category }}
                                </span>
                            </td>
                            <td style="padding: 12px 10px; font-family: 'Space Mono', monospace; color: #4ade80; font-weight: 700;">
                                Rp {{ number_format($car->price, 0, ',', '.') }}
                            </td>
                            <td style="padding: 12px 10px;">
                                @if($car->status === 'available')
                                    <span style="color: #4ade80; background: rgba(74, 222, 128, 0.15); border: 1px solid rgba(74, 222, 128, 0.3); font-family: 'Space Mono', monospace; font-size: 10px; padding: 2px 8px; border-radius: 2px;">AVAILABLE</span>
                                @elseif($car->status === 'reserved')
                                    <span style="color: #fbbf24; background: rgba(251, 191, 36, 0.15); border: 1px solid rgba(251, 191, 36, 0.3); font-family: 'Space Mono', monospace; font-size: 10px; padding: 2px 8px; border-radius: 2px;">RESERVED</span>
                                @else
                                    <span style="color: #f87171; background: rgba(248, 113, 113, 0.15); border: 1px solid rgba(248, 113, 113, 0.3); font-family: 'Space Mono', monospace; font-size: 10px; padding: 2px 8px; border-radius: 2px;">SOLD</span>
                                @endif
                            </td>
                            <td style="padding: 12px 10px; text-align: right;">
                                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 8px;">
                                    <a href="{{ route('manager.cars.edit', $car) }}" style="padding: 6px 10px; background: rgba(255,255,255,0.06); color: #60a5fa; text-decoration: none; border-radius: 4px; font-size: 12px;" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('manager.cars.destroy', $car) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mobil ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding: 6px 10px; background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; cursor: pointer; border-radius: 4px; font-size: 12px;" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 32px; text-align: center; color: #6b7280;">
                                Belum ada unit mobil di showroom. Silakan klik tombol "Tambah Mobil Baru".
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 18px;">
            {{ $cars->links() }}
        </div>
    </div>
</div>
@endsection
