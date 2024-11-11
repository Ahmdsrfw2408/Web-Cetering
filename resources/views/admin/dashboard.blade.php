@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <!-- Dashboard Header -->
    <div class="bg-blue-500 text-white rounded-lg shadow-lg mb-6 p-4">
        <h4 class="text-xl font-bold">Dashboard Warung Ratu</h4>
        <p>Welcome, {{ Auth::user()->name }}</p>
    </div>

    <!-- Card untuk Jumlah Data Makanan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
            <div>
                <i class="fa fa-cutlery fa-3x text-blue-500"></i>
                <h5 class="text-lg font-semibold mt-2">Jumlah Data Makanan</h5>
                <p class="text-blue-600 text-2xl font-bold">{{ $jumlahmakanan }}</p>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Pengguna -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h5 class="text-xl font-bold mb-4">Daftar Pengguna</h5>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Username</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Waktu Terakhir Aktif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-2 text-gray-800 text-center">{{ $user->name }}</td>
                        <td class="px-4 py-2 text-gray-800 text-center">{{ $user->email }}</td>
                        <td class="px-4 py-2 text-center">
                            <span class="{{ $user->is_online ? 'text-green-500' : 'text-red-500' }}">
                                {{ $user->is_online ? 'Online' : 'Offline' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-gray-800 text-center">
                            @if (!$user->is_online)
                                {{ $user->last_active ? $user->last_active->diffForHumans() : 'Tidak Pernah Aktif' }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div>
@endsection
