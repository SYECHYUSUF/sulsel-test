<x-admin-layout>
    <x-slot:title>Manajemen Pengajuan Keberatan</x-slot:title>

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

            .glass-card-dark {
                background: rgba(30, 41, 59, 0.7);
                backdrop-filter: blur(20px) saturate(180%);
                -webkit-backdrop-filter: blur(20px) saturate(180%);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }


            .status-badge {
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeIn 0.3s ease-out;
            }
        </style>
    </x-slot:extra_head>

    <div x-data="keberatanDataTable()" x-init="fetchData()" class="space-y-6">
        <!-- Header Section with Glassmorphism -->
        <div class="bg-gradient-to-br from-ppid-primary via-blue-500 to-blue-600 backdrop-blur-md rounded-2xl p-6 text-white shadow-xl">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold mb-2 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Pengajuan Keberatan
                        </h1>
                        <p class="text-white/90 text-sm">Kelola keberatan atas permohonan informasi publik.</p>
                    </div>
                </div>

                <!-- Search and Filter Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Search Box -->
                    <div class="relative md:col-span-2">
                        <input type="text" x-model="search" @input.debounce.500ms="fetchData()"
                            placeholder="Cari berdasarkan nama, email, telepon, kode, kasus..."
                            class="w-full pl-11 pr-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-white/60 rounded-xl focus:ring-2 focus:ring-blue-300 focus:border-blue-300 text-sm transition-all">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-white/70 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="relative">
                        <select x-model="statusFilter" @change="fetchData()"
                            class="w-full pl-11 pr-10 py-3 bg-white/20 backdrop-blur-sm border border-white/30 text-white rounded-xl focus:ring-2 focus:ring-blue-300 focus:border-blue-300 text-sm transition-all appearance-none cursor-pointer">
                            <option value="" class="bg-slate-800 text-white">Semua Status</option>
                            <option value="p" class="bg-slate-800 text-white">Menunggu Verifikasi</option>
                            <option value="d" class="bg-slate-800 text-white">Disposisi</option>
                            <option value="a" class="bg-slate-800 text-white">Dijawab</option>
                            <option value="t" class="bg-slate-800 text-white">Ditolak</option>
                            <option value="y" class="bg-slate-800 text-white">Disetujui</option>
                        </select>
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-white/70 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                        </div>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 text-white/70 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success/Error Notifications -->
        <x-notification-modal />

        <!-- Main Content Card with Glassmorphism -->
        <div class="glass-card dark:glass-card-dark rounded-2xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead
                        class="bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-700/50 dark:to-slate-800/50 border-b-2 border-slate-200/50 dark:border-slate-600/50 text-slate-700 dark:text-slate-300 font-bold">
                        <tr
                            class="bg-gradient-to-r from-slate-50/50 to-slate-100/50 dark:from-slate-800/50 dark:to-slate-700/50">
                            <th class="px-6 py-4 text-left">Pemohon</th>
                            <th class="px-6 py-4 text-left">Kontak</th>
                            @if(auth()->user()->hasRole('admin'))
                                <th class="px-6 py-4 text-left">SKPD Tujuan</th>
                            @endif
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-left">Tanggal</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100/50 dark:divide-slate-700/50">
                        <!-- Loading State -->
                        <template x-if="loading">
                            <template x-for="i in 5" :key="i">
                                <tr class="animate-pulse">
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-3/4"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-2/3"></div>
                                    </td>
                                    <template x-if="isAdmin">
                                        <td class="px-6 py-4">
                                            <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-1/2"></div>
                                    </template>
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-1/2"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-6 bg-slate-200 dark:bg-slate-700 rounded-full w-20"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-24"></div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="h-8 bg-slate-200 dark:bg-slate-700 rounded-lg w-10 ml-auto"></div>
                                    </td>
                                </tr>
                            </template>
                        </template>

                        <!-- Empty State -->
                        <template x-if="!loading && items.length === 0">
                            <tr>
                                <td :colspan="isAdmin ? 7 : 6" class="px-6 py-16 text-center">
                                    <div
                                        class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 opacity-50"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="text-lg font-medium">Data pengajuan keberatan tidak ditemukan</p>
                                        <p class="text-sm mt-1">Belum ada pengajuan keberatan yang masuk</p>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        <!-- Data Rows -->
                        <template x-if="!loading">
                            <template x-for="item in items" :key="item.id_pengajuan">
                                <tr
                                    class="hover:bg-white/50 dark:hover:bg-slate-700/30 transition-all duration-200 animate-fade-in">
                                    <td class="px-6 py-4">
                                        <div>
                                            <div class="font-semibold text-slate-900 dark:text-slate-100"
                                                x-text="item.nama_pemohon"></div>
                                            <div
                                                class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-2 mt-1">
                                                <span x-text="item.no_pendaftaran || 'Belum ada nomor'"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-slate-700 dark:text-slate-300">
                                            <div class="flex items-center gap-2 mb-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                                </svg>
                                                <span class="text-xs" x-text="item.email_pemohon || '-'"></span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                                <span class="text-xs" x-text="item.no_telp_pemohon || '-'"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <template x-if="isAdmin">
                                        <td class="px-6 py-4">
                                            <template x-if="item.skpd">
                                                <span x-text="item.skpd.nm_skpd"></span>
                                            </template>
                                            <template x-if="!item.skpd">
                                                -
                                            </template>
                                        </td>
                                    </template>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold inline-block"
                                            :class="item.status_color" x-text="item.status_label">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-slate-600 dark:text-slate-400 text-sm"
                                            x-text="formatDate(item.created_at)"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a :href="'/admin/pengajuan-keberatan/' + item.id_pengajuan"
                                                class="group relative p-2.5 text-slate-500 dark:text-slate-400 hover:text-white hover:bg-gradient-to-r from-blue-500 to-cyan-600 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md"
                                                title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            <button @click="confirmDelete(item.id_pengajuan)"
                                                class="group relative p-2.5 text-slate-500 dark:text-slate-400 hover:text-white hover:bg-gradient-to-r from-red-500 to-rose-600 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md"
                                                title="Hapus Pengajuan" x-show="['a', 'y', 't'].includes(item.status)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-200/50 dark:border-slate-700/50 bg-white/30 dark:bg-slate-800/30"
                x-show="!loading && items.length > 0">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-slate-600 dark:text-slate-400">
                        Menampilkan <span class="font-bold text-slate-900 dark:text-slate-100"
                            x-text="items.length"></span> dari <span
                            class="font-bold text-slate-900 dark:text-slate-100" x-text="pagination.total"></span> data
                    </div>
                    <div class="flex items-center gap-2">
                        <button @click="changePage(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"
                            class="px-4 py-2 bg-white/70 dark:bg-slate-700/70 backdrop-blur-sm border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-xl text-sm font-medium hover:bg-white dark:hover:bg-slate-700 disabled:opacity-40 disabled:cursor-not-allowed transition-all shadow-sm">
                            Sebelumnya
                        </button>
                        <button @click="changePage(pagination.next_page_url)" :disabled="!pagination.next_page_url"
                            class="px-4 py-2 bg-white/70 dark:bg-slate-700/70 backdrop-blur-sm border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-xl text-sm font-medium hover:bg-white dark:hover:bg-slate-700 disabled:opacity-40 disabled:cursor-not-allowed transition-all shadow-sm">
                            Berikutnya
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Feedback Modal with Glassmorphism -->
        <div x-show="showFeedbackModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showFeedbackModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" aria-hidden="true"
                    @click="showFeedbackModal = false">
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showFeedbackModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="glass-card inline-block align-bottom rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl w-full">
                    <form
                        :action="'/admin/pengajuan-keberatan/' + (selectedItem ? selectedItem.id_pengajuan : '') + '/feedback'"
                        method="POST">
                        @csrf
                        <div class="px-6 pt-6 pb-4">
                            <!-- Modal Header -->
                            <div class="flex items-center justify-between mb-6">
                                <h3
                                    class="text-2xl font-bold text-slate-900 dark:text-slate-100 flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                    </div>
                                    Detail & Balasan Pengajuan
                                </h3>
                                <button type="button" @click="showFeedbackModal = false"
                                    class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Detail Section -->
                            <div
                                class="bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-900 p-5 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 mb-6 max-h-96 overflow-y-auto">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <dt
                                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                            Nomor Pendaftaran</dt>
                                        <dd class="text-base font-bold text-slate-900 dark:text-slate-100"
                                            x-text="detailItem.no_pendaftaran || '-'"></dd>
                                    </div>
                                    <div class="space-y-1">
                                        <dt
                                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                            Nama Pemohon</dt>
                                        <dd class="text-base font-bold text-slate-900 dark:text-slate-100"
                                            x-text="detailItem.nama_pemohon || '-'"></dd>
                                    </div>
                                    <div class="space-y-1">
                                        <dt
                                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                            Nomor Telepon</dt>
                                        <dd class="text-base font-medium text-slate-700 dark:text-slate-300"
                                            x-text="formatPhone(detailItem.no_telp_pemohon)"></dd>
                                    </div>
                                    <div class="space-y-1">
                                        <dt
                                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                            Metode Respon</dt>
                                        <dd class="text-base font-medium text-slate-700 dark:text-slate-300">
                                            <span x-show="detailItem.metode_respon === 'whatsapp'"
                                                class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg text-xs font-semibold">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.374-5.03c0-5.445 4.43-9.873 9.878-9.873 2.636 0 5.115 1.026 6.977 2.891a9.825 9.825 0 012.895 6.974c-.003 5.449-4.434 9.877-9.882 9.877h.001z" />
                                                </svg>
                                                WhatsApp
                                            </span>
                                            <span
                                                x-show="detailItem.metode_respon === 'website' || !detailItem.metode_respon"
                                                class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg text-xs font-semibold">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                                </svg>
                                                Website
                                            </span>
                                        </dd>
                                    </div>
                                    <div class="md:col-span-2 space-y-1">
                                        <dt
                                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                            Alasan Keberatan</dt>
                                        <dd class="text-sm text-slate-700 dark:text-slate-300">
                                            <ul class="list-disc list-inside space-y-1">
                                                <template x-for="alasan in detailItem.alasan" :key="alasan">
                                                    <li x-text="alasan"></li>
                                                </template>
                                            </ul>
                                        </dd>
                                    </div>
                                    <div class="md:col-span-2 space-y-1">
                                        <dt
                                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                            Kasus Posisi</dt>
                                        <dd class="text-sm text-slate-700 dark:text-slate-300 whitespace-pre-wrap bg-white/50 dark:bg-slate-800/50 p-3 rounded-lg"
                                            x-text="detailItem.kasus || 'Tidak ada keterangan'"></dd>
                                    </div>
                                </div>
                            </div>

                            <!-- WhatsApp Contact Option -->
                            <div
                                class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 rounded-xl">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.374-5.03c0-5.445 4.43-9.873 9.878-9.873 2.636 0 5.115 1.026 6.977 2.891a9.825 9.825 0 012.895 6.974c-.003 5.449-4.434 9.877-9.882 9.877h.001z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-slate-900 dark:text-slate-100"
                                                x-text="detailItem.nama_pemohon"></div>
                                            <div class="text-xs text-slate-600 dark:text-slate-400"
                                                x-text="formatPhone(detailItem.no_telp_pemohon)"></div>
                                        </div>
                                    </div>
                                    <a :href="getWhatsAppLink(detailItem)" target="_blank"
                                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                                        <span>Chat via WhatsApp</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Feedback Form -->
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Balasan
                                        Admin</label>
                                    <textarea name="feedback" rows="5" x-model="feedbackText"
                                        class="w-full rounded-xl border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                                        placeholder="Tulis balasan untuk pengajuan keberatan ini..."></textarea>
                                </div>

                                <!-- Previous Feedback Display -->
                                <div x-show="existingFeedback"
                                    class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl">
                                    <div class="flex items-start gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-xs font-semibold text-blue-900 dark:text-blue-200 mb-1">
                                                Balasan Sebelumnya:</p>
                                            <p class="text-sm text-blue-800 dark:text-blue-300"
                                                x-text="existingFeedback"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div
                            class="px-6 py-4 bg-slate-50/50 dark:bg-slate-800/50 border-t border-slate-200/50 dark:border-slate-700/50 flex justify-end gap-3">
                            <button type="button" @click="showFeedbackModal = false"
                                class="px-5 py-2.5 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-xl text-sm font-medium hover:bg-white dark:hover:bg-slate-700 transition-all shadow-sm">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                    Kirim Balasan
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <x-confirmation-dialog trigger="showDeleteModal" title="Hapus Pengajuan Keberatan?"
            description="Tindakan ini akan menghapus pengajuan keberatan secara permanen. Pengajuan yang masih dalam proses tidak dapat dihapus."
            theme="danger" confirmText="Ya, Hapus" @confirm="deleteItem()" />
    </div>

    <script>
        function keberatanDataTable() {
            return {
                loading: true,
                items: [],
                pagination: {},
                search: '',
                statusFilter: '',
                isAdmin: {{ auth()->user()->hasRole('admin') ? 'true' : 'false' }},

                // Feedback Modal State
                showFeedbackModal: false,
                selectedItem: null,
                detailItem: {},
                feedbackText: '',
                existingFeedback: null,

                // Delete Modal State
                showDeleteModal: false,
                deleteId: null,

                async fetchData(url = null) {
                    this.loading = true;
                    const params = new URLSearchParams();
                    if (this.search) params.append('search', this.search);
                    if (this.statusFilter) params.append('status', this.statusFilter);

                    const targetUrl = url || `/admin/pengajuan-keberatan?${params.toString()}`;

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
                        console.error("Error fetching data:", error);
                    } finally {
                        this.loading = false;
                    }
                },

                changePage(url) {
                    if (url) this.fetchData(url);
                },

                formatDate(dateStr) {
                    if (!dateStr) return '-';
                    return new Date(dateStr).toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                    });
                },

                getStatusClass(status) {
                    if (status == 'y') return 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-900/30 dark:text-emerald-300 dark:border-emerald-700';
                    if (status == 't') return 'bg-rose-50 text-rose-700 border-rose-200 dark:bg-rose-900/30 dark:text-rose-300 dark:border-rose-700';
                    if (status == 'a') return 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-700';
                    return 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-900/30 dark:text-amber-300 dark:border-amber-700';
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
                    this.detailItem = {};
                    this.showFeedbackModal = true;

                    try {
                        const response = await fetch(`/admin/pengajuan-keberatan/${item.id_pengajuan}/feedback`);
                        const data = await response.json();

                        this.detailItem = {
                            no_pendaftaran: data.no_pendaftaran,
                            nama_pemohon: data.nama_pemohon,
                            alasan: data.alasan,
                            kasus: data.kasus,
                            no_telp_pemohon: data.no_telp_pemohon,
                            metode_respon: data.metode_respon
                        };

                        if (data.feedback) {
                            this.feedbackText = data.feedback;
                            this.existingFeedback = data.feedback;
                        }
                    } catch (e) {
                        console.error("Failed to load feedback details", e);
                    }
                },

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
                },

                confirmDelete(id) {
                    this.deleteId = id;
                    this.showDeleteModal = true;
                },

                deleteItem() {
                    if (!this.deleteId) return;

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/pengajuan-keberatan/${this.deleteId}`;

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            }
        }
    </script>
</x-admin-layout>