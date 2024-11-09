<header class="navbar">
    <h1 class="logo">Warung Ratu</h1>
    <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
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
