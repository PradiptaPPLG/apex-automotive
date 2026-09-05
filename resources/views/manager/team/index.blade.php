@extends('manager.layout')

@section('title', 'Kelola Tim Sales & Delivery')
@section('page_header', 'Manajemen Personel Tim (Sales RM & Delivery Driver)')

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 700; color: #fff;">Daftar Anggota Tim</h2>
            <p style="font-size: 13px; color: #9ca3af; margin-top: 4px;">Kelola akun Sales RM dan Driver Delivery VIP</p>
        </div>
        <a href="{{ route('manager.team.create') }}" style="padding: 10px 18px; background: #dc2626; color: #fff; text-decoration: none; border-radius: 4px; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-user-plus"></i>
            <span>Tambah Anggota Tim</span>
        </a>
    </div>

    <!-- Filter Tab -->
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('manager.team.index') }}" style="padding: 8px 16px; border-radius: 4px; font-size: 12px; font-family: 'Space Mono', monospace; text-decoration: none; {{ empty($roleFilter) ? 'background: rgba(220, 38, 38, 0.2); color: #ef4444; border: 1px solid rgba(220, 38, 38, 0.4);' : 'background: rgba(255,255,255,0.05); color: #9ca3af;' }}">
            Semua Role
        </a>
        <a href="{{ route('manager.team.index', ['role' => 'rm']) }}" style="padding: 8px 16px; border-radius: 4px; font-size: 12px; font-family: 'Space Mono', monospace; text-decoration: none; {{ $roleFilter === 'rm' ? 'background: rgba(234, 179, 8, 0.2); color: #eab308; border: 1px solid rgba(234, 179, 8, 0.4);' : 'background: rgba(255,255,255,0.05); color: #9ca3af;' }}">
            Sales RM
        </a>
        <a href="{{ route('manager.team.index', ['role' => 'delivery']) }}" style="padding: 8px 16px; border-radius: 4px; font-size: 12px; font-family: 'Space Mono', monospace; text-decoration: none; {{ $roleFilter === 'delivery' ? 'background: rgba(34, 211, 238, 0.2); color: #22d3ee; border: 1px solid rgba(34, 211, 238, 0.4);' : 'background: rgba(255,255,255,0.05); color: #9ca3af;' }}">
            Delivery Driver
        </a>
    </div>

    <div class="card-panel">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #9ca3af; font-family: 'Space Mono', monospace; font-size: 11px;">
                        <th style="padding: 12px 10px;">NAMA PERSONEL</th>
                        <th style="padding: 12px 10px;">EMAIL</th>
                        <th style="padding: 12px 10px;">NO. TELEPON</th>
                        <th style="padding: 12px 10px;">ROLE / JABATAN</th>
                        <th style="padding: 12px 10px; text-align: right;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); color: #d1d5db;">
                            <td style="padding: 12px 10px;">
                                <div style="font-weight: 700; color: #fff;">{{ $member->name }}</div>
                            </td>
                            <td style="padding: 12px 10px; font-family: 'Space Mono', monospace; color: #9ca3af;">
                                {{ $member->email }}
                            </td>
                            <td style="padding: 12px 10px;">
                                {{ $member->phone ?? '—' }}
                            </td>
                            <td style="padding: 12px 10px;">
                                @if($member->role === 'rm')
                                    <span style="color: #eab308; background: rgba(234, 179, 8, 0.15); border: 1px solid rgba(234, 179, 8, 0.3); font-family: 'Space Mono', monospace; font-size: 10px; padding: 2px 8px; border-radius: 2px; font-weight: 700;">
                                        SALES RM
                                    </span>
                                @elseif($member->role === 'delivery')
                                    <span style="color: #22d3ee; background: rgba(34, 211, 238, 0.15); border: 1px solid rgba(34, 211, 238, 0.3); font-family: 'Space Mono', monospace; font-size: 10px; padding: 2px 8px; border-radius: 2px; font-weight: 700;">
                                        DELIVERY DRIVER
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 12px 10px; text-align: right;">
                                <form method="POST" action="{{ route('manager.team.destroy', $member) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota tim ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="padding: 6px 10px; background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; cursor: pointer; border-radius: 4px; font-size: 12px;" title="Hapus Member">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 32px; text-align: center; color: #6b7280;">
                                Belum ada anggota tim terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 18px;">
            {{ $members->links() }}
        </div>
    </div>
</div>
@endsection
