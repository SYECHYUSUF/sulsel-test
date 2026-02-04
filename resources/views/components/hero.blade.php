<section 
    x-data="{ 
        scroll: 0, 
        activeSlide: 0,
        direction: 'next',
        slides: [
            @foreach($banners as $banner)
                '{{ asset('storage/' . $banner->image_path) }}',
            @endforeach
        ],
        showImageModal: false,
        currentImageSrc: '',
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
            this.direction = 'next';
            this.activeSlide = (this.activeSlide + 1) % this.slides.length;
        },
        prev() {
            this.direction = 'prev';
            this.activeSlide = (this.activeSlide === 0) ? (this.slides.length - 1) : (this.activeSlide - 1);
        },
        handleImageClick(imageSrc) {
            // Check if it's the Maklumat image
            if (imageSrc.includes('20230918134717_Maklumat pelayanan informasi publik.png')) {
                window.location.href = '/maklumat';
            } else {
                this.currentImageSrc = imageSrc;
                this.showImageModal = true;
                document.body.style.overflow = 'hidden';
            }
        },
        closeImageModal() {
            this.showImageModal = false;
            document.body.style.overflow = '';
        }
    }" 
    @scroll.window="scroll = window.pageYOffset"
    class="w-full relative h-[50vh] sm:h-[85vh] md:h-[100vh] overflow-hidden font-['Plus_Jakarta_Sans'] group z-10 block mt-24 sm:mt-32 md:mt-40"
    @mouseenter="stopTimer"
    @mouseleave="startTimer"
