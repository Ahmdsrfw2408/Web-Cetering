<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
 <!-- CSRF Token -->
    <title>Warung Ratu</title>
    <link rel="stylesheet" href="css/styles.css" />
    <script defer src="js/script.js"></script>
</head>
<body>
    <header class="navbar">
        <h1 class="logo">Warung Ratu</h1>
    
        <button class="menu-toggle" id="menu-toggle" aria-label="Toggle Menu">&#9776;</button>
        
        <ul class="nav-links" id="nav-links">
            <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
            <li class="{{ request()->routeIs('menu.index') ? 'active' : '' }}"><a href="{{ route('menu.index') }}">Menu</a></li>
            <li class="{{ request()->routeIs('about') ? 'active' : '' }}"><a href="{{ route('about') }}">About</a></li>
            <li class="{{ request()->routeIs('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
    
        <div class="icons">
            <a href="{{ route('cart.index') }}"><img src="img/cart1.svg" alt="Cart"></a>
            <a href="{{ route('cart.history') }}"><img src="img/history.svg" alt="History"></a>
        </div>
    
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </header>
    
    

    <main>
        <!-- Home Section -->
        <section  class="section active">
            @yield('konten')
        </section>

        <!-- Menu Section-->
        <section  class="section">
            @yield('konten')
        </section>

        <section id="about" class="section">
            @yield('konten')
        </section>
        

        <section id="contact" class="section">
            @yield('konten')
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

    <!-- btn menu categori -->
    <script>
        document.querySelectorAll('.btn-category').forEach(button => {
            button.addEventListener('click', () => {
                const selectedCategory = button.getAttribute('data-category');
                console.log(`Tombol kategori '${selectedCategory}' diklik`);
        
                document.querySelectorAll('.menu-item').forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    console.log(`Produk kategori: ${itemCategory}`);

                     // Jika kategori 'all', tampilkan semua produk
                    if (selectedCategory === 'all' || itemCategory === selectedCategory) {
                        item.style.display = 'block'; // Tampilkan produk
                    } else {
                        item.style.display = 'none'; // Sembunyikan produk lainnya
                    }
                });
            });
        });
        </script>
        
</body>
</html>




