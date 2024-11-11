@extends('layouts.app')

@section('content')
    <h1 class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-600">Daftar Makanan</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Tambah Makanan</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <!-- Tabel yang diubah menjadi kartu di layar kecil -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="hidden md:block">
            <!-- Tabel tampilan desktop -->
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">No</th>
                        <th class="py-2 px-4 text-left">Gambar</th>
                        <th class="py-2 px-4 text-left">Nama Produk</th>
                        <th class="py-2 px-4 text-left">Kategori</th> 
                        <th class="py-2 px-4 text-left">Deskripsi</th>
                        <th class="py-2 px-4 text-left">Jumlah</th>
                        <th class="py-2 px-4 text-left">Harga</th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index => $product)
                    <tr class="border-b border-gray-200">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover">
                            @else
                                <span>Tidak ada gambar</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">{{ $product->name }}</td>
                        <td class="py-3 px-4">{{ ucfirst(str_replace('-', ' ', $product->category)) }}</td> 
                        <td class="py-3 px-4">{{ $product->description }}</td>
                        <td class="py-3 px-4">{{ $product->jumlah }} Porsi</td>
                        <td class="py-3 px-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tampilan mobile: format kartu -->
        <div class="md:hidden space-y-4">
            @foreach($products as $index => $product)
            <div class="bg-gray-100 rounded-lg shadow p-4">
                <div class="flex items-center space-x-4">
                    <div>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover">
                        @else
                            <span>Tidak ada gambar</span>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-600">Kategori: {{ ucfirst(str_replace('-', ' ', $product->category)) }}</p>
                        <p class="text-sm text-gray-600">Jumlah: {{ $product->jumlah }} Porsi</p>
                        <p class="text-sm text-gray-600">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">Deskripsi: {{ $product->description }}</p>
                    </div>
                </div>
                <div class="mt-4 space-x-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
