<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-8">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-ppid-primary dark:text-white transition-colors">
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
                <span class="text-ppid-primary dark:text-white font-medium">Layanan</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-4 h-4 text-gray-400">
                    <path d="m9 18 6-6-6-6" />
                </svg>
                <span class="text-ppid-primary dark:text-white font-bold">Permohonan Informasi</span>
            </div>

            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-ppid-primary dark:text-white mb-2">
                        {{ __('messages.layanan_pages.permohonan_title') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('messages.layanan_pages.permohonan_subtitle') }}
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-24 h-1.5 bg-gradient-to-r from-ppid-primary to-ppid-accent rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-12 md:py-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-bold text-red-800">Mohon periksa kembali inputan Anda:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form Container --}}
                <div x-data="{ successModalOpen: @if(session('success')) true @else false @endif }"
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 p-8 md:p-10 relative">
                    <div class="text-center mb-10">
                        <div
                            class="w-16 h-16 bg-ppid-primary/5 text-ppid-primary dark:text-white rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                                <line x1="16" x2="8" y1="13" y2="13" />
                                <line x1="16" x2="8" y1="17" y2="17" />
                                <polyline points="10 9 9 9 8 9" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-ppid-primary dark:text-white mb-2">
                            {{ __('messages.form.form_title') }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300">
                            {{ __('messages.form.fill_form_desc') }}
                        </p>
                    </div>

                    {{-- Success Modal --}}
                    <div x-show="successModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                        <div
                            class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <div x-show="successModalOpen" @click="successModalOpen = false"
                                class="fixed inset-0 transition-opacity" aria-hidden="true">
                                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm opacity-100"></div>
                            </div>

                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                aria-hidden="true">&#8203;</span>

                            <div x-show="successModalOpen"
                                class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full relative">

                                <!-- Modal Content -->
                                <div class="px-8 pt-10 pb-8 relative z-10 flex flex-col items-center text-center">

                                    <!-- Icon Wrapper with Blob Background -->
                                    <div
                                        class="relative w-28 h-28 mb-6 flex items-center justify-center transform hover:scale-105 transition-transform duration-300">
                                        <!-- Blob SVG -->
                                        <svg viewBox="0 0 200 200"
                                            class="absolute inset-0 w-full h-full drop-shadow-2xl"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <defs>
                                                <linearGradient id="blobGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" class="text-ppid-primary" style="stop-color:currentColor;stop-opacity:1" />
                                                    <!-- Primary Dark Blue -->
                                                    <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:1" />
                                                    <!-- Blue 500 -->
                                                </linearGradient>
                                            </defs>
                                            <path fill="url(#blobGradient)"
                                                d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,70.8,34.1C59.4,45.1,47.9,53.4,36.1,60.8C24.3,68.2,12.2,74.7,-1.2,76.8C-14.6,78.9,-29.2,76.6,-42.6,69.9C-56,63.2,-68.2,52.1,-76.6,38.6C-85,25.1,-89.6,9.2,-86.6,-5.3C-83.6,-19.8,-73,-32.9,-62,-44.6C-51,-56.3,-39.6,-66.6,-26.8,-74.7C-14,-82.8,0.2,-88.7,14.6,-88.7C29,-88.7,46.1,-82.8,58.7,-73.4L44.7,-76.4Z"
                                                transform="translate(100 100) scale(1.1)" />
                                        </svg>

                                        <!-- Check Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-12 w-12 text-white relative z-10 filter drop-shadow-md" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-3xl font-black text-slate-800 dark:text-white mb-3 tracking-tight">
                                        {{ __('messages.form.success_title') }}
                                    </h3>

                                    <!-- Message -->
                                    <p
                                        class="text-slate-500 dark:text-slate-400 text-base font-medium leading-relaxed mb-1">
                                        {{ session('success') ?? __('messages.form.success_desc') }}
                                    </p>
                                    <p class="text-slate-400 dark:text-slate-500 text-sm mb-10">
                                        {{ __('messages.form.process_desc') }}
                                    </p>

                                    <!-- Buttons -->
                                    <div class="flex gap-4 w-full">
                                        <button @click="successModalOpen = false"
                                            class="flex-1 px-5 py-3.5 rounded-2xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-sm tracking-wide hover:bg-slate-300 dark:hover:bg-slate-600 transition-all active:scale-95">
                                            {{ __('messages.form.close') }}
                                        </button>
                                        <button @click="successModalOpen = false"
                                            class="flex-1 px-5 py-3.5 rounded-2xl text-white font-bold text-sm tracking-wide shadow-xl shadow-blue-500/30 transition-all transform hover:scale-105 active:scale-95 bg-gradient-to-r from-ppid-primary to-blue-600 hover:to-blue-500">
                                            {{ __('messages.form.great') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('layanan.permohonan-informasi.store') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-8" id="permohonanForm">
                        @csrf

                        {{-- Honeypot field for bot detection (hidden, must remain empty) --}}
                        <div style="position: absolute; left: -9999px; opacity: 0;" aria-hidden="true">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" />
                        </div>
                        {{-- Timestamp for bot detection --}}
                        <input type="hidden" name="_form_timestamp" value="{{ time() }}" />

                        {{-- Personal Data --}}
                        <div class="space-y-6">
                            <h3
                                class="text-lg font-bold text-ppid-primary dark:text-white flex items-center gap-2 border-b border-gray-200 pb-3">
                                <span
                                    class="w-8 h-8 rounded-full bg-ppid-accent text-white flex items-center justify-center text-sm font-bold">1</span>
                                Data Pribadi
                            </h3>

                            {{-- Row 1: Nama & NIK --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nama" value="{{ old('nama') }}"
                                        placeholder="Masukkan nama sesuai KTP"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required />
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        No. KTP (NIK) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nik" id="nikInput" value="{{ old('nik') }}"
                                        placeholder="16 digit NIK" maxlength="16"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required />
                                    <p class="text-xs text-gray-500 mt-1">NIK harus 16 digit angka</p>
                                </div>
                            </div>

                            {{-- Row 2: No. KK & Email --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Nomor KK (Opsional)
                                    </label>
                                    <input type="text" name="no_kk" value="{{ old('no_kk') }}"
                                        placeholder="Nomor Kartu Keluarga"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800" />
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        placeholder="contoh@email.com"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required />
                                </div>
                            </div>

                            {{-- Row 3: No. HP & Alamat --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        No. HP / WhatsApp <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                                        placeholder="08xxxxxxxxxx"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required />
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Alamat Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="alamat" value="{{ old('alamat') }}"
                                        placeholder="Jl. Contoh No. 123, Kelurahan/Desa"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required />
                                </div>
                            </div>

                            {{-- Row 4: Asal/Domisili & Pekerjaan --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Asal / Domisili <span class="text-red-500">*</span>
                                    </label>

                                    <x-searchable-select name="domisili_id" :options="$masterDomisili" idKey="id"
                                        labelKey="nama_daerah" :value="old('domisili_id')"
                                        placeholder="-- Pilih Kabupaten/Kota --" :required="true"
                                        class="h-12 [&>button]:h-full" />
                                    <p class="text-xs text-gray-500 mt-1">Pilih kabupaten/kota asal Anda</p>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Pekerjaan <span class="text-red-500">*</span>
                                    </label>

                                    <x-searchable-select name="pekerjaan_id" :options="$masterPekerjaan" idKey="id"
                                        labelKey="nama_pekerjaan" :value="old('pekerjaan_id')"
                                        placeholder="-- Pilih Pekerjaan --" :required="true"
                                        class="h-12 [&>button]:h-full" />
                                </div>
                            </div>

                            {{-- Row 5: Upload KTP --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Upload Foto KTP <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="file" name="foto_ktp" accept="image/jpeg,image/jpg,image/png" class="block w-full text-sm text-gray-700 dark:text-gray-300
                                                  file:mr-4 file:py-3 file:px-6 
                                                  file:rounded-lg file:border-0 
                                                  file:text-sm file:font-semibold
                                                  file:bg-ppid-primary file:text-white
                                                  hover:file:bg-ppid-primary/90
                                                  cursor-pointer border border-gray-300 rounded-lg bg-white dark:bg-slate-800
                                                  focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary" required />
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Format: JPG, JPEG, PNG | Maksimal ukuran: 5MB
                                </p>
                            </div>
                        </div>

                        {{-- Information Details --}}
                        <div class="space-y-6">
                            <h3
                                class="text-lg font-bold text-ppid-primary dark:text-white flex items-center gap-2 border-b border-gray-200 pb-3">
                                <span
                                    class="w-8 h-8 rounded-full bg-ppid-accent text-white flex items-center justify-center text-sm font-bold">2</span>
                                Detail Informasi
                            </h3>

                            {{-- Row 1: Nomor Pengeluaran & Tujuan --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Nomor Pengeluaran (Badan Hukum)
                                    </label>
                                    <input type="text" name="nmr_pengesahan" value="{{ old('nmr_pengesahan') }}"
                                        placeholder="Jika mewakili badan hukum"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800" />
                                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika mengajukan sebagai perorangan
                                    </p>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Tujuan Penggunaan Informasi <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="tujuan" value="{{ old('tujuan') }}"
                                        placeholder="Contoh: Penelitian, Keperluan Pribadi, dll"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required />
                                </div>
                            </div>

                            {{-- Row 2: Rincian Informasi --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Rincian Informasi Yang Dibutuhkan <span class="text-red-500">*</span>
                                </label>
                                <textarea name="rincian" rows="5"
                                    placeholder="Deskripsikan secara detail informasi yang Anda butuhkan..."
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800 resize-none"
                                    required>{{ old('rincian') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-lightbulb mr-1"></i>
                                    Jelaskan informasi yang dibutuhkan sejelas mungkin
                                </p>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-6 border-t border-gray-200">
                            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                                <button type="reset"
                                    class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-all flex items-center justify-center gap-2">
                                    <i class="fas fa-redo"></i>
                                    Reset Form
                                </button>
                                <button type="submit"
                                    class="px-8 py-3.5 bg-ppid-primary text-white font-bold rounded-lg hover:bg-ppid-primary/90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <line x1="22" x2="11" y1="2" y2="13" />
                                        <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                    </svg>
                                    Kirim Permohonan
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- File Upload with Drag & Drop and NIK Validation Script --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const fotoKtpInput = document.getElementById('fotoKtpInput');
                            const nikInput = document.getElementById('nikInput');
                            const form = document.getElementById('permohonanForm');
                            const dropZone = document.getElementById('ktpDropZone');
                            const dropText = document.getElementById('ktpDropText');
                            const preview = document.getElementById('ktpPreview');
                            const previewImage = document.getElementById('ktpPreviewImage');
                            const fileName = document.getElementById('ktpFileName');
                            const fileSize = document.getElementById('ktpFileSize');
                            const removeBtn = document.getElementById('ktpRemoveBtn');

                            // NIK validation - only allow numbers and limit to 16 digits
                            if (nikInput) {
                                nikInput.addEventListener('input', function (e) {
                                    this.value = this.value.replace(/[^0-9]/g, '');
                                    if (this.value.length > 16) {
                                        this.value = this.value.slice(0, 16);
                                    }
                                });
                            }

                            // File validation function
                            function validateFile(file) {
                                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                                const maxSize = 5 * 1024 * 1024; // 5MB

                                if (!allowedTypes.includes(file.type)) {
                                    alert('Format file tidak valid! Hanya file JPG, JPEG, dan PNG yang diperbolehkan.');
                                    return false;
                                }

                                if (file.size > maxSize) {
                                    alert('Ukuran file terlalu besar! Maksimal 5MB.');
                                    return false;
                                }

                                return true;
                            }

                            // Format file size
                            function formatFileSize(bytes) {
                                if (bytes < 1024) return bytes + ' B';
                                if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
                                return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
                            }

                            // Show file preview
                            function showPreview(file) {
                                const reader = new FileReader();
                                reader.onload = function (e) {
                                    previewImage.src = e.target.result;
                                    fileName.textContent = file.name;
                                    fileSize.textContent = formatFileSize(file.size);
                                    dropText.classList.add('hidden');
                                    preview.classList.remove('hidden');
                                };
                                reader.readAsDataURL(file);
                            }

                            // Handle file selection
                            function handleFile(file) {
                                if (validateFile(file)) {
                                    showPreview(file);
                                } else {
                                    fotoKtpInput.value = '';
                                }
                            }

                            // Click to upload
                            dropZone.addEventListener('click', function (e) {
                                if (e.target !== removeBtn && !removeBtn.contains(e.target)) {
                                    fotoKtpInput.click();
                                }
                            });

                            // File input change
                            fotoKtpInput.addEventListener('change', function (e) {
                                const file = e.target.files[0];
                                if (file) {
                                    handleFile(file);
                                }
                            });

                            // Drag and drop events
                            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                                dropZone.addEventListener(eventName, preventDefaults, false);
                            });

                            function preventDefaults(e) {
                                e.preventDefault();
                                e.stopPropagation();
                            }

                            // Highlight on drag
                            ['dragenter', 'dragover'].forEach(eventName => {
                                dropZone.addEventListener(eventName, function () {
                                    dropZone.classList.add('border-ppid-accent', 'bg-gradient-to-br', 'from-yellow-50', 'to-amber-50');
                                });
                            });

                            ['dragleave', 'drop'].forEach(eventName => {
                                dropZone.addEventListener(eventName, function () {
                                    dropZone.classList.remove('border-ppid-accent', 'bg-gradient-to-br', 'from-yellow-50', 'to-amber-50');
                                });
                            });

                            // Handle drop
                            dropZone.addEventListener('drop', function (e) {
                                const dt = e.dataTransfer;
                                const files = dt.files;

                                if (files.length > 0) {
                                    const file = files[0];

                                    // Create a new FileList-like object
                                    const dataTransfer = new DataTransfer();
                                    dataTransfer.items.add(file);
                                    fotoKtpInput.files = dataTransfer.files;

                                    handleFile(file);
                                }
                            });

                            // Remove file
                            removeBtn.addEventListener('click', function (e) {
                                e.stopPropagation();
                                fotoKtpInput.value = '';
                                preview.classList.add('hidden');
                                dropText.classList.remove('hidden');
                                previewImage.src = '';
                            });

                            // Form submit validation
                            form.addEventListener('submit', function (e) {
                                const file = fotoKtpInput.files[0];

                                if (!file) {
                                    e.preventDefault();
                                    alert('Foto KTP wajib diupload!');
                                    dropZone.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    return;
                                }

                                if (!validateFile(file)) {
                                    e.preventDefault();
                                    fotoKtpInput.value = '';
                                    preview.classList.add('hidden');
                                    dropText.classList.remove('hidden');
                                }
                            });
                        });
                    </script>
                </div>

            </div>
        </div>
    </main>

    {{-- NIK Validation Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nikInput = document.getElementById('nikInput');

            if (nikInput) {
                nikInput.addEventListener('input', function (e) {
                    // Remove non-numeric characters
                    let value = e.target.value.replace(/\D/g, '');

                    // Limit to 16 digits
                    if (value.length > 16) {
                        value = value.substring(0, 16);
                    }

                    e.target.value = value;
                });

                // Validate on form submit
                nikInput.closest('form').addEventListener('submit', function (e) {
                    if (nikInput.value.length !== 16) {
                        e.preventDefault();
                        alert('NIK harus terdiri dari 16 digit angka!');
                        nikInput.focus();
                    }
                });
            }
        });
    </script>

    <x-footer />
</x-layout>