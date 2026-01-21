<aside 
    class="flex-shrink-0 w-64 flex flex-col transition-all duration-300 bg-[#1A305E] text-white z-20 font-sans"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64 absolute h-full'"
>
    <!-- Logo -->
    <div class="flex items-center gap-3 px-6 h-20 bg-[#1A305E]">
        <div class="p-1.5 bg-white/10 rounded-lg">
             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
        </div>
        <div>
            <h1 class="text-xl font-bold tracking-wide text-white leading-none">
                PPID <span class="text-[#D4AF37]">ADMIN</span>
            </h1>
            <span class="text-[10px] text-slate-400 uppercase tracking-widest">Sulawesi Selatan</span>
        </div>
    </div>

    <!-- Nav Links -->
    <nav class="flex-1 overflow-y-auto py-6 space-y-1">
        
        <!-- Section: Hospital (Main) -->
        <div class="px-6 mb-2 mt-2">
            <span class="text-xs font-bold text-slate-400/80 uppercase tracking-wider">Main Menu</span>
        </div>

        <ul>
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}" 
                   class="relative flex items-center px-6 py-3.5 text-sm font-medium transition-all duration-200
                   {{ request()->routeIs('admin.dashboard') 
                        ? 'bg-slate-50 text-[#1A305E] rounded-l-full ml-4 shadow-sm' 
                        : 'text-slate-300 hover:text-white hover:bg-white/5 mx-4 rounded-lg' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-[#D4AF37]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Dashboard
                    @if(request()->routeIs('admin.dashboard'))
                        <!-- Decor elements for smooth corner transition could go here if using complex CSS -->
                    @endif
                </a>
            </li>

            <!-- Permohonan Info -->
            <li>
                <a href="#" 
                   class="relative flex items-center px-6 py-3.5 text-sm font-medium transition-all duration-200
                   {{ request()->is('admin/permohonan*') 
                        ? 'bg-slate-50 text-[#1A305E] rounded-l-full ml-4 shadow-sm' 
                        : 'text-slate-300 hover:text-white hover:bg-white/5 mx-4 rounded-lg' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->is('admin/permohonan*') ? 'text-[#D4AF37]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Permohonan Info
                    <span class="ml-auto bg-[#D4AF37] text-[#1A305E] py-0.5 px-2 rounded-full text-[10px] font-bold">5</span>
                </a>
            </li>

            <!-- Pengajuan Keberatan -->
            <li>
                <a href="#" 
                   class="relative flex items-center px-6 py-3.5 text-sm font-medium transition-all duration-200
                   {{ request()->is('admin/keberatan*') 
                        ? 'bg-slate-50 text-[#1A305E] rounded-l-full ml-4 shadow-sm' 
                        : 'text-slate-300 hover:text-white hover:bg-white/5 mx-4 rounded-lg' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->is('admin/keberatan*') ? 'text-[#D4AF37]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Keberatan
                </a>
            </li>
        </ul>

        <!-- Section: Content -->
        <div class="px-6 mb-2 mt-6">
            <span class="text-xs font-bold text-slate-400/80 uppercase tracking-wider">Content Management</span>
        </div>
        
        <ul>
            <!-- Berita -->
            <li>
                <a href="{{ route('admin.berita.index') }}" 
                   class="relative flex items-center px-6 py-3.5 text-sm font-medium transition-all duration-200
                   {{ request()->routeIs('admin.berita.*') 
                        ? 'bg-slate-50 text-[#1A305E] rounded-l-full ml-4 shadow-sm' 
                        : 'text-slate-300 hover:text-white hover:bg-white/5 mx-4 rounded-lg' }}">
                     <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.berita.*') ? 'text-[#D4AF37]' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    Berita & Artikel
                </a>
            </li>

            <!-- Slide Banner -->
            <li>
                <a href="#" 
                   class="relative flex items-center px-6 py-3.5 text-sm font-medium transition-all duration-200
                   {{ request()->is('admin/slide*') 
                        ? 'bg-slate-50 text-[#1A305E] rounded-l-full ml-4 shadow-sm' 
                        : 'text-slate-300 hover:text-white hover:bg-white/5 mx-4 rounded-lg' }}">
                   <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Slide Banner
                </a>
            </li>
        </ul>

         <!-- Section: System -->
        <div class="px-6 mb-2 mt-6">
            <span class="text-xs font-bold text-slate-400/80 uppercase tracking-wider">System</span>
        </div>

        <ul>
            <!-- Users -->
             <li>
                <a href="#" 
                   class="relative flex items-center px-6 py-3.5 text-sm font-medium transition-all duration-200 text-slate-300 hover:text-white hover:bg-white/5 mx-4 rounded-lg">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Users
                </a>
            </li>
             <li>
                <a href="#" 
                   class="relative flex items-center px-6 py-3.5 text-sm font-medium transition-all duration-200 text-slate-300 hover:text-white hover:bg-white/5 mx-4 rounded-lg">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Data SKPD
                </a>
            </li>
             <li>
                <a href="#" 
                   class="relative flex items-center px-6 py-3.5 text-sm font-medium transition-all duration-200 text-slate-300 hover:text-white hover:bg-white/5 mx-4 rounded-lg">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </li>
        </ul>
    </nav>
</aside>
