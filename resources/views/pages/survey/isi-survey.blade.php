<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans'] ">
        <div class="container mx-auto px-4 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-ppid-primary dark:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-ppid-primary dark:text-white font-medium">{{ __('messages.breadcrumb.survey') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-ppid-primary dark:text-white font-medium">{{ __('messages.survey_pages.isi_title') }}</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-ppid-primary dark:text-white mb-2">
                        {{ __('messages.survey_form.title') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('messages.survey_form.subtitle') }}
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-20 h-1 bg-gradient-to-r from-ppid-primary to-transparent rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-10 md:py-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']" x-data="{ showSuccessModal: {{ session('success') ? 'true' : 'false' }} }">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                
                <div class="border-b border-gray-200 dark:border-slate-700 pb-6 mb-8">
                    <h2 class="text-2xl font-bold text-ppid-primary dark:text-white mb-3">{{ __('messages.survey_form.form_title') }}</h2>
                    <p class="text-base text-gray-600 dark:text-gray-300">{{ __('messages.survey_form.form_desc') }}</p>
                </div>

                <form method="POST" action="/survey/isi-survey" class="space-y-8">
                    @csrf
                    
                    {{-- Honeypot field for bot detection (hidden, must remain empty) --}}
                    <div style="position: absolute; left: -9999px; opacity: 0;" aria-hidden="true">
                        <input type="text" name="website" tabindex="-1" autocomplete="off" />
                    </div>
                    {{-- Timestamp for bot detection --}}
                    <input type="hidden" name="_form_timestamp" value="{{ time() }}" />
                    
                    {{-- Section: Data Responden --}}
                    <div class="bg-gradient-to-br from-blue-50 to-white dark:from-slate-900 dark:to-slate-800 p-8 rounded-2xl border-2 border-gray-200 dark:border-slate-700 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-ppid-primary text-white shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-ppid-primary dark:text-white">{{ __('messages.survey_form.respondent_data') }}</h3>
                        </div>
                        <div class="space-y-5">
                            <div class="space-y-2">
                                <label class="block text-base font-semibold text-gray-800 dark:text-gray-200">{{ __('messages.survey_form.email') }} <span class="text-red-500">*</span></label>
                                <input type="email" name="email" placeholder="contoh@email.com" required class="w-full px-5 py-3.5 text-base rounded-xl border-2 border-gray-300 dark:border-slate-600 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary outline-none transition-all bg-white dark:bg-slate-800 dark:text-white" value="{{ old('email') }}" />
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-base font-semibold text-gray-800 dark:text-gray-200">{{ __('messages.survey_form.name') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" placeholder="{{ __('messages.form.full_name') }}" required class="w-full px-5 py-3.5 text-base rounded-xl border-2 border-gray-300 dark:border-slate-600 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary outline-none transition-all bg-white dark:bg-slate-800 dark:text-white" value="{{ old('nama') }}" />
                                @error('nama')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-base font-semibold text-gray-800 dark:text-gray-200">{{ __('messages.survey_form.institution') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="lembaga" placeholder="{{ __('messages.survey_form.institution_placeholder') }}" required class="w-full px-5 py-3.5 text-base rounded-xl border-2 border-gray-300 dark:border-slate-600 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary outline-none transition-all bg-white dark:bg-slate-800 dark:text-white" value="{{ old('lembaga') }}" />
                                @error('lembaga')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-base font-semibold text-gray-800 dark:text-gray-200">{{ __('messages.survey_form.address') }} <span class="text-red-500">*</span></label>
                                <textarea rows="3" name="alamat" placeholder="{{ __('messages.form.applicant_address') }}" required class="w-full px-5 py-3.5 text-base rounded-xl border-2 border-gray-300 dark:border-slate-600 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary outline-none transition-all bg-white dark:bg-slate-800 dark:text-white resize-none">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-base font-semibold text-gray-800 dark:text-gray-200">{{ __('messages.survey_form.date') }} <span class="text-red-500">*</span></label>
                                <input type="date" name="tanggal" required class="w-full px-5 py-3.5 text-base rounded-xl border-2 border-gray-300 dark:border-slate-600 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary outline-none transition-all bg-white dark:bg-slate-800 dark:text-white" value="{{ old('tanggal') }}" />
                                @error('tanggal')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Section: Penilaian --}}
                    <div class="bg-gradient-to-br from-amber-50 to-white dark:from-slate-900 dark:to-slate-800 p-8 rounded-2xl border-2 border-gray-200 dark:border-slate-700 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-ppid-accent text-white shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-ppid-primary dark:text-white">{{ __('messages.survey_form.service_rating') }}</h3>
                        </div>
                        
                        <div class="space-y-8">
                            @foreach($questions as $index => $question)
                                <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-200 dark:border-slate-700 hover:shadow-md transition-shadow">
                                    <p class="text-base font-semibold text-gray-900 dark:text-white mb-5 leading-relaxed">
                                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-ppid-primary text-white text-sm font-bold mr-2">{{ $index + 1 }}</span>
                                        {{ $question->soal }}
                                    </p>
                                    
                                    @if($question->tipe == 'radio')
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <label class="relative flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-slate-600 cursor-pointer hover:border-ppid-primary hover:bg-blue-50 dark:hover:bg-slate-700 transition-all group">
                                                <input type="radio" name="answer[{{ $question->id }}]" value="Sangat Baik" required class="w-5 h-5 text-ppid-primary focus:ring-2 focus:ring-ppid-primary cursor-pointer" />
                                                <span class="text-base font-medium text-gray-700 dark:text-gray-300 group-hover:text-ppid-primary dark:group-hover:text-white transition-colors">A. {{ __('messages.survey_form.very_good') }}</span>
                                            </label>
                                            <label class="relative flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-slate-600 cursor-pointer hover:border-ppid-primary hover:bg-blue-50 dark:hover:bg-slate-700 transition-all group">
                                                <input type="radio" name="answer[{{ $question->id }}]" value="Baik" required class="w-5 h-5 text-ppid-primary focus:ring-2 focus:ring-ppid-primary cursor-pointer" />
                                                <span class="text-base font-medium text-gray-700 dark:text-gray-300 group-hover:text-ppid-primary dark:group-hover:text-white transition-colors">B. {{ __('messages.survey_form.good') }}</span>
                                            </label>
                                            <label class="relative flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-slate-600 cursor-pointer hover:border-ppid-primary hover:bg-blue-50 dark:hover:bg-slate-700 transition-all group">
                                                <input type="radio" name="answer[{{ $question->id }}]" value="Cukup Baik" required class="w-5 h-5 text-ppid-primary focus:ring-2 focus:ring-ppid-primary cursor-pointer" />
                                                <span class="text-base font-medium text-gray-700 dark:text-gray-300 group-hover:text-ppid-primary dark:group-hover:text-white transition-colors">C. {{ __('messages.survey_form.fair') }}</span>
                                            </label>
                                            <label class="relative flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 dark:border-slate-600 cursor-pointer hover:border-ppid-primary hover:bg-blue-50 dark:hover:bg-slate-700 transition-all group">
                                                <input type="radio" name="answer[{{ $question->id }}]" value="Tidak Baik" required class="w-5 h-5 text-ppid-primary focus:ring-2 focus:ring-ppid-primary cursor-pointer" />
                                                <span class="text-base font-medium text-gray-700 dark:text-gray-300 group-hover:text-ppid-primary dark:group-hover:text-white transition-colors">D. {{ __('messages.survey_form.poor') }}</span>
                                            </label>
                                        </div>
                                    @elseif($question->tipe == 'textarea')
                                        <textarea rows="5" name="answer[{{ $question->id }}]" placeholder="{{ __('messages.survey_form.comment_placeholder') }}" class="w-full px-5 py-3.5 text-base rounded-xl border-2 border-gray-300 dark:border-slate-600 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary outline-none transition-all bg-white dark:bg-slate-800 dark:text-white resize-none">{{ old('answer.' . $question->id) }}</textarea>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Section: Masukan --}}
                    <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl border-2 border-gray-200 dark:border-slate-700 shadow-sm">
                        <div class="flex items-center gap-3 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-ppid-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            <label class="text-lg font-bold text-gray-900 dark:text-white">{{ __('messages.survey_form.feedback_section') }}</label>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ __('messages.survey_form.feedback_desc') }}</p>
                        <textarea rows="5" name="masukan" placeholder="{{ __('messages.survey_form.feedback_placeholder') }}" class="w-full px-5 py-3.5 text-base rounded-xl border-2 border-gray-300 dark:border-slate-600 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800 dark:text-white resize-none">{{ old('masukan') }}</textarea>
                    </div>

                    <div class="pt-4 flex gap-4 justify-end">
                        <button type="reset" class="px-6 py-3 text-base font-semibold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                            {{ __('messages.survey_form.reset_btn') }}
                        </button>
                        <button type="submit" class="group relative px-10 py-4 bg-gradient-to-r from-ppid-primary to-ppid-primary-light text-white text-lg font-bold rounded-xl hover:from-ppid-primary-light hover:to-ppid-primary transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 overflow-hidden">
                            <span class="relative z-10 flex items-center gap-2">
                                {{ __('messages.survey_form.submit_btn') }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-ppid-accent transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                        </button>
                    </div>
                </form>

            </div>
        </div>

        {{-- Success Notification Modal --}}
        @if(session('success'))
            <x-notification-modal 
                trigger="showSuccessModal" 
                status="success" 
                title="{{ __('messages.survey_form.success_title') }}"
                description="{{ session('success') }}" 
            />
        @endif
    </main>

</x-layout>
