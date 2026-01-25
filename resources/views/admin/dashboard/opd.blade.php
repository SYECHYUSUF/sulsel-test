<x-admin-layout title="Dashboard Admin - PPID Sulsel">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Dashboard Overview</h1>
        <h3 class="text-sm font-medium text-slate-500">{{ auth()->user()->skpd->nm_skpd }}</h3>
    </div>

    <div class="grid mt-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:border-blue-300 transition-all">
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

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:border-amber-300 transition-all">
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

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:border-indigo-300 transition-all">
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
    </div>
</x-admin-layout>