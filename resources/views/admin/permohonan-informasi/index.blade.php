<x-admin-layout title="Manajemen Berita - Admin PPID">
    <x-slot name="header">
        Permohonan Informasi
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-lg font-bold text-[#1A305E]">Daftar Permohonan Informasi</h3>
        </div>

        <!-- Search/Filter -->
        <div class="p-4 bg-slate-50 border-b border-slate-100">
            <form action="{{ route('admin.permohonan-informasi.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="relative flex-1 max-w-md">
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul permohonan..."
                        class="pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm w-full focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300 transition-colors">
                    Filter
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-semibold uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Tujuan</th>
                        <th class="px-6 py-4">Diajukan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($permohonan as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="font-medium text-[#1A305E] line-clamp-2 max-w-xs">
                                        {{ $item->nama }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $item->email }}</td>
                            <td class="px-6 py-4">{{ $item->tujuan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($item->status == 1)
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Disetujui</span>
                                @else
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    
                                    <form action="{{ route('admin.permohonan-informasi.destroy', $item->id_permohonan) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus permohonan informasi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors"
                                            title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                                <p>Belum ada data permohonan informasi.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-slate-100">
            {{ $permohonan->withQueryString()->links() }}
        </div>
    </div>
</x-admin-layout>