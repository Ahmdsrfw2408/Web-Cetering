@extends('customer.dashboard')

@section('konten')
<section>
    <div class="container">
        <div class="category-buttons">
            <a href="{{ route('menu.index', ['category' => 'all']) }}" class="btn-category">Semua</a>
            <a href="{{ route('menu.index', ['category' => 'hemat']) }}" class="btn-category">Paket Hemat</a>
            <a href="{{ route('menu.index', ['category' => 'ekstra']) }}" class="btn-category">Paket Ekstra</a>
            <a href="{{ route('menu.index', ['category' => 'sarapan']) }}" class="btn-category">Paket Sarapan</a>
            <a href="{{ route('menu.index', ['category' => 'makan-siang']) }}" class="btn-category">Paket Makan Siang</a>
        </div>
        
        <h3>Menu Makanan</h3>
    
        <div class="menu-items">
            @foreach ($products as $product)
                <div class="menu-item">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p class="des">{{ $product->description }}</p>

                        <div class="product-footer">
                            <p class="paket"><strong>Paket: </strong>{{ ucfirst(str_replace('-', ' ', $product->category)) }}</p>
                            <p>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <p>Stok: {{ $product->jumlah }} Paket</p>
                                @if($product->jumlah > 0 )
                                    <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                                @else
                                    <button class="btn btn-secondary" disabled>Stok Habis</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
