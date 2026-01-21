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
                <a href="/informasi-publik" class="hover:text-[#1A305E] dark:text-white transition-colors">Daftar Informasi Publik</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-medium">Tahun 2024</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-2">
                        Daftar Informasi Publik 2024
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Daftar lengkap informasi publik tahun 2024
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
            
                {{-- Info Banner --}}
                <div class="bg-[#1A305E] text-white rounded-xl p-6 mb-8">
                    <div class="flex items-start gap-4">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 flex-shrink-0 mt-0.5"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                        <div>
                            <h2 class="font-bold text-lg mb-2">Daftar Informasi Publik 2024</h2>
                            <p class="text-white/90 text-sm leading-relaxed">
                                Berikut adalah daftar lengkap informasi publik yang tersedia di Pemerintah Provinsi Sulawesi Selatan tahun 2024.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Table --}}
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                    <div class="border-b border-gray-200 dark:border-slate-700 px-6 py-4 flex items-center justify-between bg-gray-50 dark:bg-slate-900">
                        <h3 class="font-bold text-gray-900 dark:text-white">Daftar Informasi Publik 2024</h3>
                        <button class="flex items-center gap-2 text-[#1A305E] dark:text-white hover:text-[#D4AF37] text-sm font-medium transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                            Export Data
                        </button>
                    </div>
              
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-[#1A305E] text-white">
                                <tr>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">No</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">Jenis Informasi</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">Ringkasan Isi Informasi</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">Pejabat yang Menguasai</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">Penanggung Jawab</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">Format</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">Tahun</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @php
                                    $informasiData = [
                                        ['no' => 1, 'jenis' => 'Informasi tentang profil Badan Publik', 'ringkasan' => 'Profil Pemerintah Provinsi Sulawesi Selatan', 'pejabat' => 'Sekretaris Daerah', 'penanggungJawab' => 'Kepala Bagian Humas', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 2, 'jenis' => 'Ringkasan informasi tentang program dan kegiatan', 'ringkasan' => 'RPJMD, RKPD, Rencana Strategis', 'pejabat' => 'Kepala Bappeda', 'penanggungJawab' => 'Kepala Bidang Perencanaan', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 3, 'jenis' => 'Ringkasan informasi tentang kinerja', 'ringkasan' => 'LAKIP, LKPJ, Laporan Kinerja OPD', 'pejabat' => 'Sekretaris Daerah', 'penanggungJawab' => 'Kepala Bagian Organisasi', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 4, 'jenis' => 'Ringkasan laporan keuangan', 'ringkasan' => 'APBD, LKPD, Laporan Realisasi Anggaran', 'pejabat' => 'Kepala BPKAD', 'penanggungJawab' => 'Kepala Bidang Akuntansi', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 5, 'jenis' => 'Ringkasan laporan akses informasi publik', 'ringkasan' => 'Statistik Layanan Informasi Publik', 'pejabat' => 'PPID Utama', 'penanggungJawab' => 'Kepala Seksi Layanan Informasi', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 6, 'jenis' => 'Informasi tentang penerimaan CPNS', 'ringkasan' => 'Pengumuman CPNS, PPPK, Formasi', 'pejabat' => 'Kepala BKD', 'penanggungJawab' => 'Kepala Bidang Pengadaan', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 7, 'jenis' => 'Informasi tentang PPDB', 'ringkasan' => 'Pengumuman PPDB, Jalur Pendaftaran', 'pejabat' => 'Kepala Dinas Pendidikan', 'penanggungJawab' => 'Kepala Bidang SMA/SMK', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 8, 'jenis' => 'Informasi tentang tata ruang', 'ringkasan' => 'RTRW Provinsi Sulawesi Selatan', 'pejabat' => 'Kepala Dinas PUPR', 'penanggungJawab' => 'Kepala Bidang Cipta Karya', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 9, 'jenis' => 'Data Statistik Daerah', 'ringkasan' => 'Sulawesi Selatan Dalam Angka', 'pejabat' => 'Kepala BPS Sulsel', 'penanggungJawab' => 'Kepala Seksi Statistik', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 10, 'jenis' => 'Informasi hasil pengadaan barang dan jasa', 'ringkasan' => 'Pemenang Lelang, Kontrak Pengadaan', 'pejabat' => 'UKPBJ', 'penanggungJawab' => 'Kepala UKPBJ', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 11, 'jenis' => 'Peraturan Daerah', 'ringkasan' => 'Perda Provinsi Sulawesi Selatan', 'pejabat' => 'Sekretaris Daerah', 'penanggungJawab' => 'Kepala Biro Hukum', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 12, 'jenis' => 'Peraturan Gubernur', 'ringkasan' => 'Pergub Provinsi Sulawesi Selatan', 'pejabat' => 'Sekretaris Daerah', 'penanggungJawab' => 'Kepala Biro Hukum', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 13, 'jenis' => 'Keputusan Gubernur', 'ringkasan' => 'SK Gubernur Sulawesi Selatan', 'pejabat' => 'Sekretaris Daerah', 'penanggungJawab' => 'Kepala Biro Hukum', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 14, 'jenis' => 'Informasi Layanan Kesehatan', 'ringkasan' => 'Program Kesehatan, Rumah Sakit, Puskesmas', 'pejabat' => 'Kepala Dinas Kesehatan', 'penanggungJawab' => 'Kepala Bidang Pelayanan Kesehatan', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 15, 'jenis' => 'Informasi Layanan Sosial', 'ringkasan' => 'Program Bantuan Sosial, DTKS', 'pejabat' => 'Kepala Dinas Sosial', 'penanggungJawab' => 'Kepala Bidang Bantuan Sosial', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 16, 'jenis' => 'Informasi Perizinan', 'ringkasan' => 'Jenis Izin, Persyaratan, Prosedur', 'pejabat' => 'Kepala DPMPTSP', 'penanggungJawab' => 'Kepala Bidang Perizinan', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 17, 'jenis' => 'Informasi Kependudukan', 'ringkasan' => 'Data Kependudukan, Layanan Adminduk', 'pejabat' => 'Kepala Disdukcapil', 'penanggungJawab' => 'Kepala Bidang Pelayanan', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 18, 'jenis' => 'Informasi Pariwisata', 'ringkasan' => 'Destinasi Wisata, Event Pariwisata', 'pejabat' => 'Kepala Dispar', 'penanggungJawab' => 'Kepala Bidang Destinasi', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 19, 'jenis' => 'Informasi Pertanian', 'ringkasan' => 'Program Pertanian, Bantuan Petani', 'pejabat' => 'Kepala Dinas Pertanian', 'penanggungJawab' => 'Kepala Bidang Tanaman Pangan', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 20, 'jenis' => 'Informasi Perikanan', 'ringkasan' => 'Program Perikanan, Bantuan Nelayan', 'pejabat' => 'Kepala Dinas Perikanan', 'penanggungJawab' => 'Kepala Bidang Perikanan Tangkap', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 21, 'jenis' => 'Informasi Perhubungan', 'ringkasan' => 'Layanan Transportasi, Terminal, Pelabuhan', 'pejabat' => 'Kepala Dishub', 'penanggungJawab' => 'Kepala Bidang Lalu Lintas', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 22, 'jenis' => 'Informasi Lingkungan Hidup', 'ringkasan' => 'Program Lingkungan, Pengelolaan Sampah', 'pejabat' => 'Kepala Dinas LH', 'penanggungJawab' => 'Kepala Bidang Pengendalian', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 23, 'jenis' => 'Informasi Ketenagakerjaan', 'ringkasan' => 'Lowongan Kerja, Pelatihan Kerja', 'pejabat' => 'Kepala Disnaker', 'penanggungJawab' => 'Kepala Bidang Penempatan', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 24, 'jenis' => 'Informasi Koperasi dan UKM', 'ringkasan' => 'Program Koperasi, Bantuan UMKM', 'pejabat' => 'Kepala Diskop UKM', 'penanggungJawab' => 'Kepala Bidang Pemberdayaan', 'format' => 'PDF', 'tahun' => '2024'],
                                        ['no' => 25, 'jenis' => 'Informasi Perindustrian', 'ringkasan' => 'Program Industri, Perizinan Industri', 'pejabat' => 'Kepala Disperindag', 'penanggungJawab' => 'Kepala Bidang Industri', 'format' => 'PDF', 'tahun' => '2024']
                                    ];
                                @endphp
                                @foreach ($informasiData as $item)
                                    <tr class="hover:bg-[#1A305E]/5 transition-colors border-b border-gray-100 last:border-0">
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white font-medium whitespace-nowrap">{{ $item['no'] }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 min-w-[200px]">{{ $item['jenis'] }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 min-w-[250px]">{{ $item['ringkasan'] }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 min-w-[150px]">{{ $item['pejabat'] }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300 min-w-[150px]">{{ $item['penanggungJawab'] }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300 whitespace-nowrap">{{ $item['format'] }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300 whitespace-nowrap">{{ $item['tahun'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Footer Info --}}
                    <div class="border-t border-gray-200 dark:border-slate-700 px-6 py-4 bg-gray-50 dark:bg-slate-900">
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            Menampilkan <strong>{{ count($informasiData) }}</strong> dari <strong>{{ count($informasiData) }}</strong> informasi publik tahun 2024
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
