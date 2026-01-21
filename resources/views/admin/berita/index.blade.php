<x-admin-layout title="Manajemen Berita - Admin PPID">
    <x-slot name="header">
        Manajemen Berita
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-lg font-bold text-[#1A305E]">Daftar Berita</h3>
            <a href="{{ route('admin.berita.create') }}" class="px-4 py-2 bg-[#1A305E] text-white rounded-lg text-sm font-medium hover:bg-[#122143] transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Berita
            </a>
        </div>
        
        <!-- Search/Filter -->
        <div class="p-4 bg-slate-50 border-b border-slate-100 flex flex-col sm:flex-row gap-4">
            <div class="relative flex-1 max-w-md">
                <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Cari judul berita..." class="pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm w-full focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37]">
            </div>
            <select class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37]">
                <option value="">Semua Status</option>
                <option value="y">Terverifikasi</option>
                <option value="n">Belum Verifikasi</option>
                <option value="t">Ditolak</option>
            </select>
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
                    <!-- Placeholder Rows -->
                    @forelse($berita ?? [] as $item)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded bg-slate-200 flex-shrink-0 overflow-hidden mr-3">
                                    @if($item->img_berita)
                                    <img src="{{ asset('storage/'.$item->img_berita) }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="font-medium text-[#1A305E] line-clamp-2 max-w-xs">
                                    {{ $item->judul }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $item->id_skpd }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tgl_upload)->format('d M Y') }}</td>
                        <td class="px-6 py-4">{{ $item->viewers }}</td>
                        <td class="px-6 py-4">
                            @if($item->verify == 'y')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Verified</span>
                            @elseif($item->verify == 't')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Rejected</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.berita.edit', 1) }}" class="text-slate-400 hover:text-blue-600 transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <button class="text-slate-400 hover:text-red-600 transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
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
        <div class="p-6 border-t border-slate-100 flex justify-end">
            <!-- Pagination Placeholder -->
            <div class="flex space-x-1">
                <button class="px-3 py-1 border border-slate-200 rounded text-slate-500 hover:bg-slate-50 disabled:opacity-50">&laquo;</button>
                <button class="px-3 py-1 bg-[#1A305E] text-white rounded">1</button>
                <button class="px-3 py-1 border border-slate-200 rounded text-slate-500 hover:bg-slate-50">2</button>
                <button class="px-3 py-1 border border-slate-200 rounded text-slate-500 hover:bg-slate-50">&raquo;</button>
            </div>
        </div>
    </div>
</x-admin-layout>
