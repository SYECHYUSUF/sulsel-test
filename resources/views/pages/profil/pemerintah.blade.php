<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-[#1A305E] dark:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <a href="#" class="hover:text-[#1A305E] dark:text-white transition-colors">Profil</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-medium">Profil Pemerintah Sulsel</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-2">
                        Profil Pemerintah Sulsel
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Provinsi Sulawesi Selatan - Bumi Panrita Lopi
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-20 h-1 bg-gradient-to-r from-[#1A305E] to-transparent rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-10 md:py-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
          
            {{-- Stats --}}
            <div class="grid md:grid-cols-3 gap-6 mb-10 max-w-5xl mx-auto">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 p-6 text-center">
                    <div class="w-12 h-12 bg-[#1A305E]/10 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#1A305E] dark:text-white"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <p class="text-2xl font-bold text-[#1A305E] dark:text-white mb-1">46.717,48 km²</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Luas Wilayah</p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 p-6 text-center">
                    <div class="w-12 h-12 bg-[#1A305E]/10 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#1A305E] dark:text-white"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <p class="text-2xl font-bold text-[#1A305E] dark:text-white mb-1">9,07 Juta Jiwa</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Jumlah Penduduk</p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 p-6 text-center">
                    <div class="w-12 h-12 bg-[#1A305E]/10 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#1A305E] dark:text-white"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                    </div>
                    <p class="text-2xl font-bold text-[#1A305E] dark:text-white mb-1">24 Wilayah</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Kabupaten/Kota</p>
                </div>
            </div>

            {{-- Content Grid --}}
            <div class="grid lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-8">
              
                    {{-- Profil --}}
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6 md:p-8">
                        <div class="mb-5">
                            <h2 class="text-2xl font-bold text-[#1A305E] dark:text-white mb-2">Profil Provinsi</h2>
                            <div class="w-20 h-1 bg-[#1A305E] rounded-full"></div>
                        </div>
                        <div class="prose prose-gray max-w-none space-y-4 text-gray-700 leading-relaxed text-justify">
                            <p>
                                <strong>Sulawesi Selatan</strong> merupakan salah satu provinsi di Indonesia yang terletak di bagian selatan Pulau Sulawesi. Sulawesi Selatan berbatasan dengan Provinsi Sulawesi Barat di sebelah utara, Teluk Bone dan Sulawesi Tenggara di timur, Selat Makassar di barat, dan Laut Flores di selatan.
                            </p>
                            <p>
                                Sulawesi Selatan memiliki luas wilayah 46.717,48 km² dengan jumlah penduduk sekitar 9,07 juta jiwa. Wilayah ini terbagi menjadi 21 kabupaten dan 3 kota dengan Makassar sebagai ibu kota provinsi.
                            </p>
                            <p>
                                Provinsi ini terkenal dengan kekayaan budayanya yang beragam, terutama budaya Bugis, Makassar, dan Toraja. Sulawesi Selatan juga memiliki potensi ekonomi yang besar terutama dalam bidang pertanian, perikanan, perdagangan, dan pariwisata.
                            </p>
                        </div>
                    </div>

                    {{-- Data Geografis --}}
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6 md:p-8">
                        <div class="mb-5">
                            <h2 class="text-2xl font-bold text-[#1A305E] dark:text-white mb-2">Data Geografis</h2>
                            <div class="w-20 h-1 bg-[#D4AF37] rounded-full"></div>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-4">
                            @php
                                $geografisData = [
                                    ['label' => 'Ibukota', 'value' => 'Makassar'],
                                    ['label' => 'Gubernur', 'value' => 'Andi Sudirman Sulaiman'],
                                    ['label' => 'Wakil Gubernur', 'value' => 'Fatmawati Rusdi'],
                                    ['label' => 'Jumlah Kecamatan', 'value' => '304 Kecamatan'],
                                    ['label' => 'Jumlah Kelurahan/Desa', 'value' => '3.054 Kel/Desa']
                                ];
                            @endphp
                            @foreach ($geografisData as $item)
                                <div class="flex items-center gap-3 p-4 bg-gray-50 dark:bg-slate-900 rounded-lg">
                                    <div class="w-2 h-2 bg-[#1A305E] rounded-full flex-shrink-0"></div>
                                    <div>
                                        <p class="text-xs text-gray-600 dark:text-gray-300">{{ $item['label'] }}</p>
                                        <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $item['value'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Visi Misi --}}
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6 md:p-8">
                        <div class="mb-5">
                            <h2 class="text-2xl font-bold text-[#1A305E] dark:text-white mb-2">Visi & Misi</h2>
                            <div class="w-20 h-1 bg-[#1A305E] rounded-full"></div>
                        </div>
                
                        {{-- Visi --}}
                        <div class="mb-6">
                            <h3 class="font-bold text-[#1A305E] dark:text-white mb-3 text-sm uppercase tracking-wide">Visi</h3>
                            <div class="bg-[#1A305E]/5 border-l-4 border-[#1A305E] rounded-r-lg p-5">
                                <p class="text-gray-700 font-medium leading-relaxed">
                                    Mewujudkan Sulawesi Selatan sebagai Provinsi Terdepan dalam Peningkatan Kualitas Hidup Masyarakat
                                </p>
                            </div>
                        </div>

                        {{-- Misi --}}
                        <div>
                            <h3 class="font-bold text-[#1A305E] dark:text-white mb-3 text-sm uppercase tracking-wide">Misi</h3>
                            <div class="space-y-3">
                                @php
                                    $misi = [
                                        'Meningkatkan kualitas dan aksesibilitas pelayanan dasar',
                                        'Mengembangkan ekonomi kerakyatan berbasis potensi lokal',
                                        'Membangun infrastruktur yang merata dan berkualitas',
                                        'Memperkuat tata kelola pemerintahan yang baik',
                                        'Melestarikan nilai-nilai budaya dan kearifan lokal'
                                    ];
                                @endphp
                                @foreach ($misi as $index => $item)
                                    <div class="flex gap-3 items-start">
                                        <div class="flex-shrink-0 w-6 h-6 bg-[#1A305E] rounded-lg flex items-center justify-center text-white font-bold text-xs">
                                            {{ $index + 1 }}
                                        </div>
                                        <p class="text-gray-700 text-sm leading-relaxed flex-1 pt-0.5">{{ $item }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
              
                    {{-- Pejabat --}}
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden sticky top-24">
                        <div class="bg-[#1A305E] px-5 py-4">
                            <h3 class="font-bold text-white">Pejabat Pemerintah</h3>
                        </div>
                
                        <div class="p-5 space-y-4">
                            {{-- Gubernur --}}
                            <div class="bg-[#1A305E]/5 rounded-lg p-4 border border-[#1A305E]/10">
                                <div class="aspect-[3/4] rounded-lg overflow-hidden mb-3 bg-white dark:bg-slate-800">
                                    <img 
                                        src="{{ asset('images/gubernur.jpg') }}"
                                        alt="Andi Sudirman Sulaiman"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <p class="font-bold text-[#1A305E] dark:text-white text-sm">Andi Sudirman Sulaiman</p>
                                <p class="text-xs text-[#D4AF37] font-medium">Gubernur Sulawesi Selatan</p>
                            </div>

                            {{-- Wakil Gubernur --}}
                            <div class="bg-[#D4AF37]/5 rounded-lg p-4 border border-[#D4AF37]/20">
                                <div class="aspect-[3/4] rounded-lg overflow-hidden mb-3 bg-white dark:bg-slate-800">
                                    <img 
                                        src="{{ asset('images/wakil-gubernur.jpg') }}"
                                        alt="Fatmawati Rusdi"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <p class="font-bold text-[#1A305E] dark:text-white text-sm">Fatmawati Rusdi</p>
                                <p class="text-xs text-[#B08D26] font-medium">Wakil Gubernur Sulawesi Selatan</p>
                            </div>
                        </div>
                    </div>

                    {{-- Potensi --}}
                    <div class="bg-gradient-to-br from-[#1A305E] to-[#4A5568] rounded-xl p-6 text-white">
                        <h4 class="font-bold mb-3">Potensi Daerah</h4>
                        <div class="space-y-2 text-sm text-white/90">
                            <div>• Pertanian & Perkebunan</div>
                            <div>• Perikanan & Kelautan</div>
                            <div>• Pariwisata Budaya</div>
                            <div>• Perdagangan & Jasa</div>
                            <div>• Industri Kreatif</div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>

    <x-footer />
</x-layout>
