<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Histori Pemesanan</title>
    <style>
        /* Styling umum untuk container */
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2); /* Gradient background */
            border-radius: 8px;
        }

        /* Judul halaman */
        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
        }

        /* Card styling untuk setiap pesanan */
        .order {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        /* Efek hover untuk card */
        .order:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        /* Judul pesanan */
        .order h3 {
            font-size: 1.4rem;
            color: #ff6347;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .order h3:before {
            content: "🛒";
            font-size: 1.4rem;
        }

        /* Informasi pesanan umum */
        .order p {
            margin: 8px 0;
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Daftar item pesanan */
        .order ul {
            list-style: none;
            padding: 0;
            margin: 15px 0;
        }

        /* Item pesanan */
        .order ul li {
            font-size: 1rem;
            padding: 6px 0;
            border-bottom: 1px dashed #ddd;
            color: #333;
        }

        /* Hapus garis bawah dari item terakhir */
        .order ul li:last-child {
            border-bottom: none;
        }

        /* Penekanan pada label teks */
        .order p strong {
            color: #333;
            font-weight: 600;
        }

        /* Badge untuk status */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            background-color: #ff6347;
            color: #fff;
            border-radius: 12px;
            font-size: 0.85rem;
            text-transform: uppercase;
            margin-left: 10px;
            font-weight: bold;
        }

        /* Pesan tanpa histori pemesanan */
        .container p {
            text-align: center;
            font-size: 1.1rem;
            color: #888;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            font-style: italic;
        }

        .btn{
            background-color: #ff6347;
            border: 1px transparent solid
            display: inline-block;
            padding: 4px 10px;
            background-color: #ff6347;
            color: #fff;
            border-radius: 12px;
            font-size: 0.85rem;
            text-transform: uppercase;
            margin-left: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
<div class="container">
    <h1>Histori Pemesanan</h1>

    @forelse ($orders as $order)
        <div class="order">
            <h3>Pesanan ID: {{ $order->id }}</h3>
            <p>
                <strong>Nama:</strong> {{ $order->name }} <br>
                <strong>Alamat:</strong> {{ $order->address }} <br>
                <p>Status: <span class="status-badge">{{ ucfirst($order->status) }}</span></p>
                @if ($order->status === 'sedang diantar')
                    <form action="{{ route('payments.confirmDelivery', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="photo">Unggah Foto Barang:</label>
                        <input type="file" name="photo" required>
                        <button type="submit" class="btn">Konfirmasi Barang Sudah Sampai</button>
                    </form>
                @endif
                <strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </p>

            <h4>Detail Item:</h4>
            <ul>
                @foreach ($order->items as $item)
                    <li>{{ $item->product->name }} x {{ $item->quantity }} - Rp {{ number_format($item->price, 0, ',', '.') }}</li>
                @endforeach
            </ul>

            <p><strong>Ongkir:</strong> Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
            <a href="{{ route('home') }}" class="btn">Kembali</a>
        </div>
    @empty
        <p>Belum ada histori pemesanan.</p>
    @endforelse
</div>

</body>
</html>
