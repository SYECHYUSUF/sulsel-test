<section 
    x-data="{ scroll: 0 }" 
    @scroll.window="scroll = window.pageYOffset"
    class="relative h-[600px] sm:h-[650px] md:h-[750px] flex items-center justify-center overflow-hidden font-['Plus_Jakarta_Sans']">
    
    {{-- 1. GAMBAR LATAR BELAKANG DENGAN EFEK PARALLAX --}}
    {{-- Kita gunakan h-[120%] agar ada ruang lebih saat gambar bergeser ke atas/bawah --}}
    <img
        src="{{ asset('images/20230807143338_Welcome Banner.png') }}"
        class="absolute inset-0 w-full h-[120%] object-cover transition-transform duration-75 ease-out"
        alt="Welcome Banner PPID Utama Sulsel"
        :style="`transform: translateY(${scroll * 0.3}px)`"
    >

    {{-- 2. OVERLAY GELAP & GRADASI --}}
    <div class="absolute inset-0 bg-black/40 bg-gradient-to-b from-black/50 via-transparent to-black/80"></div>

    {{-- 3. KONTEN UTAMA --}}
    <div class="relative z-10 container mx-auto px-6 text-center text-white">
        {{-- Judul Besar - Animasi: Fade Down --}}
        <h2 
            data-aos="fade-down" 
            data-aos-duration="1000"
            class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 md:mb-6 leading-tight drop-shadow-2xl tracking-tight">
            Selamat Datang di Portal Resmi<br class="hidden md:block">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-100 to-gray-300">
                PPID Utama Provinsi Sulawesi Selatan
            </span>
        </h2>

        {{-- 4. INPUT PENCARIAN - Animasi: Zoom In --}}
        <div 
            data-aos="zoom-in" 
            data-aos-delay="400"
            data-aos-duration="800"
            class="max-w-2xl mx-auto mb-10 md:mb-14 px-2 relative group mt-8">
            <form action="/search" method="GET" class="relative">
                <input 
                    type="text" 
                    name="query"
                    placeholder="Cari dokumen, berita, atau regulasi..." 
                    class="w-full bg-white/10 backdrop-blur-xl border border-white/30 text-white placeholder-white/60 px-7 py-4 md:py-5 rounded-full focus:outline-none focus:ring-4 focus:ring-violet-500/50 focus:bg-white/20 transition-all duration-300 shadow-2xl text-sm md:text-base outline-none"
                >
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-violet-600 hover:bg-violet-500 text-white p-3 md:p-4 rounded-full transition-all shadow-lg active:scale-95 group-hover:scale-105 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
            
            {{-- Hint Pencarian Populer - Animasi: Fade Up --}}
            <div 
                data-aos="fade-up" 
                data-aos-delay="800"
                class="mt-3 flex flex-wrap justify-center gap-2 text-[10px] md:text-xs text-white/60">
                <span>Populer:</span>
                <a href="#" class="hover:text-white transition-colors underline decoration-white/20">Laporan Keuangan</a>
                <a href="#" class="hover:text-white transition-colors underline decoration-white/20">Daftar Aset</a>
                <a href="#" class="hover:text-white transition-colors underline decoration-white/20">RKA-SKPD</a>
            </div>
        </div>
    </div>

    {{-- Dekorasi Gelombang --}}
    <div class="absolute bottom-0 left-0 right-0 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" fill="#ffffff" class="w-full h-auto min-h-[40px]">
            <path fill-opacity="1" d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,58.7C960,64,1056,64,1152,58.7C1248,53,1344,43,1392,37.3L1440,32L1440,100L1392,100C1344,100,1248,100,1152,100C1056,100,960,100,864,100C768,100,672,100,576,100C480,100,384,100,288,100C192,100,96,100,48,100L0,100Z"></path>
        </svg>
    </div>
</section>