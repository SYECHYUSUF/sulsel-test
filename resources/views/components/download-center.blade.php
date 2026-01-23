<section id="download" class="py-8 md:py-16 bg-white dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
    <div class="container mx-auto px-4">
        {{-- Section Header - Tipografi Adaptif --}}
        <div class="text-center mb-12 md:mb-16 max-w-3xl mx-auto" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 mb-4 px-5 py-2.5 bg-[#D4AF37]/10 border border-[#D4AF37]/30 rounded-full shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[#D4AF37]">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/>
                </svg>
                <span class="text-[#1A305E] dark:text-gray-200 text-xs md:text-sm font-bold tracking-wide uppercase">{{ __('messages.download.badge') }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold text-[#1A305E] dark:text-white mb-4 leading-tight">{{ __('messages.download.title') }}</h2>
            <p class="text-base md:text-xl text-[#4A5568] dark:text-gray-300 leading-relaxed">{{ __('messages.download.subtitle') }}</p>
        </div>

        {{-- Grid: 1 Kolom (Mobile) -> 2 Kolom (Tablet) -> 4 Kolom (Desktop) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
            @php
                $docs = [
                    [
                        'title' => 'messages.download.doc1_title', 
                        'desc' => 'messages.download.doc1_desc', 
                        'icon' => '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>',
                        'size' => '245 KB'
                    ],
                    [
                        'title' => 'messages.download.doc2_title', 
                        'desc' => 'messages.download.doc2_desc', 
                        'icon' => '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
                        'size' => '198 KB'
                    ],
                    [
                        'title' => 'messages.download.doc3_title', 
                        'desc' => 'messages.download.doc3_desc', 
                        'icon' => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>',
                        'size' => '1.2 MB'
                    ],
                    [
                        'title' => 'messages.download.doc4_title', 
                        'desc' => 'messages.download.doc4_desc', 
                        'icon' => '<path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17"/><path d="m7 11 6-6"/><path d="m3 21 3-3"/><path d="M20.9 18.5 21 17a2 2 0 0 0-2-2h-3"/><path d="M21 14V5a2 2 0 0 0-2-2H5"/>',
                        'size' => '324 KB'
                    ],
                ];
            @endphp

            @foreach($docs as $index => $doc)
            <div data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" class="group bg-white dark:bg-slate-800 rounded-3xl overflow-hidden shadow-lg hover:shadow-[0_20px_50px_-10px_rgba(26,48,94,0.15)] transition-all duration-300 border border-gray-100 dark:border-slate-700 hover:border-[#D4AF37]/50 flex flex-col h-full hover:-translate-y-2">
                <div class="bg-[#1A305E] p-6 relative overflow-hidden text-white group-hover:bg-[#15264a] transition-colors shrink-0">
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
                
                <div class="p-6 md:p-8 flex flex-col flex-grow">
                    <h3 class="text-lg md:text-xl font-bold text-[#1A305E] dark:text-white mb-3 group-hover:text-[#D4AF37] transition-colors leading-tight">
                        {{ __($doc['title']) }}
                    </h3>
                    <p class="text-sm md:text-base text-[#4A5568] dark:text-slate-300 leading-relaxed mb-6 flex-grow wrap-break-word">
                        {{ __($doc['desc']) }}
                    </p>
                    <button class="w-full bg-[#fafafa] dark:bg-slate-700 border border-gray-200 dark:border-slate-600 hover:border-[#D4AF37] hover:bg-[#D4AF37] hover:text-[#1A305E] text-[#1A305E] dark:text-white px-5 py-3 rounded-xl font-bold text-sm transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 group/btn mt-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="group-hover/btn:translate-y-0.5 transition-transform"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        <span>{{ __('messages.download.btn') }}</span>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>