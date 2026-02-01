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
                                       class="flex-1 px-4 py-3 text-base border-0 outline-none focus:outline-none focus:ring-0 focus:border-0 bg-transparent text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">

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
                {{-- SKPD Cards Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="skpdGrid">
                    @foreach($ppidData as $ppid)
                        <a href="{{ route('ppid-pelaksana.detail', $ppid->id_skpd) }}" 
                           class="group relative bg-white dark:bg-slate-800 rounded-2xl shadow-md hover:shadow-2xl border-2 border-gray-100 dark:border-slate-700 hover:border-[#D4AF37] p-8 transition-all duration-300 hover:-translate-y-2 overflow-hidden block h-full flex flex-col">
                            
                            {{-- Gradient Overlay on Hover --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-[#1A305E]/0 via-transparent to-[#D4AF37]/0 group-hover:from-[#1A305E]/5 group-hover:to-[#D4AF37]/5 transition-all duration-500 pointer-events-none"></div>
                            
                            {{-- Top Accent Line --}}
                            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#1A305E] via-[#D4AF37] to-[#1A305E] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>

                            {{-- Logo with Animated Ring --}}
                            <div class="relative w-24 h-24 mx-auto mb-6 transform group-hover:scale-105 transition-transform duration-500 flex-shrink-0">
                                <div class="absolute inset-0 bg-gradient-to-br from-[#1A305E] to-[#D4AF37] rounded-full opacity-0 group-hover:opacity-10 dark:group-hover:opacity-30 blur-xl transition-opacity duration-500"></div>
                                <div class="relative w-full h-full bg-white dark:bg-slate-700 rounded-full flex items-center justify-center shadow-lg border-4 border-white dark:border-slate-600 group-hover:border-[#D4AF37]/30 transition-colors duration-300">
                                    <img src="{{ $ppid->logo ? asset('storage/logo-skpd/' . $ppid->logo) : asset('images/logo-sulsel.png') }}" 
                                         alt="Logo {{ $ppid->nm_skpd }}" 
                                         class="w-14 h-14 object-contain">
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="text-center space-y-4 flex flex-col flex-grow">
                                {{-- Name --}}
                                <div class="min-h-[3.5rem] flex items-center justify-center">
                                    <h3 class="text-lg md:text-xl font-bold text-[#1A305E] dark:text-white leading-tight group-hover:text-[#D4AF37] transition-colors duration-300">
                                        {{ $ppid->nm_skpd }}
                                    </h3>
                                </div>

                                {{-- Divider --}}
                                <div class="w-12 h-1 bg-gradient-to-r from-[#1A305E] to-[#D4AF37] mx-auto rounded-full opacity-50 group-hover:opacity-100 transition-opacity flex-shrink-0"></div>

                                {{-- Info Grid --}}
                                <div class="grid grid-cols-1 gap-3 pt-2 flex-grow">
                                    {{-- Address --}}
                                    <div class="flex items-start justify-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 mt-0.5 text-[#D4AF37]"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span class="line-clamp-2 text-left">{{ $ppid->alamat ?? 'Alamat belum tersedia' }}</span>
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="pt-4 mt-auto">
                                    <div class="inline-flex items-center gap-2 text-[#1A305E] dark:text-[#D4AF37] font-bold text-sm bg-[#1A305E]/5 dark:bg-[#D4AF37]/10 px-4 py-2 rounded-full group-hover:bg-[#1A305E] group-hover:text-white dark:group-hover:text-white transition-all duration-300">
                                        Lihat Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    </div>
                                </div>
                            </div>
                        </a>
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
