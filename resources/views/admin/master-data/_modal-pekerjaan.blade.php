<!-- Modal for Create Pekerjaan -->
<x-modal name="modal-pekerjaan-create" maxWidth="md">
    <div class="p-6">
        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Tambah Pekerjaan</h2>

        <form id="form-pekerjaan-create" method="POST" action="{{ route('admin.master-data.pekerjaan.store') }}">
            @csrf

            <div class="mb-4">
                <label for="create-nama_pekerjaan"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Nama Pekerjaan <span class="text-red-500">*</span>
                </label>
                <input type="text" id="create-nama_pekerjaan" name="nama_pekerjaan" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-ppid-primary dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" id="create-pekerjaan-is_active" name="is_active" value="1" checked
                        class="w-4 h-4 text-ppid-primary border-slate-300 rounded focus:ring-ppid-primary dark:border-slate-600 dark:bg-slate-700">
                    <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" @click="$dispatch('close-modal', 'modal-pekerjaan-create')"
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

<!-- Modal for Edit Pekerjaan -->
<x-modal name="modal-pekerjaan-edit" maxWidth="md">
    <div class="p-6">
        <h2 id="pekerjaan-modal-title" class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Edit
            Pekerjaan</h2>

        <form id="form-pekerjaan-edit" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="pekerjaan-id" name="id">

            <div class="mb-4">
                <label for="pekerjaan-nama_pekerjaan"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Nama Pekerjaan <span class="text-red-500">*</span>
                </label>
                <input type="text" id="pekerjaan-nama_pekerjaan" name="nama_pekerjaan" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-ppid-primary dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" id="pekerjaan-is_active" name="is_active" value="1"
                        class="w-4 h-4 text-ppid-primary border-slate-300 rounded focus:ring-ppid-primary dark:border-slate-600 dark:bg-slate-700">
                    <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" @click="$dispatch('close-modal', 'modal-pekerjaan-edit')"
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
