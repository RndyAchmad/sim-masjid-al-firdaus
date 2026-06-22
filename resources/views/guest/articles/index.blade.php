<x-layouts.guest>
    {{-- Hero Section dengan efek Radial Gradient yang lebih halus --}}
    <section class="relative overflow-hidden border-b border-white/5 bg-[#050505] py-24 sm:py-32">
        <div
            class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#c49c4d]/10 via-[#0B0B0B] to-[#0B0B0B]">
        </div>

        <div class="relative mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span
                class="inline-flex items-center rounded-full border border-[#c49c4d]/30 bg-[#c49c4d]/10 px-3 py-1 text-xs font-bold uppercase tracking-widest text-[#c49c4d]">
                Bacaan Jamaah
            </span>
            <h1 class="mt-6 font-serif text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Artikel Keislaman
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-base leading-8 text-gray-400">
                Menuntut ilmu agama adalah jalan untuk memperbaiki ibadah, melembutkan hati, dan menumbuhkan akhlak yang
                baik dalam kehidupan sehari-hari.
            </p>
        </div>
    </section>

    {{-- Grid Artikel Section --}}
    <section class="bg-[#0B0B0B] py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($articles as $article)
                    <article
                        class="group relative flex flex-col rounded-2xl border border-white/5 bg-[#111] p-4 shadow-lg transition-all duration-300 hover:-translate-y-1 hover:border-[#c49c4d]/30 hover:bg-[#151515] hover:shadow-[#c49c4d]/5">
                        {{-- Thumbnail --}}
                        <a href="{{ route('articles.show', $article['slug']) }}"
                            class="block aspect-[16/10] w-full overflow-hidden rounded-xl bg-black">
                            <img src="{{ asset($article['thumbnail']) }}" alt="{{ $article['title'] }}"
                                class="h-full w-full object-cover opacity-80 transition duration-500 group-hover:scale-105 group-hover:opacity-100">
                        </a>

                        <div class="flex flex-1 flex-col pt-6 pb-2 px-2">
                            {{-- Meta Info --}}
                            <div class="mb-3 flex items-center gap-2 text-xs font-medium text-gray-400">
                                <span>{{ $article['author'] }}</span>
                                <span class="h-1 w-1 rounded-full bg-[#c49c4d]"></span>
                                <time datetime="{{ $article['published_at'] }}">{{ $article['published_at'] }}</time>
                            </div>

                            {{-- Title --}}
                            <h2
                                class="font-serif text-xl font-bold leading-snug text-white group-hover:text-[#c49c4d] transition-colors duration-300">
                                <a href="{{ route('articles.show', $article['slug']) }}">
                                    <span class="absolute inset-0"></span> {{-- Membuat seluruh card bisa diklik --}}
                                    {{ $article['title'] }}
                                </a>
                            </h2>

                            {{-- Excerpt --}}
                            <p class="mt-3 flex-1 text-sm leading-relaxed text-gray-400 line-clamp-3">
                                {{ $article['excerpt'] }}
                            </p>

                            {{-- Read More Link (Lebih elegan dari tombol) --}}
                            <div class="mt-6 flex items-center text-sm font-semibold text-[#c49c4d]">
                                Baca Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="ml-1 h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.guest>
