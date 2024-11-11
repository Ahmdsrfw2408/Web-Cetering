<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tailwind Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Sidebar -->
    <div class="flex min-h-screen">
        <aside id="sidebar" class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-200">
            <div class="text-center">
                <h5 class="text-lg font-semibold mt-2">Warung Ratu</h5>
            </div>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-600">
                    <i class="fa fa-home mr-2"></i> Dashboard
                </a>

                <div class="mt-2">
                    <button onclick="toggleDropdown('masterDropdown', 'masterArrow')" class="w-full text-left block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-600">
                        <i class="fa fa-briefcase mr-2"></i> Data Master
                        <i id="masterArrow" class="fa fa-chevron-right transition-transform duration-200"></i>
                    </button>
                    <div id="masterDropdown" class="ml-4 space-y-2 hidden">
                        <a href="{{ route('admin.products.index') }}" class="block py-1 px-2 text-gray-300 hover:text-white">Makanan</a>
                        <a href="{{ route('admin.products.kelola') }}" class="block py-1 px-2 text-gray-300 hover:text-white">Kelola Pesanan</a>
                    </div>
                </div>
                <div class="mt-2">
                    <button onclick="toggleDropdown('laporanDropdown', 'laporanArrow')" class="w-full text-left block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-600">
                        <i class="fa fa-chart-line mr-2"></i> Data Laporan
                        <i id="laporanArrow" class="fa fa-chevron-right transition-transform duration-200"></i>
                    </button>
                    <div id="laporanDropdown" class="ml-4 space-y-2 hidden">
                        <a href="{{ route('reports.customers') }}" class="block py-1 px-2 text-gray-300 hover:text-white">Laporan Pelanggan</a>
                        <a href="{{ route('reports.orders') }}" class="block py-1 px-2 text-gray-300 hover:text-white">Laporan Pesanan</a>
                        <a href="{{ route('reports.products') }}" class="block py-1 px-2 text-gray-300 hover:text-white">Laporan Makanan</a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 md:ml-64">
            <!-- Navbar -->
            <header class="bg-white shadow-md py-4 px-6 flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-700">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <button onclick="toggleSidebar()" class="text-gray-700 md:hidden">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Page content -->
            <div class="p-6">
                <section class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Dashboard</h2>
                    <p class="text-gray-600 mt-2">@yield('content')</p>
                </section>
            </div>

            <!-- Footer -->
            <footer class="bg-white text-center py-4">
                <p class="text-gray-600">&copy; 2024 Tailwind Admin. All Rights Reserved.</p>
            </footer>
        </main>
    </div>

    <!-- Tailwind Script -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/jit-cdn"></script>
    <script>
        function toggleDropdown(id, arrowId) {
            const dropdown = document.getElementById(id);
            const arrow = document.getElementById(arrowId);
            dropdown.classList.toggle("hidden");
            arrow.classList.toggle("fa-chevron-right");
            arrow.classList.toggle("fa-chevron-down");
        }

        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("-translate-x-full");
        }
    </script>
</body>

</html>
