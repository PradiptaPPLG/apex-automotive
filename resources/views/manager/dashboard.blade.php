@extends('manager.layout')

@section('title', 'Dashboard & Analytics Manager')
@section('page_header', 'Dashboard Exec & Monitoring Penjualan')

@section('content')
<div style="display: flex; flex-direction: column; gap: 28px;">
    <!-- Metric Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
        <div class="card-panel" style="border-left: 4px solid #ef4444;">
            <div style="font-family: 'Space Mono', monospace; font-size: 10px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 8px;">
                TOTAL UNIT MOBIL SHOWROOM
            </div>
            <div style="font-size: 1.8rem; font-weight: 800; color: #ffffff; font-family: 'Playfair Display', serif;">
                {{ $totalCars }} <span style="font-size: 12px; color: #9ca3af; font-family: 'Inter', sans-serif; font-weight: 400;">Unit</span>
            </div>
        </div>

        <div class="card-panel" style="border-left: 4px solid #eab308;">
            <div style="font-family: 'Space Mono', monospace; font-size: 10px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 8px;">
                ANGGOTA SALES RM
            </div>
            <div style="font-size: 1.8rem; font-weight: 800; color: #ffffff; font-family: 'Playfair Display', serif;">
                {{ $totalRm }} <span style="font-size: 12px; color: #9ca3af; font-family: 'Inter', sans-serif; font-weight: 400;">Personel</span>
            </div>
        </div>

        <div class="card-panel" style="border-left: 4px solid #22d3ee;">
            <div style="font-family: 'Space Mono', monospace; font-size: 10px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 8px;">
                DELIVERY DRIVERS
            </div>
            <div style="font-size: 1.8rem; font-weight: 800; color: #ffffff; font-family: 'Playfair Display', serif;">
                {{ $totalDelivery }} <span style="font-size: 12px; color: #9ca3af; font-family: 'Inter', sans-serif; font-weight: 400;">Personel</span>
            </div>
        </div>

        <div class="card-panel" style="border-left: 4px solid #10b981;">
            <div style="font-family: 'Space Mono', monospace; font-size: 10px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 8px;">
                TOTAL PERMINTAAN INQUIRY
            </div>
            <div style="font-size: 1.8rem; font-weight: 800; color: #ffffff; font-family: 'Playfair Display', serif;">
                {{ $totalInquiries }} <span style="font-size: 12px; color: #9ca3af; font-family: 'Inter', sans-serif; font-weight: 400;">Inquiries</span>
            </div>
        </div>
    </div>

    <!-- Grafik Breakdown Status & Inquiries Terbaru -->
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px;">
        <!-- Distribution Chart Card -->
        <div class="card-panel" style="display: flex; flex-direction: column; gap: 20px;">
            <div>
                <h3 style="font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; color: #fff;">Status Pipeline Transaksi</h3>
                <p style="font-size: 12px; color: #9ca3af; margin-top: 4px;">Distribusi tahap konsultasi & penjualan VIP</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 6px;">
                        <span style="color: #fbbf24; font-family: 'Space Mono', monospace;">PENDING / BARU</span>
                        <strong style="color: #fff;">{{ $inquiryStats['pending'] }}</strong>
                    </div>
                    <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.06); border-radius: 4px; overflow: hidden;">
                        <div style="width: {{ $totalInquiries > 0 ? ($inquiryStats['pending'] / $totalInquiries * 100) : 0 }}%; height: 100%; background: #fbbf24;"></div>
                    </div>
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 6px;">
                        <span style="color: #60a5fa; font-family: 'Space Mono', monospace;">APPROVED / DISUPPORT RM</span>
                        <strong style="color: #fff;">{{ $inquiryStats['approved'] }}</strong>
                    </div>
                    <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.06); border-radius: 4px; overflow: hidden;">
                        <div style="width: {{ $totalInquiries > 0 ? ($inquiryStats['approved'] / $totalInquiries * 100) : 0 }}%; height: 100%; background: #60a5fa;"></div>
                    </div>
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 6px;">
                        <span style="color: #4ade80; font-family: 'Space Mono', monospace;">PAYMENT VERIFIED / SUKSES</span>
                        <strong style="color: #fff;">{{ $inquiryStats['payment_verified'] }}</strong>
                    </div>
                    <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.06); border-radius: 4px; overflow: hidden;">
                        <div style="width: {{ $totalInquiries > 0 ? ($inquiryStats['payment_verified'] / $totalInquiries * 100) : 0 }}%; height: 100%; background: #4ade80;"></div>
                    </div>
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 6px;">
                        <span style="color: #f87171; font-family: 'Space Mono', monospace;">REJECTED / BATAL</span>
                        <strong style="color: #fff;">{{ $inquiryStats['rejected'] }}</strong>
                    </div>
                    <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.06); border-radius: 4px; overflow: hidden;">
                        <div style="width: {{ $totalInquiries > 0 ? ($inquiryStats['rejected'] / $totalInquiries * 100) : 0 }}%; height: 100%; background: #f87171;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Inquiries Table -->
        <div class="card-panel">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
                <div>
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; color: #fff;">Inquiry Transaksi Terbaru</h3>
                    <p style="font-size: 12px; color: #9ca3af; margin-top: 4px;">Permintaan konsultasi terkini dari buyer</p>
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #9ca3af; font-family: 'Space Mono', monospace; font-size: 11px;">
                            <th style="padding: 10px;">ID & PEMBELI</th>
                            <th style="padding: 10px;">UNIT MOBIL</th>
                            <th style="padding: 10px;">SALES RM</th>
                            <th style="padding: 10px;">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentInquiries as $inquiry)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); color: #d1d5db;">
                                <td style="padding: 12px 10px;">
                                    <div style="font-weight: 600; color: #fff;">{{ $inquiry->name }}</div>
                                    <div style="font-size: 11px; font-family: 'Space Mono', monospace; color: #ef4444;">#APX-{{ str_pad($inquiry->id, 5, '0', STR_PAD_LEFT) }}</div>
                                </td>
                                <td style="padding: 12px 10px;">{{ $inquiry->car_model }}</td>
                                <td style="padding: 12px 10px;">{{ $inquiry->assigned_rm_name ?? 'Belum Diassigned' }}</td>
                                <td style="padding: 12px 10px;">
                                    <span style="font-family: 'Space Mono', monospace; font-size: 10px; padding: 4px 8px; border-radius: 2px; text-transform: uppercase; font-weight: 700;" class="{{ $inquiry->statusColor() }}">
                                        {{ $inquiry->statusLabel() }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 24px; text-align: center; color: #6b7280;">Belum ada inquiry transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
