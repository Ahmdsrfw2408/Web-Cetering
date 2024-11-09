document.addEventListener("DOMContentLoaded", function () {
    // Ambil total harga dari localStorage
    const totalPrice = localStorage.getItem("totalPrice");

    // Debugging jika total harga tidak tersimpan di localStorage
    if (!totalPrice) {
        console.error("Total harga tidak ditemukan di localStorage.");
    }

    // Tampilkan total harga di halaman
    const paymentTotalElement = document.getElementById("payment-total");
    paymentTotalElement.textContent = totalPrice || "0";

    const paymentMethodSelect = document.getElementById("payment-method");
    const bankSelection = document.getElementById("bank-selection");
    const printReceiptBtn = document.getElementById("print-receipt");
    const closeModalBtn = document.getElementById("close-modal"); // Tombol untuk menutup modal
    const paymentForm = document.getElementById("payment-form");
    const confirmPaymentBtn = document.getElementById("confirm-payment");
    const paymentModal = document.getElementById("payment-modal");

    // Menampilkan atau menyembunyikan pilihan bank dan nomor rekening
    paymentMethodSelect.addEventListener("change", function () {
        if (this.value === "bank_transfer") {
            bankSelection.style.display = "block";
        } else {
            bankSelection.style.display = "none";
        }
    });

    // Aktifkan tombol konfirmasi jika semua input valid
    paymentForm.addEventListener("input", () => {
        confirmPaymentBtn.disabled = !paymentForm.checkValidity();
    });

    // Event listener untuk konfirmasi pembayaran dan menampilkan modal
    paymentForm.addEventListener("submit", (e) => {
        e.preventDefault(); // Mencegah reload halaman

        // Ambil data dari form dan tampilkan di modal
        document.getElementById("modal-name").textContent =
            document.getElementById("name").value;
        document.getElementById("modal-altujuan").textContent =
            document.getElementById("altujuan").value;
        document.getElementById("modal-email").textContent =
            document.getElementById("email").value;
        document.getElementById("modal-phone").textContent =
            document.getElementById("phone").value;
        document.getElementById("modal-method").textContent =
            paymentMethodSelect.value;
        document.getElementById("modal-total").textContent = totalPrice || "0";

        paymentModal.style.display = "flex"; // Tampilkan modal
    });

    // Fungsi cetak struk
    if (printReceiptBtn) {
        printReceiptBtn.addEventListener("click", () => {
            window.print();
        });
    }

    // Event listener untuk menutup modal saat tombol "Tutup" diklik
    if (closeModalBtn) {
        closeModalBtn.addEventListener("click", () => {
            paymentModal.style.display = "none"; // Sembunyikan modal
            localStorage.removeItem("totalPrice"); // Hapus data total harga
            window.location.href = "/home"; // Redirect ke halaman utama
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Ambil data dari localStorage
    const totalPrice = localStorage.getItem("totalPrice");
    const cartItems = JSON.parse(localStorage.getItem("cartItems"));

    // Tampilkan total harga
    document.getElementById("payment-total").textContent = totalPrice || "0";

    // Jika ingin menampilkan daftar produk yang dibeli di halaman pembayaran
    const itemsList = document.getElementById("cart-items");
    cartItems.forEach((item) => {
        const listItem = document.createElement("li");
        listItem.textContent = `Produk ID: ${item.product_id}, Jumlah: ${item.quantity}`;
        itemsList.appendChild(listItem);
    });
});

document
    .getElementById("payment-form")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Mencegah reload halaman

        const cartItems = JSON.parse(localStorage.getItem("cartItems"));
        const paymentMethod = document.getElementById("payment-method").value;

        // Mengirim data ke server menggunakan AJAX
        fetch("/payment/process", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({
                name: document.getElementById("name").value,
                altujuan: document.getElementById("altujuan").value,
                email: document.getElementById("email").value,
                phone: document.getElementById("phone").value,
                payment_method: paymentMethod,
                cart_items: cartItems,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    window.location.href = "/payment/success"; // Arahkan ke halaman sukses
                } else {
                    alert(
                        "Terjadi kesalahan saat memproses pembayaran: " +
                            data.error
                    );
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
