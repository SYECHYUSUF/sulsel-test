<x-admin-layout title="Dashboard Admin - PPID Sulsel">
    <div class="flex flex-col mb-4">
        <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Dashboard Overview</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">
            Selamat datang kembali, {{ auth()->user()->name }}.
        </p>
    </div>

    <div class="space-y-6 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
                class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 hover:border-blue-300 dark:hover:border-blue-500 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    @if($stats['permohonan_trend'] > 0)
                        <span
                            class="text-xs font-medium py-1 px-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full">+{{ $stats['permohonan_trend'] }}%</span>
                    @elseif($stats['permohonan_trend'] < 0)
                        <span
                            class="text-xs font-medium py-1 px-2 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-full">{{ $stats['permohonan_trend'] }}%</span>
                    @else
                        <span class="text-xs font-medium py-1 px-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-full">Tetap</span>
                    @endif
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Permohonan</p>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ number_format($stats['total_permohonan']) }}</h2>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 hover:border-red-300 dark:hover:border-red-500 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-red-50 dark:bg-red-900/30 rounded-lg text-red-600 dark:text-red-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium py-1 px-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-full">Tetap</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Keberatan</p>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ number_format($stats['total_keberatan']) }}</h2>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 hover:border-amber-300 dark:hover:border-amber-500 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-amber-50 dark:bg-amber-900/30 rounded-lg text-amber-600 dark:text-amber-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Berita Baru</p>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ number_format($stats['total_berita']) }}</h2>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 hover:border-emerald-300 dark:hover:border-emerald-500 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg text-emerald-600 dark:text-emerald-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">SKPD</p>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ number_format($stats['total_skpd']) }}</h2>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 hover:border-indigo-300 dark:hover:border-indigo-500 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg text-indigo-600 dark:text-indigo-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Dokumen</p>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">
                        {{ $stats['total_dokumen'] >= 1000 ? number_format($stats['total_dokumen'] / 1000, 1) . 'k' : number_format($stats['total_dokumen']) }}
                    </h2>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 hover:border-purple-300 dark:hover:border-purple-500 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-purple-50 dark:bg-purple-900/30 rounded-lg text-purple-600 dark:text-purple-400">
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
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Visitor</p>
                    
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">
                        {{ $stats['total_visitor'] >= 1000 
                            ? number_format($stats['total_visitor'] / 1000, 1) . 'k' 
                            : number_format($stats['total_visitor']) 
                        }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12 lg:col-span-8 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                    <div>
                        <h3 class="text-slate-800 dark:text-slate-100 font-bold text-lg">Statistik Layanan</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Perbandingan permohonan & keberatan 2024</p>
                    </div>
                    <div class="flex items-center space-x-4 bg-slate-50 dark:bg-slate-700/50 p-2 rounded-lg">
                        <div class="flex items-center text-xs font-semibold text-slate-600 dark:text-slate-300">
                            <span class="w-3 h-3 rounded-full bg-[#1A305E] mr-2"></span> Permohonan
                        </div>
                        <div class="flex items-center text-xs font-semibold text-slate-600 dark:text-slate-300">
                            <span class="w-3 h-3 rounded-full bg-[#D4AF37] mr-2"></span> Keberatan
                        </div>
                    </div>
                </div>

                <div class="relative h-72 flex items-end justify-between px-2 gap-4">
                    <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                        <div class="border-b border-slate-100 dark:border-slate-700 w-full h-full"></div>
                        <div class="border-b border-slate-100 dark:border-slate-700 w-full h-full"></div>
                        <div class="border-b border-slate-100 dark:border-slate-700 w-full h-full"></div>
                        <div class="border-b border-slate-100 dark:border-slate-700 w-full h-full"></div>
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
                            <span class="text-[11px] font-medium text-slate-500 dark:text-slate-400 absolute bottom-0">{{ $month }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-slate-800 dark:text-slate-100 font-bold text-lg">Login Terbaru</h3>
                    <a href="{{ route('admin.log-login.index') }}" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">Lihat Semua</a>
                </div>

                <div class="space-y-4 flex-1">
                    @forelse($recentLogins as $log)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700 transition-hover hover:border-blue-200 dark:hover:border-blue-500/50">
                            <div class="flex-shrink-0">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($log->user->name ?? 'U') }}&background=1A305E&color=fff" 
                                    alt="Avatar" class="w-10 h-10 rounded-full shadow-sm">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-800 dark:text-slate-100 truncate">
                                    {{ $log->user->name ?? 'Unknown User' }}
                                </p>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-[10px] font-mono text-slate-500 dark:text-slate-400 bg-slate-200 dark:bg-slate-700 px-1.5 py-0.5 rounded">
                                        {{ $log->ip_address }}
                                    </span>
                                    <span class="text-[10px] text-slate-400 dark:text-slate-500">
                                        {{ $log->created_at?->diffForHumans() ?? 'Baru saja' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <p class="text-sm text-slate-400 italic">Belum ada riwayat login.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-700">
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-100 dark:border-blue-800">
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-white dark:bg-blue-900/40 rounded-lg text-blue-600 dark:text-blue-400 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="text-xs font-bold text-blue-900 dark:text-blue-100 uppercase tracking-wider">Security Tip</h5>
                                <p class="text-[11px] text-blue-700 dark:text-blue-300 mt-1 leading-relaxed">
                                    Pastikan untuk selalu memantau alamat IP yang tidak dikenal untuk menjaga keamanan akun admin.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>