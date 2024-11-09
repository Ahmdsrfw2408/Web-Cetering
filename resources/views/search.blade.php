<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Ratu - Hasil Pencarian</title>
    <style>
        /* CSS disini seperti pada kode yang sudah ada */
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
            <input type="text" name="query" class="search-bar" placeholder="Cari makanan..." value="{{ request('query') }}">
            <button type="submit" class="btn">Cari</button>
        </form>
        <div>
            <a href="{{ route('login') }}" class="btn">Login</a>
            <a href="{{ route('register') }}" class="btn">Register</a>
        </div>
    </header>

    <!-- Hasil Pencarian -->
    <h3>Hasil Pencarian: "{{ $query }}"</h3>
    <section class="search-results">
        @if($filteredFoods->isEmpty())
            <p>Tidak ada hasil yang ditemukan.</p>
        @else
            <div class="result-list">
                @foreach($filteredFoods as $food)
                    <div class="result-item">
                        <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}">
                        <span>{{ $food->name }}</span>
                        <p>Harga: {{ $food->price }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
    

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Warung Ratu. All rights reserved.</p>
    </footer>

    <style>
        /* Warna tema dan font */
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
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            color: var(--text-color);
            box-shadow: 0 2px 8px var(--shadow-color);
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
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
            text-decoration: none;
        }

        .btn:hover {
            background-color: var(--hover-color);
        }

        /* Hero Section */
        .hero {
            background-image: url('img/background_hero.jpg');
            background-size: cover;
            padding: 120px 20px;
            color: var(--text-color);
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .hero-content h2 {
            font-size: 36px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .hero-content p {
            margin-top: 10px;
            font-size: 18px;
        }

        /* Hasil Pencarian */
        .search-results {
            padding: 20px;
            margin-top: 80px;
        }

        .result-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .result-item {
            background-color: var(--card-bg);
            border-radius: 8px;
            padding: 15px;
            width: 160px;
            box-shadow: 0 4px 8px var(--shadow-color);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .result-item:hover {
            transform: translateY(-5px);
        }

        .result-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .result-item span {
            font-weight: bold;
            color: var(--secondary-color);
            margin-top: 10px;
            display: block;
        }

        .result-item p {
            color: #777;
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
</body>
</html>

