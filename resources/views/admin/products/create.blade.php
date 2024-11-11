@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Judul Form -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Produk Baru</h2>

    <!-- Pesan Error -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.
            <ul class="mt-2 list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Produk -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium">Nama Produk:</label>
            <input type="text" name="name" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nama Produk" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium">Deskripsi:</label>
            <textarea name="description" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Deskripsi Produk"></textarea>
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-medium">Kategori:</label>
            <select name="category" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="-">-</option>
                <option value="hemat">Paket Hemat</option>
                <option value="ekstra">Paket Ekstra</option>
                <option value="makan-siang">Paket Makan Siang</option>
                <option value="sarapan">Paket Sarapan</option>
                <option value="makan-malam">Paket Makan Malam</option>
            </select>
        </div>

        <!-- Harga -->
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-medium">Harga:</label>
            <input type="number" name="price" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Harga Produk" required>
        </div>

        <!-- Jumlah Stok -->
        <div class="mb-4">
            <label for="jumlah" class="block text-gray-700 font-medium">Jumlah Stok:</label>
            <input type="number" name="jumlah" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Jumlah Stok" min="0" required>
        </div>

        <!-- Gambar Produk -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-medium">Gambar Produk:</label>
            <input type="file" name="image" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Tambah Produk</button>
    </form>
</div>
@endsection
