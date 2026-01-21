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
                <span class="text-[#1A305E] dark:text-white font-medium">Survey</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-medium">Isi Survey</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-2">
                        Survey Kepuasan Masyarakat
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Bantu kami meningkatkan kualitas pelayanan
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
            <div class="max-w-4xl mx-auto bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                
                <div class="mb-8 border-b border-gray-100 pb-6">
                    <h2 class="text-xl font-bold text-[#1A305E] dark:text-white mb-2">Formulir Survey</h2>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Mohon isi survey di bawah ini dengan jujur untuk evaluasi kami.</p>
                </div>

                <form class="space-y-6">
                    
                    {{-- Section: Data Responden --}}
                    <div class="bg-gray-50 dark:bg-slate-900 p-6 rounded-xl border border-gray-200 dark:border-slate-700">
                        <h3 class="font-bold text-[#1A305E] dark:text-white mb-4 flex items-center gap-2">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-[#1A305E] text-white text-xs">1</span>
                            Data Responden
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                                <input type="text" placeholder="Masukkan nama" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] outline-none" />
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Pekerjaan</label>
                                <input type="text" placeholder="Masukkan pekerjaan" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] outline-none" />
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Pendidikan Terakhir</label>
                                <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] outline-none bg-white dark:bg-slate-800">
                                    <option>SD/Sederajat</option>
                                    <option>SMP/Sederajat</option>
                                    <option>SMA/Sederajat</option>
                                    <option>D3</option>
                                    <option>S1/D4</option>
                                    <option>S2</option>
                                    <option>S3</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Jenis Layanan</label>
                                <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] outline-none bg-white dark:bg-slate-800">
                                    <option>Permohonan Informasi</option>
                                    <option>Pengajuan Keberatan</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Section: Penilaian --}}
                    <div class="bg-gray-50 dark:bg-slate-900 p-6 rounded-xl border border-gray-200 dark:border-slate-700">
                        <h3 class="font-bold text-[#1A305E] dark:text-white mb-4 flex items-center gap-2">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-[#1A305E] text-white text-xs">2</span>
                            Penilaian Pelayanan
                        </h3>
                        
                        <div class="space-y-6">
                            @php
                                $questions = [
                                    "Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?",
                                    "Bagaimana pendapat Saudara tentang kemudahan prosedur pelayanan di unit ini?",
                                    "Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?",
                                    "Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan?",
                                    "Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan?"
                                ];
                            @endphp
                            @foreach($questions as $index => $question)
                                <div class="space-y-3 pb-4 border-b border-gray-200 dark:border-slate-700 last:border-0">
                                    <p class="text-sm font-medium text-gray-800">{{ $index + 1 }}. {{ $question }}</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="q{{ $index }}" class="text-[#1A305E] dark:text-white focus:ring-[#1A305E]" />
                                            <span class="text-sm text-gray-600 dark:text-gray-300">Sangat Baik</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="q{{ $index }}" class="text-[#1A305E] dark:text-white focus:ring-[#1A305E]" />
                                            <span class="text-sm text-gray-600 dark:text-gray-300">Baik</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="q{{ $index }}" class="text-[#1A305E] dark:text-white focus:ring-[#1A305E]" />
                                            <span class="text-sm text-gray-600 dark:text-gray-300">Cukup</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="q{{ $index }}" class="text-[#1A305E] dark:text-white focus:ring-[#1A305E]" />
                                            <span class="text-sm text-gray-600 dark:text-gray-300">Buruk</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Section: Kritik & Saran --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Kritik dan Saran</label>
                        <textarea rows="4" placeholder="Tuliskan kritik dan saran Anda untuk perbaikan layanan kami" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="button" class="w-full md:w-auto px-8 py-3 bg-[#1A305E] text-white font-semibold rounded-lg hover:bg-[#1A305E]/90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Kirim Survey
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
