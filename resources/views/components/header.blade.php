<header class="sticky top-0 z-50 bg-white shadow-sm font-['Plus_Jakarta_Sans']" 
        x-data="{ 
            mobileMenu: false,
            openProfil: false, 
            openDaftar: false, 
            openInformasi: false, 
            openLayanan: false, 
            openService: false,
            openLang: false,
            lang: localStorage.getItem('lang') || 'ID',
            darkMode: localStorage.getItem('theme') === 'dark',
            init() {
                if (this.darkMode) document.documentElement.classList.add('dark');
            }
        }">

    {{-- 1. TOP BAR: LOGO & BAHASA --}}
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo Sulawesi Selatan" class="h-10 md:h-12 w-auto transition-transform group-hover:scale-105" />
        </a>

        <div class="flex items-center gap-3 md:gap-4">
            {{-- Contact Desktop --}}
            <a href="/contact" class="hidden lg:block text-sm font-medium text-[#4A5568] hover:text-[#D4AF37] transition-colors">Contact</a>
            
            {{-- Dark Mode Toggle --}}
            <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light'); if(darkMode) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark');" 
                    class="p-2 rounded-full text-[#4A5568] hover:text-[#D4AF37] hover:bg-[#1A305E]/5 transition-all">
                <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </button>
            
            {{-- Dropdown Bahasa --}}
            <div class="relative" @click.away="openLang = false">
                <button @click="openLang = !openLang" class="flex items-center gap-1 text-[#4A5568] hover:text-[#D4AF37] transition-colors font-bold uppercase focus:outline-none text-sm">
                    <span x-text="lang"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openLang ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </button>

                <div x-show="openLang" x-transition class="absolute right-0 mt-2 w-24 bg-white border border-gray-100 shadow-xl rounded-xl overflow-hidden py-1 z-[60]">
                    <button @click="lang = 'ID'; localStorage.setItem('lang', 'ID'); openLang = false; location.reload()" class="w-full text-left px-4 py-2 hover:bg-[#D4AF37]/10 hover:text-[#D4AF37] transition-colors text-sm">🇮🇩 ID</button>
                    <button @click="lang = 'EN'; localStorage.setItem('lang', 'EN'); openLang = false; location.reload()" class="w-full text-left px-4 py-2 hover:bg-[#D4AF37]/10 hover:text-[#D4AF37] transition-colors text-sm">🇺🇸 EN</button>
                </div>
            </div>

            {{-- TOMBOL HAMBURGER: Hanya muncul di Mobile --}}
            <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 rounded-lg bg-[#1A305E]/5 text-[#1A305E]">
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

        <div class="container mx-auto px-0 lg:px-4">
            <ul class="flex flex-col lg:flex-row items-stretch lg:items-center text-xs lg:text-sm font-medium text-white/90">
                
                {{-- BERANDA --}}
                <li class="border-b lg:border-none border-white/10">
                    <a href="/" class="block px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all relative group">
                        BERANDA
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </a>
                </li>
                
                {{-- Dropdown Profil --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openProfil = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openProfil = false">
                    <div @click="if(window.innerWidth < 1024) openProfil = !openProfil" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all cursor-pointer relative">
                        <span>PROFIL</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-[#D4AF37]" :class="openProfil ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </div>
                    <ul x-show="openProfil" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white lg:shadow-xl text-[#1A305E] py-2 lg:rounded-b-lg lg:border-t-4 lg:border-[#D4AF37] z-50">
                        <li><a href="/profil-ppid" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Profil PPID</a></li>
                        <li><a href="/visi-misi" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Visi & Misi</a></li>
                        <li><a href="/struktur-organisasi" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Struktur Organisasi</a></li>
                        <li><a href="/tupoksi" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Tugas & Fungsi</a></li>
                        <li><a href="/maklumat-pelayanan" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] transition-colors border-l-4 border-transparent hover:border-[#D4AF37]">Maklumat Pelayanan</a></li>
                    </ul>
                </li>

                <li class="border-b lg:border-none border-white/10">
                    <a href="/berita" class="block px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all relative group">
                        BERITA
                         <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </a>
                </li>

                {{-- Dropdown Daftar Informasi Publik --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openDaftar = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openDaftar = false">
                    <div @click="if(window.innerWidth < 1024) openDaftar = !openDaftar" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all cursor-pointer relative">
                        <span>DAFTAR INFORMASI PUBLIK</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-[#D4AF37]" :class="openDaftar ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </div>
                    <ul x-show="openDaftar" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white lg:shadow-xl text-[#1A305E] py-2 lg:rounded-b-lg lg:border-t-4 lg:border-[#D4AF37] z-50">
                        <li><a href="#" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-l-4 border-transparent hover:border-[#D4AF37]">Informasi Publik Tahun 2024</a></li>
                        <li><a href="#" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-l-4 border-transparent hover:border-[#D4AF37]">Informasi Publik Tahun 2023</a></li>
                    </ul>
                </li>

                {{-- Dropdown Informasi Publik --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openInformasi = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openInformasi = false">
                    <div @click="if(window.innerWidth < 1024) openInformasi = !openInformasi" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all cursor-pointer relative">
                        <span>INFORMASI PUBLIK</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-[#D4AF37]" :class="openInformasi ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </div>
                    <ul x-show="openInformasi" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white lg:shadow-xl text-[#1A305E] py-2 lg:rounded-b-lg lg:border-t-4 lg:border-[#D4AF37] z-50">
                        <li><a href="#" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-l-4 border-transparent hover:border-[#D4AF37]">Berkala</a></li>
                        <li><a href="#" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-l-4 border-transparent hover:border-[#D4AF37]">Serta Merta</a></li>
                        <li><a href="#" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-l-4 border-transparent hover:border-[#D4AF37]">Setiap Saat</a></li>
                        <li><a href="#" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-l-4 border-transparent hover:border-[#D4AF37]">Informasi Dikecualikan</a></li>
                    </ul>
                </li>

                <li class="border-b lg:border-none border-white/10">
                    <a href="#" class="block px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all relative group">
                        PPID PELAKSANA
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </a>
                </li>

                {{-- Dropdown Layanan --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openLayanan = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openLayanan = false">
                    <div @click="if(window.innerWidth < 1024) openLayanan = !openLayanan" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all cursor-pointer relative">
                        <span>LAYANAN</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-[#D4AF37]" :class="openLayanan ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </div>
                    <ul x-show="openLayanan" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white lg:shadow-xl text-[#1A305E] py-2 lg:rounded-b-lg lg:border-t-4 lg:border-[#D4AF37] z-50">
                        <li><a href="#" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-l-4 border-transparent hover:border-[#D4AF37]">Permohonan Informasi Online</a></li>
                        <li><a href="#" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-l-4 border-transparent hover:border-[#D4AF37]">Pengajuan Keberatan Online</a></li>
                        <li><a href="#" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-l-4 border-transparent hover:border-[#D4AF37]">Cek Status Permohonan</a></li>
                    </ul>
                </li>

                {{-- Dropdown Survey --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openService = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openService = false">
                    <div @click="if(window.innerWidth < 1024) openService = !openService" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-[#D4AF37] transition-all cursor-pointer relative">
                        <span>SURVEY</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-[#D4AF37]" :class="openService ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                         <span class="absolute bottom-0 left-0 w-full h-[3px] bg-[#D4AF37] scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block"></span>
                    </div>
                    <ul x-show="openService" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-56 bg-white lg:shadow-xl text-[#1A305E] py-2 lg:rounded-b-lg lg:border-t-4 lg:border-[#D4AF37] z-50">
                        <li><a href="#" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-l-4 border-transparent hover:border-[#D4AF37]">Isi Survey</a></li>
                        <li><a href="#" class="block px-10 lg:px-6 py-3 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-l-4 border-transparent hover:border-[#D4AF37]">Hasil Survey</a></li>
                    </ul>
                </li>

                {{-- Contact Mobile Only --}}
                <li class="lg:hidden border-b border-white/10">
                    <a href="/contact" class="block px-6 py-4 hover:bg-white/10 hover:text-white">CONTACT</a>
                </li>
            </ul>
        </div>
    </nav>
</header>