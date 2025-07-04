<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $invoice_number }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
        }
        
        .store-name {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 5px;
        }
        
        .store-tagline {
            color: #666;
            font-size: 12px;
        }
        
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .invoice-details, .transaction-details {
            flex: 1;
        }
        
        .invoice-details h3, .transaction-details h3 {
            color: #2563eb;
            font-size: 14px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        
        .detail-row {
            margin-bottom: 5px;
        }
        
        .detail-label {
            font-weight: bold;
            display: inline-block;
            width: 100px;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .items-table th,
        .items-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .items-table th {
            background-color: #f8fafc;
            font-weight: bold;
            color: #2563eb;
        }
        
        .items-table tr:hover {
            background-color: #f9fafb;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .total-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 8px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .total-label {
            font-weight: bold;
        }
        
        .total-amount {
            font-weight: bold;
            color: #2563eb;
        }
        
        .grand-total {
            font-size: 16px;
            border-top: 2px solid #2563eb;
            padding-top: 10px;
            margin-top: 10px;
        }
        
        .grand-total .total-amount {
            font-size: 18px;
            color: #1e40af;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 11px;
        }
        
        .thank-you {
            margin-top: 30px;
            text-align: center;
            padding: 15px;
            background-color: #eff6ff;
            border-radius: 8px;
        }
        
        .thank-you h3 {
            color: #2563eb;
            margin-bottom: 5px;
        }
        
        .currency {
            font-weight: bold;
        }
        
        .invoice-number {
            font-size: 16px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 10px;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 10px;
            }
            
            .invoice-header {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <div class="store-name">AGAM STORE</div>
        <div class="store-tagline">Toko Terpercaya Pilihan Keluarga</div>
    </div>

    <div class="invoice-info">
        <div class="invoice-details">
            <h3>Detail Invoice</h3>
            <div class="detail-row">
                <span class="detail-label">No. Invoice:</span>
                <span class="invoice-number">{{ $invoice_number }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal:</span>
                <span>{{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y H:i:s') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Kasir:</span>
                <span>{{ $kasir }}</span>
            </div>
        </div>
        
        <div class="transaction-details">
            <h3>Informasi Transaksi</h3>
            <div class="detail-row">
                <span class="detail-label">Jml Item:</span>
                <span>{{ $transaksis->count() }} item</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Qty:</span>
                <span>{{ $transaksis->sum('jumlah') }} pcs</span>
            </div>
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $index => $transaksi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $transaksi->produk->nama_produk }}</strong>
                    @if($transaksi->produk->deskripsi)
                        <br><small style="color: #666;">{{ $transaksi->produk->deskripsi }}</small>
                    @endif
                </td>
                <td class="text-center">{{ $transaksi->jumlah }}</td>
                <td class="text-right">
                    <span class="currency">Rp {{ number_format($transaksi->produk->harga, 0, ',', '.') }}</span>
                </td>
                <td class="text-right">
                    <span class="currency">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row">
            <span class="total-label">Total Harga:</span>
            <span class="total-amount currency">Rp {{ number_format($total_harga, 0, ',', '.') }}</span>
        </div>
        <div class="total-row">
            <span class="total-label">Uang Bayar:</span>
            <span class="total-amount currency">Rp {{ number_format($bayar, 0, ',', '.') }}</span>
        </div>
        <div class="total-row grand-total">
            <span class="total-label">Kembalian:</span>
            <span class="total-amount currency">Rp {{ number_format($kembalian, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="thank-you">
        <h3>Terima Kasih!</h3>
        <p>Atas kepercayaan Anda berbelanja di Agam Store</p>
        <p><strong>Barang yang sudah dibeli tidak dapat dikembalikan</strong></p>
    </div>

    <div class="footer">
        <p>Invoice ini dicetak secara otomatis pada {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        <p>Agam Store - Jl. Contoh No. 123, Bekasi | Telp: (021) 123-4567</p>
    </div>
</body>
</html>