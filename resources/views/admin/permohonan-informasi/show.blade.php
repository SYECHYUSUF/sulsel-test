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
                            <button type="button"
                                @click="processModalOpen = true; activeTab = 'disposisi'"
                                class="w-full flex items-center justify-center gap-2 py-3 bg-purple-600 hover:bg-purple-700 active:bg-purple-800 text-white rounded-lg font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Disposisi Lain
                            </button>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 text-center">Klik untuk menambahkan OPD lain yang perlu menerima disposisi.</p>
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
                        @if($permohonan->status != 5)
                            <button @click="activeTab = 'jawab'" 
                                :class="activeTab === 'jawab' ? 'bg-white dark:bg-slate-600 shadow text-blue-700 dark:text-blue-300' : 'text-slate-600 dark:text-slate-400 hover:bg-white/[0.12] hover:text-white'"
                                class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2 transition-all">
                                Jawab (Admin)
                            </button>
                        @endif
                        <button @click="activeTab = 'disposisi'" 
                            :class="activeTab === 'disposisi' ? 'bg-white dark:bg-slate-600 shadow text-purple-700 dark:text-purple-300' : 'text-slate-600 dark:text-slate-400 hover:bg-white/[0.12] hover:text-white'"
                            class="w-full rounded-lg py-2.5 text-sm font-medium leading-5 ring-white ring-opacity-60 ring-offset-2 ring-offset-purple-400 focus:outline-none focus:ring-2 transition-all">
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
                        <form action="{{ route('admin.permohonan-informasi.disposisi', $permohonan->id_permohonan) }}" method="POST"
                            x-data="{ 
                                selectedSkpds: [], 
                                showHelp: false,
                                searchQuery: '',
                                toggleSkpd(id) {
                                    if (this.selectedSkpds.includes(id)) {
                                        this.selectedSkpds = this.selectedSkpds.filter(s => s !== id);
                                    } else {
                                        this.selectedSkpds.push(id);
                                    }
                                }
                            }">
                            @csrf
                            
                            <!-- Info Banner -->
                            <div class="mb-6 p-4 bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 border border-purple-200 dark:border-purple-800 rounded-xl">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-semibold text-purple-900 dark:text-purple-100 mb-1">Disposisi Permohonan</h4>
                                        <p class="text-xs text-purple-700 dark:text-purple-300">Teruskan permohonan ini ke OPD terkait untuk diproses lebih lanjut. Anda dapat memilih lebih dari satu OPD sekaligus.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-5">
                                <!-- SKPD Checkbox Grid Card -->
                                <div class="bg-white dark:bg-slate-700/50 rounded-xl border border-slate-200 dark:border-slate-600 p-5 shadow-sm">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-bold text-slate-800 dark:text-slate-100">
                                                    Pilih OPD Tujuan <span class="text-red-500">*</span>
                                                </label>
                                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Centang satu atau lebih OPD penerima disposisi</p>
                                            </div>
                                        </div>
                                        <button type="button" @click="showHelp = !showHelp" 
                                            class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Help Text -->
                                    <div x-show="showHelp" x-transition class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                                        <p class="text-xs text-blue-700 dark:text-blue-300">
                                            <strong>Tips:</strong> Gunakan kotak pencarian untuk menemukan OPD dengan cepat. Centang kotak untuk memilih. OPD yang sudah menerima disposisi tidak dapat dipilih lagi.
                                        </p>
                                    </div>

                                    <!-- Search Box -->
                                    <div class="mb-4">
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                </svg>
                                            </div>
                                            <input type="text" x-model="searchQuery" 
                                                placeholder="🔍 Cari OPD..."
                                                class="block w-full pl-10 pr-3 py-2.5 border-2 border-slate-300 dark:border-slate-500 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all">
                                        </div>
                                    </div>
                                    
                                    <!-- OPD Checkbox Grid -->
                                    <div class="max-h-96 overflow-y-auto pr-2 space-y-2 custom-scrollbar">
                                        @foreach($allSkpd as $skpd)
                                            @php
                                                $isDisposisied = $permohonan->disposisi->pluck('id_skpd')->contains($skpd->id_skpd);
                                            @endphp
                                            <div x-show="'{{ strtolower($skpd->nm_skpd) }}'.includes(searchQuery.toLowerCase())" 
                                                class="group/card relative">
                                                <label class="flex items-center gap-3 p-3 rounded-lg border-2 transition-all cursor-pointer
                                                    {{ $isDisposisied ? 'bg-green-50 dark:bg-green-900/10 border-green-200 dark:border-green-800 opacity-60 cursor-not-allowed' : 'bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-600 hover:border-purple-300 dark:hover:border-purple-600 hover:shadow-md' }}"
                                                    :class="{ 'border-purple-500 dark:border-purple-500 bg-purple-50 dark:bg-purple-900/20 shadow-md': selectedSkpds.includes('{{ $skpd->id_skpd }}') && !{{ $isDisposisied ? 'true' : 'false' }} }">
                                                    
                                                    @if($isDisposisied)
                                                        <!-- Already Disposed Checkmark -->
                                                        <div class="flex-shrink-0 w-5 h-5 rounded bg-green-500 flex items-center justify-center">
                                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </div>
                                                    @else
                                                        <!-- Selectable Checkbox -->
                                                        <input type="checkbox" 
                                                            name="skpd_ids[]" 
                                                            value="{{ $skpd->id_skpd }}"
                                                            @click="toggleSkpd('{{ $skpd->id_skpd }}')"
                                                            class="w-5 h-5 text-purple-600 bg-white dark:bg-slate-700 border-2 border-slate-300 dark:border-slate-500 rounded focus:ring-2 focus:ring-purple-500 focus:ring-offset-0 transition-all cursor-pointer">
                                                    @endif
                                                    
                                                    <!-- OPD Info -->
                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-4 h-4 flex-shrink-0 {{ $isDisposisied ? 'text-green-600 dark:text-green-400' : 'text-purple-600 dark:text-purple-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                            </svg>
                                                            <span class="text-sm font-medium text-slate-800 dark:text-slate-100 truncate">
                                                                {{ $skpd->nm_skpd }}
                                                            </span>
                                                            @if($isDisposisied)
                                                                <span class="ml-auto flex-shrink-0 px-2 py-0.5 text-xs font-semibold text-green-700 dark:text-green-300 bg-green-100 dark:bg-green-900/30 rounded-full">
                                                                    Sudah Didisposisikan
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </label>
                                                
                                                <!-- Tooltip on card hover -->
                                                <div class="absolute left-3 top-full mt-2 px-3 py-2 bg-slate-900 dark:bg-slate-700 text-white text-sm rounded-lg shadow-2xl z-[9999] whitespace-nowrap opacity-0 invisible group-hover/card:opacity-100 group-hover/card:visible transition-all duration-200 pointer-events-none">
                                                    <div class="font-medium">{{ $skpd->nm_skpd }}</div>
                                                    <div class="absolute -top-1.5 left-6 w-3 h-3 bg-slate-900 dark:bg-slate-700 transform rotate-45"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <!-- Selection Counter -->
                                    <div class="mt-4 flex items-center justify-between p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg border border-purple-200 dark:border-purple-800">
                                        <div class="flex items-center gap-2 text-sm">
                                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="font-semibold text-purple-900 dark:text-purple-100">
                                                <span x-text="selectedSkpds.length">0</span> OPD dipilih
                                            </span>
                                        </div>
                                        <span class="text-xs text-purple-700 dark:text-purple-300">
                                            Minimal 1 OPD harus dipilih
                                        </span>
                                    </div>
                                </div>

                                <!-- Catatan Disposisi Card -->
                                <div class="bg-white dark:bg-slate-700/50 rounded-xl border border-slate-200 dark:border-slate-600 p-5 shadow-sm">
                                    <div class="flex items-center gap-2 mb-4">
                                        <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-slate-800 dark:text-slate-100">
                                                Catatan Disposisi
                                            </label>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Instruksi atau pesan untuk OPD penerima (opsional)</p>
                                        </div>
                                    </div>
                                    
                                    <textarea name="catatan" rows="4"
                                        class="w-full px-4 py-3 border-2 border-slate-300 dark:border-slate-500 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 sm:text-sm resize-none transition-all"
                                        placeholder="Contoh: Mohon segera ditindaklanjuti dan berkoordinasi dengan bagian terkait..."></textarea>
                                    
                                    <div class="flex items-center gap-2 mt-2 text-xs text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Catatan akan terlihat oleh semua OPD yang menerima disposisi</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons with Better Visibility -->
                            <div class="mt-6 pt-4 border-t-2 border-slate-300 dark:border-slate-600 flex flex-col-reverse sm:flex-row gap-3">
                                <button type="button" @click="processModalOpen = false"
                                    class="flex-1 sm:flex-none px-6 py-3.5 rounded-xl border-2 border-slate-400 dark:border-slate-500 bg-slate-100 dark:bg-slate-700 text-slate-800 dark:text-slate-100 font-bold hover:bg-slate-200 dark:hover:bg-slate-600 hover:border-slate-500 dark:hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all shadow-md hover:shadow-lg">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Batal
                                    </span>
                                </button>
                                <button type="submit"
                                    x-bind:disabled="selectedSkpds.length === 0"
                                    x-bind:class="selectedSkpds.length === 0 ? 'bg-slate-300 dark:bg-slate-600 text-slate-500 dark:text-slate-400 cursor-not-allowed' : 'bg-purple-600 text-white hover:bg-purple-700 transform hover:-translate-y-0.5 hover:shadow-2xl active:scale-95'"
                                    class="flex-1 px-6 py-3.5 rounded-xl font-bold shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        Kirim Disposisi
                                    </span>
                                </button>
                            </div>
                        </form>
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

    @push('styles')
    <style>
        /* Custom Scrollbar for OPD List */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgb(241 245 249);
            border-radius: 10px;
        }
        
        .dark .custom-scrollbar::-webkit-scrollbar-track {
            background: rgb(15 23 42);
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #9333EA 0%, #6366F1 100%);
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #7C3AED 0%, #4F46E5 100%);
        }
        
        /* Smooth checkbox animations */
        input[type="checkbox"] {
            transition: all 0.2s ease-in-out;
        }
        
        input[type="checkbox"]:checked {
            transform: scale(1.05);
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // No additional scripts needed - pure Alpine.js implementation
    </script>
    @endpush

</x-admin-layout>