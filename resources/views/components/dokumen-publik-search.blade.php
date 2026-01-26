<div x-data="{ 
    isOpen: false,
    searchQuery: '', 
    results: [], 
    isLoading: false,
    fetchSuggestions() {
        if (this.searchQuery.length < 2) {
            this.results = [];
            return;
        }
        this.isLoading = true;
        fetch(`/api/dokumen-publik/search-suggestions?query=${this.searchQuery}`)
            .then(res => res.json())
            .then(data => {
                this.results = data;
                this.isLoading = false;
            });
    },
    closeSearch() {
        this.isOpen = false;
        this.searchQuery = '';
        this.results = [];
    }
}"
@open-search.window="isOpen = true; $nextTick(() => $refs.searchInput.focus())"
@keydown.escape.window="closeSearch()"
style="display: none;" 
x-show="isOpen" 
class="fixed inset-0 z-[100] overflow-y-auto" 
role="dialog" 
aria-modal="true">

    {{-- Backdrop --}}
    <div x-show="isOpen" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" 
         @click="closeSearch()"></div>

    {{-- Modal Panel --}}
    <div x-show="isOpen"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="relative min-h-[20vh] mx-auto mt-20 w-full max-w-2xl transform transition-all p-4">
         
         <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-2xl ring-1 ring-black/5 overflow-hidden">
            {{-- Search Input Area --}}
            <div class="relative border-b border-gray-100 dark:border-slate-700">
                <div class="flex items-center px-4 py-4 sm:px-6">
                    <div class="mr-4">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <form action="/informasi-publik" method="GET" class="flex-1 w-full">
                        <input x-ref="searchInput"
                               type="text" 
                               name="query" 
                               class="w-full bg-transparent border-none text-lg text-gray-900 dark:text-white placeholder-gray-400 focus:ring-0 focus:outline-none" 
                               placeholder="Cari informasi (misal: RKA, Izin...)" 
                               x-model="searchQuery"
                               @input.debounce.300ms="fetchSuggestions()"
                               autocomplete="off">
                    </form>
                    <button @click="closeSearch()" class="ml-4 p-2 text-gray-400 hover:text-gray-500 bg-gray-100 dark:bg-slate-700 rounded-full transition-colors">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Results Area --}}
            <div x-show="results.length > 0 || isLoading" class="max-h-[60vh] overflow-y-auto custom-scrollbar">
                
                <div x-show="isLoading" class="p-8 text-center text-gray-500 dark:text-gray-400">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="animate-spin h-8 w-8 text-[#D4AF37] mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-sm">Mencari informasi...</span>
                    </div>
                </div>

                <div x-show="!isLoading && results.length > 0" class="py-2">
                    <div class="px-4 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Hasil Pencarian</div>
                    <template x-for="item in results" :key="item.id_informasi">
                        <a :href="'/informasi-publik/detail/' + item.id_informasi" class="block px-4 py-3 mx-2 rounded-xl hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors group">
                            <div class="flex items-start gap-3">
                                <div class="mt-1 shrink-0">
                                    <div class="w-8 h-8 rounded-lg bg-[#1A305E]/10 dark:bg-white/5 flex items-center justify-center text-[#1A305E] dark:text-gray-300 group-hover:bg-[#1A305E] group-hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-0.5">
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white truncate group-hover:text-[#1A305E] dark:group-hover:text-[#D4AF37]" x-text="item.judul"></h4>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300" x-text="item.nm_kat_info"></span>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1" x-text="item.ket || 'Tidak ada keterangan'"></p>
                                </div>
                            </div>
                        </a>
                    </template>
                </div>
            </div>
            
            {{-- Footer suggestions/help --}}
            <div x-show="!searchQuery && results.length === 0" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-slate-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <p class="text-sm">Ketik kata kunci untuk mulai mencari dokumen publik.</p>
                <div class="mt-4 flex flex-wrap justify-center gap-2">
                    <button @click="searchQuery = 'RKA'; fetchSuggestions(); $refs.searchInput.focus()" class="px-3 py-1 text-xs rounded-full border border-gray-200 dark:border-slate-700 hover:border-[#D4AF37] hover:text-[#D4AF37] transition-colors">#RKA</button>
                    <button @click="searchQuery = 'Anggaran'; fetchSuggestions(); $refs.searchInput.focus()" class="px-3 py-1 text-xs rounded-full border border-gray-200 dark:border-slate-700 hover:border-[#D4AF37] hover:text-[#D4AF37] transition-colors">#Anggaran</button>
                    <button @click="searchQuery = 'Lapor'; fetchSuggestions(); $refs.searchInput.focus()" class="px-3 py-1 text-xs rounded-full border border-gray-200 dark:border-slate-700 hover:border-[#D4AF37] hover:text-[#D4AF37] transition-colors">#Lapor</button>
                </div>
            </div>

         </div>
    </div>
</div>