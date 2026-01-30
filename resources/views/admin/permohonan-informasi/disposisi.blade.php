<x-admin-layout title="Disposisi Permohonan - Admin PPID">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.permohonan-informasi.show', $permohonan->id_permohonan) }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span>Disposisi Permohonan</span>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto" 
         x-data="{ 
             selectedSkpd: [],
             showConfirm: false,
             showSuccess: @if(session('success')) true @else false @endif,
             showScrollButton: true,
             checkScroll() {
                 const windowHeight = window.innerHeight;
                 const documentHeight = document.documentElement.scrollHeight;
                 const scrollPosition = window.scrollY;
                 // Hide if we are near bottom (e.g. 100px from bottom)
                 this.showScrollButton = (windowHeight + scrollPosition) < (documentHeight - 100);
             }
         }"
         @scroll.window="checkScroll()"
         x-init="checkScroll()"
         @confirm.window="document.getElementById('disposisiForm').submit()">
         
        <!-- Fixed Scroll Button -->
        <div class="fixed bottom-6 right-6 z-50 transition-all duration-300 transform"
             x-show="showScrollButton"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-10"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-10">
            <button @click="document.getElementById('disposisiForm').scrollIntoView({ behavior: 'smooth', block: 'center' })" 
                    class="flex items-center gap-2 px-5 py-3 bg-[#1A305E] text-white rounded-full shadow-lg hover:shadow-xl hover:bg-blue-800 transition-all border border-blue-400/20 group">
                <span class="font-semibold">Kirim Disposisi</span>
                <div class="bg-white/20 rounded-full p-1 group-hover:bg-white/30 transition-colors">
                    <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </button>
        </div>
        <!-- Header Card -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-[#1A305E] to-blue-700 p-6 text-white">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-white/10 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold mb-1">Disposisi Permohonan Informasi</h1>
                        <p class="text-blue-100 text-sm">Pilih OPD yang akan menangani permohonan ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Request Info -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden mb-6">
            <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Info Permohonan
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Nama Pemohon</label>
                        <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $permohonan->nama }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Email</label>
                        <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $permohonan->email }}</p>
                    </div>
                </div>
                <div>
                    <label class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold">Rincian Informasi</label>
                    <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $permohonan->rincian }}</p>
                </div>
            </div>
        </div>

        {{-- SKPD Selection Form --}}
        <form id="disposisiForm" action="{{ route('admin.permohonan-informasi.disposisi', $permohonan->id_permohonan) }}" method="POST">
            @csrf

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden mb-6">
                <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400 flex items-center gap-2">
                            Pilih OPD Tujuan
                        </h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Centang satu atau lebih OPD yang akan menerima disposisi</p>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-slate-500 dark:text-slate-400 mb-1">Dipilih</div>
                        <div class="text-2xl font-bold text-[#D4AF37]" x-text="selectedSkpd.length"></div>
                    </div>
                </div>

                <div class="p-6">
                    @error('skpd_ids')
                        <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg text-red-600 dark:text-red-400 text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($allSkpd as $skpd)
                            @php
                                $isDisposisied = in_array($skpd->id_skpd, $existingSkpdIds ?? []);
                            @endphp
                            <label class="relative flex items-start p-4 rounded-xl border-2 transition-all 
                                        {{ $isDisposisied ? 'bg-slate-50 dark:bg-slate-900 border-slate-100 dark:border-slate-800 opacity-70 cursor-not-allowed' : 'cursor-pointer hover:shadow-md' }}"
                                   :class="selectedSkpd.includes('{{ $skpd->id_skpd }}') ? 'border-[#1A305E] bg-[#1A305E]/5 dark:bg-[#1A305E]/20 shadow-lg' : '{{ $isDisposisied ? '' : 'border-slate-200 dark:border-slate-700 hover:border-[#D4AF37]' }}'">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" 
                                           name="skpd_ids[]" 
                                           value="{{ $skpd->id_skpd }}"
                                           x-model="selectedSkpd"
                                           class="h-5 w-5 text-[#1A305E] border-slate-300 rounded focus:ring-[#D4AF37] focus:ring-offset-0 {{ $isDisposisied ? 'cursor-not-allowed' : 'cursor-pointer' }}"
                                           {{ $isDisposisied ? 'disabled checked' : '' }}>
                                </div>
                                <div class="ml-3 flex-1">
                                    <span class="font-semibold text-slate-900 dark:text-slate-100 block">
                                        {{ $skpd->nm_skpd }}
                                    </span>
                                    @if($skpd->alias)
                                        <span class="text-xs text-slate-500 dark:text-slate-400">{{ $skpd->alias }}</span>
                                    @endif
                                    @if($isDisposisied)
                                        <span class="inline-block mt-1 px-2 py-0.5 bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-[10px] rounded font-semibold">
                                            Sudah Didisposisikan
                                        </span>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>

                    @if($allSkpd->isEmpty())
                        <div class="text-center py-12 text-slate-500 dark:text-slate-400">
                            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p class="font-semibold">Tidak ada OPD tersedia</p>
                        </div>
                    @endif

                    {{-- Catatan Disposisi --}}
                    <div class="mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Catatan Disposisi (Opsional)
                        </label>
                        <textarea name="catatan" rows="3"
                            class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E]"
                            placeholder="Tuliskan catatan atau instruksi khusus untuk OPD yang menerima disposisi..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 justify-end">
                <a href="{{ route('admin.permohonan-informasi.show', $permohonan->id_permohonan) }}"
                   class="px-6 py-3 bg-white dark:bg-slate-700 border-2 border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg font-semibold hover:bg-slate-50 dark:hover:bg-slate-600 transition-all">
                    Batal
                </a>
                <button type="button" @click="selectedSkpd.length > 0 ? showConfirm = true : alert('Pilih minimal 1 OPD!')"
                        class="px-6 py-3 bg-gradient-to-r from-[#1A305E] to-blue-700 text-white rounded-lg font-semibold hover:shadow-lg transition-all transform hover:scale-[1.02] flex items-center gap-2"
                        :disabled="selectedSkpd.length === 0"
                        :class="selectedSkpd.length === 0 ? 'opacity-50 cursor-not-allowed' : ''">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Kirim Disposisi
                    <span x-show="selectedSkpd.length > 0" class="px-2 py-0.5 bg-white/20 rounded-full text-sm" x-text="'(' + selectedSkpd.length + ')'"></span>
                </button>
            </div>
        </form>

        {{-- Confirmation Dialog --}}
        <x-confirmation-dialog
            trigger="showConfirm"
            title="Konfirmasi Disposisi"
            description="Apakah Anda yakin ingin mendisposisikan permohonan ini ke SKPD yang dipilih?"
            theme="primary"
            confirmText="Ya, Kirim"
            cancelText="Batal"
            url="#"
        />

        {{-- Success Notification --}}
        <x-notification-modal
            trigger="showSuccess"
            status="success"
            title="Disposisi Berhasil!"
            :description="session('success') ?? 'Permohonan berhasil didisposisikan.'"
        />
    </div>
</x-admin-layout>
