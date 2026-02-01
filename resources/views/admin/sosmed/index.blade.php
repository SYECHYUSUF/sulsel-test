<x-admin-layout>
    <x-slot:title>Manajemen Media Sosial</x-slot:title>

    <div class="space-y-6" x-data="{ 
        showNotification: {{ session('success') || session('error') ? 'true' : 'false' }},
        showDeleteModal: false,
        deleteUrl: ''
    }">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Media Sosial</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Kelola tautan media sosial yang tampil di halaman
                    depan.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.social-links.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-colors shadow-sm gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah Media Sosial
                </a>
            </div>
        </div>

        {{-- Custom Notification Modal --}}
        @if(session('success') || session('error'))
            <x-notification-modal trigger="showNotification" :status="session('success') ? 'success' : 'error'"
                :title="session('success') ? 'Berhasil!' : 'Gagal!'" :description="session('success') ?? session('error')" />
        @endif

        {{-- Custom Confirmation Dialog --}}
        <x-confirmation-dialog trigger="showDeleteModal" title="Hapus Media Sosial"
            description="Apakah Anda yakin ingin menghapus media sosial ini? Tindakan ini tidak dapat dibatalkan."
            confirmText="Ya, Hapus" cancelText="Batal" theme="danger" @confirm="$nextTick(() => { 
                const form = document.getElementById('global-delete-form');
                form.action = deleteUrl;
                form.submit();
            })" />

        {{-- Hidden Delete Form --}}
        <form id="global-delete-form" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <div
            class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead
                        class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 font-semibold">
                        <tr>
                            <th class="px-6 py-4">Platform</th>
                            <th class="px-6 py-4">Tautan</th>
                            <th class="px-6 py-4 text-center">Ikon</th>
                            <th class="px-6 py-4">Urutan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($sosmeds as $item)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-900 dark:text-slate-100">{{ $item->sosmed }}</div>
                                    <div class="text-xs text-slate-400">{{ $item->judul }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ $item->link_sosmed }}" target="_blank"
                                        class="text-indigo-600 hover:text-indigo-800 hover:underline break-all">
                                        {{ $item->link_sosmed }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div
                                        class="inline-flex items-center justify-center p-2 bg-slate-100 dark:bg-slate-700 rounded-lg text-slate-600 dark:text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            {!! $item->icon_sosmed !!}
                                        </svg>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500 dark:text-slate-400">{{ $item->urutan }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.social-links.edit', $item->id_sosmed) }}"
                                            class="p-2 text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-all"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <button type="button"
                                            @click="deleteUrl = '{{ route('admin.social-links.destroy', $item->id_sosmed) }}'; showDeleteModal = true"
                                            class="p-2 text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all"
                                            title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                    Data Media Sosial tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>