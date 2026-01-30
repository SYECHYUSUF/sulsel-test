            {{-- SKPD Disposisi Tracking --}}
            @if($permohonan->disposisi->isNotEmpty())
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Tracking Disposisi SKPD</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Status dan respon dari setiap SKPD yang menerima disposisi</p>
                    </div>
                    <div class="p-6 space-y-4">
                        @foreach($permohonan->disposisi as $disp)
                            <div class="border border-slate-200 dark:border-slate-700 rounded-lg p-4">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h4 class="font-bold text-slate-900 dark:text-white">{{ $disp->skpd->nm_skpd }}</h4>
                                        <p class="text-xs text-slate-500 mt-1">Disposisi: {{ $disp->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $disp->status_color }}">
                                        {{ $disp->status_label }}
                                    </span>
                                </div>

                                @if($disp->catatan_disposisi)
                                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 rounded-lg p-3 mb-3">
                                        <p class="text-xs font-semibold text-blue-800 dark:text-blue-300 mb-1">Catatan:</p>
                                        <p class="text-sm text-blue-700 dark:text-blue-200">{{ $disp->catatan_disposisi }}</p>
                                    </div>
                                @endif

                                @if($disp->respon->isNotEmpty())
                                    @foreach($disp->respon as $resp)
                                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-lg p-3">
                                            <p class="text-xs font-semibold text-green-800 dark:text-green-300 mb-1">
                                                Respon SKPD ({{ $resp->responded_at->format('d M Y H:i') }}):
                                            </p>
                                            <p class="text-sm text-slate-700 dark:text-slate-300">{{ $resp->respon }}</p>
                                            
                                            @if($resp->file)
                                                <a href="{{ Storage::url($resp->file) }}" target="_blank" 
                                                    class="inline-flex items-center gap-2 text-green-600 dark:text-green-400 text-sm font-medium hover:underline mt-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    Download Lampiran Respon
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    {{-- Response Form for SKPD --}}
                                    @if(Auth::user()->hasRole('opd') && Auth::user()->id_skpd === $disp->id_skpd && $disp->status !== 'selesai' && $disp->status !== 'ditolak')
                                        <form action="{{ route('admin.permohonan-informasi.respon.store', $disp->id_disposisi) }}" 
                                              method="POST" 
                                              enctype="multipart/form-data"
                                            >
                                            @csrf                                            
                                            <div class="space-y-3">
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                                        Status <span class="text-red-500">*</span>
                                                    </label>
                                                    <select name="status" required
                                                        class="w-full px-3 py-2 text-sm border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg focus:ring-2 focus:ring-[#1A305E]">
                                                        <option value="">Pilih Status</option>
                                                        <option value="diproses">Sedang Diproses</option>
                                                        <option value="selesai">Selesai</option>
                                                        <option value="ditolak">Ditolak</option>
                                                    </select>
                                                </div>
                                                
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                                        Respon <span class="text-red-500">*</span>
                                                    </label>
                                                    <textarea name="respon" rows="4" required
                                                        class="w-full px-3 py-2 text-sm border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg focus:ring-2 focus:ring-[#1A305E]"
                                                        placeholder="Tuliskan respon atau jawaban untuk permohonan ini..."></textarea>
                                                </div>
                                                
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                                        Lampiran File (Opsional)
                                                    </label>
                                                    <input type="file" name="file" accept=".pdf,.doc,.docx,.jpg,.png"
                                                        class="w-full text-sm text-slate-500 dark:text-slate-400
                                                               file:mr-4 file:py-2 file:px-4
                                                               file:rounded-lg file:border-0
                                                               file:text-sm file:font-semibold
                                                               file:bg-[#1A305E] file:text-white
                                                               hover:file:bg-blue-800 file:cursor-pointer">
                                                    <p class="text-xs text-slate-500 mt-1">PDF, DOC, DOCX, JPG, PNG (Max 5MB)</p>
                                                </div>
                                                
                                                <button type="submit"
                                                    class="w-full px-4 py-2 bg-gradient-to-r from-[#1A305E] to-blue-700 text-white text-sm font-bold rounded-lg hover:shadow-lg transition-all transform hover:scale-[1.02]">
                                                    Kirim Respon
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <p class="text-slate-500 dark:text-slate-400 italic text-sm">Belum ada respon dari SKPD ini.</p>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
