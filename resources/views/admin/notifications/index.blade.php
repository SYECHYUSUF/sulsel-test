<x-admin-layout title="Semua Notifikasi - Admin PPID">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.dashboard') }}" class="text-slate-500 hover:text-slate-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <span class="text-slate-300">/</span>
            <span>Semua Notifikasi</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6 pb-10">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Notifikasi</h1>
                <p class="text-sm text-slate-500">Kelola semua pemberitahuan sistem Anda</p>
            </div>
            <div class="flex items-center gap-3">
                <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 text-sm font-bold text-blue-600 bg-blue-50 dark:bg-blue-900/20 rounded-xl hover:bg-blue-100 transition-colors">
                        Tandai Semua Dibaca
                    </button>
                </form>
                <form action="{{ route('admin.notifications.delete-all') }}" method="POST"
                    onsubmit="return confirm('Hapus semua notifikasi?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 text-sm font-bold text-red-600 bg-red-50 dark:bg-red-900/20 rounded-xl hover:bg-red-100 transition-colors">
                        Hapus Semua
                    </button>
                </form>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($notifications as $notif)
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border {{ $notif->read_at ? 'border-slate-100 dark:border-slate-700' : 'border-blue-200 dark:border-blue-500/50 bg-blue-50/30 dark:bg-blue-900/10' }} p-5 transition-all hover:shadow-md group">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 mt-1">
                            <div
                                class="p-2.5 {{ $notif->read_at ? 'bg-slate-100 text-slate-400' : 'bg-blue-100 text-blue-600' }} rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h4 class="text-base font-bold text-slate-800 dark:text-slate-100">{{ $notif->title }}
                                    </h4>
                                    <p class="text-xs text-slate-400 mt-1">{{ $notif->created_at->format('d F Y, H:i') }}
                                        ({{ $notif->created_at->diffForHumans() }})</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.notifications.destroy', $notif->id_notification) }}"
                                        method="POST" onsubmit="return confirm('Hapus notifikasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-slate-400 hover:text-red-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                                {{ $notif->message }}
                            </p>
                            @if ($notif->url)
                                <a href="{{ $notif->url }}"
                                    onclick="event.preventDefault(); markAsRead('{{ $notif->id_notification }}', '{{ $notif->url }}')"
                                    class="inline-flex items-center gap-1.5 mt-4 text-sm font-bold text-blue-600 dark:text-blue-400 hover:underline">
                                    Lihat Detail
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    class="py-20 text-center bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700">
                    <div class="flex flex-col items-center gap-4 text-slate-400">
                        <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-full">
                            <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium italic">Kotak notifikasi kosong.</p>
                    </div>
                </div>
            @endforelse

            <div class="mt-8">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>

</x-admin-layout>