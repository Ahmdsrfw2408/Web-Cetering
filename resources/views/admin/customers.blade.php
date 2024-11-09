<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF Token -->
    <title>Warung Ratu</title>
    <link rel="stylesheet" href="css/styles.css" />
    <script defer src="js/script.js"></script>
</head>
<body>
    <header class="navbar">
        <h1 class="logo">
            <a href="{{ route('admin.dashboard') }}">Warung Ratu</a></h1>
        <button class="menu-toggle" id="menu-toggle" aria-label="Toggle Menu">&#9776;</button>
        <ul class="nav-links" id="nav-links" role="navigation">
            <li><a href="#" data-target="home">Home</a></li>
            <li><a href="#" data-target="menu">Menu</a></li>
            <li><a href="#" data-target="about">About</a></li>
            <li><a href="#" data-target="contact">Contact</a></li>
        </ul>
        <button class="cart-btn" id="cart-btn" aria-label="Open Cart">
            <img src="img/cart.svg" alt="Keranjang" class="cart-icon" />
            <span id="cart-count">0</span>
        </button>
    </header>

    <main>
        <!-- Home Section -->
        <section id="home" class="section active">
            <div class="home-slider">
                <div class="slider">
                    <div class="slide active">
                        <img src="img/menu1.png" alt="Menu 1" />
                    </div>
                    <div class="slide">
                        <img src="img/menu2.png" alt="Menu 2" />
                    </div>
                </div>
                <div class="slider-controls">
                    <button id="prev-slide" class="prev" aria-label="Previous Slide">&#10094;</button>
                    <button id="next-slide" class="next" aria-label="Next Slide">&#10095;</button>
                </div>
            </div>
        </section>

        <!-- Menu Section -->
        <section id="menu" class="section">
            <h2>Menu Makanan</h2>
            <div class="menu-items">
                @forelse($products as $product)
                <div class="menu-item" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-jumlah="{{ $product->jumlah }}">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p>Stok: {{ $product->jumlah }}</p>
                    @if($product->jumlah > 0)
                        <button class="add-to-cart btn btn-primary">Tambah ke Keranjang</button>
                    @else
                        <button class="btn btn-secondary" disabled>Stok Habis</button>
                    @endif
                </div>
                @empty
                <p>Tidak ada produk tersedia.</p>
                @endforelse
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="section about-section">
            <h2>Tentang Kami</h2>
            <div class="about-content">
                <p>Warung Ratu menyediakan layanan catering berkualitas dengan berbagai masakan tradisional Indonesia.</p>
                <h3>Lokasi</h3>
                <p>Gg. Rahmat, Martapura, Kalimantan Selatan</p>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="section contact-section">
            <h2>Kontak Kami</h2>
            <div class="contact-content">
                <p>Email: support@foodieexpress.com | Telepon: +62 812 3456 7890</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Menu</h3>
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Informasi</h3>
                <ul>
                    <li><a href="#privacy">Kebijakan Privasi</a></li>
                    <li><a href="#terms">Syarat dan Ketentuan</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Kontak</h3>
                <p>Email: <a href="mailto:info@example.com">info@example.com</a></p>
                <p>Telepon: <a href="tel:+62123456789">+62 123 456 789</a></p>
                <p>Alamat: Jl. Contoh No. 123, Jakarta</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Nama Perusahaan. Semua hak dilindungi.</p>
        </div>
    </footer>

    <!-- Keranjang Modal -->
    <div id="cart-modal" class="cart-modal hidden" aria-hidden="true">
        <h2>Keranjang Belanja</h2>
        <ul id="cart-items"></ul>
        <p>Total: Rp <span id="cart-total">0</span></p>
        <button id="checkout-btn" class="btn btn-primary">Checkout</button>
        <button id="close-cart" class="btn btn-secondary">Tutup</button>
    </div>

    <!-- Overlay -->
    <div id="modal-overlay" class="hidden" aria-hidden="true"></div>
</body>
</html>



