@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')
<!-- Alert Notification (letakkan di bagian atas view setelah header) -->
<!-- Jika menggunakan Tailwind CSS -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" onclick="this.parentElement.parentElement.remove()">
                <path d="M14.348 14.849c-.469.469-1.229.469-1.697 0L10 11.819l-2.651 3.029c-.469.469-1.229.469-1.697 0-.469-.469-.469-1.229 0-1.697l2.758-3.15-2.759-3.152c-.469-.469-.469-1.228 0-1.697.469-.469 1.228-.469 1.697 0L10 8.183l2.651-3.031c.469-.469 1.228-.469 1.697 0 .469.469.469 1.229 0 1.697l-2.758 3.152 2.758 3.15c.469.469.469 1.229 0 1.698z"/>
            </svg>
        </span>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Gagal!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" onclick="this.parentElement.parentElement.remove()">
                <path d="M14.348 14.849c-.469.469-1.229.469-1.697 0L10 11.819l-2.651 3.029c-.469.469-1.229.469-1.697 0-.469-.469-.469-1.229 0-1.697l2.758-3.15-2.759-3.152c-.469-.469-.469-1.228 0-1.697.469-.469 1.228-.469 1.697 0L10 8.183l2.651-3.031c.469-.469 1.228-.469 1.697 0 .469.469.469 1.229 0 1.697l-2.758 3.152 2.758 3.15c.469.469.469 1.229 0 1.698z"/>
            </svg>
        </span>
    </div>
@endif
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-white/20">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Kelola Produk</h1>
                    <p class="text-gray-600">Kelola semua produk di Agam Store</p>
                </div>
                <div class="flex space-x-3">
                    <button onclick="openAddModal()" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 flex items-center shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Produk
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="mb-6">
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-white/20">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="search" placeholder="Cari produk..." class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl leading-5 bg-white/50 backdrop-blur-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <select id="filter-stok" class="border border-gray-200 rounded-xl px-4 py-3 bg-white/50 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <option value="">Semua Stok</option>
                        <option value="tersedia">Stok Tersedia</option>
                        <option value="habis">Stok Habis</option>
                        <option value="menipis">Stok Menipis</option>
                    </select>
                    <button class="p-3 bg-white/50 backdrop-blur-sm border border-gray-200 rounded-xl hover:bg-white/70 transition-all duration-300">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="products-grid">
        @forelse($produk as $item)
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 hover:shadow-lg transition-all duration-300 group product-card" data-name="{{ strtolower($item->nama_produk) }}" data-stok="{{ $item->stok }}">
            <!-- Product Image -->
            <div class="relative overflow-hidden rounded-t-2xl">
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute top-3 right-3">
                    @if($item->stok <= 0)
                        <span class="bg-red-500 text-white px-2 py-1 rounded-lg text-xs font-medium">Habis</span>
                    @elseif($item->stok <= 10)
                        <span class="bg-amber-500 text-white px-2 py-1 rounded-lg text-xs font-medium">Menipis</span>
                    @else
                        <span class="bg-green-500 text-white px-2 py-1 rounded-lg text-xs font-medium">Tersedia</span>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="p-5">
                <h3 class="font-bold text-gray-800 text-lg mb-2 line-clamp-2">{{ $item->nama_produk }}</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $item->deskripsi }}</p>
                
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-xs text-gray-500">Harga</p>
                        <p class="text-xl font-bold text-blue-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">Stok</p>
                        <p class="text-lg font-semibold {{ $item->stok <= 0 ? 'text-red-500' : ($item->stok <= 10 ? 'text-amber-500' : 'text-green-500') }}">
                            {{ $item->stok }}
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-2">
                    <button onclick="viewProduct({{ $item->id }})" class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 text-center">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Detail
                    </button>
                    <button onclick="editProduct({{ $item->id }})" class="flex-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 text-center">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </button>
                    <button onclick="deleteProduct({{ $item->id }}, '{{ $item->nama_produk }}')" class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-12 shadow-sm border border-white/20 text-center">
                <div class="mx-auto w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Produk</h3>
                <p class="text-gray-600 mb-6">Mulai tambahkan produk pertama Anda untuk mulai berjualan</p>
                <button onclick="openAddModal()" class="inline-flex items-center bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Produk Pertama
                </button>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Add/Edit Product -->
<div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 id="modalTitle" class="text-2xl font-bold text-gray-800">Tambah Produk</h2>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form id="productForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="methodField"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Produk -->
                <div class="md:col-span-2">
                    <label for="nama_produk" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama produk" required>
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan deskripsi produk" required></textarea>
                </div>

                <!-- Harga -->
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                    <input type="number" id="harga" name="harga" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0" min="0" required>
                </div>

                <!-- Stok -->
                <div>
                    <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                    <input type="number" id="stok" name="stok" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0" min="0" required>
                </div>

                <!-- Gambar -->
                <div class="md:col-span-2">
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center">
                        <input type="file" id="gambar" name="gambar" accept="image/*" class="hidden" onchange="previewImage(this)">
                        <div id="imagePreview" class="mb-4 hidden">
                            <img id="preview" src="" alt="Preview" class="mx-auto max-h-40 rounded-lg">
                        </div>
                        <div id="uploadArea">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">
                                <button type="button" onclick="document.getElementById('gambar').click()" class="font-medium text-blue-600 hover:text-blue-500">Upload gambar</button>
                                atau drag and drop
                            </p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF maksimal 2MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <button type="button" onclick="closeModal()" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-xl font-medium transition-all duration-300">
                    <span id="submitText">Simpan Produk</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal View Product -->