>
    
    
    {{-- 1. CAROUSEL SLIDES (SMOOTH SLIDING) --}}
    <div class="relative w-full h-full flex transition-transform duration-700 ease-in-out"
         :style="`transform: translateX(-${activeSlide * 100}%)`">
        <template x-for="(slide, index) in slides" :key="index">
            <div class="w-full h-full flex-shrink-0 relative cursor-pointer" @click="handleImageClick(slide)">
                {{-- Gambar diset untuk menampilkan seluruh konten tanpa crop --}}
                <img 
                    :src="slide" 
                    class="absolute inset-0 w-full h-full object-cover md:object-contain object-center bg-white dark:bg-slate-800 pointer-events-none"
                    alt="Slider Image"
                    :style="`transform: translateY(${scroll * 0.3}px)`"
                >
                {{-- Overlay Gradient --}}
                <div class="absolute inset-0 bg-gradient-to-t from-ppid-primary/90 via-ppid-primary/40 to-transparent pointer-events-none"></div>
            </div>
        </template>
    </div>

    {{-- 2. KONTEN (CENTERED) - Welcome Message on First Slide Only --}}
    <div class="absolute inset-0 z-20 flex items-center md:items-end justify-center pb-0 md:pb-12 md:mb-72">
        <div class="container mx-auto px-6 text-center text-white">
            {{-- Welcome Content - Only on First Slide --}}
            <div x-show="activeSlide === 0"
                 x-transition:enter="transition ease-out duration-700 delay-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="flex flex-col items-center justify-center gap-4 md:gap-6 lg:gap-12 max-w-6xl mx-auto">
                
                {{-- Mobile: Both Logos Above Text (horizontal) --}}
                <div class="flex md:hidden gap-6 items-center justify-center">
                    <img src="{{ asset('images/logo-sulsel.png') }}" 
                         alt="Logo Sulawesi Selatan" 
                         class="w-12 h-12 sm:w-16 sm:h-16 object-contain drop-shadow-2xl">
                    <img src="{{ asset('images/ppid-2.png') }}" 
                         alt="Logo PPID" 
                         class="w-12 h-12 sm:w-16 sm:h-16 object-contain drop-shadow-2xl">
                </div>

                {{-- Desktop: Content in Row with Logos on Sides --}}
                <div class="hidden md:flex flex-row items-center justify-center gap-8 lg:gap-12 w-full">
                    {{-- Logo Sulsel (Left - Desktop Only) --}}
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/logo-sulsel.png') }}" 
                             alt="Logo Sulawesi Selatan" 
                             class="w-24 h-24 lg:w-32 lg:h-32 object-contain drop-shadow-2xl animate-pulse">
                    </div>
                    
                    {{-- Welcome Text (Center) --}}
                    <div class="flex-1 max-w-3xl">
                        <h1 class="text-xs sm:text-2xl md:text-4xl lg:text-5xl font-bold leading-tight mb-1.5 sm:mb-4 text-white drop-shadow-lg">
                            Selamat Datang di Portal Resmi<br>
                            <span class="text-ppid-accent">PPID Utama</span><br>
                            Provinsi Sulawesi Selatan
                        </h1>
                        <p class="text-[10px] leading-tight sm:text-sm md:text-lg lg:text-xl text-white/90 font-medium drop-shadow-md mb-2 sm:mb-6 md:mb-8">
                            Transparansi Informasi Publik untuk Sulawesi Selatan yang Lebih Baik
                        </p>
                        
                        {{-- Hero Search Bar --}}
                        <div class="max-w-2xl mx-auto scale-90 sm:scale-100">
                            <button 
                                @click="$dispatch('open-search')"
                                class="group w-full flex items-center gap-1.5 sm:gap-3 px-3 py-1.5 sm:px-6 sm:py-4 bg-white/95 dark:bg-slate-800/95 backdrop-blur-md rounded-xl sm:rounded-2xl shadow-2xl hover:shadow-ppid-accent/20 hover:shadow-3xl transition-all duration-300 border-2 border-transparent hover:border-ppid-accent/50">
                                
                                {{-- Search Icon --}}
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-6 sm:h-6 text-ppid-text dark:text-gray-400 group-hover:text-ppid-accent transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                
                                {{-- Placeholder Text --}}
                                <div class="flex-1 text-left">
                                    <span class="text-ppid-text dark:text-gray-400 text-xs sm:text-base md:text-lg font-normal sm:font-medium">
                                        {{ __('messages.common.search_placeholder') }}
                                    </span>
                                </div>
                                
                                {{-- Keyboard Shortcut Hint --}}
                                <div class="hidden md:flex items-center gap-1 px-3 py-1.5 bg-gray-100 dark:bg-slate-700 rounded-lg">
                                    <kbd class="text-xs font-semibold text-ppid-text dark:text-gray-400">Ctrl</kbd>
                                    <span class="text-xs text-ppid-text dark:text-gray-400">+</span>
                                    <kbd class="text-xs font-semibold text-ppid-text dark:text-gray-400">K</kbd>
                                </div>
                            </button>
                            
                            {{-- Popular Keywords --}}
                            <div class="hidden sm:flex mt-4 flex-wrap items-center justify-center gap-2">
                                <span class="text-white/70 text-sm font-medium">{{ __('messages.hero.popular') }}</span>
                                <a href="/informasi-publik/berkala" class="px-3 py-1 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full text-white text-xs font-medium transition-all hover:scale-105">
                                    Laporan Keuangan
                                </a>
                                <a href="/informasi-publik/serta-merta" class="px-3 py-1 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full text-white text-xs font-medium transition-all hover:scale-105">
                                    Informasi Serta Merta
                                </a>
                                <a href="/berita" class="px-3 py-1 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full text-white text-xs font-medium transition-all hover:scale-105">
                                    Berita Terkini
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Logo PPID (Right - Desktop Only) --}}
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/ppid-2.png') }}" 
                             alt="Logo PPID" 
                             class="w-24 h-24 lg:w-32 lg:h-32 object-contain drop-shadow-2xl animate-pulse">
                    </div>
                </div>

                {{-- Mobile: Welcome Text Below Logos --}}
                <div class="md:hidden flex-1 max-w-3xl">
                    <h1 class="text-xs sm:text-2xl font-bold leading-tight mb-1.5 sm:mb-4 text-white drop-shadow-lg">
                        Selamat Datang di Portal Resmi<br>
                        <span class="text-ppid-accent">PPID Utama</span><br>
                        Provinsi Sulawesi Selatan
                    </h1>
                    <p class="text-[10px] leading-tight sm:text-sm text-white/90 font-medium drop-shadow-md mb-2 sm:mb-6">
                        Transparansi Informasi Publik untuk Sulawesi Selatan yang Lebih Baik
                    </p>
                    
                    {{-- Hero Search Bar --}}
                    <div class="max-w-2xl mx-auto scale-90 sm:scale-100">
                        <button 
                            @click="$dispatch('open-search')"
                            class="group w-full flex items-center gap-1.5 sm:gap-3 px-3 py-1.5 sm:px-6 sm:py-4 bg-white/95 dark:bg-slate-800/95 backdrop-blur-md rounded-xl sm:rounded-2xl shadow-2xl hover:shadow-ppid-accent/20 hover:shadow-3xl transition-all duration-300 border-2 border-transparent hover:border-ppid-accent/50">
                            
                            {{-- Search Icon --}}
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-6 sm:h-6 text-ppid-text dark:text-gray-400 group-hover:text-ppid-accent transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            
                            {{-- Placeholder Text --}}
                            <div class="flex-1 text-left">
                                <span class="text-ppid-text dark:text-gray-400 text-xs sm:text-base font-normal sm:font-medium">
                                    {{ __('messages.common.search_placeholder') }}
                                </span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @ --}}
    <button @click="prev()" class="absolute left-2 sm:left-4 top-1/2 -translate-y-14 p-2 sm:p-3 rounded-full bg-black/20 hover:bg-ppid-accent hover:text-ppid-primary text-white backdrop-blur-sm transition-all z-30 opacity-0 group-hover:opacity-100 transform -translate-x-4 group-hover:translate-x-0 duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
    </button>
    <button @click="next()" class="absolute right-2 sm:right-4 top-1/2 -translate-y-14 p-2 sm:p-3 rounded-full bg-black/20 hover:bg-ppid-accent hover:text-ppid-primary text-white backdrop-blur-sm transition-all z-30 opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
    </button>

    {{-- DOT INDICATORS --}}
    <div class="absolute bottom-6 sm:bottom-24 md:bottom-28 left-1/2 -translate-x-1/2 flex space-x-2 z-30">
        <template x-for="(slide, index) in slides" :key="index">
            <button 
                @click="activeSlide = index"
                class="w-10 h-1.5 rounded-full transition-all duration-300"
                :class="activeSlide === index ? 'bg-ppid-accent w-16' : 'bg-white/30 hover:bg-white/50'"
            ></button>
        </template>
    </div>

    {{-- DEKORASI GELOMBANG --}}
    {{-- DEKORASI GELOMBANG --}}
    <div class="absolute bottom-0 left-0 right-0 z-20 pointer-events-none text-white dark:text-slate-900 transition-colors duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" fill="currentColor" class="w-full h-auto ">
            <path fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,42.7C1120,32,1280,32,1360,32L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
        </svg>
    </div>

    {{-- IMAGE ZOOM MODAL --}}
    <div x-show="showImageModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="closeImageModal()"
         @keydown.escape.window="closeImageModal()"
         class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/90 backdrop-blur-sm p-4"
         style="display: none;">
        
        {{-- Close Button --}}
        <button @click="closeImageModal()" 
                class="absolute top-4 right-4 sm:top-6 sm:right-6 z-[10000] w-10 h-10 sm:w-12 sm:h-12 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white rounded-full flex items-center justify-center transition-all hover:scale-110 hover:rotate-90">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Image Container --}}
        <div @click.stop class="relative max-w-7xl max-h-[90vh] w-full">
            <img :src="currentImageSrc" 
                 alt="Zoomed Image" 
                 class="w-full h-full object-contain rounded-lg shadow-2xl"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100">
        </div>

        {{-- Helper Text --}}
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white/70 text-sm">
            Klik di luar gambar atau tekan ESC untuk menutup
        </div>
    </div>
</section>