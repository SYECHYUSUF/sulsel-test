<x-admin-layout title="Detail SOP - Admin PPID">
    <x-slot name="header">
        Detail SOP
    </x-slot>

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.data-sop.index') }}" class="text-slate-500 hover:text-[#1A305E] transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h3 class="text-lg font-bold text-[#1A305E]">{{ $sop->judul }}</h3>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Informasi Utama --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-100">
                <h4 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-4">Pratinjau Dokumen</h4>
                @php
                    $extension = pathinfo($sop->file, PATHINFO_EXTENSION);
                @endphp

                @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset('storage/' . $sop->file) }}" alt="{{ $sop->judul }}" class="w-full rounded-lg border border-slate-200">
                @elseif(strtolower($extension) === 'pdf')
                    <iframe src="{{ asset('storage/' . $sop->file) }}" class="w-full h-[600px] rounded-lg border border-slate-200"></iframe>
                @else
                    <div class="p-10 text-center bg-slate-50 rounded-lg border border-dashed border-slate-300">
                        <p class="text-slate-500">Format file tidak mendukung pratinjau langsung.</p>
                        <a href="{{ asset('storage/' . $sop->file) }}" class="mt-4 inline-block bg-[#1A305E] text-white px-4 py-2 rounded-lg" download>
                            Download untuk Melihat
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Sidebar Detail --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-100">
                <h4 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-4">Informasi Dokumen</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-slate-400">ID SKPD Pemilik</p>
                        <p class="text-sm font-medium text-[#1A305E]">{{ $sop->id_skpd ?? 'Tidak Diketahui' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Total Unduhan</p>
                        <p class="text-sm font-medium text-[#1A305E]">{{ $sop->jumlah_download ?? 0 }} kali</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Terakhir Diperbarui</p>
                        <p class="text-sm font-medium text-[#1A305E]">{{ $sop->updated_at ? $sop->updated_at->format('d M Y, H:i') : '-' }}</p>
                    </div>
                </div>
                
                <hr class="my-6 border-slate-100">
                
                <div class="flex flex-col gap-3">
                    <a href="{{ asset('storage/' . $sop->file) }}" target="_blank" class="w-full text-center bg-blue-50 text-blue-600 py-2 rounded-lg font-medium hover:bg-blue-100 transition">
                        Buka di Tab Baru
                    </a>
                    <a href="{{ route('admin.data-sop.edit', $sop->id) }}" class="w-full text-center bg-amber-50 text-amber-600 py-2 rounded-lg font-medium hover:bg-amber-100 transition">
                        Edit Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>