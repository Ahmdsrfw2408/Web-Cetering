@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Judul Halaman -->
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Laporan Data Pelanggan</h1>

    <!-- Tampilan Tabel di Layar Lebar -->
    <div class="hidden md:block overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $customer->id }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $customer->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $customer->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tampilan Kartu di Layar Kecil -->
    <div class="md:hidden space-y-4">
        @foreach($customers as $customer)
        <div class="bg-gray-100 rounded-lg shadow p-4">
            <p class="text-sm font-semibold text-gray-700">ID: {{ $customer->id }}</p>
            <p class="text-sm text-gray-700">Nama: {{ $customer->name }}</p>
            <p class="text-sm text-gray-700">Email: {{ $customer->email }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
