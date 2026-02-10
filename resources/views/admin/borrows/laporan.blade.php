<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Data Peminjaman - PerpusDigi</title>
    <style>
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            color: #334155; 
            margin: 0; 
            padding: 0; 
        }
        .container { 
            padding: 40px; 
        }
        
        /* Header Style */
        .header { 
            border-bottom: 2px solid #2563eb; 
            padding-bottom: 20px; 
            margin-bottom: 30px; 
            text-align: center;
        }
        .brand { 
            color: #1e293b; 
            font-size: 32px; 
            font-weight: bold; 
        }
        .brand span { 
            color: #2563eb; 
        }
        .report-title {
            font-size: 18px;
            color: #64748b;
            margin-top: 10px;
        }
        .report-date {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 5px;
        }
        
        /* Table Style */
        .main-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        .main-table thead th { 
            background-color: #f8fafc; 
            border: 1px solid #e2e8f0; 
            padding: 12px 8px; 
            text-align: left; 
            font-size: 11px; 
            color: #1e293b;
            font-weight: bold;
        }
        .main-table tbody td { 
            padding: 10px 8px; 
            border: 1px solid #f1f5f9; 
            font-size: 10px;
            vertical-align: top;
        }
        
        /* Badge */
        .badge { 
            padding: 3px 8px; 
            border-radius: 10px; 
            font-size: 9px; 
            font-weight: bold;
            display: inline-block;
        }
        .badge-dipinjam { 
            background: #fef3c7; 
            color: #92400e; 
        }
        .badge-dikembalikan { 
            background: #d1fae5; 
            color: #065f46; 
        }
        
        /* Footer */
        .footer { 
            margin-top: 40px; 
            text-align: center; 
            border-top: 1px solid #f1f5f9; 
            padding-top: 20px; 
        }
        .footer p { 
            font-size: 11px; 
            color: #94a3b8; 
        }
        .location { 
            font-size: 10px; 
            color: #3b82f6; 
            margin-top: 5px; 
        }
        
        /* Summary Box */
        .summary-box {
            background: #f8fafc;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .summary-item {
            display: inline-block;
            margin-right: 30px;
            font-size: 12px;
        }
        .summary-label {
            color: #64748b;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .summary-value {
            font-size: 18px;
            font-weight: bold;
            color: #1e293b;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="brand">Perpus<span>Digi</span></div>
            <div class="report-title">Laporan Data Peminjaman Buku</div>
            <div class="report-date">Dicetak pada: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d F Y, H:i') }} WIB</div>
        </div>

        <div class="summary-box">
            <div class="summary-item">
                <div class="summary-label">Total Peminjaman</div>
                <div class="summary-value">{{ $borrow->count() }}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Dipinjam</div>
                <div class="summary-value" style="color: #d97706;">{{ $borrow->where('status', 'dipinjam')->count() }}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Dikembalikan</div>
                <div class="summary-value" style="color: #059669;">{{ $borrow->where('status', 'dikembalikan')->count() }}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Total Denda</div>
                <div class="summary-value" style="color: #ef4444;">Rp {{ number_format($borrow->sum('denda'), 0, ',', '.') }}</div>
            </div>
        </div>

        <table class="main-table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Peminjam</th>
                    <th width="25%">Judul Buku</th>
                    <th width="10%">Kode Buku</th>
                    <th width="12%">Tgl Pinjam</th>
                    <th width="12%">Tgl Kembali</th>
                    <th width="8%">Status</th>
                    <th width="8%">Denda</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrow as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $item->user->name }}</strong><br>
                        <small style="color: #64748b;">{{ $item->user->email }}</small>
                    </td>
                    <td>
                        <strong>{{ $item->book->judul }}</strong><br>
                        <small style="color: #64748b;">{{ $item->book->penulis }} ({{ $item->book->tahun_terbit }})</small>
                    </td>
                    <td><code style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">{{ $item->book->code }}</code></td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>
                        @if($item->tanggal_dikembalikan)
                            {{ \Carbon\Carbon::parse($item->tanggal_dikembalikan)->format('d M Y') }}
                        @else
                            <span style="color: #ef4444; font-style: italic;">-</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $item->status }}">
                            {{ strtoupper($item->status) }}
                        </span>
                    </td>
                    <td style="text-align: right; color: #ef4444; font-weight: bold;">
                        {{ $item->denda > 0 ? 'Rp ' . number_format($item->denda, 0, ',', '.') : '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 30px; color: #94a3b8;">
                        Tidak ada data peminjaman
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <p>© {{ date('Y') }} PerpusDigi Indonesia - Akses Pengetahuan Tanpa Batas</p>
            <div class="location">Banda Aceh, Indonesia</div>
        </div>
    </div>
</body>
</html>