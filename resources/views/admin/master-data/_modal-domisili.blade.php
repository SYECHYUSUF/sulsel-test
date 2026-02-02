<!-- Modal for Create Domisili -->
<x-modal name="modal-domisili-create" maxWidth="md">
    <div class="p-6">
        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Tambah Domisili</h2>

        <form id="form-domisili-create" method="POST" action="{{ route('admin.master-data.domisili.store') }}">
            @csrf

            <div class="mb-4">
                <label for="create-nama_daerah"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Nama Daerah <span class="text-red-500">*</span>
                </label>
                <input type="text" id="create-nama_daerah" name="nama_daerah" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-[#1A305E] dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-4">
                <label for="create-provinsi" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Provinsi <span class="text-red-500">*</span>
                </label>
                <input type="text" id="create-provinsi" name="provinsi" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-[#1A305E] dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" id="create-domisili-is_active" name="is_active" value="1" checked
                        class="w-4 h-4 text-[#1A305E] border-slate-300 rounded focus:ring-[#1A305E] dark:border-slate-600 dark:bg-slate-700">
                    <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" @click="$dispatch('close-modal', 'modal-domisili-create')"
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

<!-- Modal for Edit Domisili -->
<x-modal name="modal-domisili-edit" maxWidth="md">
    <div class="p-6">
        <h2 id="domisili-modal-title" class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-4">Edit
            Domisili</h2>

        <form id="form-domisili-edit" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="domisili-id" name="id">

            <div class="mb-4">
                <label for="domisili-nama_daerah"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Nama Daerah <span class="text-red-500">*</span>
                </label>
                <input type="text" id="domisili-nama_daerah" name="nama_daerah" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-[#1A305E] dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-4">
                <label for="domisili-provinsi"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Provinsi <span class="text-red-500">*</span>
                </label>
                <input type="text" id="domisili-provinsi" name="provinsi" required
                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-[#1A305E] dark:focus:ring-blue-400 focus:border-transparent dark:bg-slate-700 dark:text-slate-100">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" id="domisili-is_active" name="is_active" value="1"
                        class="w-4 h-4 text-[#1A305E] border-slate-300 rounded focus:ring-[#1A305E] dark:border-slate-600 dark:bg-slate-700">
                    <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" @click="$dispatch('close-modal', 'modal-domisili-edit')"
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
    // Handle Create Form Submission
    document.getElementById('form-domisili-create').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = {
            nama_daerah: formData.get('nama_daerah'),
            provinsi: formData.get('provinsi'),
            is_active: formData.get('is_active') ? 1 : 0
        };

        fetch('{{ route('admin.master-data.domisili.store') }}', {
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
    document.getElementById('form-domisili-edit').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const id = document.getElementById('domisili-id').value;
        const data = {
            nama_daerah: formData.get('nama_daerah'),
            provinsi: formData.get('provinsi'),
            is_active: formData.get('is_active') ? 1 : 0
        };

        fetch(`/admin/master-data/domisili/${id}`, {
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