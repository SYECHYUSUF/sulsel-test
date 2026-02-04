<section id="layanan" 
    x-data="{ scroll: 0 }" 
    @scroll.window="scroll = window.pageYOffset"
    class="py-8 md:py-16 bg-white dark:bg-slate-900 relative overflow-hidden font-['Plus_Jakarta_Sans'] transition-colors duration-300">
    

    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header - Animasi Fade Down --}}
        <div class="text-center mb-8 md:mb-12 max-w-3xl mx-auto" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 bg-white dark:bg-slate-800 border border-ppid-accent/30 rounded-full shadow-sm">
                <div class="w-2 h-2 bg-ppid-accent rounded-full"></div>
                <span class="text-ppid-primary dark:text-gray-200 text-xs md:text-sm font-bold tracking-wide uppercase">{{ __('messages.service.our_services') }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-ppid-primary dark:text-white mb-4 sm:mb-6 leading-tight">{{ __('messages.service.public_info_services') }}</h2>
            <p class="text-base md:text-lg text-ppid-text dark:text-gray-300 leading-relaxed">{{ __('messages.service.access_desc') }}</p>
        </div>

        {{-- Cards Grid - Animasi Fade Up dengan Staggered Delay --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 max-w-7xl mx-auto">
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
                <div class="relative bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-10px_theme('colors.ppid-primary_/_10%')] transition-all duration-700 ease-out group-hover:-translate-y-1 border border-gray-100/80 dark:border-slate-700 overflow-hidden h-full flex flex-col">
                
                {{-- Hover Accent Line --}}
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-ppid-accent to-transparent scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                
                <div class="relative z-10 flex flex-row md:flex-col h-full gap-4 md:gap-0">
                    {{-- Icon Container - Pada mobile lebih kecil dan flex-shrink-0 --}}
                    <div class="w-12 h-12 md:w-14 md:h-14 flex-shrink-0 rounded-xl bg-ppid-primary/5 dark:bg-white/10 text-ppid-primary dark:text-white group-hover:bg-ppid-primary group-hover:text-ppid-accent flex items-center justify-center md:mb-6 transition-colors duration-300">
                        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/>
                        </svg>
                    </div>
                    
                    {{-- Content Container --}}
                    <div class="flex flex-col flex-grow">
                        <h3 class="text-base md:text-lg lg:text-xl font-bold text-ppid-primary dark:text-white mb-2 md:mb-3 group-hover:text-ppid-accent transition-colors">{{ __($s['title']) }}</h3>
                        <p class="text-sm md:text-base text-ppid-text dark:text-gray-300 leading-relaxed mb-4 md:mb-8 flex-grow">{{ __($s['desc']) }}</p>
                        
                        <span class="inline-flex items-center gap-2 text-xs md:text-sm font-bold text-ppid-primary dark:text-white group-hover:translate-x-1 transition-transform uppercase tracking-wider">
                            {{ __('messages.service.access_service') }}
                            <svg class="w-3 h-3 md:w-4 md:h-4 text-ppid-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </span>
                    </div>
                </div>

                {{-- Decorative Circle on Hover --}}
                <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-ppid-accent/5 rounded-full group-hover:scale-150 transition-transform duration-700 ease-out"></div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>