<header class="z-50 bg-slate-50 dark:bg-slate-800 sticky top-0 h-20 flex items-center justify-between px-8 py-5 transition-colors duration-300 shadow-sm">
    <div class="flex-1 flex items-center max-w-2xl gap-4">
        <button @click="toggleSidebar()" class="p-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div class="relative flex-1 group">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-slate-400 group-hover:text-[#D4AF37] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input type="text" 
                   class="w-full py-2.5 pl-10 pr-4 text-sm text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-full focus:outline-none focus:ring-2 focus:ring-[#D4AF37]/50 focus:border-[#D4AF37] transition-all shadow-sm placeholder-slate-400 dark:placeholder-slate-500"
                   placeholder="{{ __('Search...') }}">
        </div>
    </div>

    <div class="flex items-center gap-4">
        {{-- Language Switcher --}}
        <div class="relative" x-data="{ openLang: false }" @click.away="openLang = false">
            <button @click="openLang = !openLang" class="flex items-center gap-2 p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                <span class="text-sm font-bold text-slate-600 dark:text-slate-300 uppercase">{{ app()->getLocale() }}</span>
                <svg class="w-4 h-4 text-slate-500 transition-transform duration-200" :class="{'rotate-180': openLang}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="openLang" 
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 class="absolute right-0 mt-2 w-32 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-xl shadow-xl py-1 z-50 overflow-hidden"
                 style="display: none;">
                <a href="{{ url('lang/id') }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 {{ app()->getLocale() == 'id' ? 'font-bold text-[#1A305E] dark:text-[#D4AF37]' : '' }}">
                    Bahasa (ID)
                </a>
                <a href="{{ url('lang/en') }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 {{ app()->getLocale() == 'en' ? 'font-bold text-[#1A305E] dark:text-[#D4AF37]' : '' }}">
                    English (EN)
                </a>
            </div>
        </div>

        {{-- Dark Mode Toggle --}}
        <button @click="toggleDarkMode()" 
                class="p-2 rounded-full text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-700 transition-colors"
                title="Toggle Dark Mode">
            <!-- Sun Icon (showing in light mode) -->
            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <!-- Moon Icon (showing in dark mode) -->
            <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>
        
        {{-- Notification Bell --}}
        @php
            $unreadCount = \App\Models\Notification::where(function($query) {
                    $query->where('to_user_id', auth()->id())
                          ->orWhere('to_skpd_id', auth()->user()->id_skpd);
                })
                ->whereNull('read_at')
                ->count();
        @endphp
        <div class="relative" x-data="{ openNotif: false }" @click.away="openNotif = false">
            <button @click="openNotif = !openNotif" class="p-2 rounded-full text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-700 transition-colors relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                @if($unreadCount > 0)
                    <span class="absolute top-1 right-1 flex h-4 w-4">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500 text-[10px] text-white items-center justify-center font-bold">
                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                        </span>
                    </span>
                @endif
            </button>
            <div x-show="openNotif" 
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 class="absolute right-0 mt-3 w-80 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-2xl shadow-2xl py-2 z-50 overflow-hidden"
                 style="display: none;">
                <div class="px-4 py-2 border-b border-slate-50 dark:border-slate-700 flex justify-between items-center">
                    <span class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase">Notifikasi</span>
                    <a href="{{ route('admin.notifications.index') }}" class="text-[10px] font-bold text-blue-600 hover:underline">Lihat Semua</a>
                </div>
                <div class="max-h-96 overflow-y-auto">
                    @php
                        $headerNotifs = \App\Models\Notification::where(function($query) {
                                $query->where('to_user_id', auth()->id())
                                      ->orWhere('to_skpd_id', auth()->user()->id_skpd);
                            })
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp
                    @forelse($headerNotifs as $n)
                        <a href="{{ $n->url ?? '#' }}"
                            onclick="event.preventDefault(); markAsRead('{{ $n->id_notification }}', '{{ $n->url }}')"
                            class="block px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors border-b border-slate-50 dark:border-slate-700 last:border-0">
                            <div class="flex gap-3">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="p-1.5 {{ $n->read_at ? 'bg-slate-100 text-slate-400' : 'bg-blue-100 text-blue-600' }} rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold text-slate-800 dark:text-slate-200 truncate">{{ $n->title }}</p>
                                    <p class="text-[10px] text-slate-500 mt-0.5 line-clamp-2">{{ $n->message }}</p>
                                    <p class="text-[9px] text-slate-400 mt-1">{{ $n->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="px-4 py-8 text-center">
                            <p class="text-xs text-slate-400 italic">Tidak ada notifikasi baru.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Profile Dropdown --}}
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open" class="flex items-center space-x-3 cursor-pointer group focus:outline-none">
                <div class="h-10 w-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center overflow-hidden border-2 border-white dark:border-slate-600 shadow-md ring-2 ring-transparent group-hover:ring-[#D4AF37]/50 transition-all">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1A305E&color=D4AF37" alt="Admin" class="h-full w-full object-cover">
                </div>
                <div class="text-left hidden lg:block">
                    <div class="flex items-center">
                        <span class="text-sm font-bold text-[#1A305E] dark:text-slate-200 group-hover:text-[#D4AF37] transition-colors">
                            {{ auth()->user()->name }}
                        </span> 
                        <svg class="w-4 h-4 text-slate-400 ml-1 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    
                    <div class="text-[10px] text-slate-500 dark:text-slate-400 font-medium">
                        {{ auth()->user()->roles->first()->display_name ?? auth()->user()->email }}
                    </div>
                </div>
            </button>

            <div x-show="open" 
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-3 w-48 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-xl shadow-xl py-2 z-50 overflow-hidden"
                    style="display: none;">
                
                <a href="/admin/profile" class="flex items-center px-4 py-2.5 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-[#D4AF37] transition-colors">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    {{ __('Profil') }}
                </a>

                <a href="/settings" class="flex items-center px-4 py-2.5 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-[#D4AF37] transition-colors">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ __('Pengaturan') }}
                </a>

                <div class="border-t border-slate-100 dark:border-slate-700 my-1"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    if (typeof markAsRead !== 'function') {
        function markAsRead(id, url = null) {
            fetch(`/admin/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            }).then(() => {
                if (url && url !== 'null' && url !== 'undefined' && url !== '#') {
                    window.location.href = url;
                } else {
                    window.location.reload();
                }
            });
        }
    }
</script>