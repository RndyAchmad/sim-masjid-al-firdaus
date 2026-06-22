<x-layouts.guest>
    <article class="bg-[#0B0B0B] text-white">

        {{-- Header Section --}}
        <section class="relative border-b border-white/5 bg-[#050505] pt-16 pb-32 sm:pt-24 sm:pb-40">
            <div
                class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#c49c4d]/10 via-[#0B0B0B] to-[#0B0B0B]">
            </div>

            <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                {{-- Tombol Kembali --}}
                <a href="{{ route('articles.index') }}"
                    class="group inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-xs font-semibold tracking-wider text-gray-300 uppercase transition-all duration-300 hover:border-[#c49c4d]/50 hover:text-[#c49c4d]">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>

                {{-- Judul Artikel --}}
                <h1
                    class="mt-8 font-serif text-3xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl lg:leading-[1.1] tracking-tight">
                    {{ $article['title'] }}
                </h1>

                {{-- Meta Data Penulis & Tanggal --}}
                <div class="mt-8 flex items-center justify-center gap-4 text-sm font-medium">
                    <div class="flex items-center gap-2 text-gray-300">
                        <svg class="h-4 w-4 text-[#c49c4d]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        {{ $article['author'] }}
                    </div>
                    <span class="h-1 w-1 rounded-full bg-[#c49c4d]"></span>
                    <div class="flex items-center gap-2 text-gray-400">
                        <svg class="h-4 w-4 text-[#c49c4d]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <time datetime="{{ $article['published_at'] }}">{{ $article['published_at'] }}</time>
                    </div>
                </div>
            </div>
        </section>

        {{-- Content Section --}}
        <section class="relative z-10 px-4 pb-20 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl"> {{-- Container diperkecil sedikit agar paragraf lebih enak dibaca --}}

                {{-- Container Gambar Utama --}}
                <div
                    class="-mt-24 overflow-hidden rounded-2xl border border-white/10 bg-black shadow-2xl shadow-black sm:-mt-32">
                    <img src="{{ asset($article['thumbnail']) }}" alt="{{ $article['title'] }}"
                        class="aspect-[16/9] w-full object-cover opacity-90">
                </div>

                {{-- Isi Paragraf Artikel --}}
                <div
                    class="mx-auto mt-16 max-w-3xl space-y-8 text-base leading-loose text-gray-300 sm:text-lg sm:leading-loose">
                    @foreach ($article['content'] as $paragraph)
                        <p class="tracking-wide text-left">{{ $paragraph }}</p>
                    @endforeach
                </div>

            </div>
        </section>

        {{-- Section Artikel Terkait --}}
        <section class="border-t border-white/5 bg-[#080808] py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                {{-- Header Artikel Terkait --}}
                <div class="mb-12 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-[#c49c4d]">
                            Bacaan Lainnya
                        </p>
                        <h2 class="mt-2 font-serif text-3xl font-bold text-white tracking-tight">
                            Artikel Terkait
                        </h2>
                    </div>

                    <a href="{{ route('articles.index') }}"
                        class="group inline-flex items-center gap-2 text-sm font-semibold text-gray-400 transition hover:text-[#c49c4d]">
                        Lihat semua artikel
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                {{-- Grid Cards Artikel Terkait --}}
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    @foreach ($relatedArticles as $relatedArticle)
                        <article
                            class="group relative flex flex-col rounded-2xl border border-white/5 bg-[#111] p-3 shadow-lg transition duration-300 hover:-translate-y-1 hover:border-[#c49c4d]/30 hover:bg-[#151515]">
                            <a href="{{ route('articles.show', $relatedArticle['slug']) }}"
                                class="block aspect-[16/10] w-full overflow-hidden rounded-xl bg-black">
                                <img src="{{ asset($relatedArticle['thumbnail']) }}"
                                    alt="{{ $relatedArticle['title'] }}"
                                    class="h-full w-full object-cover opacity-80 transition duration-500 group-hover:scale-105 group-hover:opacity-100">
                            </a>

                            <div class="flex flex-1 flex-col px-3 py-5">
                                <time datetime="{{ $relatedArticle['published_at'] }}"
                                    class="text-xs font-medium text-gray-500">
                                    {{ $relatedArticle['published_at'] }}
                                </time>

                                <h3
                                    class="mt-2 font-serif text-lg font-bold leading-snug text-white group-hover:text-[#c49c4d] transition duration-300">
                                    <a href="{{ route('articles.show', $relatedArticle['slug']) }}">
                                        <span class="absolute inset-0"></span>
                                        {{ $relatedArticle['title'] }}
                                    </a>
                                </h3>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </article>
</x-layouts.guest>
