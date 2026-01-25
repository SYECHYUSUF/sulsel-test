<x-admin-layout>
    <x-slot:title>Manajemen Berita</x-slot:title>

    <x-slot:extra_head>
        <style>
            /* Animasi Shimmer Kustom */
            .animate-pulse {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: .5; }
            }
            /* Transisi antar data yang halus */
            ::view-transition-old(root),
            ::view-transition-new(root) {
                animation-duration: 0.3s;
            }
        </style>
    </x-slot:extra_head>

    <div x-data="newsDataTable()" x-init="fetchData()" class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Daftar Berita</h1>
                <p class="text-slate-500 text-sm">Kelola informasi dan berita sektoral SKPD.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input 
                        type="text" 
                        x-model="search" 
                        @input.debounce.500ms="fetchData()" 
                        placeholder="Cari berita..." 
                        class="pl-10 pr-4 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full md:w-64 text-sm transition-all"
                    >
                    <div class="absolute left-3 top-2.5 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-colors shadow-sm gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Berita
                </a>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-semibold">
                        <tr>
                            <th class="px-6 py-4">Berita</th>
                            <th class="px-6 py-4">SKPD Pengirim</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Tanggal Upload</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <template x-if="loading">
                            <template x-for="i in 5" :key="i">
                                <tr class="animate-pulse">
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-100 rounded w-3/4 mb-2"></div>
                                        <div class="h-3 bg-slate-50 rounded w-1/2"></div>
                                    </td>
                                    <td class="px-6 py-4"><div class="h-4 bg-slate-100 rounded w-1/2"></div></td>
                                    <td class="px-6 py-4"><div class="h-6 bg-slate-100 rounded-full w-16"></div></td>
                                    <td class="px-6 py-4"><div class="h-4 bg-slate-100 rounded w-24"></div></td>
                                    <td class="px-6 py-4 text-right"><div class="h-8 bg-slate-100 rounded-lg w-12 ml-auto"></div></td>
                                </tr>
                            </template>
                        </template>

                        <template x-if="!loading && news.length === 0">
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    Data berita tidak ditemukan.
                                </td>
                            </tr>
                        </template>

                        <template x-if="!loading">
                            <template x-for="item in news" :key="item.id_berita">
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900 line-clamp-1" x-text="item.judul"></div>
                                        <div class="text-xs text-slate-400 mt-1" x-text="'ID: #' + item.id_berita"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-slate-600" x-text="item.skpd ? item.skpd.nm_skpd : '-'"></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span :class="{
                                            'bg-emerald-50 text-emerald-700 border-emerald-100': item.verify === 'y',
                                            'bg-rose-50 text-rose-700 border-rose-100': item.verify === 'n',
                                            'bg-amber-50 text-amber-700 border-amber-100': item.verify === 't'
                                        }" class="px-2.5 py-1 rounded-full text-xs font-medium border" x-text="getStatusLabel(item.verify)"></span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500" x-text="formatDate(item.tgl_upload)"></td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a :href="'/admin/berita/' + item.id_berita + '/edit'" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between gap-4 py-2" x-show="!loading && news.length > 0">
            <div class="text-sm text-slate-500">
                Menampilkan <span class="font-medium text-slate-900" x-text="news.length"></span> data dari <span class="font-medium text-slate-900" x-text="pagination.total"></span> total berita
            </div>
            <div class="flex items-center gap-2">
                <button 
                    @click="changePage(pagination.prev_page_url)" 
                    :disabled="!pagination.prev_page_url"
                    class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-medium hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                >
                    Sebelumnya
                </button>
                <button 
                    @click="changePage(pagination.next_page_url)" 
                    :disabled="!pagination.next_page_url"
                    class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-medium hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                >
                    Berikutnya
                </button>
            </div>
        </div>
    </div>

    <script>
        function newsDataTable() {
            return {
                loading: true,
                news: [],
                pagination: {},
                search: '',
                
                async fetchData(url = null) {
                    this.loading = true;
                    const targetUrl = url || `/admin/berita?search=${encodeURIComponent(this.search)}`;
                    
                    try {
                        const response = await fetch(targetUrl, {
                            headers: { 'Accept': 'application/json' }
                        });
                        const data = await response.json();

                        // View Transition API Support
                        if (document.startViewTransition) {
                            document.startViewTransition(() => {
                                this.updateState(data);
                            });
                        } else {
                            this.updateState(data);
                        }
                    } catch (error) {
                        console.error("Fetch error:", error);
                    } finally {
                        this.loading = false;
                    }
                },

                updateState(data) {
                    this.news = data.data;
                    this.pagination = {
                        next_page_url: data.next_page_url,
                        prev_page_url: data.prev_page_url,
                        total: data.total
                    };
                },

                changePage(url) {
                    if (url) this.fetchData(url);
                },

                getStatusLabel(val) {
                    if (val === 'y') return 'Terverifikasi';
                    if (val === 'n') return 'Ditolak';
                    return 'Pending';
                },

                formatDate(dateStr) {
                    return new Date(dateStr).toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                }
            }
        }
    </script>
</x-admin-layout>