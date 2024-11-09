document.addEventListener("DOMContentLoaded", function () {
    const cartBtn = document.getElementById("cart-btn");
    const cartModal = document.getElementById("cart-modal");
    const closeCartBtn = document.getElementById("close-cart");
    const cartItemsList = document.getElementById("cart-items");
    const cartTotal = document.getElementById("cart-total");
    const cartCount = document.getElementById("cart-count");
    const modalOverlay = document.getElementById("modal-overlay");
    const menuToggle = document.getElementById("menu-toggle");
    const navLinks = document.getElementById("nav-links");
    const checkoutBtn = document.getElementById("checkout-btn");
    const buttons = document.querySelectorAll(".filter-btn");
    const items = document.querySelectorAll(".menu-item");

    // **Toggle menu (Hamburger)**
    menuToggle.addEventListener("click", function () {
        navLinks.classList.toggle("show");
    });

    // **Event listeners untuk link di navbar**
    const menuLinks = document.querySelectorAll(".nav-links a");
    menuLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            const targetId = link.getAttribute("data-target");

            if (targetId) {
                e.preventDefault(); // Hanya cegah *default* jika ada `data-target`
                navigateToSection(targetId);
            }
        });
    });

    function navigateToSection(targetId) {
        document.querySelectorAll(".section").forEach((section) => {
            section.classList.remove("active");
        });

        const targetSection = document.getElementById(targetId);
        if (targetSection) {
            targetSection.classList.add("active");
        }
    }

    // **Checkout button redirect**
    checkoutBtn.addEventListener("click", function () {
        console.log("Tombol checkout ditekan");
        window.location.href = "/payment"; // Redirect ke halaman pembayaran
    });

    // **Tambah produk ke keranjang**
    document.querySelectorAll(".add-to-cart").forEach((button) => {
        button.addEventListener("click", function () {
            const menuItem = this.closest(".menu-item");
            const productId = menuItem.getAttribute("data-id");
            const price = menuItem.getAttribute("data-price");

            // Send AJAX request to add item to cart
            fetch("/cart/add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ id: productId, price: price }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("Produk berhasil ditambahkan ke keranjang");
                    } else {
                        alert("Gagal menambahkan produk ke keranjang");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    });

    // **Buka modal keranjang dan tampilkan item**
    cartBtn.addEventListener("click", function () {
        openCartModal();
        fetchCartItems();
    });

    closeCartBtn.addEventListener("click", closeModal);
    modalOverlay.addEventListener("click", closeModal);

    function fetchCartItems() {
        fetch("/cart")
            .then((response) => response.json())
            .then((data) => {
                renderCartItems(data.carts);
                cartTotal.textContent = data.totalPrice.toLocaleString("id-ID");
            })
            .catch((error) => console.error("Error:", error));
    }

    function fetchCartCount() {
        fetch("/cart")
            .then((response) => response.json())
            .then((data) => {
                cartCount.textContent = data.carts.length;
            })
            .catch((error) => console.error("Error:", error));
    }

    function renderCartItems(carts) {
        cartItemsList.innerHTML = "";
        carts.forEach((cart) => {
            const li = document.createElement("li");
            li.innerHTML = `
                <span>${cart.product.name}</span>
                <span>Rp ${cart.product.price.toLocaleString("id-ID")}</span>
                <button class="decrease-quantity" data-id="${
                    cart.id
                }">-</button>
                <span>${cart.quantity}</span>
                <button class="increase-quantity" data-id="${
                    cart.id
                }">+</button>
                <button class="remove-item" data-id="${cart.id}">Hapus</button>
            `;
            cartItemsList.appendChild(li);
        });

        attachCartEventListeners();
    }

    function attachCartEventListeners() {
        document.querySelectorAll(".decrease-quantity").forEach((button) => {
            button.addEventListener("click", function () {
                const cartId = this.getAttribute("data-id");
                changeQuantity(cartId, -1);
            });
        });

        document.querySelectorAll(".increase-quantity").forEach((button) => {
            button.addEventListener("click", function () {
                const cartId = this.getAttribute("data-id");
                changeQuantity(cartId, 1);
            });
        });

        document.querySelectorAll(".remove-item").forEach((button) => {
            button.addEventListener("click", function () {
                const cartId = this.getAttribute("data-id");
                removeItem(cartId);
            });
        });
    }

    function changeQuantity(cartId, change) {
        fetch(`/cart/${cartId}/update`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ quantity: change }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    fetchCartItems();
                } else {
                    alert("Gagal memperbarui jumlah: " + data.message);
                }
            })
            .catch((error) => console.error("Error:", error));
    }

    function removeItem(cartId) {
        fetch(`/cart/${cartId}/remove`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then(() => fetchCartItems())
            .catch((error) => console.error("Error:", error));
    }

    function openCartModal() {
        cartModal.classList.remove("hidden");
        modalOverlay.classList.remove("hidden");
    }

    function closeModal() {
        cartModal.classList.add("hidden");
        modalOverlay.classList.add("hidden");
    }

    // Fetch initial cart count when the page loads
    fetchCartCount();
});

document.getElementById("checkout-btn").addEventListener("click", function () {
    window.location.href = "/cart/checkout"; // Arahkan ke controller checkout
});

buttons.forEach((button) => {
    button.addEventListener("click", function () {
        const category = this.getAttribute("data-category");

        items.forEach((item) => {
            if (
                item.getAttribute("data-category") === category ||
                category === "all"
            ) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    });
});

button.addEventListener("click", () => {
    const selectedCategory = button.getAttribute("data-category");
    console.log(`Tombol kategori '${selectedCategory}' diklik`);

    document.querySelectorAll(".menu-item").forEach((item) => {
        const itemCategory = item.getAttribute("data-category");
        console.log(`Produk kategori: ${itemCategory}`);
        if (itemCategory === selectedCategory) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
});
