@extends('layouts.app')

@section('content')
    <h1>Daftar Makanan</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-dt-4 mb-3">Tambah Makanan</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th> 
                <th>Deskripsi</th>
                <td>Jumlah</td>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                    @else
                        <span>Tidak ada gambar</span>
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ ucfirst(str_replace('-', ' ', $product->category)) }}</td> 
                <td>{{ $product->description }}</td>
                <td>{{ $product->jumlah }} Porsi</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    
@endsection
