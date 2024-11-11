@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Judul Halaman -->
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Laporan Data Produk</h1>

    <!-- Tabel Produk di Layar Lebar -->
    <div class="hidden md:block overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">ID Produk</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Nama Produk</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Stok</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->id }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->jumlah }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tampilan Kartu di Layar Kecil -->
    <div class="md:hidden space-y-4">
        @foreach($products as $product)
        <div class="bg-gray-100 rounded-lg shadow p-4">
            <p class="text-sm font-semibold text-gray-700">ID Produk: {{ $product->id }}</p>
            <p class="text-sm text-gray-700">Nama Produk: {{ $product->name }}</p>
            <p class="text-sm text-gray-700">Stok: {{ $product->jumlah }}</p>
            <p class="text-sm text-gray-700">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
