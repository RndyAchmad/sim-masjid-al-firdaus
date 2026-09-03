<x-layouts.admin>
    <x-slot name="title">Detail Artikel</x-slot>
    <x-slot name="backUrl">{{ route('admin.articles.index') }}</x-slot>

    <div class="max-w-4xl space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-sm space-y-6">
            <div class="flex items-center gap-3">
                <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-medium text-[#c49c4d]">Fiqih</span>
                <span class="text-xs text-gray-400">• Dipublikasi pada 02 Sep 2026</span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Keutamaan Menjaga Salat Berjamaah di Masjid</h1>

            <div class="overflow-hidden rounded-xl h-64 sm:h-80 w-full bg-gray-100">
                <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?w=800" alt="Cover"
                    class="h-full w-full object-cover">
            </div>

            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4 text-sm sm:text-base">
                <p class="font-semibold text-gray-800">Penjelasan mendalam mengenai pahala 27 derajat serta keutamaan
                    langkah kaki menuju masjid.</p>
                <p>Salat berjamaah di masjid memiliki keutamaan luar biasa bagi kaum muslimin. Dalam sebuah hadis
                    riwayat Bukhari dan Muslim, Rasulullah SAW bersabda bahwa salat berjamaah lebih utama daripada salat
                    sendirian sebanyak 27 derajat.</p>
                <p>Setiap langkah kaki seorang hamba menuju masjid untuk menunaikan salat akan diangkat derajatnya dan
                    dihapuskan dosa-dosanya.</p>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.articles.edit', 1) }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">
                    Edit Artikel
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>