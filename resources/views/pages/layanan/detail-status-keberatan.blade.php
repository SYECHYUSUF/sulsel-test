<x-guest-layout>
    <x-slot:title>
        Detail Status Pengajuan Keberatan
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Detail Pengajuan Keberatan</h2>
                        <a href="{{ route('layanan.pengajuan-keberatan.check-status') }}" class="text-indigo-600 hover:text-indigo-900 text-sm">Kembali ke Pencarian</a>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 py-4">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nomor Pendaftaran</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pengajuan->no_pendaftaran }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Pengajuan</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pengajuan->created_at->format('d F Y H:i') }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Pemohon</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pengajuan->nama_pemohon }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                <dd class="mt-1">
                                    @if($pengajuan->status == 'y')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                                    @elseif($pengajuan->status == 't')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                    @elseif($pengajuan->status == 'a')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Dijawab</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Dalam Proses</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alasan Keberatan</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    <ul class="list-disc pl-5">
                                        @foreach($pengajuan->alasanPengajuan as $alasan)
                                            <li>{{ $alasan->alasan }}</li>
                                        @endforeach
                                    </ul>
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Kasus Posisi</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pengajuan->kasus }}</dd>
                            </div>
                        </dl>
                    </div>

                    @if($pengajuan->feedback)
                        <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100 mb-4">Tanggapan Admin</h3>
                            <div class="bg-slate-50 dark:bg-slate-900 rounded-lg p-4 border border-slate-200 dark:border-slate-700">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 w-full">
                                        <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-line">{{ $pengajuan->feedback }}</p>
                                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                            Dijawab pada: {{ \Carbon\Carbon::parse($pengajuan->tgl_feedback)->format('d F Y H:i') }}
                                            @if($pengajuan->feedbackBy)
                                                oleh {{ $pengajuan->feedbackBy->name }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
