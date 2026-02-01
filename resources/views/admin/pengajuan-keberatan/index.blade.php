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
                                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-2">
                                            Respon pengajuan ini melalui WhatsApp:
                                        </p>
                                        <div class="flex items-center gap-2 p-3 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.374-5.03c0-5.445 4.43-9.873 9.878-9.873 2.636 0 5.115 1.026 6.977 2.891a9.825 9.825 0 012.895 6.974c-.003 5.449-4.434 9.877-9.882 9.877h.001z"/>
                                            </svg>
                                            <div class="flex-1">
                                                <div class="text-sm font-medium text-slate-900 dark:text-slate-100" x-text="detailItem.nama_pemohon"></div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400" x-text="formatPhone(detailItem.no_telp_pemohon)"></div>
                                            </div>
                                            <a :href="getWhatsAppLink(detailItem)" target="_blank" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded shadow-sm transition-colors flex items-center gap-1">
                                                <span>Chat</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Hidden Feedback Form if needed for manual logging later -->
                                    <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-700">
                                        <p class="text-xs text-slate-400">
                                            Catatan: Klik tombol Chat untuk membuka WhatsApp.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" @click="showFeedbackModal = false" class="w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Tutup
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
                            kasus: data.kasus,
                            no_telp_pemohon: data.no_telp_pemohon // Make sure this is returned by controller
                        };

                        if(data.feedback) {
                            this.feedbackText = data.feedback;
                            this.existingFeedback = data.feedback;
                        }
                    } catch(e) {
                        console.error("Failed to load feedback details", e);
                    }
                },

                // Helper for phone formatting
                formatPhone(number) {
                    if (!number) return '-';
                    return number;
                },

                getWhatsAppLink(item) {
                    if (!item || !item.no_telp_pemohon) return '#';
                    
                    let phone = item.no_telp_pemohon.trim();
                    if (phone.startsWith('0')) {
                        phone = '62' + phone.substring(1);
                    } else if (phone.startsWith('+62')) {
                        phone = phone.substring(1);
                    }

                    const message = `Halo Sdr/i ${item.nama_pemohon}, menanggapi pengajuan keberatan anda dengan Nomor Pendaftaran: ${item.no_pendaftaran}...`;
                    return `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
                }
            }
        }
    </script>
</x-admin-layout>