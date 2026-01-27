<aside class="flex flex-col transition-all duration-300 bg-[#1A305E] text-white z-30 font-sans border-r border-slate-200/10 absolute md:static h-full shadow-xl md:shadow-none inset-y-0 left-0"
    style="view-transition-name: sidebar"
    :class="sidebarOpen ? 'w-72 translate-x-0' : 'w-20 -translate-x-full md:translate-x-0 md:w-24'">

    <div class="flex items-center h-20 bg-[#1A305E] transition-all duration-300"
         :class="sidebarOpen ? 'px-8 gap-4' : 'px-0 justify-center'">
        <img src="{{ asset('images/ppid-2.png') }}" alt="Logo PPID Sulawesi Selatan"
            class="transition-all duration-300 object-contain"
            :class="sidebarOpen ? 'h-12 w-auto' : 'h-10 w-10'" />
            
        <div class="logo-text flex flex-col overflow-hidden whitespace-nowrap transition-all duration-300"
             :class="sidebarOpen ? 'w-full opacity-100 ml-0' : 'w-0 opacity-0 hidden'">
            <span class="font-bold text-sm tracking-wide">PPID</span>
            <span class="text-[10px] text-slate-300">Sulawesi Selatan</span>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto overflow-x-hidden [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden py-4">
        <div class="px-6 transition-all duration-300 overflow-hidden whitespace-nowrap" 
             :class="sidebarOpen ? 'max-h-10 opacity-100 mb-2 mt-2' : 'max-h-0 opacity-0 mb-0 mt-0'">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] whitespace-nowrap">
                {{ __('Main Menu') }}
            </span>
        </div>
        <ul>
            <x-sidebar-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                label="Dashboard">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
            </x-sidebar-link>   
        </ul>

        {{-- Route opd --}}
        @role('opd')
        <div class="px-6 transition-all duration-300 overflow-hidden whitespace-nowrap" 
             :class="sidebarOpen ? 'max-h-10 opacity-100 mb-2 mt-6' : 'max-h-0 opacity-0 mb-0 mt-0'">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] whitespace-nowrap">{{ __('Layanan') }}</span>
        </div>
        <ul>   
            <x-sidebar-link href="/admin/pengajuan-keberatan" :active="request()->is('admin/pengajuan-keberatan*')"
                label="Pengajuan Keberatan">
                
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><path fill="currentColor" fill-rule="evenodd" d="M21.5 14c0-6.904 5.596-12.5 12.5-12.5S46.5 7.096 46.5 14S40.904 26.5 34 26.5S21.5 20.904 21.5 14m14 0a1.5 1.5 0 0 0-3 0v7a1.5 1.5 0 0 0 3 0zM34 6.5A1.5 1.5 0 0 1 35.5 8v1a1.5 1.5 0 0 1-3 0V8A1.5 1.5 0 0 1 34 6.5M13.889 28a6 6 0 1 0 0-12a6 6 0 0 0 0 12m-6.86 5.514c.275-1.539 1.484-2.708 3.04-2.847a45 45 0 0 1 3.932-.167c1.57 0 2.896.075 3.931.167c1.557.139 2.766 1.308 3.041 2.847c.105.584.217 1.253.329 1.987c-7.16.007-11.764.038-14.613.068c.116-.761.232-1.453.34-2.055m38.862 6.094c-.172-1.009-1.125-1.49-2.149-1.507C41.284 38.06 35.581 38 24 38c-11.58 0-17.283.062-19.742.1c-1.024.017-1.977.5-2.15 1.51A8.5 8.5 0 0 0 2 41.021c0 .556.042 1.014.105 1.39c.17 1.023 1.137 1.51 2.175 1.52C6.751 43.959 12.454 44 24 44s17.25-.042 19.72-.068c1.037-.012 2.004-.498 2.175-1.52c.063-.376.105-.835.105-1.39a8.4 8.4 0 0 0-.109-1.414" clip-rule="evenodd"/></svg>
            </x-sidebar-link>
        </ul>
        @endrole

        {{-- Manajemen Informasi --}}
        <div class="px-6 transition-all duration-300 overflow-hidden whitespace-nowrap" 
             :class="sidebarOpen ? 'max-h-10 opacity-100 mb-2 mt-6' : 'max-h-0 opacity-0 mb-0 mt-0'">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] whitespace-nowrap">{{ __('Manajemen Informasi') }}</span>
        </div>
        <ul>
            <x-sidebar-link href="{{ route('admin.matriks-dip.index') }}"
                :active="request()->routeIs('admin.matriks-dip.*')" label="Matriks DIP">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="12" r="10"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(90 12 12)"/><path d="M2 12h20"/></g></svg>
            </x-sidebar-link>

            <x-sidebar-link href="{{ route('admin.dokumen-publik.index') }}"
                :active="request()->routeIs('admin.dokumen-publik.*')" label="Publikasi Dokumen">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
            </x-sidebar-link>

            {{-- <x-sidebar-link href="{{ route('admin.kategori-informasi.index') }}"
                :active="request()->routeIs('admin.kategori-informasi.*')" label="Kategori Info">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                    </path>
                </svg>
            </x-sidebar-link> --}}

            {{-- <x-sidebar-link href="{{ route('admin.informasi-setiap-saat.index') }}"
                :active="request()->routeIs('admin.informasi-setiap-saat.*')" label="Info Setiap Saat">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </x-sidebar-link>

            <x-sidebar-link href="{{ route('admin.informasi-serta-merta.index') }}"
                :active="request()->routeIs('admin.informasi-serta-merta.*')" label="Info Serta Merta">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </x-sidebar-link>

            <x-sidebar-link href="{{ route('admin.informasi-daftar-publik.index') }}"
                :active="request()->routeIs('admin.informasi-daftar-publik.*')" label="Info Daftar Publik">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
            </x-sidebar-link>  --}}
        </ul>


        <div class="px-6 transition-all duration-300 overflow-hidden whitespace-nowrap" 
             :class="sidebarOpen ? 'max-h-10 opacity-100 mb-2 mt-6' : 'max-h-0 opacity-0 mb-0 mt-0'">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] whitespace-nowrap">{{ __('Konten') }}</span>
        </div>
        <ul>
            @role('opd')
            <x-sidebar-link :href="route('admin.berita.index')" :active="request()->routeIs('admin.berita.*')"
                label="Berita & Artikel">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                    </path>
                </svg>
            </x-sidebar-link>
            @endrole

            
            {{-- Route khusus admin --}}
            @role('admin')
            <x-sidebar-link href="/admin/permohonan-informasi" :active="request()->is('admin/permohonan-informasi*')"
                label="Permohonan Informasi">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.357 7.714l6.98 4.654c.963.641 1.444.962 1.964 1.087c.46.11.939.11 1.398 0c.52-.125 1.001-.446 1.964-1.087l6.98-4.654M7.157 19.5h9.686c1.68 0 2.52 0 3.162-.327a3 3 0 0 0 1.31-1.311c.328-.642.328-1.482.328-3.162V9.3c0-1.68 0-2.52-.327-3.162a3 3 0 0 0-1.311-1.311c-.642-.327-1.482-.327-3.162-.327H7.157c-1.68 0-2.52 0-3.162.327a3 3 0 0 0-1.31 1.311c-.328.642-.328 1.482-.328 3.162v5.4c0 1.68 0 2.52.327 3.162a3 3 0 0 0 1.311 1.311c.642.327 1.482.327 3.162.327"/></svg>
            </x-sidebar-link>

            <x-sidebar-link :href="route('admin.faq.index')" :active="request()->routeIs('admin.faq.*')" label="FAQ">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-message-circle-question-mark-icon lucide-message-circle-question-mark">
                    <path
                        d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <path d="M12 17h.01" />
                </svg>
            </x-sidebar-link>


            <x-sidebar-link href="/admin/slide-banner" :active="request()->is('admin/slide-banner*')"
                label="Slide Banner">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </x-sidebar-link>
            @endrole
        </ul>

        {{-- Route khusus admin --}}
        @role('admin')
        <div class="px-6 transition-all duration-300 overflow-hidden whitespace-nowrap" 
             :class="sidebarOpen ? 'max-h-10 opacity-100 mb-2 mt-6' : 'max-h-0 opacity-0 mb-0 mt-0'">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] whitespace-nowrap">{{ __('Pengaturan') }}</span>
        </div>
        <ul>
            <x-sidebar-link href="{{ route('admin.data-sop.index') }}" :active="request()->is('admin/data-sop*')"
                label="Data SOP">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                        <path
                            d="M5 8c0-2.828 0-4.243.879-5.121C6.757 2 8.172 2 11 2h2c2.828 0 4.243 0 5.121.879C19 3.757 19 5.172 19 8v8c0 2.828 0 4.243-.879 5.121C17.243 22 15.828 22 13 22h-2c-2.828 0-4.243 0-5.121-.879C5 20.243 5 18.828 5 16zm0-3.924c-.975.096-1.631.313-2.121.803C2 5.757 2 7.172 2 10v4c0 2.828 0 4.243.879 5.121c.49.49 1.146.707 2.121.803M19 4.076c.975.096 1.631.313 2.121.803C22 5.757 22 7.172 22 10v4c0 2.828 0 4.243-.879 5.121c-.49.49-1.146.707-2.121.803" />
                        <path stroke-linecap="round" d="M9 13h6M9 9h6m-6 8h3" />
                    </g>
                </svg>
            </x-sidebar-link>

            <x-sidebar-link href="{{ route('admin.kategori-informasi.index') }}"
                :active="request()->routeIs('admin.kategori-informasi.*')" label="Kategori Info">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                    </path>
                </svg>
            </x-sidebar-link>

            <x-sidebar-link href="/admin/users" :active="request()->is('admin/users*')" label="Users">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </x-sidebar-link>

            <x-sidebar-link href="{{ route('admin.skpd.index') }}" :active="request()->is('admin/skpd*')"
                label="Data SKPD">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
            </x-sidebar-link>

             <x-sidebar-link href="{{ route('admin.struktur-organisasi.index') }}" :active="request()->is('admin/struktur-organisasi*')"
                label="Struktur Organisasi">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="3" rx="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg>
            </x-sidebar-link>

            <x-sidebar-link href="/admin/pengaturan" :active="request()->is('admin/pengaturan*')" label="Pengaturan">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </x-sidebar-link>
        </ul>
        @endrole

        {{-- Route khusus opd --}}
        @role('opd')
        <div class="px-6 transition-all duration-300 overflow-hidden whitespace-nowrap" 
             :class="sidebarOpen ? 'max-h-10 opacity-100 mb-2 mt-6' : 'max-h-0 opacity-0 mb-0 mt-0'">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] whitespace-nowrap">{{ __('Pengaturan') }}</span>
        </div>
        <ul>
            <x-sidebar-link href="{{ route('admin.skpd.show', auth()->user()->id_skpd) }}"
                :active="request()->is('admin/skpd*')" label="Profil SKPD">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
            </x-sidebar-link>
        </ul>
        @endrole
    </nav>
</aside>