<div id="viewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Detail Produk</h2>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <img id="viewImage" src="" alt="" class="w-full h-64 object-cover rounded-xl">
            </div>
            <div class="md:col-span-2">
                <h3 id="viewNama" class="text-xl font-bold text-gray-800 mb-2"></h3>
                <p id="viewDeskripsi" class="text-gray-600 mb-4"></p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Harga</p>
                <p id="viewHarga" class="text-2xl font-bold text-blue-600"></p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Stok</p>
                <p id="viewStok" class="text-2xl font-bold"></p>
            </div>
        </div>
    </div>
</div>

<script>
let currentProductId = null;
let isEditMode = false;

// Modal functions
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Produk';
    document.getElementById('submitText').textContent = 'Simpan Produk';
    document.getElementById('productForm').action = '{{ route("admin.produk.store") }}';
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('productForm').reset();
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('uploadArea').classList.remove('hidden');
    isEditMode = false;
    document.getElementById('productModal').classList.remove('hidden');
    document.getElementById('productModal').classList.add('flex');
}

function editProduct(id) {
    fetch(`/admin/produk/edit/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalTitle').textContent = 'Edit Produk';
            document.getElementById('submitText').textContent = 'Update Produk';
            document.getElementById('productForm').action = `/admin/produk/update/${id}`;
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            
            document.getElementById('nama_produk').value = data.nama_produk;
            document.getElementById('deskripsi').value = data.deskripsi;
            document.getElementById('harga').value = data.harga;
            document.getElementById('stok').value = data.stok;
            
            if (data.gambar) {
                document.getElementById('preview').src = `/storage/${data.gambar}`;
                document.getElementById('imagePreview').classList.remove('hidden');
                document.getElementById('uploadArea').classList.add('hidden');
            }
            
            isEditMode = true;
            currentProductId = id;
            document.getElementById('productModal').classList.remove('hidden');
            document.getElementById('productModal').classList.add('flex');
        })
        .catch(error => console.error('Error:', error));
}

function viewProduct(id) {
    fetch(`/admin/produk/show/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('viewImage').src = `/storage/${data.gambar}`;
            document.getElementById('viewNama').textContent = data.nama_produk;
            document.getElementById('viewDeskripsi').textContent = data.deskripsi;
            document.getElementById('viewHarga').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(data.harga)}`;
            document.getElementById('viewStok').textContent = data.stok;
            document.getElementById('viewStok').className = `text-2xl font-bold ${data.stok <= 0 ? 'text-red-500' : (data.stok <= 10 ? 'text-amber-500' : 'text-green-500')}`;
            
            document.getElementById('viewModal').classList.remove('hidden');
            document.getElementById('viewModal').classList.add('flex');
        })
        .catch(error => console.error('Error:', error));
}

function deleteProduct(id, name) {
    if (confirm(`Apakah Anda yakin ingin menghapus produk "${name}"?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/produk/delete/${id}`;
        form.innerHTML = '@csrf';
        document.body.appendChild(form);
        form.submit();
    }
}

function closeModal() {
    document.getElementById('productModal').classList.add('hidden');
    document.getElementById('productModal').classList.remove('flex');
}

function closeViewModal() {
    document.getElementById('viewModal').classList.add('hidden');
    document.getElementById('viewModal').classList.remove('flex');
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
            document.getElementById('uploadArea').classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Search functionality
document.getElementById('search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const products = document.querySelectorAll('.product-card');
    
    products.forEach(product => {
        const productName = product.getAttribute('data-name');
        if (productName.includes(searchTerm)) {
            product.style.display = 'block';
            product.style.opacity = '1';
            product.style.transform = 'translateY(0)';
        } else {
            product.style.opacity = '0';
            product.style.transform = 'translateY(10px)';
            setTimeout(() => {
                if (!productName.includes(searchTerm)) {
                    product.style.display = 'none';
                }
            }, 300);
        }
    });
});

// Filter functionality
document.getElementById('filter-stok').addEventListener('change', function() {
    const filterValue = this.value;
    const products = document.querySelectorAll('.product-card');
    
    products.forEach(product => {
        const stok = parseInt(product.getAttribute('data-stok'));
        let show = true;
        
        switch(filterValue) {
            case 'tersedia':
                show = stok > 10;
                break;
            case 'habis':
                show = stok <= 0;
                break;
            case 'menipis':
                show = stok > 0 && stok <= 10;
                break;
            default:
                show = true;
        }
        
        if (show) {
            product.style.display = 'block';
            product.style.opacity = '1';
            product.style.transform = 'translateY(0)';
        } else {
            product.style.opacity = '0';
            product.style.transform = 'translateY(10px)';
            setTimeout(() => {
                if (!show) {
                    product.style.display = 'none';
                }
            }, 300);
        }
    });
});

// Animate cards on load
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.product-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// Close modal when clicking outside
document.getElementById('productModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

document.getElementById('viewModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeViewModal();
    }
});
</script>

@if(session('success'))
<script>
    // Show success notification
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300';
    notification.textContent = '{{ session("success") }}';
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
</script>
@endif

<style>
.line-clamp-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
}
</style>
@endsection