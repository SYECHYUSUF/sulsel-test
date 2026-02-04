<!-- Modal for Create Tahun -->
<x-modal name="modal-tahun-create" maxWidth="md">
    <div class="p-6">
        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Tambah Tahun Informasi</h2>

        <form id="form-tahun-create" method="POST" action="{{ route('admin.master-data.tahun.store') }}">
            @csrf

            <div class="mb-6">
                <label for="create-waktu" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Tahun <span class="text-red-500">*</span>
                </label>
                <input type="text" id="create-waktu" name="waktu" required placeholder="Contoh: 2024"
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-ppid-primary dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" @click="$dispatch('close-modal', 'modal-tahun-create')"
                    class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-ppid-primary hover:bg-ppid-dark rounded-lg transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-modal>

<!-- Modal for Edit Tahun -->
<x-modal name="modal-tahun-edit" maxWidth="md">
    <div class="p-6">
        <h2 id="tahun-modal-title" class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Edit Tahun
            Informasi</h2>

        <form id="form-tahun-edit" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="tahun-id" name="id">

            <div class="mb-6">
                <label for="tahun-waktu" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Tahun <span class="text-red-500">*</span>
                </label>
                <input type="text" id="tahun-waktu" name="waktu" required placeholder="Contoh: 2024"
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-ppid-primary dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" @click="$dispatch('close-modal', 'modal-tahun-edit')"
                    class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-ppid-primary hover:bg-ppid-dark rounded-lg transition-colors">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-modal>
