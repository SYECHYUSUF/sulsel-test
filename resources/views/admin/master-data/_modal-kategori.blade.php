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
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-[#1A305E] dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-4">
                <label for="create-icon" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Icon (max 10 karakter) <span class="text-red-500">*</span>
                </label>
                <input type="text" id="create-icon" name="icon" maxlength="10" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-[#1A305E] dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" id="create-is_active" name="is_active" value="1" checked
                        class="w-4 h-4 text-[#1A305E] border-slate-300 rounded focus:ring-[#1A305E] dark:border-slate-600 dark:bg-slate-700">
                    <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" @click="$dispatch('close-modal', 'modal-kategori-create')"
                    class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-[#1A305E] hover:bg-ppid-dark rounded-lg transition-colors">
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
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-[#1A305E] dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-4">
                <label for="kategori-icon" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Icon (max 10 karakter) <span class="text-red-500">*</span>
                </label>
                <input type="text" id="kategori-icon" name="icon" maxlength="10" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-[#1A305E] dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" id="kategori-is_active" name="is_active" value="1"
                        class="w-4 h-4 text-[#1A305E] border-slate-300 rounded focus:ring-[#1A305E] dark:border-slate-600 dark:bg-slate-700">
                    <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" @click="$dispatch('close-modal', 'modal-kategori-edit')"
                    class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-[#1A305E] hover:bg-ppid-dark rounded-lg transition-colors">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-modal>

<script>
    // Helper function to get active tab
    function getActiveTab() {
        const alpineData = Alpine.$data(document.querySelector('#master-data-root'));
        return alpineData ? alpineData.activeTab : 'kategori';
    }

    // Handle Create Form Submission
    document.getElementById('form-kategori-create').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = {
            nm_kat_info: formData.get('nm_kat_info'),
            icon: formData.get('icon'),
            is_active: formData.get('is_active') ? 1 : 0
        };

        fetch('{{ route('admin.master-data.kategori.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "/admin/master-data?tab=" + (new URLSearchParams(window.location.search).get("tab") || "kategori");
                }
            })
            .catch(error => console.error('Error:', error));
    });

    // Handle Edit Form Submission
    document.getElementById('form-kategori-edit').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const id = document.getElementById('kategori-id').value;
        const data = {
            nm_kat_info: formData.get('nm_kat_info'),
            icon: formData.get('icon'),
            is_active: formData.get('is_active') ? 1 : 0
        };

        fetch(`/admin/master-data/kategori/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "/admin/master-data?tab=" + (new URLSearchParams(window.location.search).get("tab") || "kategori");
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>