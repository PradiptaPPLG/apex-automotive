@extends('manager.layout')

@section('title', 'Kelola Showroom Mobil')
@section('page_header', 'Manajemen Showroom & Catalog Unit Mobil')

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 700; color: var(--text-heading);">Catalog Mobil Showroom</h2>
            <p style="font-size: 13px; color: var(--text-muted); margin-top: 4px;">Daftar unit hypercar &amp; supercar yang tersedia di sistem Apex</p>
        </div>
        <a href="{{ route('manager.cars.create') }}" style="padding: 10px 18px; background: #dc2626; color: #fff; text-decoration: none; border-radius: 4px; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Mobil Baru</span>
        </a>
    </div>

    <div class="card-panel">
        <div style="overflow: visible;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                <thead>
                    <tr class="mgr-table-header-row">
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
                        <tr class="mgr-table-body-row">
                            <td style="padding: 12px 10px;">
                                <div style="width: 60px; height: 40px; border-radius: 4px; overflow: hidden; background: var(--bg-hover); border: 1px solid var(--border);">
                                    @if($car->image_url)
                                        <img src="{{ $car->image_url }}" alt="{{ $car->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color: var(--text-dim); font-size:16px;">
                                            <i class="fa-solid fa-car"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td style="padding: 12px 10px;">
                                <div style="font-weight: 600; color: var(--text-heading);">{{ $car->name }}</div>
                                <div style="font-size: 11px; color: var(--text-muted); margin-top: 2px;">{{ $car->brand }}</div>
                                @if(!empty($car->specs['colors']) && is_array($car->specs['colors']))
                                    <div style="display: flex; align-items: center; gap: 6px; margin-top: 5px;">
                                        <div style="display: flex; gap: 4px; align-items: center;">
                                            @foreach($car->specs['colors'] as $col)
                                                <div title="{{ $col['name'] ?? '' }}" style="width: 14px; height: 14px; border-radius: 50%; background-color: {{ $col['hex'] ?? '#000' }}; border: 1px solid rgba(255,255,255,0.4); box-shadow: 0 1px 3px rgba(0,0,0,0.3);"></div>
                                            @endforeach
                                        </div>
                                        <span style="font-size: 10px; color: var(--text-muted); font-family: 'Space Mono', monospace;">
                                            {{ count($car->specs['colors']) }} Varian Warna
                                        </span>
                                    </div>
                                @elseif(!empty($car->specs['Warna']))
                                    <div style="font-size: 10px; color: var(--text-muted); margin-top: 4px; font-family: 'Space Mono', monospace;">
                                        🎨 {{ is_array($car->specs['Warna']) ? ($car->specs['Warna']['val'] ?? '') : $car->specs['Warna'] }}
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 12px 10px;">
                                <span style="font-family: 'Space Mono', monospace; font-size: 10px; padding: 2px 8px; background: var(--bg-hover); border: 1px solid var(--border); border-radius: 2px; color: var(--text-muted);">
                                    {{ $car->category }}
                                </span>
                            </td>
                            <td style="padding: 12px 10px; font-family: 'Space Mono', monospace; color: #4ade80; font-weight: 700;">
                                Rp {{ number_format($car->price, 0, ',', '.') }}
                            </td>
                            <td style="padding: 12px 10px;">
                                @if($car->status === 'available')
                                    <span style="font-family: 'Space Mono', monospace; font-size: 10px; padding: 4px 8px; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); border-radius: 2px; color: #4ade80; font-weight: 700;">AVAILABLE</span>
                                @elseif($car->status === 'sold')
                                    <span style="font-family: 'Space Mono', monospace; font-size: 10px; padding: 4px 8px; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 2px; color: #f87171; font-weight: 700;">SOLD OUT</span>
                                @else
                                    <span style="font-family: 'Space Mono', monospace; font-size: 10px; padding: 4px 8px; background: rgba(234, 179, 8, 0.1); border: 1px solid rgba(234, 179, 8, 0.2); border-radius: 2px; color: #facc15; font-weight: 700;">COMING SOON</span>
                                @endif
                            </td>
                            <td style="padding: 12px 10px; text-align: right; position: relative;">
                                <button type="button" onclick="toggleActionDropdown('{{ $car->id }}')" style="padding: 6px 10px; background: var(--bg-hover); border: 1px solid var(--border); border-radius: 4px; color: var(--text-muted); cursor: pointer; transition: all 0.2s;">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                
                                <div id="dropdown-menu-{{ $car->id }}" class="action-dropdown" style="display: none; position: absolute; right: 0; top: 100%; margin-top: 4px; width: 160px; z-index: 50; padding: 6px 0; background: var(--bg-card); border: 1px solid var(--border); border-radius: 6px; box-shadow: 0 10px 25px rgba(0,0,0,0.4); text-align: left;">
                                    <a href="{{ route('manager.cars.edit', $car->id) }}" class="mgr-dropdown-link" style="color: #60a5fa;">
                                        <i class="fa-solid fa-pen-to-square w-4"></i> Edit Detail
                                    </a>
                                    
                                    @if($car->status !== 'sold')
                                    <form action="{{ route('manager.cars.status', $car->id) }}" method="POST" style="margin:0;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="sold">
                                        <button type="submit" class="mgr-dropdown-link" style="width: 100%; background: none; border: none; text-align: left; color: #f87171; font-family: inherit; cursor: pointer;">
                                            <i class="fa-solid fa-ban w-4"></i> Set SOLD OUT
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('manager.cars.status', $car->id) }}" method="POST" style="margin:0;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="available">
                                        <button type="submit" class="mgr-dropdown-link" style="width: 100%; background: none; border: none; text-align: left; color: #4ade80; font-family: inherit; cursor: pointer;">
                                            <i class="fa-solid fa-circle-check w-4"></i> Set Available
                                        </button>
                                    </form>
                                    @endif

                                    <div style="margin: 4px 0; border-top: 1px solid var(--border);"></div>
                                    
                                    <form action="{{ route('manager.cars.destroy', $car->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mobil ini? Data yang dihapus tidak dapat dikembalikan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="mgr-dropdown-link" style="width: 100%; background: none; border: none; text-align: left; color: #ef4444; font-family: inherit; cursor: pointer;">
                                            <i class="fa-solid fa-trash w-4"></i> Hapus Mobil
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 32px; text-align: center; color: var(--text-dim);">
                                Belum ada unit mobil di showroom. Silakan klik tombol "Tambah Mobil Baru".
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 24px; border-top: 1px solid var(--border); padding-top: 16px; display: flex; justify-content: flex-end;">
            <style>
                .custom-pagination { display: flex; list-style: none; padding: 0; margin: 0; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 600; border-radius: 4px; overflow: hidden; border: 1px solid var(--border); background: var(--bg-card); }
                .custom-pagination li { border-right: 1px solid var(--border); }
                .custom-pagination li:last-child { border-right: none; }
                .custom-pagination li a, .custom-pagination li span { display: block; padding: 8px 14px; color: var(--text-base); text-decoration: none; }
                .custom-pagination li a:hover { background: var(--bg-hover); color: var(--text-heading); }
                .custom-pagination li.active span { background: #dc2626; color: #fff; }
                .custom-pagination li.disabled span { opacity: 0.4; background: var(--bg-surface); cursor: not-allowed; }
            </style>
            {{ $cars->links('pagination::bootstrap-4') }}
            <script>
                // Add custom class to pagination ul
                document.querySelectorAll('.pagination').forEach(el => {
                    el.classList.remove('pagination');
                    el.classList.add('custom-pagination');
                });
                document.querySelectorAll('.page-link').forEach(el => {
                    el.classList.remove('page-link');
                });
                document.querySelectorAll('.page-item').forEach(el => {
                    el.classList.remove('page-item');
                });
            </script>
    </div>
</div>

<script>
    function toggleActionDropdown(id) {
        event.stopPropagation();
        const targetDropdown = document.getElementById('dropdown-menu-' + id);
        document.querySelectorAll('.action-dropdown').forEach(dropdown => {
            if (dropdown !== targetDropdown) {
                dropdown.style.display = 'none';
            }
        });
        if (targetDropdown.style.display === 'block') {
            targetDropdown.style.display = 'none';
        } else {
            targetDropdown.style.display = 'block';
        }
    }

    document.addEventListener('click', function () {
        document.querySelectorAll('.action-dropdown').forEach(dropdown => {
            dropdown.style.display = 'none';
        });
    });
</script>
@endsection
