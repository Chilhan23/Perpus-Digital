<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice {{ $borrow->id }} - PerpusDigi</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #334155; margin: 0; padding: 0; }
        .container { padding: 40px; }
        
        /* Header Style */
        .header { border-bottom: 2px solid #2563eb; padding-bottom: 20px; margin-bottom: 30px; }
        .brand { color: #1e293b; font-size: 28px; font-weight: bold; }
        .brand span { color: #2563eb; }
        .invoice-info { float: right; text-align: right; font-size: 12px; color: #64748b; margin-top: -40px; }
        
        /* Details */
        .details { margin-bottom: 40px; }
        .details-table { width: 100%; border-collapse: collapse; }
        .details-table td { vertical-align: top; }
        .section-title { font-size: 10px; text-transform: uppercase; font-weight: bold; color: #3b82f6; letter-spacing: 1px; margin-bottom: 5px; }
        
        /* Table Style */
        .main-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .main-table thead th { background-color: #f8fafc; border-bottom: 2px solid #e2e8f0; padding: 12px 10px; text-align: left; font-size: 12px; color: #1e293b; }
        .main-table tbody td { padding: 15px 10px; border-bottom: 1px solid #f1f5f9; font-size: 13px; }
        
        /* Badge */
        .badge { background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: bold; }
        
        /* Footer */
        .footer { margin-top: 50px; text-align: center; border-top: 1px solid #f1f5f9; padding-top: 20px; }
        .footer p { font-size: 11px; color: #94a3b8; }
        .location { font-size: 10px; color: #3b82f6; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="brand">Perpus<span>Digi</span></div>
            <div class="invoice-info">
                <strong>INVOICE #{{ $borrow->id }}</strong><br>
                Tanggal Pinjam: {{ $borrow->tanggal_pinjam }}<br>
                Status: <span class="badge">{{ strtoupper($borrow->status) }}</span>
            </div>
        </div>

        <div class="details">
            <table class="details-table">
                <tr>
                    <td width="50%">
                        <div class="section-title">Peminjam</div>
                        <strong>{{ $borrow->user->name }}</strong><br>
                        {{ $borrow->user->email }}<br>
                        Username: {{ $borrow->user->username }}
                    </td>
                    <td width="50%" style="text-align: right;">
                        <div class="section-title">Lokasi Perpustakaan</div>
                        <strong>PerpusDigi Banda Aceh</strong><br>
                        Jl. Stadion H. Dimurthala No. 5, Kota Baru, Kecamatan Kuta Alam, Kota Banda Aceh, Aceh<br>
                        Indonesia
                    </td>
                </tr>
            </table>
        </div>

        <table class="main-table">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="50%">Judul Buku</th>
                    <th width="20%">Kode Buku</th>
                    <th width="20%">Dikembalikan Tanggal</th>
                    <th width="20%">{{ $borrow->denda ? 'Jumlah Denda' : '' }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $borrow->id }}</td>
                    <td>
                        <strong>{{ $borrow->book->judul }}</strong><br>
                        <small style="color: #64748b">Penulis: {{ $borrow->book->penulis }}</small>
                    </td>
                    <td><code>{{ $borrow->book->code }}</code></td>
                    <td style="color: #2563eb; font-weight: bold;">
                        @if($borrow->tanggal_dikembalikan)
                            {{ $borrow->tanggal_dikembalikan->format('d M Y') }}
                        @else
                            <span style="color: #ef4444;">Belum Dikembalikan</span>
                        @endif
                    </td>

                    <td style="color: #ef4444; font-weight: bold;">
                        {{ $borrow->denda > 0 ? 'Rp ' . number_format($borrow->denda, 0, ',', '.') : '-' }}
                    </td>
                </tr>
            </tbody>
        </table>

        @if($borrow->catatan)
        <div style="margin-top: 30px; padding: 15px; background: #f8fafc; border-radius: 8px; font-size: 12px;">
            <div class="section-title">Catatan:</div>
            {{ $borrow->catatan }}
        </div>
        @endif

        <div class="footer">
            <p>© {{ date('Y') }} PerpusDigi Indonesia - Akses Pengetahuan Tanpa Batas</p>
            <div class="location">Banda Aceh, Indonesia</div>
        </div>
    </div>
</body>
</html>