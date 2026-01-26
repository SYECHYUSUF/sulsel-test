<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-8">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-[#1A305E] dark:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-medium">{{ __('messages.header.services') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-bold">{{ __('messages.objection.title') }}</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-2">
                        {{ __('messages.objection.title') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('messages.objection.subtitle') }}
                    </p>
                </div>
                <div class="hidden md:block">
                     <div class="w-24 h-1.5 bg-gradient-to-r from-[#1A305E] to-[#D4AF37] rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-12 md:py-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                
                {{-- Form Container --}}
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 p-8 md:p-10">
                    <div class="text-center mb-10">
                         <div class="w-16 h-16 bg-[#1A305E]/5 text-[#1A305E] dark:text-white rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-[#1A305E] dark:text-white mb-2">
                            {{ __('messages.objection.form_title') }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300">
                            {{ __('messages.objection.form_desc') }}
                        </p>
                    </div>

                    <form action="{{ route('layanan.pengajuan-keberatan.store') }}" method="POST" class="space-y-8">
                        @csrf
                        
                        {{-- Top Section --}}
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-[#1A305E] dark:text-white border-b border-gray-100 pb-2">
                                {{ __('messages.objection.title') }}
                            </h3>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.reg_no') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="no_pendaftaran" placeholder="{{ __('messages.objection.reg_no_placeholder') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.purpose') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="tujuan" placeholder="{{ __('messages.objection.purpose_placeholder') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                            </div>
                        </div>

                        {{-- Pengirim --}}
                        <div class="bg-[#1A305E]/5 p-6 rounded-xl border border-[#1A305E]/10">
                            <label class="block text-sm font-bold text-[#1A305E] dark:text-white mb-3">
                                {{ __('messages.objection.sender_section') }}
                            </label>
                            <div class="flex flex-col sm:flex-row gap-6">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative flex items-center justify-center w-5 h-5">
                                        <input type="radio" name="pengirim" value="pemohon" class="peer appearance-none w-5 h-5 border-2 border-gray-400 rounded-full checked:border-[#D4AF37] checked:bg-[#D4AF37] transition-all" checked />
                                        <div class="absolute w-2.5 h-2.5 bg-white dark:bg-slate-800 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                    </div>
                                    <span class="text-gray-700 font-medium group-hover:text-[#1A305E] dark:text-white">{{ __('messages.objection.applicant') }}</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                     <div class="relative flex items-center justify-center w-5 h-5">
                                        <input type="radio" name="pengirim" value="kuasa" class="peer appearance-none w-5 h-5 border-2 border-gray-400 rounded-full checked:border-[#D4AF37] checked:bg-[#D4AF37] transition-all" />
                                        <div class="absolute w-2.5 h-2.5 bg-white dark:bg-slate-800 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                    </div>
                                    <span class="text-gray-700 font-medium group-hover:text-[#1A305E] dark:text-white">{{ __('messages.objection.proxy') }}</span>
                                </label>
                            </div>
                        </div>

                        {{-- Identitas --}}
                        <div class="space-y-6">
                             <h3 class="text-lg font-bold text-[#1A305E] dark:text-white flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">1</span>
                                {{ __('messages.objection.id_section_1') }}
                            </h3>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.name') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_pemohon" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.address') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="alamat_pemohon" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.street') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="address_pemohon" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.apt') }}</label>
                                <input type="text" name="apt_pemohon" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.city') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="city_pemohon" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.state') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="state_pemohon" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.country') }}</label>
                                <input type="text" value="Indonesia" class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed" disabled />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.job') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="pekerjaan_pemohon" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.phone') }} <span class="text-red-500">*</span></label>
                                <input type="tel" name="no_telp_pemohon" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.email') }} <span class="text-red-500">*</span></label>
                                <input type="email" name="email_pemohon" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                            </div>
                        </div>

                         {{-- Identitas Kuasa (Optional/Separated) --}}
                         <div class="space-y-6">
                             <h3 class="text-lg font-bold text-[#1A305E] dark:text-white flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">2</span>
                                {{ __('messages.objection.id_section_2') }}
                            </h3>
                             <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.name_proxy') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_kuasa" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.address') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="alamat_kuasa" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.street') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="address_kuasa" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.apt') }}</label>
                                <input type="text" name="apt_kuasa" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.city') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="city_kuasa" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" />
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.state') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="state_kuasa" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.country') }}</label>
                                <input type="text" value="Indonesia" class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed" disabled />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.phone') }} <span class="text-red-500">*</span></label>
                                <input type="tel" name="no_telp_kuasa" placeholder="" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" />
                            </div>
                        </div>

                        {{-- Alasan & Kasus --}}
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-[#1A305E] dark:text-white flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">3</span>
                                {{ __('messages.objection.reason_section') }} <span class="text-red-500">*</span>
                            </h3>

                            <p class="text-xs text-gray-500">{{ __('messages.objection.reason_desc') }}</p>

                            <div class="space-y-3">
                                @php
                                    $reasons = [
                                        __('messages.objection.reasons.r1'),
                                        __('messages.objection.reasons.r2'),
                                        __('messages.objection.reasons.r3'),
                                        __('messages.objection.reasons.r4'),
                                        __('messages.objection.reasons.r5'),
                                        __('messages.objection.reasons.r6'),
                                        __('messages.objection.reasons.r7')
                                    ];
                                @endphp

                                @foreach ($reasons as $reason)
                                <div class="flex items-start gap-3">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" name="alasan[]" value="{{ $reason }}" class="w-4 h-4 rounded border-gray-300 text-[#1A305E] focus:ring-[#1A305E]">
                                    </div>
                                    <label class="text-sm text-gray-700 dark:text-gray-300 leading-tight">
                                        {{ $reason }}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <div class="space-y-2 pt-4">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('messages.objection.case_position') }} <span class="text-red-500">*</span></label>
                                <textarea name="kasus" rows="6" placeholder="{{ __('messages.objection.case_placeholder') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800 resize-none" required></textarea>
                            </div>
                        </div>
                        
                        {{-- Submit --}}
                        <div class="pt-6 flex justify-end">
                             <button type="submit" class="px-8 py-3.5 bg-[#1A305E] text-white font-bold rounded-lg hover:bg-[#1A305E]/90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                                {{ __('messages.objection.submit') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
