<x-layout>
    <x-header />
    
    <div x-data="{ 
        view: 'grid',
        loading: true,
        berita: [],
        pagination: {},
        params: {
            search: '{{ request('search') }}',
            category: '{{ request('category') }}',
            page: {{ request('page', 1) }}
        },
        
        init() {
            this.fetchBerita();
        },

        fetchBerita() {
            this.loading = true;
            let url = new URL(window.location.origin + '/berita');
            
            // Append params ke URL
            Object.keys(this.params).forEach(key => {
                if (this.params[key]) url.searchParams.append(key, this.params[key]);
            });

            fetch(url, { 
                headers: { 'Accept': 'application/json' } 
            })
            .then(res => res.json())
            .then(data => {
                this.berita = data.data;
                this.pagination = data;
                this.loading = false;
                // Update URL browser tanpa reload
                history.pushState({}, '', url);
            });
        },

        changePage(p) {
            this.params.page = p;
            this.fetchBerita();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }">
        
        {{-- Breadcrumb + Title Section --}}
        <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-transparent font-['Plus_Jakarta_Sans']">
            <div class="container mx-auto px-4 py-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-3">
                            <a href="/" class="flex items-center gap-1.5 hover:text-ppid-primary dark:hover:text-ppid-accent transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                {{ __('messages.common.home') }}
                            </a>
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="text-ppid-primary dark:text-ppid-accent font-semibold">{{ __('messages.common.news') }}</span>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold text-ppid-primary dark:text-white">
                            {{ __('messages.news.title') }}
                        </h1>
                    </div>
                    <div class="hidden md:block">
                        <div class="flex gap-2">
                            <button @click="view = 'grid'" 
                                    class="p-2 rounded transition-colors"
                                    :class="view === 'grid' ? 'text-ppid-primary dark:text-white bg-gray-100 dark:bg-slate-700' : 'text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-700'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
                            </button>
                            <button @click="view = 'list'" 
                                    class="p-2 rounded transition-colors"
                                    :class="view === 'list' ? 'text-ppid-primary dark:text-white bg-gray-100 dark:bg-slate-700' : 'text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-700'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" x2="21" y1="6" y2="6"/><line x1="8" x2="21" y1="12" y2="12"/><line x1="8" x2="21" y1="18" y2="18"/><line x1="3" x2="3.01" y1="6" y2="6"/><line x1="3" x2="3.01" y1="12" y2="12"/><line x1="3" x2="3.01" y1="18" y2="18"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Main Content --}}
        <div class="py-12 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
            <div class="container mx-auto px-4">
                
                {{-- Search & Filter Section --}}
                <div class="mb-8 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
                    <form @submit.prevent="params.page = 1; fetchBerita()" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1 relative">
                            <input type="text" 
                                   x-model="params.search" 
                                   placeholder="{{ __('messages.common.search_news') }}" 
                                   class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-ppid-accent focus:border-transparent outline-none transition-all">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <div class="w-full md:w-64">
                            <select x-model="params.category" 
                                    @change="params.page = 1; fetchBerita()" 
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-ppid-accent focus:border-transparent outline-none transition-all appearance-none cursor-pointer">
                                <option value="">{{ __('messages.common.categories') }}</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id_skpd }}">{{ $cat->nm_skpd }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="px-6 py-2.5 bg-ppid-primary hover:bg-[#152649] text-white font-semibold rounded-lg transition-colors shadow-md">
                            {{ __('messages.news.search_btn') }}
                        </button>
                    </form>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
                    <div class="lg:col-span-3">
                        
                        {{-- Skeleton Loader --}}
                        <template x-if="loading">
                            <div :class="view === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6' : 'flex flex-col space-y-6'">
                                <template x-for="i in 6" :key="i">
                                    <div class="animate-pulse bg-white dark:bg-slate-800 rounded-2xl p-4 border border-gray-100 dark:border-slate-700">
                                        <div class="bg-slate-200 dark:bg-slate-700 h-48 w-full rounded-xl mb-4"></div>
                                        <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-3/4 mb-3"></div>
                                        <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-full mb-2"></div>
                                        <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-5/6"></div>
                                    </div>
                                </template>
                            </div>
                        </template>

                        {{-- News Content --}}
                        <template x-if="!loading && berita.length > 0">
                            <div :class="view === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6' : 'flex flex-col space-y-6'">
                                <template x-for="news in berita" :key="news.id_berita">
                                    <article class="group relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden hover:shadow-lg transition-all duration-300"
                                             :class="view === 'grid' ? 'flex flex-col h-full hover:-translate-y-1' : 'flex flex-col md:flex-row items-stretch hover:translate-x-1'">
                                        
                                        <div class="relative overflow-hidden shrink-0"
                                             :class="view === 'grid' ? 'h-48 w-full' : 'h-48 w-full md:w-64 md:h-auto'">
                                            <img :src="'/storage/img_berita/' + news.img_berita" 
                                                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                                 x-show="news.img_berita">
                                            <div x-show="!news.img_berita" class="w-full h-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                            <div class="absolute top-3 left-3 bg-ppid-primary text-white text-[10px] font-bold px-2.5 py-1 rounded shadow-sm" x-text="news.skpd ? news.skpd.nm_skpd : 'General'"></div>
                                            <a :href="'/berita/' + news.slug" class="absolute inset-0"></a>
                                        </div>

                                        <div class="p-5 flex-1 flex flex-col">
                                            <div class="mb-3 flex items-center gap-2 text-xs text-gray-500">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                <span x-text="new Date(news.tgl_upload).toLocaleDateString('id-ID', {day:'numeric', month:'long', year:'numeric'})"></span>
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3" :class="view === 'grid' ? 'line-clamp-2' : ''" x-text="news.judul"></h3>
                                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 flex-1" :class="view === 'grid' ? 'line-clamp-3' : 'line-clamp-2'" x-text="news.deskripsi.replace(/<[^>]*>?/gm, '').substring(0, 150) + '...'"></p>
                                            <a :href="'/berita/' + news.slug" class="text-ppid-accent font-semibold text-sm inline-flex items-center">
                                                {{ __('messages.news.read_more') }}
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                                            </a>
                                        </div>
                                    </article>
                                </template>
                            </div>
                        </template>

                        {{-- Empty State --}}
                        <template x-if="!loading && berita.length === 0">
                            <div class="text-center py-12 bg-white dark:bg-slate-800 rounded-2xl border border-dashed border-gray-300">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('messages.news.no_news') }}</h3>
                                <p class="text-gray-500">{{ __('messages.news.no_news_desc') }}</p>
                            </div>
                        </template>

                        {{-- Pagination --}}
                        <div class="mt-12 flex justify-center gap-2" x-show="!loading && pagination.last_page > 1">
                            <button @click="changePage(params.page - 1)" :disabled="params.page <= 1" class="px-4 py-2 bg-white dark:bg-slate-800 border dark:border-slate-700 rounded-lg disabled:opacity-50 transition-all hover:bg-gray-50">Prev</button>
                            
                            <div class="flex items-center gap-2">
                                <template x-for="p in pagination.last_page" :key="p">
                                    <button @click="changePage(p)" 
                                            class="w-10 h-10 rounded-lg border dark:border-slate-700 transition-all font-semibold"
                                            :class="params.page === p ? 'bg-ppid-primary text-white border-ppid-primary' : 'bg-white dark:bg-slate-800 text-gray-600 hover:bg-gray-50'"
                                            x-text="p"
                                            x-show="p > params.page - 3 && p < params.page + 3">
                                    </button>
                                </template>
                            </div>

                            <button @click="changePage(params.page + 1)" :disabled="params.page >= pagination.last_page" class="px-4 py-2 bg-white dark:bg-slate-800 border dark:border-slate-700 rounded-lg disabled:opacity-50 transition-all hover:bg-gray-50">Next</button>
                        </div>
                    </div>

                    {{-- Sidebar (Tetap Server Side) --}}
                    <aside class="lg:col-span-1 space-y-8">
                        {{-- Widget Magazine --}}
                        <div class="bg-ppid-primary rounded-2xl overflow-hidden text-white relative shadow-lg p-6 text-center">
                             <h3 class="text-lg font-bold text-ppid-accent mb-4">{{ __('messages.news.recent_posts') }}</h3>
                             <div class="aspect-[4/5] bg-slate-700 rounded-lg mb-4 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1620912189868-3b178608d0ac?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-60">
                                <div class="absolute bottom-0 p-4 text-left bg-gradient-to-t from-black to-transparent">
                                    <h4 class="text-xs font-bold">Optimisme Ekonomi Sulsel Tahun 2026</h4>
                                </div>
                             </div>
                             <a href="#" class="inline-block px-4 py-2 border border-ppid-accent text-ppid-accent text-xs font-bold rounded-full hover:bg-ppid-accent hover:text-ppid-primary transition-all">{{ __('messages.news.digital_edition') }}</a>
                        </div>

                        {{-- Categories Widget --}}
                        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 p-6">
                            <h3 class="font-bold text-ppid-primary dark:text-white mb-4 border-l-4 border-ppid-accent pl-3">{{ __('messages.common.categories') }}</h3>
                            <div class="space-y-2">
                                @foreach($categories as $cat)
                                    <button @click="params.category = '{{ $cat->id_skpd }}'; params.page = 1; fetchBerita()" 
                                            class="w-full flex items-center justify-between p-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors group"
                                            :class="params.category == '{{ $cat->id_skpd }}' ? 'bg-gray-50 dark:bg-slate-700' : ''">
                                        <span class="text-gray-700 dark:text-gray-300 font-medium text-sm group-hover:text-ppid-primary line-clamp-1">{{ $cat->nm_skpd }}</span>
                                        <span class="bg-ppid-primary/5 text-ppid-primary dark:text-white text-xs font-bold px-2 py-0.5 rounded-full group-hover:bg-ppid-primary group-hover:text-white transition-colors">{{ $cat->berita_count }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</x-layout>