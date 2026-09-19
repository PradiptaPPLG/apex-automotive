<?php $__env->startSection('page_header', 'Pengaturan Website'); ?>
<?php $__env->startSection('title', 'Pengaturan Website'); ?>

<?php $__env->startSection('content'); ?>
<!-- Leaflet Map CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
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

    /* CYBER SERVER STYLES */
    .cyber-server-container { display: flex; flex-direction: column; align-items: center; margin-top: 10px; }
    .cyber-server-node { width: 100%; background: #111; border: 1px solid #333; border-radius: 8px; padding: 12px; cursor: pointer; transition: border-color 0.3s; position: relative; z-index: 2; box-shadow: inset 0 0 10px rgba(0,0,0,0.8); }
    .cyber-server-node:hover { border-color: #ef4444; }
    .cyber-server-header { font-family: 'Space Mono', monospace; font-size: 0.85rem; font-weight: bold; color: #e5e5e5; display: flex; justify-content: space-between; align-items: center; }
    .cyber-pulse-indicator { width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981; animation: cyber-pulse 2s infinite; }
    @keyframes cyber-pulse { 0% { opacity: 1; } 50% { opacity: 0.2; } 100% { opacity: 1; } }
    
    .cyber-server-specs { max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(0, 1, 0, 1), padding 0.4s ease; background: #000; border-radius: 4px; margin-top: 0; border: 0px solid transparent; }
    .cyber-server-specs.expanded { max-height: 500px; padding: 12px; margin-top: 12px; border: 1px solid #333; transition: max-height 0.6s ease-in-out, padding 0.4s ease; }
    .spec-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; font-family: 'Space Mono', monospace; font-size: 0.7rem; }
    .spec-item { display: flex; flex-direction: column; background: #1a1a1a; padding: 6px 10px; border-left: 2px solid #ef4444; border-radius: 0 4px 4px 0; }
    .spec-label { color: #666; font-size: 0.6rem; text-transform: uppercase; margin-bottom: 2px; }
    .spec-value { color: #10b981; font-weight: bold; }
    
    .cyber-connection-area { width: 100%; height: 85px; position: relative; display: flex; justify-content: space-between; align-items: flex-start; margin-top: -4px; margin-bottom: 25px; gap: 12px; }
    .cyber-wire-col { position: relative; flex: 1; height: 100%; display: flex; justify-content: center; }
    
    .cyber-wire { width: 6px; height: 40px; background: #222; position: relative; z-index: 1; border-radius: 0 0 2px 2px; box-shadow: inset 0 0 5px #000; display: flex; flex-direction: column; align-items: center; }
    
    /* STRIPE ANIMATION FLOWING UPWARDS - WHITE */
    .cyber-wire::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: repeating-linear-gradient(to top, transparent, transparent 4px, #aaa 4px, #fff 10px); opacity: 0; transition: opacity 0.3s; }
    .cyber-wire.connected::before { opacity: 1; animation: wire-stripe-flow 0.4s linear infinite; box-shadow: 0 0 8px #fff; }
    @keyframes wire-stripe-flow { 0% { background-position: 0 0; } 100% { background-position: 0 -10px; } }
    
    .cyber-plug { width: 22px; height: 26px; background: #1a1a1a; border: 1px solid #555; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #555; font-size: 0.65rem; position: absolute; bottom: -20px; left: 50%; transform: translateX(-50%); cursor: grab; z-index: 10; box-shadow: 0 4px 6px rgba(0,0,0,0.5); user-select: none; }
    .cyber-plug:active { cursor: grabbing; }
    .cyber-wire.connected .cyber-plug { border-color: #fff; color: #fff; box-shadow: 0 0 10px rgba(255, 255, 255, 0.4); cursor: grab; }

    .cyber-datasets-row { display: flex; justify-content: space-between; width: 100%; gap: 12px; }
    .cyber-dataset-node { flex: 1; background: #111; border: 1px dashed #444; border-radius: 6px; padding: 14px 8px 8px 8px; font-family: 'Space Mono', monospace; font-size: 0.55rem; color: #777; text-align: center; position: relative; transition: border-color 0.3s, color 0.3s, background 0.3s; display: flex; flex-direction: column; align-items: center; gap: 6px; }
    .cyber-dataset-node.connected { border-style: solid; border-color: #fff; color: #fff; background: #1a1a1a; }
    
    /* ALERT DISCONNECTED STATE - RED */
    .cyber-dataset-node.alert-disconnected { border-style: solid; border-color: #ef4444; color: #ef4444; animation: alert-pulse 1s infinite; }
    @keyframes alert-pulse { 0% { background: #111; } 50% { background: #3a1111; } 100% { background: #111; } }
    .cyber-dataset-node.alert-disconnected .dataset-socket { border-color: #ef4444; box-shadow: 0 0 8px #ef4444; }

    .dataset-socket { width: 26px; height: 8px; background: #000; border: 1px solid #333; border-radius: 2px; position: absolute; top: -5px; left: 50%; transform: translateX(-50%); transition: border-color 0.3s, box-shadow 0.3s; }
    .cyber-dataset-node.connected .dataset-socket { border-color: #fff; box-shadow: 0 0 8px #fff; }
    
    .cyber-metrics { display: flex; flex-wrap: wrap; justify-content: space-between; margin-top: 20px; font-family: 'Space Mono', monospace; font-size: 0.65rem; color: #10b981; background: #050505; padding: 10px 15px; border: 1px solid #222; border-radius: 4px; gap: 10px; }
    .metric-item { display: flex; align-items: center; gap: 5px; }
    .metric-item i { color: #555; }
    
    .cyber-btn { width: 100%; margin-top: 15px; padding: 10px; background: transparent; border: 1px solid #ef4444; color: #ef4444; font-family: 'Space Mono', monospace; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; transition: all 0.3s; border-radius: 4px; display: flex; justify-content: center; align-items: center; }
    .cyber-btn:hover { background: rgba(239, 68, 68, 0.1); box-shadow: 0 0 10px rgba(239, 68, 68, 0.4); }
    .cyber-btn:disabled { border-color: #333 !important; color: #555 !important; cursor: not-allowed; background: #111 !important; box-shadow: none !important; }
</style>

<?php if(session('success')): ?>
    <div class="m-alert">
        <i class="fa-solid fa-check-circle text-xl"></i>
        <span><?php echo e(session('success')); ?></span>
    </div>
<?php endif; ?>

<div class="settings-wrapper">
    <!-- LEFT COLUMN: AI MODEL INFO -->
    <div>
        <div class="m-card">
            <h2 class="m-card-title">
                <i class="fa-solid fa-microchip text-red-600"></i> AI Core System
            </h2>
            
            <div class="ai-avatar-container">
                <img src="<?php echo e(asset('images/logo/staff/neura_ai_pose_1.webp')); ?>" alt="Neura AI" id="aiSettingsAvatar" class="ai-avatar ai-avatar-glitch">
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
                <span class="ai-spec-label">System Uptime</span>
                <span class="ai-spec-val font-mono text-emerald-500" id="sys-uptime" style="font-family: 'Space Mono', monospace; font-size: 0.85rem; letter-spacing: 1px;">00:00:00:00</span>
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

        <!-- SERVER INTEGRATION CARD -->
        <div class="m-card" style="margin-top: 24px;">
            <h2 class="m-card-title" style="font-size: 0.95rem;">
                <i class="fa-solid fa-server text-red-600"></i> Integrasi Server & Dataset
            </h2>
            <p style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 16px;">
                Tarik (drag) colokan abu-abu ke kotak dataset di bawahnya untuk menghubungkan *pipeline* data.
            </p>
            
            <div class="cyber-server-container" style="position: relative;">
                <!-- Loading Overlay -->
                <div id="cyberOverlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); z-index: 50; display: none; flex-direction: column; align-items: center; justify-content: center; backdrop-filter: blur(3px); border-radius: 8px;">
                    <i class="fa-solid fa-arrows-rotate fa-spin text-red-500 text-4xl mb-4"></i>
                    <span class="font-mono text-red-500 text-xs tracking-widest" style="animation: alert-pulse 1s infinite;">REINITIALIZING SYSTEM...</span>
                </div>

                <!-- Server Node -->
                <div class="cyber-server-node" onclick="toggleServerSpecs()" title="Klik untuk melihat spesifikasi hardware">
                    <div class="cyber-server-header">
                        <span><i class="fa-solid fa-microchip text-neutral-400" style="margin-right: 8px;"></i>SERVER CLIENT 1</span>
                        <span class="cyber-pulse-indicator"></span>
                    </div>
                    
                    <div class="cyber-server-specs" id="serverSpecs">
                        <div class="spec-grid">
                            <div class="spec-item"><span class="spec-label">CPU</span> <span class="spec-value">Ryzen 9 5950X</span></div>
                            <div class="spec-item"><span class="spec-label">RAM</span> <span class="spec-value">128GB DDR4</span></div>
                            <div class="spec-item"><span class="spec-label">GPU</span> <span class="spec-value text-red-500">Radeon RX 6600</span></div>
                            <div class="spec-item"><span class="spec-label">Storage</span> <span class="spec-value">4TB (3.26TB Free)</span></div>
                        </div>
                    </div>
                </div>

                <!-- Cables Connection Area -->
                <div class="cyber-connection-area">
                    <!-- Wire 1 -->
                    <div class="cyber-wire-col">
                        <div class="cyber-wire connected" id="wire-1" style="height: 85px;">
                            <div class="cyber-plug connected" id="plug-1">
                                <i class="fa-solid fa-plug" style="transform: rotate(180deg);"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Wire 2 -->
                    <div class="cyber-wire-col">
                        <div class="cyber-wire connected" id="wire-2" style="height: 85px;">
                            <div class="cyber-plug connected" id="plug-2">
                                <i class="fa-solid fa-plug" style="transform: rotate(180deg);"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Datasets Nodes -->
                <div class="cyber-datasets-row">
                    <div class="cyber-dataset-node connected" id="dataset-1">
                        <div class="dataset-socket" id="socket-1"></div>
                        <i class="fa-solid fa-database text-lg mb-1"></i>
                        <span>dataset-neura-2b7t.jsonl</span>
                    </div>
                    <div class="cyber-dataset-node connected" id="dataset-2">
                        <div class="dataset-socket" id="socket-2"></div>
                        <i class="fa-solid fa-database text-lg mb-1"></i>
                        <span>dataset-all-car-showroom-apex.sql</span>
                    </div>
                </div>
                
                <!-- Live Metrics -->
                <div class="cyber-metrics" style="width: 100%;">
                    <div class="metric-item"><i class="fa-solid fa-network-wired"></i> <span id="m-lat">12</span>ms</div>
                    <div class="metric-item"><i class="fa-solid fa-arrow-up"></i> <span id="m-up">450</span> Mbps</div>
                    <div class="metric-item"><i class="fa-solid fa-arrow-down"></i> <span id="m-down">980</span> Mbps</div>
                    <div class="metric-item"><i class="fa-solid fa-microchip"></i> <span id="m-cpu">45</span>°C</div>
                    <div class="metric-item"><i class="fa-solid fa-server"></i> <span id="m-srv">38</span>°C</div>
                </div>

                <!-- Refresh Button -->
                <button type="button" id="btnRefresh" class="cyber-btn" onclick="simulateRefresh()">
                    <i class="fa-solid fa-power-off" style="margin-right: 8px;"></i> RESTART SERVER PROCESS
                </button>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN: WEBSITE SETTINGS FORM -->
    <div>
        <div class="m-card">
            <h2 class="m-card-title">
                <i class="fa-solid fa-pen-nib text-red-600"></i> Konfigurasi Tampilan
            </h2>
            
            <form action="<?php echo e(route('manager.settings.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <div class="m-form-group">
                    <label class="m-form-label">Deskripsi Profil Showroom (Footer)</label>
                    <textarea name="footer_desc" class="m-input" rows="4" placeholder="Tuliskan deskripsi pameran di sini..."><?php echo e(old('footer_desc', $settings['footer_desc'])); ?></textarea>
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
                        <input type="text" name="social_instagram" class="m-input" value="<?php echo e(old('social_instagram', $settings['social_instagram'])); ?>">
                    </div>

                    <div class="m-form-group">
                        <label class="m-form-label"><i class="fa-brands fa-youtube text-red-500"></i> YouTube URL</label>
                        <input type="text" name="social_youtube" class="m-input" value="<?php echo e(old('social_youtube', $settings['social_youtube'])); ?>">
                    </div>

                    <div class="m-form-group">
                        <label class="m-form-label"><i class="fa-brands fa-facebook text-blue-500"></i> Facebook URL</label>
                        <input type="text" name="social_facebook" class="m-input" value="<?php echo e(old('social_facebook', $settings['social_facebook'])); ?>">
                    </div>

                    <div class="m-form-group">
                        <label class="m-form-label"><i class="fa-brands fa-linkedin text-blue-700"></i> LinkedIn URL</label>
                        <input type="text" name="social_linkedin" class="m-input" value="<?php echo e(old('social_linkedin', $settings['social_linkedin'])); ?>">
                    </div>
                </div>

                <div style="margin: 30px 0 20px;">
                    <h3 style="font-size: 1rem; font-weight: 700; color: var(--text-primary); display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-map-location-dot text-red-600"></i> Peta Lokasi Dealer (Leaflet)
                    </h3>
                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">Koordinat ini akan digunakan untuk menampilkan peta pada halaman utama pengunjung. Peta menggunakan OpenStreetMap (Gratis & Presisi).</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="m-form-group">
                        <label class="m-form-label">Latitude</label>
                        <input type="text" name="dealer_latitude" id="dealer_latitude" class="m-input" style="font-family: 'Space Mono', monospace;" value="<?php echo e(old('dealer_latitude', $settings['dealer_latitude'] ?? '-7.32733900')); ?>">
                    </div>

                    <div class="m-form-group">
                        <label class="m-form-label">Longitude</label>
                        <input type="text" name="dealer_longitude" id="dealer_longitude" class="m-input" style="font-family: 'Space Mono', monospace;" value="<?php echo e(old('dealer_longitude', $settings['dealer_longitude'] ?? '108.35416200')); ?>">
                    </div>
                </div>

                <div class="m-form-group">
                    <button type="button" onclick="getPreciseLocation()" class="m-btn" style="background:#2563eb; width:100%; justify-content:center;">
                        <i class="fa-solid fa-location-crosshairs"></i> Ambil Lokasi Saya (Lock Location)
                    </button>
                    <p id="geoStatus" style="font-size: 0.8rem; color: #10b981; margin-top: 8px; display: none; text-align:center;"><i class="fa-solid fa-check-circle"></i> Lokasi berhasil didapatkan dengan presisi tinggi!</p>
                    <p id="geoError" style="font-size: 0.8rem; color: #dc2626; margin-top: 8px; display: none; text-align:center;"><i class="fa-solid fa-triangle-exclamation"></i> Gagal mendapatkan lokasi.</p>
                </div>

                <!-- Admin Map Preview -->
                <div class="m-form-group mb-6">
                    <label class="m-form-label">Preview Lokasi (Geser pin merah untuk mengubah koordinat)</label>
                    <div id="adminMapPreview" style="height: 350px; width: 100%; border-radius: 8px; border: 1px solid var(--border-color); z-index: 1;"></div>
                </div>

                <div class="m-form-group" id="formActionsContainer" style="display: none; justify-content: flex-end; gap: 10px; margin-top: 10px; padding-top: 20px; border-top: 1px solid var(--border-color); animation: slideUp 0.3s ease-out;">
                    <style>@keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }</style>
                    <button type="button" class="m-btn" style="background: #333; color: #fff; border: 1px solid #555;" onclick="resetForm()">
                        <i class="fa-solid fa-rotate-left"></i> Batal
                    </button>
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
            "<?php echo e(asset('images/logo/staff/neura_ai_pose_1.webp')); ?>",
            "<?php echo e(asset('images/logo/staff/neura_ai_pose_2.webp')); ?>",
            "<?php echo e(asset('images/logo/staff/neura_ai_pose_3.webp')); ?>",
            "<?php echo e(asset('images/logo/staff/neura_ai_pose_4.webp')); ?>",
            "<?php echo e(asset('images/logo/staff/neura_ai_pose_5.webp')); ?>"
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

    // Unsaved Changes Tracker
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form[action="<?php echo e(route('manager.settings.update')); ?>"]');
        const actionsContainer = document.getElementById('formActionsContainer');
        
        if (form && actionsContainer) {
            let initialValues = {};
            
            function captureInitialValues() {
                const inputs = form.querySelectorAll('input:not([type="hidden"]), textarea');
                inputs.forEach(input => {
                    initialValues[input.id || input.name] = input.value;
                });
            }
            captureInitialValues();
            
            window.checkUnsavedChanges = function() {
                let isChanged = false;
                const inputs = form.querySelectorAll('input:not([type="hidden"]), textarea');
                
                inputs.forEach(input => {
                    let key = input.id || input.name;
                    if (input.value !== initialValues[key]) {
                        isChanged = true;
                    }
                });
                
                if (isChanged) {
                    actionsContainer.style.display = 'flex';
                } else {
                    actionsContainer.style.display = 'none';
                }
            };
            
            form.addEventListener('input', window.checkUnsavedChanges);
            form.addEventListener('change', window.checkUnsavedChanges);
            
            window.resetForm = function() {
                const inputs = form.querySelectorAll('input:not([type="hidden"]), textarea');
                inputs.forEach(input => {
                    let key = input.id || input.name;
                    if (initialValues[key] !== undefined) {
                        input.value = initialValues[key];
                    }
                });
                
                // Trigger change event to reset map marker
                let latInput = document.getElementById('dealer_latitude');
                if (latInput) latInput.dispatchEvent(new Event('change'));
                
                window.checkUnsavedChanges();
            };
        }
    });

    // Map initialization variables
    var adminMap, adminMarker;

    document.addEventListener('DOMContentLoaded', function() {
        var latInput = document.getElementById('dealer_latitude');
        var lngInput = document.getElementById('dealer_longitude');
        var lat = parseFloat(latInput.value) || -7.32733900;
        var lng = parseFloat(lngInput.value) || 108.35416200;

        adminMap = L.map('adminMapPreview').setView([lat, lng], 15);
        
        // Define base layers
        var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        });
        
        var satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 19,
            attribution: '© Esri World Imagery'
        });

        // Add default layer
        osmLayer.addTo(adminMap);
        
        // Add layer control
        L.control.layers({
            "Peta Jalan (Standar)": osmLayer,
            "Satelit (Esri)": satelliteLayer
        }, null, { position: 'topright' }).addTo(adminMap);

        var redIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Draggable marker
        adminMarker = L.marker([lat, lng], {icon: redIcon, draggable: true}).addTo(adminMap);
        adminMarker.bindPopup("<b>Lokasi Dealer</b><br>Geser marker ini untuk merubah koordinat.").openPopup();

        // Listen for drag end to update inputs
        adminMarker.on('dragend', function(event) {
            var position = adminMarker.getLatLng();
            latInput.value = position.lat.toFixed(8);
            lngInput.value = position.lng.toFixed(8);
            
            // Visual feedback
            latInput.style.backgroundColor = '#fef08a';
            lngInput.style.backgroundColor = '#fef08a';
            setTimeout(() => {
                latInput.style.backgroundColor = 'var(--bg-body)';
                lngInput.style.backgroundColor = 'var(--bg-body)';
            }, 1000);
            
            if(window.checkUnsavedChanges) window.checkUnsavedChanges();
        });
        
        // Listen to input changes to move marker
        latInput.addEventListener('change', updateMarkerFromInputs);
        lngInput.addEventListener('change', updateMarkerFromInputs);
        
        function updateMarkerFromInputs() {
            var newLat = parseFloat(latInput.value);
            var newLng = parseFloat(lngInput.value);
            if(!isNaN(newLat) && !isNaN(newLng)) {
                var newPos = new L.LatLng(newLat, newLng);
                adminMarker.setLatLng(newPos);
                adminMap.panTo(newPos);
            }
        }
        
        // Klik peta untuk memindahkan marker (seperti di aplikasi Asign)
        adminMap.on('click', function(e) {
            var newPos = e.latlng;
            adminMarker.setLatLng(newPos);
            
            latInput.value = newPos.lat.toFixed(8);
            lngInput.value = newPos.lng.toFixed(8);
            
            latInput.style.backgroundColor = '#fef08a';
            lngInput.style.backgroundColor = '#fef08a';
            setTimeout(() => {
                latInput.style.backgroundColor = 'var(--bg-body)';
                lngInput.style.backgroundColor = 'var(--bg-body)';
            }, 1000);
            
            if (adminMap.getZoom() < 17) adminMap.setView(newPos, 17);
            if (window.checkUnsavedChanges) window.checkUnsavedChanges();
        });
        
        // Fix for Leaflet rendering correctly initially
        setTimeout(function() { adminMap.invalidateSize(); }, 500);
    });

    // Geolocation API Logic
    function getPreciseLocation() {
        var geoStatus = document.getElementById('geoStatus');
        var geoError = document.getElementById('geoError');
        var latInput = document.getElementById('dealer_latitude');
        var lngInput = document.getElementById('dealer_longitude');
        
        geoStatus.style.display = 'none';
        geoError.style.display = 'none';
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                // Get coords with high precision (8+ digits)
                var lat = position.coords.latitude.toFixed(8);
                var lng = position.coords.longitude.toFixed(8);
                
                latInput.value = lat;
                lngInput.value = lng;
                
                // Update Map
                if(adminMap && adminMarker) {
                    var newPos = new L.LatLng(lat, lng);
                    adminMarker.setLatLng(newPos);
                    adminMap.flyTo(newPos, 17);
                }
                
                geoStatus.style.display = 'block';
                geoStatus.innerHTML = '<i class="fa-solid fa-check-circle"></i> Lokasi berhasil dikunci: ' + lat + ', ' + lng;
                
                latInput.style.backgroundColor = '#dcfce7';
                latInput.style.color = '#065f46';
                lngInput.style.backgroundColor = '#dcfce7';
                lngInput.style.color = '#065f46';
                
                setTimeout(() => {
                    latInput.style.backgroundColor = 'var(--bg-body)';
                    latInput.style.color = 'var(--text-primary)';
                    lngInput.style.backgroundColor = 'var(--bg-body)';
                    lngInput.style.color = 'var(--text-primary)';
                }, 1500);
                
                if (window.checkUnsavedChanges) window.checkUnsavedChanges();
                
            }, function(error) {
                geoError.style.display = 'block';
                geoError.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Error: ' + error.message;
            }, {
                enableHighAccuracy: true,
                timeout: 15000
            });
        } else {
            geoError.style.display = 'block';
            geoError.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Browser Anda tidak mendukung Geolocation.';
        }
    }

    // Cyber Server Logic
    function toggleServerSpecs() {
        var el = document.getElementById('serverSpecs');
        el.classList.toggle('expanded');
    }

    // Custom Visual Drag for Plugs
    let draggedPlug = null;
    let draggedWire = null;
    let dragStartY = 0;
    let dragStartHeight = 40;

    document.querySelectorAll('.cyber-plug').forEach(plug => {
        plug.onmousedown = function(e) {
            e.preventDefault(); // Stop text selection/native drag
            let wire = this.parentElement;
            
            draggedPlug = this;
            draggedWire = wire;
            dragStartY = e.clientY;
            dragStartHeight = parseInt(wire.style.height) || 40; // 40 or 85
            
            // Temporary styles for dragging
            draggedWire.style.transition = 'none';
            
            document.onmousemove = function(ev) {
                if(!draggedWire) return;
                let diff = ev.clientY - dragStartY;
                let newHeight = dragStartHeight + diff;
                
                // Limit stretch distance between 40 and 95
                if(newHeight >= 40 && newHeight <= 95) {
                    draggedWire.style.height = newHeight + 'px';
                }
            };
            
            document.onmouseup = function(ev) {
                if(!draggedWire) return;
                document.onmousemove = null;
                document.onmouseup = null;
                
                let currentHeight = parseInt(draggedWire.style.height);
                let id = draggedPlug.id.split('-')[1];
                
                // If dragged down far enough to the socket
                if(currentHeight > 75) {
                    connectWire(id);
                } else {
                    // Snap back to top (disconnected state)
                    draggedWire.style.transition = 'height 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                    draggedWire.style.height = '40px';
                    
                    if(draggedWire.classList.contains('connected')) {
                        disconnectWire(id);
                    }
                }
                
                draggedPlug = null;
                draggedWire = null;
            };
        };
    });

    function connectWire(id) {
        var wire = document.getElementById('wire-' + id);
        var dataset = document.getElementById('dataset-' + id);
        
        if (wire && dataset) {
            wire.style.transition = 'height 0.1s';
            wire.style.height = '85px'; // Exact height to reach socket
            
            wire.classList.add('connected');
            dataset.classList.add('connected');
            dataset.classList.remove('alert-disconnected');
            
            burstMetrics();
        }
    }

    function disconnectWire(id) {
        var wire = document.getElementById('wire-' + id);
        var dataset = document.getElementById('dataset-' + id);
        
        if (wire && dataset) {
            wire.classList.remove('connected');
            dataset.classList.remove('connected');
            
            // Add the red alert state to the dataset
            dataset.classList.add('alert-disconnected');
            
            dropMetrics();
        }
    }

    // System Uptime Tracker
    let systemStartTime = Date.now();
    let uptimeInterval;

    function updateUptime() {
        let diff = Math.floor((Date.now() - systemStartTime) / 1000);
        let d = Math.floor(diff / 86400);
        let h = Math.floor((diff % 86400) / 3600);
        let m = Math.floor((diff % 3600) / 60);
        let s = diff % 60;
        
        let formatted = 
            (d < 10 ? '0' + d : d) + ':' +
            (h < 10 ? '0' + h : h) + ':' + 
            (m < 10 ? '0' + m : m) + ':' + 
            (s < 10 ? '0' + s : s);
            
        let el = document.getElementById('sys-uptime');
        if(el) el.innerText = formatted;
    }
    
    uptimeInterval = setInterval(updateUptime, 1000);
    updateUptime();

    // Live Metrics Randomizer
    let currentCpu = 46;
    let currentSrv = 38;
    let isRefreshing = false;
    let networkInterval, tempInterval;

    function randomizeNetworkMetrics() {
        document.getElementById('m-lat').innerText = Math.floor(Math.random() * 45) + 5;
        document.getElementById('m-up').innerText = Math.floor(Math.random() * 600) + 200;
        document.getElementById('m-down').innerText = Math.floor(Math.random() * 800) + 400;
    }

    function randomizeTempMetrics() {
        currentCpu = 46 + (Math.random() > 0.6 ? 1 : (Math.random() < 0.4 ? -1 : 0));
        currentSrv = 38 + (Math.random() > 0.6 ? 1 : (Math.random() < 0.4 ? -1 : 0));
        document.getElementById('m-cpu').innerText = currentCpu;
        document.getElementById('m-srv').innerText = currentSrv;
    }
    
    networkInterval = setInterval(randomizeNetworkMetrics, 1500);
    tempInterval = setInterval(randomizeTempMetrics, 5000); // Slower 5-second interval for temps
    
    function burstMetrics() {
        clearInterval(networkInterval);
        let burstCount = 0;
        let burst = setInterval(() => {
            document.getElementById('m-lat').innerText = Math.floor(Math.random() * 5) + 2;
            document.getElementById('m-up').innerText = Math.floor(Math.random() * 300) + 800;
            document.getElementById('m-down').innerText = Math.floor(Math.random() * 500) + 1500;
            burstCount++;
            if(burstCount > 10) {
                clearInterval(burst);
                if (!isRefreshing) {
                    networkInterval = setInterval(randomizeNetworkMetrics, 1500);
                }
            }
        }, 100);
    }
    
    function dropMetrics() {
        if (isRefreshing) return;
        clearInterval(networkInterval);
        document.getElementById('m-lat').innerText = "ERR";
        document.getElementById('m-up').innerText = "0";
        document.getElementById('m-down').innerText = "0";
        
        setTimeout(() => {
            if (!isRefreshing) {
                networkInterval = setInterval(randomizeNetworkMetrics, 1500);
            }
        }, 2000);
    }
    
    // Simulate Refresh Process
    function simulateRefresh() {
        isRefreshing = true;
        let btn = document.getElementById('btnRefresh');
        let overlay = document.getElementById('cyberOverlay');
        
        // Disable button
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="margin-right: 8px;"></i> REBOOTING...';
        
        // Stop randomizers and reset to ZERO (or base levels)
        clearInterval(networkInterval);
        clearInterval(tempInterval);
        document.getElementById('m-lat').innerText = "0";
        document.getElementById('m-up').innerText = "0";
        document.getElementById('m-down').innerText = "0";
        document.getElementById('m-cpu').innerText = "32"; // Cool down to 32C during reboot
        document.getElementById('m-srv').innerText = "30";
        
        // Force disconnect wires
        disconnectWire(1);
        disconnectWire(2);
        
        // Snap wires back visually
        document.getElementById('wire-1').style.height = '40px';
        document.getElementById('wire-2').style.height = '40px';
        
        // Show Overlay
        overlay.style.display = 'flex';
        
        // After 2.5 seconds, finish loading
        setTimeout(() => {
            isRefreshing = false;
            overlay.style.display = 'none';
            
            // Restart temp randomizer & reset uptime
            tempInterval = setInterval(randomizeTempMetrics, 5000);
            systemStartTime = Date.now();
            updateUptime();
            
            // Reconnect (this triggers burstMetrics which restarts networkInterval)
            connectWire(1);
            connectWire(2);
            
            // Success state on button
            btn.innerHTML = '<i class="fa-solid fa-check" style="margin-right: 8px;"></i> SYSTEM ONLINE';
            btn.style.borderColor = '#10b981';
            btn.style.color = '#10b981';
            btn.style.boxShadow = '0 0 10px rgba(16, 185, 129, 0.4)';
            
            // Reset button to normal
            setTimeout(() => {
                btn.innerHTML = '<i class="fa-solid fa-power-off" style="margin-right: 8px;"></i> RESTART SERVER PROCESS';
                btn.style.borderColor = '';
                btn.style.color = '';
                btn.style.boxShadow = '';
                btn.disabled = false;
            }, 2000);
            
        }, 2500);
    }
</script>
<!-- Leaflet Map JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('manager.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\apex-automotive\resources\views/manager/settings.blade.php ENDPATH**/ ?>