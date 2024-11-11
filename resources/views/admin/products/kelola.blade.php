@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Judul Halaman -->
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Kelola Pesanan</h1>

    <!-- Tabel Pesanan -->
    <div class="bg-white shadow-md rounded-lg">
        <!-- Tampilan Tabel di Layar Lebar -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Id Pesanan</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Nama Pemesan</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Email Pemesan</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Foto Bukti</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $order->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $order->user->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ ucfirst($order->status) }}</td>
                        <td class="px-6 py-4">
                            @if($order->status === 'success' && $order->photo)
                                <img src="{{ asset('storage/' . $order->photo) }}" alt="Foto Bukti" class="w-24 h-24 object-cover">
                            @else
                                Tidak ada
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($order->status === 'pending')
                                <form action="{{ route('admin.products.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="status" value="sedang diantar" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        Antarkan Pesanan
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tampilan Kartu di Layar Kecil -->
        <div class="md:hidden space-y-4">
            @foreach($orders as $order)
            <div class="bg-gray-100 rounded-lg shadow p-4">
                <p class="text-sm font-semibold text-gray-700">Id Pesanan: {{ $order->id }}</p>
                <p class="text-sm text-gray-700">Nama Pemesan: {{ $order->user->name }}</p>
                <p class="text-sm text-gray-700">Email Pemesan: {{ $order->user->email }}</p>
                <p class="text-sm text-gray-700">Status: {{ ucfirst($order->status) }}</p>
                <p class="text-sm text-gray-700">Foto Bukti:
                    @if($order->status === 'success' && $order->photo)
                        <img src="{{ asset('storage/' . $order->photo) }}" alt="Foto Bukti" class="w-24 h-24 object-cover mt-2">
                    @else
                        Tidak ada
                    @endif
                </p>
                <div class="mt-4">
                    @if ($order->status === 'pending')
                        <form action="{{ route('admin.products.updateStatus', $order->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <button type="submit" name="status" value="sedang diantar" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Antarkan Pesanan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
