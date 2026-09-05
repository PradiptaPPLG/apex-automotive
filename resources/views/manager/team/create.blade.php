@extends('manager.layout')

@section('title', 'Tambah Anggota Tim Baru')
@section('page_header', 'Tambah Personel (Sales RM / Delivery Driver)')

@section('content')
<div style="max-width: 600px;">
    <div class="card-panel">
        <form method="POST" action="{{ route('manager.team.store') }}" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                @error('name')
                    <span style="color: #f87171; font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Alamat Email <span style="color:#ef4444;">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="budi@apex.id" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                @error('email')
                    <span style="color: #f87171; font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">No. WhatsApp / HP</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+62 812 3456 7890" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
            </div>

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Jabatan / Role <span style="color:#ef4444;">*</span></label>
                <select name="role" required style="width: 100%; background: #0c0c12; border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                    <option value="rm" {{ old('role') == 'rm' ? 'selected' : '' }}>Sales Relationship Manager (RM)</option>
                    <option value="delivery" {{ old('role') == 'delivery' ? 'selected' : '' }}>Delivery Driver (Escort Specialist)</option>
                </select>
                @error('role')
                    <span style="color: #f87171; font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label style="display: block; font-family: 'Space Mono', monospace; font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 6px;">Password Login Initial <span style="color:#ef4444;">*</span></label>
                <input type="password" name="password" required placeholder="Minimal 6 karakter" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 10px 14px; color: #fff; border-radius: 4px; font-size: 13px;">
                @error('password')
                    <span style="color: #f87171; font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; margin-top: 10px; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 16px;">
                <a href="{{ route('manager.team.index') }}" style="padding: 10px 18px; background: rgba(255,255,255,0.06); color: #9ca3af; text-decoration: none; border-radius: 4px; font-size: 13px;">Batal</a>
                <button type="submit" style="padding: 10px 24px; background: #dc2626; color: #fff; border: none; font-family: 'Space Mono', monospace; font-size: 11px; font-weight: 700; text-transform: uppercase; border-radius: 4px; cursor: pointer;">
                    Simpan Anggota Tim
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
