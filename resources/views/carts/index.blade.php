<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container-cart">
        <h1>Keranjang Belanja</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <ul class="cart-list">
            @foreach ($carts as $cart)
                <li class="cart-item">
                    <div class="cart-info">
                        <strong>{{ $cart->product->name }}</strong>
                        <p>Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="quantity-controls">
                        <form method="POST" action="{{ route('cart.update', $cart->id) }}" class="quantity-form">
                            @csrf
                            <button type="submit" name="quantity" value="{{ $cart->quantity - 1 }}" class="btn">-</button>
                            <span>{{ $cart->quantity }}</span>
                            <button type="submit" name="quantity" value="{{ $cart->quantity + 1 }}" class="btn">+</button>
                        </form>
                    </div>

                    <div class="total-price">
                        <p>Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
                    </div>

                    <form method="POST" action="{{ route('cart.remove', $cart->id) }}" class="remove-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">Hapus</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <div class="cart-summary">
            <p>Total: Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
            <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Checkout</a>
            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</body>
</html>
