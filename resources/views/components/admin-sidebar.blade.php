<aside class="shrink-0 w-72 flex flex-col transition-all duration-300 bg-[#1A305E] text-white z-20 font-sans"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64 absolute h-full'">

    <div class="flex items-center gap-3 px-6 py-4 bg-[#1A305E]">
        <img src="{{ asset('images/ppid-putih.png') }}" alt="Logo PPID Sulawesi Selatan"
            class="h-10 md:h-14 w-auto transition-transform group-hover:scale-105" />
    </div>

    <nav class="flex-1 overflow-y-auto [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
        <div class="px-10 mb-1 mt-2">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px]">Main Menu</span>
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

            <x-sidebar-link href="/admin/permohonan-informasi" :active="request()->is('admin/permohonan-informasi*')" label="Permohonan Info" badge="5">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
            </x-sidebar-link>

            <x-sidebar-link href="/admin/pengajuan-keberatan" :active="request()->is('admin/pengajuan-keberatan*')" label="Keberatan">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </x-sidebar-link>
        </ul>

        <div class="px-10 mb-1 mt-2">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px]">Content</span>
        </div>
        <ul>
            <x-sidebar-link :href="route('admin.berita.index')" :active="request()->routeIs('admin.berita.*')"
                label="Berita & Artikel">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                    </path>
                </svg>
            </x-sidebar-link>

            {{-- Route khusus admin --}}
            @role('admin')
            <x-sidebar-link href="/admin/slide-banner" :active="request()->is('admin/slide-banner*')" label="Slide Banner">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </x-sidebar-link>
            @endrole

            <x-sidebar-link href="/admin/data-sop" :active="request()->is('admin/data-sop*')" label="Data SOP">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
            </x-sidebar-link>
        </ul>

        <div class="px-10 mb-1 mt-2">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[2px]">System</span>
        </div>
        <ul>
            {{-- Route khusus admin --}}
            @role('admin')
            <x-sidebar-link href="/admin/users" :active="request()->is('admin/users*')" label="Users">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </x-sidebar-link>
            @endrole

            {{-- Route khusus admin --}}
            @role('admin')
            <x-sidebar-link href="/admin/data-skpd" :active="request()->is('admin/data-skpd*')" label="Data SKPD">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
            </x-sidebar-link>
            @endrole

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
    </nav>
</aside>