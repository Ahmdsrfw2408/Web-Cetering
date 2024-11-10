<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Ratu - Struk</title>
    <style>
        :root {
            --primary-color: #ff5722;
            --secondary-color: #333;
            --text-color: #fff;
            --bg-color: #f4f4f4;
            --card-bg-color: #ffffff;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --hover-color: rgba(255, 87, 34, 0.8);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--bg-color);
            color: var(--secondary-color);
            line-height: 1.6;
        }

        .card {
            background-color: var(--card-bg-color);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px var(--shadow-color);
            max-width: 500px;
            width: 100%;
            text-align: left; /* Rata kiri untuk teks */
        }

        .card h1 {
            color: var(--primary-color);
            margin-bottom: 20px;
            text-align: center; /* Judul tetap di tengah */
        }

        .info {
            background-color: var(--bg-color);
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 1px 5px var(--shadow-color);
        }

        .info p {
            margin: 5px 0;
            display: flex; /* Menyusun elemen dalam baris */
            justify-content: space-between; /* Membagi ruang antara elemen */
        }

        .info p strong {
            width: 50%; /* Lebar label 50% */
            text-align: left; /* Rata kiri untuk label */
        }

        .divider {
            border-top: 1px dashed var(--secondary-color); /* Garis putus-putus */
            margin: 10px 0; /* Margin atas dan bawah */
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: var(--hover-color);
        }

        @media print {
            .btn-container {
                display: none; /* Sembunyikan tombol saat dicetak */
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Pembayaran Berhasil</h1>
        <p>Terima kasih telah memesan di tempat kami! Kami akan segera memproses pesanan Anda.</p>

        <div class="info">
            <p><strong>Nama Pemesan:</strong> {{ $order->name }}</p>
            <p><strong>Alamat:</strong> {{ $order->address }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Nomor HP:</strong> {{ $order->phone }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
            <div class="divider"></div>
            <h3>Detail Pesanan:</h3>
            @foreach ($order->items as $item)
                <p>
                    <strong>{{ $item->product->name }}</strong> - 
                    {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }} = 
                    Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                </p>
             @endforeach
            <div class="divider"></div>
            <p><Strong>Ongkos Kirim: </Strong>Rp {{ number_format($shippingCost, 0, ',', '.') }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($totalPriceWithShipping, 0, ',', '.') }}</p>

        </div>
        

        <div class="btn-container">
            <a href="#" onclick="window.print();" class="btn">Cetak Struk</a>
            <a href="{{ route('home') }}" class="btn">Kembali ke Beranda</a>
        </div>
    </div>
</body>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                window.location.href = "/payment/success";  // arahkan ke halaman selesai pembayaran
            },
            onPending: function(result) {
                alert("Menunggu pembayaran Anda!");
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
            }
        });
    });
</script>

</html>
