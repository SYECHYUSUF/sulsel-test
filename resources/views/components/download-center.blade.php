<section id="informasi" class="py-8 md:py-16 bg-white dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
    <div class="container mx-auto px-4">
        {{-- Section Header - Tipografi Adaptif --}}
        <div class="text-center mb-12 md:mb-16 max-w-3xl mx-auto" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 mb-4 px-5 py-2.5 bg-[#D4AF37]/10 border border-[#D4AF37]/30 rounded-full shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[#D4AF37]">
                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                </svg>
                <span class="text-[#1A305E] dark:text-gray-200 text-xs md:text-sm font-bold tracking-wide uppercase">Akses Cepat</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold text-[#1A305E] dark:text-white mb-4 leading-tight">Informasi & Layanan</h2>
            <p class="text-base md:text-xl text-[#4A5568] dark:text-gray-300 leading-relaxed">Akses mudah ke berbagai layanan dan informasi PPID</p>
        </div>

        {{-- Grid: 1 Kolom (Mobile) -> 2 Kolom (Tablet) -> 4 Kolom (Desktop) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
            @php
                $cards = [
                    [
                        'title' => 'Berita & Informasi', 
                        'desc' => 'Baca berita terkini dan update informasi dari PPID Sulawesi Selatan', 
                        'icon' => '<path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>',
                        'url' => '/berita',
                        'badge' => 'Berita'
                    ],
                    [
                        'title' => 'Profil PPID', 
                        'desc' => 'Pelajari lebih lanjut tentang profil, visi misi, dan struktur organisasi PPID', 
                        'icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
                        'url' => '/profil-ppid',
                        'badge' => 'Profil'
                    ],
                    [
                        'title' => 'PPID Pelaksana', 
                        'desc' => 'Temukan kontak dan informasi PPID Pelaksana di berbagai SKPD Provinsi Sulsel', 
                        'icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87m0-4.13a4 4 0 0 1 0 7.75"/>',
                        'url' => '/ppid-pelaksana',
                        'badge' => 'Kontak'
                    ],
                    [
                        'title' => 'Standar Operasional', 
                        'desc' => 'Lihat SOP dan prosedur pelayanan informasi publik PPID', 
                        'icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>',
                        'url' => '/layanan/sop',
                        'badge' => 'Panduan'
                    ],
                ];
            @endphp

            @foreach($cards as $index => $card)
            <a href="{{ $card['url'] }}" 
               data-aos="fade-up" 
               data-aos-delay="{{ $index * 100 }}" 
               class="group bg-white dark:bg-slate-800 rounded-3xl overflow-hidden shadow-lg hover:shadow-[0_20px_50px_-10px_rgba(26,48,94,0.15)] transition-all duration-300 border border-gray-100 dark:border-slate-700 hover:border-[#D4AF37]/50 flex flex-col h-full hover:-translate-y-2">
                <div class="bg-[#1A305E] p-6 relative overflow-hidden text-white group-hover:bg-[#15264a] transition-colors shrink-0">
                    {{-- Decorative Gold Pattern --}}
                    <div class="absolute top-0 right-0 w-24 h-24 bg-[#D4AF37]/10 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-125 transition-transform duration-500"></div>
                    
                    <div class="relative w-12 h-12 md:w-14 md:h-14 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110 border border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="text-[#D4AF37]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            {!! $card['icon'] !!}
                        </svg>
                    </div>
                    <div class="flex items-center gap-2 text-white/70 text-[10px] md:text-xs font-semibold uppercase tracking-wider">
                        <span class="bg-[#D4AF37]/20 px-2 py-0.5 rounded text-[#D4AF37]">{{ $card['badge'] }}</span>
                        <span>•</span>
                        <span>PPID Sulsel</span>
                    </div>
                </div>
                
                <div class="p-6 md:p-8 flex flex-col flex-grow">
                    <h3 class="text-lg md:text-xl font-bold text-[#1A305E] dark:text-white mb-3 group-hover:text-[#D4AF37] transition-colors leading-tight">
                        {{ $card['title'] }}
                    </h3>
                    <p class="text-sm md:text-base text-[#4A5568] dark:text-slate-300 leading-relaxed mb-6 flex-grow wrap-break-word">
                        {{ $card['desc'] }}
                    </p>
                    <div class="w-full bg-[#fafafa] dark:bg-slate-700 border border-gray-200 dark:border-slate-600 group-hover:border-[#D4AF37] group-hover:bg-[#D4AF37] group-hover:text-[#1A305E] text-[#1A305E] dark:text-white px-5 py-3 rounded-xl font-bold text-sm transition-all shadow-sm group-hover:shadow-md flex items-center justify-center gap-2 mt-auto">
                        <span>Akses Sekarang</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="group-hover:translate-x-1 transition-transform">
                            <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>