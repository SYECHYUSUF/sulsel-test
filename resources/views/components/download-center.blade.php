<section id="download" class="py-12 md:py-24 bg-white font-['Plus_Jakarta_Sans']">
    <div class="container mx-auto px-4">
        {{-- Section Header - Tipografi Adaptif --}}
        <div class="text-center mb-12 md:mb-16 max-w-3xl mx-auto" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 mb-4 px-5 py-2.5 bg-[#D4AF37]/10 border border-[#D4AF37]/30 rounded-full shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[#D4AF37]">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/>
                </svg>
                <span class="text-[#1A305E] text-xs md:text-sm font-bold tracking-wide uppercase">Download Center</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold text-[#1A305E] mb-4 leading-tight">Formulir & Dokumen</h2>
            <p class="text-base md:text-xl text-[#4A5568] leading-relaxed">Unduh formulir dan panduan yang Anda butuhkan untuk layanan PPID</p>
        </div>

        {{-- Grid: 1 Kolom (Mobile) -> 2 Kolom (Tablet) -> 4 Kolom (Desktop) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
            @php
                $docs = [
                    [
                        'title' => 'Formulir Permohonan Informasi', 
                        'desc' => 'Formulir resmi untuk mengajukan permohonan informasi publik', 
                        'icon' => '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>',
                        'size' => '245 KB'
                    ],
                    [
                        'title' => 'Formulir Pengajuan Keberatan', 
                        'desc' => 'Formulir untuk mengajukan keberatan atas permohonan informasi', 
                        'icon' => '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
                        'size' => '198 KB'
                    ],
                    [
                        'title' => 'Panduan Layanan PPID', 
                        'desc' => 'Panduan lengkap tata cara permohonan informasi publik', 
                        'icon' => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>',
                        'size' => '1.2 MB'
                    ],
                    [
                        'title' => 'Maklumat Pelayanan', 
                        'desc' => 'Maklumat pelayanan informasi publik PPID Sulawesi Selatan', 
                        'icon' => '<path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17"/><path d="m7 11 6-6"/><path d="m3 21 3-3"/><path d="M20.9 18.5 21 17a2 2 0 0 0-2-2h-3"/><path d="M21 14V5a2 2 0 0 0-2-2H5"/>',
                        'size' => '324 KB'
                    ],
                ];
            @endphp

            @foreach($docs as $index => $doc)
            <div data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" class="group bg-white rounded-3xl shadow-lg hover:shadow-[0_20px_50px_-10px_rgba(26,48,94,0.15)] transition-all duration-300 border border-gray-100 hover:border-[#D4AF37]/50 overflow-hidden hover:-translate-y-2 flex flex-col">
                <div class="bg-[#1A305E] p-6 relative overflow-hidden text-white group-hover:bg-[#15264a] transition-colors">
                    {{-- Decorative Gold Pattern --}}
                    <div class="absolute top-0 right-0 w-24 h-24 bg-[#D4AF37]/10 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-125 transition-transform duration-500"></div>
                    
                    <div class="relative w-12 h-12 md:w-14 md:h-14 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110 border border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="text-[#D4AF37]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            {!! $doc['icon'] !!}
                        </svg>
                    </div>
                    <div class="flex items-center gap-2 text-white/70 text-[10px] md:text-xs font-semibold uppercase tracking-wider">
                        <span class="bg-[#D4AF37]/20 px-2 py-0.5 rounded text-[#D4AF37]">PDF</span>
                        <span>•</span>
                        <span>{{ $doc['size'] }}</span>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-base md:text-lg font-bold text-[#1A305E] mb-2 leading-tight group-hover:text-[#D4AF37] transition-colors">{{ $doc['title'] }}</h3>
                    <p class="text-sm md:text-base text-[#4A5568] leading-relaxed mb-6 flex-grow">{{ $doc['desc'] }}</p>
                    <button class="w-full bg-[#fafafa] border border-gray-200 hover:border-[#D4AF37] hover:bg-[#D4AF37] hover:text-[#1A305E] text-[#1A305E] px-5 py-3 rounded-xl font-bold text-sm transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 group/btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="group-hover/btn:translate-y-0.5 transition-transform"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        <span>Download</span>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>