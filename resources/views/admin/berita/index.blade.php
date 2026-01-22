<x-admin-layout title="Manajemen Berita - Admin PPID">
    <x-slot name="header">
        Manajemen Berita
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-lg font-bold text-[#1A305E]">Daftar Berita</h3>
            <a href="{{ route('admin.berita.create') }}"
                class="px-4 py-2 bg-[#1A305E] text-white rounded-lg text-sm font-medium hover:bg-[#122143] transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Berita
            </a>
        </div>

        <!-- Search/Filter -->
        <div class="p-4 bg-slate-50 border-b border-slate-100">
            <form action="{{ route('admin.berita.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="relative flex-1 max-w-md">
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul berita..."
                        class="pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm w-full focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>
                <select name="verify"
                    class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                    <option value="">Semua Status</option>
                    <option value="y" {{ request('verify') == 'y' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="n" {{ request('verify') == 'n' ? 'selected' : '' }}>Belum Verifikasi</option>
                    <option value="t" {{ request('verify') == 't' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <select name="id_skpd"
                    class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                    <option value="">Semua SKPD</option>
                    @foreach($skpdList as $skpd)
                        <option value="{{ $skpd->id_skpd }}" {{ request('id_skpd') == $skpd->id_skpd ? 'selected' : '' }}>
                            {{ $skpd->nm_skpd }}
                        </option>
                    @endforeach
                </select>
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
                        <th class="px-6 py-4">Judul Berita</th>
                        <th class="px-6 py-4">SKPD</th>
                        <th class="px-6 py-4">Tanggal Upload</th>
                        <th class="px-6 py-4">Viewers</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($berita as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded bg-slate-200 shrink-0 overflow-hidden mr-3">
                                        @if($item->img_berita)
                                            <img src="{{ asset('storage/img_berita/' . $item->img_berita) }}"
                                                class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="font-medium text-[#1A305E] line-clamp-2 max-w-xs">
                                        {{ $item->judul }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $item->id_skpd }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->tgl_upload)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">{{ $item->viewers }}</td>
                            <td class="px-6 py-4">
                                @if($item->verify == 'y')
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Verified</span>
                                @elseif($item->verify == 't')
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Rejected</span>
                                @else
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.berita.edit', $item->id_berita) }}"
                                        class="text-slate-400 hover:text-blue-600 transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $item->id_berita) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
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
                                <p>Belum ada data berita.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-slate-100">
            {{ $berita->withQueryString()->links() }}
        </div>
    </div>
</x-admin-layout>