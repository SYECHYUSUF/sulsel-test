<x-admin-layout title="Detail Pengajuan Keberatan - Admin PPID">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.pengajuan-keberatan.index') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
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
        successModalOpen: @if(session('success')) true @else false @endif
    }">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content - Left Side -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Data Pemohon Card -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Data Pemohon</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">Nama Lengkap</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $pengajuan->nama_pemohon }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">NIK / No. Identitas</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $pengajuan->nik_pemohon ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">Email</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $pengajuan->email_pemohon }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">Nomor HP</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium flex items-center gap-2">
                                    {{ $pengajuan->no_telp_pemohon }}
                                    @if($pengajuan->no_telp_pemohon)
                                        @php
                                            $whatsappNumber = $pengajuan->no_telp_pemohon;
                                            if (Str::startsWith($whatsappNumber, '0')) {
                                                $whatsappNumber = '62' . substr($whatsappNumber, 1);
                                            }
                                        @endphp
                                        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="text-green-600 text-sm hover:text-green-700">
                                            ✓ WhatsApp
                                        </a>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">Pekerjaan</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $pengajuan->pekerjaan_pemohon ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-1">Alamat</label>
                                <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $pengajuan->alamat_pemohon }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rincian Keberatan Card -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Rincian Keberatan</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-2">Alasan Keberatan</label>
                            <ul class="list-disc list-inside space-y-1 text-slate-700 dark:text-slate-300">
                                @foreach($pengajuan->alasanPengajuan as $alasan)
                                    <li>{{ $alasan->alasan }}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div>
                            <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-2">Kasus Posisi</label>
                            <div class="bg-slate-50 dark:bg-slate-900/50 rounded-lg p-4 border border-slate-200 dark:border-slate-700">
                                <p class="text-slate-900 dark:text-slate-100 whitespace-pre-wrap">{{ $pengajuan->kasus ?? 'Tidak ada keterangan' }}</p>
                            </div>
                        </div>

                        @if($pengajuan->tujuan)
                        <div>
                            <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold block mb-2">Tujuan Penggunaan Informasi</label>
                            <p class="text-slate-900 dark:text-slate-100">{{ $pengajuan->tujuan }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Balasan Admin (if exists) -->
                @if($pengajuan->feedback)
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Balasan Admin</h3>
                    </div>
                    <div class="p-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 border border-blue-200 dark:border-blue-800">
                            <p class="text-slate-700 dark:text-slate-300 whitespace-pre-wrap">{{ $pengajuan->feedback }}</p>
                            @if($pengajuan->tgl_feedback)
                            <div class="mt-3 pt-3 border-t border-blue-200 dark:border-blue-700 text-sm text-slate-600 dark:text-slate-400">
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
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden sticky top-6">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Tindakan</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @if($pengajuan->status == 'p')
                            <!-- Status Menunggu Verifikasi -->
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 text-center">
                                <p class="text-sm font-semibold text-yellow-800 dark:text-yellow-300">
                                    Permohonan Menunggu Verifikasi.
                                </p>
                            </div>

                            <!-- Jawab Button -->
                            <button @click="responseModalOpen = true"
                                class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-colors shadow-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                </svg>
                                Jawab Pengajuan
                            </button>

                            <!-- Disposisi Button -->
                            <a href="{{ route('admin.pengajuan-keberatan.disposisi', $pengajuan->id_pengajuan) }}"
                                class="w-full py-3 bg-white dark:bg-slate-700 border-2 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 rounded-lg font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shadow-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4-4m-4 4l4 4" />
                                </svg>
                                Disposisi ke OPD
                            </a>

                            <!-- Tolak Button -->
                            <button @click="rejectionModalOpen = true"
                                class="w-full py-3 bg-white dark:bg-slate-700 border-2 border-red-200 dark:border-red-900/50 text-red-600 dark:text-red-400 rounded-lg font-semibold hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                Tolak Pengajuan
                            </button>

                        @elseif($pengajuan->status == 'd')
                            <!-- Status Disposisi -->
                            <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg p-4">
                                <p class="text-sm font-semibold text-purple-800 dark:text-purple-300 text-center">
                                    Pengajuan <strong>Didisposisikan</strong>.
                                </p>
                            </div>

                            @if($pengajuan->skpd)
                            <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3 border border-slate-100 dark:border-slate-600">
                                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase mb-1">SKPD Tujuan:</p>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $pengajuan->skpd->nm_skpd }}</p>
                            </div>
                            @endif

                            <a href="{{ route('admin.pengajuan-keberatan.disposisi', $pengajuan->id_pengajuan) }}"
                                class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold transition-colors shadow-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Tambah Disposisi
                            </a>

                        @elseif($pengajuan->status == 'a')
                            <!-- Status Dijawab -->
                            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
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
        <x-confirmation-dialog 
            trigger="responseModalOpen"
            title="Kirim Jawaban Keberatan?"
            description="Jawaban akan dikirimkan ke pemohon melalui metode yang dipilih (Website/WhatsApp)."
            theme="primary"
            confirmText="Ya, Kirim Jawaban"
            url="{{ route('admin.pengajuan-keberatan.storeFeedback', $pengajuan->id_pengajuan) }}"
            method="POST"
        >
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Jawaban Pengajuan <span class="text-red-500">*</span>
                </label>
                <textarea name="feedback" rows="5"
                    class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all"
                    placeholder="Tuliskan jawaban untuk pemohon..." required></textarea>
            </div>
        </x-confirmation-dialog>

        <!-- Rejection Modal -->
        <x-confirmation-dialog 
            trigger="rejectionModalOpen"
            title="Tolak Pengajuan Keberatan?"
            description="Berikan alasan penolakan yang jelas agar pemohon dapat memahaminya."
            theme="danger"
            confirmText="Ya, Tolak"
            url="{{ route('admin.pengajuan-keberatan.update', $pengajuan->id_pengajuan) }}"
            method="PUT"
        >
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

        <!-- Success notification modal -->
        <x-notification-modal />
    </div>
</x-admin-layout>
