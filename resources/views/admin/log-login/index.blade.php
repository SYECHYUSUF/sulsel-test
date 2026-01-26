<x-admin-layout title="Riwayat Login - PPID Sulsel">
    <div class="flex flex-col mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Riwayat Login User</h1>
        <p class="text-sm text-slate-500">Memantau aktivitas login seluruh pengguna sistem.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-700">User</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-700">Alamat IP</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-700">User Agent</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-700">Waktu Login</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-medium text-slate-800">{{ $log->user->name ?? 'Unknown' }}</span>
                                    <span class="text-xs text-slate-500">{{ $log->user->email ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                <span class="px-2 py-1 bg-slate-100 rounded text-xs font-mono">{{ $log->ip_address }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                <span class="truncate block max-w-xs" title="{{ $log->user_agent }}">
                                    {{ $log->user_agent }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $log->createdAt->format('d M Y, H:i') }} WITA
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400">
                                Belum ada riwayat login tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($logs->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>