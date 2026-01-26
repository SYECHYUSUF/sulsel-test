<x-admin-layout title="Edit Informasi Daftar Publik - Admin PPID">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.matriks-dip.index') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span>Edit Informasi Daftar Publik</span>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden max-w-4xl mx-auto">
        <div class="p-6 border-b border-slate-100 dark:border-slate-700">
            <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Form Edit Data</h3>
        </div>

        <form action="{{ route('admin.matriks-dip.update', $item->id) }}" method="POST"
            class="p-6 pt-0 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ \App\Models\MatriksDip::columnLabels()['a'] }}</label>
                    <input type="text" name="a" value="{{ old('a', $item->a) }}"
                        class="w-full px-4 py-2 border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ \App\Models\MatriksDip::columnLabels()['b'] }}</label>
                    <input type="text" name="b" value="{{ old('b', $item->b) }}"
                        class="w-full px-4 py-2 border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ \App\Models\MatriksDip::columnLabels()['c'] }}</label>
                    <input type="text" name="c" value="{{ old('c', $item->c) }}"
                        class="w-full px-4 py-2 border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ \App\Models\MatriksDip::columnLabels()['d'] }}</label>
                    <input type="text" name="d" value="{{ old('d', $item->d) }}"
                        class="w-full px-4 py-2 border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ \App\Models\MatriksDip::columnLabels()['e'] }}</label>
                    <input type="text" name="e" value="{{ old('e', $item->e) }}"
                        class="w-full px-4 py-2 border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ \App\Models\MatriksDip::columnLabels()['f'] }}</label>
                    <input type="text" name="f" value="{{ old('f', $item->f) }}"
                        class="w-full px-4 py-2 border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ \App\Models\MatriksDip::columnLabels()['g'] }}</label>
                    <input type="text" name="g" value="{{ old('g', $item->g) }}"
                        class="w-full px-4 py-2 border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ \App\Models\MatriksDip::columnLabels()['h'] }}</label>
                    <input type="text" name="h" value="{{ old('h', $item->h) }}"
                        class="w-full px-4 py-2 border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-3">
                <a href="{{ route('admin.matriks-dip.index') }}"
                    class="px-4 py-2 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-200 rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-[#1A305E] dark:bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-ppid-dark dark:hover:bg-blue-700 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>