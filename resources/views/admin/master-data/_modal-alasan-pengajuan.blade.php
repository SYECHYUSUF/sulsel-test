<!-- Modal for Create Alasan Pengajuan -->
<x-modal name="modal-alasan-create" maxWidth="md">
    <div class="p-6">
        <h2 id="alasan-modal-title" class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-4">
            Tambah Alasan Pengajuan
        </h2>

        <form id="form-alasan-create" method="POST" action="{{ route('admin.master-data.alasan-pengajuan.store') }}">
            @csrf

            <div class="mb-4">
                <label for="alasan-alasan-create"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Alasan <span class="text-red-500">*</span>
                </label>
                <textarea id="alasan-alasan-create" name="alasan" rows="3" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-[#1A305E] dark:focus:ring-blue-500 focus:border-transparent dark:bg-slate-700 dark:text-slate-100"
                    placeholder="Masukkan alasan pengajuan keberatan"></textarea>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" @click="$dispatch('close-modal', 'modal-alasan-create')"
                    class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-[#1A305E] rounded-lg hover:bg-ppid-dark transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-modal>

<!-- Modal for Edit Alasan Pengajuan -->
<x-modal name="modal-alasan-edit" maxWidth="md">
    <div class="p-6">
        <h2 id="alasan-modal-title" class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-4">
            Edit Alasan Pengajuan
        </h2>

        <form id="form-alasan-edit" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="alasan-id" name="id">

            <div class="mb-4">
                <label for="alasan-alasan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Alasan <span class="text-red-500">*</span>
                </label>
                <textarea id="alasan-alasan" name="alasan" rows="3" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-[#1A305E] dark:focus:ring-blue-500 focus:border-transparent dark:bg-slate-700 dark:text-slate-100"
                    placeholder="Masukkan alasan pengajuan keberatan"></textarea>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" @click="$dispatch('close-modal', 'modal-alasan-edit')"
                    class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-[#1A305E] rounded-lg hover:bg-ppid-dark transition-colors">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-modal>
