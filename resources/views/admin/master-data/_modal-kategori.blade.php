<!-- Modal for Create Kategori -->
<x-modal name="modal-kategori-create" maxWidth="md">
    <div class="p-6">
        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Tambah Kategori Informasi</h2>

        <form id="form-kategori-create" method="POST" action="{{ route('admin.master-data.kategori.store') }}">
            @csrf

            <div class="mb-4">
                <label for="create-nm_kat_info"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" id="create-nm_kat_info" name="nm_kat_info" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-ppid-primary dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-4">
                <label for="create-icon" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Icon (max 10 karakter) <span class="text-red-500">*</span>
                </label>
                <input type="text" id="create-icon" name="icon" maxlength="10" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-ppid-primary dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" id="create-is_active" name="is_active" value="1" checked
                        class="w-4 h-4 text-ppid-primary border-slate-300 rounded focus:ring-ppid-primary dark:border-slate-600 dark:bg-slate-700">
                    <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" @click="$dispatch('close-modal', 'modal-kategori-create')"
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

<!-- Modal for Edit Kategori -->
<x-modal name="modal-kategori-edit" maxWidth="md">
    <div class="p-6">
        <h2 id="kategori-modal-title" class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Edit
            Kategori Informasi</h2>

        <form id="form-kategori-edit" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="kategori-id" name="id">

            <div class="mb-4">
                <label for="kategori-nm_kat_info"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" id="kategori-nm_kat_info" name="nm_kat_info" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-ppid-primary dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-4">
                <label for="kategori-icon" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Icon (max 10 karakter) <span class="text-red-500">*</span>
                </label>
                <input type="text" id="kategori-icon" name="icon" maxlength="10" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-ppid-primary dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" id="kategori-is_active" name="is_active" value="1"
                        class="w-4 h-4 text-ppid-primary border-slate-300 rounded focus:ring-ppid-primary dark:border-slate-600 dark:bg-slate-700">
                    <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" @click="$dispatch('close-modal', 'modal-kategori-edit')"
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
