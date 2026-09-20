<?php $__env->startSection('title', 'Dashboard & Analytics Manager'); ?>
<?php $__env->startSection('page_header', 'Metabase Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* METABASE UI STYLES & VARIABLES */
    .metabase-dashboard {
        --mb-bg: #f6f8f9;
        --mb-card-bg: white;
        --mb-border: #e1e8ed;
        --mb-text-main: #394359;
        --mb-text-muted: #8492a6;
        --mb-chart-grid: #edf2f7;
        --mb-pie-border: #ffffff;
        
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        background-color: var(--mb-bg) !important;
        padding: 24px;
        min-height: 100vh;
        margin: -24px; /* Override manager layout padding if any */
        color: var(--mb-text-muted);
        transition: background-color 0.3s ease;
    }
    
    .dark .metabase-dashboard {
        --mb-bg: #0b0b13;
        --mb-card-bg: #161622;
        --mb-border: rgba(255, 255, 255, 0.1);
        --mb-text-main: #e2e8f0;
        --mb-text-muted: #94a3b8;
        --mb-chart-grid: rgba(255, 255, 255, 0.05);
        --mb-pie-border: #161622;
    }

    .mb-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        grid-auto-rows: minmax(140px, auto);
        gap: 16px;
        margin-bottom: 16px;
    }
    
    /* Responsive Grid for mobile */
    @media (max-width: 1024px) {
        .span-1, .span-2, .span-3, .span-4, .span-6 { grid-column: span 6; }
    }
    @media (max-width: 640px) {
        .span-1, .span-2, .span-3, .span-4, .span-6 { grid-column: span 12; }
    }
    
    .span-1 { grid-column: span 1; }
    .span-2 { grid-column: span 2; }
    .span-3 { grid-column: span 3; }
    .span-4 { grid-column: span 4; }
    .span-6 { grid-column: span 6; }
    .span-12 { grid-column: span 12; }
    .mb-card {
        background: var(--mb-card-bg);
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.1);
        padding: 20px;
        display: flex;
        flex-direction: column;
        border: 1px solid var(--mb-border);
        transition: all 0.2s ease;
    }
    .dark .mb-card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }
    .mb-card:hover {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .dark .mb-card:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
    }
    .mb-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    .mb-card-title {
        font-size: 13px;
        font-weight: 600;
        color: var(--mb-text-main);
        text-transform: capitalize;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .mb-card-menu {
        color: var(--mb-text-muted);
        cursor: pointer;
    }
    .mb-number {
        font-size: 38px;
        font-weight: 700;
        color: #509ee3;
        line-height: 1;
        margin-top: auto;
    }
    .mb-number.green { color: #84bb3c; }
    .mb-number.red { color: #ed5c5c; }
    .mb-number.orange { color: #f2a83b; }
    .mb-number.purple { color: #9c6ade; }
    .mb-number.dark { color: var(--mb-text-main); }

    .mb-sub-metric {
        font-size: 12px;
        color: var(--mb-text-muted);
        margin-top: 8px;
    }
    
    .mb-chart-card {
        grid-column: span 6;
        min-height: 350px;
    }
    @media (max-width: 1024px) {
        .mb-chart-card { grid-column: span 12; }
    }
    .mb-table-card {
        grid-column: span 12;
    }

    .mb-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .mb-table th {
        text-align: left;
        padding: 12px 16px;
        border-bottom: 2px solid var(--mb-chart-grid);
        color: var(--mb-text-muted);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 11px;
    }
    .mb-table td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--mb-border);
        color: var(--mb-text-main);
    }
    .mb-table tr:hover {
        background-color: rgba(128, 128, 128, 0.05);
    }

    .mb-footer {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 24px 0 10px;
        color: var(--mb-text-muted);
        font-size: 14px;
        font-weight: 500;
    }
    .mb-footer div {
        color: var(--mb-text-main);
    }
    .mb-logo-icon {
        display: grid;
        grid-template-columns: repeat(3, 4px);
        gap: 2px;
        align-items: end;
    }
    .mb-logo-icon div {
        width: 4px;
        background-color: #509ee3;
        border-radius: 1px;
    }
    .mb-logo-icon div:nth-child(1) { height: 12px; }
    .mb-logo-icon div:nth-child(2) { height: 8px; }
    .mb-logo-icon div:nth-child(3) { height: 16px; }
</style>

<div class="metabase-dashboard">
    
    <!-- METRICS GRID ROW 1 -->
    <div class="mb-grid">
        <div class="mb-card span-3">
            <div class="mb-card-header">
                <div class="mb-card-title">Total Jenis Mobil</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="mb-number dark"><?php echo e($totalCars); ?></div>
            <div class="mb-sub-metric">Total Asset Showroom</div>
        </div>

        <div class="mb-card span-3">
            <div class="mb-card-header">
                <div class="mb-card-title">Unit Available (Ready)</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="mb-number green"><?php echo e($carStats['available']); ?></div>
            <div class="mb-sub-metric">Siap dijual</div>
        </div>

        <div class="mb-card span-2">
            <div class="mb-card-header">
                <div class="mb-card-title">Unit Reserved</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="mb-number orange"><?php echo e($carStats['reserved']); ?></div>
            <div class="mb-sub-metric">Proses SPK</div>
        </div>

        <div class="mb-card span-2">
            <div class="mb-card-header">
                <div class="mb-card-title">Unit Sold Out</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="mb-number red"><?php echo e($carStats['sold']); ?></div>
            <div class="mb-sub-metric">Selesai</div>
        </div>

        <div class="mb-card span-2">
            <div class="mb-card-header">
                <div class="mb-card-title">Inquiries</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="mb-number"><?php echo e($totalInquiries); ?></div>
            <div class="mb-sub-metric">Leads Masuk</div>
        </div>
    </div>

    <!-- METRICS GRID ROW 2 -->
    <div class="mb-grid">
        <div class="mb-card span-2">
            <div class="mb-card-header">
                <div class="mb-card-title">Total Visit Website</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="mb-number purple"><?php echo e($totalVisits); ?></div>
            <div class="mb-sub-metric">Pengunjung Landing Page</div>
        </div>

        <div class="mb-card span-2">
            <div class="mb-card-header">
                <div class="mb-card-title">Total Unit Mobil</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="mb-number" style="color: #60a5fa;"><?php echo e($totalUnits); ?></div>
            <div class="mb-sub-metric">Total Fisik Unit (Stok Varian)</div>
        </div>

        <div class="mb-card span-2">
            <div class="mb-card-header">
                <div class="mb-card-title">Total User Aktif</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="mb-number orange">32</div>
            <div class="mb-sub-metric">Pengguna Login (24 Jam)</div>
        </div>

        <div class="mb-card span-2">
            <div class="mb-card-header">
                <div class="mb-card-title">Sales Selesai</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="mb-number green"><?php echo e($inquiryStats['completed']); ?></div>
            <div class="mb-sub-metric">Terkirim</div>
        </div>

        <div class="mb-card span-2">
            <div class="mb-card-header">
                <div class="mb-card-title">Sales RM</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="mb-number dark"><?php echo e($totalRm); ?></div>
            <div class="mb-sub-metric">Aktif</div>
        </div>

        <div class="mb-card span-2">
            <div class="mb-card-header">
                <div class="mb-card-title">Drivers</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div class="mb-number dark"><?php echo e($totalDelivery); ?></div>
            <div class="mb-sub-metric">Escort</div>
        </div>
    </div>

    <!-- CHARTS GRID ROW 3 -->
    <div class="mb-grid">
        <div class="mb-card mb-chart-card">
            <div class="mb-card-header">
                <div class="mb-card-title">Pipeline Sales & Konsultasi</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div style="flex: 1; position: relative;">
                <canvas id="mbBarChart"></canvas>
            </div>
        </div>

        <div class="mb-card mb-chart-card">
            <div class="mb-card-header">
                <div class="mb-card-title">Rasio Status Mobil</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div style="flex: 1; position: relative; display: flex; align-items: center; justify-content: center;">
                <canvas id="mbPieChart"></canvas>
            </div>
        </div>
    </div>

    <!-- TABLE GRID ROW 4 -->
    <div class="mb-grid">
        <div class="mb-card mb-table-card">
            <div class="mb-card-header">
                <div class="mb-card-title">Data Inquiries Terbaru</div>
                <div class="mb-card-menu"><i class="fa-solid fa-ellipsis"></i></div>
            </div>
            <div style="overflow-x: auto;">
                <table class="mb-table">
                    <thead>
                        <tr>
                            <th>ID & Pembeli</th>
                            <th>Unit Mobil</th>
                            <th>Sales RM</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentInquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <div style="font-weight: 600;"><?php echo e($inquiry->name); ?></div>
                                    <div style="font-size: 11px; color: #8492a6;">#APX-<?php echo e(str_pad($inquiry->id, 5, '0', STR_PAD_LEFT)); ?></div>
                                </td>
                                <td><?php echo e($inquiry->car_model); ?></td>
                                <td><?php echo e($inquiry->assigned_rm_name ?? 'Unassigned'); ?></td>
                                <td>
                                    <span style="font-size: 11px; font-weight: 600; padding: 4px 8px; border-radius: 4px; background: #edf2f7; color: #4a5568;">
                                        <?php echo e($inquiry->statusLabel()); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" style="text-align: center; color: #8492a6;">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mb-footer">
        Powered by 
        <div style="display: flex; align-items: center; gap: 6px; font-weight: 700; color: #394359;">
            <div class="mb-logo-icon">
                <div></div><div></div><div></div>
            </div>
            Metabase
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Number Count Up Animation — fixed 1000ms duration regardless of number size
        const countUpEase = (t) => 1 - Math.pow(1 - t, 3);
        const statNumbers = document.querySelectorAll('.mb-number');
        statNumbers.forEach(el => {
            const raw = el.innerText.replace(/[^0-9]/g, '');
            const target = parseInt(raw) || 0;
            if (target > 0) {
                el.innerText = '0';
                const duration = 1000;
                const startTime = performance.now();
                function countStep(now) {
                    const progress = Math.min((now - startTime) / duration, 1);
                    el.innerText = Math.round(target * countUpEase(progress)).toLocaleString('id-ID');
                    if (progress < 1) requestAnimationFrame(countStep);
                }
                requestAnimationFrame(countStep);
            }
        });

        // Get CSS variables for charts
        const rootStyles = getComputedStyle(document.querySelector('.metabase-dashboard'));
        const getVar = (name) => rootStyles.getPropertyValue(name).trim();

        const gridColor = getVar('--mb-chart-grid') || '#edf2f7';
        const textColor = getVar('--mb-text-muted') || '#8492a6';
        const titleColor = getVar('--mb-text-main') || '#394359';
        const pieBorderColor = getVar('--mb-pie-border') || '#ffffff';

        // Bar chart target values
        const barTargets = [
            <?php echo e($inquiryStats['received']); ?>,
            <?php echo e($inquiryStats['consultation']); ?>,
            <?php echo e($inquiryStats['spk']); ?>,
            <?php echo e($inquiryStats['kyc']); ?>,
            <?php echo e($inquiryStats['contract']); ?>,
            <?php echo e($inquiryStats['payment']); ?>,
            <?php echo e($inquiryStats['delivery']); ?>,
            <?php echo e($inquiryStats['completed']); ?>

        ];

        const ctxBar = document.getElementById('mbBarChart').getContext('2d');
        const barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Lead Masuk', 'Konsultasi', 'SPK Issued', 'Dokumen KYC', 'E-Sign SPA', 'Pembayaran', 'Pengiriman', 'Selesai'],
                datasets: [{
                    label: 'Count',
                    data: [0, 0, 0, 0, 0, 0, 0, 0],
                    backgroundColor: '#509ee3',
                    borderRadius: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: Math.max(...barTargets, 1) * 1.25,
                        ticks: { color: textColor, precision: 0 },
                        grid: { color: gridColor },
                        border: { display: false }
                    },
                    x: {
                        ticks: { color: textColor, font: { size: 11 } },
                        grid: { display: false },
                        border: { display: false }
                    }
                }
            }
        });

        // Manual staggered bar animation using requestAnimationFrame
        const animDuration = 700;
        const easeOutQuart = (t) => 1 - Math.pow(1 - t, 4);
        barTargets.forEach((target, i) => {
            setTimeout(() => {
                const startTime = performance.now();
                function step(now) {
                    const elapsed = now - startTime;
                    const progress = Math.min(elapsed / animDuration, 1);
                    barChart.data.datasets[0].data[i] = target * easeOutQuart(progress);
                    barChart.update('none');
                    if (progress < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }, i * 120);
        });

        // Metabase Style Doughnut/Pie Chart
        const ctxDoughnut = document.getElementById('mbPieChart').getContext('2d');
        const pieChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Available', 'Reserved', 'Sold Out'],
                datasets: [{
                    data: [
                        <?php echo e($carStats['available']); ?>,
                        <?php echo e($carStats['reserved']); ?>,
                        <?php echo e($carStats['sold']); ?>

                    ],
                    backgroundColor: ['#84bb3c', '#f2a83b', '#ed5c5c'],
                    borderWidth: 2,
                    borderColor: pieBorderColor,
                    cutout: '60%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { color: titleColor, font: { size: 12, weight: '500' }, usePointStyle: true, boxWidth: 8 }
                    }
                }
            }
        });

        // Add a MutationObserver to update chart colors dynamically when dark mode toggles
        const observer = new MutationObserver(() => {
            const currentRootStyles = getComputedStyle(document.querySelector('.metabase-dashboard'));
            const currentGridColor = currentRootStyles.getPropertyValue('--mb-chart-grid').trim() || '#edf2f7';
            const currentTextColor = currentRootStyles.getPropertyValue('--mb-text-muted').trim() || '#8492a6';
            const currentTitleColor = currentRootStyles.getPropertyValue('--mb-text-main').trim() || '#394359';
            const currentPieBorderColor = currentRootStyles.getPropertyValue('--mb-pie-border').trim() || '#ffffff';

            barChart.options.scales.y.grid.color = currentGridColor;
            barChart.options.scales.y.ticks.color = currentTextColor;
            barChart.options.scales.x.ticks.color = currentTextColor;
            barChart.update();

            pieChart.data.datasets[0].borderColor = currentPieBorderColor;
            pieChart.options.plugins.legend.labels.color = currentTitleColor;
            pieChart.update();
        });

        // Observe the body or html tag for class changes (specifically for .dark)
        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
        observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('manager.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\apex-automotive\resources\views/manager/dashboard.blade.php ENDPATH**/ ?>