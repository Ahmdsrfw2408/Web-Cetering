@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Laporan Data Pesanan</h1>
    <a href="{{ route('reports.orders.pdf') }}" class="btn btn-primary mb-3">Download PDF</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Metode Pembayaran</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal Pesan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ $order->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
