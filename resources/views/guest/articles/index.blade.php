<x-layouts.guest>
    {{-- Header Banner Halaman Artikel (Gaya Gelap Elegan) --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20 border-b border-gray-800">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Syiar & Literasi
            </span>
            <h1
                class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                Artikel Keislaman
            </h1>
            <p class="mt-2 text-xs text-gray-400 sm:mt-3 sm:text-sm md:text-base">
                Kumpulan tulisan, wawasan, dan nasehat islami dari Takmir Masjid Al-Firdaus
            </p>
            <div
                class="mx-auto mt-4 h-px w-16 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent sm:mt-6 sm:w-20">
            </div>
        </div>
    </div>

    {{-- Main Content Section (Background Krem Sejuk / Off-White Sama Seperti Kegiatan) --}}
    <div class="bg-[#FBF9F5] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header Section (Rata Tengah) --}}
            <div class="mb-10 text-center max-w-3xl mx-auto sm:mb-12">
                <span
                    class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-3">
                    Kajian & Risalah
                </span>
                <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">
                    Daftar Artikel
                </h2>
                <p class="mt-2 text-xs text-gray-600 sm:text-sm md:text-base">
                    Simak berbagai artikel dan tulisan edukasi keislaman terbaru untuk menambah wawasan jamaah.
                </p>
            </div>

            {{-- Grid Daftar Artikel --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                @forelse ($articles as $article)
                    <div
                        class="flex flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-[#8c6b2d] hover:shadow-xl">

                        {{-- Thumbnail --}}
                        <div class="relative aspect-video w-full overflow-hidden border-b border-stone-200 bg-stone-100">
                            @if ($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-300 hover:scale-105">
                            @else
                                <div class="flex h-full w-full items-center justify-center">
                                    <span class="text-sm text-stone-400">Tidak ada gambar</span>
                                </div>
                            @endif
                        </div>

                        {{-- Konten Artikel --}}
                        <div class="flex flex-1 flex-col justify-between bg-white p-5 sm:p-6">
                            <div>
                                {{-- Tanggal dan Kategori --}}
                                <div
                                    class="flex flex-wrap items-center gap-x-3 gap-y-2 text-xs font-semibold text-[#8c6b2d]">
                                    <span>
                                        {{ $article->created_at?->translatedFormat('d F Y') ?? '-' }}
                                    </span>

                                    @if ($article->category)
                                        <span class="rounded-full bg-[#f5efe2] px-2.5 py-1">
                                            {{ $article->category }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Judul --}}
                                <h3 class="mt-3 line-clamp-2 font-serif text-lg font-bold text-gray-900 sm:text-xl">
                                    {{ $article->title }}
                                </h3>

                                {{-- Ringkasan --}}
                                <p class="mt-2 line-clamp-3 text-xs text-gray-600 sm:text-sm">
                                    {{ $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 180) }}
                                </p>
                            </div>

                            {{-- Penulis dan Tombol --}}
                            <div class="mt-6 space-y-3 border-t border-stone-100 pt-4">
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-stone-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM5 21a7 7 0 0114 0H5z" />
                                    </svg>

                                    <span>
                                        Penulis:
                                        <strong class="text-gray-800">
                                            {{ $article->author ?: 'Pengurus Masjid' }}
                                        </strong>
                                    </span>
                                </div>

                                <a href="{{ route('articles.show', ['slug' => $article->slug]) }}"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#8c6b2d] px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-[#6e5321]">
                                    Baca Artikel

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="rounded-2xl border border-stone-200 bg-white px-6 py-12 text-center sm:col-span-2 lg:col-span-3">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#f5efe2]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#8c6b2d]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.5v11m-5.5-5.5h11M4 4h16v16H4z" />
                            </svg>
                        </div>

                        <h3 class="mt-4 font-serif text-lg font-bold text-gray-900">
                            Belum Ada Artikel
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Artikel keislaman akan ditampilkan di halaman ini setelah diterbitkan.
                        </p>
                    </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            @if ($articles->hasPages())
                <div class="mt-10">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.guest>