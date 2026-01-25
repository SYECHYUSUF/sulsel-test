@php
    $user = Auth::user();
@endphp
<x-admin-layout title="Informasi Publik - Admin PPID">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Daftar Informasi Publik') }}
            </h2>
            <a href="{{ route('admin.informasi-publik.create') }}"
                class="px-4 py-2 bg-[#1A305E] text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Informasi
            </a>
        </div>
    </x-slot>

    <div x-data="{
        selectedIds: [],
        showFilters: false,
        bulkAction: '',
        bulkStatus: '',
        selectAll: false,
        toggleAll() {
            this.selectAll = !this.selectAll;
            if (this.selectAll) {
                this.selectedIds = Array.from(document.querySelectorAll('input[name=\u0022item_ids[]\u0022]')).map(el => el.value);
            } else {
                this.selectedIds = [];
            }
        },
        confirmBulkAction() {
            if (this.selectedIds.length === 0) {
                alert('Pilih minimal 1 item');
                return false;
            }
            if (this.bulkAction === 'delete') {
                return confirm(`Hapus ${this.selectedIds.length} dokumen yang dipilih?`);
            } else if (this.bulkAction === 'update_status') {
                if (!this.bulkStatus) {
                    alert('Pilih status terlebih dahulu');
                    return false;
                }
                return confirm(`Ubah status ${this.selectedIds.length} dokumen yang dipilih?`);
            }
            return true;
        }
    }" class="space-y-4">
        
        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                <p class="text-red-700">{{ session('error') }}</p>
            </div>
        @endif

        {{-- Filters and Actions Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            {{-- Quick Filters --}}
            <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex flex-col lg:flex-row gap-4 justify-between">
                <div class="flex flex-col md:flex-row gap-3 w-full lg:w-auto flex-1">
                    {{-- Search --}}
                    <div class="relative w-full md:w-64">
                        <form action="{{ route('admin.informasi-publik.index') }}" method="GET">
                            @foreach(request()->except('search') as $key => $value)
                                @if(!is_array($value))
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                                placeholder="Cari judul informasi...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </form>
                    </div>

                    {{-- Category Filter --}}
                    <form action="{{ route('admin.informasi-publik.index') }}" method="GET" class="w-full md:w-48">
                        @foreach(request()->except('id_kat_info') as $key => $value)
                            @if(!is_array($value))
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <select name="id_kat_info" onchange="this.form.submit()"
                            class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent text-slate-600">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriList as $kategori)
                                <option value="{{ $kategori->id_kat_info }}" {{ request('id_kat_info') == $kategori->id_kat_info ? 'selected' : '' }}>
                                    {{ $kategori->nm_kat_info }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    {{-- Advanced Filter Toggle --}}
                    <button @click="showFilters = !showFilters" type="button"
                        class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter Lanjut
                    </button>
                </div>

                {{-- Bulk Actions --}}
                <div class="flex gap-2" x-show="selectedIds.length > 0" x-cloak>
                    <form method="POST" action="{{ route('admin.informasi-publik.bulk-delete') }}" @submit="return confirmBulkAction()">
                        @csrf
                        <template x-for="id in selectedIds">
                            <input type="hidden" name="ids[]" :value="id">
                        </template>
                        <input type="hidden" x-model="bulkAction" x-init="bulkAction = 'delete'">
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus (<span x-text="selectedIds.length"></span>)
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.informasi-publik.bulk-update-status') }}" @submit="return confirmBulkAction()">
                        @csrf
                        <template x-for="id in selectedIds">
                            <input type="hidden" name="ids[]" :value="id">
                        </template>
                        <input type="hidden" x-model="bulkAction" x-init="bulkAction = 'update_status'">
                        <input type="hidden" name="verify" x-model="bulkStatus">
                        <select x-model="bulkStatus"
                            class="px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent">
                            <option value="">-- Ubah Status --</option>
                            <option value="y">Terverifikasi</option>
                            <option value="n">Pending</option>
                            <option value="t">Ditolak</option>
                        </select>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                           Terapkan
                        </button>
                    </form>
                </div>
            </div>

            {{-- Advanced Filters Panel --}}
            <div x-show="showFilters" x-cloak x-transition class="p-4 border-b border-slate-100 bg-blue-50/30">
                <form action="{{ route('admin.informasi-publik.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Preserve search --}}
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    @if(request('id_kat_info'))
                        <input type="hidden" name="id_kat_info" value="{{ request('id_kat_info') }}">
                    @endif

                    {{-- SKPD Filter (Admin only) --}}
                    @if(!$user->hasRole('opd'))
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">SKPD</label>
                            <select name="id_skpd"
                                class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent">
                                <option value="">Semua SKPD</option>
                                @foreach($skpdList as $skpd)
                                    <option value="{{ $skpd->id_skpd }}" {{ request('id_skpd') == $skpd->id_skpd ? 'selected' : '' }}>
                                        {{ $skpd->nm_skpd }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    {{-- Status Filter --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Status Verifikasi</label>
                        <select name="verify"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent">
                            <option value="">Semua Status</option>
                            <option value="y" {{ request('verify') == 'y' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="n" {{ request('verify') == 'n' ? 'selected' : '' }}>Pending</option>
                            <option value="t" {{ request('verify') == 't' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    {{-- Date Range --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Tanggal Akhir</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent">
                    </div>

                    {{-- Sort --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Urutkan</label>
                        <select name="sort"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Judul A-Z</option>
                            <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Judul Z-A</option>
                        </select>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-end gap-2">
                        <button type="submit"
                            class="px-4 py-2 bg-[#1A305E] text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors flex-1">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('admin.informasi-publik.index') }}"
                            class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-200 transition-colors">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            {{-- Active Filters Display --}}
            @if(request()->hasAny(['search', 'id_kat_info', 'id_skpd', 'verify', 'start_date', 'end_date', 'sort']))
                <div class="px-4 py-2 bg-slate-50 flex items-center gap-2 flex-wrap text-sm">
                    <span class="text-slate-600 font-medium">Filter aktif:</span>
                    @if(request('search'))
                        <span class="px-2 py-1 bg-white border border-slate-200 rounded-full text-xs">
                            Pencarian: "{{ request('search') }}"
                        </span>
                    @endif
                    @if(request('verify'))
                        <span class="px-2 py-1 bg-white border border-slate-200 rounded-full text-xs">
                            Status: {{ request('verify') == 'y' ? 'Terverifikasi' : (request('verify') == 'n' ? 'Pending' : 'Ditolak') }}
                        </span>
                    @endif
                    @if(request('start_date') || request('end_date'))
                        <span class="px-2 py-1 bg-white border border-slate-200 rounded-full text-xs">
                            Periode: {{ request('start_date') ?? '...' }} s/d {{ request('end_date') ?? '...' }}
                        </span>
                    @endif
                </div>
            @endif

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-12">
                                <input type="checkbox" @change="toggleAll()" :checked="selectAll"
                                    class="rounded border-slate-300 text-[#1A305E] focus:ring-ppid-accent">
                            </th>
                            <th scope="col" class="px-6 py-3">Judul Informasi</th>
                            <th scope="col" class="px-6 py-3">Kategori</th>
                            <th scope="col" class="px-6 py-3">SKPD</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">File</th>
                            <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($informasi as $info)
                            <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <input type="checkbox" name="item_ids[]" value="{{ $info->id_informasi }}"
                                        x-model="selectedIds"
                                        class="rounded border-slate-300 text-[#1A305E] focus:ring-ppid-accent">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-900">{{ $info->judul }}</div>
                                    <div class="text-xs text-slate-500 mt-1">Uploaded: {{ $info->tgl_upload }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $info->kategori->nm_kat_info ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs">{{ $info->skpd->nm_skpd ?? $info->id_skpd }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($info->verify == 'y')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Terverifikasi
                                        </span>
                                    @elseif($info->verify == 'n')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($info->file)
                                        <a href="{{ Storage::url($info->file) }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-800 hover:underline flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            Download
                                        </a>
                                    @else
                                        <span class="text-slate-400 text-xs italic">No File</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.informasi-publik.edit', $info->id_informasi) }}"
                                            class="p-2 text-slate-500 hover:text-[#1A305E] hover:bg-slate-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.informasi-publik.destroy', $info->id_informasi) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <p>Belum ada data informasi publik</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $informasi->withQueryString()->links() }}
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-admin-layout>