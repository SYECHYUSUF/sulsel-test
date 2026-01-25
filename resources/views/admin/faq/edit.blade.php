<x-admin-layout title="Edit FAQ - Admin PPID">
    <x-slot name="extra_head"></x-slot>

    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.faq.index') }}" class="text-slate-500 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <span class="text-slate-300">/</span>
            <span>Edit FAQ</span>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden max-w-4xl mx-auto">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-[#1A305E]">Form Edit FAQ</h3>
        </div>

        <form action="{{ route('admin.faq.update', $faq->id_faq) }}" method="POST" class="p-6 pt-0 space-y-6">
            @csrf
            @method('PUT')

            <!-- Pertanyaan -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Pertanyaan</label>
                <input type="text" name="pertanyaan" value="{{ old('pertanyaan', $faq->pertanyaan) }}"
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                    placeholder="Masukkan pertanyaan" required>
                @error('pertanyaan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jawaban -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Jawaban</label>
                <textarea name="jawaban"
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                    rows="5" placeholder="Masukkan jawaban">{{ old('jawaban', $faq->jawaban) }}</textarea>
                @error('jawaban')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Status Active -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                    <select name="is_active"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                        <option value="1" {{ old('is_active', $faq->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $faq->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif
                        </option>
                    </select>
                    @error('is_active')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Urutan -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Urutan (Opsional)</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $faq->urutan) }}"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                        placeholder="Contoh: 1">
                    @error('urutan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.faq.index') }}"
                    class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-[#1A305E] text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>


</x-admin-layout>