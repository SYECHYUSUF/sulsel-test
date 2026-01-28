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
                <span class="text-[#1A305E] dark:text-white font-medium">Hasil Survey</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-2">
                        Hasil Survey
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Indeks Kepuasan Masyarakat (IKM)
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
            <div class="max-w-7xl mx-auto space-y-12">
            
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-[#1A305E] dark:text-white mb-4">Indeks Kepuasan Masyarakat</h2>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-6">
                            Hasil survei kepuasan masyarakat terhadap pelayanan informasi publik di lingkungan Pemerintah Provinsi Sulawesi Selatan menunjukkan kategori <strong>SANGAT BAIK</strong>. Kami terus berkomitmen untuk meningkatkan kualitas pelayanan publik.
                        </p>
                        
                        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6">
                            <div class="flex items-end gap-2 mb-2">
                                <span class="text-5xl font-bold text-[#D4AF37]">88.5</span>
                                <span class="text-gray-500 mb-2">/ 100</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                <div class="bg-[#1A305E] h-2.5 rounded-full" style="width: 88.5%"></div>
                            </div>
                            <p class="text-sm font-medium text-[#1A305E] dark:text-white">Kategori: SANGAT BAIK</p>
                        </div>
                    </div>
                    <div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                                <h3 class="text-4xl font-bold text-[#1A305E] dark:text-white mb-1">1,240</h3>
                                <p class="text-sm text-gray-500">Responden</p>
                            </div>
                            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                                <h3 class="text-4xl font-bold text-[#1A305E] dark:text-white mb-1">92%</h3>
                                <p class="text-sm text-gray-500">Tingkat Penyelesaian</p>
                            </div>
                            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                                <h3 class="text-4xl font-bold text-[#1A305E] dark:text-white mb-1">4.8</h3>
                                <p class="text-sm text-gray-500">Rating Rata-rata</p>
                            </div>
                             <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                                <h3 class="text-4xl font-bold text-[#1A305E] dark:text-white mb-1">24h</h3>
                                <p class="text-sm text-gray-500">Waktu Respon</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Survey Results by Question --}}
                <div class="space-y-6">
                    @foreach($results as $result)
                        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md border-2 border-gray-200 dark:border-slate-700 overflow-hidden hover:shadow-xl transition-all">
                            {{-- Question Header --}}
                            <div class="bg-gradient-to-r from-[#1A305E] to-[#2A4A7E] p-6">
                                <div class="flex items-start gap-3">
                                    <span class="flex-shrink-0 inline-flex items-center justify-center w-10 h-10 rounded-full bg-white text-[#1A305E] text-lg font-bold shadow-md">
                                        {{ $result['question']->urutan }}
                                    </span>
                                    <h4 class="text-lg font-bold text-white leading-relaxed pt-1">
                                        {{ $result['question']->soal }}
                                    </h4>
                                </div>
                            </div>
                            
                            {{-- Bar Charts --}}
                            <div class="p-6 space-y-5 bg-gradient-to-br from-gray-50 to-white dark:from-slate-900 dark:to-slate-800">
                                @foreach($result['stats'] as $index => $stat)
                                    <div class="group">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center gap-2">
                                                <span class="flex items-center justify-center w-7 h-7 rounded-full bg-[#673AB7] text-white text-sm font-bold">
                                                    {{ chr(65 + $index) }}
                                                </span>
                                                <span class="text-base font-semibold text-gray-800 dark:text-gray-200">
                                                    {{ $stat['option'] }}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $stat['count'] }} responden</span>
                                                <span class="text-xl font-bold text-[#673AB7]">{{ $stat['percentage'] }}%</span>
                                            </div>
                                        </div>
                                        <div class="relative w-full bg-gray-200 dark:bg-slate-700 rounded-full h-10 overflow-hidden shadow-inner">
                                            <div class="absolute inset-0 bg-gradient-to-r from-[#673AB7] to-[#8B5FBF] h-full rounded-full flex items-center px-4 transition-all duration-700 ease-out group-hover:brightness-110" 
                                                 style="width: {{ $stat['percentage'] }}%">
                                                @if($stat['percentage'] > 12)
                                                <span class="text-sm font-bold text-white drop-shadow-md">{{ $stat['percentage'] }}%</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Footer Stats --}}
                            <div class="bg-gradient-to-r from-blue-50 to-amber-50 dark:from-slate-800 dark:to-slate-700 px-6 py-4 border-t-2 border-gray-200 dark:border-slate-600">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 dark:text-gray-400 font-medium">Total Responden</span>
                                    <span class="text-[#1A305E] dark:text-[#D4AF37] font-bold text-base">{{ collect($result['stats'])->sum('count') }} orang</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
