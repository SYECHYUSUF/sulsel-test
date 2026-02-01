<aside
    class="flex flex-col transition-all duration-300 bg-[#1A305E] text-white z-30 font-sans border-r border-slate-200/10 absolute md:static h-full shadow-xl md:shadow-none inset-y-0 left-0"
    style="view-transition-name: sidebar"
    :class="sidebarOpen ? 'w-72 translate-x-0' : 'w-20 -translate-x-full md:translate-x-0 md:w-24'">

    <div class="flex items-center h-20 bg-[#1A305E] transition-all duration-300"
        :class="sidebarOpen ? 'px-8 gap-4' : 'px-0 justify-center'">
        <img src="{{ asset('images/ppid-2.png') }}" alt="Logo PPID Sulawesi Selatan"
            class="transition-all duration-300 object-contain" :class="sidebarOpen ? 'h-12 w-auto' : 'h-7 w-7'" />

        <div class="logo-text flex flex-col overflow-hidden whitespace-nowrap transition-all duration-300"
            :class="sidebarOpen ? 'w-full opacity-100 ml-0' : 'w-0 opacity-0 hidden'">
            <span class="font-bold text-lg tracking-wide">ADMIN PANEL</span>
            <span class="text-slate-300">PPID Sulsel</span>
        </div>
    </div>

    <nav
        class="flex-1 overflow-y-auto overflow-x-hidden [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden py-4">
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

            @role('admin')
            {{-- Profil Dropdown --}}
            <x-sidebar-dropdown label="Profil" :active="request()->is('admin/profil*') || request()->is('admin/sambutan*') || request()->is('admin/visi-misi*') || request()->is('admin/tupoksi*') || request()->is('admin/maklumat*') || request()->is('admin/struktur-organisasi*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </x-slot>

                <x-sidebar-dropdown-link href="{{ route('admin.profil-ppid.index') }}"
                    :active="request()->is('admin/profil-ppid*')" label="Profil PPID" />
                <x-sidebar-dropdown-link href="{{ route('admin.sambutan.index') }}"
                    :active="request()->is('admin/sambutan*')" label="Sambutan" />
                <x-sidebar-dropdown-link href="{{ route('admin.struktur-organisasi.index') }}"
                    :active="request()->is('admin/struktur-organisasi*')" label="Struktur Organisasi" />
                <x-sidebar-dropdown-link href="{{ route('admin.visi-misi.index') }}"
                    :active="request()->is('admin/visi-misi*')" label="Visi Misi" />
                <x-sidebar-dropdown-link href="{{ route('admin.tupoksi.index') }}"
                    :active="request()->is('admin/tupoksi*')" label="Tupoksi" />
                <x-sidebar-dropdown-link href="{{ route('admin.maklumat.index') }}"
                    :active="request()->is('admin/maklumat*')" label="Maklumat" />
                <x-sidebar-dropdown-link href="{{ route('admin.profil-pemprov.index') }}"
                    :active="request()->is('admin/profil-pemprov*')" label="Profil Pemerintah Sulsel" />
                <x-sidebar-dropdown-link href="{{ route('admin.social-links.index') }}"
                    :active="request()->is('admin/social-links*')" label="Media Sosial" />
            </x-sidebar-dropdown>
            @endrole

            <x-sidebar-dropdown label="Layanan" :active="request()->is('admin/permohonan-informasi*') || request()->is('admin/pengajuan-keberatan*')">
                <x-slot name="icon">


                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M21.5 14c0-6.904 5.596-12.5 12.5-12.5S46.5 7.096 46.5 14S40.904 26.5 34 26.5S21.5 20.904 21.5 14m14 0a1.5 1.5 0 0 0-3 0v7a1.5 1.5 0 0 0 3 0zM34 6.5A1.5 1.5 0 0 1 35.5 8v1a1.5 1.5 0 0 1-3 0V8A1.5 1.5 0 0 1 34 6.5M13.889 28a6 6 0 1 0 0-12a6 6 0 0 0 0 12m-6.86 5.514c.275-1.539 1.484-2.708 3.04-2.847a45 45 0 0 1 3.932-.167c1.57 0 2.896.075 3.931.167c1.557.139 2.766 1.308 3.041 2.847c.105.584.217 1.253.329 1.987c-7.16.007-11.764.038-14.613.068c.116-.761.232-1.453.34-2.055m38.862 6.094c-.172-1.009-1.125-1.49-2.149-1.507C41.284 38.06 35.581 38 24 38c-11.58 0-17.283.062-19.742.1c-1.024.017-1.977.5-2.15 1.51A8.5 8.5 0 0 0 2 41.021c0 .556.042 1.014.105 1.39c.17 1.023 1.137 1.51 2.175 1.52C6.751 43.959 12.454 44 24 44s17.25-.042 19.72-.068c1.037-.012 2.004-.498 2.175-1.52c.063-.376.105-.835.105-1.39a8.4 8.4 0 0 0-.109-1.414"
                            clip-rule="evenodd" />
                    </svg>
                </x-slot>

                <x-sidebar-dropdown-link href="/admin/permohonan-informasi"
                    :active="request()->is('admin/permohonan-informasi*')" label="Permohonan Informasi" />
                <x-sidebar-dropdown-link href="/admin/pengajuan-keberatan"
                    :active="request()->is('admin/pengajuan-keberatan*')" label="Pengajuan Keberatan" />
            </x-sidebar-dropdown>

            <x-sidebar-dropdown label="Konten" :active="request()->is('admin/berita*') || request()->is('admin/faq*') || request()->is('admin/slide-banner*')">

                <x-slot name="icon">
                    {{-- Icon Folder/Layout untuk Konten --}}
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </x-slot>

                <x-sidebar-dropdown-link :href="route('admin.berita.index')"
                    :active="request()->routeIs('admin.berita.*')" label="Berita & Artikel" />

                {{-- Link FAQ & Slide Banner (Hanya untuk Admin) --}}
                @role('admin')
                <x-sidebar-dropdown-link :href="route('admin.faq.index')" :active="request()->routeIs('admin.faq.*')"
                    label="FAQ" />

                <x-sidebar-dropdown-link href="/admin/slide-banner" :active="request()->is('admin/slide-banner*')"
                    label="Slide Banner" />
                @endrole
            </x-sidebar-dropdown>

            <x-sidebar-dropdown label="Survey" :active="request()->is('admin/survey*')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 11l3 3L22 4" />
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                    </svg>
                </x-slot>

                <x-sidebar-dropdown-link href="{{ route('admin.survey-questions.index') }}"
                    :active="request()->is('admin/survey-questions*')" label="Kelola Survey" />
                <x-sidebar-dropdown-link href="{{ route('admin.survey-responses.index') }}"
                    :active="request()->is('admin/survey-responses*')" label="Hasil Survey" />
            </x-sidebar-dropdown>
        </ul>

        {{-- Manajemen Informasi --}}
        <div class="px-6 transition-all duration-300 overflow-hidden whitespace-nowrap"
            :class="sidebarOpen ? 'max-h-10 opacity-100 mb-2 mt-6' : 'max-h-0 opacity-0 mb-0 mt-0'">
            <span
                class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] whitespace-nowrap">{{ __('Manajemen Informasi') }}</span>
        </div>
        <ul>
            <x-sidebar-link href="{{ route('admin.matriks-dip.index') }}"
                :active="request()->routeIs('admin.matriks-dip.*')" label="Matriks DIP">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(90 12 12)" />
                        <path d="M2 12h20" />
                    </g>
                </svg>
            </x-sidebar-link>

            <x-sidebar-link href="{{ route('admin.dokumen-publik.index') }}"
                :active="request()->routeIs('admin.dokumen-publik.*')" label="Publikasi Dokumen">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
            </x-sidebar-link>
        </ul>

        {{-- Route khusus admin --}}
        @role('admin')
        <div class="px-6 transition-all duration-300 overflow-hidden whitespace-nowrap"
            :class="sidebarOpen ? 'max-h-10 opacity-100 mb-2 mt-6' : 'max-h-0 opacity-0 mb-0 mt-0'">
            <span
                class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] whitespace-nowrap">{{ __('Pengaturan Sistem') }}</span>
        </div>
        <ul>
            <x-sidebar-dropdown label="Pengaturan" :active="request()->is('admin/data-sop*') || request()->routeIs('admin.kategori-informasi.*') || request()->is('admin/skpd*')">

                <x-slot name="icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </x-slot>

                <x-sidebar-dropdown-link href="{{ route('admin.data-sop.index') }}"
                    :active="request()->is('admin/data-sop*')" label="Data SOP" />

                <x-sidebar-dropdown-link href="{{ route('admin.kategori-informasi.index') }}"
                    :active="request()->routeIs('admin.kategori-informasi.*')" label="Kategori Info" />

                <x-sidebar-dropdown-link href="{{ route('admin.skpd.index') }}" :active="request()->is('admin/skpd*')"
                    label="Data SKPD" />
            </x-sidebar-dropdown>

            <x-sidebar-link href="/admin/users" :active="request()->is('admin/users*')" label="Users">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </x-sidebar-link>
        </ul>
        @endrole

        {{-- Route khusus opd --}}
        @role('opd')
        <div class="px-6 transition-all duration-300 overflow-hidden whitespace-nowrap"
            :class="sidebarOpen ? 'max-h-10 opacity-100 mb-2 mt-6' : 'max-h-0 opacity-0 mb-0 mt-0'">
            <span
                class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px] whitespace-nowrap">{{ __('Pengaturan') }}</span>
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