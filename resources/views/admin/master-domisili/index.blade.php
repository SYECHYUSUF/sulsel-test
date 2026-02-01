<x-admin-layout>
    <x-slot:title>Master Data Domisili</x-slot:title>

    <div x-data="{
        showDeleteModal: false,
        deleteForm: null,
        deleteItemName: '',
        openDeleteModal(form, name) {
            this.deleteForm = form;
            this.deleteItemName = name;
            this.showDeleteModal = true;
        },
        confirmDelete() {
            if (this.deleteForm) {
                this.deleteForm.submit();
            }
        }
    }" class="space-y-6">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Master Data Domisili</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Kelola data domisili untuk formulir permohonan informasi</p>
            </div>
            <a href="{{ route('admin.master-domisili.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-colors shadow-sm gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Domisili
            </a>
        </div>

        {{-- Success Alert --}}
        @if(session('success'))
            <div class="bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-emerald-800 dark:text-emerald-200 text-sm font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- Table Card --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-semibold">
                        <tr>
                            <th class="px-6 py-4 w-20">No</th>
                            <th class="px-6 py-4">Nama Daerah</th>
                            <th class="px-6 py-4">Provinsi</th>
                            <th class="px-6 py-4 w-32">Status</th>
                            <th class="px-6 py-4 text-right w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($data as $index => $item)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-900 dark:text-slate-100">{{ $item->nama_daerah }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">{{ $item->provinsi }}</td>
                                <td class="px-6 py-4">
                                    @if($item->is_active)
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100 dark:bg-emerald-900/30 dark:text-emerald-400 dark:border-emerald-800">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200 dark:bg-slate-700 dark:text-slate-400 dark:border-slate-600">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.master-domisili.edit', $item->id) }}" 
                                           class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 dark:hover:text-indigo-400 rounded-lg transition-all"
                                           title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.master-domisili.destroy', $item->id) }}" method="POST" class="inline" 
                                              @submit.prevent="openDeleteModal($el, '{{ $item->nama_daerah }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/30 dark:hover:text-rose-400 rounded-lg transition-all"
                                                    title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                    Tidak ada data domisili.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer Info --}}
        @if($data->count() > 0)
            <div class="text-sm text-slate-500 dark:text-slate-400">
                Total: <span class="font-medium text-slate-900 dark:text-slate-100">{{ $data->count() }}</span> domisili
            </div>
        @endif

        {{-- Delete Confirmation Modal --}}
        <x-delete-confirmation>
            Apakah Anda yakin ingin menghapus domisili <span class="font-bold text-slate-800 dark:text-white" x-text="deleteItemName"></span>?
        </x-delete-confirmation>
    </div>
</x-admin-layout>
