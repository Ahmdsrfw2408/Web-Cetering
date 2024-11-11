@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Judul Halaman -->
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Laporan Data Pesanan</h1>

    <!-- Tombol Download PDF -->
    <a href="{{ route('reports.orders.pdf') }}" class="btn btn-primary mb-6 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
        Download PDF
    </a>

    <!-- Tabel Pesanan di Layar Lebar -->
    <div class="hidden md:block overflow-x-auto bg-white shadow-md rounded-lg mb-8">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">ID Pesanan</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Nama Pelanggan</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Alamat</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Nomor Telepon</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Metode Pembayaran</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Total Harga</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Tanggal Pesan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $order->id }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $order->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $order->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $order->address }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $order->phone }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $order->payment_method }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ ucfirst($order->status) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $order->created_at->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tampilan Kartu di Layar Kecil -->
    <div class="md:hidden space-y-4">
        @foreach($orders as $order)
        <div class="bg-gray-100 rounded-lg shadow p-4">
            <p class="text-sm font-semibold text-gray-700">ID Pesanan: {{ $order->id }}</p>
            <p class="text-sm text-gray-700">Nama Pelanggan: {{ $order->name }}</p>
            <p class="text-sm text-gray-700">Email: {{ $order->email }}</p>
            <p class="text-sm text-gray-700">Alamat: {{ $order->address }}</p>
            <p class="text-sm text-gray-700">Nomor Telepon: {{ $order->phone }}</p>
            <p class="text-sm text-gray-700">Metode Pembayaran: {{ $order->payment_method }}</p>
            <p class="text-sm text-gray-700">Total Harga: Rp {{ number_format($order->amount, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-700">Status: {{ ucfirst($order->status) }}</p>
            <p class="text-sm text-gray-700">Tanggal Pesan: {{ $order->created_at->format('d-m-Y') }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
