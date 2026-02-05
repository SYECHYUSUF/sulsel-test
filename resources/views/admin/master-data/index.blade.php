<x-admin-layout title="Master Data - Admin PPID">
    <div class="mb-4">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-100 leading-tight">
            {{ __('Master Data Management') }}
        </h2>
        <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Kelola semua data master dalam satu halaman</p>
    </div>

    <div id="master-data-root" x-data="{
        activeTab: '{{ request()->get("tab", "kategori") }}',
        showAllKategori: false,
        showAllTahun: false,
        showAllDomisili: false,
        showAllPekerjaan: false,
        showAllAlasanPengajuan: false,
        showAllBentukInformasi: false,
        limitedCount: 10,
        showDeleteKategori: false,
        showDeleteTahun: false,
        showDeleteDomisili: false,
        showDeletePekerjaan: false,
        showDeleteAlasan: false,
        showDeleteBentukInformasi: false,
        deleteId: null,
        deleteUrl: ''
    }">
        <!-- Tabs Navigation -->
        <div
            class="bg-white dark:bg-slate-800 rounded-t-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="flex border-b border-slate-200 dark:border-slate-700 overflow-x-auto">
                <button @click="activeTab = 'kategori'"
                    :class="activeTab === 'kategori' ? 'border-b-2 border-ppid-primary text-ppid-primary dark:border-blue-400 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200'"
                    class="px-6 py-3 font-medium text-sm whitespace-nowrap transition-colors">
                    Kategori Informasi
                </button>
                <button @click="activeTab = 'tahun'"
                    :class="activeTab === 'tahun' ? 'border-b-2 border-ppid-primary text-ppid-primary dark:border-blue-400 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200'"
                    class="px-6 py-3 font-medium text-sm whitespace-nowrap transition-colors">
                    Tahun Informasi
                </button>
                <button @click="activeTab = 'domisili'"
                    :class="activeTab === 'domisili' ? 'border-b-2 border-ppid-primary text-ppid-primary dark:border-blue-400 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200'"
                    class="px-6 py-3 font-medium text-sm whitespace-nowrap transition-colors">
                    Domisili
                </button>
                <button @click="activeTab = 'pekerjaan'"
                    :class="activeTab === 'pekerjaan' ? 'border-b-2 border-ppid-primary text-ppid-primary dark:border-blue-400 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200'"
                    class="px-6 py-3 font-medium text-sm whitespace-nowrap transition-colors">
                    Pekerjaan
                </button>
                <button @click="activeTab = 'alasan'"
                    :class="activeTab === 'alasan' ? 'border-b-2 border-ppid-primary text-ppid-primary dark:border-blue-400 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200'"
                    class="px-6 py-3 font-medium text-sm whitespace-nowrap transition-colors">
                    Alasan Pengajuan Keberatan
                </button>
                <button @click="activeTab = 'bentuk_informasi'"
                    :class="activeTab === 'bentuk_informasi' ? 'border-b-2 border-ppid-primary text-ppid-primary dark:border-blue-400 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200'"
                    class="px-6 py-3 font-medium text-sm whitespace-nowrap transition-colors">
                    Bentuk Informasi
                </button>
            </div>
        </div>

        <!-- Tab Content -->
        <div
            class="bg-white dark:bg-slate-800 rounded-b-xl shadow-sm border border-t-0 border-slate-100 dark:border-slate-700">

            <!-- Kategori Informasi Tab -->
            <div x-show="activeTab === 'kategori'" x-transition class="p-6">
                {{-- <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Kategori Informasi</h3>
                    <button @click="$dispatch('open-modal', 'modal-kategori-create')"
                        class="px-4 py-2 bg-ppid-primary text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Tambah Kategori
                    </button>
                </div> --}}

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <thead
                            class="text-xs text-slate-500 dark:text-slate-400 uppercase bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Kategori</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                {{-- <th scope="col" class="px-6 py-3 text-right">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody id="kategori-table-body">
                            @forelse ($kategoris as $index => $kategori)
                                <tr x-show="showAllKategori || {{ $index }} < limitedCount"
                                    class="bg-white dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">
                                        {{ $kategori->nm_kat_info }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($kategori->is_active)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">Aktif</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400">Tidak
                                                Aktif</span>
                                        @endif
                                    </td>
                                    {{-- <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                onclick="editKategori('{{ route('admin.master-data.kategori.update', $kategori->id_kat_info) }}', {{ $kategori->id_kat_info }}, '{{ $kategori->nm_kat_info }}', '{{ $kategori->icon }}', {{ $kategori->is_active ? 'true' : 'false' }})"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-ppid-primary dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button
                                                @click="deleteId = {{ $kategori->id_kat_info }}; deleteUrl = '{{ route('admin.master-data.kategori.destroy', $kategori->id_kat_info) }}'; showDeleteKategori = true"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                        <p>Belum ada data kategori informasi</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(count($kategoris) > 10)
                    <div class="mt-4 text-center">
                        <button @click="showAllKategori = !showAllKategori"
                            class="px-4 py-2 text-sm font-medium text-ppid-primary dark:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                            <span
                                x-text="showAllKategori ? 'Tampilkan Lebih Sedikit' : 'Tampilkan Seluruhnya ({{ count($kategoris) }} items)'"></span>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Tahun Informasi Tab -->
            <div x-show="activeTab === 'tahun'" x-transition class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Tahun Informasi</h3>
                    <button @click="$dispatch('open-modal', 'modal-tahun-create')"
                        class="px-4 py-2 bg-ppid-primary text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Tambah Tahun
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <thead
                            class="text-xs text-slate-500 dark:text-slate-400 uppercase bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">Tahun</th>
                                {{-- <th scope="col" class="px-6 py-3 text-right">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody id="tahun-table-body">
                            @forelse ($tahuns as $index => $tahun)
                                <tr x-show="showAllTahun || {{ $index }} < limitedCount"
                                    class="bg-white dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">{{ $tahun->waktu }}
                                    </td>
                                    {{-- <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button onclick="editTahun({{ $tahun->id }}, '{{ $tahun->waktu }}')"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-ppid-primary dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button
                                                @click="deleteId = {{ $tahun->id }}; deleteUrl = '{{ route('admin.master-data.tahun.destroy', $tahun->id) }}'; showDeleteTahun = true"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                        <p>Belum ada data tahun</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(count($tahuns) > 10)
                    <div class="mt-4 text-center">
                        <button @click="showAllTahun = !showAllTahun"
                            class="px-4 py-2 text-sm font-medium text-ppid-primary dark:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                            <span
                                x-text="showAllTahun ? 'Tampilkan Lebih Sedikit' : 'Tampilkan Seluruhnya ({{ count($tahuns) }} items)'"></span>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Domisili Tab -->
            <div x-show="activeTab === 'domisili'" x-transition class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Domisili</h3>
                    <button @click="$dispatch('open-modal', 'modal-domisili-create')"
                        class="px-4 py-2 bg-ppid-primary text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Tambah Domisili
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <thead
                            class="text-xs text-slate-500 dark:text-slate-400 uppercase bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Daerah</th>
                                <th scope="col" class="px-6 py-3">Provinsi</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="domisili-table-body">
                            @forelse ($domisilis as $index => $domisili)
                                <tr x-show="showAllDomisili || {{ $index }} < limitedCount"
                                    class="bg-white dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">
                                        {{ $domisili->nama_daerah }}
                                    </td>
                                    <td class="px-6 py-4">{{ $domisili->provinsi }}</td>
                                    <td class="px-6 py-4">
                                        @if($domisili->is_active)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">Aktif</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400">Tidak
                                                Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                onclick="editDomisili('{{ route('admin.master-data.domisili.update', $domisili->id) }}', {{ $domisili->id }}, '{{ addslashes($domisili->nama_daerah) }}', '{{ addslashes($domisili->provinsi) }}', {{ $domisili->is_active ? 'true' : 'false' }})"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-ppid-primary dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button
                                                @click="deleteId = {{ $domisili->id }}; deleteUrl = '{{ route('admin.master-data.domisili.destroy', $domisili->id) }}'; showDeleteDomisili = true"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                        <p>Belum ada data domisili</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(count($domisilis) > 10)
                    <div class="mt-4 text-center">
                        <button @click="showAllDomisili = !showAllDomisili"
                            class="px-4 py-2 text-sm font-medium text-ppid-primary dark:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                            <span
                                x-text="showAllDomisili ? 'Tampilkan Lebih Sedikit' : 'Tampilkan Seluruhnya ({{ count($domisilis) }} items)'"></span>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Pekerjaan Tab -->
            <div x-show="activeTab === 'pekerjaan'" x-transition class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Pekerjaan</h3>
                    <button @click="$dispatch('open-modal', 'modal-pekerjaan-create')"
                        class="px-4 py-2 bg-ppid-primary text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Tambah Pekerjaan
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <thead
                            class="text-xs text-slate-500 dark:text-slate-400 uppercase bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Pekerjaan</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="pekerjaan-table-body">
                            @forelse ($pekerjaans as $index => $pekerjaan)
                                <tr x-show="showAllPekerjaan || {{ $index }} < limitedCount"
                                    class="bg-white dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">
                                        {{ $pekerjaan->nama_pekerjaan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($pekerjaan->is_active)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">Aktif</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400">Tidak
                                                Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                onclick="editPekerjaan('{{ route('admin.master-data.pekerjaan.update', $pekerjaan->id) }}', {{ $pekerjaan->id }}, '{{ addslashes($pekerjaan->nama_pekerjaan) }}', {{ $pekerjaan->is_active ? 'true' : 'false' }})"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-ppid-primary dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button
                                                @click="deleteId = {{ $pekerjaan->id }}; deleteUrl = '{{ route('admin.master-data.pekerjaan.destroy', $pekerjaan->id) }}'; showDeletePekerjaan = true"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                        <p>Belum ada data pekerjaan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(count($pekerjaans) > 10)
                    <div class="mt-4 text-center">
                        <button @click="showAllPekerjaan = !showAllPekerjaan"
                            class="px-4 py-2 text-sm font-medium text-ppid-primary dark:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                            <span
                                x-text="showAllPekerjaan ? 'Tampilkan Lebih Sedikit' : 'Tampilkan Seluruhnya ({{ count($pekerjaans) }} items)'"></span>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Alasan Pengajuan Tab -->
            <div x-show="activeTab === 'alasan'" x-transition class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Alasan Pengajuan Keberatan</h3>
                    <button @click="$dispatch('open-modal', 'modal-alasan-create')"
                        class="px-4 py-2 bg-ppid-primary text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Tambah Alasan
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <thead
                            class="text-xs text-slate-500 dark:text-slate-400 uppercase bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">Alasan</th>
                                <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="alasan-table-body">
                            @forelse ($alasanPengajuans as $index => $alasan)
                                <tr x-show="showAllAlasanPengajuan || {{ $index }} < limitedCount"
                                    class="bg-white dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">
                                        {{ $alasan->alasan }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                onclick="editAlasanPengajuan('{{ route('admin.master-data.alasan-pengajuan.update', $alasan->id) }}', {{ $alasan->id }}, '{{ addslashes($alasan->alasan) }}')"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-ppid-primary dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button
                                                @click="deleteId = {{ $alasan->id }}; deleteUrl = '{{ route('admin.master-data.alasan-pengajuan.destroy', $alasan->id) }}'; showDeleteAlasan = true"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                        <p>Belum ada data alasan pengajuan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(count($alasanPengajuans) > 10)
                    <div class="mt-4 text-center">
                        <button @click="showAllAlasanPengajuan = !showAllAlasanPengajuan"
                            class="px-4 py-2 text-sm font-medium text-ppid-primary dark:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                            <span
                                x-text="showAllAlasanPengajuan ? 'Tampilkan Lebih Sedikit' : 'Tampilkan Seluruhnya ({{ count($alasanPengajuans) }} items)'"></span>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Bentuk Informasi Tab -->
            <div x-show="activeTab === 'bentuk_informasi'" x-transition class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Bentuk Informasi</h3>
                    <button @click="$dispatch('open-modal', 'modal-bentuk-informasi-create')"
                        class="px-4 py-2 bg-ppid-primary text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Tambah Bentuk
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                        <thead
                            class="text-xs text-slate-500 dark:text-slate-400 uppercase bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">Judul Bentuk Informasi</th>
                                <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="bentuk-informasi-table-body">
                            @forelse ($bentukInformasis as $index => $bentuk)
                                <tr x-show="showAllBentukInformasi || {{ $index }} < limitedCount"
                                    class="bg-white dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">
                                        {{ $bentuk->judul }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                onclick="editBentukInformasi('{{ route('admin.master-data.bentuk-informasi.update', $bentuk->id) }}', {{ $bentuk->id }}, '{{ addslashes($bentuk->judul) }}')"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-ppid-primary dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button
                                                @click="deleteId = {{ $bentuk->id }}; deleteUrl = '{{ route('admin.master-data.bentuk-informasi.destroy', $bentuk->id) }}'; showDeleteBentukInformasi = true"
                                                class="p-2 text-slate-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                        <p>Belum ada data bentuk informasi</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(count($bentukInformasis) > 10)
                    <div class="mt-4 text-center">
                        <button @click="showAllBentukInformasi = !showAllBentukInformasi"
                            class="px-4 py-2 text-sm font-medium text-ppid-primary dark:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition-colors">
                            <span
                                x-text="showAllBentukInformasi ? 'Tampilkan Lebih Sedikit' : 'Tampilkan Seluruhnya ({{ count($bentukInformasis) }} items)'"></span>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Confirmation Dialogs -->
        <!-- Delete Kategori Confirmation -->
        <x-confirmation-dialog trigger="showDeleteKategori" title="Hapus Kategori Informasi?"
            description="Data kategori akan dihapus permanen dan tidak dapat dikembalikan." theme="danger"
            confirmText="Ya, Hapus" cancelText="Batal" url="deleteUrl" dynamic="true" method="DELETE" />

        <!-- Delete Tahun Confirmation -->
        <x-confirmation-dialog trigger="showDeleteTahun" title="Hapus Tahun Informasi?"
            description="Data tahun akan dihapus permanen dan tidak dapat dikembalikan." theme="danger"
            confirmText="Ya, Hapus" cancelText="Batal" url="deleteUrl" dynamic="true" method="DELETE" />

        <!-- Delete Domisili Confirmation -->
        <x-confirmation-dialog trigger="showDeleteDomisili" title="Hapus Domisili?"
            description="Data domisili akan dihapus permanen dan tidak dapat dikembalikan." theme="danger"
            confirmText="Ya, Hapus" cancelText="Batal" url="deleteUrl" dynamic="true" method="DELETE" />

        <!-- Delete Pekerjaan Confirmation -->
        <x-confirmation-dialog trigger="showDeletePekerjaan" title="Hapus Pekerjaan?"
            description="Data pekerjaan akan dihapus permanen dan tidak dapat dikembalikan." theme="danger"
            confirmText="Ya, Hapus" cancelText="Batal" url="deleteUrl" dynamic="true" method="DELETE" />

        <!-- Delete Alasan Pengajuan Confirmation -->
        <x-confirmation-dialog trigger="showDeleteAlasan" title="Hapus Alasan Pengajuan?"
            description="Data alasan pengajuan akan dihapus permanen dan tidak dapat dikembalikan." theme="danger"
            confirmText="Ya, Hapus" cancelText="Batal" url="deleteUrl" dynamic="true" method="DELETE" />

        <!-- Delete Bentuk Informasi Confirmation -->
        <x-confirmation-dialog trigger="showDeleteBentukInformasi" title="Hapus Bentuk Informasi?"
            description="Data bentuk informasi akan dihapus permanen dan tidak dapat dikembalikan." theme="danger"
            confirmText="Ya, Hapus" cancelText="Batal" url="deleteUrl" dynamic="true" method="DELETE" />
    </div>

    <!-- Include Modal Components -->
    @include('admin.master-data._modal-kategori')
    @include('admin.master-data._modal-tahun')
    @include('admin.master-data._modal-domisili')
    @include('admin.master-data._modal-pekerjaan')
    @include('admin.master-data._modal-alasan-pengajuan')
    @include('admin.master-data._modal-bentuk-informasi')

    {{-- Notification Modal --}}
    @if (session('success'))
        <x-notification-modal show="true" theme="success" title="Berhasil!" description="{{ session('success') }}" />
    @endif

    @if (session('error'))
        <x-notification-modal show="true" theme="error" title="Gagal!" description="{{ session('error') }}" />
    @endif

    <!-- JavaScript for AJAX Operations -->
    <x-slot name="extra_script">
        <script>
            // CSRF Token
            // CSRF Token is handled by the form in x-confirmation-dialog

            // Kategori Functions
            function editKategori(url, id, name, icon, isActive) {
                document.getElementById('form-kategori-edit').action = url;
                document.getElementById('kategori-id').value = id;
                document.getElementById('kategori-nm_kat_info').value = name;
                document.getElementById('kategori-icon').value = icon;
                document.getElementById('kategori-is_active').checked = isActive;
                document.getElementById('kategori-modal-title').textContent = 'Edit Kategori Informasi';
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'modal-kategori-edit' }));
            }

            // Domisili Functions
            function editDomisili(url, id, nama_daerah, provinsi, isActive) {
                console.log('Editing Domisili:', { url, id, nama_daerah, provinsi, isActive });
                document.getElementById('form-domisili-edit').action = url;
                document.getElementById('domisili-id').value = id;
                document.getElementById('domisili-nama_daerah').value = nama_daerah;
                document.getElementById('domisili-provinsi').value = provinsi;
                document.getElementById('domisili-is_active').checked = isActive;
                document.getElementById('domisili-modal-title').textContent = 'Edit Domisili';
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'modal-domisili-edit' }));
            }

            // Pekerjaan Functions
            function editPekerjaan(url, id, nama_pekerjaan, isActive) {
                document.getElementById('form-pekerjaan-edit').action = url;
                document.getElementById('pekerjaan-id').value = id;
                document.getElementById('pekerjaan-nama_pekerjaan').value = nama_pekerjaan;
                document.getElementById('pekerjaan-is_active').checked = isActive;
                document.getElementById('pekerjaan-modal-title').textContent = 'Edit Pekerjaan';
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'modal-pekerjaan-edit' }));
            }

            // Alasan Pengajuan Functions
            function editAlasanPengajuan(url, id, alasan) {
                document.getElementById('form-alasan-edit').action = url;
                document.getElementById('alasan-id').value = id;
                document.getElementById('alasan-alasan').value = alasan;
                document.getElementById('alasan-modal-title').textContent = 'Edit Alasan Pengajuan';
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'modal-alasan-edit' }));
            }

            // Bentuk Informasi Functions
            function editBentukInformasi(url, id, judul) {
                document.getElementById('form-bentuk-informasi-edit').action = url;
                document.getElementById('bentuk-informasi-id').value = id;
                document.getElementById('bentuk-informasi-judul').value = judul;
                document.getElementById('bentuk-informasi-modal-title').textContent = 'Edit Bentuk Informasi';
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'modal-bentuk-informasi-edit' }));
            }
        </script>
    </x-slot>
</x-admin-layout>