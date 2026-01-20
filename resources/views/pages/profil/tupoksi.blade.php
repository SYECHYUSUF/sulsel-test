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
                <a href="#" class="hover:text-[#1A305E] transition-colors">Profil</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] font-medium">Tupoksi</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        Tupoksi
                    </h1>
                    <p class="text-gray-600">
                        Tugas Pokok dan Fungsi PPID Provinsi Sulawesi Selatan
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
            <div class="max-w-5xl mx-auto space-y-8">
            
                {{-- Intro --}}
                <div class="bg-[#1A305E] text-white rounded-xl p-8 text-center">
                    <h2 class="text-xl md:text-2xl font-bold mb-3">Tugas dan Tanggung Jawab PPID</h2>
                    <p class="text-white/90 leading-relaxed max-w-3xl mx-auto">
                        PPID memiliki tugas dan tanggung jawab dalam pengumpulan, pendokumentasian, penyediaan, dan pelayanan Informasi Publik, melakukan verifikasi dokumen Informasi Publik.
                    </p>
                </div>

                {{-- PPID Utama --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-10">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-[#1A305E] mb-2">Tugas PPID Utama</h2>
                        <div class="w-20 h-1 bg-[#1A305E] rounded-full"></div>
                    </div>
              
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Pejabat Pengelola Informasi dan Dokumentasi (PPID) memiliki tugas dan tanggung jawab dalam melakukan verifikasi bahan Informasi Publik, dan penyediaan Informasi Publik yang akurat, benar dan tidak menyesatkan:
                    </p>

                    <div class="space-y-3">
                        @php
                            $tugasPPIDUtama = [
                                'Melakukan pengumpulan, pendokumentasian, penyediaan, dan pelayanan Informasi Publik',
                                'Melakukan verifikasi dokumen Informasi Publik',
                                'Menguji konsekuensi Informasi Publik yang dibuka terhadap rahasia negara',
                                'Melakukan pengklasifikasian Informasi Publik dan/atau pengubahannya',
                                'Menetapkan Informasi Publik yang mudah diakses oleh publik',
                                'Menyediakan Informasi Publik yang wajib diakses oleh publik',
                                'Menyediakan Informasi Publik dan Daftar Informasi Publik yang Dikecualikan',
                                'Melakukan pembaruan, pengelolaan dan pengamanan informasi',
                                'Menyediakan sarana dan prasarana layanan informasi publik',
                                'Menyiapkan kebijakan teknis informasi publik yang dilakukan oleh PPID Pelaksana'
                            ];
                        @endphp
                        @foreach ($tugasPPIDUtama as $index => $tugas)
                            <div class="flex gap-4 items-start bg-[#1A305E]/5 rounded-lg p-4 border border-[#1A305E]/10 hover:bg-[#1A305E]/10 transition-colors">
                                <div class="flex-shrink-0 w-7 h-7 bg-[#1A305E] rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                    {{ $index + 1 }}
                                </div>
                                <p class="text-gray-700 leading-relaxed flex-1 pt-0.5">
                                    {{ $tugas }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- PPID Pelaksana --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-10">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-[#1A305E] mb-2">Tugas PPID Pelaksana</h2>
                        <div class="w-20 h-1 bg-[#D4AF37] rounded-full"></div>
                    </div>
              
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        PPID Pelaksana bertanggung jawab membantu PPID dalam menyimpan, mengklasifikasi, dan menyebarkan dokumen Informasi publik:
                    </p>

                    <div class="space-y-3">
                        @php
                            $tugasPPIDPelaksana = [
                                'Menyediakan, memberikan dan menerbitkan Informasi Publik yang berada di bawah kewenangannya',
                                'Membantu PPID dalam menyimpan, mengklasifikasi, dan menyebarkan dokumen Informasi publik',
                                'Memberikan pelayanan permohonan Informasi Publik yang langsung diambil, surat, fax, e-mail, dengan website PPID',
                                'Membuat PPID membuat laporan layanan Informasi publik secara berkala',
                                'Membuat, memelihara, dan/atau memutakhirkan daftar Informasi Publik yang berada dibawah penguasaannya secara berkala, dan melakukan uji keterbukaan terhadap pelayanan informasi publik'
                            ];
                        @endphp
                        @foreach ($tugasPPIDPelaksana as $index => $tugas)
                            <div class="flex gap-4 items-start bg-[#D4AF37]/5 rounded-lg p-4 border border-[#D4AF37]/20 hover:bg-[#D4AF37]/10 transition-colors">
                                <div class="flex-shrink-0 w-7 h-7 bg-[#D4AF37] rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                    {{ $index + 1 }}
                                </div>
                                <p class="text-gray-700 leading-relaxed flex-1 pt-0.5">
                                    {{ $tugas }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Prinsip --}}
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white border border-[#1A305E]/20 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <h3 class="font-bold text-[#1A305E] mb-4">Prinsip Pelayanan</h3>
                        <div class="space-y-2 text-sm text-gray-700">
                            <div class="flex gap-2"><span class="text-[#1A305E] font-bold">✓</span> Transparan dan akuntabel</div>
                            <div class="flex gap-2"><span class="text-[#1A305E] font-bold">✓</span> Cepat dan tepat waktu</div>
                            <div class="flex gap-2"><span class="text-[#1A305E] font-bold">✓</span> Mudah diakses</div>
                            <div class="flex gap-2"><span class="text-[#1A305E] font-bold">✓</span> Profesional dan berintegritas</div>
                        </div>
                    </div>

                    <div class="bg-white border border-[#D4AF37]/40 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <h3 class="font-bold text-[#B08D26] mb-4">Standar Layanan</h3>
                        <div class="space-y-2 text-sm text-gray-700">
                            <div class="flex gap-2"><span class="text-[#D4AF37] font-bold">✓</span> Informasi akurat dan benar</div>
                            <div class="flex gap-2"><span class="text-[#D4AF37] font-bold">✓</span> Tidak menyesatkan</div>
                            <div class="flex gap-2"><span class="text-[#D4AF37] font-bold">✓</span> Lengkap dan terkini</div>
                            <div class="flex gap-2"><span class="text-[#D4AF37] font-bold">✓</span> Sesuai regulasi KIP</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
