<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-[#1A305E] dark:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-4 h-4 text-gray-400">
                    <path d="m9 18 6-6-6-6" />
                </svg>
                <span class="text-[#1A305E] dark:text-white font-medium">Daftar Informasi Publik</span>
            </div>

            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-2">
                        Daftar Informasi Publik
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Daftar lengkap informasi publik yang tersedia
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-20 h-1 bg-gradient-to-r from-[#1A305E] to-transparent rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-10 md:py-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">

                {{-- Info Banner --}}
                <div class="bg-[#1A305E] text-white rounded-xl p-6 mb-8">
                    <div class="flex items-start gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="w-6 h-6 flex-shrink-0 mt-0.5">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                            <polyline points="14 2 14 8 20 8" />
                            <path d="M16 13H8" />
                            <path d="M16 17H8" />
                            <path d="M10 9H8" />
                        </svg>
                        <div>
                            <h2 class="font-bold text-lg mb-2">Daftar Informasi Publik</h2>
                            <p class="text-white/90 text-sm leading-relaxed">
                                Berikut adalah daftar lengkap informasi publik yang tersedia di Pemerintah Provinsi
                                Sulawesi Selatan sesuai dengan UU No. 14 Tahun 2008 tentang Keterbukaan Informasi
                                Publik.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Table --}}
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                    <div
                        class="border-b border-gray-200 dark:border-slate-700 px-6 py-4 flex items-center justify-between bg-gray-50 dark:bg-slate-900">
                        <h3 class="font-bold text-gray-900 dark:text-white">Daftar Informasi Publik</h3>
                        <button
                            class="flex items-center gap-2 text-[#1A305E] dark:text-white hover:text-[#D4AF37] text-sm font-medium transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-4 h-4">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="7 10 12 15 17 10" />
                                <line x1="12" x2="12" y1="15" y2="3" />
                            </svg>
                            Export Data
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-[#1A305E] text-white">
                                <tr>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">No</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">
                                        {{ \App\Models\MatriksDip::columnLabels()['a'] }}</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">
                                        {{ \App\Models\MatriksDip::columnLabels()['b'] }}</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">
                                        {{ \App\Models\MatriksDip::columnLabels()['c'] }}</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">
                                        {{ \App\Models\MatriksDip::columnLabels()['d'] }}</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">
                                        {{ \App\Models\MatriksDip::columnLabels()['e'] }}</th>
                                    <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide">
                                        {{ \App\Models\MatriksDip::columnLabels()['f'] }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($matriksDip as $item)
                                    <tr
                                        class="hover:bg-[#1A305E]/5 transition-colors border-b border-gray-100 last:border-0">
                                        <td
                                            class="px-4 py-3 text-sm text-gray-900 dark:text-white font-medium whitespace-nowrap">
                                            {{ ($matriksDip->currentPage() - 1) * $matriksDip->perPage() + $loop->iteration }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-700 min-w-[200px]">{{ $item->a }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 min-w-[250px]">{{ $item->b }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 min-w-[150px]">{{ $item->c }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300 min-w-[150px]">
                                            {{ $item->d }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                            {{ $item->e }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                            {{ $item->f }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Footer Info --}}
                    <div class="border-t border-gray-200 dark:border-slate-700 px-6 py-4 bg-gray-50 dark:bg-slate-900">
                        <div class="flex flex-col md:flex-row justify-center items-center gap-4">


                            <div class="pagination-wrapper">
                                {{ $matriksDip->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>