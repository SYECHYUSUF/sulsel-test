<section 
    x-data="{ 
        activeSlide: 0,
        slides: [
            '{{ asset('images/20230807143353_Alur Umum Permohonan Informasi (1).png') }}',
            '{{ asset('images/20230807143405_Tata Cara Pengajuan Informasi Publik Bagi Penyandang Disabilitas.png') }}',
            '{{ asset('images/20230915142948_Tata Cara Memperoleh Informasi Publik Revisi.png') }}',
            '{{ asset('images/20230917024457_Tata Cara Pengaduan.png') }}',
            '{{ asset('images/20230918134717_Maklumat pelayanan informasi publik.png') }}',
            '{{ asset('images/20240920113831_Banner Web Keberatan.png') }}'
        ],
        timer: null,
        init() {
            this.startTimer();
        },
        startTimer() {
            this.timer = setInterval(() => {
                this.next();
            }, 6000);
        },
        stopTimer() {
            clearInterval(this.timer);
        },
        next() {
            this.activeSlide = (this.activeSlide + 1) % this.slides.length;
        },
        prev() {
            this.activeSlide = (this.activeSlide === 0) ? (this.slides.length - 1) : (this.activeSlide - 1);
        }
    }" 
    class="relative min-h-screen w-full overflow-hidden font-['Plus_Jakarta_Sans'] group"
    @mouseenter="stopTimer"
    @mouseleave="startTimer"
>
    
    {{-- 1. CAROUSEL SLIDES --}}
    <template x-for="(slide, index) in slides" :key="index">
        <div 
            x-show="activeSlide === index"
            x-transition:enter="transition transform ease-out duration-700"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition transform ease-in duration-700"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="absolute inset-0 w-full h-full"
        >
            <img 
                :src="slide" 
                class="w-full h-full object-cover object-center"
                alt="Slider Image"
            >
             {{-- Overlay Gradient for Text Contrast --}}
             <div class="absolute inset-0 bg-gradient-to-t from-[#1A305E]/90 via-[#1A305E]/40 to-transparent"></div>
        </div>
    </template>

    {{-- 2. KONTEN TUMPANG TINDIH --}}
    <div class="absolute inset-0 z-20 flex items-center justify-center">
        <div class="container mx-auto px-6 text-center text-white mt-16 md:mt-0">
            {{-- Judul Besar --}}
            <h2 
                data-aos="fade-down" 
                data-aos-duration="1000"
                class="text-3xl sm:text-5xl md:text-6xl font-extrabold mb-6 md:mb-8 leading-tight drop-shadow-lg tracking-tight">
                Selamat Datang di Portal Resmi<br>
                <span class="text-[#D4AF37] relative inline-block">
                    PPID Utama
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-[#D4AF37] opacity-60" viewBox="0 0 200 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.00025 6.9997C2.00025 6.9997 18.0007 20.0002 77.5 5.5002C137 -9.0001 198.5 7.5003 198.5 7.5003" stroke="currentColor" stroke-width="3"/></svg>
                </span>
                Provinsi Sulawesi Selatan
            </h2>

             {{-- 4. INPUT PENCARIAN PREMIUM --}}
             <div 
                data-aos="zoom-in" 
                data-aos-delay="400"
                data-aos-duration="800"
                class="max-w-3xl mx-auto mb-10 md:mb-14 relative group mt-8">
                <form action="/search" method="GET" class="relative">
                    <div class="relative flex items-center bg-white/10 backdrop-blur-md border border-white/20 rounded-full p-2 shadow-2xl transition-all duration-300 focus-within:bg-white/20 focus-within:ring-4 focus-within:ring-[#D4AF37]/30">
                        <div class="pl-4 text-white/70">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input 
                            type="text" 
                            name="query"
                            placeholder="Cari dokumen, berita, atau informasi publik..." 
                            class="w-full bg-transparent border-none text-white placeholder-white/70 px-4 py-3 md:py-4 focus:ring-0 focus:outline-none text-base md:text-lg font-medium"
                        >
                        <button type="submit" class="bg-[#D4AF37] hover:bg-[#b08d26] text-[#1A305E] font-bold py-3 px-8 rounded-full transition-all duration-300 shadow-lg transform hover:scale-105">
                            CARI
                        </button>
                    </div>
                </form>
                
                {{-- Hint Pencarian Populer --}}
                <div class="mt-4 flex flex-wrap justify-center gap-3 text-sm font-medium text-white/80">
                    <span class="text-[#D4AF37]">Populer:</span>
                    <a href="#" class="hover:text-[#D4AF37] transition-colors bg-white/10 px-3 py-1 rounded-full backdrop-blur-sm border border-white/10 hover:bg-white/20">Laporan Keuangan</a>
                    <a href="#" class="hover:text-[#D4AF37] transition-colors bg-white/10 px-3 py-1 rounded-full backdrop-blur-sm border border-white/10 hover:bg-white/20">Daftar Aset</a>
                    <a href="#" class="hover:text-[#D4AF37] transition-colors bg-white/10 px-3 py-1 rounded-full backdrop-blur-sm border border-white/10 hover:bg-white/20">RKA-SKPD</a>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTROLS (ARROWS) --}}
    <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-black/20 hover:bg-[#D4AF37] hover:text-[#1A305E] text-white backdrop-blur-sm transition-all z-30 opacity-0 group-hover:opacity-100 transform -translate-x-4 group-hover:translate-x-0 duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
    </button>
    <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-black/20 hover:bg-[#D4AF37] hover:text-[#1A305E] text-white backdrop-blur-sm transition-all z-30 opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
    </button>

    {{-- DOT INDICATORS --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-2 z-30">
        <template x-for="(slide, index) in slides" :key="index">
            <button 
                @click="activeSlide = index"
                class="w-12 h-1.5 rounded-full transition-all duration-300"
                :class="activeSlide === index ? 'bg-[#D4AF37]' : 'bg-white/30 hover:bg-white/50'"
            ></button>
        </template>
    </div>

    {{-- DEKORASI GELOMBANG HALUS --}}
    <div class="absolute bottom-0 left-0 right-0 z-20 pointer-events-none text-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" fill="currentColor" class="w-full h-auto">
            <path fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,42.7C1120,32,1280,32,1360,32L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
        </svg>
    </div>
</section>