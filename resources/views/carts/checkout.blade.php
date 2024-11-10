<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Warung Ratu - Payment</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/payment.css">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    window.location.href = "/payment/success";
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran Anda!");
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                }
            });
        };
    </script>
</head>
<body>
    <header class="navbar">
        <h1 class="logo">Warung Ratu</h1>
        <button class="menu-toggle" id="menu-toggle">&#9776;</button>

        <ul class="nav-links" id="nav-links">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="#">Menu</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </header>

    <div class="payment-container">
        <h1>Halaman Pembayaran</h1>
        <p>Total Harga: Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>

    <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>

        <label for="altujuan">Alamat Tujuan:</label>
        <select id="altujuan" name="altujuan" required onchange="updateOngkosKirim()">
            <option value="" disabled selected>Pilih Alamat Tujuan</option>
            <option value="Martapura" data-ongkir="10000">Martapura</option>
            <option value="Banjarbaru" data-ongkir="15000">Banjarbaru</option>
            <option value="Banjarmasin" data-ongkir="20000">Banjarmasin</option>
        </select>

        <p>Ongkos Kirim: Rp <span id="ongkos-kirim">0</span></p>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Nomor HP:</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{10,13}" required>

        <label for="payment-method">Metode Pembayaran:</label>
        <select id="payment-method" name="payment_method" required>
            <option value="" disabled selected>Pilih Metode Pembayaran</option>
            <option value="bank_transfer">Transfer Bank</option>
            <option value="credit_card">Kartu Kredit</option>
            <option value="ewallet">E-Wallet</option>
        </select>

        <button type="submit" id="pay-button">Konfirmasi Pembayaran</button>
        
    </form>
    

    </div>

    <footer class="footer">
        <p>&copy; 2024 Warung Ratu. All Rights Reserved.</p>
    </footer>
    
</body>
</html>
