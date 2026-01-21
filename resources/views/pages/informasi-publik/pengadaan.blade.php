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
                <a href="/informasi-publik" class="hover:text-[#1A305E] dark:text-white transition-colors">Barang Dan Jasa</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-medium">Informasi Pengadaan</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-2xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-2">
                        INFORMASI PENGADAAN BARANG DAN JASA
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Informasi pengadaan barang dan jasa Pemerintah Provinsi Sulawesi Selatan
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
            <div class="max-w-7xl mx-auto">
            
                {{-- Search Box --}}
                <div class="flex gap-4 mb-6">
                    <div class="flex-1">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            <input
                                type="text"
                                placeholder="Search..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1A305E]"
                            />
                        </div>
                    </div>
                    <button class="px-6 py-2 bg-[#D4AF37] text-white rounded-lg hover:bg-[#B08D26] transition-colors font-medium">
                        Cari
                    </button>
                </div>

                {{-- Table --}}
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-[#1A305E] text-white">
                                <tr>
                                    <th class="px-4 py-3 text-sm font-semibold">No.</th>
                                    <th class="px-4 py-3 text-sm font-semibold">Judul</th>
                                    <th class="px-4 py-3 text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @php
                                    $informasiData = [
                                        ['no' => 1, 'judul' => 'Rencana Umum Pengadaan Pemerintah Provinsi Sulawesi Selatan Tahun 2023, 2024, 2024'],
                                        ['no' => 2, 'judul' => 'RUP PENGADAAN TERHUB LKNG SEGMEN RUAK JALAN PROVINSI KAB. BARRU'],
                                        ['no' => 3, 'judul' => 'RUP PENGADAAN TERHUB LKNG SEGMEN RUAK JALAN PROVINSI KAB. KAB. SOPHENG DI KAB. BARRU'],
                                        ['no' => 4, 'judul' => 'DOKUMEN PENGADAAN PEKERJAAN TERHUB LKNG ( SEGMEN RUAK JALAN PROVINSI KAB.SYTE- KAB. SOPHENG DI KAB. BARRU'],
                                        ['no' => 5, 'judul' => 'DOKUMEN PENGADAAN PEKERJAAN TERHUB LKNG ( SEGMEN RUAK JALAN PROVINSI KAB.SYTE- KAB. SOPHENG DI KAB. BARRU'],
                                        ['no' => 6, 'judul' => 'SPPD PENINGKATAN PENGADAAN TERHUB PELAK JALAN PROVINSI KAB. SOPHENG DI KAB. BARRU'],
                                        ['no' => 7, 'judul' => 'SPPD PENINGKATAN PENGADAAN TERHUB LKNG (SEGMEN) RUAK JALAN PROVINSI KAB. SOPHENG DI KAB. BARRU'],
                                        ['no' => 8, 'judul' => 'DOKUMEN PUBLIKASI LELANG PENGADAAN TERHUB LKNG SEGMEN RUAK JALAN PROVINSI KAB. BARRU'],
                                        ['no' => 9, 'judul' => 'Sppd Kunci Pengadaan Terhub Lkng Pengumuman TERHUB PENGADAAN LKNG SEGMEN RUAK JALAN PROVINSI KAB. BARRU'],
                                        ['no' => 10, 'judul' => 'Sppd Kunci Pengadaan Terhub Lkng Segra Bregu PENGADAAN TERHUB PENGADAAN LKNG SEGMEN RUAK JALAN PROVINSI...BTS']
                                    ];
                                @endphp
                                @foreach ($informasiData as $item)
                                    <tr class="hover:bg-[#1A305E]/5 transition-colors">
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $item['no'] }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 font-medium">{{ $item['judul'] }}</td>
                                        <td class="px-4 py-3 text-center whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button class="p-1.5 text-[#1A305E] dark:text-white hover:bg-[#1A305E]/10 rounded transition-colors" title="Lihat">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                                </button>
                                                <span class="text-xs font-bold text-[#1A305E] dark:text-white bg-[#1A305E]/10 px-2 py-0.5 rounded">
                                                    481
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="border-t border-gray-200 dark:border-slate-700 px-6 py-4 bg-gray-50 dark:bg-slate-900 flex items-center justify-center gap-2">
                         <button class="w-8 h-8 flex items-center justify-center bg-[#1A305E] text-white rounded hover:bg-[#1A305E]/90">1</button>
                         <button class="w-8 h-8 flex items-center justify-center bg-white dark:bg-slate-800 text-gray-700 border border-gray-200 dark:border-slate-700 rounded hover:bg-gray-100 dark:bg-slate-700">2</button>
                         <button class="w-8 h-8 flex items-center justify-center bg-white dark:bg-slate-800 text-gray-700 border border-gray-200 dark:border-slate-700 rounded hover:bg-gray-100 dark:bg-slate-700">3</button>
                         <span class="text-gray-500">...</span>
                         <button class="w-8 h-8 flex items-center justify-center bg-white dark:bg-slate-800 text-gray-700 border border-gray-200 dark:border-slate-700 rounded hover:bg-gray-100 dark:bg-slate-700">18</button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
