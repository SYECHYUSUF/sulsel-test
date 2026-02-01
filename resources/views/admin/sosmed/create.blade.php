<x-admin-layout>
    <x-slot:title>Tambah Media Sosial</x-slot:title>

    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Tambah Media Sosial</h1>
            <a href="{{ route('admin.social-links.index') }}"
                class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        <div
            class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm overflow-hidden">
            <form action="{{ route('admin.social-links.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="sosmed"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300">Platform <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="sosmed" id="sosmed" value="{{ old('sosmed') }}" required
                            class="w-full px-4 py-2 border {{ $errors->has('sosmed') ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }} bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Contoh: Facebook, Instagram, TikTok">
                        @error('sosmed')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="judul" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Judul
                            Tampilan (Tooltip)</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                            class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Contoh: Ikuti kami di Facebook">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label for="link_sosmed"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tautan (URL) <span
                                class="text-red-500">*</span></label>
                        <input type="url" name="link_sosmed" id="link_sosmed" value="{{ old('link_sosmed') }}" required
                            class="w-full px-4 py-2 border {{ $errors->has('link_sosmed') ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }} bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="https://facebook.com/username">
                        @error('link_sosmed')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 md:col-span-2" x-data="{ selectedIcon: '{{ old('icon_sosmed') }}' }">
                        <label for="icon_sosmed"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300">Pilih Ikon <span
                                class="text-red-500">*</span></label>
                        <div class="flex gap-4 items-start">
                            <div class="flex-1">
                                <select name="icon_sosmed" id="icon_sosmed" required x-model="selectedIcon"
                                    class="w-full px-4 py-2 border {{ $errors->has('icon_sosmed') ? 'border-red-500' : 'border-slate-200 dark:border-slate-700' }} bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="" disabled selected>Pilih platform...</option>
                                    @foreach($predefinedIcons as $name => $path)
                                        <option value="{{ $path }}">{{ $name }}</option>
                                    @endforeach
                                    <option value="custom">Kustom (Masukkan SVG Path)</option>
                                </select>
                            </div>
                            <div class="w-12 h-12 flex items-center justify-center bg-slate-100 dark:bg-slate-700 rounded-xl text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-600"
                                x-show="selectedIcon && selectedIcon !== 'custom'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" x-html="selectedIcon"></svg>
                            </div>
                        </div>

                        <div class="mt-4" x-show="selectedIcon === 'custom'">
                            <label for="custom_icon"
                                class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">SVG Path
                                Kustom</label>
                            <textarea name="custom_icon" id="custom_icon" rows="2"
                                @input="if(selectedIcon === 'custom') $el.closest('.space-y-2').querySelector('select').value = $event.target.value"
                                class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 font-mono text-xs"
                                placeholder='Contoh: <path d="..." />'></textarea>
                        </div>

                        @error('icon_sosmed')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="urutan" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Urutan
                            Tampil</label>
                        <input type="number" name="urutan" id="urutan" value="{{ old('urutan') }}"
                            class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="1, 2, 3...">
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition-colors shadow-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>