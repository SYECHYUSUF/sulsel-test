<x-admin-layout title="Detail Informasi - Admin PPID">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.dokumen-publik.index') }}"
                class="text-slate-500 hover:text-slate-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <span class="text-slate-300">/</span>
            <span>Detail Informasi Publik</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6 pb-10">
        <!-- Main Content -->
        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Informasi Dokumen</h3>
                <div class="flex items-center gap-2">
                    @if($informasi->verify == 'y')
                        <span
                            class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-bold rounded-full border border-green-200 dark:border-green-800/50">Terverifikasi</span>
                    @elseif($informasi->verify == 'n')
                        <span
                            class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs font-bold rounded-full border border-amber-200 dark:border-amber-800/50">Menunggu
                            Verifikasi</span>
                    @else
                        <span
                            class="px-3 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-bold rounded-full border border-red-200 dark:border-red-800/50">Ditolak</span>
                    @endif
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Judul</label>
                            <p class="text-slate-800 dark:text-slate-200 font-medium">{{ $informasi->judul }}</p>
                        </div>
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Kategori</label>
                            <p class="text-slate-800 dark:text-slate-200 font-medium">
                                {{ $informasi->kategori->nm_kat_info ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">SKPD
                                Penginput</label>
                            <p class="text-slate-800 dark:text-slate-200 font-medium">
                                {{ $informasi->skpd->nm_skpd ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Tanggal
                                Upload</label>
                            <p class="text-slate-800 dark:text-slate-200 font-medium">
                                {{ $informasi->tgl_upload ? date('d F Y', strtotime($informasi->tgl_upload)) : '-' }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">File
                                Dokumen</label>
                            @if($informasi->file)
                                <div class="mt-2 group">
                                    <a href="{{ Storage::url($informasi->file) }}" target="_blank"
                                        class="inline-flex items-center gap-2 p-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-300 dark:hover:border-blue-500 transition-all">
                                        <div
                                            class="p-2 bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 rounded-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">Lihat Dokumen
                                            </p>
                                            <p class="text-[10px] text-slate-500">Klik untuk membuka file</p>
                                        </div>
                                    </a>
                                </div>
                            @else
                                <p class="text-slate-400 italic text-sm">Tidak ada file attach</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Keterangan /
                        Ringkasan</label>
                    <div
                        class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-slate-100 dark:border-slate-700">
                        <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
                            {!! nl2br(e($informasi->ket)) !!}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons for Admin -->
            @if(auth()->user()->hasRole('admin') && $informasi->verify == 'n')
                <div class="p-6 bg-slate-50 dark:bg-slate-900/30 border-t border-slate-100 dark:border-slate-700">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-center sm:text-left">
                            <h4 class="font-bold text-slate-800 dark:text-slate-100">Aksi Verifikasi</h4>
                            <p class="text-xs text-slate-500">Tentukan status verifikasi untuk dokumen ini.</p>
                        </div>
                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <form action="{{ route('admin.dokumen-publik.bulk-update-status') }}" method="POST"
                                class="w-full sm:w-auto">
                                @csrf
                                <input type="hidden" name="ids[]" value="{{ $informasi->id_informasi }}">
                                <input type="hidden" name="verify" value="t">
                                <button type="submit"
                                    class="w-full sm:w-auto px-6 py-2.5 bg-red-50 text-red-600 border border-red-200 rounded-xl text-sm font-bold hover:bg-red-100 transition-all flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Tolak Dokumen
                                </button>
                            </form>
                            <form action="{{ route('admin.dokumen-publik.bulk-update-status') }}" method="POST"
                                class="w-full sm:w-auto">
                                @csrf
                                <input type="hidden" name="ids[]" value="{{ $informasi->id_informasi }}">
                                <input type="hidden" name="verify" value="y">
                                <button type="submit"
                                    class="w-full sm:w-auto px-6 py-2.5 bg-[#1A305E] text-white rounded-xl text-sm font-bold hover:bg-ppid-dark shadow-lg shadow-blue-900/20 transition-all flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Verifikasi Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>