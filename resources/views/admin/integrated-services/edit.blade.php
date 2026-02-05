<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ppid-primary leading-tight">
            {{ __('Edit Layanan Terpadu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.integrated-services.update', $integratedService) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul Layanan</label>
                            <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('title', $integratedService->title) }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Singkat</label>
                            <input type="text" name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('description', $integratedService->description) }}" required>
                            @error('description')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                         <div class="mb-4">
                            <label for="link" class="block text-gray-700 text-sm font-bold mb-2">Link Tujuan</label>
                            <input type="url" name="link" id="link" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('link', $integratedService->link) }}" placeholder="https://..." required>
                            @error('link')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="icon" class="block text-gray-700 text-sm font-bold mb-2">Icon (Gambar)</label>
                            @if ($integratedService->icon)
                                <div class="mb-2">
                                     <img src="{{ asset('storage/integrated_services/' . $integratedService->icon) }}" alt="Current Icon" class="w-16 h-16 object-contain rounded-lg border">
                                </div>
                            @endif
                            <input type="file" name="icon" id="icon" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="image/*">
                             <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar. Max: 2MB.</p>
                            @error('icon')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                         <div class="mb-4">
                            <label for="is_active" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                            <select name="is_active" id="is_active" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="1" {{ old('is_active', $integratedService->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $integratedService->is_active) === 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                             <a href="{{ route('admin.integrated-services.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2 focus:outline-none focus:shadow-outline">
                                Batal
                            </a>
                            <button type="submit" class="bg-ppid-primary hover:bg-ppid-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
