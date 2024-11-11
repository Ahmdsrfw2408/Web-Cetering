<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Ratu - Hasil Pencarian</title>
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
            flex-wrap: wrap;
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

        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-color);
        }

        .search-bar-container {
            display: flex;
            position: relative;
            width: 100%;
            max-width: 250px;
        }

        .search-bar {
            width: 100%;
            padding: 8px 35px 8px 10px;
            border-radius: 5px;
            border: 1px solid var(--shadow-color);
        }

        .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
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

        .menu-toggle {
            display: flex;
            flex-direction: column;
            gap: 4px;
            cursor: pointer;
        }

        .menu-toggle div {
            width: 25px;
            height: 3px;
            background-color: var(--text-color);
            border-radius: 5px;
        }

        .nav-links {
            display: flex;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
                align-items: center;
                background-color: rgba(0, 0, 0, 0.8);
                position: absolute;
                top: 60px;
                left: 0;
                padding: 15px 0;
                box-shadow: 0 2px 8px var(--shadow-color);
            }

            .nav-links.active {
                display: flex;
            }

            .menu-toggle {
                display: flex;
            }
        }

        .search-results {
            padding: 20px;
            margin-top: 100px;
        }

        .result-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 15px;
            padding: 20px;
            margin-top: 100px;
            justify-content: center;
        }
        .result-item {
            background-color: var(--card-bg);
            border-radius: 8px;
            padding: 15px;
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

        footer {
            background-color: var(--secondary-color);
            color: var(--text-color);
            padding: 15px;
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }

         /* Animasi */
         @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsif */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
            }

            .navbar .menu-toggle {
                display: block;
            }

            .navbar.expanded .nav-links {
                display: flex;
            }

            .hero-content h2 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .result-item {
                width: 100%;
            }
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
        <form action="{{ route('search') }}" method="get" class="search-bar-container">
            <input type="text" name="query" class="search-bar" placeholder="Cari makanan..." value="{{ request('query') }}">
            <i class="fas fa-search search-icon"></i>
        </form>
    </header>

    <!-- Hasil Pencarian -->
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.querySelector('.menu-toggle');
            const navbar = document.querySelector('.navbar');

            toggle.addEventListener('click', () => {
                navbar.classList.toggle('expanded');
            });
        });
    </script>

</body>
</html>
