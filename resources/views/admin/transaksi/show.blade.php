@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-white/20">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-2">
                        <a href="{{ route('admin.transaksi.index') }}" class="inline-flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                        <div class="text-gray-300">|</div>
                        <h1 class="text-3xl font-bold text-gray-800">Detail Transaksi #{{ $transaksi->id }}</h1>
                    </div>
                    <p class="text-gray-600">Informasi lengkap transaksi di Agam Store</p>
                </div>
                <div class="text-right">
                    <div class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Selesai
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Transaction Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Transaction Info -->
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-white/20">
                <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Informasi Transaksi
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</label>
                            <p class="mt-1 text-lg font-semibold text-gray-900">#{{ $transaksi->id }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</label>
                            <p class="mt-1 text-lg font-medium text-gray-900">{{ $transaksi->created_at->format('d F Y') }}</p>
                            <p class="text-sm text-gray-500">{{ $transaksi->created_at->format('H:i:s') }} WIB</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500 uppercase tracking-wider">Status</label>
                            <div class="mt-1">
                                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Transaksi Selesai
                                </span>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500 uppercase tracking-wider">Metode Pembayaran</label>
                            <p class="mt-1 text-lg font-medium text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Tunai
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-white/20">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Detail Produk
                </h3>
                
                <div class="bg-gray-50/50 rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $transaksi->produk->nama_produk }}</h4>
                            <p class="text-sm text-gray-600 mt-1">Harga per item: Rp {{ number_format($transaksi->produk->harga, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <div class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-2">
                                {{ $transaksi->jumlah }} pcs
                            </div>
                            <p class="text-lg font-bold text-gray-900">Rp {{ number_format($transaksi->produk->harga * $transaksi->jumlah, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Cashier Info -->
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-white/20">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Kasir
                </h3>
                
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center">
                            <span class="text-sm font-medium text-white">{{ substr($transaksi->user->name, 0, 2) }}</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $transaksi->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $transaksi->user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Summary -->
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-white/20">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    Ringkasan Pembayaran
                </h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-sm text-gray-600">Subtotal</span>
                        <span class="text-sm font-medium text-gray-900">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-base font-medium text-gray-900">Total</span>
                        <span class="text-lg font-bold text-green-600">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-sm text-gray-600">Dibayar</span>
                        <span class="text-sm font-medium text-gray-900">Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm text-gray-600">Kembalian</span>
                        <span class="text-sm font-bold text-orange-600">Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-white/20">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
                
                <div class="space-y-3">
                    <button onclick="cetakStruk()" class="w-full flex items-center justify-center px-4 py-3 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg text-sm font-medium transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak Struk
                    </button>
                    
                    <a href="{{ route('admin.transaksi.index') }}" class="w-full flex items-center justify-center px-4 py-3 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-lg text-sm font-medium transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Lihat Semua Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    
    #struk-print, #struk-print * {
        visibility: visible;
    }
    
    #struk-print {
        position: absolute;
        left: 0;
        top: 0;
        width: 58mm; /* Lebar kertas struk thermal */
        font-size: 10px;
        font-family: 'Courier New', monospace;
        background: white;
        color: black;
        margin: 0;
        padding: 0;
    }
    
    @page {
        size: 58mm auto;
        margin: 0;
    }
}

#struk-print {
    display: none;
}
</style>

<!-- Hidden Print Area -->
<div id="struk-print" class="print-content">
    <div style="text-align: center; margin-bottom: 10px;">
        <h3 style="margin: 0; font-size: 14px; font-weight: bold;">AGAM STORE</h3>
        <p style="margin: 2px 0; font-size: 10px;">Jl. Contoh No. 123</p>
        <p style="margin: 2px 0; font-size: 10px;">Telp: 08123456789</p>
        <p style="margin: 5px 0; font-size: 10px;">================================</p>
    </div>
    
    <div style="margin-bottom: 10px;">
        <table style="width: 100%; font-size: 10px;">
            <tr>
                <td>No. Transaksi</td>
                <td>: #{{ $transaksi->id }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td>: {{ $transaksi->user->name }}</td>
            </tr>
        </table>
    </div>
    
    <p style="margin: 5px 0; font-size: 10px;">================================</p>
    
    <div style="margin-bottom: 10px;">
        <table style="width: 100%; font-size: 10px;">
            <tr>
                <td colspan="3" style="font-weight: bold;">{{ $transaksi->produk->nama_produk }}</td>
            </tr>
            <tr>
                <td>{{ $transaksi->jumlah }} pcs</td>
                <td>@</td>
                <td style="text-align: right;">{{ number_format($transaksi->produk->harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2">Subtotal:</td>
                <td style="text-align: right; font-weight: bold;">{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
    
    <p style="margin: 5px 0; font-size: 10px;">================================</p>
    
    <div style="margin-bottom: 10px;">
        <table style="width: 100%; font-size: 11px; font-weight: bold;">
            <tr>
                <td>TOTAL:</td>
                <td style="text-align: right;">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>BAYAR:</td>
                <td style="text-align: right;">Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>KEMBALI:</td>
                <td style="text-align: right;">Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
    
    <p style="margin: 5px 0; font-size: 10px;">================================</p>
    
    <div style="text-align: center; margin-top: 10px;">
        <p style="margin: 2px 0; font-size: 10px;">Terima Kasih</p>
        <p style="margin: 2px 0; font-size: 10px;">Atas Kunjungan Anda</p>
        <p style="margin: 5px 0; font-size: 9px;">{{ $transaksi->created_at->format('d/m/Y H:i:s') }}</p>
    </div>
</div>

<script>
// Function untuk mencetak struk
function cetakStruk() {
    // Tampilkan area struk untuk print
    const strukArea = document.getElementById('struk-print');
    strukArea.style.display = 'block';
    
    // Tunggu sebentar untuk memastikan elemen sudah tampil
    setTimeout(() => {
        window.print();
        
        // Sembunyikan kembali area struk setelah print
        setTimeout(() => {
            strukArea.style.display = 'none';
        }, 1000);
    }, 100);
}

// Add smooth animations on page load
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.bg-white\\/70');
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.6s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// Handle print event untuk memastikan format yang benar
window.addEventListener('beforeprint', function() {
    document.getElementById('struk-print').style.display = 'block';
});

window.addEventListener('afterprint', function() {
    document.getElementById('struk-print').style.display = 'none';
});
</script>

@endsection