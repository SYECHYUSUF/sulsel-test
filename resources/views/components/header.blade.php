<header class="sticky top-0 z-50 bg-white shadow-sm font-['Plus_Jakarta_Sans']" 
        x-data="{ 
            mobileMenu: false,
            openProfil: false, 
            openDaftar: false, 
            openInformasi: false, 
            openLayanan: false, 
            openService: false,
            openLang: false,
            lang: localStorage.getItem('lang') || 'ID' 
        }">

    {{-- 1. TOP BAR: LOGO & BAHASA --}}
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo Sulawesi Selatan" class="h-10 md:h-12 w-auto transition-transform group-hover:scale-105" />
        </a>

        <div class="flex items-center gap-3 md:gap-4">
            {{-- Contact Desktop --}}
            <a href="/contact" class="hidden lg:block text-sm font-medium text-gray-700 hover:text-violet-600 transition-colors">Contact</a>
            
            {{-- Dropdown Bahasa --}}
            <div class="relative" @click.away="openLang = false">
                <button @click="openLang = !openLang" class="flex items-center gap-1 text-gray-700 hover:text-violet-600 transition-colors font-bold uppercase focus:outline-none text-sm">
                    <span x-text="lang"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openLang ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </button>

                <div x-show="openLang" x-transition class="absolute right-0 mt-2 w-24 bg-white border border-gray-100 shadow-xl rounded-xl overflow-hidden py-1 z-[60]">
                    <button @click="lang = 'ID'; localStorage.setItem('lang', 'ID'); openLang = false; location.reload()" class="w-full text-left px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors text-sm">🇮🇩 ID</button>
                    <button @click="lang = 'EN'; localStorage.setItem('lang', 'EN'); openLang = false; location.reload()" class="w-full text-left px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors text-sm">🇺🇸 EN</button>
                </div>
            </div>

            {{-- TOMBOL HAMBURGER: Hanya muncul di Mobile --}}
            <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 rounded-lg bg-violet-50 text-violet-600">
                <svg x-show="!mobileMenu" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                <svg x-show="mobileMenu" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    </div>

    {{-- 2. NAVIGATION BAR --}}
    {{-- Logika: 'hidden' di mobile kecuali mobileMenu true, tapi 'lg:block' di layar besar --}}
    <nav class="bg-[#6B46C1] shadow-md transition-all duration-300"
         :class="mobileMenu ? 'block' : 'hidden lg:block'">
        <div class="container mx-auto px-0 lg:px-4">
            <ul class="flex flex-col lg:flex-row items-stretch lg:items-center text-xs lg:text-sm font-medium text-white/90">
                
                {{-- BERANDA --}}
                <li class="border-b lg:border-none border-white/10">
                    <a href="/" class="block px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all">BERANDA</a>
                </li>
                
                {{-- Dropdown Profil --}}
                <li class="relative border-b lg:border-none border-white/10"
                    @mouseenter="if(window.innerWidth >= 1024) openProfil = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openProfil = false">
                    <div @click="if(window.innerWidth < 1024) openProfil = !openProfil" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all cursor-pointer">
                        <span>PROFIL</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openProfil ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                    <ul x-show="openProfil" class="lg:absolute lg:left-0 lg:top-full w-full lg:w-56 bg-white lg:shadow-xl text-gray-800 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-violet-600 z-50">
                        <li><a href="/profil-ppid" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors">Profil PPID</a></li>
                        <li><a href="/visi-misi" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors">Visi & Misi</a></li>
                        <li><a href="/struktur-organisasi" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors">Struktur Organisasi</a></li>
                        <li><a href="/tupoksi" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors">Tugas & Fungsi</a></li>
                        <li><a href="/maklumat-pelayanan" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors">Maklumat Pelayanan</a></li>
                    </ul>
                </li>

                <li class="border-b lg:border-none border-white/10">
                    <a href="/berita" class="block px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all">BERITA</a>
                </li>

                {{-- Dropdown Daftar Informasi Publik --}}
                <li class="relative border-b lg:border-none border-white/10"
                    @mouseenter="if(window.innerWidth >= 1024) openDaftar = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openDaftar = false">
                    <div @click="if(window.innerWidth < 1024) openDaftar = !openDaftar" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all cursor-pointer">
                        <span>DAFTAR INFORMASI PUBLIK</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openDaftar ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                    <ul x-show="openDaftar" class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white lg:shadow-xl text-gray-800 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-violet-600 z-50">
                        <li><a href="#" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600">Informasi Publik Tahun 2024</a></li>
                        <li><a href="#" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600">Informasi Publik Tahun 2023</a></li>
                    </ul>
                </li>

                {{-- Dropdown Informasi Publik --}}
                <li class="relative border-b lg:border-none border-white/10"
                    @mouseenter="if(window.innerWidth >= 1024) openInformasi = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openInformasi = false">
                    <div @click="if(window.innerWidth < 1024) openInformasi = !openInformasi" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all cursor-pointer">
                        <span>INFORMASI PUBLIK</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openInformasi ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                    <ul x-show="openInformasi" class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white lg:shadow-xl text-gray-800 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-violet-600 z-50">
                        <li><a href="#" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600">Berkala</a></li>
                        <li><a href="#" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600">Serta Merta</a></li>
                        <li><a href="#" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600">Setiap Saat</a></li>
                        <li><a href="#" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600">Informasi Dikecualikan</a></li>
                    </ul>
                </li>

                <li class="border-b lg:border-none border-white/10">
                    <a href="#" class="block px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all">PPID PELAKSANA</a>
                </li>

                {{-- Dropdown Layanan --}}
                <li class="relative border-b lg:border-none border-white/10"
                    @mouseenter="if(window.innerWidth >= 1024) openLayanan = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openLayanan = false">
                    <div @click="if(window.innerWidth < 1024) openLayanan = !openLayanan" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all cursor-pointer">
                        <span>LAYANAN</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openLayanan ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                    <ul x-show="openLayanan" class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white lg:shadow-xl text-gray-800 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-violet-600 z-50">
                        <li><a href="#" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors">Permohonan Informasi Online</a></li>
                        <li><a href="#" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors">Pengajuan Keberatan Online</a></li>
                        <li><a href="#" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors">Cek Status Permohonan</a></li>
                    </ul>
                </li>

                {{-- Dropdown Survey --}}
                <li class="relative border-b lg:border-none border-white/10"
                    @mouseenter="if(window.innerWidth >= 1024) openService = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openService = false">
                    <div @click="if(window.innerWidth < 1024) openService = !openService" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all cursor-pointer">
                        <span>SURVEY</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openService ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                    <ul x-show="openService" class="lg:absolute lg:left-0 lg:top-full w-full lg:w-56 bg-white lg:shadow-xl text-gray-800 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-violet-600 z-50">
                        <li><a href="#" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors">Isi Survey</a></li>
                        <li><a href="#" class="block px-10 lg:px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors">Hasil Survey</a></li>
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