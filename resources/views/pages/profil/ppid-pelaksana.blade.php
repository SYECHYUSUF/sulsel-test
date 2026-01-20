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
                <span class="text-[#1A305E] font-medium">Profil</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] font-medium">PPID Pelaksana</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        PPID Pelaksana
                    </h1>
                    <p class="text-gray-600">
                        Daftar PPID Pelaksana Provinsi Sulawesi Selatan
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
            <div class="max-w-7xl mx-auto">
            
                @php
                    $ppidData = [
                        [
                            'name' => 'Badan Perencanaan, Penelitian Dan Pengembangan Daerah',
                            'address' => 'Jl. Jend. Urip Sumoharjo No. 269 Makassar',
                            'postalCode' => 'Kode Pos Kota Makassar 90234',
                            'phone' => '0411-455297',
                            'email' => 'bappeda@sulselprov.go.id',
                            'website' => 'https://bappeda.sulselprov.go.id'
                        ],
                        [
                            'name' => 'Badan Pengelolaan Keuangan Dan Aset Daerah',
                            'address' => 'Jl. Jend. Sudirman No. 5 Makassar',
                            'postalCode' => 'Kode Pos Kota Makassar 90111',
                            'phone' => '0411-441962',
                            'email' => 'bpkad@sulselprov.go.id',
                            'website' => 'https://bpkad.sulselprov.go.id'
                        ],
                        [
                            'name' => 'Dinas Komunikasi, Informatika, Statistik Dan Persandian',
                            'address' => 'Jl. Urip Sumoharjo No. 269 Makassar',
                            'postalCode' => 'Kode Pos Kota Makassar 90234',
                            'phone' => '0411-448907',
                            'email' => 'diskominfo@sulselprov.go.id',
                            'website' => 'https://diskominfo.sulselprov.go.id'
                        ],
                        [
                            'name' => 'Badan Kepegawaian, Pendidikan Dan Pelatihan Daerah',
                            'address' => 'Jl. A. P. Pettarani No. 1 Makassar 90221 - Provinsi Sulawesi Selatan',
                            'postalCode' => '',
                            'phone' => '0411-452346',
                            'email' => 'bkpsdm@sulselprov.go.id',
                            'website' => 'https://bkpsdm.sulselprov.go.id'
                        ],
                        [
                            'name' => 'Badan Pendapatan Daerah Provinsi Sulawesi Selatan',
                            'address' => 'Jl. Urip Sumoharjo KM.4 Makassar',
                            'postalCode' => '',
                            'phone' => '0411-452346',
                            'email' => 'bapenda@sulselprov.go.id',
                            'website' => 'https://bapenda.sulselprov.go.id'
                        ],
                        [
                            'name' => 'Dinas Kesehatan Provinsi Sulawesi Selatan',
                            'address' => 'Jl. Perintis Kemerdekaan KM. 10 Tamalanrea, Kec. Tamalanrea, Makassar Sulawesi Selatan 90245',
                            'postalCode' => '',
                            'phone' => '0411-584534',
                            'email' => 'dinkes@sulselprov.go.id',
                            'website' => 'https://dinkes.sulselprov.go.id'
                        ],
                        [
                            'name' => 'Dinas Pekerjaan Umum Dan Penataan Ruang Provinsi Sulawesi Selatan',
                            'address' => 'Jl. A. P. Pettarani No. 1 Makassar',
                            'postalCode' => 'Kode Pos Kota Makassar 90111',
                            'phone' => '0411-424809',
                            'email' => 'pupr@sulselprov.go.id',
                            'website' => 'https://pupr.sulselprov.go.id'
                        ],
                        [
                            'name' => 'Dinas Perumahan, Kawasan Permukiman, Cipta Karya Dan Pertanahan',
                            'address' => 'Jl. Urip Sumoharjo No. 269 Makassar, Kec. Panakkukang Kota Makassar',
                            'postalCode' => '',
                            'phone' => '0411-448907',
                            'email' => 'perkim@sulselprov.go.id',
                            'website' => 'https://perkim.sulselprov.go.id'
                        ],
                        [
                            'name' => 'Dinas Sosial Provinsi Sulawesi Selatan',
                            'address' => 'Jl. AP. Pettarani No. 3 Makassar, Kec. Panakkukang, Kota Makassar',
                            'postalCode' => '',
                            'phone' => '0411-452346',
                            'email' => 'dinsos@sulselprov.go.id',
                            'website' => 'https://dinsos.sulselprov.go.id'
                        ]
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($ppidData as $ppid)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all hover:border-[#D4AF37]/50 group">
                            {{-- Logo --}}
                            <div class="flex justify-center mb-4">
                                <img src="{{ asset('images/logo-sulsel.png') }}" alt="Logo" class="w-16 h-16 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>

                            {{-- Name --}}
                            <h3 class="text-center font-bold text-[#1A305E] mb-4 text-sm leading-tight min-h-[40px]">
                                {{ $ppid['name'] }}
                            </h3>

                            {{-- Contact Info --}}
                            <div class="space-y-3 text-xs text-gray-600">
                                <div>
                                    <p class="font-semibold text-gray-900 mb-1">Alamat:</p>
                                    <p class="leading-relaxed">{{ $ppid['address'] }}</p>
                                    @if($ppid['postalCode'])
                                        <p class="leading-relaxed">{{ $ppid['postalCode'] }}</p>
                                    @endif
                                </div>

                                <div class="flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#D4AF37] flex-shrink-0 mt-0.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    <div>
                                        <p class="font-semibold text-gray-900">Phone:</p>
                                        <p>{{ $ppid['phone'] }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#D4AF37] flex-shrink-0 mt-0.5"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                    <div>
                                        <p class="font-semibold text-gray-900">Email:</p>
                                        <a href="mailto:{{ $ppid['email'] }}" class="text-[#1A305E] hover:underline break-all group-hover:text-[#D4AF37] transition-colors">
                                            {{ $ppid['email'] }}
                                        </a>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#D4AF37] flex-shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"/><line x1="2" x2="22" y1="12" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                    <div>
                                        <p class="font-semibold text-gray-900">Website:</p>
                                        <a href="{{ $ppid['website'] }}" target="_blank" rel="noopener noreferrer" class="text-[#1A305E] hover:underline break-all group-hover:text-[#D4AF37] transition-colors">
                                            {{ $ppid['website'] }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination (Placeholder) --}}
                <div class="mt-8 flex items-center justify-center gap-2">
                    <button class="w-8 h-8 flex items-center justify-center bg-[#1A305E] text-white rounded hover:bg-[#1A305E]/90 transition-colors">1</button>
                    <button class="w-8 h-8 flex items-center justify-center bg-white text-gray-700 rounded hover:bg-gray-100 border border-gray-300 transition-colors">2</button>
                    <button class="w-8 h-8 flex items-center justify-center bg-white text-gray-700 rounded hover:bg-gray-100 border border-gray-300 transition-colors">3</button>
                    <span class="px-2 text-gray-400">...</span>
                    <button class="w-8 h-8 flex items-center justify-center bg-white text-gray-700 rounded hover:bg-gray-100 border border-gray-300 transition-colors">7</button>
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
