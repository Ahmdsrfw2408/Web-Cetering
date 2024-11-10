@extends('layouts.app')

@section('content')
<h1>Kelola Pesanan</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Id Pesanan</th>
            <th>Nama Pemesan</th>
            <th>Email Pemesan</th>
            <th>Status</th>
            <th>Foto Bukti</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->user->email }}</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>
                @if($order->status === 'success' && $order->photo)
                    <img src="{{ asset('storage/' . $order->photo) }}" alt="Foto Bukti" width="100px">
                @else
                    Tidak ada
                @endif
            </td>
            
            <td>
                @if ($order->status === 'pending')
                    <form action="{{ route('admin.products.updateStatus', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('PUT')
                        <button type="submit" name="status" value="sedang diantar" class="btn btn-primary">Antarkan Pesanan</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection