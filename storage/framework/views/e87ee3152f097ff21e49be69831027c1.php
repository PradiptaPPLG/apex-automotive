<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIP Buyer Portal — Apex Automotive</title>
    <meta name="description" content="Portal VIP Pembeli Apex Automotive — Lacak status pembelian supercar Anda.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #080810;
            color: #e5e7eb;
            min-height: 100vh;
        }
        .portal-nav {
            background: rgba(8, 8, 16, 0.95);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(12px);
        }
        .portal-nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .portal-nav-logo img { height: 32px; }
        .portal-nav-logo span {
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            color: #dc2626;
            letter-spacing: 0.15em;
            font-weight: 700;
            text-transform: uppercase;
        }
        .nav-user {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            color: #9ca3af;
        }
        .nav-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: white;
            font-family: 'Space Mono', monospace;
        }
        .main-content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }
        .page-header {
            margin-bottom: 2.5rem;
        }
        .page-label {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #dc2626;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.25rem;
            font-weight: 800;
            color: white;
            line-height: 1.15;
        }
        .page-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-top: 6px;
        }
        .status-pipeline {
            display: flex;
            gap: 0;
            margin-bottom: 3rem;
            overflow-x: auto;
            padding-bottom: 4px;
        }
        .pipeline-step {
            flex: 1;
            min-width: 120px;
            padding: 12px 16px;
            border: 1px solid rgba(255,255,255,0.06);
            border-right: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
            background: rgba(255,255,255,0.02);
        }
        .pipeline-step:last-child { border-right: 1px solid rgba(255,255,255,0.06); }
        .pipeline-step-num {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: #4b5563;
            letter-spacing: 0.1em;
        }
        .pipeline-step-label {
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
        }
        .pipeline-step.active {
            border-color: rgba(220, 38, 38, 0.4);
            background: rgba(220, 38, 38, 0.06);
        }
        .pipeline-step.active .pipeline-step-num { color: #dc2626; }
        .pipeline-step.active .pipeline-step-label { color: #fca5a5; }
        .inquiries-grid {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .inquiry-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }
        .inquiry-card:hover {
            border-color: rgba(220, 38, 38, 0.4);
            background: rgba(220, 38, 38, 0.04);
        }
        .inquiry-icon {
            width: 48px; height: 48px;
            border: 1px solid rgba(220, 38, 38, 0.3);
            background: rgba(220, 38, 38, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dc2626;
            font-size: 18px;
            flex-shrink: 0;
        }
        .inquiry-info { flex: 1; min-width: 0; }
        .inquiry-car {
            font-family: 'Space Mono', monospace;
            font-size: 13px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .inquiry-meta {
            font-size: 12px;
            color: #6b7280;
            margin-top: 3px;
        }
        .inquiry-status {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 4px 10px;
            border: 1px solid;
        }
        .inquiry-msgs {
            font-size: 12px;
            color: #6b7280;
            text-align: right;
            flex-shrink: 0;
        }
        .inquiry-msgs-count {
            font-family: 'Space Mono', monospace;
            font-size: 18px;
            font-weight: 700;
            color: white;
            display: block;
        }
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            border: 1px dashed rgba(255,255,255,0.1);
        }
        .empty-state-icon {
            font-size: 3rem;
            color: #374151;
            margin-bottom: 1rem;
        }
        .empty-state-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 8px;
        }
        .empty-state-text { font-size: 14px; color: #6b7280; }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 1.5rem;
            padding: 12px 24px;
            background: #dc2626;
            color: white;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-primary:hover { background: #b91c1c; }
        .logout-btn {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: #6b7280;
            background: none;
            border: 1px solid rgba(255,255,255,0.1);
            padding: 6px 12px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.2s;
            text-decoration: none;
        }
        .logout-btn:hover { color: #ef4444; border-color: rgba(239, 68, 68, 0.3); }
    </style>
</head>
<body>
    <nav class="portal-nav">
        <a href="<?php echo e(route('home')); ?>" class="portal-nav-logo">
            <img src="<?php echo e(asset('images/logo/logo.png')); ?>" alt="Apex Automotive">
            <span>VIP Buyer Portal</span>
        </a>
        <div class="nav-user">
            <?php if(auth()->user()->isRm()): ?>
                <a href="<?php echo e(route('admin.inquiries.index')); ?>" class="logout-btn">
                    <i class="fa-solid fa-shield-halved mr-1"></i> Admin Panel
                </a>
            <?php elseif(auth()->user()->isDelivery()): ?>
                <a href="<?php echo e(route('delivery.portal')); ?>" class="logout-btn" style="border-color: rgba(249, 115, 22, 0.4); color: #f97316;">
                    <i class="fa-solid fa-truck-fast mr-1"></i> Delivery Driver Panel
                </a>
            <?php elseif(auth()->user()->isMechanic()): ?>
                <a href="<?php echo e(route('mechanic.dashboard')); ?>" class="logout-btn" style="border-color: rgba(249, 115, 22, 0.4); color: #f97316;">
                    <i class="fa-solid fa-wrench mr-1"></i> Mechanic Panel
                </a>
            <?php endif; ?>
            <div class="nav-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></div>
            <span><?php echo e(auth()->user()->name); ?></span>
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket mr-1"></i>Keluar</button>
            </form>
        </div>
    </nav>

    <main class="main-content">
        <div class="page-header">
            <p class="page-label">// <?php echo e(auth()->user()->isRm() || auth()->user()->isManager() ? 'Portal Sales RM & Staff — Contact Recent Buyer' : 'Portal VIP Pembeli'); ?></p>
            <h1 class="page-title">Selamat Datang, <?php echo e(explode(' ', auth()->user()->name)[0]); ?></h1>
            <p class="page-subtitle">
                <?php if(auth()->user()->isRm() || auth()->user()->isManager()): ?>
                    Daftar kontak buyer & inquiry konsumen terbaru. Klik kartu untuk merespon chat konsultasi.
                <?php else: ?>
                    Lacak seluruh status konsultasi, pemesanan, dan servis kendaraan eksklusif Anda.
                <?php endif; ?>
            </p>
        </div>

        
        <div style="display:flex; gap:0; border-bottom:1px solid rgba(255,255,255,0.08); margin-bottom:2rem;">
            <button id="tab-purchase" onclick="switchTab('purchase')" style="font-family:'Space Mono',monospace; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.1em; padding:12px 24px; border:none; background:rgba(220,38,38,0.1); color:#fca5a5; border-bottom:2px solid #dc2626; cursor:pointer; transition:all .2s;">
                <i class="fa-solid fa-car mr-2"></i> Purchase Inquiry
                <?php if($inquiries->isNotEmpty()): ?>
                    <span style="margin-left:6px; background:rgba(220,38,38,.3); padding:2px 7px; font-size:9px; border-radius:10px;"><?php echo e($inquiries->count()); ?></span>
                <?php endif; ?>
            </button>
            <button id="tab-service" onclick="switchTab('service')" style="font-family:'Space Mono',monospace; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.1em; padding:12px 24px; border:none; background:transparent; color:#6b7280; border-bottom:2px solid transparent; cursor:pointer; transition:all .2s;">
                <i class="fa-solid fa-screwdriver-wrench mr-2"></i> Service & Modification
                <?php if(isset($serviceBookings) && $serviceBookings->isNotEmpty()): ?>
                    <span style="margin-left:6px; background:rgba(249,115,22,.25); color:#f97316; padding:2px 7px; font-size:9px; border-radius:10px;"><?php echo e($serviceBookings->count()); ?></span>
                <?php endif; ?>
            </button>
        </div>

        
        <div id="content-purchase">
        <?php if($inquiries->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-state-icon"><i class="fa-solid fa-car-side"></i></div>
                <h2 class="empty-state-title">Belum Ada Inquiry</h2>
                <p class="empty-state-text">Anda belum mengajukan konsultasi pembelian. Kunjungi showroom dan pilih kendaraan impian Anda.</p>
                <a href="<?php echo e(route('home')); ?>" class="btn-primary"><i class="fa-solid fa-arrow-left"></i> Kunjungi Showroom</a>
            </div>
        <?php else: ?>
            <div class="inquiries-grid">
                <?php $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isDelivery = in_array($inquiry->status, ['scheduled_delivery', 'delivered_completed']);
                        $hasUnread = (($inquiry->unread_count ?? 0) > 0);
                    ?>
                    <a href="<?php echo e(route('portal.consultation', $inquiry)); ?>" class="inquiry-card" style="position: relative;">
                        <?php if($hasUnread): ?>
                            <span style="position: absolute; top: 12px; left: 12px; width: 10px; height: 10px; border-radius: 50%; background: #ef4444; box-shadow: 0 0 8px #ef4444; z-index: 2;" title="Pesan Baru Belum Dibaca"></span>
                        <?php endif; ?>

                        <?php if($isDelivery): ?>
                            <div class="inquiry-icon" style="border-color: rgba(249, 115, 22, 0.4); background: rgba(249, 115, 22, 0.12); color: #f97316;">
                                <i class="fa-solid fa-box-archive"></i>
                            </div>
                        <?php else: ?>
                            <div class="inquiry-icon" style="border-color: rgba(234, 179, 8, 0.4); background: rgba(234, 179, 8, 0.12); color: #eab308;">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </div>
                        <?php endif; ?>

                        <div class="inquiry-info">
                            <div class="inquiry-car" style="display: flex; align-items: center; gap: 8px;">
                                <?php echo e($inquiry->car_model ?? 'Kendaraan VIP'); ?>

                                <?php if(auth()->user()->isRm() || auth()->user()->isManager()): ?>
                                    <span style="font-size: 9px; font-family: monospace; padding: 2px 6px; background: rgba(59, 130, 246, 0.2); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.4); border-radius: 2px;">BUYER: <?php echo e($inquiry->name); ?></span>
                                <?php elseif($isDelivery): ?>
                                    <span style="font-size: 9px; font-family: monospace; padding: 2px 6px; background: rgba(249, 115, 22, 0.2); color: #f97316; border: 1px solid rgba(249, 115, 22, 0.4); border-radius: 2px;">DELIVERY ACTIVE</span>
                                <?php else: ?>
                                    <span style="font-size: 9px; font-family: monospace; padding: 2px 6px; background: rgba(234, 179, 8, 0.2); color: #eab308; border: 1px solid rgba(234, 179, 8, 0.4); border-radius: 2px;">SALES CONSULTATION</span>
                                <?php endif; ?>
                            </div>
                            <div class="inquiry-meta">
                                Kontak: <strong style="color: #e5e7eb;"><?php echo e($inquiry->name); ?></strong> (<?php echo e($inquiry->phone); ?>) &nbsp;·&nbsp; Diajukan <?php echo e($inquiry->created_at->diffForHumans()); ?>

                                <?php if($inquiry->assigned_rm_name): ?>
                                    &nbsp;·&nbsp; RM: <?php echo e($inquiry->assigned_rm_name); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                        <span class="inquiry-status <?php echo e($inquiry->statusColor()); ?>"><?php echo e($inquiry->statusLabel()); ?></span>
                        <div class="inquiry-msgs" style="display: flex; align-items: center; gap: 8px;">
                            <div>
                                <span class="inquiry-msgs-count"><?php echo e($inquiry->messages_count); ?></span>
                                pesan
                            </div>
                            <?php if($hasUnread): ?>
                                <span style="width: 8px; height: 8px; border-radius: 50%; background: #ef4444; display: inline-block;"></span>
                            <?php endif; ?>
                        </div>
                        <i class="fa-solid fa-chevron-right" style="color: #374151; font-size: 12px;"></i>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        </div>

        
        <div id="content-service" style="display:none;">
            <div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
                <a href="<?php echo e(route('service.create')); ?>" style="display:inline-flex; align-items:center; gap:8px; padding:10px 20px; background:#dc2626; color:white; font-family:'Space Mono',monospace; font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; text-decoration:none; transition:background .2s;">
                    <i class="fa-solid fa-plus"></i> Book New Service
                </a>
            </div>

            <?php if(isset($serviceBookings) && $serviceBookings->isNotEmpty()): ?>
                <div class="inquiries-grid">
                    <?php $__currentLoopData = $serviceBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $sbUnread = ($sb->unread_count ?? 0) > 0; ?>
                        <a href="<?php echo e(route('service.show', $sb)); ?>" class="inquiry-card" style="position:relative;">
                            <?php if($sbUnread): ?>
                                <span style="position:absolute;top:12px;left:12px;width:10px;height:10px;border-radius:50%;background:#ef4444;box-shadow:0 0 8px #ef4444;z-index:2;"></span>
                            <?php endif; ?>
                            <div class="inquiry-icon" style="border-color:rgba(249,115,22,.35);background:rgba(249,115,22,.1);color:#f97316;">
                                <i class="fa-solid <?php echo e($sb->serviceTypeIcon()); ?>"></i>
                            </div>
                            <div class="inquiry-info">
                                <div class="inquiry-car" style="display:flex;align-items:center;gap:8px;">
                                    <?php echo e($sb->title); ?>

                                    <span style="font-size:9px;padding:2px 6px;background:rgba(249,115,22,.15);color:#fdba74;border:1px solid rgba(249,115,22,.3);border-radius:2px;">
                                        <?php echo e(strtoupper(str_replace('_',' ',$sb->service_type))); ?>

                                    </span>
                                </div>
                                <div class="inquiry-meta">
                                    Kendaraan: <strong style="color:#e5e7eb;"><?php echo e($sb->vehicle->displayName()); ?></strong>
                                    &nbsp;·&nbsp;
                                    Jadwal: <?php echo e($sb->preferred_date?->format('d M Y')); ?>

                                    <?php if($sb->assigned_mechanic_name): ?> &nbsp;·&nbsp; Teknisi: <?php echo e($sb->assigned_mechanic_name); ?> <?php endif; ?>
                                    &nbsp;·&nbsp; <?php echo e($sb->created_at->diffForHumans()); ?>

                                </div>
                            </div>
                            <span class="inquiry-status <?php echo e($sb->statusColor()); ?>"><?php echo e($sb->statusLabel()); ?></span>
                            <div class="inquiry-msgs" style="display:flex;align-items:center;gap:8px;">
                                <div><span class="inquiry-msgs-count"><?php echo e($sb->messages_count); ?></span> pesan</div>
                                <?php if($sbUnread): ?><span style="width:8px;height:8px;border-radius:50%;background:#ef4444;display:inline-block;"></span><?php endif; ?>
                            </div>
                            <i class="fa-solid fa-chevron-right" style="color:#374151;font-size:12px;"></i>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                    <h2 class="empty-state-title">Belum Ada Booking Service</h2>
                    <p class="empty-state-text">Ajukan servis berkala, performance tuning, atau modifikasi kendaraan Anda sekarang.</p>
                    <a href="<?php echo e(route('service.create')); ?>" class="btn-primary"><i class="fa-solid fa-calendar-plus"></i> Buat Booking Pertama</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script>
        function switchTab(tab) {
            const tabs = ['purchase', 'service'];
            tabs.forEach(t => {
                const btn = document.getElementById('tab-' + t);
                const content = document.getElementById('content-' + t);
                if (t === tab) {
                    btn.style.background = 'rgba(220,38,38,0.1)';
                    btn.style.color = '#fca5a5';
                    btn.style.borderBottom = '2px solid #dc2626';
                    if (content) content.style.display = 'block';
                } else {
                    btn.style.background = 'transparent';
                    btn.style.color = '#6b7280';
                    btn.style.borderBottom = '2px solid transparent';
                    if (content) content.style.display = 'none';
                }
            });
        }

        // Auto-switch to service tab if ?tab=service in URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('tab') === 'service') {
            switchTab('service');
        }
    </script>
    <?php echo $__env->make('partials.chatbot', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>


<?php /**PATH C:\xampp\htdocs\apex-automotive\resources\views/portal/dashboard.blade.php ENDPATH**/ ?>