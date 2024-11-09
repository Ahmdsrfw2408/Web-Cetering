
@extends('layouts.app')

@section('content')
<div class="container-fluid"> <!-- Mengganti container dengan container-fluid untuk lebar penuh -->
    <div class="row justify-content-md-center">
        <div class="col-md-12 px-0"> <!-- Mengubah col-md-8 menjadi col-md-12 dan menghilangkan padding horizontal -->
            <div class="panel">
                <div class="miniStats--panel">
                    <div class="miniStats--header bg-darker w-100">
                        <div class="text-start text-white fw-bold "> <!-- Menambahkan kelas Bootstrap untuk teks putih dan tebal, serta padding -->
                            <h4>Dashboard Warung Ratu</h4> 
                            <p>Welcome, {{ Auth::user()->name }}</p>
                        </div>
                        
                    </div>
                </div>
                <div class="miniStats--body">
                    <i class="miniStats--icon fa fa-user text-blue"></i>
                    <h3 class="miniStats--title h4">Jumlah Data Makanan</h3>
                    <p class="miniStats--num text-blue">{{  $jumlahmakanan }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Password (Terenkripsi)</th>
                <th>Status</th>
                <th>Waktu Terakhir Aktif</th> <!-- Kolom baru untuk waktu terakhir aktif -->
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>
                        <span class="{{ $user->is_online ? 'text-success' : 'text-danger' }}">
                            {{ $user->is_online ? 'Online' : 'Offline' }}
                        </span>
                    </td>
                    <td>
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
@endsection


