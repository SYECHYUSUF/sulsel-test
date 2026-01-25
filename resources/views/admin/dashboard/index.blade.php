<x-admin-layout title="Dashboard Admin - PPID Sulsel">
    <div class="flex flex-col mb-4">
        <h1 class="text-2xl font-bold text-slate-800">Dashboard Overview</h1>
        <p class="text-sm text-slate-500">
            Selamat datang kembali, {{ auth()->user()->name }}.
            Unit Kerja: {{ auth()->user()->skpd->nm_skpd ?? 'Tidak Terikat SKPD' }}
        </p>
    </div>

    <div class="space-y-6 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:border-blue-300 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    @if($stats['permohonan_trend'] > 0)
                        <span
                            class="text-xs font-medium py-1 px-2 bg-green-100 text-green-700 rounded-full">+{{ $stats['permohonan_trend'] }}%</span>
                    @elseif($stats['permohonan_trend'] < 0)
                        <span
                            class="text-xs font-medium py-1 px-2 bg-red-100 text-red-700 rounded-full">{{ $stats['permohonan_trend'] }}%</span>
                    @else
                        <span class="text-xs font-medium py-1 px-2 bg-slate-100 text-slate-600 rounded-full">Tetap</span>
                    @endif
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Permohonan</p>
                    <h2 class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_permohonan']) }}</h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:border-red-300 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-red-50 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium py-1 px-2 bg-slate-100 text-slate-600 rounded-full">Tetap</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Keberatan</p>
                    <h2 class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_keberatan']) }}</h2>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:border-amber-300 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Berita Baru</p>
                    <h2 class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_berita']) }}</h2>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:border-emerald-300 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">SKPD</p>
                    <h2 class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_skpd']) }}</h2>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:border-indigo-300 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Dokumen</p>
                    <h2 class="text-2xl font-bold text-slate-800">
                        {{ $stats['total_dokumen'] >= 1000 ? number_format($stats['total_dokumen'] / 1000, 1) . 'k' : number_format($stats['total_dokumen']) }}
                    </h2>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:border-purple-300 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Visitor</p>
                    <h2 class="text-2xl font-bold text-slate-800">
                        {{ $stats['total_visitor'] >= 1000 ? number_format($stats['total_visitor'] / 1000, 1) . 'k' : number_format($stats['total_visitor']) }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12 lg:col-span-8 bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                    <div>
                        <h3 class="text-slate-800 font-bold text-lg">Statistik Layanan</h3>
                        <p class="text-xs text-slate-500">Perbandingan permohonan & keberatan 2024</p>
                    </div>
                    <div class="flex items-center space-x-4 bg-slate-50 p-2 rounded-lg">
                        <div class="flex items-center text-xs font-semibold text-slate-600">
                            <span class="w-3 h-3 rounded-full bg-[#1A305E] mr-2"></span> Permohonan
                        </div>
                        <div class="flex items-center text-xs font-semibold text-slate-600">
                            <span class="w-3 h-3 rounded-full bg-[#D4AF37] mr-2"></span> Keberatan
                        </div>
                    </div>
                </div>

                <div class="relative h-72 flex items-end justify-between px-2 gap-4">
                    <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                        <div class="border-b border-slate-100 w-full h-full"></div>
                        <div class="border-b border-slate-100 w-full h-full"></div>
                        <div class="border-b border-slate-100 w-full h-full"></div>
                        <div class="border-b border-slate-100 w-full h-full"></div>
                    </div>

                    @foreach($monthlyTrends['months'] as $month)
                        <div class="flex flex-col items-center justify-end h-full w-full group relative z-10">
                            <div class="flex items-end justify-center w-full gap-1.5 h-full pb-8">
                                <div class="w-3 bg-[#1A305E] rounded-t-sm transition-all duration-300 group-hover:brightness-125"
                                    style="height: {{ $monthlyTrends['permohonan_percentages'][$month] }}%"
                                    title="Permohonan: {{ $monthlyTrends['permohonan'][$month] }}"></div>
                                <div class="w-3 bg-[#D4AF37] rounded-t-sm transition-all duration-300 group-hover:brightness-110"
                                    style="height: {{ $monthlyTrends['keberatan_percentages'][$month] }}%"
                                    title="Keberatan: {{ $monthlyTrends['keberatan'][$month] }}"></div>
                            </div>
                            <span class="text-[11px] font-medium text-slate-500 absolute bottom-0">{{ $month }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div
                class="col-span-12 lg:col-span-4 bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 font-bold text-lg">Piket Hari Ini</h3>
                        <span
                            class="text-[10px] uppercase tracking-wider font-bold bg-amber-100 text-amber-700 px-2 py-1 rounded">Shift
                            Pagi</span>
                    </div>

                    <div class="flex flex-col items-center text-center py-4">
                        <div class="relative mb-4">
                            <div
                                class="absolute -inset-1 bg-gradient-to-tr from-[#D4AF37] to-[#1A305E] rounded-full opacity-25">
                            </div>
                            <img src="https://ui-avatars.com/api/?name=Andi+M&background=1A305E&color=fff" alt="Officer"
                                class="relative w-24 h-24 rounded-full border-4 border-white shadow-sm object-cover">
                        </div>

                        <h4 class="text-lg font-bold text-slate-800">Andi Mulawarman</h4>
                        <p class="text-sm text-slate-500 mb-6">Staf Layanan Informasi</p>

                        <div
                            class="inline-flex items-center text-xs font-bold text-slate-600 bg-slate-100 px-4 py-2 rounded-full border border-slate-200">
                            <svg class="w-4 h-4 mr-2 text-[#1A305E]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            08:00 — 16:00 WITA
                        </div>
                    </div>
                </div>

                <div class="flex gap-2 mt-6">
                    <button
                        class="flex-1 py-2 px-4 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-600 text-sm font-semibold transition-colors border border-slate-200">
                        Kemarin
                    </button>
                    <button
                        class="flex-1 py-2 px-4 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold transition-colors shadow-sm">
                        Besok
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>