<x-admin-layout title="Tambah Informasi Daftar Publik - Admin PPID">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.informasi-daftar-publik.index') }}" class="text-slate-500 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <span class="text-slate-300">/</span>
            <span>Tambah Informasi Daftar Publik</span>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden max-w-4xl mx-auto">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-[#1A305E]">Form Tambah Data</h3>
        </div>

        <form action="{{ route('admin.informasi-daftar-publik.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Column A -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Column A</label>
                    <input type="text" name="a" value="{{ old('a') }}"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <!-- Column B -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Column B</label>
                    <input type="text" name="b" value="{{ old('b') }}"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <!-- Column C -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Column C</label>
                    <input type="text" name="c" value="{{ old('c') }}"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <!-- Column D -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Column D</label>
                    <input type="text" name="d" value="{{ old('d') }}"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <!-- Column E -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Column E</label>
                    <input type="text" name="e" value="{{ old('e') }}"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <!-- Column F -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Column F</label>
                    <input type="text" name="f" value="{{ old('f') }}"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <!-- Column G -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Column G</label>
                    <input type="text" name="g" value="{{ old('g') }}"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>

                <!-- Column H -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Column H</label>
                    <input type="text" name="h" value="{{ old('h') }}"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.informasi-daftar-publik.index') }}"
                    class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-[#1A305E] text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>