<x-admin-layout>
    <x-slot:title>Manajemen FAQ</x-slot:title>

    <x-slot:extra_head>
        <style>
            /* Animasi Shimmer Kustom */
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

            /* Transisi antar data yang halus */
            ::view-transition-old(root),
            ::view-transition-new(root) {
                animation-duration: 0.3s;
            }
        </style>
    </x-slot:extra_head>

    <div x-data="faqDataTable()" x-init="fetchData()" class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Daftar FAQ</h1>
                <p class="text-slate-500 text-sm">Kelola pertanyaan yang sering diajukan.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input type="text" x-model="search" @input.debounce.500ms="fetchData()"
                        placeholder="Cari pertanyaan..."
                        class="pl-10 pr-4 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full md:w-64 text-sm transition-all">
                    <div class="absolute left-3 top-2.5 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.faq.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-colors shadow-sm gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah FAQ
                </a>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-semibold">
                        <tr>
                            <th class="px-6 py-4">Pertanyaan</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Urutan</th>
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
                                    <td class="px-6 py-4">
                                        <div class="h-6 bg-slate-100 rounded-full w-16"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-100 rounded w-10"></div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="h-8 bg-slate-100 rounded-lg w-12 ml-auto"></div>
                                    </td>
                                </tr>
                            </template>
                        </template>

                        <template x-if="!loading && faqs.length === 0">
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    Data FAQ tidak ditemukan.
                                </td>
                            </tr>
                        </template>

                        <template x-if="!loading">
                            <template x-for="item in faqs" :key="item.id_faq">
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900 line-clamp-2" x-text="item.pertanyaan">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span :class="{
                                            'bg-emerald-50 text-emerald-700 border-emerald-100': item.is_active,
                                            'bg-slate-50 text-slate-700 border-slate-100': !item.is_active
                                        }" class="px-2.5 py-1 rounded-full text-xs font-medium border"
                                            x-text="item.is_active ? 'Aktif' : 'Non-Aktif'"></span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500" x-text="item.urutan || '-'"></td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a :href="'/admin/faq/' + item.id_faq"
                                                class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all"
                                                title="Lihat">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a :href="'/admin/faq/' + item.id_faq + '/edit'"
                                                class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form :action="'/admin/faq/' + item.id_faq" method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between gap-4 py-2"
            x-show="!loading && faqs.length > 0">
            <div class="text-sm text-slate-500">
                Menampilkan <span class="font-medium text-slate-900" x-text="faqs.length"></span> data dari <span
                    class="font-medium text-slate-900" x-text="pagination.total"></span> total FAQ
            </div>
            <div class="flex items-center gap-2">
                <button @click="changePage(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"
                    class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-medium hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                    Sebelumnya
                </button>
                <button @click="changePage(pagination.next_page_url)" :disabled="!pagination.next_page_url"
                    class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-medium hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                    Berikutnya
                </button>
            </div>
        </div>
    </div>

    <script>
        function faqDataTable() {
            return {
                loading: true,
                faqs: [],
                pagination: {},
                search: '',

                async fetchData(url = null) {
                    this.loading = true;
                    const targetUrl = url || `/admin/faq?search=${encodeURIComponent(this.search)}`;

                    try {
                        const response = await fetch(targetUrl, {
                            headers: { 'Accept': 'application/json' }
                        });
                        const data = await response.json();

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
                    this.faqs = data.data;
                    this.pagination = {
                        next_page_url: data.next_page_url,
                        prev_page_url: data.prev_page_url,
                        total: data.total
                    };
                },

                changePage(url) {
                    if (url) this.fetchData(url);
                }
            }
        }
    </script>
</x-admin-layout>