<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir - Agam Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #1e40af;
            --light-blue: #eff6ff;
            --dark-blue: #1e3a8a;
        }
        
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            box-shadow: 0 2px 10px rgba(37, 99, 235, 0.2);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
        }
        
        .main-container {
            padding: 20px 0;
        }
        
        .search-section {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .search-input {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 45px 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .search-btn {
            background: var(--primary-blue);
            border: none;
            border-radius: 0 10px 10px 0;
            padding: 12px 15px;
            color: white;
            transition: all 0.3s ease;
        }
        
        .search-btn:hover {
            background: var(--secondary-blue);
        }
        
        .products-section {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .product-card {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            background: white;
        }
        
        .product-card:hover {
            border-color: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.1);
        }
        
        .product-card.selected {
            border-color: var(--primary-blue);
            background: var(--light-blue);
        }
        
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            background: #f3f4f6;
        }
        
        .product-name {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
        }
        
        .product-price {
            color: var(--primary-blue);
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .product-stock {
            color: #10b981;
            font-size: 0.9rem;
        }
        
        .cart-section {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 20px;
        }
        
        .cart-item {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 0;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .qty-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .qty-btn {
            background: var(--primary-blue);
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .qty-btn:hover {
            background: var(--secondary-blue);
        }
        
        .qty-input {
            width: 60px;
            text-align: center;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 5px;
        }
        
        .total-section {
            background: var(--light-blue);
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
        }
        
        .total-amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--dark-blue);
        }
        
        .payment-input {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
        
        .payment-input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .btn-process {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-process:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
            color: white;
        }
        
        .btn-clear {
            background: #ef4444;
            border: none;
            border-radius: 10px;
            padding: 8px 15px;
            color: white;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .btn-clear:hover {
            background: #dc2626;
            color: white;
        }
        
        .kembalian-display {
            background: #dcfce7;
            border: 2px solid #10b981;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
            display: none;
        }
        
        .kembalian-amount {
            font-size: 1.2rem;
            font-weight: bold;
            color: #047857;
        }
        
        @media (max-width: 768px) {
            .main-container {
                padding: 10px;
            }
            
            .product-card {
                margin-bottom: 10px;
            }
            
            .cart-section {
                position: relative;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-store me-2"></i>Agam Store - Kasir
            </a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    <i class="fas fa-user me-1"></i>{{ session('username') }}
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container main-container">
        <div class="row">
            <!-- Produk Section -->
            <div class="col-lg-8">
                <!-- Search Section -->
                <div class="search-section">
                    <h5 class="mb-3">
                        <i class="fas fa-search me-2 text-primary"></i>Cari Produk
                    </h5>
                    <form method="GET" action="{{ route('kasir.index') }}">
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control search-input" 
                                   name="search" 
                                   placeholder="Cari nama produk atau deskripsi..."
                                   value="{{ $search }}">
                            <button class="btn search-btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Products Section -->
                <div class="products-section">
                    <h5 class="mb-3">
                        <i class="fas fa-box me-2 text-primary"></i>Daftar Produk
                        @if($search)
                            <small class="text-muted">(Hasil pencarian: "{{ $search }}")</small>
                        @endif
                    </h5>
                    
                    @if(count($produk) > 0)
                        <div class="row">
                            @foreach($produk as $item)
                                <div class="col-md-6 col-lg-4">
                                    <div class="product-card" data-product-id="{{ $item->id }}" 
                                         data-product-name="{{ $item->nama_produk }}"
                                         data-product-price="{{ $item->harga }}"
                                         data-product-stock="{{ $item->stok }}">
                                        <div class="d-flex align-items-start">
                                            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('img/produk1.jpg') }}" 
                                                 alt="{{ $item->nama_produk }}" 
                                                 class="product-img me-3">
                                            <div class="flex-grow-1">
                                                <div class="product-name">{{ $item->nama_produk }}</div>
                                                <div class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                                                <div class="product-stock">
                                                    <i class="fas fa-box me-1"></i>Stok: {{ $item->stok }}
                                                </div>
                                                <small class="text-muted">{{ $item->deskripsi }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-box-open fa-3x mb-3"></i>
                            <p>{{ $search ? 'Tidak ada produk yang ditemukan' : 'Belum ada produk tersedia' }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Cart Section -->
            <div class="col-lg-4">
                <div class="cart-section">
                    <h5 class="mb-3">
                        <i class="fas fa-shopping-cart me-2 text-primary"></i>Keranjang Belanja
                    </h5>
                    
                    <div id="cart-items">
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-cart-plus fa-2x mb-2"></i>
                            <p>Pilih produk untuk memulai transaksi</p>
                        </div>
                    </div>

                    <div class="total-section">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Total:</span>
                            <span class="total-amount" id="total-amount">Rp 0</span>
                        </div>
                    </div>

                    <div class="payment-section">
                        <label class="form-label fw-bold">Uang Pembeli:</label>
                        <input type="number" class="form-control payment-input" id="payment-amount" 
                               placeholder="Masukkan jumlah uang pembeli">
                        
                        <div class="kembalian-display" id="kembalian-display">
                            <div class="kembalian-amount" id="kembalian-amount"></div>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn btn-process" id="btn-process" disabled>
                                <i class="fas fa-cash-register me-2"></i>Selesai Transaksi
                            </button>
                            <button type="button" class="btn btn-clear" id="btn-clear">
                                <i class="fas fa-trash me-2"></i>Bersihkan Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-check-circle me-2"></i>Transaksi Berhasil
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-receipt fa-3x text-success mb-3"></i>
                        <h6>Detail Transaksi:</h6>
                    </div>
                    <div class="row">
                        <div class="col-6 text-end"><strong>Total Harga:</strong></div>
                        <div class="col-6 text-start" id="modal-total"></div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-end"><strong>Uang Bayar:</strong></div>
                        <div class="col-6 text-start" id="modal-bayar"></div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-end"><strong>Kembalian:</strong></div>
                        <div class="col-6 text-start text-success fw-bold" id="modal-kembalian"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                        <i class="fas fa-check me-2"></i>OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cart = [];
            let totalAmount = 0;

            // Setup CSRF token for AJAX requests
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Product card click handler
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', function() {
                    const productId = this.dataset.productId;
                    const productName = this.dataset.productName;
                    const productPrice = parseInt(this.dataset.productPrice);
                    const productStock = parseInt(this.dataset.productStock);

                    addToCart(productId, productName, productPrice, productStock);
                });
            });

            // Add to cart function
            function addToCart(productId, productName, productPrice, productStock) {
                const existingItem = cart.find(item => item.productId === productId);

                if (existingItem) {
                    if (existingItem.quantity < productStock) {
                        existingItem.quantity++;
                        existingItem.subtotal = existingItem.quantity * productPrice;
                    } else {
                        alert('Stok tidak mencukupi!');
                        return;
                    }
                } else {
                    cart.push({
                        productId: productId,
                        productName: productName,
                        productPrice: productPrice,
                        productStock: productStock,
                        quantity: 1,
                        subtotal: productPrice
                    });
                }

                updateCartDisplay();
                updateTotal();
            }

            // Update cart display
            function updateCartDisplay() {
                const cartContainer = document.getElementById('cart-items');
                
                if (cart.length === 0) {
                    cartContainer.innerHTML = `
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-cart-plus fa-2x mb-2"></i>
                            <p>Pilih produk untuk memulai transaksi</p>
                        </div>
                    `;
                    return;
                }

                let html = '';
                cart.forEach((item, index) => {
                    html += `
                        <div class="cart-item">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="flex-grow-1">
                                    <div class="fw-bold">${item.productName}</div>
                                    <div class="text-primary">Rp ${item.productPrice.toLocaleString('id-ID')}</div>
                                </div>
                                <button class="btn btn-sm btn-outline-danger remove-item" data-index="${index}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="qty-control">
                                <button class="qty-btn decrease-qty" data-index="${index}">-</button>
                                <input type="number" class="qty-input" value="${item.quantity}" 
                                       min="1" max="${item.productStock}" data-index="${index}">
                                <button class="qty-btn increase-qty" data-index="${index}">+</button>
                                <div class="ms-auto fw-bold">
                                    Rp ${item.subtotal.toLocaleString('id-ID')}
                                </div>
                            </div>
                        </div>
                    `;
                });

                cartContainer.innerHTML = html;

                // Add event listeners for cart controls
                addCartEventListeners();
            }

            // Add event listeners for cart controls
            function addCartEventListeners() {
                // Remove item
                document.querySelectorAll('.remove-item').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = parseInt(this.dataset.index);
                        cart.splice(index, 1);
                        updateCartDisplay();
                        updateTotal();
                    });
                });

                // Increase quantity
                document.querySelectorAll('.increase-qty').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = parseInt(this.dataset.index);
                        if (cart[index].quantity < cart[index].productStock) {
                            cart[index].quantity++;
                            cart[index].subtotal = cart[index].quantity * cart[index].productPrice;
                            updateCartDisplay();
                            updateTotal();
                        } else {
                            alert('Stok tidak mencukupi!');
                        }
                    });
                });

                // Decrease quantity
                document.querySelectorAll('.decrease-qty').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = parseInt(this.dataset.index);
                        if (cart[index].quantity > 1) {
                            cart[index].quantity--;
                            cart[index].subtotal = cart[index].quantity * cart[index].productPrice;
                            updateCartDisplay();
                            updateTotal();
                        }
                    });
                });

                // Manual quantity input
                document.querySelectorAll('.qty-input').forEach(input => {
                    input.addEventListener('change', function() {
                        const index = parseInt(this.dataset.index);
                        const newQty = parseInt(this.value);
                        
                        if (newQty >= 1 && newQty <= cart[index].productStock) {
                            cart[index].quantity = newQty;
                            cart[index].subtotal = cart[index].quantity * cart[index].productPrice;
                            updateCartDisplay();
                            updateTotal();
                        } else {
                            this.value = cart[index].quantity;
                            if (newQty > cart[index].productStock) {
                                alert('Stok tidak mencukupi!');
                            }
                        }
                    });
                });
            }

            // Update total amount
            function updateTotal() {
                totalAmount = cart.reduce((total, item) => total + item.subtotal, 0);
                document.getElementById('total-amount').textContent = `Rp ${totalAmount.toLocaleString('id-ID')}`;
                
                // Enable/disable process button
                const processBtn = document.getElementById('btn-process');
                processBtn.disabled = cart.length === 0;
            }

            // Payment amount input handler
            document.getElementById('payment-amount').addEventListener('input', function() {
                const paymentAmount = parseFloat(this.value) || 0;
                const kembalianDisplay = document.getElementById('kembalian-display');
                const kembalianAmount = document.getElementById('kembalian-amount');

                if (paymentAmount >= totalAmount && totalAmount > 0) {
                    const kembalian = paymentAmount - totalAmount;
                    kembalianAmount.textContent = `Kembalian: Rp ${kembalian.toLocaleString('id-ID')}`;
                    kembalianDisplay.style.display = 'block';
                } else {
                    kembalianDisplay.style.display = 'none';
                }
            });

            // Clear cart button
            document.getElementById('btn-clear').addEventListener('click', function() {
                if (confirm('Yakin ingin membersihkan keranjang?')) {
                    cart = [];
                    totalAmount = 0;
                    updateCartDisplay();
                    updateTotal();
                    document.getElementById('payment-amount').value = '';
                    document.getElementById('kembalian-display').style.display = 'none';
                }
            });

           document.getElementById('btn-process').addEventListener('click', function() {
    const paymentAmount = parseFloat(document.getElementById('payment-amount').value) || 0;

    if (cart.length === 0) {
        alert('Keranjang masih kosong!');
        return;
    }

    if (paymentAmount < totalAmount) {
        alert('Uang pembeli kurang dari total harga!');
        return;
    }

    // Show loading state
    const processBtn = this;
    const originalText = processBtn.innerHTML;
    processBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
    processBtn.disabled = true;

    // Prepare transaction data
    const transactionData = {
        items: cart.map(item => ({
            produk_id: item.productId,
            jumlah: item.quantity
        })),
        bayar: paymentAmount
    };

    // Send AJAX request
    fetch('{{ route("kasir.transaksi") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(transactionData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update modal content
            document.getElementById('modal-total').textContent = `Rp ${data.data.total_harga.toLocaleString('id-ID')}`;
            document.getElementById('modal-bayar').textContent = `Rp ${data.data.bayar.toLocaleString('id-ID')}`;
            document.getElementById('modal-kembalian').textContent = `Rp ${data.data.kembalian.toLocaleString('id-ID')}`;
            
            // Add invoice number to modal
            const modalHeader = document.querySelector('#successModal .modal-title');
            modalHeader.innerHTML = `<i class="fas fa-check-circle me-2"></i>Transaksi Berhasil - ${data.data.invoice_number}`;
            
            // Add download button to modal
            const modalFooter = document.querySelector('#successModal .modal-footer');
            modalFooter.innerHTML = `
                <a href="/kasir/download-invoice/${data.data.invoice_number}" 
                   class="btn btn-primary" 
                   download>
                    <i class="fas fa-download me-2"></i>Download Invoice
                </a>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                    <i class="fas fa-check me-2"></i>OK
                </button>
            `;

            // Show success modal
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            // Auto download PDF
            if (data.data.pdf_url) {
                setTimeout(() => {
                    const link = document.createElement('a');
                    link.href = data.data.pdf_url;
                    link.download = `Invoice_${data.data.invoice_number}.pdf`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }, 1000);
            }

            // Clear cart
            cart = [];
            totalAmount = 0;
            updateCartDisplay();
            updateTotal();
            document.getElementById('payment-amount').value = '';
            document.getElementById('kembalian-display').style.display = 'none';

            // Reload page after modal is closed to update stock
            document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
                location.reload();
            });
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses transaksi');
    })
    .finally(() => {
        // Reset button state
        processBtn.innerHTML = originalText;
        processBtn.disabled = false;
    });
});
        });
    </script>
</body>
</html>