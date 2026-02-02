<x-admin-layout>
    <x-slot:title>Manajemen Permohonan Informasi</x-slot:title>

    <x-slot:extra_head>
        <style>
            /* Glassmorphism Styles */
            .glass-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(20px) saturate(180%);
                -webkit-backdrop-filter: blur(20px) saturate(180%);
                border: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            }

            .glass-header {
                background: linear-gradient(135deg, #1A305E 0%, #2563eb 50%, #3b82f6 100%);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }

            .animate-pulse {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            @keyframes pulse {
                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: .5;
                }
            }
        </style>
    </x-slot:extra_head>

    <div x-data="permohonanDataTable()" x-init="fetchData()" class="space-y-6">
        <!-- Header Section with Gradient -->
        <div class="glass-header rounded-2xl p-6 text-white shadow-xl">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold mb-2 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Permohonan Informasi
                        </h1>
                        <p class="text-white/90 text-sm">Pantau dan kelola permintaan informasi publik dari masyarakat.</p>
                    </div>
                </div>

                <!-- Search Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- Search Box -->
                    <div class="relative">
                        <input 
                            type="text" 
                            x-model="search" 
                            @input.debounce.500ms="fetchData()" 
                            placeholder="Cari pemohon..." 
                            class="w-full pl-11 pr-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-white/60 rounded-xl focus:ring-2 focus:ring-blue-300 focus:border-blue-300 text-sm transition-all"
                        >
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-white/70 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="relative">
                        <select 
                            x-model="statusFilter" 
                            @change="fetchData()" 
                            class="w-full pl-11 pr-10 py-3 bg-white/20 backdrop-blur-sm border border-white/30 text-white rounded-xl focus:ring-2 focus:ring-blue-300 focus:border-blue-300 text-sm transition-all appearance-none cursor-pointer">
                            <option value="" class="bg-slate-800 text-white">Semua Status</option>
                            <option value="Menunggu Verifikasi" class="bg-slate-800 text-white">Menunggu Verifikasi</option>
                            <option value="Diproses" class="bg-slate-800 text-white">Diproses</option>
                            <option value="Selesai" class="bg-slate-800 text-white">Selesai</option>
                            <option value="Ditolak" class="bg-slate-800 text-white">Ditolak</option>
                        </select>
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-white/70 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                        </div>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 text-white/70 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 font-semibold">
                        <tr>
                            <th class="px-6 py-4">Pemohon</th>
                            <th class="px-6 py-4">Kontak</th>
                            {{-- Tampilkan header ini hanya untuk admin --}}
                            @if(auth()->user()->hasRole('admin'))
                                <th class="px-6 py-4">SKPD Tujuan</th>
                            @endif
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        <template x-if="loading">
                            <template x-for="i in 5" :key="i">
                                <tr class="animate-pulse">
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-100 dark:bg-slate-700 rounded w-3/4"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-100 dark:bg-slate-700 rounded w-1/2"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-100 dark:bg-slate-700 rounded w-1/2"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-6 bg-slate-100 dark:bg-slate-700 rounded-full w-16"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-100 dark:bg-slate-700 rounded w-20"></div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="h-8 bg-slate-100 dark:bg-slate-700 rounded-lg w-10 ml-auto"></div>
                                    </td>
                                </tr>
                            </template>
                        </template>

                        <template x-if="!loading && items.length === 0">
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                    Tidak ada data permohonan.
                                </td>
                            </tr>
                        </template>

                        <template x-if="!loading">
                            <template x-for="item in items" :key="item.id_permohonan">
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900 dark:text-slate-100" x-text="item.nama"></div>
                                        <div class="text-xs text-slate-400 dark:text-slate-500" x-text="item.kategori_pemohon"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-slate-600 dark:text-slate-300" x-text="item.email"></div>
                                        <div class="text-xs text-slate-400 dark:text-slate-500" x-text="item.no_hp"></div>
                                    </td>
                                    {{-- Tampilkan sel ini hanya jika admin --}}
                                    <template x-if="isAdmin">
                                        <td class="px-6 py-4">
                                            <span class="text-slate-600 dark:text-slate-300"
                                                x-text="item.skpd ? item.skpd.nm_skpd : '-'"></span>
                                        </td>
                                    </template>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold"
                                            :class="item.status_color" x-text="item.status_label">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 dark:text-slate-400" x-text="formatDate(item.created_at)"></td>
                                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                                        <a :href="'/admin/permohonan-informasi/' + item.id_permohonan"
                                            class="p-2 text-slate-400 dark:text-slate-500 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-all inline-block"
                                            title="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Delete Button (Only for Final Statuses: 2, 3, 4) --}}
                                        <template x-if="[2, 3, 4].includes(item.status)">
                                            <button @click="confirmDeleteItem('/admin/permohonan-informasi/' + item.id_permohonan)"
                                                class="p-2 text-slate-400 dark:text-slate-500 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all inline-block"
                                                title="Hapus Data">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between gap-4 py-2"
            x-show="!loading && items.length > 0">
            <div class="text-sm text-slate-500 dark:text-slate-400">
                Menampilkan <span class="font-medium text-slate-900 dark:text-slate-100" x-text="items.length"></span> dari <span
                    class="font-medium text-slate-900 dark:text-slate-100" x-text="pagination.total"></span> data
            </div>
            <div class="flex items-center gap-2">
                <button @click="changePage(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"
                    class="px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 disabled:opacity-50 transition-colors">Sebelumnya</button>
                <button @click="changePage(pagination.next_page_url)" :disabled="!pagination.next_page_url"
                    class="px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 disabled:opacity-50 transition-colors">Berikutnya</button>
            </div>
        </div>
    </div>
    
    <div x-data="{ showDeleteModal: false, deleteUrl: '' }" 
         @open-delete-modal.window="showDeleteModal = true; deleteUrl = $event.detail">
         <x-confirmation-dialog trigger="showDeleteModal" title="Hapus Data?"
            description="Apakah Anda yakin ingin menghapus data ini secara permanen?" confirmText="Hapus" theme="danger"
            url="deleteUrl" :dynamic="true" method="DELETE" />
    </div>

    </div> <!-- Close x-data permohonanDataTable -->
    </div> <!-- Close x-data div -->

    <script>
        function permohonanDataTable() {
            return {
                loading: true,
                items: [],
                pagination: {},
                isAdmin: {{ auth()->user()->hasRole('admin') ? 'true' : 'false' }},
                search: '',
                statusFilter: '',
                deleteModalOpen: false,
                deleteId: null,

                async fetchData(url = null) {
                    this.loading = true;
                    const targetUrl = url || `/admin/permohonan-informasi?search=${encodeURIComponent(this.search)}&status=${encodeURIComponent(this.statusFilter)}`;

                    try {
                        const response = await fetch(targetUrl, {
                            headers: { 'Accept': 'application/json' }
                        });
                        const data = await response.json();
                        this.items = data.data;
                        this.pagination = {
                            next_page_url: data.next_page_url,
                            prev_page_url: data.prev_page_url,
                            total: data.total
                        };
                    } catch (error) {
                        console.error("Error:", error);
                    } finally {
                        this.loading = false;
                    }
                },

                changePage(url) { if (url) this.fetchData(url); },

                formatDate(dateStr) {
                    return new Date(dateStr).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
                },

                confirmDeleteItem(url) {
                    window.dispatchEvent(new CustomEvent('open-delete-modal', { detail: url }));
                },

                getStatusClass(status) {
                    const s = status.toLowerCase();
                    if (s === 'selesai') return 'bg-emerald-50 text-emerald-700 border-emerald-100';
                    if (s === 'proses') return 'bg-amber-50 text-amber-700 border-amber-100';
                    return 'bg-slate-50 text-slate-700 border-slate-100';
                }
            }
        }
    </script>
</x-admin-layout>