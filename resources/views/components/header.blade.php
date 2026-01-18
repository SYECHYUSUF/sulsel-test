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

    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo Sulawesi Selatan" class="h-10 md:h-12 w-auto transition-transform group-hover:scale-105" />
        </a>

        <div class="flex items-center gap-4">
            <a href="/contact" class="hidden lg:block text-sm font-medium text-gray-700 hover:text-violet-600 transition-colors">Kontak</a>
            
            <div class="relative" @click.away="openLang = false">
                <button @click="openLang = !openLang" class="flex items-center gap-1 text-gray-700 hover:text-violet-600 transition-colors font-bold text-sm uppercase focus:outline-none">
                    <span x-text="lang"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openLang ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </button>

                <div x-show="openLang" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-24 bg-white border border-gray-100 shadow-xl rounded-xl overflow-hidden py-1 z-50">
                    <button @click="lang = 'ID'; localStorage.setItem('lang', 'ID'); openLang = false; location.reload()" 
                            class="w-full text-left px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors text-sm flex items-center gap-2">
                        <span>🇮🇩</span> ID
                    </button>
                    <button @click="lang = 'EN'; localStorage.setItem('lang', 'EN'); openLang = false; location.reload()" 
                            class="w-full text-left px-4 py-2 hover:bg-violet-50 hover:text-violet-600 transition-colors text-sm flex items-center gap-2">
                        <span>🇺🇸</span> EN
                    </button>
                </div>
            </div>

            <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-violet-600 focus:outline-none">
                <svg x-show="!mobileMenu" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                <svg x-show="mobileMenu" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <nav class="lg:block bg-[#6B46C1] shadow-md transition-all duration-300"
         :class="mobileMenu ? 'block' : 'hidden'">
        <div class="container mx-auto px-0 lg:px-4">
            <ul class="flex flex-col lg:flex-row items-stretch lg:items-center text-sm font-medium text-white/90">
                <li class="border-b lg:border-none border-white/10">
                    <a href="/" class="block px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all">BERANDA</a>
                </li>
                
                <li class="relative border-b lg:border-none border-white/10"
                    @mouseenter="if(window.innerWidth >= 1024) openProfil = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openProfil = false">
                    <div @click="if(window.innerWidth < 1024) openProfil = !openProfil" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all cursor-pointer">
                        PROFIL 
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openProfil ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </div>
                    <ul x-show="openProfil" 
                        x-collapse.duration.300ms
                        class="lg:absolute lg:left-0 lg:top-full lg:w-56 bg-white lg:shadow-xl text-gray-800 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-violet-600">
                        <li><a href="/profil-ppid" class="block px-10 lg:px-4 py-3 hover:bg-violet-50 hover:text-violet-600">Profil PPID</a></li>
                        <li><a href="/visi-misi" class="block px-10 lg:px-4 py-3 hover:bg-violet-50 hover:text-violet-600">Visi & Misi</a></li>
                        <li><a href="/struktur-organisasi" class="block px-10 lg:px-4 py-3 hover:bg-violet-50 hover:text-violet-600">Struktur Organisasi</a></li>
                        <li><a href="/tupoksi" class="block px-10 lg:px-4 py-3 hover:bg-violet-50 hover:text-violet-600">Tugas & Fungsi</a></li>
                        <li><a href="/maklumat-pelayanan" class="block px-10 lg:px-4 py-3 hover:bg-violet-50 hover:text-violet-600">Maklumat Pelayanan</a></li>
                    </ul>
                </li>

                <li class="border-b lg:border-none border-white/10">
                    <a href="/berita" class="block px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all">BERITA</a>
                </li>

                <li class="relative border-b lg:border-none border-white/10"
                    @mouseenter="if(window.innerWidth >= 1024) openDaftar = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openDaftar = false">
                    <div @click="if(window.innerWidth < 1024) openDaftar = !openDaftar" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all cursor-pointer">
                        DAFTAR INFORMASI PUBLIK
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openDaftar ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </div>
                    <ul x-show="openDaftar" x-collapse.duration.300ms
                        class="lg:absolute lg:left-0 lg:top-full lg:w-64 bg-white lg:shadow-xl text-gray-800 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-violet-600">
                        <li><a href="#" class="block px-10 lg:px-4 py-3 hover:bg-violet-50 hover:text-violet-600">Informasi Publik Tahun 2024</a></li>
                        <li><a href="#" class="block px-10 lg:px-4 py-3 hover:bg-violet-50 hover:text-violet-600">Informasi Publik Tahun 2023</a></li>
                    </ul>
                </li>

                <li class="relative border-b lg:border-none border-white/10"
                    @mouseenter="if(window.innerWidth >= 1024) openLayanan = true" 
                    @mouseleave="if(window.innerWidth >= 1024) openLayanan = false">
                    <div @click="if(window.innerWidth < 1024) openLayanan = !openLayanan" 
                         class="flex items-center justify-between px-6 lg:px-4 py-4 hover:bg-white/10 hover:text-white transition-all cursor-pointer">
                        LAYANAN
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="openLayanan ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </div>
                    <ul x-show="openLayanan" x-collapse.duration.300ms
                        class="lg:absolute lg:left-0 lg:top-full lg:w-60 bg-white lg:shadow-xl text-gray-800 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-violet-600">
                        <li><a href="#" class="block px-10 lg:px-4 py-3 hover:bg-violet-50 hover:text-violet-600">Permohonan Informasi Online</a></li>
                        <li><a href="#" class="block px-10 lg:px-4 py-3 hover:bg-violet-50 hover:text-violet-600">Pengajuan Keberatan Online</a></li>
                    </ul>
                </li>

                <li class="lg:hidden border-b border-white/10">
                    <a href="/contact" class="block px-6 py-4 hover:bg-white/10 hover:text-white transition-all uppercase">CONTACT</a>
                </li>
            </ul>
        </div>
    </nav>
</header>