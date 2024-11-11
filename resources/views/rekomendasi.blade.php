<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Ratu - Rekomendasi</title>
    <style>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-image: url("/img/ayam_bakar.jpeg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: var(--secondary-color);
            line-height: 1.6;
            position: relative;
            z-index: 0;
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
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        /* Kolom Pencarian */
        .search-container {
            display: flex;
            align-items: center;
            background-color: var(--card-bg);
            border-radius: 25px;
            padding: 5px 15px;
            box-shadow: 0 2px 8px var(--shadow-color);
        }

        .search-input {
            border: none;
            padding: 10px;
            border-radius: 20px;
            outline: none;
            width: 200px;
        }

        .search-button {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-button:hover {
            background-color: var(--hover-color);
        }

        /* Menu Toggle */
        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-color);
        }

        /* Card Styling */
        .categories {
            padding: 100px 30px 50px;
            text-align: center;
        }

        .categories h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 8px;
            box-shadow: 0 4px 8px var(--shadow-color);
            overflow: hidden;
            max-width: 250px;
            text-align: left;
        }

        .card-img-top {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .card-text {
            font-size: 14px;
            color: #555;
            margin-top: 5px;
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
                background-color: rgba(0, 0, 0, 0.8);
                position: absolute;
                top: 60px;
                left: 0;
                padding: 15px 0;
                box-shadow: 0 2px 8px var(--shadow-color);
            }

            /* Menampilkan menu saat expanded */
            .navbar.expanded .nav-links {
                display: flex;
            }

            .card {
                max-width: 100%;
            }

            .search-container {
                width: 100%;
            }

            .search-input {
                width: 100%;
            }
        }
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
        <span class="menu-toggle">&#9776;</span>
        <ul class="nav-links">
            <li><a href="{{ route('welcome') }}">Home</a></li>
            <li><a href="{{ route('rekomendasi') }}">Rekomendasi</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        </ul>
        <!-- Kolom Pencarian -->
        <form action="{{ route('search') }}" method="GET" class="search-container">
            <input type="text" name="search" class="search-input" placeholder="Cari produk..." required>
            <button type="submit" class="search-button">Cari</button>
        </form>
    </header>

    <!-- Kategori Populer -->
    <section class="categories" id="rekomendasi">
        <h3>Kategori Populer</h3>
        <div class="category-list">
            @foreach ($popularProducts as $product)
                <div class="card">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Rp{{ number_format($product->price, 0, ',', '.') }}</strong></p>
                        <p class="card-text">Terjual: {{ $product->total_sales }} kali</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Warung Ratu. All rights reserved.</p>
    </footer>

    <!-- Script for Toggle Menu -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.querySelector('.menu-toggle');
            const navbar = document.querySelector('.navbar');

            toggle.addEventListener('click', () => {
                navbar.classList.toggle('expanded');
            });
        });

        document.querySelector('.search-button').addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah pengiriman form default
            const query = document.querySelector('.search-input').value.trim();
            
            // Lakukan pencarian berdasarkan query
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                const productName = card.querySelector('.card-title').textContent.toLowerCase();
                if (productName.includes(query.toLowerCase())) {
                    card.style.display = 'block'; // Tampilkan produk yang cocok
                } else {
                    card.style.display = 'none'; // Sembunyikan produk yang tidak cocok
                }
            });
        });
    </script>

</body>
</html>
