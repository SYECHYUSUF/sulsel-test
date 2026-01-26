<x-admin-layout>
    <x-slot:title>Manajemen Permohonan Informasi</x-slot:title>

    <x-slot:extra_head>
        <style>
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

    <div x-data="usersTable()" x-init="fetchData()" class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Manajemen User</h1>
                <p class="text-slate-500 text-sm">Kelola akun pengguna, peran, dan akses SKPD mereka dalam sistem.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input type="text" x-model="search" @input.debounce.500ms="fetchData()"
                        placeholder="Cari user..."
                        class="pl-10 pr-4 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full md:w-64 text-sm transition-all">
                    <div class="absolute left-3 top-2.5 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-semibold">
                        <tr>
                            <th class="px-6 py-4">Nama & Username</th>
                            <th class="px-6 py-4">SKPD</th>
                            <th class="px-6 py-4">Terakhir Login</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <template x-if="loading">
                            <template x-for="i in 5" :key="i">
                                <tr class="animate-pulse">
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-100 rounded w-3/4"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-100 rounded w-1/2"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-6 bg-slate-100 rounded-full w-16"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="h-4 bg-slate-100 rounded w-20"></div>
                                    </td>
                                </tr>
                            </template>
                        </template>

                        <template x-if="!loading && items.length === 0">
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    Tidak ada data user.
                                </td>
                            </tr>
                        </template>

                        <template x-if="!loading">
                            <template x-for="item in items" :key="item.id">
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900" x-text="item.name"></div>
                                        <div class="text-xs text-slate-400" x-text="item.username"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900" 
                                            x-text="item.skpd ? item.skpd.nm_skpd : '-'">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-slate-700" 
                                                x-text="item.last_login ? formatDate(item.last_login.createdAt) : '-'">
                                            </span>
                                            <span class="text-[10px] text-slate-400" 
                                                x-show="item.last_login" 
                                                x-text="'IP: ' + item.last_login.ip">
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a :href="'/admin/users/' + item.id"
                                            class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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

        <div class="flex flex-col md:flex-row items-center justify-between gap-4 py-2"
            x-show="!loading && items.length > 0">
            <div class="text-sm text-slate-500">
                Menampilkan <span class="font-medium text-slate-900" x-text="items.length"></span> dari <span
                    class="font-medium text-slate-900" x-text="pagination.total"></span> data
            </div>
            <div class="flex items-center gap-2">
                <button @click="changePage(pagination.prev_page_url)" :disabled="!pagination.prev_page_url"
                    class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-medium hover:bg-slate-50 disabled:opacity-50 transition-colors">Sebelumnya</button>
                <button @click="changePage(pagination.next_page_url)" :disabled="!pagination.next_page_url"
                    class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-medium hover:bg-slate-50 disabled:opacity-50 transition-colors">Berikutnya</button>
            </div>
        </div>
    </div>

    <script>
        function usersTable() {
            return {
                loading: true,
                items: [],
                pagination: {},
                search: '',

                async fetchData(url = null) {
                    this.loading = true;
                    const targetUrl = url || `/admin/users?search=${encodeURIComponent(this.search)}`;

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