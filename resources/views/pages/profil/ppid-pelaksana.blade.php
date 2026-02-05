<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-8">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-ppid-primary dark:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-ppid-primary dark:text-white font-medium">{{ __('messages.breadcrumb.profile') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-ppid-primary dark:text-white font-bold">{{ __('messages.ppid_pelaksana.title') }}</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-ppid-primary dark:text-white mb-2">
                        {{ __('messages.ppid_pelaksana.title') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('messages.ppid_pelaksana.subtitle') }}
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-24 h-1.5 bg-gradient-to-r from-ppid-primary to-ppid-accent rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-12 md:py-20 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']"
          x-data="{
              search: '{{ request('search') }}',
              loading: false,
              skpds: {{ \Illuminate\Support\Js::from($ppidData->items()) }},
              pagination: {
                  next_page_url: '{{ $ppidData->nextPageUrl() }}',
                  prev_page_url: '{{ $ppidData->previousPageUrl() }}',
                  current_page: {{ $ppidData->currentPage() }},
                  last_page: {{ $ppidData->lastPage() }}
              },
              
              async performSearch(url = null) {
                  this.loading = true;
                  const fetchUrl = url || `{{ url()->current() }}?search=${this.search}`;
                  
                  try {
                      const response = await fetch(fetchUrl, {
                          headers: {
                              'X-Requested-With': 'XMLHttpRequest',
                              'Accept': 'application/json'
                          }
                      });
                      const data = await response.json();
                      this.skpds = data.data;
                      this.pagination = {
                          next_page_url: data.next_page_url,
                          prev_page_url: data.prev_page_url,
                          current_page: data.current_page,
                          last_page: data.last_page
                      };
                      
                      // Update URL without refresh
                      if (!url) {
                          const newUrl = new URL(window.location);
                          if(this.search) {
                              newUrl.searchParams.set('search', this.search);
                          } else {
                              newUrl.searchParams.delete('search');
                          }
                          window.history.pushState({}, '', newUrl);
                      }
                      
                  } catch (error) {
                      console.error('Error fetching data:', error);
                  } finally {
                      this.loading = false;
                  }
              }
          }">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                
                {{-- Minimal Search Bar --}}
                <div class="mb-12">
                    <form @submit.prevent="performSearch()" class="max-w-2xl mx-auto">
                        <div class="relative bg-white dark:bg-slate-800 rounded-xl shadow-lg hover:shadow-xl border-2 border-ppid-primary/20 dark:border-slate-700 hover:border-ppid-accent/50 transition-all duration-300">
                            <div class="flex items-center gap-2 p-2">
                                {{-- Search Input --}}
                                <input type="text" 
                                       x-model="search"
                                       placeholder="Cari SKPD..." 
                                       class="flex-1 px-4 py-3 text-base border-0 outline-none focus:outline-none focus:ring-0 focus:border-0 bg-transparent text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">

                                {{-- Action Button --}}
                                <button type="submit"
                                        :disabled="loading"
                                        class="flex items-center gap-2 px-5 py-3 bg-ppid-primary hover:bg-ppid-accent text-white rounded-lg transition-all duration-300 font-medium shadow-md hover:shadow-lg disabled:opacity-70 disabled:cursor-not-allowed">
                                    <span x-show="!loading">Cari</span>
                                    <span x-show="loading">...</span>
                                    <svg x-show="!loading" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"/>
                                        <path d="m21 21-4.3-4.3"/>
                                    </svg>
                                    <div x-show="loading" class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Empty State --}}
                <div x-show="skpds.length === 0 && !loading" x-cloak class="mt-5 p-10 bg-gray-50 dark:bg-slate-700/50 rounded-xl border border-dashed border-gray-300 dark:border-slate-600 text-center">
                    <p class="text-5xl mb-4">🔍</p>
                    <p class="text-gray-700 dark:text-gray-300 font-medium mb-1">Tidak ada hasil ditemukan</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Coba kata kunci lain</p>
                </div>

                {{-- SKPD Cards Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" :class="{'opacity-50 pointer-events-none': loading}">
                    <template x-for="skpd in skpds" :key="skpd.id_skpd">
                        <a :href="`/ppid-pelaksana/${skpd.id_skpd}`" 
                           class="group relative bg-white dark:bg-slate-800 rounded-2xl shadow-md hover:shadow-2xl border-2 border-gray-100 dark:border-slate-700 hover:border-ppid-accent p-8 transition-all duration-300 hover:-translate-y-2 overflow-hidden flex flex-col h-full">
                            
                            {{-- Gradient Overlay on Hover --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-ppid-primary/0 via-transparent to-ppid-accent/0 group-hover:from-ppid-primary/5 group-hover:to-ppid-accent/5 transition-all duration-500 pointer-events-none"></div>
                            
                            {{-- Top Accent Line --}}
                            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-ppid-primary via-ppid-accent to-ppid-primary transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>

                            {{-- Logo with Animated Ring --}}
                            <div class="relative w-24 h-24 mx-auto mb-6 transform group-hover:scale-105 transition-transform duration-500 flex-shrink-0">
                                <div class="absolute inset-0 bg-gradient-to-br from-ppid-primary to-ppid-accent rounded-full opacity-0 group-hover:opacity-10 dark:group-hover:opacity-30 blur-xl transition-opacity duration-500"></div>
                                <div class="relative w-full h-full bg-white dark:bg-slate-700 rounded-full flex items-center justify-center shadow-lg border-4 border-white dark:border-slate-600 group-hover:border-ppid-accent/30 transition-colors duration-300">
                                    <img :src="skpd.logo ? `/storage/logo-skpd/${skpd.logo}` : '/images/logo-sulsel.png'" 
                                         :alt="`Logo ${skpd.nm_skpd}`" 
                                         class="w-14 h-14 object-contain">
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="text-center space-y-4 flex flex-col flex-grow">
                                {{-- Name --}}
                                <div class="min-h-[3.5rem] flex items-center justify-center">
                                    <h3 class="text-lg md:text-xl font-bold text-ppid-primary dark:text-white leading-tight group-hover:text-ppid-accent transition-colors duration-300" x-text="skpd.nm_skpd"></h3>
                                </div>

                                {{-- Divider --}}
                                <div class="w-12 h-1 bg-gradient-to-r from-ppid-primary to-ppid-accent mx-auto rounded-full opacity-50 group-hover:opacity-100 transition-opacity flex-shrink-0"></div>

                                {{-- Info Grid --}}
                                <div class="grid grid-cols-1 gap-3 pt-2 flex-grow">
                                    {{-- Address --}}
                                    <div class="flex items-start justify-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 mt-0.5 text-ppid-accent"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span class="line-clamp-2 text-left" x-text="skpd.alamat ? skpd.alamat : 'Alamat belum tersedia'"></span>
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="pt-4 mt-auto">
                                    <div class="inline-flex items-center gap-2 text-ppid-primary dark:text-ppid-accent font-bold text-sm bg-ppid-primary/5 dark:bg-ppid-accent/10 px-4 py-2 rounded-full group-hover:bg-ppid-primary group-hover:text-white dark:group-hover:text-white transition-all duration-300">
                                        Lihat Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </template>
                </div>

                {{-- Pagination Buttons --}}
                <div class="mt-12 flex justify-center gap-4" x-show="pagination.last_page > 1">
                    <button 
                        @click="performSearch(pagination.prev_page_url)" 
                        :disabled="!pagination.prev_page_url"
                        class="px-4 py-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 rounded-lg shadow-sm disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200"
                        x-text="'&laquo; Sebelumnya'">
                    </button>
                    
                    <span class="px-4 py-2 text-gray-600 dark:text-gray-300">
                        Halaman <span x-text="pagination.current_page"></span> dari <span x-text="pagination.last_page"></span>
                    </span>

                    <button 
                        @click="performSearch(pagination.next_page_url)" 
                        :disabled="!pagination.next_page_url"
                        class="px-4 py-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 rounded-lg shadow-sm disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200"
                        x-text="'Selanjutnya &raquo;'">
                    </button>
                </div>

            </div>
        </div>
    </main>

</x-layout>
