<header class="fixed top-0 left-0 w-full z-50 bg-white dark:bg-slate-900 shadow-sm font-['Plus_Jakarta_Sans'] transition-colors duration-300" 
        x-data="{ 
            mobileMenu: false,
            openProfil: false, 
            openDaftar: false, 
            openInformasi: false, 
            openLayanan: false, 
            openService: false,
            openLang: false,
            lang: '{{ session('locale', 'id') }}'.toUpperCase(),
            darkMode: localStorage.getItem('theme') === 'dark',
            init() {
                if (this.darkMode) document.documentElement.classList.add('dark');
                else document.documentElement.classList.remove('dark');
            }
        }">

    {{-- 1. TOP BAR: LOGO & BAHASA --}}
    <div class="container mx-auto px-4 py-4 md:py-6 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group">
            {{-- Logo Image --}}
            <img src="{{ asset('images/ppid-2.png') }}" alt="Logo PPID Sulawesi Selatan" class="h-10 md:h-14 w-auto transition-transform group-hover:scale-105" />
            
            {{-- TEKS SAMPING LOGO --}}
            <div class="flex flex-col justify-center">
                <span class="font-extrabold text-[#1A305E] dark:text-white text-xs md:text-base leading-tight group-hover:text-[#D4AF37] transition-colors font-['Plus_Jakarta_Sans']">
                    {{ __('messages.header.title_1') }}
                </span>
                <span class="font-bold text-[#D4AF37] text-[10px] md:text-xs tracking-[0.15em] uppercase mt-0.5">
                    {{ __('messages.header.title_2') }}
                </span>
            </div>
        </a>

        {{-- SEARCH BAR (Desktop) --}}
        <div class="hidden lg:flex flex-1 max-w-xl mx-8">
            <form action="/search" method="GET" class="w-full relative">
                <input 
                    type="text" 
                    name="query" 
                    placeholder="Cari informasi..." 
                    class="w-full py-2.5 pl-4 pr-12 rounded-full border-2 border-gray-300 bg-white focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-sm transition-all text-[#1A305E] placeholder:text-gray-500 dark:bg-slate-800 dark:border-slate-600 dark:text-white dark:placeholder:text-gray-400 dark:focus:bg-slate-900 dark:focus:border-[#D4AF37]"
                >
                <button type="submit" class="absolute right-1 top-1 bottom-1 bg-[#1A305E] hover:bg-[#15264a] text-white px-4 rounded-full transition-colors flex items-center justify-center dark:hover:bg-[#D4AF37] dark:hover:text-[#1A305E]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </form>
        </div>

        <div class="flex items-center gap-3 md:gap-4">
            {{-- Contact Desktop --}}
            <a href="/contact" class="hidden lg:block text-sm font-medium text-[#4A5568] dark:text-gray-300 hover:text-[#D4AF37] transition-colors">{{ __('messages.header.contact') }}</a>
            
            {{-- Dark Mode Toggle --}}
            <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light'); if(darkMode) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark');" 
                    class="p-2 rounded-full text-[#4A5568] dark:text-gray-300 hover:text-[#D4AF37] hover:bg-[#1A305E]/5 dark:hover:bg-white/10 transition-all">
                <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </button>
            
            {{-- Dropdown Bahasa --}}
            <div class="relative" @click.away="openLang = false">
                <button @click="openLang = !openLang" class="flex items-center gap-1 text-[#4A5568] dark:text-gray-300 hover:text-[#D4AF37] transition-colors font-bold uppercase focus:outline-none text-sm">
                    <span x-text="lang"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openLang ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </button>

                <div x-show="openLang" x-transition class="absolute right-0 mt-2 w-24 bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 shadow-xl rounded-xl overflow-hidden py-1 z-[60]">
                    <a href="/lang/id" class="block w-full text-left px-4 py-2 hover:bg-[#D4AF37]/10 hover:text-[#D4AF37] dark:text-gray-200 transition-colors text-sm">🇮🇩 ID</a>
                    <a href="/lang/en" class="block w-full text-left px-4 py-2 hover:bg-[#D4AF37]/10 hover:text-[#D4AF37] dark:text-gray-200 transition-colors text-sm">🇺🇸 EN</a>
                </div>
            </div>

            {{-- TOMBOL HAMBURGER: Hanya muncul di Mobile --}}
            <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 rounded-lg bg-[#1A305E]/5 dark:bg-white/10 text-[#1A305E] dark:text-white">
                <svg x-show="!mobileMenu" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                <svg x-show="mobileMenu" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    </div>

    {{-- 2. NAVIGATION BAR --}}
    <nav class="bg-[#1A305E] shadow-md transition-all duration-300 relative"
         :class="mobileMenu ? 'block' : 'hidden lg:block'">
        
        {{-- Gold Line Accent --}}
        <div class="absolute top-0 left-0 w-full h-[2px] bg-[#D4AF37]"></div>

        <div class="container mx-auto px-0 lg:px-4 py-4">
            <ul class="flex flex-col lg:flex-row items-stretch justify-center lg:items-center text-xs lg:text-sm font-medium text-white/90">
                
                {{-- SEARCH (Mobile Only) --}}
                <li class="lg:hidden px-6 py-4 border-b border-white/10">
                    <form action="/search" method="GET" class="relative">
                        <input 
                            type="text" 
                            name="query" 
                            placeholder="Cari informasi..." 
                            class="w-full py-2 pl-4 pr-10 rounded-lg bg-white/10 border-2 border-white/30 text-white placeholder-white/70 text-sm focus:bg-white/20 focus:border-[#D4AF37] focus:outline-none focus:ring-2 focus:ring-[#D4AF37]/30"
                        >
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-white/70 hover:text-[#D4AF37]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </form>
                </li>
                
                {{-- BERANDA --}}
                <li class="border-b lg:border-none border-white/10">
                    <a href="/" class="block px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all relative group">
                        {{ __('messages.header.home') }}
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </a>
                </li>
                
                {{-- Dropdown Profil --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openProfil = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openProfil = false">
                    <div @click="if(window.innerWidth < 1024) openProfil = !openProfil" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all cursor-pointer relative">
                        <span>{{ __('messages.header.profile') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-[#D4AF37]" :class="openProfil ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </div>
                    <ul x-show="openProfil" 
                        x-transition:enter="transition ease-out duration-300 transform origin-top"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform origin-top"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white dark:bg-slate-800 lg:shadow-xl text-[#1A305E] dark:text-gray-200 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-[#D4AF37] z-50">
                        <li><a href="/profil-ppid" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Profil PPID</a></li>
                        <li><a href="/sambutan" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Sambutan</a></li>
                        <li><a href="/struktur-organisasi" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Struktur Organisasi</a></li>
                        <li><a href="/visi-misi" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Visi Misi</a></li>
                        <li><a href="/tupoksi" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Tupoksi</a></li>
                        <li><a href="/maklumat-pelayanan" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Maklumat</a></li>
                        <li><a href="/profil-pemprov" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Profil Pemerintah Sulsel</a></li>
                    </ul>
                </li>

                {{-- BERITA --}}
                <li class="border-b lg:border-none border-white/10">
                    <a href="/berita" class="block px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all relative group">
                        {{ __('messages.header.news') }}
                         <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </a>
                </li>

                {{-- Dropdown Data Informasi Publik (Formerly Daftar) --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openDaftar = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openDaftar = false">
                    <div @click="if(window.innerWidth < 1024) openDaftar = !openDaftar" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all cursor-pointer relative">
                        <span>{{ __('messages.header.data_info') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-[#D4AF37]" :class="openDaftar ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </div>
                    <ul x-show="openDaftar" 
                        x-transition:enter="transition ease-out duration-300 transform origin-top"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform origin-top"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white dark:bg-slate-800 lg:shadow-xl text-[#1A305E] dark:text-gray-200 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-[#D4AF37] z-50">
                        <li><a href="/informasi-publik/2023" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">Informasi Publik Tahun 2023</a></li>
                        <li><a href="/informasi-publik/2024" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">Informasi Publik Tahun 2024</a></li>
                        <li><a href="/informasi-publik/2025" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">Informasi Publik Tahun 2025</a></li>
                        <li><a href="/informasi-publik/pengadaan" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">Informasi Pengadaan Barang Dan Jasa</a></li>
                    </ul>
                </li>

                {{-- Dropdown Informasi Publik --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openInformasi = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openInformasi = false">
                    <div @click="if(window.innerWidth < 1024) openInformasi = !openInformasi" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all cursor-pointer relative">
                        <span>{{ __('messages.header.public_info') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-[#D4AF37]" :class="openInformasi ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </div>
                    <ul x-show="openInformasi" 
                        x-transition:enter="transition ease-out duration-300 transform origin-top"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform origin-top"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-72 bg-white dark:bg-slate-800 lg:shadow-xl text-[#1A305E] dark:text-gray-200 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-[#D4AF37] z-50">
                        <li><a href="/informasi-publik/serta-merta" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">Informasi Serta Merta</a></li>
                        <li><a href="/informasi-publik/setiap-saat" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">Informasi Setiap Saat</a></li>
                        <li><a href="/informasi-publik/dikecualikan" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">Daftar Informasi Dikecualikan</a></li>
                        <li><a href="/informasi-publik" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">Daftar Informasi Publik</a></li>
                        <li><a href="/informasi-publik/berkala" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">Informasi Berkala</a></li>
                    </ul>
                </li>

                <li class="border-b lg:border-none border-white/10">
                    <a href="/ppid-pelaksana" class="block px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all relative group">
                        {{ __('messages.header.ppid_implementing') }}
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </a>
                </li>

                {{-- Dropdown Layanan --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openLayanan = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openLayanan = false">
    <div @click="if(window.innerWidth < 1024) openLayanan = !openLayanan" 
            class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all cursor-pointer relative">
        <span>{{ __('messages.header.services') }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-[#D4AF37]" :class="openLayanan ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
    </div>
    {{-- Kode Baru (Perbaikan) --}}
<ul x-show="openLayanan" 
    x-transition:enter="transition ease-out duration-300 transform origin-top"
    x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-200 transform origin-top"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
    class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white dark:bg-slate-800 lg:shadow-xl text-[#1A305E] dark:text-gray-200 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-[#D4AF37] z-50">
    
    <li>
        <a href="/layanan/permohonan-informasi" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">
            Permohonan Informasi
        </a>
    </li>
    
    <li>
        <a href="/layanan/pengajuan-keberatan" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">
            Pengajuan Keberatan
        </a>
    </li>
    
    <li>
        <a href="/layanan/sop" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">
            SOP
        </a>
    </li>

</ul>
                </li>

                {{-- Dropdown Survey --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openService = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openService = false">
                    <div @click="if(window.innerWidth < 1024) openService = !openService" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all cursor-pointer relative">
                        <span>{{ __('messages.header.survey') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-[#D4AF37]" :class="openService ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                         <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </div>
                    <ul x-show="openService" 
                        x-transition:enter="transition ease-out duration-300 transform origin-top"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform origin-top"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-56 bg-white dark:bg-slate-800 lg:shadow-xl text-[#1A305E] dark:text-gray-200 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-[#D4AF37] z-50">
                        <li><a href="/survey/isi-survey" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">Isi Survey</a></li>
                        <li><a href="/survey/hasil-survey" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#D4AF37] border-l-4 border-transparent hover:border-[#D4AF37]">Hasil Survey</a></li>
                    </ul>
                </li>

                {{-- Contact Mobile Only --}}
                <li class="lg:hidden border-b border-white/10">
                    <a href="/contact" class="block px-6 py-4 hover:bg-white/10 hover:text-white">{{ __('messages.header.contact') }}</a>
                </li>
            </ul>
        </div>
    </nav>
</header>