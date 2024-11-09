@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Produk Baru</h2>

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

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nama Produk:</label>
            <input type="text" name="name" class="form-control" placeholder="Nama Produk" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea name="description" class="form-control" placeholder="Deskripsi Produk"></textarea>
        </div>

        <div class="form-group">
            <label for="category">Kategori:</label>
            <select name="category" class="form-control" required>
                <option value="hemat">Paket Hemat</option>
                <option value="ekstra">Paket Ekstra</option>
                <option value="makan-siang">Paket Makan Siang</option>
                <option value="sarapan">Paket Sarapan</option>
                <option value="makan-malam">Paket Makan Malam</option>
            </select>
        </div>
        

        <div class="form-group">
            <label for="price">Harga:</label>
            <input type="number" name="price" class="form-control" placeholder="Harga Produk" required>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah Stok:</label>
            <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Stok" min="0" required>
        </div>

        <div class="form-group">
            <label for="image">Gambar Produk:</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Tambah Produk</button>
    </form>
</div>
@endsection
