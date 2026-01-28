<x-admin-layout>
    <x-slot:title>Hasil Survey</x-slot:title>

<div class="p-8">
    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 dark:text-white mb-2">Hasil Survey</h1>
                <p class="text-slate-600 dark:text-slate-400">Kelola dan lihat hasil survey kepuasan masyarakat</p>
            </div>
        </div>

        {{-- Search & Filter --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 mb-6">
            <form action="{{ route('admin.survey-responses.index') }}" method="GET" class="flex gap-4">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search }}" 
                        placeholder="Cari berdasarkan nama, email, atau lembaga..." 
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] outline-none transition-all bg-white dark:bg-slate-700 dark:text-white"
                    />
                </div>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#1A305E] to-[#2A4A7E] text-white font-semibold rounded-xl hover:from-[#2A4A7E] hover:to-[#1A305E] transition-all shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
                @if($search)
                    <a href="{{ route('admin.survey-responses.index') }}" class="px-6 py-2.5 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold rounded-xl hover:bg-slate-300 dark:hover:bg-slate-600 transition-all">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-[#1A305E] to-[#2A4A7E] text-white">
                            <th class="px-6 py-4 text-left text-sm font-semibold">Kode Survey</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Lembaga</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal Pengisian</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($responses as $response)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-mono text-slate-900 dark:text-white">{{ $response->kode }}</td>
                                <td class="px-6 py-4 text-sm text-slate-900 dark:text-white">{{ $response->nama }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $response->email }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $response->lembaga }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $response->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.survey-responses.show', $response->kode) }}" 
                                       class="inline-flex items-center gap-1 px-4 py-2 bg-[#1A305E] text-white rounded-lg hover:bg-[#2A4A7E] transition-colors text-sm font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-lg font-semibold">Tidak ada data survey</p>
                                    <p class="text-sm mt-1">Belum ada responden yang mengisi survey</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($responses->hasPages())
                <div class="border-t border-slate-200 dark:border-slate-700 px-6 py-4">
                    {{ $responses->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

</x-admin-layout>
