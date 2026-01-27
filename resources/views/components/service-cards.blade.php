<section id="layanan" 
    x-data="{ scroll: 0 }" 
    @scroll.window="scroll = window.pageYOffset"
    class="py-8 md:py-16 bg-[#fafafa] dark:bg-slate-900 relative overflow-hidden font-['Plus_Jakarta_Sans'] transition-colors duration-300">
    
    {{-- Decorative Background (Subtle) - Full Width --}}
    <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-[#1A305E]/5 via-transparent to-[#D4AF37]/5 dark:from-[#1A305E]/10 dark:to-[#D4AF37]/10 pointer-events-none"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-[#1A305E]/5 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-[#D4AF37]/10 rounded-full blur-3xl opacity-40 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header - Animasi Fade Down --}}
        <div class="text-center mb-8 md:mb-12 max-w-3xl mx-auto" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 bg-white dark:bg-slate-800 border border-[#D4AF37]/30 rounded-full shadow-sm">
                <div class="w-2 h-2 bg-[#D4AF37] rounded-full"></div>
                <span class="text-[#1A305E] dark:text-gray-200 text-xs md:text-sm font-bold tracking-wide uppercase">{{ __('messages.service.our_services') }}</span>
            </div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#1A305E] dark:text-white mb-6 leading-tight">{{ __('messages.service.public_info_services') }}</h2>
            <p class="text-base md:text-lg text-[#4A5568] dark:text-gray-300 leading-relaxed">{{ __('messages.service.access_desc') }}</p>
        </div>

        {{-- Cards Grid - Animasi Fade Up dengan Staggered Delay --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
            @php
                $services = [
                    ['title' => 'messages.service.info_public_title', 'desc' => 'messages.service.public_info_desc', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'url' => '/informasi-publik'],
                    ['title' => 'messages.footer.info_request', 'desc' => 'messages.service.request_desc', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'url' => '/layanan/permohonan-informasi'],
                    ['title' => 'messages.footer.objection', 'desc' => 'messages.service.objection_desc', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z', 'url' => '/layanan/pengajuan-keberatan'],
                ];
            @endphp

            @foreach($services as $index => $s)
            <a href="{{ $s['url'] }}" class="group h-full block"
                 data-aos="fade-up" 
                 data-aos-delay="{{ $index * 150 }}">
                <div class="relative bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-10px_rgba(26,48,94,0.1)] transition-all duration-700 ease-out group-hover:-translate-y-1 border border-gray-100/80 dark:border-slate-700 overflow-hidden h-full flex flex-col">
                
                {{-- Hover Accent Line --}}
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#D4AF37] to-transparent scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                
                <div class="relative z-10 flex flex-col h-full">
                    <div class="w-14 h-14 rounded-xl bg-[#1A305E]/5 dark:bg-white/10 text-[#1A305E] dark:text-white group-hover:bg-[#1A305E] group-hover:text-[#D4AF37] flex items-center justify-center mb-6 transition-colors duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/>
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-[#1A305E] dark:text-white mb-3 group-hover:text-[#D4AF37] transition-colors">{{ __($s['title']) }}</h3>
                    <p class="text-[#4A5568] dark:text-gray-300 leading-relaxed mb-8 flex-grow">{{ __($s['desc']) }}</p>
                    
                    <span class="inline-flex items-center gap-2 text-sm font-bold text-[#1A305E] dark:text-white group-hover:translate-x-1 transition-transform uppercase tracking-wider">
                        {{ __('messages.service.access_service') }}
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </div>

                {{-- Decorative Circle on Hover --}}
                <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-[#D4AF37]/5 rounded-full group-hover:scale-150 transition-transform duration-700 ease-out"></div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>