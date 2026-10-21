<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{'Admin Masjid Al-Firdaus' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tambahkan Alpine.js jika belum ada di file app.js kamu -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<!-- x-data="sidebarOpen: false" digunakan untuk mengontrol sidebar di mode HP -->

<body class="bg-gray-50 font-sans text-gray-800 antialiased" x-data="{ sidebarOpen: false }">

    <!-- Komponen Sidebar -->
    <x-admin.sidebar />

    <!-- Wrapper Konten Utama (Bergeser ke kanan jika di laptop) -->
    <div class="flex min-h-screen flex-col transition-all duration-300 lg:ml-64">

        <!-- Komponen Navbar -->
        <x-admin.navbar :title="$title ?? 'Dashboard'" :back-url="$backUrl ?? null" />

        <!-- Area Konten Utama -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            {{ $slot }}
        </main>

        <!-- Komponen Footer -->
        <x-admin.footer />

    </div>

    @stack('scripts')
    {{-- SweetAlert2: Flash Notification --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(session('success')),
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#c49c4d',
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: @json(session('error')),
                    confirmButtonText: 'Mengerti',
                    confirmButtonColor: '#c49c4d',
                });
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-confirm]').forEach((form) => {
                form.addEventListener('submit', async (event) => {
                    event.preventDefault();

                    const title = form.dataset.confirmTitle
                        || 'Yakin ingin melanjutkan?';

                    const text = form.dataset.confirm
                        || 'Tindakan ini tidak dapat dibatalkan.';

                    const result = await Swal.fire({
                        icon: 'warning',
                        title: title,
                        text: text,
                        showCancelButton: true,
                        confirmButtonText: 'Ya, lanjutkan',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        reverseButtons: true,
                        focusCancel: true,
                    });

                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>