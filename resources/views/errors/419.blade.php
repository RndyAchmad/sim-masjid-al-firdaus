<x-layouts.guest>
    <div class="min-h-[75vh] flex items-center justify-center px-4 py-16 bg-white">
        <div class="max-w-xl w-full text-center">
            <span
                class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold tracking-wide uppercase bg-amber-50 text-amber-600 border border-amber-200 mb-4">
                Error 419
            </span>

            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-3">
                Sesi Halaman Berakhir
            </h1>

            <p class="text-gray-600 text-base sm:text-lg mb-8 leading-relaxed">
                Sesi form Anda telah kadaluarsa karena terlalu lama tidak ada aktivitas. Silakan muat ulang halaman.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <button onclick="window.location.reload()"
                    class="w-full sm:w-auto px-6 py-3 bg-amber-500 hover:bg-amber-600 text-black font-semibold rounded-lg shadow-sm transition">
                    Muat Ulang Halaman
                </button>
                <a href="{{ url('/') }}"
                    class="w-full sm:w-auto px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-lg transition border border-gray-200">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-layouts.guest>
