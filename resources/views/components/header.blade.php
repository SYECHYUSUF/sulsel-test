<header class="fixed top-0 left-0 w-full z-50 font-['Plus_Jakarta_Sans'] transition-all duration-300"
    :class="scrolled ? 'bg-transparent shadow-none' : 'bg-white dark:bg-slate-900 shadow-sm'" x-data="{ 
            mobileMenu: false,
            openProfil: false, 
            openDaftar: false, 
            openInformasi: false, 
            openLayanan: false, 
            openService: false,
            openLang: false,
            lang: '{{ session('locale', 'id') }}'.toUpperCase(),
            darkMode: localStorage.getItem('theme') === 'dark',
            scrolled: false,
            init() {
                if (this.darkMode) document.documentElement.classList.add('dark');
                else document.documentElement.classList.remove('dark');
                
                // Listen to scroll events
                window.addEventListener('scroll', () => {
                    this.scrolled = window.scrollY > 50;
                });
            }
        }">

    {{-- 1. TOP BAR: LOGO & BAHASA --}}
    <div id="topbar"
        class="container mx-auto px-4 flex items-center justify-between transition-all duration-300 bg-white dark:bg-slate-900"
        :class="scrolled ? 'max-h-0 py-0 opacity-0 invisible' : 'max-h-32 py-4 md:py-6 opacity-100 visible'">
        <a href="/" class="flex items-center gap-3 group">
            {{-- Logo Image --}}
            <img src="{{ asset('images/ppid-2.png') }}" alt="Logo PPID Sulawesi Selatan"
                class="h-10 md:h-14 w-auto transition-transform group-hover:scale-105" />

            {{-- TEKS SAMPING LOGO --}}
            <div class="flex-col justify-center md:flex hidden">
                <span
                    class="font-extrabold text-ppid-primary dark:text-white text-xs md:text-base leading-tight group-hover:text-ppid-accent transition-colors font-['Plus_Jakarta_Sans']">
                    {{ __('messages.header.title_1') }}
                </span>
                <span class="font-bold text-ppid-accent text-[10px] md:text-xs tracking-[0.15em] uppercase mt-0.5">
                    {{ __('messages.header.title_2') }}
                </span>
            </div>
        </a>

        <div class="flex items-center gap-3 md:gap-4">
            {{-- Login Button --}}
            <a href="/login"
                class="hidden lg:flex items-center gap-1.5 text-sm font-medium text-ppid-text dark:text-gray-300 hover:text-ppid-accent transition-colors">
                Login
            </a>

            {{-- Search Trigger Button --}}
            <button @click="$dispatch('open-search')"
                class="p-2 rounded-full text-ppid-text dark:text-gray-300 hover:text-ppid-accent hover:bg-ppid-primary/5 dark:hover:bg-white/10 transition-all"
                aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>

            {{-- Dark Mode Toggle --}}
            <button
                @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light'); if(darkMode) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark');"
                class="p-2 rounded-full text-ppid-text dark:text-gray-300 hover:text-ppid-accent hover:bg-ppid-primary/5 dark:hover:bg-white/10 transition-all">
                <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>

            {{-- Dropdown Bahasa --}}
            <div class="relative" @click.away="openLang = false">
                <button @click="openLang = !openLang"
                    class="flex items-center gap-1 text-ppid-text dark:text-gray-300 hover:text-ppid-accent transition-colors font-bold uppercase focus:outline-none text-sm">
                    <span x-text="lang"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform"
                        :class="openLang ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <div x-show="openLang" x-transition
                    class="absolute right-0 mt-2 w-24 bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 shadow-xl rounded-xl overflow-hidden py-1 z-[60]">
                    <a href="/lang/id"
                        class="block w-full text-left px-4 py-2 hover:bg-ppid-accent/10 hover:text-ppid-accent dark:text-gray-200 transition-colors text-sm">🇮🇩
                        ID</a>
                    <a href="/lang/en"
                        class="block w-full text-left px-4 py-2 hover:bg-ppid-accent/10 hover:text-ppid-accent dark:text-gray-200 transition-colors text-sm">🇺🇸
                        EN</a>
                </div>
            </div>

            {{-- Social Media Icons - Desktop Only --}}
            @php
                $socials = \App\Models\Sosmed::orderBy('urutan')->get();
            @endphp
            <div class="hidden lg:flex items-center gap-2">
                @foreach($socials as $soc)
                    <a href="{{ $soc->link_sosmed }}" title="{{ $soc->judul }}" target="_blank" rel="noopener noreferrer"
                        class="group p-1.5 rounded-lg text-ppid-text dark:text-gray-300 hover:text-ppid-accent hover:bg-ppid-primary/5 dark:hover:bg-white/10 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="transition-transform group-hover:scale-110">
                            {!! $soc->icon_sosmed !!}
                        </svg>
                    </a>
                @endforeach
            </div>
            {{-- TOMBOL HAMBURGER: Hanya muncul di Mobile --}}
            <button @click="mobileMenu = !mobileMenu"
                class="lg:hidden p-2 rounded-lg bg-ppid-primary/5 dark:bg-white/10 text-ppid-primary dark:text-white">
                <svg x-show="!mobileMenu" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                <svg x-show="mobileMenu" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- 2. NAVIGATION BAR --}}
    <nav class="bg-ppid-primary shadow-md transition-all duration-300 relative"
        :class="mobileMenu ? 'block' : 'hidden lg:block'">

        <div class="container mx-auto px-0 lg:px-4 py-4">
            <ul
                class="flex flex-col lg:flex-row items-stretch justify-center lg:items-center text-xs lg:text-sm font-medium text-white/90">

                {{-- SEARCH (Mobile Only) --}}
                <li class="lg:hidden px-6 py-4 border-b border-white/10">
                    <form action="/search" method="GET" class="relative">
                        <input type="text" name="query" placeholder="{{ __('messages.common.search_info') }}"
                            class="w-full py-2 pl-4 pr-10 rounded-lg bg-white/10 border-2 border-white/30 text-white placeholder-white/70 text-sm focus:bg-white/20 focus:border-ppid-accent focus:outline-none focus:ring-2 focus:ring-ppid-accent/30">
                        <button type="submit"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-white/70 hover:text-ppid-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </form>
                </li>

                {{-- BERANDA --}}
                <li class="border-b lg:border-none border-white/10">
                    <a href="/"
                        class="block px-6 lg:px-4 py-4 hover:text-ppid-accent transition-all relative group {{ request()->is('/') ? 'text-ppid-accent' : '' }}">
                        {{ __('messages.header.home') }}
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-ppid-accent scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block {{ request()->is('/') ? 'scale-x-100' : '' }}"></span>
                    </a>
                </li>

                {{-- Dropdown Profil --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openProfil = true"
                    @mouseleave="if(window.innerWidth >= 1024) openProfil = false">
                    <div @click="if(window.innerWidth < 1024) openProfil = !openProfil"
                        class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-ppid-accent transition-all cursor-pointer relative {{ request()->is('profil-ppid*', 'sambutan*', 'struktur-organisasi*', 'visi-misi*', 'tupoksi*', 'maklumat-pelayanan*', 'profil-pemprov*') ? 'text-ppid-accent' : '' }}">
                        <span>{{ __('messages.header.profile') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-ppid-accent"
                            :class="openProfil ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-ppid-accent scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block {{ request()->is('profil-ppid*', 'sambutan*', 'struktur-organisasi*', 'visi-misi*', 'tupoksi*', 'maklumat-pelayanan*', 'profil-pemprov*') ? 'scale-x-100' : '' }}"></span>
                    </div>
                    <ul x-show="openProfil" x-transition:enter="transition ease-out duration-300 transform origin-top"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform origin-top"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white dark:bg-slate-800 lg:shadow-xl text-ppid-primary dark:text-gray-200 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-ppid-accent z-50">
                        <li><a href="/profil-ppid"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent transition-colors border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('profil-ppid') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.ppid_profile') }}</a>
                        </li>
                        <li><a href="/sambutan"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent transition-colors border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('sambutan') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.greeting') }}</a>
                        </li>
                        <li><a href="/struktur-organisasi"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent transition-colors border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('struktur-organisasi') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.org_structure') }}</a>
                        </li>
                        <li><a href="/visi-misi"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent transition-colors border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('visi-misi') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.vision_mission') }}</a>
                        </li>
                        <li><a href="/tupoksi"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent transition-colors border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('tupoksi') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.duties_functions') }}</a>
                        </li>
                        <li><a href="/maklumat-pelayanan"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent transition-colors border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('maklumat-pelayanan') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.service_declaration') }}</a>
                        </li>
                        <li><a href="/profil-pemprov"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent transition-colors border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('profil-pemprov') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.government_profile') }}</a>
                        </li>
                    </ul>
                </li>

                {{-- BERITA --}}
                <li class="border-b lg:border-none border-white/10">
                    <a href="/berita"
                        class="block px-6 lg:px-4 py-4 hover:text-ppid-accent transition-all relative group {{ request()->is('berita*') ? 'text-ppid-accent' : '' }}">
                        {{ __('messages.header.news') }}
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-ppid-accent scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block {{ request()->is('berita*') ? 'scale-x-100' : '' }}"></span>
                    </a>
                </li>

                {{-- Dropdown Data Informasi Publik (Formerly Daftar) --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openDaftar = true"
                    @mouseleave="if(window.innerWidth >= 1024) openDaftar = false">
                    <div @click="if(window.innerWidth < 1024) openDaftar = !openDaftar"
                        class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-ppid-accent transition-all cursor-pointer relative {{ request()->is('informasi-publik/20*', 'informasi-publik/pengadaan*') ? 'text-ppid-accent' : '' }}">
                        <span>{{ __('messages.header.data_info') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-ppid-accent"
                            :class="openDaftar ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-ppid-accent scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block {{ request()->is('informasi-publik/20*', 'informasi-publik/pengadaan*') ? 'scale-x-100' : '' }}"></span>
                    </div>

                    {{-- Mengambil Data Tahun (Hanya dijalankan saat file ini dimuat) --}}
                    @php
                        $daftarTahun = \App\Models\MasterTahun::whereNotNull('waktu')
                            ->orderBy('waktu', 'desc')
                            ->get();
                    @endphp

                    <ul x-show="openDaftar" x-transition:enter="transition ease-out duration-300 transform origin-top"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform origin-top"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white dark:bg-slate-800 lg:shadow-xl text-ppid-primary dark:text-gray-200 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-ppid-accent z-50">
                        @foreach($daftarTahun as $tahun)
                            <li><a href="{{ route('informasi-publik.tahun', $tahun->waktu) }}"
                                    class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('informasi-publik/tahun/' . $tahun->waktu) ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.data_info_prefix') }}
                                    {{ $tahun->waktu }}</a>
                            </li>
                        @endforeach
                        <li><a href="/informasi-publik/pengadaan"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('informasi-publik/pengadaan') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.procurement_info') }}</a>
                        </li>
                    </ul>
                </li>

                {{-- Dropdown Informasi Publik --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openInformasi = true"
                    @mouseleave="if(window.innerWidth >= 1024) openInformasi = false">
                    <div @click="if(window.innerWidth < 1024) openInformasi = !openInformasi"
                        class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-ppid-accent transition-all cursor-pointer relative {{ request()->is('informasi-publik/serta-merta*', 'informasi-publik/setiap-saat*', 'informasi-publik/dikecualikan*', 'informasi-publik/berkala*', 'informasi-publik') ? 'text-ppid-accent' : '' }}">
                        <span>{{ __('messages.header.public_info') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-ppid-accent"
                            :class="openInformasi ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-ppid-accent scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block {{ request()->is('informasi-publik/serta-merta*', 'informasi-publik/setiap-saat*', 'informasi-publik/dikecualikan*', 'informasi-publik/berkala*', 'informasi-publik') ? 'scale-x-100' : '' }}"></span>
                    </div>

                    {{-- Mengambil Data Kategori (Hanya dijalankan saat file ini dimuat) --}}
                    @php
                        $kategoriInfo = \App\Models\KategoriInformasi::where('is_active', 1)
                            ->orderBy('nm_kat_info', 'asc')
                            ->get();
                    @endphp

                    <ul x-show="openInformasi"
                        x-transition:enter="transition ease-out duration-300 transform origin-top"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform origin-top"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-72 bg-white dark:bg-slate-800 lg:shadow-xl text-ppid-primary dark:text-gray-200 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-ppid-accent z-50">
                        @foreach ($kategoriInfo as $kategori)
                            <li><a href="/informasi-publik/{{ \Illuminate\Support\Str::slug($kategori->nm_kat_info) }}"
                                    class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('informasi-publik/' . \Illuminate\Support\Str::slug($kategori->nm_kat_info)) ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">
                                    {{ $kategori->nm_kat_info }}
                                </a>
                            </li>
                        @endforeach
                        <li><a href="/informasi-publik"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('informasi-publik') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.public_info_list') }}</a>
                        </li>
                    </ul>
                </li>

                <li class="border-b lg:border-none border-white/10">
                    <a href="/ppid-pelaksana"
                        class="block px-6 lg:px-4 py-4 hover:text-ppid-accent transition-all relative group {{ request()->is('ppid-pelaksana*') ? 'text-ppid-accent' : '' }}">
                        {{ __('messages.header.ppid_implementing') }}
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-ppid-accent scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block {{ request()->is('ppid-pelaksana*') ? 'scale-x-100' : '' }}"></span>
                    </a>
                </li>

                {{-- Dropdown Layanan --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openLayanan = true"
                    @mouseleave="if(window.innerWidth >= 1024) openLayanan = false">
                    <div @click="if(window.innerWidth < 1024) openLayanan = !openLayanan"
                        class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-ppid-accent transition-all cursor-pointer relative {{ request()->is('layanan*', 'contact*') ? 'text-ppid-accent' : '' }}">
                        <span>{{ __('messages.header.services') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-ppid-accent"
                            :class="openLayanan ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-ppid-accent scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block {{ request()->is('layanan*', 'contact*') ? 'scale-x-100' : '' }}"></span>
                    </div>
                    {{-- Kode Baru (Perbaikan) --}}
                    <ul x-show="openLayanan" x-transition:enter="transition ease-out duration-300 transform origin-top"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform origin-top"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-64 bg-white dark:bg-slate-800 lg:shadow-xl text-ppid-primary dark:text-gray-200 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-ppid-accent z-50">

                        <li>
                            <a href="/layanan/permohonan-informasi"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('layanan/permohonan-informasi') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">
                                {{ __('messages.menu.info_request_service') }}
                            </a>
                        </li>

                        <li>
                            <a href="/layanan/pengajuan-keberatan"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('layanan/pengajuan-keberatan') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">
                                {{ __('messages.menu.objection_service') }}
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('layanan.cek-status') }}"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('layanan/cek-status*') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">
                                Cek Status
                            </a>
                        </li>


                        <li>
                            <a href="/layanan/sop"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('layanan/sop') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">
                                {{ __('messages.menu.sop') }}
                            </a>
                        </li>

                        <li>
                            <a href="/contact"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('contact') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">
                                {{ __('messages.header.contact') }}
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Dropdown Survey --}}
                <li class="relative border-b lg:border-none border-white/10 group"
                    @mouseenter="if(window.innerWidth >= 1024) openService = true"
                    @mouseleave="if(window.innerWidth >= 1024) openService = false">
                    <div @click="if(window.innerWidth < 1024) openService = !openService"
                        class="flex items-center justify-between px-6 lg:px-4 py-4 hover:text-ppid-accent transition-all cursor-pointer relative {{ request()->is('survey*') ? 'text-ppid-accent' : '' }}">
                        <span>{{ __('messages.header.survey') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform text-ppid-accent"
                            :class="openService ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                        <span
                            class="absolute bottom-0 left-0 w-full h-[3px] bg-ppid-accent scale-x-0 group-hover:scale-x-100 transition-transform origin-left hidden lg:block {{ request()->is('survey*') ? 'scale-x-100' : '' }}"></span>
                    </div>
                    <ul x-show="openService" x-transition:enter="transition ease-out duration-300 transform origin-top"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform origin-top"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="lg:absolute lg:left-0 lg:top-full w-full lg:w-56 bg-white dark:bg-slate-800 lg:shadow-xl text-ppid-primary dark:text-gray-200 py-2 lg:rounded-b-lg lg:border-t-4 lg:border-ppid-accent z-50">
                        <li><a href="/survey/isi-survey"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('survey/isi-survey') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.fill_survey') }}</a>
                        </li>
                        <li><a href="/survey/hasil-survey"
                                class="block px-10 lg:px-6 py-3 hover:bg-ppid-primary/5 hover:text-ppid-accent border-l-4 border-transparent hover:border-ppid-accent {{ request()->is('survey/hasil-survey') ? 'text-ppid-accent border-ppid-accent bg-ppid-primary/5' : '' }}">{{ __('messages.menu.survey_results') }}</a>
                        </li>
                    </ul>
                </li>




                {{-- Login Mobile Only --}}
                <li class="lg:hidden border-b border-white/10">
                    <a href="/login" class="flex items-center gap-2 px-6 py-4 hover:bg-white/10 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

{{-- Search Modal Component --}}
<x-dokumen-publik-search />