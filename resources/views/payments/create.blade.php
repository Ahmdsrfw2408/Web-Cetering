<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Warung Ratu - Payment</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/payment.css">
    <script defer src="js/payment.js"></script>
    
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
        <input type="text" id="name" name="name" value="{{ $user->name }}" required readonly> 

              <!-- Dropdown untuk memilih Kota/Wilayah -->
<label for="main-location">Pilih Kota/Wilayah:</label>
<select id="main-location" required onchange="updateSubLocationOptions()">
    <option value="" disabled selected>Pilih Kota/Wilayah</option>
    <option value="martapura">Martapura</option>
    <option value="banjarbaru">Banjarbaru</option>
    <option value="banjarmasin">Banjarmasin</option>
</select>

<!-- Dropdown dinamis untuk Kecamatan -->
<label for="sub-location">Pilih Kecamatan:</label>
<select id="sub-location" name="altujuan" required onchange="updateOngkosKirim()">
    <option value="" disabled selected>Pilih Kecamatan</option>
    <!-- Opsi kecamatan akan diisi secara dinamis -->
</select>



        <!-- Tampilkan ongkos kirim -->
        <p>Ongkos Kirim: Rp <span id="ongkos-kirim">0</span></p>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required readonly>

        <label for="phone">Nomor HP:</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{10,13}" required>

        <label for="payment-category">Kategori Pembayaran:</label>
        <select id="payment-category" required onchange="showPaymentOptions()">
            <option value="" disabled selected>Pilih Kategori Pembayaran</option>
            <option value="e-wallet">E-Wallet</option>
            <option value="virtual-account">Virtual Account</option>
            <option value="debit-card">Credit/Debit Card</option>
            <option value="alfa-group">Alfindo</option>
        </select>

        <div id="e-wallet-options" style="display: none;">
            <label for="e-wallet">Pilih E-Wallet:</label>
            <select id="e-wallet" name="payment_method">
                <option value="" disabled selected>Pilih E-Wallet</option>
                <option value="qris">Qris</option>
                <option value="dana">Dana</option>
                <option value="ovo">OVO</option>
                <option value="link-aja">Link Aja</option>
                <option value="gopay">Gopay</option>
                <option value="shopee pay">ShopeePay</option>
                <option value="paylater">PayLater</option>
            </select>
        </div>

        <div id="virtual-account-options" style="display: none;">
            <label for="virtual-account">Pilih Virtual Account:</label>
            <select id="virtual-account" name="payment_method">
                <option value="" disabled selected>Pilih Virtual Account</option>
                <option value="bri">BRI</option>
                <option value="bni">BNI</option>
                <option value="mandiri">Mandiri</option>
                <option value="bca">BCA</option>
                <option value="other banks">Other banks</option>
                <option value="cimb niaga">CIMB NIAGA</option>
            </select>
        </div>

        <div id="debit-card-options" style="display: none;">
            <label for="debit-card">Pilih Debit Card:</label>
            <select id="debit-card" name="payment_method">
                <option value="" disabled selected>Pilih Debit Card</option>
                <option value="visa">Visa</option>
                <option value="jcb">Jcb</option>
            </select>
        </div>

        <div id="alfa-group-options" style="display: none;">
            <label for="alfa-group">Pilih Debit Card:</label>
            <select id="alfa-group" name="payment_method">
                <option value="" disabled selected>Pilih Alfindo</option>
                <option value="alfamart">Alfamart</option>
                <option value="alfamidi">Alfamidi</option>
                <option value="indomaret">Indomaret</option>
                <option value="dan dan">DAN-DAN</option>
            </select>
        </div>

        <button type="submit" id="pay-button" disabled>Konfirmasi Pembayaran</button>
    </form>
    
    </div>

    <footer class="footer">
        <p>&copy; 2024 Warung Ratu. All Rights Reserved.</p>
    </footer>

    <script>
         const kecamatanData = {
        martapura: [
            { name: "Martapura Timur", ongkir: 12000 },
            { name: "Martapura Barat", ongkir: 14000 },
            { name: "Martapura Kota", ongkir: 10000 },
        ],
        banjarbaru: [
            { name: "Banjarbaru Utara", ongkir: 15000 },
            { name: "Banjarbaru Selatan", ongkir: 16000 },
        ],
        banjarmasin: [
            { name: "Banjarmasin Timur", ongkir: 20000 },
            { name: "Banjarmasin Barat", ongkir: 21000 },
        ]
    };

    // Fungsi untuk memperbarui opsi kecamatan berdasarkan kota yang dipilih
    function updateSubLocationOptions() {
        const mainLocation = document.getElementById("main-location").value;
        const subLocationSelect = document.getElementById("sub-location");

        // Hapus opsi kecamatan sebelumnya
        subLocationSelect.innerHTML = '<option value="" disabled selected>Pilih Kecamatan</option>';

        // Tambahkan opsi kecamatan baru berdasarkan pilihan kota
        if (kecamatanData[mainLocation]) {
            kecamatanData[mainLocation].forEach(kecamatan => {
                const option = document.createElement("option");
                option.value = kecamatan.name;
                option.textContent = kecamatan.name;
                option.setAttribute("data-ongkir", kecamatan.ongkir);
                subLocationSelect.appendChild(option);
            });
        }

        // Reset ongkos kirim saat kota berubah
        document.getElementById("ongkos-kirim").innerText = "0";
    }

    // Fungsi untuk memperbarui ongkos kirim berdasarkan kecamatan yang dipilih
    function updateOngkosKirim() {
        const selectedOption = document.getElementById("sub-location").selectedOptions[0];
        const ongkir = selectedOption ? selectedOption.getAttribute("data-ongkir") : 0;
        document.getElementById("ongkos-kirim").innerText = ongkir;
    }

        function showPaymentOptions() {
        const category = document.getElementById("payment-category").value;
        const eWalletOptions = document.getElementById("e-wallet-options");
        const virtualAccountOptions = document.getElementById("virtual-account-options");
        const debitCardOptions = document.getElementById("debit-card-options");
        const alfaGroupOptions = document.getElementById("alfa-group-options");

        // Sembunyikan kedua opsi terlebih dahulu
        eWalletOptions.style.display = "none";
        virtualAccountOptions.style.display = "none";
        debitCardOptions.style.display = "none";
        alfaGroupOptions.style.display = "none";

        // Tampilkan opsi berdasarkan kategori yang dipilih
        if (category === "e-wallet") {
            eWalletOptions.style.display = "block";
        } else if (category === "virtual-account") {
            virtualAccountOptions.style.display = "block";
        } else if (category === "debit-card") {
            debitCardOptions.style.display = "block";
        } else if (category === "alfa-group") {
            alfaGroupOptions.style.display = "block";
        }
    }

    // Aktifkan tombol jika opsi dipilih
    document.querySelectorAll("#e-wallet, #virtual-account, #debit-card, #alfa-group").forEach(select => {
        select.addEventListener("change", function() {
            document.getElementById("pay-button").disabled = !this.value;
        });
    });
    </script>
    
</body>
</html>
