<div class="flex-1 max-w-xl mx-8 relative" 
     x-data="{ 
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
        }
     }" 
     @click.away="results = []">
    
    <form action="/informasi-publik" method="GET" class="w-full relative">
        <input 
            type="text" 
            name="query" 
            x-model="searchQuery"
            @input.debounce.300ms="fetchSuggestions()"
            placeholder="Cari informasi (misal: RKA, Izin...)" 
            class="w-full py-2.5 pl-4 pr-12 rounded-full border-2 border-gray-300 bg-white focus:border-[#D4AF37] text-sm transition-all dark:bg-slate-800 dark:text-white"
            autocomplete="off"
        >
        <button type="submit" class="absolute right-1 top-1 bottom-1 bg-[#1A305E] text-white px-4 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </button>
    </form>

    {{-- Dropdown Rekomendasi --}}
    <div x-show="results.length > 0 || isLoading" 
        class="absolute top-full left-0 w-full mt-2 bg-white dark:bg-slate-800 rounded-xl shadow-2xl border border-gray-100 dark:border-slate-700 overflow-hidden z-[100]"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100">
        
        <div x-show="isLoading" class="p-4 text-center text-sm text-gray-500">
            <span class="animate-pulse">Mencari informasi...</span>
        </div>

        <template x-for="item in results" :key="item.id_informasi">
            <a :href="'/informasi-publik/detail/' + item.id_informasi" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-slate-700 border-b border-gray-50 dark:border-slate-700 last:border-0">
                <div class="flex flex-col gap-1">
                    <div class="flex items-start justify-between gap-2">
                        <span class="text-sm font-bold text-[#1A305E] dark:text-white leading-tight" x-text="item.judul"></span>
                        {{-- Badge Kategori --}}
                        <span class="shrink-0 inline-block px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide bg-[#D4AF37]/10 text-[#D4AF37] border border-[#D4AF37]/20 rounded" x-text="item.nm_kat_info"></span>
                    </div>
                    <div x-show="item.ket" class="text-xs text-gray-500 dark:text-gray-400 truncate" x-text="item.ket"></div>
                </div>
            </a>
        </template>
    </div>
</div>