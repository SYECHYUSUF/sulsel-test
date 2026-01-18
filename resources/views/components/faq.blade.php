<section class="py-12 md:py-24 bg-white font-['Plus_Jakarta_Sans']" x-data="{ active: null }">
    <div class="container mx-auto px-4">
        {{-- Section Header --}}
        <div class="text-center mb-12 md:mb-16 max-w-3xl mx-auto" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 mb-4 px-5 py-2.5 bg-violet-100 border border-violet-200 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-violet-600">
                    <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" x2="12" y1="17" y2="17"/>
                </svg>
                <span class="text-violet-700 text-xs md:text-sm font-bold tracking-wide uppercase">Tanya Jawab</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight tracking-tight">Frequently Asked Questions</h2>
            <p class="text-base md:text-lg text-gray-600">Informasi cepat mengenai layanan keterbukaan informasi publik di Sulawesi Selatan</p>
        </div>

        <div class="max-w-4xl mx-auto space-y-4">
            @php
                $faqs = [
                    [
                        'q' => 'Apa itu Informasi Publik?', 
                        'a' => 'Informasi publik adalah informasi yang dihasilkan, disimpan, dikelola, dikirim, dan/atau diterima oleh suatu badan publik yang berkaitan dengan penyelenggara dan penyelenggaraan negara dan/atau penyelenggara dan penyelenggaraan badan publik lainnya.'
                    ],
                    [
                        'q' => 'Berapa lama waktu proses permohonan informasi?', 
                        'a' => 'Sesuai UU No. 14 Tahun 2008, PPID wajib memberikan tanggapan paling lambat 10 hari kerja sejak permohonan diterima. PPID dapat memperpanjang waktu paling lambat 7 hari kerja berikutnya.'
                    ],
                    [
                        'q' => 'Apakah ada biaya untuk permohonan informasi?', 
                        'a' => 'Layanan informasi publik pada PPID Sulawesi Selatan tidak dipungut biaya (Gratis). Namun, jika pemohon menginginkan penggandaan dokumen (fotokopi) atau pengiriman melalui kurir, biaya tersebut ditanggung oleh pemohon.'
                    ],
                    [
                        'q' => 'Dokumen apa yang harus disiapkan saat memohon informasi?', 
                        'a' => 'Pemohon wajib melampirkan identitas diri yang sah, yaitu KTP untuk perorangan, atau Akta Pendirian/Legalitas Organisasi untuk kategori Badan Hukum/Organisasi.'
                    ],
                    [
                        'q' => 'Bagaimana jika permohonan informasi saya ditolak?', 
                        'a' => 'Pemohon berhak mengajukan keberatan kepada Atasan PPID melalui formulir pengajuan keberatan yang tersedia di portal ini, selambat-lambatnya 30 hari kerja setelah tanggapan diterima.'
                    ],
                ];
            @endphp

            @foreach($faqs as $index => $faq)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-300"
                 data-aos="fade-up" data-aos-delay="{{ $index * 50 }}"
                 :class="active === {{ $index }} ? 'ring-2 ring-violet-500/20 border-violet-200 shadow-lg' : 'hover:border-violet-300'">
                
                <button @click="active = (active === {{ $index }} ? null : {{ $index }})" 
                        class="w-full flex items-center justify-between p-5 md:p-6 text-left focus:outline-none group">
                    <span class="text-base md:text-lg font-bold text-gray-900 leading-snug pr-4 group-hover:text-violet-600 transition-colors">
                        {{ $faq['q'] }}
                    </span>
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-violet-50 flex items-center justify-center group-hover:bg-violet-600 group-hover:text-white transition-all">
                        <svg :class="active === {{ $index }} ? 'rotate-180' : ''" class="w-5 h-5 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </div>
                </button>

                <div x-show="active === {{ $index }}" 
                     x-collapse 
                     x-cloak
                     class="px-5 pb-6 md:px-6 md:pb-8 pt-0">
                    <div class="h-px w-full bg-gray-100 mb-4"></div>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        {{ $faq['a'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>