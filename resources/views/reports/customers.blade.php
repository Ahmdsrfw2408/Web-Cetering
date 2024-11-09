@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Laporan Data Pelanggan</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
