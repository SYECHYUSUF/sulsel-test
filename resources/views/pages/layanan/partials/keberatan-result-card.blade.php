<div
    class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border-2 border-slate-100 dark:border-slate-700 overflow-hidden">

    {{-- Card Header --}}
    <div
        class="p-6 bg-slate-50 dark:bg-slate-700/30 border-b-2 border-slate-100 dark:border-slate-700 flex flex-wrap justify-between items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-ppid-primary rounded-xl shadow-md">
                <svg class="w-7 h-7 text-ppid-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
            </div>
            <div>
                <div class="text-lg font-bold text-slate-900 dark:text-white" x-text="item.no_pendaftaran"></div>
                <div class="text-sm text-slate-500"
                    x-text="new Date(item.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })">
                </div>
            </div>
        </div>

        <span class="px-5 py-2 rounded-xl text-sm font-bold text-white shadow-md" :class="{
                'bg-red-500': item.display_status_code == 'belum_direspon',
                'bg-amber-500': item.status == 'p',
                'bg-emerald-600': item.status == 'y',
                'bg-rose-600': item.status == 't',
                'bg-indigo-600': item.status == 'a'
            }" x-text="item.status_label_display"></span>
    </div>

    {{-- Card Body --}}
    <div class="p-8 grid lg:grid-cols-2 gap-8">
        {{-- Left: Details --}}
        <div>
            <label class="flex items-center gap-2 text-xs font-bold text-ppid-accent uppercase tracking-wider mb-3">
                <span>Nama Pemohon</span>
            </label>
            <p class="text-lg font-bold text-ppid-primary dark:text-white leading-relaxed mb-6" x-text="item.nama_pemohon">
            </p>

            <label class="flex items-center gap-2 text-xs font-bold text-ppid-accent uppercase tracking-wider mb-3">
                <span>Kasus Posisi</span>
            </label>
            <p class="text-base text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-line"
                x-text="item.kasus"></p>
        </div>

        {{-- Right: Response --}}
        <div class="space-y-6">
            <div>
                <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3 block">Tanggapan
                    Admin</label>
                <div
                    class="bg-slate-50 dark:bg-slate-900 rounded-2xl p-6 border-2 border-slate-100 dark:border-slate-700 min-h-[100px]">
                    {{-- Conditional Response Templates --}}
                    <template x-if="item.status == 'p'">
                        <p class="text-slate-600 italic">Menunggu review dari admin...</p>
                    </template>

                    <template x-if="item.feedback && item.status != 'p'">
                        <p class="text-slate-800 dark:text-slate-200 whitespace-pre-line" x-text="item.feedback"></p>
                    </template>

                    <template x-if="item.status == 't'">
                        <div class="text-red-600 font-medium">
                            <p class="font-bold mb-1">Pengajuan Ditolak</p>
                            <p class="text-sm"
                                x-text="item.feedback || 'Silakan hubungi admin untuk informasi lebih lanjut.'"></p>
                        </div>
                    </template>

                    <template x-if="!item.feedback && item.status != 'p' && item.status != 't'">
                        <p class="text-slate-400 italic">Belum ada tanggapan resmi.</p>
                    </template>

                    {{-- Tanggal Feedback --}}
                    <template x-if="item.tgl_feedback">
                        <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700">
                            <p class="text-xs text-slate-500">
                                Dijawab pada: <span
                                    x-text="new Date(item.tgl_feedback).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })"></span>
                                <template x-if="item.feedback_by">
                                    <span> oleh <span class="font-semibold"
                                            x-text="item.feedback_by.name"></span></span>
                                </template>
                            </p>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>