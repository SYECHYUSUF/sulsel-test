<section id="layanan" 
    x-data="{ scroll: 0 }" 
    @scroll.window="scroll = window.pageYOffset"
    class="py-12 md:py-24 bg-[#fafafa] relative overflow-hidden font-['Plus_Jakarta_Sans']">
    
    {{-- Decorative Background (Subtle) --}}
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#1A305E]/5 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#D4AF37]/10 rounded-full blur-3xl opacity-40 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header - Animasi Fade Down --}}
        <div class="text-center mb-12 md:mb-20 max-w-3xl mx-auto" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 bg-white border border-[#D4AF37]/30 rounded-full shadow-sm">
                <div class="w-2 h-2 bg-[#D4AF37] rounded-full"></div>
                <span class="text-[#1A305E] text-xs md:text-sm font-bold tracking-wide uppercase">Layanan Kami</span>
            </div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#1A305E] mb-6 leading-tight">Layanan Informasi Publik</h2>
            <p class="text-base md:text-lg text-[#4A5568] leading-relaxed">Akses mudah dan transparan untuk berbagai layanan informasi publik di Provinsi Sulawesi Selatan.</p>
        </div>

        {{-- Cards Grid - Animasi Fade Up dengan Staggered Delay --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
            @php
                $services = [
                    ['title' => 'Informasi Publik', 'desc' => 'Akses berbagai informasi publik secara berkala, serta merta, dan setiap saat.', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                    ['title' => 'Permohonan Informasi', 'desc' => 'Ajukan permohonan informasi publik dengan proses yang mudah dan terintegrasi.', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['title' => 'Pengajuan Keberatan', 'desc' => 'Layanan pengajuan keberatan jika permohonan informasi tidak sesuai ketentuan.', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                ];
            @endphp

            @foreach($services as $index => $s)
            <div class="group h-full"
                 data-aos="fade-up" 
                 data-aos-delay="{{ $index * 150 }}">
                <div class="relative bg-white rounded-2xl p-8 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-10px_rgba(26,48,94,0.1)] transition-all duration-700 ease-out group-hover:-translate-y-1 border border-gray-100/80 overflow-hidden h-full flex flex-col">
                
                {{-- Hover Accent Line --}}
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#D4AF37] to-transparent scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                
                <div class="relative z-10 flex flex-col h-full">
                    <div class="w-14 h-14 rounded-xl bg-[#1A305E]/5 text-[#1A305E] group-hover:bg-[#1A305E] group-hover:text-[#D4AF37] flex items-center justify-center mb-6 transition-colors duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/>
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-[#1A305E] mb-3 group-hover:text-[#D4AF37] transition-colors">{{ $s['title'] }}</h3>
                    <p class="text-[#4A5568] leading-relaxed mb-8 flex-grow">{{ $s['desc'] }}</p>
                    
                    <a href="#" class="inline-flex items-center gap-2 text-sm font-bold text-[#1A305E] group-hover:translate-x-1 transition-transform uppercase tracking-wider">
                        Akses Layanan
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>

                {{-- Decorative Circle on Hover --}}
                <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-[#D4AF37]/5 rounded-full group-hover:scale-150 transition-transform duration-700 ease-out"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>