<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-8">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-[#1A305E] dark:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-medium">{{ __('messages.breadcrumb.profile') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-bold">{{ __('messages.ppid_pelaksana.title') }}</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-2">
                        {{ __('messages.ppid_pelaksana.title') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('messages.ppid_pelaksana.subtitle') }}
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-24 h-1.5 bg-gradient-to-r from-[#1A305E] to-[#D4AF37] rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-12 md:py-20 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                
                {{-- Minimal Search Bar --}}
                <div class="mb-12">
                    <form method="GET" action="{{ url('/ppid-pelaksana') }}" class="max-w-2xl mx-auto">
                        <div class="relative bg-white dark:bg-slate-800 rounded-xl shadow-lg hover:shadow-xl border-2 border-[#1A305E]/20 dark:border-slate-700 hover:border-[#D4AF37]/50 transition-all duration-300">
                            <div class="flex items-center gap-2 p-2">
                                {{-- Search Input --}}
                                <input type="text" 
                                       name="search" 
                                       id="searchInput" 
                                       value="{{ $search ?? '' }}"
                                       placeholder="Cari SKPD..." 
                                       class="flex-1 px-4 py-3 text-base bg-transparent text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none">

                                {{-- Action Button --}}
                                @if($search ?? false)
                                <a href="{{ url('/ppid-pelaksana') }}" 
                                   class="flex items-center gap-2 px-5 py-3 bg-[#1A305E] hover:bg-[#D4AF37] text-white rounded-lg transition-all duration-300 font-medium shadow-md hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                                    </svg>
                                    <span class="hidden sm:inline">Reset</span>
                                </a>
                                @else
                                <button type="submit"
                                        class="flex items-center gap-2 px-5 py-3 bg-[#1A305E] hover:bg-[#D4AF37] text-white rounded-lg transition-all duration-300 font-medium shadow-md hover:shadow-lg">
                                    <span>Cari</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"/>
                                        <path d="m21 21-4.3-4.3"/>
                                    </svg>
                                </button>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Search Results (No Results Message Only) --}}
                        @if($search ?? false)
                            @if($ppidData->total() === 0)
                            <div class="mt-5 p-5 bg-gray-50 dark:bg-slate-700/50 rounded-xl border border-dashed border-gray-300 dark:border-slate-600 text-center">
                                <p class="text-5xl mb-2">🔍</p>
                                <p class="text-gray-700 dark:text-gray-300 font-medium mb-1">Tidak ada hasil untuk "{{ $search }}"</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Coba kata kunci lain</p>
                            </div>
                            @endif
                        @endif
                    </form>
                </div>

                {{-- SKPD Cards Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" id="skpdGrid">
                    @foreach($ppidData as $ppid)
                        <div class="group relative bg-white dark:bg-slate-800 rounded-2xl shadow-md hover:shadow-2xl border-2 border-gray-100 dark:border-slate-700 hover:border-[#D4AF37] p-8 transition-all duration-300 hover:-translate-y-2 overflow-hidden">
                            
                            {{-- Gradient Overlay on Hover --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-[#1A305E]/0 via-transparent to-[#D4AF37]/0 group-hover:from-[#1A305E]/5 group-hover:to-[#D4AF37]/5 transition-all duration-500 pointer-events-none"></div>
                            
                            {{-- Top Accent Line --}}
                            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#1A305E] via-[#D4AF37] to-[#1A305E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>

                            {{-- Logo with Animated Ring --}}
                            <div class="flex justify-center mb-6 relative">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gradient-to-br from-[#1A305E] to-[#D4AF37] rounded-full opacity-0 group-hover:opacity-20 blur-xl transition-opacity duration-500"></div>
                                    <div class="relative w-24 h-24 bg-gradient-to-br from-[#1A305E]/10 to-[#D4AF37]/10 dark:from-slate-700 dark:to-slate-600 rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 border-4 border-white dark:border-slate-800 group-hover:border-[#D4AF37]/50">
                                        @if($ppid->logo)
                                            <img src="{{ asset('storage/logo-skpd/' . $ppid->logo) }}" 
                                                alt="Logo {{ $ppid->nama_skpd }}" 
                                                class="w-16 h-16 object-contain group-hover:scale-110 transition-transform duration-300">
                                        @else
                                            <img src="{{ asset('images/logo-sulsel.png') }}" 
                                                alt="Logo Sulsel" 
                                                class="w-16 h-16 object-contain group-hover:scale-110 transition-transform duration-300">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- SKPD Name --}}
                            <h3 class="text-center font-bold text-[#1A305E] dark:text-white mb-4 text-lg leading-snug min-h-[60px] flex items-center justify-center px-2 group-hover:text-[#D4AF37] dark:group-hover:text-[#D4AF37] transition-colors duration-300">
                                {{ $ppid->nm_skpd }}
                            </h3>

                            {{-- Animated Divider --}}
                            <div class="relative mb-6 h-px">
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-gray-200 dark:via-slate-600 to-transparent"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-[#D4AF37] to-transparent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                            </div>

                            {{-- Contact Information --}}
                            <div class="space-y-4 relative z-10">
                                {{-- Address --}}
                                <div class="flex items-start gap-3 group/item">
                                   <div class="w-9 h-9 rounded-xl bg-[#1A305E]/10 dark:bg-slate-700 text-[#1A305E] dark:text-gray-200 flex items-center justify-center flex-shrink-0 group-hover/item:bg-gradient-to-br group-hover/item:from-[#1A305E] group-hover/item:to-[#D4AF37] group-hover/item:text-white transition-all duration-300 shadow-sm">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                   </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-gray-500 dark:text-gray-400 text-xs uppercase mb-1 tracking-wide">Alamat</p>
                                        <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">{{ $ppid->alamat ?? 'Belum tersedia' }}</p>
                                    </div>
                                </div>

                                {{-- Phone --}}
                                <div class="flex items-start gap-3 group/item">
                                     <div class="w-9 h-9 rounded-xl bg-[#1A305E]/10 dark:bg-slate-700 text-[#1A305E] dark:text-gray-200 flex items-center justify-center flex-shrink-0 group-hover/item:bg-gradient-to-br group-hover/item:from-[#1A305E] group-hover/item:to-[#D4AF37] group-hover/item:text-white transition-all duration-300 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                     </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-gray-500 dark:text-gray-400 text-xs uppercase mb-1 tracking-wide">Telepon</p>
                                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">{{ $ppid->no_telp ?? '-' }}</p>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="flex items-start gap-3 group/item">
                                     <div class="w-9 h-9 rounded-xl bg-[#1A305E]/10 dark:bg-slate-700 text-[#1A305E] dark:text-gray-200 flex items-center justify-center flex-shrink-0 group-hover/item:bg-gradient-to-br group-hover/item:from-[#1A305E] group-hover/item:to-[#D4AF37] group-hover/item:text-white transition-all duration-300 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                     </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-gray-500 dark:text-gray-400 text-xs uppercase mb-1 tracking-wide">Email</p>
                                        <a href="mailto:{{ $ppid->email }}" class="text-[#1A305E] dark:text-[#D4AF37] hover:underline text-sm font-medium truncate block group-hover/item:text-[#D4AF37] transition-colors">
                                            {{ $ppid->email ?? '-' }}
                                        </a>
                                    </div>
                                </div>

                                {{-- Website --}}
                                <div class="flex items-start gap-3 group/item">
                                     <div class="w-9 h-9 rounded-xl bg-[#1A305E]/10 dark:bg-slate-700 text-[#1A305E] dark:text-gray-200 flex items-center justify-center flex-shrink-0 group-hover/item:bg-gradient-to-br group-hover/item:from-[#1A305E] group-hover/item:to-[#D4AF37] group-hover/item:text-white transition-all duration-300 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" x2="22" y1="12" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1 4-10z"/></svg>
                                     </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-gray-500 dark:text-gray-400 text-xs uppercase mb-1 tracking-wide">Website</p>
                                        <a href="{{ $ppid->website }}" target="_blank" rel="noopener noreferrer" class="text-[#1A305E] dark:text-[#D4AF37] hover:underline text-sm font-medium truncate block group-hover/item:text-[#D4AF37] transition-colors">
                                            {{ $ppid->website ?? '-' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12 flex justify-center">
                    {{ $ppidData->links('pagination::tailwind') }}
                </div>

            </div>
        </div>
        
        {{-- Auto-submit Search Script --}}
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchForm = searchInput.closest('form');
            let timeout = null;
            
            // Auto-submit with debounce
            searchInput.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    searchForm.submit();
                }, 500); // Wait 500ms after user stops typing
            });
            
            // Immediate submit on Enter key
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(timeout);
                    searchForm.submit();
                }
            });
        });
        </script>
    </main>

    <x-footer />
</x-layout>
