<section class="py-12 md:py-[89px] bg-gray-50 font-['Plus_Jakarta_Sans'] transition-all">
    <div class="container mx-auto px-4">
        
        {{-- Section Header --}}
        <div class="text-center mb-10 md:mb-[55px] max-w-3xl mx-auto" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 mb-[13px] px-4 py-1.5 md:px-5 md:py-2 bg-violet-100 border border-violet-200 rounded-full">
                <span class="w-2 h-2 bg-violet-600 rounded-full animate-pulse"></span>
                <span class="text-violet-700 text-[9px] md:text-[10px] font-black uppercase tracking-widest">Berita Terkini</span>
            </div>
            <h2 class="text-2xl md:text-[42px] font-extrabold text-gray-900 mb-4 md:mb-[21px] leading-tight tracking-tight">
                Informasi & Berita Terbaru
            </h2>
            <p class="text-base md:text-lg text-gray-600">Update terbaru seputar layanan informasi publik di Sulawesi Selatan</p>
        </div>

        {{-- News Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-[34px] max-w-7xl mx-auto">
            @php
                $news = [
                    ['title' => 'Peningkatan Transparansi Informasi di Sulsel', 'cat' => 'Berita', 'date' => '16 Jan 2026', 'img' => 'https://images.unsplash.com/photo-1663580109859-b63aafcb275e?q=80&w=800'],
                    ['title' => 'Rapat Koordinasi PPID se-Sulawesi Selatan', 'cat' => 'Pengumuman', 'date' => '15 Jan 2026', 'img' => 'https://images.unsplash.com/photo-1627488043116-f66f15a31bfe?q=80&w=800'],
                    ['title' => 'Penghargaan Keterbukaan Informasi Publik 2025', 'cat' => 'Berita', 'date' => '14 Jan 2026', 'img' => 'https://images.unsplash.com/photo-1734548798173-e9348223d094?q=80&w=800'],
                ];
            @endphp

            @foreach($news as $index => $item)
            <div data-aos="fade-up" data-aos-delay="{{ $index * 150 }}" class="group bg-white rounded-[21px] overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 flex flex-col">
                <div class="relative aspect-[1.618/1] overflow-hidden">
                    <img src="{{ $item['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $item['title'] }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="absolute top-4 left-4 md:top-[21px] md:left-[21px]">
                        <span class="px-3 py-1.5 md:px-4 md:py-2 bg-violet-600 text-white text-[9px] md:text-[10px] font-bold rounded-lg shadow-lg">
                            {{ $item['cat'] }}
                        </span>
                    </div>
                </div>

                <div class="p-6 md:p-[34px] flex-grow flex flex-col">
                    <div class="flex items-center gap-2 text-gray-400 text-xs mb-3 md:mb-[13px] font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                        {{ $item['date'] }}
                    </div>
                    <h3 class="text-lg md:text-[21px] font-bold text-gray-900 mb-6 md:mb-[21px] leading-snug group-hover:text-violet-600 transition-colors line-clamp-2">
                        {{ $item['title'] }}
                    </h3>
                    
                    <div class="mt-auto">
                        <a href="#" class="inline-flex items-center gap-2 text-violet-600 font-bold text-sm group/btn">
                            <span>Baca Selengkapnya</span>
                            <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>