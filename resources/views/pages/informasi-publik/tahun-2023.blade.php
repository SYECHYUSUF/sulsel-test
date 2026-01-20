<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white border-b border-gray-200 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
                <a href="/" class="hover:text-[#1A305E] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <a href="/informasi-publik" class="hover:text-[#1A305E] transition-colors">Daftar Informasi Publik</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] font-medium">Tahun 2023</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        Daftar Informasi Publik 2023
                    </h1>
                    <p class="text-gray-600">
                        Informasi publik yang tersedia tahun 2023
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-20 h-1 bg-gradient-to-r from-[#1A305E] to-transparent rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-10 md:py-16 bg-gray-50 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto space-y-10">
            
                {{-- A. INFORMASI WAJIB DIUMUMKAN SECARA BERKALA --}}
                <section>
                    <div class="bg-[#1A305E] text-white px-6 py-4 rounded-t-xl">
                        <h2 class="font-bold text-lg">A. INFORMASI WAJIB DIUMUMKAN SECARA BERKALA</h2>
                    </div>
                    <div class="bg-white rounded-b-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Jenis Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Ringkasan Isi Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Pejabat yang Menguasai Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Waktu Pembuatan</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Bentuk Informasi yang Tersedia</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Jangka Waktu Penyimpanan</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Jenis Media yang Memuat Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Biaya/Tarif Memperoleh Informasi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @php
                                        $berkalaData = [
                                            ['jenis' => 'Informasi tentang profil', 'ringkasan' => 'Profil Pemprov Sulsel', 'pejabat' => 'Sekretaris Daerah', 'waktu' => 'Setiap saat', 'bentuk' => 'Softcopy', 'jangkaWaktu' => '1 Hari Kerja', 'jenisMedia' => 'Website', 'biaya' => 'Gratis'],
                                            ['jenis' => 'Program dan kegiatan', 'ringkasan' => 'RPJMD, RKPD', 'pejabat' => 'Kepala Bappeda', 'waktu' => 'Setiap tahun', 'bentuk' => 'Softcopy/Hardcopy', 'jangkaWaktu' => '2 Hari Kerja', 'jenisMedia' => 'Website/Cetak', 'biaya' => 'Gratis']
                                        ];
                                    @endphp
                                    @foreach ($berkalaData as $item)
                                        <tr class="hover:bg-[#1A305E]/5 transition-colors">
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item['jenis'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item['ringkasan'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item['pejabat'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['waktu'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['bentuk'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['jangkaWaktu'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['jenisMedia'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['biaya'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                {{-- B. INFORMASI WAJIB DIUMUMKAN SECARA SERTA MERTA --}}
                <section>
                    <div class="bg-[#D4AF37] text-white px-6 py-4 rounded-t-xl">
                        <h2 class="font-bold text-lg">B. INFORMASI WAJIB DIUMUMKAN SECARA SERTA MERTA</h2>
                    </div>
                    <div class="bg-white rounded-b-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Jenis Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Ringkasan Isi Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Pejabat yang Menguasai Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Waktu Pembuatan</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Bentuk Informasi yang Tersedia</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Jangka Waktu Penyimpanan</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Jenis Media yang Memuat Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Biaya/Tarif Memperoleh Informasi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @php
                                        $sertaMertaData = [
                                            ['jenis' => 'Informasi bencana alam', 'ringkasan' => 'Peringatan dini bencana', 'pejabat' => 'Kepala BPBD', 'waktu' => 'Segera', 'bentuk' => 'Pengumuman', 'jangkaWaktu' => 'Segera', 'jenisMedia' => 'Media Massa', 'biaya' => 'Gratis']
                                        ];
                                    @endphp
                                    @foreach ($sertaMertaData as $item)
                                        <tr class="hover:bg-[#D4AF37]/5 transition-colors">
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item['jenis'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item['ringkasan'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item['pejabat'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['waktu'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['bentuk'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['jangkaWaktu'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['jenisMedia'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['biaya'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                {{-- C. INFORMASI TERSEDIA SETIAP SAAT --}}
                <section>
                    <div class="bg-[#4A5568] text-white px-6 py-4 rounded-t-xl">
                        <h2 class="font-bold text-lg">C. INFORMASI TERSEDIA SETIAP SAAT</h2>
                    </div>
                    <div class="bg-white rounded-b-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Jenis Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Ringkasan Isi Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Pejabat yang Menguasai Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Waktu Pembuatan</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Bentuk Informasi yang Tersedia</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Jangka Waktu Penyimpanan</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Jenis Media yang Memuat Informasi</th>
                                        <th class="px-4 py-3 text-xs font-semibold text-gray-700 uppercase tracking-wide">Biaya/Tarif Memperoleh Informasi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @php
                                        $setiapSaatData = [
                                            ['jenis' => 'Daftar Informasi Publik', 'ringkasan' => 'Daftar seluruh informasi', 'pejabat' => 'PPID Utama', 'waktu' => 'Setiap saat', 'bentuk' => 'Softcopy', 'jangkaWaktu' => '10 Hari Kerja', 'jenisMedia' => 'Website', 'biaya' => 'Sesuai PP']
                                        ];
                                    @endphp
                                    @foreach ($setiapSaatData as $item)
                                        <tr class="hover:bg-gray-100 transition-colors">
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item['jenis'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item['ringkasan'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item['pejabat'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['waktu'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['bentuk'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['jangkaWaktu'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['jenisMedia'] }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item['biaya'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
