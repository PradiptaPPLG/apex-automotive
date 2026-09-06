@extends('manager.layout')

@section('title', 'Dashboard & Analytics Manager')
@section('page_header', 'Executive Analytics & Control Center')

@section('content')
<div style="display: flex; flex-direction: column; gap: 28px;">
    <!-- Metric Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
        <div class="card-panel" style="border-left: 4px solid #ef4444;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="mgr-stat-label">TOTAL UNIT MOBIL SHOWROOM</div>
                    <div class="mgr-metric-num">
                        {{ $totalCars }} <span style="font-size: 12px; color: var(--text-muted); font-family: 'Inter', sans-serif; font-weight: 400;">Unit</span>
                    </div>
                </div>
                <div style="background: rgba(239,68,68,0.12); color: #ef4444; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="fa-solid fa-car"></i>
                </div>
            </div>
            <div style="margin-top: 10px; font-size: 11px; color: var(--text-muted); display: flex; gap: 10px; font-family: 'Space Mono', monospace;">
                <span style="color: #4ade80;"><i class="fa-solid fa-circle text-[8px]"></i> {{ $carStats['available'] }} Ready</span>
                <span style="color: #f87171;"><i class="fa-solid fa-circle text-[8px]"></i> {{ $carStats['sold'] }} Sold Out</span>
            </div>
        </div>

        <div class="card-panel" style="border-left: 4px solid #eab308;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="mgr-stat-label">ANGGOTA SALES RM</div>
                    <div class="mgr-metric-num">
                        {{ $totalRm }} <span style="font-size: 12px; color: var(--text-muted); font-family: 'Inter', sans-serif; font-weight: 400;">Personel</span>
                    </div>
                </div>
                <div style="background: rgba(234,179,8,0.12); color: #eab308; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
            <div style="margin-top: 10px; font-size: 11px; color: var(--text-muted); font-family: 'Space Mono', monospace;">
                <span>Tim Relationship Manager</span>
            </div>
        </div>

        <div class="card-panel" style="border-left: 4px solid #22d3ee;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="mgr-stat-label">DELIVERY DRIVERS</div>
                    <div class="mgr-metric-num">
                        {{ $totalDelivery }} <span style="font-size: 12px; color: var(--text-muted); font-family: 'Inter', sans-serif; font-weight: 400;">Personel</span>
                    </div>
                </div>
                <div style="background: rgba(34,211,238,0.12); color: #22d3ee; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
            </div>
            <div style="margin-top: 10px; font-size: 11px; color: var(--text-muted); font-family: 'Space Mono', monospace;">
                <span>Armada Escort Specialist</span>
            </div>
        </div>

        <div class="card-panel" style="border-left: 4px solid #10b981;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="mgr-stat-label">TOTAL PERMINTAAN INQUIRY</div>
                    <div class="mgr-metric-num">
                        {{ $totalInquiries }} <span style="font-size: 12px; color: var(--text-muted); font-family: 'Inter', sans-serif; font-weight: 400;">Inquiries</span>
                    </div>
                </div>
                <div style="background: rgba(16,185,129,0.12); color: #10b981; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="fa-solid fa-headset"></i>
                </div>
            </div>
            <div style="margin-top: 10px; font-size: 11px; color: var(--text-muted); font-family: 'Space Mono', monospace;">
                <span>Total Permintaan VIP Viewing</span>
            </div>
        </div>
    </div>

    <!-- Chart.js Section -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
        <!-- Bar Chart Panel -->
        <div class="card-panel" style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 class="mgr-card-heading">Diagram Pipeline Sales &amp; Konsultasi</h3>
                    <p class="mgr-card-sub">Distribusi inquiry buyer berdasarkan tahap transaksi</p>
                </div>
                <span style="font-family: 'Space Mono', monospace; font-size: 10px; padding: 4px 8px; background: rgba(220,38,38,0.15); border: 1px solid rgba(220,38,38,0.3); color: #ef4444; border-radius: 4px;">
                    LIVE ANALYTICS
                </span>
            </div>
            <div style="height: 250px; position: relative;">
                <canvas id="pipelineBarChart"></canvas>
            </div>
        </div>

        <!-- Donut Chart Panel -->
        <div class="card-panel" style="display: flex; flex-direction: column; gap: 16px;">
            <div>
                <h3 class="mgr-card-heading">Status Showroom Mobil</h3>
                <p class="mgr-card-sub">Perbandingan unit Ready vs Sold Out</p>
            </div>
            <div style="height: 200px; position: relative; display: flex; items-center; justify-content: center;">
                <canvas id="carStatusDoughnut"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Inquiries Table -->
    <div class="card-panel">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
            <div>
                <h3 class="mgr-card-heading">Inquiry Transaksi Terbaru</h3>
                <p class="mgr-card-sub">Permintaan konsultasi terkini dari buyer</p>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                <thead>
                    <tr class="mgr-table-header-row">
                        <th style="padding: 10px;">ID &amp; PEMBELI</th>
                        <th style="padding: 10px;">UNIT MOBIL</th>
                        <th style="padding: 10px;">SALES RM</th>
                        <th style="padding: 10px;">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentInquiries as $inquiry)
                        <tr class="mgr-table-body-row">
                            <td style="padding: 12px 10px;">
                                <div class="mgr-cell-heading">{{ $inquiry->name }}</div>
                                <div style="font-size: 11px; font-family: 'Space Mono', monospace; color: #ef4444;">#APX-{{ str_pad($inquiry->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td style="padding: 12px 10px; color: var(--text-base);">{{ $inquiry->car_model }}</td>
                            <td style="padding: 12px 10px; color: var(--text-base);">{{ $inquiry->assigned_rm_name ?? 'Belum Diassigned' }}</td>
                            <td style="padding: 12px 10px;">
                                <span style="font-family: 'Space Mono', monospace; font-size: 10px; padding: 4px 8px; border-radius: 2px; text-transform: uppercase; font-weight: 700;" class="{{ $inquiry->statusColor() }}">
                                    {{ $inquiry->statusLabel() }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 24px; text-align: center; color: var(--text-dim);">Belum ada inquiry transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const isLight = document.documentElement.classList.contains('light');
        const gridColor  = isLight ? 'rgba(0,0,0,0.07)' : 'rgba(255,255,255,0.05)';
        const tickColor  = isLight ? '#6b7280'           : '#9ca3af';
        const legendColor= isLight ? '#374151'           : '#d1d5db';
        const doughnutBorder = isLight ? '#f3f4f6'       : '#080810';

        // Bar Chart - Pipeline Sales
        const ctxBar = document.getElementById('pipelineBarChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Lead Masuk', 'Konsultasi', 'SPK Issued', 'Dokumen KYC', 'E-Sign SPA', 'Pembayaran', 'Pengiriman', 'Selesai'],
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: [
                        {{ $inquiryStats['received'] }},
                        {{ $inquiryStats['consultation'] }},
                        {{ $inquiryStats['spk'] }},
                        {{ $inquiryStats['kyc'] }},
                        {{ $inquiryStats['contract'] }},
                        {{ $inquiryStats['payment'] }},
                        {{ $inquiryStats['delivery'] }},
                        {{ $inquiryStats['completed'] }}
                    ],
                    backgroundColor: [
                        'rgba(251, 191, 36, 0.7)',
                        'rgba(96, 165, 250, 0.7)',
                        'rgba(192, 132, 252, 0.7)',
                        'rgba(251, 146, 60, 0.7)',
                        'rgba(34, 211, 238, 0.7)',
                        'rgba(74, 222, 128, 0.7)',
                        'rgba(129, 140, 248, 0.7)',
                        'rgba(248, 113, 113, 0.7)'
                    ],
                    borderColor: [
                        '#fbbf24', '#60a5fa', '#c084fc', '#fb923c', '#22d3ee', '#4ade80', '#818cf8', '#f87171'
                    ],
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: tickColor, precision: 0 },
                        grid: { color: gridColor }
                    },
                    x: {
                        ticks: { color: tickColor, font: { size: 10 } },
                        grid: { display: false }
                    }
                }
            }
        });

        // Doughnut Chart - Showroom Cars Status
        const ctxDoughnut = document.getElementById('carStatusDoughnut').getContext('2d');
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Available', 'Reserved', 'Sold Out'],
                datasets: [{
                    data: [
                        {{ $carStats['available'] }},
                        {{ $carStats['reserved'] }},
                        {{ $carStats['sold'] }}
                    ],
                    backgroundColor: ['#4ade80', '#fbbf24', '#f87171'],
                    borderWidth: 2,
                    borderColor: doughnutBorder
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: legendColor, font: { size: 11 } }
                    }
                }
            }
        });
    });
</script>
@endsection
