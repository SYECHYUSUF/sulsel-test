<x-admin-layout title="Detail Pengajuan Keberatan - Admin PPID">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.pengajuan-keberatan.index') }}"
                class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span>Detail Pengajuan Keberatan</span>
        </div>
    </x-slot>

    <div x-data="{ 
        responseModalOpen: false,
        rejectionModalOpen: false,
        disposisiModalOpen: false,
        successModalOpen: @if(session('success')) true @else false @endif
    }">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content - Left Side -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Data Pemohon Card -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Data Pemohon</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">Nama
                                    Lengkap</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $pengajuan->nama_pemohon }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">NIK
                                    / No. Identitas</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium">
                                    {{ $pengajuan->nik_pemohon ?? '-' }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">Email</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium">
                                    {{ $pengajuan->email_pemohon }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">Nomor
                                    HP</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium flex items-center gap-2">
                                    {{ $pengajuan->no_telp_pemohon }}
                                    @if($pengajuan->no_telp_pemohon)
                                        @php
                                            $whatsappNumber = $pengajuan->no_telp_pemohon;
                                            if (Str::startsWith($whatsappNumber, '0')) {
                                                $whatsappNumber = '62' . substr($whatsappNumber, 1);
                                            }
                                        @endphp
                                        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank"
                                            class="text-green-600 text-sm hover:text-green-700">
                                            ✓ WhatsApp
                                        </a>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label
                                    class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">Pekerjaan</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium">
                                    {{ $pengajuan->pekerjaan_pemohon ?? '-' }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">Alamat</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium">
                                    {{ $pengajuan->alamat_pemohon }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rincian Keberatan Card -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Rincian Keberatan</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label
                                class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-2">Alasan
                                Keberatan</label>
                            <ul class="list-disc list-inside space-y-1 text-slate-700 dark:text-slate-300">
                                @foreach($pengajuan->alasanPengajuan as $alasan)
                                    <li>{{ $alasan->alasan }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div>
                            <label
                                class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-2">Kasus
                                Posisi</label>
                            <div
                                class="bg-slate-50 dark:bg-slate-900/50 rounded-lg p-4 border border-slate-200 dark:border-slate-700">
                                <p class="text-slate-900 dark:text-slate-100 whitespace-pre-wrap">
                                    {!! $pengajuan->kasus !!}
                                </p>
                            </div>
                        </div>

                        @if($pengajuan->tujuan)
                            <div>
                                <label
                                    class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-2">Tujuan
                                    Penggunaan Informasi</label>
                                <div class="text-slate-900 dark:text-slate-100">{!! $pengajuan->tujuan !!}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Balasan Admin (if exists) -->
                @if($pengajuan->feedback)
                    <div
                        class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                            <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Balasan Admin</h3>
                        </div>
                        <div class="p-6">
                            <div
                                class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 border border-blue-200 dark:border-blue-800">
                                <p class="text-slate-700 dark:text-slate-300 whitespace-pre-wrap">{{ $pengajuan->feedback }}
                                </p>
                                @if($pengajuan->tgl_feedback)
                                    <div
                                        class="mt-3 pt-3 border-t border-blue-200 dark:border-blue-700 text-sm text-slate-600 dark:text-slate-400">
                                        Dijawab pada {{ \Carbon\Carbon::parse($pengajuan->tgl_feedback)->format('d F Y, H:i') }}
                                        @if($pengajuan->feedbackBy)
                                            oleh <span class="font-semibold">{{ $pengajuan->feedbackBy->name }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- OPD Disposisi Tracking --}}
                @include('admin.pengajuan-keberatan.partials.tracking-card')
            </div>

            <!-- Sidebar - Right Side (Tindakan) -->
            @role('admin')
            <div class="lg:col-span-1">
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden sticky top-6">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Tindakan</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @if($pengajuan->status == 'p')
                            <!-- Status Menunggu Verifikasi -->
                            <div
                                class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 text-center">
                                <p class="text-sm font-semibold text-yellow-800 dark:text-yellow-300">
                                    Permohonan Menunggu Verifikasi.
                                </p>
                            </div>

                            <!-- Jawab Button -->
                            <button @click="responseModalOpen = true"
                                class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-colors shadow-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                </svg>
                                Jawab Pengajuan
                            </button>

                            <!-- Disposisi Button -->
                            <button @click="disposisiModalOpen = true"
                                class="w-full py-3 bg-white dark:bg-slate-700 border-2 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 rounded-lg font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shadow-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4" />
                                </svg>
                                Disposisi ke OPD
                            </button>

                            <!-- Tolak Button -->
                            <button @click="rejectionModalOpen = true"
                                class="w-full py-3 bg-white dark:bg-slate-700 border-2 border-red-200 dark:border-red-900/50 text-red-600 dark:text-red-400 rounded-lg font-semibold hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                Tolak Pengajuan
                            </button>

                        @elseif($pengajuan->status == 'd')
                            <!-- Status Disposisi -->
                            <div
                                class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg p-4">
                                <p class="text-sm font-semibold text-purple-800 dark:text-purple-300 text-center">
                                    Pengajuan <strong>Didisposisikan</strong>.
                                </p>
                            </div>

                            @if($pengajuan->skpd)
                                <div
                                    class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3 border border-slate-100 dark:border-slate-600">
                                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase mb-1">SKPD
                                        Tujuan:</p>
                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-300">
                                        {{ $pengajuan->skpd->nm_skpd }}
                                    </p>
                                </div>
                            @endif

                            <button @click="disposisiModalOpen = true"
                                class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold transition-colors shadow-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Tambah Disposisi
                            </button>

                        @elseif($pengajuan->status == 'a')
                            <!-- Status Dijawab -->
                            <div
                                class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                                <p class="text-sm text-blue-800 dark:text-blue-300 text-center">
                                    Permohonan Telah <strong>Dijawab</strong> oleh Admin.
                                </p>
                            </div>

                        @else
                            <!-- Status Lainnya -->
                            <div class="bg-slate-50 dark:bg-slate-700/50 p-4 rounded-lg text-center">
                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Status: <strong>
                                        @if($pengajuan->status == 'y') Disetujui
                                        @elseif($pengajuan->status == 't') Ditolak
                                        @else {{ $pengajuan->status }}
                                        @endif
                                    </strong>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endrole
        </div>

        <!-- Jawab Modal -->
        <x-confirmation-dialog trigger="responseModalOpen" title="Kirim Jawaban Keberatan?"
            description="Jawaban akan dikirimkan ke pemohon melalui metode yang dipilih (Website/WhatsApp)."
            theme="primary" confirmText="Ya, Kirim Jawaban"
            url="{{ route('admin.pengajuan-keberatan.storeFeedback', $pengajuan->id_pengajuan) }}" method="POST">
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Jawaban Pengajuan <span class="text-red-500">*</span>
                </label>
                <textarea name="feedback" rows="5"
                    class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all"
                    placeholder="Tuliskan jawaban untuk pemohon..." required></textarea>
            </div>
        </x-confirmation-dialog>

        <!-- Disposisi Modal -->
        <div x-show="disposisiModalOpen" style="display: none;"
            class="fixed inset-0 z-[100] flex items-center justify-center px-4 py-6 sm:px-0"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <div class="fixed inset-0 transition-opacity transform" @click="disposisiModalOpen = false">
                <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden shadow-2xl transform transition-all sm:w-full sm:max-w-lg w-full flex flex-col max-h-[90vh]"
                @click.stop
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                <!-- Header -->
                <div class="bg-white dark:bg-slate-800 px-6 py-4 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center sticky top-0 z-10">
                    <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">
                        Disposisi ke SKPD
                    </h3>
                    <button @click="disposisiModalOpen = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Form Content -->
                <form action="{{ route('admin.pengajuan-keberatan.disposisi.store', $pengajuan->id_pengajuan) }}" method="POST" class="flex flex-col flex-1 overflow-hidden">
                    @csrf
                    
                    <div class="p-6 overflow-y-auto flex-1 custom-scrollbar space-y-5" 
                         x-data="{
                            search: '',
                            selected: {{ json_encode($existingSkpdIds ?? []) }},
                            options: {{ $allSkpd->map(fn($s) => ['id' => $s->id_skpd, 'name' => $s->nm_skpd])->values()->toJson() }},
                            get filteredOptions() {
                                if (this.search === '') return this.options;
                                return this.options.filter(opt => opt.name.toLowerCase().includes(this.search.toLowerCase()));
                            }
                         }">
                        
                        <!-- Pilihan SKPD -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Pilih SKPD Tujuan <span class="text-red-500">*</span>
                            </label>
                            
                            <!-- Search Bar -->
                            <div class="relative mb-3">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" x-model="search"
                                    class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-slate-100" 
                                    placeholder="Cari nama dinas / badan...">
                            </div>

                            <!-- List SKPD -->
                            <div class="border border-slate-200 dark:border-slate-600 rounded-lg max-h-48 overflow-y-auto custom-scrollbar bg-white dark:bg-slate-700">
                                <template x-for="opt in filteredOptions" :key="opt.id">
                                    <label class="flex items-center p-3 hover:bg-slate-50 dark:hover:bg-slate-600 cursor-pointer transition-colors border-b last:border-0 border-slate-100 dark:border-slate-600">
                                        <input type="checkbox" name="skpd_ids[]" :value="opt.id" x-model="selected"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-500">
                                        <span class="ml-3 text-sm text-slate-700 dark:text-slate-200 font-medium" x-text="opt.name"></span>
                                        <span x-show="selected.includes(opt.id)" class="ml-auto text-blue-600 dark:text-blue-400 text-xs font-bold px-2 py-0.5 bg-blue-50 dark:bg-blue-900/40 rounded-full">Terpilih</span>
                                    </label>
                                </template>
                                <div x-show="filteredOptions.length === 0" class="p-4 text-center text-sm text-slate-500 dark:text-slate-400">
                                    Tidak ada SKPD yang cocok.
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 mt-1 dark:text-slate-400" x-text="selected.length + ' SKPD dipilih'"></p>
                        </div>

                        <!-- Catatan Disposisi -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Catatan / Instruksi (Opsional)
                            </label>
                            <textarea name="catatan" rows="3"
                                class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all"
                                placeholder="Tambahkan catatan untuk SKPD..."></textarea>
                        </div>
                    </div>

                    <!-- Footer / Buttons -->
                    <div class="bg-gray-50 dark:bg-slate-700/50 px-6 py-4 flex flex-row-reverse gap-3 sticky bottom-0 z-10">
                        <button type="submit" 
                            class="inline-flex justify-center px-5 py-2.5 text-sm font-bold text-white bg-[#1A305E] border border-transparent rounded-lg hover:bg-[#1A305E]/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500 shadow-lg transform transition hover:-translate-y-0.5">
                            Kirim Disposisi
                        </button>
                        <button type="button" @click="disposisiModalOpen = false"
                            class="inline-flex justify-center px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-slate-500">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Rejection Modal -->
        <x-confirmation-dialog trigger="rejectionModalOpen" title="Tolak Pengajuan Keberatan?"
            description="Berikan alasan penolakan yang jelas agar pemohon dapat memahaminya." theme="danger"
            confirmText="Ya, Tolak" url="{{ route('admin.pengajuan-keberatan.update', $pengajuan->id_pengajuan) }}"
            method="PUT">
            <input type="hidden" name="status" value="t">
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Alasan Penolakan <span class="text-red-500">*</span>
                </label>
                <textarea name="alasan_penolakan" rows="5"
                    class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 sm:text-sm transition-all"
                    placeholder="Jelaskan alasan penolakan..." required></textarea>
            </div>
        </x-confirmation-dialog>

        <!-- Disposisi Modal -->
        <div x-show="disposisiModalOpen" style="display: none;"
            class="fixed inset-0 z-[100] flex items-center justify-center px-4 py-6 sm:px-0"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <div class="fixed inset-0 transition-opacity transform" @click="disposisiModalOpen = false">
                <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden shadow-2xl transform transition-all sm:w-full sm:max-w-lg w-full flex flex-col max-h-[90vh]"
                @click.stop
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                <!-- Header -->
                <div class="bg-white dark:bg-slate-800 px-6 py-4 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center sticky top-0 z-10">
                    <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">
                        Disposisi ke SKPD
                    </h3>
                    <button @click="disposisiModalOpen = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Form Content -->
                <form action="{{ route('admin.pengajuan-keberatan.disposisi.store', $pengajuan->id_pengajuan) }}" method="POST" class="flex flex-col flex-1 overflow-hidden">
                    @csrf
                    
                    <div class="p-6 overflow-y-auto flex-1 custom-scrollbar space-y-5" 
                         x-data="{
                            search: '',
                            selected: {{ json_encode($existingSkpdIds ?? []) }},
                            options: {{ $allSkpd->map(fn($s) => ['id' => $s->id_skpd, 'name' => $s->nm_skpd])->values()->toJson() }},
                            get filteredOptions() {
                                if (this.search === '') return this.options;
                                return this.options.filter(opt => opt.name.toLowerCase().includes(this.search.toLowerCase()));
                            }
                         }">
                        
                        <!-- Pilihan SKPD -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Pilih SKPD Tujuan <span class="text-red-500">*</span>
                            </label>
                            
                            <!-- Search Bar -->
                            <div class="relative mb-3">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" x-model="search"
                                    class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-slate-100" 
                                    placeholder="Cari nama dinas / badan...">
                            </div>

                            <!-- List SKPD -->
                            <div class="border border-slate-200 dark:border-slate-600 rounded-lg max-h-48 overflow-y-auto custom-scrollbar bg-white dark:bg-slate-700">
                                <template x-for="opt in filteredOptions" :key="opt.id">
                                    <label class="flex items-center p-3 hover:bg-slate-50 dark:hover:bg-slate-600 cursor-pointer transition-colors border-b last:border-0 border-slate-100 dark:border-slate-600">
                                        <input type="checkbox" name="skpd_ids[]" :value="opt.id" x-model="selected"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-500">
                                        <span class="ml-3 text-sm text-slate-700 dark:text-slate-200 font-medium" x-text="opt.name"></span>
                                        <span x-show="selected.includes(opt.id)" class="ml-auto text-blue-600 dark:text-blue-400 text-xs font-bold px-2 py-0.5 bg-blue-50 dark:bg-blue-900/40 rounded-full">Terpilih</span>
                                    </label>
                                </template>
                                <div x-show="filteredOptions.length === 0" class="p-4 text-center text-sm text-slate-500 dark:text-slate-400">
                                    Tidak ada SKPD yang cocok.
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 mt-1 dark:text-slate-400" x-text="selected.length + ' SKPD dipilih'"></p>
                        </div>

                        <!-- Catatan Disposisi -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Catatan / Instruksi (Opsional)
                            </label>
                            <textarea name="catatan" rows="3"
                                class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all"
                                placeholder="Tambahkan catatan untuk SKPD..."></textarea>
                        </div>
                    </div>

                    <!-- Footer / Buttons -->
                    <div class="bg-gray-50 dark:bg-slate-700/50 px-6 py-4 flex flex-row-reverse gap-3 sticky bottom-0 z-10">
                        <button type="submit" 
                            class="inline-flex justify-center px-5 py-2.5 text-sm font-bold text-white bg-[#1A305E] border border-transparent rounded-lg hover:bg-[#1A305E]/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500 shadow-lg transform transition hover:-translate-y-0.5">
                            Kirim Disposisi
                        </button>
                        <button type="button" @click="disposisiModalOpen = false"
                            class="inline-flex justify-center px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-slate-500">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Success notification modal -->
        <x-notification-modal />
    </div>
</x-admin-layout>