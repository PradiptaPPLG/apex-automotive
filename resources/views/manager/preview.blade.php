@extends('manager.layout')

@section('title', 'Preview Website Utama')
@section('page_header', 'Preview Live Website Apex Automotive')

@section('content')
<div style="display: flex; flex-direction: column; gap: 16px; height: calc(100vh - 160px);">
    <div style="display: flex; justify-content: space-between; align-items: center; background: rgba(17, 17, 26, 0.7); border: 1px solid rgba(255,255,255,0.08); padding: 12px 20px; border-radius: 6px;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-desktop text-red-500"></i>
            <span style="font-family: 'Space Mono', monospace; font-size: 12px; color: #fff;">LIVE WEBSITE IFRAME PREVIEW</span>
        </div>
        <a href="{{ route('home') }}" target="_blank" style="padding: 6px 14px; background: rgba(255,255,255,0.06); color: #fff; text-decoration: none; border-radius: 4px; font-size: 12px; font-family: 'Space Mono', monospace; display: flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-up-right-from-square"></i> Buka Tab Baru
        </a>
    </div>

    <div style="flex: 1; border-radius: 8px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); background: #000;">
        <iframe src="{{ route('home') }}" style="width: 100%; height: 100%; border: none;"></iframe>
    </div>
</div>
@endsection
