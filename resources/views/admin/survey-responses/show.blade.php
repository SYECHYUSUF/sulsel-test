<x-admin-layout>
    <x-slot:title>Detail Hasil Survey</x-slot:title>

<div class="p-8">
    <div class="max-w-5xl mx-auto">
        {{-- Header --}}
        <div class="mb-8">
            <a href="{{ route('admin.survey-responses.index') }}" class="inline-flex items-center gap-2 text-[#1A305E] dark:text-blue-400 hover:underline mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Survey
            </a>
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white mb-2">Detail Hasil Survey</h1>
            <p class="text-slate-600 dark:text-slate-400">Kode Survey: <span class="font-mono font-semibold">{{ $kode }}</span></p>
        </div>

        {{-- Respondent Information --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-8 mb-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#1A305E] text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-white">Data Responden</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2">Nama Lengkap</label>
                    <p class="text-base text-slate-900 dark:text-white font-medium">{{ $respondent->nama }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2">Email</label>
                    <p class="text-base text-slate-900 dark:text-white font-medium">{{ $respondent->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2">Lembaga</label>
                    <p class="text-base text-slate-900 dark:text-white font-medium">{{ $respondent->lembaga }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2">Tanggal Permintaan Informasi</label>
                    <p class="text-base text-slate-900 dark:text-white font-medium">{{ \Carbon\Carbon::parse($respondent->tanggal)->format('d F Y') }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2">Alamat</label>
                    <p class="text-base text-slate-900 dark:text-white font-medium">{{ $respondent->alamat }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2">Waktu Pengisian Survey</label>
                    <p class="text-base text-slate-900 dark:text-white font-medium">{{ $respondent->created_at->format('d F Y, H:i') }} WIB</p>
                </div>
            </div>
        </div>

        {{-- Survey Answers --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-8 mb-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#D4AF37] text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-white">Jawaban Penilaian</h2>
            </div>

            <div class="space-y-6">
                @foreach($questions as $index => $question)
                    @php
                        $kodeSoal = 'Q' . $question->urutan;
                        $answer = $answersMap[$kodeSoal] ?? '-';
                    @endphp
                    <div class="p-6 bg-slate-50 dark:bg-slate-700/50 rounded-xl border border-slate-200 dark:border-slate-600">
                        <div class="flex items-start gap-3 mb-3">
                            <span class="flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-[#1A305E] text-white text-sm font-bold">{{ $index + 1 }}</span>
                            <p class="text-base font-semibold text-slate-900 dark:text-white leading-relaxed">{{ $question->soal }}</p>
                        </div>
                        <div class="ml-11">
                            @if($question->tipe == 'radio')
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 rounded-lg border-2 border-[#1A305E] dark:border-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#1A305E] dark:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="font-semibold text-[#1A305E] dark:text-blue-400">{{ $answer }}</span>
                                </div>
                            @else
                                <p class="text-slate-700 dark:text-slate-300 italic">{{ $answer }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Feedback/Masukan --}}
        @if(isset($answersMap['masukan']) && $answersMap['masukan'])
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-600 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800 dark:text-white">Masukan & Saran</h2>
                </div>
                <div class="p-6 bg-slate-50 dark:bg-slate-700/50 rounded-xl border border-slate-200 dark:border-slate-600">
                    <p class="text-base text-slate-700 dark:text-slate-300 leading-relaxed">{{ $answersMap['masukan'] }}</p>
                </div>
            </div>
        @endif

        {{-- Action Buttons --}}
        <div class="mt-8 flex gap-4 justify-end">
            <a href="{{ route('admin.survey-responses.index') }}" class="px-6 py-3 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold rounded-xl hover:bg-slate-300 dark:hover:bg-slate-600 transition-all">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

</x-admin-layout>
