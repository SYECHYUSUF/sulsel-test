<!-- Modal Create Bentuk Informasi -->
<x-modal name="modal-bentuk-informasi-create" focusable>
    <form method="post" action="{{ route('admin.master-data.bentuk-informasi.store') }}" class="p-6">
        @csrf
        <h2 class="text-lg font-medium text-slate-900 dark:text-slate-100">
            {{ __('Tambah Bentuk Informasi') }}
        </h2>

        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
            {{ __('Tambahkan bentuk informasi baru ke dalam sistem.') }}
        </p>

        <div class="mt-6">
            <x-input-label for="create-judul" value="{{ __('Judul Bentuk Informasi') }}" class="sr-only" />
            <x-text-input id="create-judul" name="judul" type="text" class="mt-1 block w-full"
                placeholder="{{ __('Contoh: Softcopy (File PDF/Doc/dll)') }}" required />
            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Batal') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Simpan') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>

<!-- Modal Edit Bentuk Informasi -->
<x-modal name="modal-bentuk-informasi-edit" focusable>
    <form id="form-bentuk-informasi-edit" method="post" action="" class="p-6">
        @csrf
        @method('PUT')

        <input type="hidden" id="bentuk-informasi-id" name="id">

        <h2 id="bentuk-informasi-modal-title" class="text-lg font-medium text-slate-900 dark:text-slate-100">
            {{ __('Edit Bentuk Informasi') }}
        </h2>

        <div class="mt-6">
            <x-input-label for="edit-judul" value="{{ __('Judul Bentuk Informasi') }}" />
            <x-text-input id="bentuk-informasi-judul" name="judul" type="text" class="mt-1 block w-full"
                placeholder="{{ __('Judul Bentuk Informasi') }}" required />
            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Batal') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Simpan Perubahan') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>