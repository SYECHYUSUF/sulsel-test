<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Informasi Pengadaan') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{
        showNotification: {{ session('success') || session('error') ? 'true' : 'false' }},
        notificationStatus: '{{ session('error') ? 'error' : 'success' }}',
        notificationMessage: '{{ session('success') ?? session('error') }}',
        showDeleteModal: false,
        deleteUrl: '',
        confirmDelete(url) {
            this.deleteUrl = url;
            this.showDeleteModal = true;
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Daftar Informasi Pengadaan</h3>
                    <a href="{{ route('admin.ikphns.create') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        + Tambah Data
                    </a>
                </div>

                <!-- Filter & Search -->
                <div class="flex gap-4 mb-4">
                    <form method="GET" action="{{ route('admin.ikphns.index') }}" class="flex-1 flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..."
                            class="w-full px-4 py-2 border rounded-lg dark:bg-slate-700 dark:border-slate-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit"
                            class="px-4 py-2 bg-gray-200 dark:bg-slate-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-slate-600">
                            Cari
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 border-b dark:border-slate-600">No</th>
                                <th class="px-4 py-3 border-b dark:border-slate-600">Judul / Nama Jabatan</th>
                                <th class="px-4 py-3 border-b dark:border-slate-600">SKPD</th>
                                <th class="px-4 py-3 border-b dark:border-slate-600">File</th>
                                <th class="px-4 py-3 border-b dark:border-slate-600">Upload</th>
                                <th class="px-4 py-3 border-b dark:border-slate-600">Status</th>
                                <th class="px-4 py-3 border-b dark:border-slate-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-slate-600">
                            @forelse ($items as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $item->nama_jabatan }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        {{ $item->skpd->nm_skpd ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if($item->file)
                                            <a href="{{ Storage::url($item->file) }}" target="_blank"
                                                class="text-blue-500 hover:underline">Download</a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $item->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if ($item->verify == 'y')
                                            <span
                                                class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Terverifikasi</span>
                                        @elseif($item->verify == 't')
                                            <span
                                                class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">Ditolak</span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm flex gap-2">
                                        <a href="{{ route('admin.ikphns.edit', $item->id) }}"
                                            class="text-yellow-500 hover:text-yellow-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                        </a>
                                        <button @click="confirmDelete('{{ route('admin.ikphns.destroy', $item->id) }}')"
                                            class="text-red-500 hover:text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Belum ada
                                        data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    <!-- Notification Modal -->
    @php
        $notifyStatus = session('error') ? 'error' : 'success';
        $notifyMessage = session('success') ?? session('error');
    @endphp
    <x-notification-modal trigger="showNotification" :status="$notifyStatus" :description="$notifyMessage" />

    <!-- Delete Confirmation Dialog -->
    <x-confirmation-dialog trigger="showDeleteModal" title="Hapus Dokumen?"
        description="Dokumen yang dihapus tidak dapat dikembalikan." confirmText="Ya, Hapus" theme="danger"
        url="deleteUrl" :dynamic="true" method="DELETE" />
    </div>
</x-admin-layout>