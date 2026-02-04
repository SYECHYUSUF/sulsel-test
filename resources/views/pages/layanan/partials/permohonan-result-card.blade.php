<div
    class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border-2 border-slate-100 dark:border-slate-700 overflow-hidden">

    {{-- Card Header --}}
    <div
        class="p-6 bg-slate-50 dark:bg-slate-700/30 border-b-2 border-slate-100 dark:border-slate-700 flex flex-wrap justify-between items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-[#1A305E] rounded-xl shadow-md">
                <svg class="w-7 h-7 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            <div>
                <div class="text-lg font-bold text-slate-900 dark:text-white" x-text="item.email"></div>
                <div class="text-sm text-slate-500"
                    x-text="new Date(item.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })">
                </div>
            </div>
        </div>

        <span class="px-5 py-2 rounded-xl text-sm font-bold text-white shadow-md" :class="{
            'bg-amber-500': item.status == 0,
            'bg-emerald-600': item.status == 1 || item.status == 2,
            'bg-rose-600': item.status == 3,
            'bg-slate-500': item.status == 4,
            'bg-indigo-600': item.status == 5
        }" x-text="item.status_label_display"></span>
    </div>

    {{-- Card Body --}}
    <div class="p-8 grid lg:grid-cols-2 gap-8">
        {{-- Left: Details --}}
        <div>
            <label class="flex items-center gap-2 text-xs font-bold text-[#D4AF37] uppercase tracking-wider mb-3">
                <span>{{ __('messages.status.subject') }}</span>
            </label>
            <p class="text-lg font-bold text-[#1A305E] dark:text-white leading-relaxed" x-text="item.rincian"></p>
        </div>

        {{-- Only show these sections if NOT disposisi status --}}
        <template x-if="item.status != 5">
            {{-- Right: Response & Handler --}}
            <div class="space-y-6">
                <div class="bg-gradient-to-br from-[#1A305E] to-[#2a4a7c] rounded-2xl p-5 text-white shadow-lg">
                    <p class="text-xs font-bold text-[#D4AF37] uppercase mb-1">
                        {{ __('messages.status.handled_by') }}
                    </p>
                    <p class="text-lg font-bold" x-text="item.skpd ? item.skpd.nm_skpd : 'Admin PPID Sulsel'"></p>
                </div>

                <div>
                    <label
                        class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3 block">{{ __('messages.status.response') }}</label>
                    <div
                        class="bg-slate-50 dark:bg-slate-900 rounded-2xl p-6 border-2 border-slate-100 dark:border-slate-700 min-h-[100px]">
                        {{-- Conditional Response Templates --}}
                        <template x-if="item.status == 0">
                            <p class="text-slate-600 italic">{{ __('messages.status.waiting_admin') }}</p>
                        </template>

                        <template x-if="item.jawaban && item.status != 0">
                            <p class="text-slate-800 dark:text-slate-200 whitespace-pre-line" x-text="item.jawaban"></p>
                        </template>

                        <template x-if="item.status == 3">
                            <div class="text-red-600 font-medium">
                                <p class="font-bold mb-1">Permohonan Ditolak</p>
                                <p class="text-sm" x-text="item.alasan"></p>
                            </div>
                        </template>

                        <template x-if="!item.jawaban && item.status != 0 && item.status != 3">
                            <p class="text-slate-400 italic">Belum ada respon resmi.</p>
                        </template>

                        {{-- File Download --}}
                        <template x-if="item.file">
                            <div class="mt-4 pt-4 border-t border-slate-200">
                                <a :href="`/storage/${item.file}`" target="_blank"
                                    class="inline-flex items-center gap-2 text-[#1A305E] dark:text-[#D4AF37] font-bold hover:underline">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    {{ __('messages.status.download_attachment') }}
                                </a>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </template>

        {{-- SKPD Disposisi Tracking (Public View) --}}
        <template x-if="item.disposisi && item.disposisi.length > 0">
            <div class="mt-6 pt-6 border-slate-200 dark:border-slate-700">
                <label class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider mb-4 block">
                    {{ __('messages.status.tracking_disposition') }}
                </label>
                <div class="space-y-4">
                    <template x-for="(disp, index) in item.disposisi" :key="index">
                        <div
                            class="bg-slate-100 dark:bg-slate-900 rounded-2xl p-5 border-2 border-slate-200 dark:border-slate-700">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h5 class="font-bold text-[#1A305E] dark:text-white"
                                        x-text="disp.skpd ? disp.skpd.nm_skpd : 'SKPD'"></h5>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Disposisi: <span
                                            x-text="new Date(disp.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })"></span>
                                    </p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold" :class="{
                                        'bg-yellow-100 text-yellow-800': disp.status === 'pending',
                                        'bg-blue-100 text-blue-800': disp.status === 'diproses',
                                        'bg-green-100 text-green-800': disp.status === 'selesai',
                                        'bg-red-100 text-red-800': disp.status === 'ditolak'
                                    }" x-text="disp.status.charAt(0).toUpperCase() + disp.status.slice(1)">
                                </span>
                            </div>

                            {{-- Catatan Disposisi --}}
                            <template x-if="disp.catatan_disposisi">
                                <div
                                    class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-xl p-3 mb-3">
                                    <p class="text-xs font-semibold text-blue-800 dark:text-blue-300 mb-1">Catatan
                                        Admin:</p>
                                    <p class="text-sm text-blue-700 dark:text-blue-200" x-text="disp.catatan_disposisi">
                                    </p>
                                </div>
                            </template>

                            {{-- Respon SKPD --}}
                            <template x-if="disp.respon && disp.respon.length > 0">
                                <div>
                                    <template x-for="(resp, respIndex) in disp.respon" :key="respIndex">
                                        <div
                                            class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl p-4 mb-2">
                                            <p class="text-xs font-semibold text-green-800 dark:text-green-300 mb-2">
                                                {{ __('messages.status.skpd_response') }} (<span
                                                    x-text="new Date(resp.responded_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' })"></span>):
                                            </p>
                                            <p class="text-sm text-slate-700 dark:text-slate-200 whitespace-pre-line"
                                                x-text="resp.respon"></p>

                                            <template x-if="resp.file">
                                                <a :href="`/storage/${resp.file}`" target="_blank"
                                                    class="inline-flex items-center gap-2 text-green-600 dark:text-green-400 font-bold hover:underline mt-3 text-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                    Download Lampiran Respon
                                                </a>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <template x-if="!disp.respon || disp.respon.length === 0">
                                <p class="text-slate-500 dark:text-slate-400 italic text-sm">Belum ada respon dari SKPD
                                    ini.</p>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </div>
</div>