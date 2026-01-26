<x-admin-layout title="Struktur Organisasi - Admin PPID">
    <x-slot name="header">
        Struktur Organisasi
    </x-slot>

    <h3 class="text-lg font-bold text-[#1A305E] mb-4">Struktur Organisasi</h3>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h4 class="font-bold text-gray-800 mb-4">Upload Struktur Organisasi</h4>
        <form action="{{ route('admin.struktur-organisasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    File PDF
                </label>
                @if(isset($settings['struktur_organisasi_path']))
                    <div class="mb-2 flex items-center gap-2">
                        <span class="text-sm text-gray-600">File saat ini:</span>
                        <a href="{{ asset($settings['struktur_organisasi_path']) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline text-sm font-medium">
                            Lihat File
                        </a>
                    </div>
                @endif
                <input type="file" name="struktur_organisasi" accept=".pdf" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100
                    border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                <p class="text-xs text-gray-500 mt-1">Format yang diterima: PDF. Ukuran maks: 5MB.</p>
                @error('struktur_organisasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-start">
                <button type="submit" class="bg-[#1A305E] text-white px-4 py-2 rounded-md hover:bg-[#15264F] transition-colors font-medium text-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
