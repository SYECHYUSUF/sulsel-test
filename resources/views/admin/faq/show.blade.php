<x-admin-layout title="Detail FAQ - Admin PPID">
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
            <span>Detail FAQ</span>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden max-w-4xl mx-auto mb-6">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-[#1A305E]">Detail FAQ</h3>
            <div class="flex gap-2">
                <a href="{{ route('admin.faq.edit', $faq->id_faq) }}"
                    class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                    Edit
                </a>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <!-- Pertanyaan -->
            <div>
                <h4 class="text-sm font-medium text-slate-500 mb-1">Pertanyaan</h4>
                <div class="text-slate-900 font-medium text-lg">{{ $faq->pertanyaan }}</div>
            </div>

            <div class="border-t border-slate-100 my-4"></div>

            <!-- Jawaban -->
            <div>
                <h4 class="text-sm font-medium text-slate-500 mb-2">Jawaban</h4>
                <div
                    class="prose prose-sm max-w-none text-slate-700 bg-slate-50 p-4 rounded-lg border border-slate-100">
                    {!! $faq->jawaban !!}
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 pt-4">
                <!-- Status -->
                <div>
                    <h4 class="text-sm font-medium text-slate-500 mb-1">Status</h4>
                    <span
                        class="{{ $faq->is_active ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-slate-50 text-slate-700 border-slate-100' }} px-2.5 py-1 rounded-full text-xs font-medium border">
                        {{ $faq->is_active ? 'Aktif' : 'Non-Aktif' }}
                    </span>
                </div>

                <!-- Urutan -->
                <div>
                    <h4 class="text-sm font-medium text-slate-500 mb-1">Urutan</h4>
                    <div class="text-slate-900">{{ $faq->urutan ?? '-' }}</div>
                </div>
            </div>
        </div>

        <div class="bg-slate-50 p-6 border-t border-slate-100 text-right">
            <a href="{{ route('admin.faq.index') }}"
                class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-100 transition-colors">
                Kembali
            </a>
        </div>
    </div>
</x-admin-layout>