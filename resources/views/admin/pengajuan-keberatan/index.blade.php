<x-admin-layout>
    <x-slot:title>Manajemen Pengajuan Keberatan</x-slot:title>

    <div x-data="keberatanDataTable()" x-init="fetchData()" class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Pengajuan Keberatan</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Kelola keberatan atas permohonan informasi publik.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input 
                        type="text" 
                        x-model="search" 
                        @input.debounce.500ms="fetchData()" 
                        placeholder="Cari keberatan..." 
                        class="pl-10 pr-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full md:w-64 text-sm transition-all placeholder-slate-400 dark:placeholder-slate-500"
                    >
                    <div class="absolute left-3 top-2.5 text-slate-400 dark:text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
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
                            @if(auth()->user()->hasRole('admin'))
                                <th class="px-6 py-4">SKPD</th>
                            @endif
                            <th class="px-6 py-4">Alasan</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        <template x-if="loading">
                            <template x-for="i in 5" :key="i">
                                <tr class="animate-pulse">
                                    <td class="px-6 py-4"><div class="h-4 bg-slate-100 dark:bg-slate-700 rounded w-3/4"></div></td>
                                    <template x-if="isAdmin"><td class="px-6 py-4"><div class="h-4 bg-slate-100 dark:bg-slate-700 rounded w-1/2"></div></td></template>
                                    <td class="px-6 py-4"><div class="h-4 bg-slate-100 dark:bg-slate-700 rounded w-1/2"></div></td>
                                    <td class="px-6 py-4"><div class="h-6 bg-slate-100 dark:bg-slate-700 rounded-full w-16"></div></td>
                                    <td class="px-6 py-4"><div class="h-4 bg-slate-100 dark:bg-slate-700 rounded w-20"></div></td>
                                    <td class="px-6 py-4 text-right"><div class="h-8 bg-slate-100 dark:bg-slate-700 rounded-lg w-10 ml-auto"></div></td>
                                </tr>
                            </template>
                        </template>

                        <template x-if="!loading && items.length === 0">
                            <tr>
                                <td :colspan="isAdmin ? 6 : 5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                    Data pengajuan keberatan tidak ditemukan.
                                </td>
                            </tr>
                        </template>

                        <template x-if="!loading">
                            <template x-for="item in items" :key="item.id">
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900 dark:text-slate-100" x-text="item.nama_pemohon"></div>
                                        <div class="text-xs text-slate-400 dark:text-slate-500" x-text="'Kode: ' + (item.kode_permohonan || '-')"></div>
                                    </td>
                                    <template x-if="isAdmin">
                                        <td class="px-6 py-4">
                                            <span class="text-slate-600 dark:text-slate-300" x-text="item.skpd ? item.skpd.nm_skpd : '-'"></span>
                                        </td>
                                    </template>
                                    <td class="px-6 py-4">
                                        <div class="text-slate-600 dark:text-slate-300 line-clamp-1" x-text="item.alasan_keberatan"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span :class="getStatusClass(item.status)" 
                                              class="px-2.5 py-1 rounded-full text-xs font-medium border" 
                                              x-text="getStatusLabel(item.status)">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 dark:text-slate-400" x-text="formatDate(item.created_at)"></td>
                                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                                        <button @click="openFeedbackModal(item)" class="p-2 text-slate-400 dark:text-slate-500 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-all" title="Beri Feedback">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                            </svg>
                                        </button>
                                        <a :href="'/admin/pengajuan-keberatan/' + item.id" class="p-2 text-slate-400 dark:text-slate-500 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Feedback Modal -->
        <div x-show="showFeedbackModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showFeedbackModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showFeedbackModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                    <form :action="'/admin/pengajuan-keberatan/' + (selectedItem ? selectedItem.id : '') + '/feedback'" method="POST">
                        @csrf
                        <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-slate-100" id="modal-title">
                                        Detail & Feedback Pengajuan
                                    </h3>
                                    
                                    <!-- Detail Pengajuan Section -->
                                    <div class="mt-4 bg-slate-50 dark:bg-slate-900 p-4 rounded-lg border border-slate-200 dark:border-slate-700 text-sm overflow-y-auto max-h-60 mb-4">
                                        <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                                            <div class="sm:col-span-1">
                                                <dt class="font-medium text-gray-500 dark:text-gray-400">Nomor Pendaftaran</dt>
                                                <dd class="mt-1 text-gray-900 dark:text-gray-100" x-text="detailItem.no_pendaftaran || '-'"></dd>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <dt class="font-medium text-gray-500 dark:text-gray-400">Nama Pemohon</dt>
                                                <dd class="mt-1 text-gray-900 dark:text-gray-100" x-text="detailItem.nama_pemohon || '-'"></dd>
                                            </div>
                                            <div class="sm:col-span-2">
                                                <dt class="font-medium text-gray-500 dark:text-gray-400">Alasan Keberatan</dt>
                                                <dd class="mt-1 text-gray-900 dark:text-gray-100">
                                                    <ul class="list-disc pl-5">
                                                        <template x-for="alasan in detailItem.alasan">
                                                            <li x-text="alasan"></li>
                                                        </template>
                                                    </ul>
                                                </dd>
                                            </div>
                                            <div class="sm:col-span-2">
                                                <dt class="font-medium text-gray-500 dark:text-gray-400">Kasus Posisi</dt>
                                                <dd class="mt-1 text-gray-900 dark:text-gray-100 whitespace-pre-wrap" x-text="detailItem.kasus || '-'"></dd>
                                            </div>
                                        </dl>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                            Tanggapan / Jawaban
                                        </label>
                                        <textarea name="feedback" rows="4" class="w-full rounded-md border-slate-300 dark:border-slate-700 dark:bg-slate-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Tulis tanggapan anda disini..." x-model="feedbackText" required></textarea>
                                    </div>
                                    <div class="mt-2 text-xs text-slate-400" x-show="existingFeedback">
                                        Last Feedback: <span x-text="existingFeedback"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Kirim Tanggapan
                            </button>
                            <button type="button" @click="showFeedbackModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between gap-4 py-2" x-show="!loading && items.length > 0">
            <div class="text-sm text-slate-500 dark:text-slate-400">
                Menampilkan <span class="font-medium text-slate-900 dark:text-slate-100" x-text="items.length"></span> dari <span class="font-medium text-slate-900 dark:text-slate-100" x-text="pagination.total"></span> data
            </div>
            <div class="flex items-center gap-2">
                <button @click="changePage(pagination.prev_page_url)" :disabled="!pagination.prev_page_url" class="px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 disabled:opacity-50 transition-colors">Sebelumnya</button>
                <button @click="changePage(pagination.next_page_url)" :disabled="!pagination.next_page_url" class="px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 disabled:opacity-50 transition-colors">Berikutnya</button>
            </div>
        </div>
    </div>

    <script>
        function keberatanDataTable() {
            return {
                loading: true,
                items: [],
                pagination: {},
                search: '',
                isAdmin: {{ auth()->user()->hasRole('admin') ? 'true' : 'false' }},
                
                // Feedback Modal State
                showFeedbackModal: false,
                selectedItem: null,
                detailItem: {}, // Store details here
                feedbackText: '',
                existingFeedback: null,
                
                async fetchData(url = null) {
                    this.loading = true;
                    const targetUrl = url || `/admin/pengajuan-keberatan?search=${encodeURIComponent(this.search)}`;
                    
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
                    if (!dateStr) return '-';
                    return new Date(dateStr).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
                },

                getStatusClass(status) {
                    if (status == 'y') return 'bg-emerald-50 text-emerald-700 border-emerald-100'; // Disetujui
                    if (status == 't') return 'bg-rose-50 text-rose-700 border-rose-100'; // Ditolak
                    if (status == 'a') return 'bg-blue-50 text-blue-700 border-blue-100'; // Dijawab
                    return 'bg-amber-50 text-amber-700 border-amber-100'; // Proses (n)
                },

                getStatusLabel(status) {
                    if (status == 'y') return 'Disetujui';
                    if (status == 't') return 'Ditolak';
                    if (status == 'a') return 'Dijawab';
                    return 'Proses';
                },
                
                async openFeedbackModal(item) {
                    this.selectedItem = item;
                    this.feedbackText = '';
                    this.existingFeedback = null;
                    this.detailItem = {}; // Reset details
                    this.showFeedbackModal = true;
                    
                    // Fetch details from server
                    try {
                        const response = await fetch(`/admin/pengajuan-keberatan/${item.id}/feedback`);
                        const data = await response.json();
                        
                        this.detailItem = {
                            no_pendaftaran: data.no_pendaftaran,
                            nama_pemohon: data.nama_pemohon,
                            alasan: data.alasan,
                            kasus: data.kasus
                        };

                        if(data.feedback) {
                            this.feedbackText = data.feedback;
                            this.existingFeedback = data.feedback;
                        }
                    } catch(e) {
                        console.error("Failed to load feedback details", e);
                    }
                }
            }
        }
    </script>
</x-admin-layout>