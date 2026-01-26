<x-admin-layout title="Detail Permohonan - Admin PPID">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.permohonan-informasi.index') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span>Detail Permohonan</span>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6"
        x-data="{ rejectionModalOpen: false, completionModalOpen: false }">
        <!-- Main Detail -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Applicant Info -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Data Pemohon</h3>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $permohonan->status_color }}">
                        {{ $permohonan->status_label }}
                    </span>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Nama Lengkap</label>
                        <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $permohonan->nama }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">NIK / No. Identitas</label>
                        <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $permohonan->nik }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Email</label>
                        <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $permohonan->email }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Nomor HP</label>
                        <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $permohonan->no_hp }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Pekerjaan</label>
                        <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $permohonan->pekerjaan }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Alamat</label>
                        <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $permohonan->alamat }}</p>
                    </div>
                </div>
            </div>

            <!-- Request Detail -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Rincian Permohonan</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Rincian Informasi yang
                            Dibutuhkan</label>
                        <p class="text-slate-900 dark:text-slate-100 mt-1">{{ $permohonan->rincian }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Tujuan Penggunaan
                            Informasi</label>
                        <p class="text-slate-900 dark:text-slate-100 mt-1">{{ $permohonan->tujuan }}</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Cara Memperoleh
                                Informasi</label>
                            <p class="text-slate-900 dark:text-slate-100 mt-1">{{ $permohonan->peroleh_informasi }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Format Salinan</label>
                            <p class="text-slate-900 dark:text-slate-100 mt-1">{{ $permohonan->salinan_informasi }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- File Attachments (KTP) -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Lampiran</h3>
                </div>
                <div class="p-6">
                    @if($permohonan->foto_ktp)
                        <div class="border border-slate-200 dark:border-slate-700 rounded-lg p-4 w-full md:w-1/2">
                            <p class="text-sm font-medium mb-2 text-slate-700 dark:text-slate-300">Foto KTP:</p>
                            <img src="{{ Storage::url($permohonan->foto_ktp) }}" alt="Foto KTP"
                                class="w-full h-auto rounded">
                        </div>
                    @else
                        <p class="text-slate-500 dark:text-slate-400 italic">Tidak ada lampiran KTP.</p>
                    @endif

                    @if($permohonan->file)
                        <div class="mt-4 border border-green-100 dark:border-green-900/30 rounded-lg p-4 bg-green-50 dark:bg-green-900/10">
                            <p class="text-sm font-medium text-green-800 dark:text-green-400 mb-2">File Jawaban / Hasil:</p>
                            <a href="{{ Storage::url($permohonan->file) }}" target="_blank"
                                class="text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Download File Hasil
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Action Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden sticky top-6">
                <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Tindakan</h3>
                </div>
                <div class="p-6 space-y-3">
                    <!-- Workflow Logic -->

                    {{-- Status: PENDING (0) --}}
                    @if($permohonan->status == 0)
                        @if(auth()->user()->hasRole('admin'))
                            <form action="{{ route('admin.permohonan-informasi.update', $permohonan->id_permohonan) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="1">
                                <button type="submit"
                                    class="w-full py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors shadow-sm">
                                    Verifikasi Permohonan
                                </button>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 text-center">Setuju & lanjutkan ke proses tindak lanjut.
                                </p>
                            </form>
                            <button @click="rejectionModalOpen = true"
                                class="w-full py-2.5 bg-white dark:bg-slate-700 border border-red-200 dark:border-red-900/50 text-red-600 dark:text-red-400 rounded-lg font-medium hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors mt-3">
                                Tolak Permohonan
                            </button>
                        @else
                            <div class="bg-slate-50 dark:bg-slate-700/50 p-3 rounded-lg text-center text-sm text-slate-500 dark:text-slate-400">
                                Menunggu verifikasi admin.
                            </div>
                        @endif

                        {{-- Status: PROSES (1) --}}
                    @elseif($permohonan->status == 1)
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800/50 p-4 rounded-lg mb-4">
                            <p class="text-sm text-blue-800 dark:text-blue-300">Permohonan ini sedang dalam proses tindak lanjut.</p>
                        </div>
                        <button @click="completionModalOpen = true"
                            class="w-full py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors shadow-sm">
                            Selesaikan Permohonan
                        </button>
                        <button @click="rejectionModalOpen = true"
                            class="w-full py-2.5 bg-white dark:bg-slate-700 border border-red-200 dark:border-red-900/50 text-red-600 dark:text-red-400 rounded-lg font-medium hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors mt-3">
                            Tolak Permohonan
                        </button>

                        {{-- Status: SELESAI (2) or TOLAK (3) --}}
                    @else
                        <div class="bg-slate-50 dark:bg-slate-700/50 p-4 rounded-lg text-center text-sm text-slate-500 dark:text-slate-400">
                            Status permohonan ini sudah final: <strong>{{ $permohonan->status_label }}</strong>.
                        </div>
                        @if($permohonan->status == 3 && $permohonan->alasan)
                            <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-900/50 rounded-lg">
                                <p class="text-xs font-bold text-red-800 dark:text-red-400 uppercase mb-1">Alasan Penolakan:</p>
                                <p class="text-sm text-red-700 dark:text-red-300">{{ $permohonan->alasan }}</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Rejection Modal -->
    <div x-show="rejectionModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="rejectionModalOpen" @click="rejectionModalOpen = false"
                class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="rejectionModalOpen"
                class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('admin.permohonan-informasi.update', $permohonan->id_permohonan) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="3"> {{-- 3 = TOLAK --}}

                    <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">Tolak Permohonan</h3>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Alasan Penolakan <span
                                    class="text-red-500">*</span></label>
                            <textarea name="alasan" rows="4"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                placeholder="Jelaskan alasan penolakan..." required></textarea>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Tolak
                        </button>
                        <button type="button" @click="rejectionModalOpen = false"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Completion Modal -->
    <div x-show="completionModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="completionModalOpen" @click="completionModalOpen = false"
                class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="completionModalOpen"
                class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('admin.permohonan-informasi.update', $permohonan->id_permohonan) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="2"> {{-- 2 = SELESAI --}}

                    <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">Selesaikan Permohonan</h3>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Upload File Jawaban
                                (Optional)</label>
                            <input type="file" name="file"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Format: PDF, DOC, JPG (Max: 10MB)</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Selesaikan
                        </button>
                        <button type="button" @click="completionModalOpen = false"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>