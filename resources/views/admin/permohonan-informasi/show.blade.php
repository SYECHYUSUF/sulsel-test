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

    <div x-data="{ 
        rejectionModalOpen: false,
        processModalOpen: false,
        activeTab: 'jawab',
        successModalOpen: @if(session('success')) true @else false @endif
    }">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Detail -->
        <div class="@role('admin') lg:col-span-2 @else lg:col-span-3 @endrole space-y-6">
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
                        <p class="text-slate-900 dark:text-slate-100 font-medium flex items-center gap-2">
                            {{ $permohonan->no_hp }}
                            @if($permohonan->no_hp)
                                @php
                                    $whatsappNumber = $permohonan->no_hp;
                                    if (Str::startsWith($whatsappNumber, '0')) {
                                        $whatsappNumber = '62' . substr($whatsappNumber, 1);
                                    }
                                    if (Str::startsWith($whatsappNumber, '+62')) {
                                        $whatsappNumber = substr($whatsappNumber, 1);
                                    }
                                @endphp
                                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded hover:bg-green-200 transition-colors" title="Hubungi via WhatsApp">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.23-8.24 8.23c-1.48 0-2.93-.39-4.19-1.15l-.3-.17l-3.12.82l.83-3.04l-.2-.32a8.188 8.188 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.25-8.24M8.53 7.33c-.16-.36-.33-.37-.48-.37c-.12 0-.26 0-.39 0c-.14 0-.36.05-.55.26c-.19.21-.73.71-.73 1.73c0 1.02.74 2.01.84 2.13c.11.13 2.91 4.45 7.06 6.24c2.73 1.18 3.28.94 3.86.88c.58-.06 1.86-.76 2.12-1.5c.26-.73.26-1.36.18-1.5c-.08-.13-.28-.21-.58-.37c-.3-.15-1.78-.88-2.05-1c-.28-.11-.48-.17-.67.13c-.2.3-.77.98-.95 1.18c-.17.19-.35.21-.64.07c-.3-.15-1.25-.46-2.38-1.47c-.88-.79-1.48-1.77-1.65-2.07c-.17-.3-.02-.46.13-.61c.13-.13.3-.34.45-.51c.15-.17.2-.3.3-.49c.1-.19.05-.36-.02-.5c-.08-.16-.68-1.64-.93-2.25"/></svg>
                                    WhatsApp
                                </a>
                            @endif
                        </p>
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
                        <div class="w-full md:w-1/2">
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

            {{-- SKPD Disposisi Tracking --}}
            @include('admin.permohonan-informasi.partials.tracking-card')
        </div>

        <!-- Sidebar Actions -->
        @role('admin')
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
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-100 dark:border-yellow-800/50 p-4 rounded-lg mb-4">
                            <p class="text-sm text-yellow-800 dark:text-yellow-300">Permohonan Menunggu Verifikasi.</p>
                        </div>
                        
                        <button @click="processModalOpen = true"
                            class="w-full py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors shadow-sm">
                            Proses Permohonan
                        </button>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 text-center">Jawab Langsung atau Disposisi ke OPD.</p>

                        <button @click="rejectionModalOpen = true"
                            class="w-full py-2.5 bg-white dark:bg-slate-700 border border-red-200 dark:border-red-900/50 text-red-600 dark:text-red-400 rounded-lg font-medium hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors mt-3">
                            Tolak Permohonan
                        </button>

                    {{-- Status: PROSES (1) - Admin Answered --}}
                    @elseif($permohonan->status == 1)
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800/50 p-4 rounded-lg mb-4">
                            <p class="text-sm text-blue-800 dark:text-blue-300">Permohonan Telah <strong>Dijawab</strong> oleh Admin.</p>
                        </div>
                        
                        @if($permohonan->jawaban)
                            <div class="mt-2 p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-100 dark:border-slate-600">
                                <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Jawaban Anda:</p>
                                <p class="text-sm text-slate-700 dark:text-slate-300">{{ $permohonan->jawaban }}</p>
                            </div>
                        @endif

                    {{-- Status: DISPOSISI (5) --}}
                    @elseif($permohonan->status == 5)
                        <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-100 dark:border-purple-800/50 p-4 rounded-lg mb-4">
                            <p class="text-sm text-purple-800 dark:text-purple-300">Permohonan <strong>Didisposisikan</strong>.</p>
                        </div>
                        
                        @if($permohonan->skpd)
                            <div class="mt-2 p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-100 dark:border-slate-600">
                                <p class="text-xs font-semibold text-slate-500 uppercase mb-1">SKPD Tujuan:</p>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $permohonan->skpd->nm_skpd }}</p>
                            </div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('admin.permohonan-informasi.disposisi', $permohonan->id_permohonan) }}"
                               class="w-full block text-center py-2.5 bg-white dark:bg-slate-700 border-2 border-purple-200 dark:border-purple-800 text-purple-700 dark:text-purple-300 rounded-lg font-medium hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-all">
                                + Tambah Disposisi Lain
                            </a>
                            <p class="text-xs text-slate-500 mt-2 text-center">Tambahkan OPD lain jika diperlukan.</p>
                        </div>

                    {{-- Status: SELESAI (2), TOLAK (3), BATAL (4) --}}
                    @else
                        <div class="bg-slate-50 dark:bg-slate-700/50 p-4 rounded-lg text-center text-sm text-slate-500 dark:text-slate-400">
                            Status Akhir: <strong>{{ $permohonan->status_label }}</strong>.
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

    <!-- Process Modal (Jawab/Disposisi) -->
    <div x-show="processModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="processModalOpen" @click="processModalOpen = false"
                class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="processModalOpen"
                class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                
                <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">Proses Permohonan</h3>
                    
                    <!-- Tabs -->
                    <div class="flex space-x-1 rounded-xl bg-slate-100 dark:bg-slate-700/50 p-1 mb-6">
                        <button @click="activeTab = 'jawab'" 
                            :class="activeTab === 'jawab' ? 'bg-white dark:bg-slate-600 shadow text-blue-700 dark:text-blue-300' : 'text-slate-600 dark:text-slate-400 hover:bg-white/[0.12] hover:text-white'"
                            class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 transition-all">
                            Jawab (Admin)
                        </button>
                        <button @click="activeTab = 'disposisi'" 
                            :class="activeTab === 'disposisi' ? 'bg-white dark:bg-slate-600 shadow text-blue-700 dark:text-blue-300' : 'text-slate-600 dark:text-slate-400 hover:bg-white/[0.12] hover:text-white'"
                            class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 transition-all">
                            Disposisi (OPD)
                        </button>
                    </div>

                    <!-- Jawab Form -->
                    <div x-show="activeTab === 'jawab'">
                        <form action="{{ route('admin.permohonan-informasi.update', $permohonan->id_permohonan) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="1"> {{-- 1 = PROSES / Admin Answered --}}
                            
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Jawaban Permohonan <span class="text-red-500">*</span></label>
                                <textarea name="jawaban" rows="5"
                                    class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    placeholder="Tuliskan jawaban untuk pemohon..." required></textarea>
                            </div>
                            
                            <div class="mt-5 sm:flex sm:flex-row-reverse">
                                <button type="submit"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Kirim Jawaban
                                </button>
                                <button type="button" @click="processModalOpen = false"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Disposisi Form -->
                    <div x-show="activeTab === 'disposisi'">
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-2">Pilih OPD Tujuan Disposisi</h4>
                            <p class="text-slate-600 dark:text-slate-400 mb-6 text-sm">Anda akan dialihkan ke halaman pemilihan OPD untuk disposisi</p>
                            
                            <div class="flex gap-3 justify-center">
                                <button type="button" @click="processModalOpen = false"
                                    class="px-4 py-2 rounded-md border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-600 font-medium text-sm">
                                    Batal
                                </button>
                                <a href="{{ route('admin.permohonan-informasi.disposisi', $permohonan->id_permohonan) }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-purple-600 text-white hover:bg-purple-700 font-medium text-sm shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                    Lanjut ke Halaman Disposisi
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endrole
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

    <!-- Success/Notification Modal -->
    <div x-show="successModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="successModalOpen" @click="successModalOpen = false" 
                class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm opacity-100"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="successModalOpen"
                class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full relative">
                
                <!-- Modal Content -->
                <div class="px-8 pt-10 pb-8 relative z-10 flex flex-col items-center text-center">
                    
                    <!-- Icon Wrapper with Blob Background -->
                    <div class="relative w-28 h-28 mb-6 flex items-center justify-center transform hover:scale-105 transition-transform duration-300">
                        <!-- Blob SVG -->
                        <svg viewBox="0 0 200 200" class="absolute inset-0 w-full h-full drop-shadow-2xl" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="blobGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#1A305E;stop-opacity:1" /> <!-- Primary Dark Blue -->
                                    <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:1" /> <!-- Blue 500 -->
                                </linearGradient>
                            </defs>
                            <path fill="url(#blobGradient)" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,70.8,34.1C59.4,45.1,47.9,53.4,36.1,60.8C24.3,68.2,12.2,74.7,-1.2,76.8C-14.6,78.9,-29.2,76.6,-42.6,69.9C-56,63.2,-68.2,52.1,-76.6,38.6C-85,25.1,-89.6,9.2,-86.6,-5.3C-83.6,-19.8,-73,-32.9,-62,-44.6C-51,-56.3,-39.6,-66.6,-26.8,-74.7C-14,-82.8,0.2,-88.7,14.6,-88.7C29,-88.7,46.1,-82.8,58.7,-73.4L44.7,-76.4Z" transform="translate(100 100) scale(1.1)" />
                        </svg>
                        
                        <!-- Check Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white relative z-10 filter drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <!-- Title -->
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white mb-3 tracking-tight">Yey, Berhasil!</h3>
                    
                    <!-- Message -->
                    <p class="text-slate-500 dark:text-slate-400 text-base font-medium leading-relaxed mb-1">
                        {{ session('success') ?? 'Aksi yang kamu lakukan berjalan mulus.' }}
                    </p>
                    <p class="text-slate-400 dark:text-slate-500 text-sm mb-10">
                        Semuanya aman terkendali.
                    </p>

                    <!-- Buttons -->
                    <div class="flex gap-4 w-full">
                        <button @click="successModalOpen = false"
                            class="flex-1 px-5 py-3.5 rounded-2xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-sm tracking-wide hover:bg-slate-300 dark:hover:bg-slate-600 transition-all active:scale-95">
                            Tutup
                        </button>
                        <button @click="successModalOpen = false"
                            class="flex-1 px-5 py-3.5 rounded-2xl text-white font-bold text-sm tracking-wide shadow-xl shadow-blue-500/30 transition-all transform hover:scale-105 active:scale-95 bg-gradient-to-r from-[#1A305E] to-blue-600 hover:to-blue-500">
                            Mantap!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>
</x-admin-layout>