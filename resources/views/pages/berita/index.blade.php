<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-3">
                        <a href="/" class="hover:text-[#1A305E] dark:text-white transition-colors">{{ __('messages.common.home') }}</a>
                        <span class="text-gray-300">/</span>
                        <span class="text-[#1A305E] dark:text-white font-medium">{{ __('messages.common.news') }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white">
                        {{ __('messages.news.title') }}
                    </h1>
                </div>
                <div class="hidden md:block">
                     <div class="flex gap-2">
                        <button class="p-2 text-[#1A305E] dark:text-white bg-gray-100 dark:bg-slate-700 rounded hover:bg-[#1A305E] hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
                        </button>
                        <button class="p-2 text-gray-400 hover:bg-gray-100 dark:bg-slate-700 rounded transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" x2="21" y1="6" y2="6"/><line x1="8" x2="21" y1="12" y2="12"/><line x1="8" x2="21" y1="18" y2="18"/><line x1="3" x2="3.01" y1="6" y2="6"/><line x1="3" x2="3.01" y1="12" y2="12"/><line x1="3" x2="3.01" y1="18" y2="18"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-12 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
                
                {{-- Left Content (News Grid) --}}
                <div class="lg:col-span-3 space-y-12">
                    
                    {{-- Section: Topik Pilihanku (Featured) --}}
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-[#1A305E] dark:text-white">{{ __('messages.news.featured_topic') }}</h2>
                            <div class="flex gap-4 text-sm font-medium">
                                <a href="#" class="text-[#D4AF37] hover:underline">{{ __('messages.common.press_release') }}</a>
                                <a href="#" class="text-gray-500 hover:text-[#1A305E] dark:text-white">{{ __('messages.common.official_news') }}</a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @php
                                $newsItems = [
                                    [
                                        'title' => 'Pemprov Sulsel Raih Penghargaan Keterbukaan Informasi Publik Terbaik 2025',
                                        'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2664&auto=format&fit=crop',
                                        'category' => 'Siaran Pers',
                                        'time' => '3 jam lalu',
                                        'desc' => 'Pemerintah Provinsi Sulawesi Selatan kembali menorehkan prestasi gemilang di tingkat nasional dengan meraih penghargaan...'
                                    ],
                                    [
                                        'title' => 'Gubernur Sulsel Resmikan Digital Innovation Lounge di Makassar',
                                        'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=2670&auto=format&fit=crop',
                                        'category' => 'Berita Pemerintahan',
                                        'time' => '5 jam lalu',
                                        'desc' => 'Sebagai upaya mendorong ekosistem digital, Gubernur meresmikan pusat inovasi digital yang diperuntukkan bagi...'
                                    ],
                                    [
                                        'title' => 'PPID Sulsel Gelar Workshop Penguatan Kapasitas Operator PPID Pelaksana',
                                        'image' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=2670&auto=format&fit=crop',
                                        'category' => 'Agenda',
                                        'time' => '8 jam lalu',
                                        'desc' => 'Dinas Kominfo SP Sulsel menggelar workshop untuk meningkatkan standar pelayanan informasi publik di seluruh OPD.'
                                    ],
                                     [
                                        'title' => 'Diskominfo Sulsel Fokus Tingkatkan Literasi Digital di Pesantren',
                                        'image' => 'https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?q=80&w=2664&auto=format&fit=crop',
                                        'category' => 'Siaran Pers',
                                        'time' => '11 jam lalu',
                                        'desc' => 'Program literasi digital kini merambah ke lingkungan pesantren untuk mencetak santri yang cakap digital.'
                                    ],
                                    [
                                        'title' => '[HOAKS] Beredar Informasi Penerimaan CPNS Pemprov Sulsel Jalur Khusus',
                                        'image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2670&auto=format&fit=crop',
                                        'category' => 'Hoaks',
                                        'time' => 'sehari lalu',
                                        'desc' => 'Masyarakat diminta waspada terhadap informasi palsu terkait rekrutmen CPNS yang beredar di grup WhatsApp.'
                                    ],
                                    [
                                        'title' => 'Bappelitbangda Sulsel Paparkan Rencana Pembangunan Jangka Panjang 2026',
                                        'image' => 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?q=80&w=2670&auto=format&fit=crop',
                                        'category' => 'Berita Pemerintahan',
                                        'time' => 'sehari lalu',
                                        'desc' => 'Forum konsultasi publik digelar untuk menjaring aspirasi masyarakat dalam penyusunan RPJPD Sulsel.'
                                    ],
                                ];
                            @endphp

                            @foreach($newsItems as $news)
                                <article class="group flex flex-col h-full bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                                    {{-- Image --}}
                                    <div class="relative overflow-hidden h-48">
                                        <img src="{{ $news['image'] }}" alt="{{ $news['title'] }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                        @if($news['category'] === 'Hoaks')
                                            <div class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-bold px-2.5 py-1 rounded shadow-sm">HOAKS</div>
                                        @else
                                            <div class="absolute top-3 left-3 bg-[#1A305E] text-white text-[10px] font-bold px-2.5 py-1 rounded shadow-sm uppercase tracking-wide">{{ $news['category'] }}</div>
                                        @endif
                                        
                                        {{-- Overlay Link --}}
                                        <a href="/berita/detail" class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></a>
                                    </div>
                                    
                                    {{-- Content --}}
                                    <div class="p-5 flex-1 flex flex-col">
                                        <div class="mb-3 flex items-center gap-2 text-xs text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                            <span>{{ $news['time'] }}</span>
                                        </div>
                                        <a href="/berita/detail" class="block mb-3">
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-[#1A305E] transition-colors line-clamp-2 leading-tight">
                                                {{ $news['title'] }}
                                            </h3>
                                        </a>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-4 flex-1">
                                            {{ $news['desc'] }}
                                        </p>
                                        
                                        <a href="/berita/detail" class="inline-flex items-center text-sm font-semibold text-[#D4AF37] hover:tracking-wide transition-all mt-auto group/link">
                                            {{ __('messages.common.read_more') }}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1 w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    {{-- Pagination --}}
                    <div class="flex justify-center pt-8">
                        <nav class="flex items-center gap-2">
                            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:bg-slate-900 text-gray-600 dark:text-gray-300 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                            </button>
                            <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#1A305E] text-white font-medium shadow-md">1</button>
                            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:bg-slate-900 text-gray-600 dark:text-gray-300 font-medium transition-colors">2</button>
                             <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:bg-slate-900 text-gray-600 dark:text-gray-300 font-medium transition-colors">3</button>
                             <span class="px-2 text-gray-400">...</span>
                            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:bg-slate-900 text-gray-600 dark:text-gray-300 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </button>
                        </nav>
                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 space-y-8">
                    
                    {{-- Magazine / Featured Widget --}}
                    <div class="bg-[#1A305E] rounded-2xl overflow-hidden text-white relative shadow-lg group">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#1A305E] to-black opacity-50"></div>
                         <!-- Background pattern or image could go here -->
                        <div class="p-6 text-center z-10 relative">
                            <div class="mb-4">
                                <h3 class="text-lg font-bold tracking-widest mb-1 text-[#D4AF37]">WARTA SULSEL</h3>
                                <p class="text-[10px] uppercase text-gray-300 tracking-wider">{{ __('messages.news.source_info') }}</p>
                            </div>
                            
                            <!-- Featured Image -->
                            <div class="mx-auto w-full aspect-[4/5] bg-gradient-to-br from-blue-400 to-[#1A305E] rounded-lg shadow-2xl mb-4 flex items-center justify-center relative overflow-hidden group cursor-pointer border border-white/20">
                                <img src="https://images.unsplash.com/photo-1620912189868-3b178608d0ac?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-4">
                                     <h4 class="text-left font-bold text-sm leading-tight text-white mb-2 line-clamp-3">Optimisme Ekonomi Sulsel Tahun 2026: Tumbuh Kuat & Inklusif</h4>
                                </div>
                            </div>
                            
                            <a href="#" class="inline-block px-4 py-2 border border-[#D4AF37] text-[#D4AF37] text-xs font-bold rounded-full hover:bg-[#D4AF37] hover:text-[#1A305E] dark:text-white transition-all uppercase tracking-wider">{{ __('messages.news.digital_edition') }}</a>
                        </div>
                    </div>

                    {{-- Popular News Widget --}}
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 p-6">
                        <h3 class="font-bold text-[#1A305E] dark:text-white mb-4 border-l-4 border-[#D4AF37] pl-3">{{ __('messages.common.popular') }}</h3>
                         <div class="space-y-4">
                            @for($i=1; $i<=3; $i++)
                            <div class="flex gap-3 items-start group cursor-pointer">
                                <div class="text-2xl font-black text-gray-200 group-hover:text-[#D4AF37] transition-colors leading-none -mt-1">0{{ $i }}</div>
                                <div>
                                    <span class="text-[10px] text-gray-500 block mb-1">{{ __('messages.common.official_news') }}</span>
                                    <a href="#" class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-[#1A305E] leading-snug line-clamp-2 transition-colors">
                                        Pj Gubernur Sulsel Tinjau Proyek Strategis Nasional di Mamminasata
                                    </a>
                                </div>
                            </div>
                            <hr class="border-gray-100 {{ $i == 3 ? 'hidden' : '' }}">
                            @endfor
                        </div>
                    </div>

                    {{-- Categories Widget --}}
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 p-6">
                         <h3 class="font-bold text-[#1A305E] dark:text-white mb-4 border-l-4 border-[#D4AF37] pl-3">{{ __('messages.common.categories') }}</h3>
                        <div class="space-y-2">
                             @php
                                $categories = [
                                    ['name' => 'messages.common.press_release', 'count' => 124],
                                    ['name' => 'messages.common.official_news', 'count' => 85],
                                    ['name' => 'messages.common.opinion', 'count' => 42],
                                    ['name' => 'messages.common.announcement', 'count' => 16],
                                    ['name' => 'messages.common.service_info', 'count' => 28],
                                ];
                            @endphp
                            @foreach($categories as $cat)
                                <a href="#" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-gray-50 dark:bg-slate-900 transition-colors group">
                                    <span class="text-gray-700 font-medium text-sm group-hover:text-[#1A305E] dark:text-white">{{ __($cat['name']) }}</span>
                                    <span class="bg-[#1A305E]/5 text-[#1A305E] dark:text-white text-xs font-bold px-2 py-0.5 rounded-full group-hover:bg-[#1A305E] group-hover:text-white transition-colors">{{ $cat['count'] }}</span>
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
    </main>

    <x-footer />
</x-layout>
