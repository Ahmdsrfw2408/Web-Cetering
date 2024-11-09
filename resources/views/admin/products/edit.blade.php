@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Produk</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Produk:</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Nama Produk" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea name="description" class="form-control" placeholder="Deskripsi Produk">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="category">Kategori:</label>
            <select name="category" class="form-control" required>
                <option value="hemat" {{ $product->category == 'hemat' ? 'selected' : '' }}>Paket Hemat</option>
                <option value="ekstra" {{ $product->category == 'ekstra' ? 'selected' : '' }}>Paket Ekstra</option>
                <option value="makan-siang" {{ $product->category == 'makan-siang' ? 'selected' : '' }}>Paket Makan Siang</option>
                <option value="sarapan" {{ $product->category == 'sarapan' ? 'selected' : '' }}>Paket Sarapan</option>
                <option value="makan-malam" {{ $product->category == 'makan-malam' ? 'selected' : '' }}>Paket Makan Malam</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Harga:</label>
            <input type="number" name="price" value="{{ $product->price }}" class="form-control" placeholder="Harga Produk" required>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah Stok:</label>
            <input type="number" name="jumlah" value="{{ $product->jumlah }}" class="form-control" placeholder="Jumlah Stok" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Perbarui Produk</button>
    </form>
</div>
@endsection
