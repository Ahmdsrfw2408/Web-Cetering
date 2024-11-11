<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        td {
            font-size: 12px;
        }
        .table-header {
            background-color: #f7f7f7;
        }
        .table-footer {
            margin-top: 20px;
            text-align: right;
            font-size: 14px;
            font-weight: bold;
        }
        .table-footer .total {
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="bg-gray-100 text-gray-800">
        <div class="container mx-auto px-4 py-6 bg-white shadow-lg">
            <h1 class="text-2xl font-bold uppercase">Warung Ratu</h1>
            <p class="text-sm">Alamat: Jalan Mawar No. 15, Jakarta</p>
            <p class="text-sm">No. HP: 0812-3456-7890</p>
        </div>
        <h2 class="text-center text-xl font-bold mb-4 uppercase">Laporan Data Pesanan</h2>
        
        <!-- Tabel Laporan Pesanan -->
        <table  class="min-w-full border border-gray-300 bg-white">
            <thead class="bg-blue-200">
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border border-gray-300">ID Pesanan</th>
                    <th class="px-4 py-2 border border-gray-300">Nama Pelanggan</th>
                    <th class="px-4 py-2 border border-gray-300">Email</th>
                    <th class="px-4 py-2 border border-gray-300">Alamat</th>
                    <th class="px-4 py-2 border border-gray-300">Nomor Telepon</th>
                    <th class="px-4 py-2 border border-gray-300">Metode Pembayaran</th>
                    <th class="px-4 py-2 border border-gray-300">Total Harga</th>
                    <th class="px-4 py-2 border border-gray-300">Status</th>
                    <th class="px-4 py-2 border border-gray-300">Tanggal Pesan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="bg-gray-100">
                    <td class="px-4 py-2 border border-gray-300">{{ $order->id }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $order->name }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $order->email }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $order->address }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $order->phone }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $order->payment_method }}</td>
                    <td class="px-4 py-2 border border-gray-300">Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ ucfirst($order->status) }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $order->created_at->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer Laporan -->
        <div class="table-footer">
            <p class="total">Total Pesanan: {{ number_format($orders->sum('amount'), 0, ',', '.') }}</p>
        </div>
    </div>
</body>
</html>
