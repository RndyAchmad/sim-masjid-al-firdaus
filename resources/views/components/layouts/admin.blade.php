<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin - Masjid Al-Firdaus' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tambahkan Alpine.js jika belum ada di file app.js kamu -->
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
</head>

<!-- x-data="sidebarOpen: false" digunakan untuk mengontrol sidebar di mode HP -->

<body class="bg-gray-50 font-sans text-gray-800 antialiased" x-data="{ sidebarOpen: false }">

    <!-- Komponen Sidebar -->
    <x-admin.sidebar />

    <!-- Wrapper Konten Utama (Bergeser ke kanan jika di laptop) -->
    <div class="flex min-h-screen flex-col transition-all duration-300 lg:ml-64">

        <!-- Komponen Navbar -->
        <x-admin.navbar :title="$title ?? 'Dashboard'" />

        <!-- Area Konten Utama -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            {{ $slot }}
        </main>

        <!-- Komponen Footer -->
        <x-admin.footer />

    </div>

    @stack('scripts')
</body>

</html>