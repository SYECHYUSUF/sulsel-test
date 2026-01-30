<x-admin-layout title="Dashboard Admin - PPID Sulsel">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Dashboard Overview</h1>
        <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ auth()->user()->skpd->nm_skpd }}</h3>
    </div>

    <div class="grid mt-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 hover:border-blue-300 dark:hover:border-blue-500 transition-all">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-blue-600 dark:text-blue-400">
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
                    <span
                        class="text-xs font-medium py-1 px-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-full">Tetap</span>
                @endif
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Permohonan</p>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">
                    {{ number_format($stats['total_permohonan']) }}
                </h2>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 hover:border-red-300 dark:hover:border-red-500 transition-all">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-red-50 dark:bg-red-900/20 rounded-lg text-red-600 dark:text-red-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span
                    class="text-xs font-medium py-1 px-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-full">Tetap</span>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Keberatan</p>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">
                    {{ number_format($stats['total_keberatan']) }}
                </h2>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 hover:border-amber-300 dark:hover:border-amber-500 transition-all">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-amber-50 dark:bg-amber-900/20 rounded-lg text-amber-600 dark:text-amber-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Berita Baru</p>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">
                    {{ number_format($stats['total_berita']) }}
                </h2>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 hover:border-indigo-300 dark:hover:border-indigo-500 transition-all">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg text-indigo-600 dark:text-indigo-400">
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
    </div>

    <!-- Notifikasi & Feedback Admin -->
    <div class="mt-8">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Notifikasi & Feedback</h3>
                <p class="text-xs text-slate-500">Pesan terbaru dari sistem dan administrator PPID</p>
            </div>
            <a href="{{ route('admin.notifications.index') }}"
                class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline">
                Lihat Semua
            </a>
        </div>

        <div class="grid grid-cols-1 gap-4">
            @forelse($notifications as $notif)
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border {{ $notif->read_at ? 'border-slate-100 dark:border-slate-700' : 'border-blue-200 dark:border-blue-500/50 bg-blue-50/30 dark:bg-blue-900/10' }} p-4 transition-all hover:shadow-md group">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 mt-1">
                            @if($notif->type == 'success')
                                <div
                                    class="p-2 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-xl">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            @elseif($notif->type == 'error')
                                <div class="p-2 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-xl">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-xl">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100">{{ $notif->title }}
                                    </h4>
                                    <p class="text-[10px] text-slate-400 flex items-center gap-1 mt-0.5">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $notif->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    @if(!$notif->read_at)
                                        <button onclick="markAsRead('{{ $notif->id_notification }}')"
                                            class="p-1.5 text-slate-400 hover:text-blue-600 transition-colors"
                                            title="Tandai Dibaca">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    @endif
                                    <form action="{{ route('admin.notifications.destroy', $notif->id_notification) }}"
                                        method="POST" onsubmit="return confirm('Hapus notifikasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 text-slate-400 hover:text-red-600 transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">
                                {{ $notif->message }}
                            </p>
                            @if ($notif->url)
                                <a href="{{ $notif->url }}"
                                    onclick="event.preventDefault(); markAsRead('{{ $notif->id_notification }}', '{{ $notif->url }}')"
                                    class="inline-flex items-center gap-1.5 mt-3 text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline">
                                    Lihat Detail
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="py-12 text-center bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700">
                    <div class="flex flex-col items-center gap-2 text-slate-400">
                        <svg class="w-12 h-12 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                        <p class="text-sm italic">Belum ada notifikasi baru.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</x-admin-layout>