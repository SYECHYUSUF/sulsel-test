<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white border-b border-gray-200 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                        <a href="/" class="hover:text-[#1A305E] transition-colors">Beranda</a>
                        <span class="text-gray-300">/</span>
                        <span class="text-[#1A305E] font-medium">Berita</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E]">
                        Berita & Artikel
                    </h1>
                </div>
                <div class="hidden md:block">
                     <div class="flex gap-2">
                        <button class="p-2 text-[#1A305E] bg-gray-100 rounded hover:bg-[#1A305E] hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
                        </button>
                        <button class="p-2 text-gray-400 hover:bg-gray-100 rounded transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" x2="21" y1="6" y2="6"/><line x1="8" x2="21" y1="12" y2="12"/><line x1="8" x2="21" y1="18" y2="18"/><line x1="3" x2="3.01" y1="6" y2="6"/><line x1="3" x2="3.01" y1="12" y2="12"/><line x1="3" x2="3.01" y1="18" y2="18"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-12 bg-gray-50 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
                
                {{-- Left Content (News Grid) --}}
                <div class="lg:col-span-3 space-y-12">
                    
                    {{-- Section: Topik Pilihanku (Featured) --}}
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-[#1A305E]">TOPIK PILIHANKU</h2>
                            <div class="flex gap-4 text-sm font-medium">
                                <a href="#" class="text-[#D4AF37] hover:underline">Siaran Pers</a>
                                <a href="#" class="text-gray-500 hover:text-[#1A305E]">Berita Pemerintahan</a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @php
                                $newsItems = [
                                    [
                                        'title' => 'Menkomdigi: Tanpa Keterampilan Inklusif, Transformasi Digital Bisa...',
                                        'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2664&auto=format&fit=crop',
                                        'category' => 'Siaran Pers',
                                        'time' => '3 jam lalu',
                                        'desc' => 'Menteri Komunikasi dan Digital menekankan pentingnya inklusivitas dalam transformasi digital nasional.'
                                    ],
                                    [
                                        'title' => 'Wamenkomdigi: Berpikir Kritis, Perisai Anak Hadapi "Realitas...',
                                        'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=2670&auto=format&fit=crop',
                                        'category' => 'Siaran Pers',
                                        'time' => '5 jam lalu',
                                        'desc' => 'Wakil Menteri mengingatkan orang tua untuk mengajarkan berpikir kritis kepada anak di era digital.'
                                    ],
                                    [
                                        'title' => 'Pendaftar Tembus 261 Pelamar, Pansel KPI Ajak Talenta Terbaik...',
                                        'image' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=2670&auto=format&fit=crop',
                                        'category' => 'Siaran Pers',
                                        'time' => '8 jam lalu',
                                        'desc' => 'Panitia Seleksi KPI mengapresiasi antusiasme pelamar dan berkomitmen memilih yang terbaik.'
                                    ],
                                     [
                                        'title' => 'Hadiri Forum ADGMIN, Sekjen Ismail Tekankan Teknologi Digital Harus...',
                                        'image' => 'https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?q=80&w=2664&auto=format&fit=crop',
                                        'category' => 'Siaran Pers',
                                        'time' => '11 jam lalu',
                                        'desc' => 'Sekjen Kementerian Kominfo berbicara tentang masa depan teknologi digital di forum ASEAN.'
                                    ],
                                    [
                                        'title' => '[HOAKS] Presiden Prabowo dan Anies Makan Bersama di Posko...',
                                        'image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2670&auto=format&fit=crop',
                                        'category' => 'Hoaks',
                                        'time' => 'sehari lalu',
                                        'desc' => 'Beredar foto manipulasi yang menampilkan pertemuan yang tidak pernah terjadi.'
                                    ],
                                    [
                                        'title' => '[HOAKS] Purbaya Menolak Dijadikan Wapres',
                                        'image' => 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?q=80&w=2670&auto=format&fit=crop',
                                        'category' => 'Hoaks',
                                        'time' => 'sehari lalu',
                                        'desc' => 'Klarifikasi mengenai isu penolakan jabatan yang viral di media sosial.'
                                    ],
                                ];
                            @endphp

                            @foreach($newsItems as $news)
                                <article class="group flex flex-col h-full bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all">
                                    {{-- Image --}}
                                    <a href="/berita/detail" class="relative overflow-hidden h-48">
                                        <img src="{{ $news['image'] }}" alt="{{ $news['title'] }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                        @if($news['category'] === 'Hoaks')
                                            <div class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">HOAKS</div>
                                        @else
                                            <div class="absolute top-3 left-3 bg-[#1A305E] text-white text-xs font-bold px-2 py-1 rounded">{{ $news['category'] }}</div>
                                        @endif
                                    </a>
                                    
                                    {{-- Content --}}
                                    <div class="p-5 flex-1 flex flex-col">
                                        <div class="mb-2 flex items-center gap-2 text-xs text-gray-500">
                                            <span class="{{ $news['category'] === 'Hoaks' ? 'text-red-600' : 'text-[#D4AF37]' }} font-medium uppercase">{{ $news['category'] }}</span>
                                            <span>•</span>
                                            <span>{{ $news['time'] }}</span>
                                        </div>
                                        <a href="/berita/detail" class="block mb-3">
                                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-[#1A305E] transition-colors line-clamp-2 leading-tight">
                                                {{ $news['title'] }}
                                            </h3>
                                        </a>
                                        <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-1">
                                            {{ $news['desc'] }}
                                        </p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    {{-- Pagination --}}
                    <div class="flex justify-center pt-8">
                        <nav class="flex items-center gap-2">
                            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                            </button>
                            <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#1A305E] text-white font-medium">1</button>
                            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-600 font-medium transition-colors">2</button>
                             <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-600 font-medium transition-colors">3</button>
                             <span class="px-2 text-gray-400">...</span>
                            <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </button>
                        </nav>
                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 space-y-8">
                    
                    {{-- Magazine Widget --}}
                    <div class="bg-[#1A305E] rounded-xl overflow-hidden text-white relative">
                         <!-- Background pattern or image could go here -->
                        <div class="p-6 text-center z-10 relative">
                            <div class="mb-4">
                                <h3 class="text-xl font-bold tracking-widest mb-1">KOMDIGINEXT</h3>
                                <p class="text-[10px] uppercase text-gray-300 tracking-wider">Referensi Terpercaya Sektor Komunikasi dan Informatika</p>
                            </div>
                            
                            <!-- Magazine Cover Mockup -->
                            <div class="mx-auto w-40 h-56 bg-gradient-to-br from-blue-400 to-[#1A305E] rounded shadow-2xl mb-4 flex items-center justify-center relative overflow-hidden group cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1620912189868-3b178608d0ac?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-110 transition-transform duration-700">
                                <div class="relative text-center p-2">
                                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-2 backdrop-blur-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                                    </div>
                                    <span class="text-xs font-bold">Edisi Juli - September 2025</span>
                                </div>
                            </div>
                            
                            <h4 class="font-bold text-lg leading-tight mb-2">Merdeka Digital: Arah Baru Kedaulatan...</h4>
                            <a href="#" class="inline-block text-xs font-medium text-[#D4AF37] hover:text-white transition-colors uppercase tracking-wider">Lihat Edisi Lainnya &rarr;</a>
                        </div>
                    </div>

                    {{-- Government PR Widget --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-[#1A305E] mb-4 border-l-4 border-[#D4AF37] pl-3">Government Public Relation</h3>
                         <div class="space-y-4">
                            <div class="flex gap-3 items-start">
                                <div class="w-20 h-20 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                     <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2670&auto=format&fit=crop" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <span class="text-[10px] text-gray-500 block mb-1">sehari lalu</span>
                                    <a href="#" class="text-sm font-semibold text-gray-900 hover:text-[#1A305E] leading-snug line-clamp-3">
                                        BNPB Akselerasi Pembangunan Huntara di Lima Kecamatan Aceh Utara
                                    </a>
                                </div>
                            </div>
                            <hr class="border-gray-100">
                             <div class="flex gap-3 items-start">
                                <div class="w-20 h-20 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                     <img src="https://images.unsplash.com/photo-1469796466635-455ede028aca?q=80&w=2670&auto=format&fit=crop" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <span class="text-[10px] text-gray-500 block mb-1">sehari lalu</span>
                                    <a href="#" class="text-sm font-semibold text-gray-900 hover:text-[#1A305E] leading-snug line-clamp-3">
                                        Perkembangan Percepatan Penanganan Darurat dan Pemulihan Bencana
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Hashtag Widget --}}
                    <div class="relative rounded-xl overflow-hidden h-40 group">
                        <img src="https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?q=80&w=2664&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center p-4 text-center">
                            <h3 class="text-white font-bold text-lg leading-tight uppercase tracking-wider">#GOTONGROYONGPULIHKANSUMATRA</h3>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
