@extends('manager.layout')

@section('page_header', 'Pengaturan Website')
@section('title', 'Pengaturan Website')

@section('content')
<!-- We inject styles here because layout doesn't yield styles -->
<style>
    .settings-wrapper {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        margin-top: 20px;
    }
    @media (min-width: 1024px) {
        .settings-wrapper {
            grid-template-columns: 350px 1fr;
        }
    }
    .m-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .m-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .m-form-group {
        margin-bottom: 20px;
    }
    .m-form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 8px;
    }
    .m-input {
        width: 100%;
        padding: 10px 14px;
        background: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .m-input:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2);
    }
    .m-btn {
        background: #dc2626;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .m-btn:hover {
        background: #b91c1c;
        transform: translateY(-1px);
    }
    .ai-spec-row {
        display: flex;
        flex-direction: column;
        padding: 12px 0;
        border-bottom: 1px dashed var(--border-color);
    }
    .ai-spec-row:last-child {
        border-bottom: none;
    }
    .ai-spec-label {
        color: var(--text-muted);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .ai-spec-val {
        color: var(--text-primary);
        font-weight: 700;
        font-family: 'Space Mono', monospace;
        font-size: 0.9rem;
    }
    .status-badge {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    .m-alert {
        background: rgba(16, 185, 129, 0.1);
        border-left: 4px solid #10b981;
        color: #065f46;
        padding: 16px;
        border-radius: 4px;
        margin-bottom: 24px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .dark .m-alert {
        color: #34d399;
    }
    .ai-avatar-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        position: relative;
    }
    .ai-avatar {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #dc2626;
        box-shadow: 0 0 20px rgba(220, 38, 38, 0.4);
        transition: all 0.5s ease;
    }
    .ai-avatar-glitch {
        animation: pulse-glow 2s infinite;
    }
    @keyframes pulse-glow {
        0% { box-shadow: 0 0 15px rgba(220, 38, 38, 0.4); }
        50% { box-shadow: 0 0 30px rgba(220, 38, 38, 0.8); }
        100% { box-shadow: 0 0 15px rgba(220, 38, 38, 0.4); }
    }
</style>

@if(session('success'))
    <div class="m-alert">
        <i class="fa-solid fa-check-circle text-xl"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="settings-wrapper">
    <!-- LEFT COLUMN: AI MODEL INFO -->
    <div>
        <div class="m-card">
            <h2 class="m-card-title">
                <i class="fa-solid fa-microchip text-red-600"></i> AI Core System
            </h2>
            
            <div class="ai-avatar-container">
                <img src="{{ asset('images/logo/staff/neura_ai_pose_1.webp') }}" alt="Neura AI" id="aiSettingsAvatar" class="ai-avatar ai-avatar-glitch">
            </div>

            <div class="ai-spec-row">
                <span class="ai-spec-label">Model Designation</span>
                <span class="ai-spec-val text-red-500">Neura 2b7t</span>
            </div>
            <div class="ai-spec-row">
                <span class="ai-spec-label">System Status</span>
                <span class="ai-spec-val"><span class="status-badge"><i class="fa-solid fa-satellite-dish mr-1"></i> ACTIVE</span></span>
            </div>
            <div class="ai-spec-row">
                <span class="ai-spec-label">Primary Annotator</span>
                <span class="ai-spec-val">pradipta</span>
            </div>
            <div class="ai-spec-row">
                <span class="ai-spec-label">Training Dataset By</span>
                <span class="ai-spec-val">voxel studio</span>
            </div>
            <div class="ai-spec-row">
                <span class="ai-spec-label">Model Architecture By</span>
                <span class="ai-spec-val">naufal r</span>
            </div>
            <div class="ai-spec-row">
                <span class="ai-spec-label">Core Brain Engine</span>
                <span class="ai-spec-val text-blue-500">llama-3.3-70b-versatile</span>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN: WEBSITE SETTINGS FORM -->
    <div>
        <div class="m-card">
            <h2 class="m-card-title">
                <i class="fa-solid fa-pen-nib text-red-600"></i> Konfigurasi Tampilan
            </h2>
            
            <form action="{{ route('manager.settings.update') }}" method="POST">
                @csrf
                
                <div class="m-form-group">
                    <label class="m-form-label">Deskripsi Profil Showroom (Footer)</label>
                    <textarea name="footer_desc" class="m-input" rows="4" placeholder="Tuliskan deskripsi pameran di sini...">{{ old('footer_desc', $settings['footer_desc']) }}</textarea>
                </div>

                <div style="margin: 30px 0 20px;">
                    <h3 style="font-size: 1rem; font-weight: 700; color: var(--text-primary); display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-link text-red-600"></i> Tautan Media Sosial
                    </h3>
                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">Link ini akan muncul di bagian bawah website untuk pengunjung.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="m-form-group">
                        <label class="m-form-label"><i class="fa-brands fa-instagram text-pink-500"></i> Instagram URL</label>
                        <input type="text" name="social_instagram" class="m-input" value="{{ old('social_instagram', $settings['social_instagram']) }}">
                    </div>

                    <div class="m-form-group">
                        <label class="m-form-label"><i class="fa-brands fa-youtube text-red-500"></i> YouTube URL</label>
                        <input type="text" name="social_youtube" class="m-input" value="{{ old('social_youtube', $settings['social_youtube']) }}">
                    </div>

                    <div class="m-form-group">
                        <label class="m-form-label"><i class="fa-brands fa-facebook text-blue-500"></i> Facebook URL</label>
                        <input type="text" name="social_facebook" class="m-input" value="{{ old('social_facebook', $settings['social_facebook']) }}">
                    </div>

                    <div class="m-form-group">
                        <label class="m-form-label"><i class="fa-brands fa-linkedin text-blue-700"></i> LinkedIn URL</label>
                        <input type="text" name="social_linkedin" class="m-input" value="{{ old('social_linkedin', $settings['social_linkedin']) }}">
                    </div>
                </div>

                <div class="m-form-group" style="text-align: right; margin-top: 10px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                    <button type="submit" class="m-btn">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // AI Pose Animation Logic
    document.addEventListener('DOMContentLoaded', () => {
        const poses = [
            "{{ asset('images/logo/staff/neura_ai_pose_1.webp') }}",
            "{{ asset('images/logo/staff/neura_ai_pose_2.webp') }}",
            "{{ asset('images/logo/staff/neura_ai_pose_3.webp') }}",
            "{{ asset('images/logo/staff/neura_ai_pose_4.webp') }}",
            "{{ asset('images/logo/staff/neura_ai_pose_5.webp') }}"
        ];
        
        const avatar = document.getElementById('aiSettingsAvatar');
        let poseIdx = 0;
        
        if (avatar) {
            setInterval(() => {
                poseIdx = (poseIdx + 1) % poses.length;
                
                // Add a quick fade effect
                avatar.style.opacity = '0.7';
                setTimeout(() => {
                    avatar.src = poses[poseIdx];
                    avatar.style.opacity = '1';
                }, 150);
                
            }, 3500); // Change pose every 3.5 seconds
        }
    });
</script>
@endsection
