<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Ratu - Rekomendasi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
    <style>
        /* Tema dan font */
        :root {
            --primary-color: #ff5722;
            --secondary-color: #333;
            --bg-color: #f4f4f4;
            --text-color: #fff;
            --card-bg: #ffffff;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --hover-color: rgba(255, 87, 34, 0.8);
            font-family: "Poppins", sans-serif;
        }

        /* Reset dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-image: url("/img/ayam_bakar.jpeg"); /* Gambar background */
            background-size: cover; /* Menyesuaikan ukuran gambar agar menutupi seluruh layar */
            background-position: center;
            background-attachment: fixed; /* Agar gambar tetap di tempat saat di-scroll */
            color: var(--secondary-color);
            line-height: 1.6;
            position: relative; /* Agar overlay bisa bekerja dengan baik */
            z-index: 0; /* Memastikan konten berada di atas overlay */
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: rgba(0, 0, 0, 0.8);
            color: var(--text-color);
            box-shadow: 0 2px 8px var(--shadow-color);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 24px;
            color: var(--primary-color);
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        /* Tombol pencarian */
        .search-bar {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid var(--shadow-color);
        }

        .btn {
            background-color: var(--primary-color);
            color: var(--text-color);
            padding: 8px 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        /* Kategori Populer */
        .categories {
            padding: 60px 20px;
            margin-top: 80px;
            text-align: center;
        }

        .categories h3 {
            font-size: 24px;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .category-item {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            width: 200px;
            box-shadow: 0 4px 8px var(--shadow-color);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .category-item:hover {
            transform: translateY(-5px);
        }

        .category-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .category-item span {
            font-weight: bold;
            color: var(--secondary-color);
            margin-top: 10px;
            display: block;
        }

        /* Footer */
        footer {
            background-color: var(--secondary-color);
            color: var(--text-color);
            padding: 15px;
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <h1 class="logo">Warung Ratu</h1>
        <ul class="nav-links">
            <li><a href="{{ route('welcome') }}">Home</a></li>
            <li><a href="{{ route('rekomendasi') }}">Rekomendasi</a></li>
        </ul>
        <form action="{{ route('search') }}" method="get">
            <input type="text" name="query" class="search-bar" placeholder="Cari makanan..." value="{{ old('query') }}">
            <button type="submit" class="btn">Cari</button>
        </form>
        <div>
            <a href="{{ route('login') }}" class="btn">Login</a>
            <a href="{{ route('register') }}" class="btn">Register</a>
        </div>
    </header>

    <!-- Kategori Populer -->
    <section class="categories" id="rekomendasi">
        <h3>Kategori Populer</h3>
        <div class="category-list">
            <div class="category-item">
                <img src="img/makanan.jpg" alt="Makanan Terbaik">
                <span>Makanan Terbaik</span>
            </div>
            <div class="category-item">
                <img src="img/promo.jpg" alt="Promo Spesial">
                <span>Promo Spesial</span>
            </div>
            <div class="category-item">
                <img src="img/minuman.jpg" alt="Minuman Segar">
                <span>Minuman Segar</span>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Warung Ratu. All rights reserved.</p>
    </footer>
</body>
</html>
