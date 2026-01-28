<x-admin-layout>
<div class="p-6">
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.survey-questions.index') }}" class="p-2 hover:bg-gray-100 dark:hover:bg-slate-700 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Pertanyaan Survey</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Perbarui pertanyaan survey yang ada</p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="max-w-3xl">
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-gray-200 dark:border-slate-700 overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.survey-questions.update', $surveyQuestion) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Urutan --}}
                    <div>
                        <label for="urutan" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            Nomor Urut <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="urutan" 
                            name="urutan" 
                            min="1"
                            value="{{ old('urutan', $surveyQuestion->urutan) }}" 
                            class="w-full px-4 py-3 text-base rounded-lg border-2 border-gray-300 dark:border-slate-600 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] outline-none transition-all bg-white dark:bg-slate-900 dark:text-white @error('urutan') border-red-500 @enderror"
                            placeholder="Contoh: 1"
                            required
                        />
                        @error('urutan')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tentukan urutan pertanyaan (1, 2, 3, dst.)</p>
                    </div>

                    {{-- Soal --}}
                    <div>
                        <label for="soal" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            Pertanyaan <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="soal" 
                            name="soal" 
                            rows="4"
                            class="w-full px-4 py-3 text-base rounded-lg border-2 border-gray-300 dark:border-slate-600 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] outline-none transition-all bg-white dark:bg-slate-900 dark:text-white resize-none @error('soal') border-red-500 @enderror"
                            placeholder="Tuliskan pertanyaan survey..."
                            required
                        >{{ old('soal', $surveyQuestion->soal) }}</textarea>
                        @error('soal')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tipe --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">
                            Tipe Jawaban <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative flex items-center gap-3 p-4 rounded-lg border-2 border-gray-300 dark:border-slate-600 cursor-pointer hover:border-[#1A305E] hover:bg-blue-50 dark:hover:bg-slate-700 transition-all group @error('tipe') border-red-500 @enderror">
                                <input type="radio" name="tipe" value="radio" {{ old('tipe', $surveyQuestion->tipe) == 'radio' ? 'checked' : '' }} class="w-5 h-5 text-[#1A305E] focus:ring-2 focus:ring-[#1A305E]" required />
                                <div>
                                    <span class="block text-base font-medium text-gray-700 dark:text-gray-300 group-hover:text-[#1A305E] dark:group-hover:text-white">Radio Button</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">Pilihan ganda (A, B, C, D)</span>
                                </div>
                            </label>
                            <label class="relative flex items-center gap-3 p-4 rounded-lg border-2 border-gray-300 dark:border-slate-600 cursor-pointer hover:border-[#1A305E] hover:bg-blue-50 dark:hover:bg-slate-700 transition-all group @error('tipe') border-red-500 @enderror">
                                <input type="radio" name="tipe" value="textarea" {{ old('tipe', $surveyQuestion->tipe) == 'textarea' ? 'checked' : '' }} class="w-5 h-5 text-[#1A305E] focus:ring-2 focus:ring-[#1A305E]" />
                                <div>
                                    <span class="block text-base font-medium text-gray-700 dark:text-gray-300 group-hover:text-[#1A305E] dark:group-hover:text-white">Text Area</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">Jawaban panjang/essay</span>
                                </div>
                            </label>
                        </div>
                        @error('tipe')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-slate-700">
                        <a href="{{ route('admin.survey-questions.index') }}" class="px-6 py-3 text-gray-700 dark:text-gray-300 font-semibold hover:text-gray-900 dark:hover:text-white transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#1A305E] to-[#2A4A7E] text-white font-bold rounded-lg hover:from-[#2A4A7E] hover:to-[#1A305E] transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Update Pertanyaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-admin-layout>
