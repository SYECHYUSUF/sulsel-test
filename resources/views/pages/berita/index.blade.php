<x-layout>
    <x-header />
<div class="" x-data="{ view: 'grid' }">
    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-transparent font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-3">
                        <a href="/" class="flex items-center gap-1.5 hover:text-[#1A305E] dark:hover:text-[#D4AF37] transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            {{ __('messages.common.home') }}
                        </a>
                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-[#1A305E] dark:text-[#D4AF37] font-semibold">{{ __('messages.common.news') }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white">
                        {{ __('messages.news.title') }}
                    </h1>
                </div>
                <div class="hidden md:block">
                    <div class="flex gap-2">
                        <button @click="view = 'grid'" 
                                class="p-2 rounded transition-colors"
                                :class="view === 'grid' ? 'text-[#1A305E] dark:text-white bg-gray-100 dark:bg-slate-700' : 'text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-700'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
                        </button>
                        <button @click="view = 'list'" 
                                class="p-2 rounded transition-colors"
                                :class="view === 'list' ? 'text-[#1A305E] dark:text-white bg-gray-100 dark:bg-slate-700' : 'text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-700'">
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
                <form action="/berita" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="{{ __('messages.common.search_placeholder', ['default' => 'Cari berita...']) }}" 
                               class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent outline-none transition-all">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <div class="w-full md:w-64">
                        <select name="category" 
                                onchange="this.form.submit()" 
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent outline-none transition-all appearance-none cursor-pointer">
                            <option value="">{{ __('messages.common.categories') }}</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id_skpd }}" {{ request('category') == $cat->id_skpd ? 'selected' : '' }}>
                                    {{ $cat->nm_skpd }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-[#1A305E] hover:bg-[#152649] text-white font-semibold rounded-lg transition-colors shadow-md">
                        {{ __('messages.news.search_btn') }}
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
                
                {{-- Left Content (News Grid) --}}
                <div class="lg:col-span-3 space-y-12">
                    
                    {{-- Section: Topik Pilihanku (Featured) --}}
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-[#1A305E] dark:text-white">
                                @if(request('search'))
                                    {{ __('messages.news.search_results', ['keyword' => request('search')]) }}
                                @elseif(request('category'))
                                    {{ __('messages.news.category_filter', ['category' => $categories->where('id_skpd', request('category'))->first()->nm_skpd ?? '']) }}
                                @else
                                    {{ __('messages.news.featured_topic') }}
                                @endif
                            </h2>
                        </div>
                        
                        @if($berita->count() > 0)
                        <div :class="view === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6' : 'flex flex-col space-y-6'">
                            @foreach($berita as $news)
                            <article class="group relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden hover:shadow-lg transition-all duration-300"
                                     :class="view === 'grid' ? 'flex flex-col h-full hover:-translate-y-1' : 'flex flex-col md:flex-row items-stretch hover:translate-x-1'">
                                
                                {{-- Image --}}
                                <div class="relative overflow-hidden shrink-0"
                                     :class="view === 'grid' ? 'h-48 w-full' : 'h-48 w-full md:w-64 md:h-auto'">
                                    @if($news->img_berita)
                                    <img src="{{ asset('storage/img_berita/' . $news->img_berita) }}" 
                                         alt="{{ $news->judul }}" 
                                         class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                    >
                                    @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-slate-700 dark:to-slate-800 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    @endif
                                    
                                    <div class="absolute top-3 left-3 bg-[#1A305E] text-white text-[10px] font-bold px-2.5 py-1 rounded shadow-sm uppercase tracking-wide">
                                        {{ $news->skpd->nm_skpd ?? 'Umum' }}
                                    </div>
                                    
                                    {{-- Overlay Link --}}
                                    <a href="{{ route('berita.show', $news->slug) }}" class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></a>
                                </div>
                                
                                {{-- Content --}}
                                <div class="p-5 flex-1 flex flex-col">
                                    <div class="mb-3 flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 dark:text-gray-500"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                        <span>{{ \Carbon\Carbon::parse($news->tgl_upload)->diffForHumans() }}</span>
                                    </div>
                                    <a href="{{ route('berita.show', $news->slug) }}" class="block mb-3">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-[#1A305E] dark:group-hover:text-[#D4AF37] transition-colors leading-tight"
                                            :class="view === 'grid' ? 'line-clamp-2' : ''">
                                            {{ $news->judul }}
                                        </h3>
                                    </a>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 flex-1"
                                       :class="view === 'grid' ? 'line-clamp-3' : 'line-clamp-2 md:line-clamp-3'">
                                        {{ Str::limit(strip_tags($news->deskripsi), 150) }}
                                    </p>
                                    
                                    <a href="{{ route('berita.show', $news->slug) }}" class="inline-flex items-center text-sm font-semibold text-[#D4AF37] hover:tracking-wide transition-all mt-auto group/link">
                                        {{ __('messages.news.read_more') }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1 w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </article>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('messages.news.no_news') }}</h3>
                            <p class="text-gray-500 dark:text-gray-400">{{ __('messages.news.no_news_desc') }}</p>
                        </div>
                        @endif
                    </div>
                    
                    {{-- Pagination --}}
                    <div class="flex justify-center pt-8">
                        {{ $berita->withQueryString()->links('pagination::tailwind') }}
                    </div>
                    
                </div>
                
                {{-- Sidebar --}}
                <div class="lg:col-span-1 space-y-8">
                    
                    {{-- Magazine / Featured Widget --}}
                    <div class="bg-[#1A305E] rounded-2xl overflow-hidden text-white relative shadow-lg group">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#1A305E] to-black opacity-50"></div>
                        <div class="p-6 text-center z-10 relative">
                            <div class="mb-4">
                                <h3 class="text-lg font-bold tracking-widest mb-1 text-[#D4AF37]">{{ __('messages.news.recent_posts') }}</h3>
                                <p class="text-[10px] uppercase text-gray-300 tracking-wider">{{ __('messages.news.source_info') }}</p>
                            </div>
                            
                            {{-- Featured Image Static for now or random --}}
                            <div class="mx-auto w-full aspect-[4/5] bg-gradient-to-br from-blue-400 to-[#1A305E] rounded-lg shadow-2xl mb-4 flex items-center justify-center relative overflow-hidden group cursor-pointer border border-white/20">
                                <img src="https://images.unsplash.com/photo-1620912189868-3b178608d0ac?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-4">
                                    <h4 class="text-left font-bold text-sm leading-tight text-white mb-2 line-clamp-3">Optimisme Ekonomi Sulsel Tahun 2026: Tumbuh Kuat & Inklusif</h4>
                                </div>
                            </div>
                            
                            <a href="#" class="inline-block px-4 py-2 border border-[#D4AF37] text-[#D4AF37] text-xs font-bold rounded-full hover:bg-[#D4AF37] hover:text-[#1A305E] dark:text-white transition-all uppercase tracking-wider">{{ __('messages.news.digital_edition') }}</a>
                        </div>
                    </div>
                    
                    {{-- Categories Widget --}}
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 p-6">
                        <h3 class="font-bold text-[#1A305E] dark:text-white mb-4 border-l-4 border-[#D4AF37] pl-3">{{ __('messages.common.categories') }}</h3>
                        <div class="space-y-2">
                            @foreach($categories as $cat)
                                <a href="/berita?category={{ $cat->id_skpd }}" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors group {{ request('category') == $cat->id_skpd ? 'bg-gray-50 dark:bg-slate-700' : '' }}">
                                <span class="text-gray-700 font-medium text-sm group-hover:text-[#1A305E] dark:text-gray-300 dark:group-hover:text-white line-clamp-1 title="{{ $cat->nm_skpd }}">{{ $cat->nm_skpd }}</span>
                                <span class="bg-[#1A305E]/5 text-[#1A305E] dark:text-white text-xs font-bold px-2 py-0.5 rounded-full group-hover:bg-[#1A305E] group-hover:text-white transition-colors flex-shrink-0">{{ $cat->berita_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    
                    {{-- Hashtag Widget --}}
                    <div class="relative rounded-2xl overflow-hidden h-40 group shadow-md">
                        <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2670&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-[#1A305E]/80 flex flex-col items-center justify-center p-4 text-center">
                            <span class="text-[#D4AF37] text-xs font-bold tracking-widest uppercase mb-1">{{ __('messages.common.campaign') }}</span>
                            <h3 class="text-white font-bold text-lg leading-tight uppercase tracking-wider">#SulselMelayani<br>SepenuhHati</h3>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
                                </div>
                                    <x-footer />
                                </x-layout>
                                