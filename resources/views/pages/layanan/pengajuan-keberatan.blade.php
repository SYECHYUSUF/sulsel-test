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
                <span class="text-ppid-primary dark:text-white font-bold">Pengajuan Keberatan</span>
            </div>

            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-ppid-primary dark:text-white mb-2">
                        Pengajuan Keberatan
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Ajukan keberatan atas pelayanan informasi publik
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
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
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
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 p-8 md:p-10 relative">

                    <div class="text-center mb-10">
                        <div
                            class="w-16 h-16 bg-ppid-primary/5 text-ppid-primary dark:text-white rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-ppid-primary dark:text-white mb-2">
                            Formulir Pengajuan Keberatan
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300">
                            Silakan lengkapi data keberatan Anda
                        </p>
                    </div>

                    {{-- Success Modal --}}
                    @if(session('success'))
                        <x-success-modal :show="true" title="Yey, Berhasil!" :description="session('success')"
                            primary-button-text="Cek Status"
                            primary-button-url="{{ route('layanan.cek-status', ['type' => 'keberatan']) }}"
                            secondary-button-text="Tutup" />
                    @endif

                    {{-- Error Alert --}}
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="font-bold text-red-800">Gagal Mengirim Pengajuan</h3>
                                <p class="text-sm text-red-700 mt-1">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('layanan.pengajuan-keberatan.store') }}" method="POST" class="space-y-8">
                        @csrf

                        {{-- Honeypot --}}
                        <div style="position: absolute; left: -9999px; opacity: 0;" aria-hidden="true">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" />
                        </div>
                        <input type="hidden" name="_form_timestamp" value="{{ time() }}" />

                        {{-- Section 1: Detail Pengajuan --}}
                        <div class="space-y-6">
                            <h3
                                class="text-lg font-bold text-ppid-primary dark:text-white flex items-center gap-2 border-b border-gray-200 pb-3">
                                <span
                                    class="w-8 h-8 rounded-full bg-ppid-accent text-white flex items-center justify-center text-sm font-bold">1</span>
                                Detail Pengajuan
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Nomor Pendaftaran Pengajuan Keberatan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="no_pendaftaran" value="{{ old('no_pendaftaran') }}"
                                        placeholder="Masukkan nomor pendaftaran..."
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Tujuan Penggunaan Informasi <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="tujuan" value="{{ old('tujuan') }}"
                                        placeholder="Contoh: Penelitian Skripsi..."
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required />
                                </div>
                            </div>
                        </div>

                        {{-- Section 2: Identitas Pemohon --}}
                        <div class="space-y-6">
                            <h3
                                class="text-lg font-bold text-ppid-primary dark:text-white flex items-center gap-2 border-b border-gray-200 pb-3">
                                <span
                                    class="w-8 h-8 rounded-full bg-ppid-accent text-white flex items-center justify-center text-sm font-bold">2</span>
                                Identitas Pemohon
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nama_pemohon" value="{{ old('nama_pemohon') }}"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email_pemohon" value="{{ old('email_pemohon') }}"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Nomor Telepon / WhatsApp <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="no_telp_pemohon" value="{{ old('no_telp_pemohon') }}"
                                        placeholder="08xxxxxxxxxx" maxlength="12" inputmode="numeric"
                                        pattern="[0-9]{10,12}"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required />
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Pekerjaan <span class="text-red-500">*</span>
                                    </label>

                                    <x-searchable-select name="pekerjaan_pemohon" :options="$masterPekerjaan"
                                        idKey="nama_pekerjaan" labelKey="nama_pekerjaan"
                                        :value="old('pekerjaan_pemohon')" placeholder="-- Pilih Pekerjaan --"
                                        :required="true" class="h-12 [&>button]:h-full" />

                                </div>

                                {{-- Additional Address Fields (Previously Hidden) --}}
                                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6"
                                    x-data="addressPemohonForm()" x-init="init()">
                                    <!-- <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            Address (Jalan/Komplek) <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="address_pemohon" value="{{ old('address_pemohon') }}"
                                            placeholder="Nama Jalan / Komplek"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                            required />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            Apartment / Unit
                                        </label>
                                        <input type="text" name="apt_pemohon" value="{{ old('apt_pemohon') }}"
                                            placeholder="Blok / Unit / Lantai"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800" />
                                    </div> -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            Provinsi <span class="text-red-500">*</span>
                                        </label>
                                        <div>
                                            <x-searchable-select name="state_pemohon" :options="collect([
        'Aceh',
        'Sumatera Utara',
        'Sumatera Barat',
        'Riau',
        'Jambi',
        'Sumatera Selatan',
        'Bengkulu',
        'Lampung',
        'Kepulauan Bangka Belitung',
        'Kepulauan Riau',
        'DKI Jakarta',
        'Jawa Barat',
        'Jawa Tengah',
        'DI Yogyakarta',
        'Jawa Timur',
        'Banten',
        'Bali',
        'Nusa Tenggara Barat',
        'Nusa Tenggara Timur',
        'Kalimantan Barat',
        'Kalimantan Tengah',
        'Kalimantan Selatan',
        'Kalimantan Timur',
        'Kalimantan Utara',
        'Sulawesi Utara',
        'Sulawesi Tengah',
        'Sulawesi Selatan',
        'Sulawesi Tenggara',
        'Gorontalo',
        'Sulawesi Barat',
        'Maluku',
        'Maluku Utara',
        'Papua',
        'Papua Barat'
    ])->map(fn($p) => ['id' => $p, 'label' => $p])" 
                                                idKey="id"
                                                labelKey="label"
                                                :value="old('state_pemohon', '')" placeholder="-- Pilih Provinsi --"
                                                :required="true" class="h-12 [&>button]:h-full" />
                                            <input type="hidden" id="province_trigger" x-model="selectedProvince"
                                                @change="updateCities()">
                                        </div>
                                    </div>
                                    <div class="space-y-2" x-data="{ cityList: cities }">
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            Kota / Kabupaten <span class="text-red-500">*</span>
                                        </label>
                                        <div>
                                            <select name="city_pemohon"
                                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                                required>
                                                <option value="">-- Pilih Provinsi Terlebih Dahulu --</option>
                                                <template x-for="city in cities" :key="city">
                                                    <option :value="city" x-text="city"
                                                        :selected="city === '{{ old('city_pemohon') }}'"></option>
                                                </template>
                                            </select>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-show="!selectedProvince">
                                            Pilih provinsi terlebih dahulu untuk melihat daftar kota</p>
                                    </div>
                                </div>

                                <div class="md:col-span-2 space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Alamat Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="alamat_pemohon" rows="2" placeholder="Jl. Contoh No. 123"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        required>{{ old('alamat_pemohon') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Section 3: Kasus & Alasan --}}
                        <div class="space-y-6">
                            <h3
                                class="text-lg font-bold text-ppid-primary dark:text-white flex items-center gap-2 border-b border-gray-200 pb-3">
                                <span
                                    class="w-8 h-8 rounded-full bg-ppid-accent text-white flex items-center justify-center text-sm font-bold">3</span>
                                Kasus & Alasan Keberatan
                            </h3>

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Kasus Posisi <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="kasus" rows="4"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800"
                                        placeholder="Jelaskan secara singkat kasus posisi atau alasan keberatan anda..."
                                        required>{{ old('kasus') }}</textarea>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Alasan Keberatan (Pilih yang sesuai) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        @forelse($alasanPengajuans as $alasan)
                                            <label
                                                class="relative flex items-start p-3 border border-gray-200 dark:border-slate-700 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700/50 cursor-pointer group transition-all bg-white dark:bg-slate-800">
                                                <div class="flex items-center h-5">
                                                    <input type="checkbox" name="alasan[]" value="{{ $alasan->alasan }}"
                                                        class="h-4 w-4 text-ppid-error border-gray-300 rounded focus:ring-ppid-error">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <span
                                                        class="font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">{{ $alasan->alasan }}</span>
                                                </div>
                                            </label>
                                        @empty
                                            <div class="col-span-2 text-center py-4 text-gray-500">
                                                <p>Belum ada data alasan pengajuan.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Section 4: Kuasa (Optional) --}}
                        <div x-data="{ showKuasa: false }">
                            <div class="flex items-center mb-4">
                                <input type="checkbox" id="showKuasa" x-model="showKuasa"
                                    class="h-4 w-4 text-ppid-error border-gray-300 rounded focus:ring-ppid-error cursor-pointer">
                                <label for="showKuasa"
                                    class="ml-2 block text-sm font-semibold text-gray-700 dark:text-gray-300 cursor-pointer">
                                    Diwakilkan oleh Kuasa? 
                                </label>
                            </div>

                            <div x-show="showKuasa" x-transition
                                class="space-y-6 pt-4 border-t border-gray-100 dark:border-slate-700">
                                <h3
                                    class="text-lg font-bold text-ppid-primary dark:text-white flex items-center gap-2 border-b border-gray-200 pb-3">
                                    <span
                                        class="w-8 h-8 rounded-full bg-ppid-accent text-white flex items-center justify-center text-sm font-bold">4</span>
                                    Identitas Kuasa
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama
                                            Kuasa</label>
                                        <input type="text" name="nama_kuasa"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800">
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nomor
                                            Telepon Kuasa</label>
                                        <input type="text" name="no_telp_kuasa" maxlength="12" inputmode="numeric"
                                            pattern="[0-9]{10,12}" placeholder="08xxxxxxxxxx"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800">
                                    </div>
                                    <div class="md:col-span-2 space-y-2">
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Alamat
                                            Kuasa Lengkap</label>
                                        <textarea name="alamat_kuasa" rows="2"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800">{{ old('alamat_kuasa') }}</textarea>
                                    </div>

                                    {{-- Additional Kuasa Address Fields --}}
                                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                                Address (Jalan/Komplek)
                                            </label>
                                            <input type="text" name="address_kuasa" value="{{ old('address_kuasa') }}"
                                                placeholder="Nama Jalan / Komplek"
                                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800" />
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                                Apartment/Unit (Opsional)
                                            </label>
                                            <input type="text" name="apt_kuasa" value="{{ old('apt_kuasa') }}"
                                                placeholder="Blok / Unit / Lantai"
                                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800" />
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                                Kota / Kabupaten
                                            </label>
                                            <input type="text" name="city_kuasa" value="{{ old('city_kuasa') }}"
                                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800" />
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                                Provinsi
                                            </label>
                                            <input type="text" name="state_kuasa" value="{{ old('state_kuasa') }}"
                                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all outline-none bg-white dark:bg-slate-800" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-6 border-t border-gray-200 dark:border-slate-700">
                            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                                <a href="{{ route('layanan.cek-status', ['type' => 'keberatan']) }}"
                                    class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg border border-gray-300 hover:bg-gray-50 transition-all flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Cek Status
                                </a>
                                <button type="submit"
                                    class="px-8 py-3.5 bg-ppid-primary text-white font-bold rounded-lg hover:bg-ppid-primary/90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <line x1="22" x2="11" y1="2" y2="13" />
                                        <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                    </svg>
                                    Kirim Pengajuan
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>


    @if ($errors->any())
    <script>
        window.scrollTo({
            top: document.querySelector('form').offsetTop - 100,
            behavior: 'smooth'
        });
    </script>
    @endif

    {{-- Dynamic Province-City Dropdown Script --}}
    <script>
        // Indonesia Regions Data
        const indonesiaRegions = {
            'Aceh': ['Banda Aceh', 'Kab. Aceh Barat', 'Kab. Aceh Barat Daya', 'Kab. Aceh Besar', 'Kab. Aceh Jaya', 'Kab. Aceh Selatan', 'Kab. Aceh Singkil', 'Kab. Aceh Tamiang', 'Kab. Aceh Tengah', 'Kab. Aceh Tenggara', 'Kab. Aceh Timur', 'Kab. Aceh Utara', 'Kab. Bener Meriah', 'Kab. Bireuen', 'Kab. Gayo Lues', 'Kab. Nagan Raya', 'Kab. Pidie', 'Kab. Pidie Jaya', 'Kab. Simeulue', 'Langsa', 'Lhokseumawe', 'Sabang', 'Subulussalam'],
            'Sumatera Utara': ['Medan', 'Binjai', 'Pematangsiantar', 'Tanjungbalai', 'Tebing Tinggi', 'Padang Sidempuan', 'Gunungsitoli', 'Kab. Asahan', 'Kab. Batubara', 'Kab. Dairi', 'Kab. Deli Serdang', 'Kab. Humbang Hasundutan', 'Kab. Karo', 'Kab. Labuhanbatu', 'Kab. Labuhanbatu Selatan', 'Kab. Labuhanbatu Utara', 'Kab. Langkat', 'Kab. Mandailing Natal', 'Kab. Nias', 'Kab. Nias Barat', 'Kab. Nias Selatan', 'Kab. Nias Utara', 'Kab. Padang Lawas', 'Kab. Padang Lawas Utara', 'Kab. Pakpak Bharat', 'Kab. Samosir', 'Kab. Serdang Bedagai', 'Kab. Simalungun', 'Kab. Tapanuli Selatan', 'Kab. Tapanuli Tengah', 'Kab. Tapanuli Utara', 'Kab. Toba Samosir'],
            'Sumatera Barat': ['Padang', 'Bukittinggi', 'Padangpanjang', 'Pariaman', 'Payakumbuh', 'Sawahlunto', 'Solok', 'Kab. Agam', 'Kab. Dharmasraya', 'Kab. Kepulauan Mentawai', 'Kab. Lima Puluh Kota', 'Kab. Padang Pariaman', 'Kab. Pasaman', 'Kab. Pasaman Barat', 'Kab. Pesisir Selatan', 'Kab. Sijunjung', 'Kab. Solok', 'Kab. Solok Selatan', 'Kab. Tanah Datar'],
            'Riau': ['Pekanbaru', 'Dumai', 'Kab. Bengkalis', 'Kab. Indragiri Hilir', 'Kab. Indragiri Hulu', 'Kab. Kampar', 'Kab. Kuantan Singingi', 'Kab. Pelalawan', 'Kab. Rokan Hilir', 'Kab. Rokan Hulu', 'Kab. Siak', 'Kab. Kepulauan Meranti'],
            'Jambi': ['Jambi', 'Sungai Penuh', 'Kab. Batang Hari', 'Kab. Bungo', 'Kab. Kerinci', 'Kab. Merangin', 'Kab. Muaro Jambi', 'Kab. Sarolangun', 'Kab. Tanjung Jabung Barat', 'Kab. Tanjung Jabung Timur', 'Kab. Tebo'],
            'Sumatera Selatan': ['Palembang', 'Lubuklinggau', 'Pagar Alam', 'Prabumulih', 'Kab. Banyuasin', 'Kab. Empat Lawang', 'Kab. Lahat', 'Kab. Muara Enim', 'Kab. Musi Banyuasin', 'Kab. Musi Rawas', 'Kab. Musi Rawas Utara', 'Kab. Ogan Ilir', 'Kab. Ogan Komering Ilir', 'Kab. Ogan Komering Ulu', 'Kab. Ogan Komering Ulu Selatan', 'Kab. Ogan Komering Ulu Timur', 'Kab. Penukal Abab Lematang Ilir'],
            'Bengkulu': ['Bengkulu', 'Kab. Bengkulu Selatan', 'Kab. Bengkulu Tengah', 'Kab. Bengkulu Utara', 'Kab. Kaur', 'Kab. Kepahiang', 'Kab. Lebong', 'Kab. Mukomuko', 'Kab. Rejang Lebong', 'Kab. Seluma'],
            'Lampung': ['Bandar Lampung', 'Metro', 'Kab. Lampung Barat', 'Kab. Lampung Selatan', 'Kab. Lampung Tengah', 'Kab. Lampung Timur', 'Kab. Lampung Utara', 'Kab. Mesuji', 'Kab. Pesawaran', 'Kab. Pesisir Barat', 'Kab. Pringsewu', 'Kab. Tanggamus', 'Kab. Tulang Bawang', 'Kab. Tulang Bawang Barat', 'Kab. Way Kanan'],
            'Kepulauan Bangka Belitung': ['Pangkal Pinang', 'Kab. Bangka', 'Kab. Bangka Barat', 'Kab. Bangka Selatan', 'Kab. Bangka Tengah', 'Kab. Belitung', 'Kab. Belitung Timur'],
            'Kepulauan Riau': ['Batam', 'Tanjungpinang', 'Kab. Bintan', 'Kab. Karimun', 'Kab. Kepulauan Anambas', 'Kab. Lingga', 'Kab. Natuna'],
            'DKI Jakarta': ['Jakarta Pusat', 'Jakarta Utara', 'Jakarta Barat', 'Jakarta Selatan', 'Jakarta Timur', 'Kepulauan Seribu'],
            'Jawa Barat': ['Bandung', 'Bekasi', 'Bogor', 'Cimahi', 'Cirebon', 'Depok', 'Sukabumi', 'Tasikmalaya', 'Banjar', 'Kab. Bandung', 'Kab. Bandung Barat', 'Kab. Bekasi', 'Kab. Bogor', 'Kab. Ciamis', 'Kab. Cianjur', 'Kab. Cirebon', 'Kab. Garut', 'Kab. Indramayu', 'Kab. Karawang', 'Kab. Kuningan', 'Kab. Majalengka', 'Kab. Pangandaran', 'Kab. Purwakarta', 'Kab. Subang', 'Kab. Sukabumi', 'Kab. Sumedang', 'Kab. Tasikmalaya'],
            'Jawa Tengah': ['Semarang', 'Magelang', 'Pekalongan', 'Salatiga', 'Surakarta', 'Tegal', 'Kab. Banjarnegara', 'Kab. Banyumas', 'Kab. Batang', 'Kab. Blora', 'Kab. Boyolali', 'Kab. Brebes', 'Kab. Cilacap', 'Kab. Demak', 'Kab. Grobogan', 'Kab. Jepara', 'Kab. Karanganyar', 'Kab. Kebumen', 'Kab. Kendal', 'Kab. Klaten', 'Kab. Kudus', 'Kab. Magelang', 'Kab. Pati', 'Kab. Pekalongan', 'Kab. Pemalang', 'Kab. Purbalingga', 'Kab. Purworejo', 'Kab. Rembang', 'Kab. Semarang', 'Kab. Sragen', 'Kab. Sukoharjo', 'Kab. Tegal', 'Kab. Temanggung', 'Kab. Wonogiri', 'Kab. Wonosobo'],
            'DI Yogyakarta': ['Yogyakarta', 'Kab. Bantul', 'Kab. Gunungkidul', 'Kab. Kulon Progo', 'Kab. Sleman'],
            'Jawa Timur': ['Surabaya', 'Batu', 'Blitar', 'Kediri', 'Madiun', 'Malang', 'Mojokerto', 'Pasuruan', 'Probolinggo', 'Kab. Bangkalan', 'Kab. Banyuwangi', 'Kab. Blitar', 'Kab. Bojonegoro', 'Kab. Bondowoso', 'Kab. Gresik', 'Kab. Jember', 'Kab. Jombang', 'Kab. Kediri', 'Kab. Lamongan', 'Kab. Lumajang', 'Kab. Madiun', 'Kab. Magetan', 'Kab. Malang', 'Kab. Mojokerto', 'Kab. Nganjuk', 'Kab. Ngawi', 'Kab. Pacitan', 'Kab. Pamekasan', 'Kab. Pasuruan', 'Kab. Ponorogo', 'Kab. Probolinggo', 'Kab. Sampang', 'Kab. Sidoarjo', 'Kab. Situbondo', 'Kab. Sumenep', 'Kab. Trenggalek', 'Kab. Tuban', 'Kab. Tulungagung'],
            'Banten': ['Serang', 'Cilegon', 'Tangerang', 'Tangerang Selatan', 'Kab. Lebak', 'Kab. Pandeglang', 'Kab. Serang', 'Kab. Tangerang'],
            'Bali': ['Denpasar', 'Kab. Badung', 'Kab. Bangli', 'Kab. Buleleng', 'Kab. Gianyar', 'Kab. Jembrana', 'Kab. Karangasem', 'Kab. Klungkung', 'Kab. Tabanan'],
            'Nusa Tenggara Barat': ['Mataram', 'Bima', 'Kab. Bima', 'Kab. Dompu', 'Kab. Lombok Barat', 'Kab. Lombok Tengah', 'Kab. Lombok Timur', 'Kab. Lombok Utara', 'Kab. Sumbawa', 'Kab. Sumbawa Barat'],
            'Nusa Tenggara Timur': ['Kupang', 'Kab. Alor', 'Kab. Belu', 'Kab. Ende', 'Kab. Flores Timur', 'Kab. Kupang', 'Kab. Lembata', 'Kab. Manggarai', 'Kab. Manggarai Barat', 'Kab. Manggarai Timur', 'Kab. Nagekeo', 'Kab. Ngada', 'Kab. Rote Ndao', 'Kab. Sabu Raijua', 'Kab. Sikka', 'Kab. Sumba Barat', 'Kab. Sumba Barat Daya', 'Kab. Sumba Tengah', 'Kab. Sumba Timur', 'Kab. Timor Tengah Selatan', 'Kab. Timor Tengah Utara'],
            'Kalimantan Barat': ['Pontianak', 'Singkawang', 'Kab. Bengkayang', 'Kab. Kapuas Hulu', 'Kab. Kayong Utara', 'Kab. Ketapang', 'Kab. Kubu Raya', 'Kab. Landak', 'Kab. Melawi', 'Kab. Mempawah', 'Kab. Sambas', 'Kab. Sanggau', 'Kab. Sekadau', 'Kab. Sintang'],
            'Kalimantan Tengah': ['Palangkaraya', 'Kab. Barito Selatan', 'Kab. Barito Timur', 'Kab. Barito Utara', 'Kab. Gunung Mas', 'Kab. Kapuas', 'Kab. Katingan', 'Kab. Kotawaringin Barat', 'Kab. Kotawaringin Timur', 'Kab. Lamandau', 'Kab. Murung Raya', 'Kab. Pulang Pisau', 'Kab. Seruyan', 'Kab. Sukamara'],
            'Kalimantan Selatan': ['Banjarmasin', 'Banjarbaru', 'Kab. Balangan', 'Kab. Banjar', 'Kab. Barito Kuala', 'Kab. Hulu Sungai Selatan', 'Kab. Hulu Sungai Tengah', 'Kab. Hulu Sungai Utara', 'Kab. Kotabaru', 'Kab. Tabalong', 'Kab. Tanah Bumbu', 'Kab. Tanah Laut', 'Kab. Tapin'],
            'Kalimantan Timur': ['Balikpapan', 'Bontang', 'Samarinda', 'Kab. Berau', 'Kab. Kutai Barat', 'Kab. Kutai Kartanegara', 'Kab. Kutai Timur', 'Kab. Mahakam Ulu', 'Kab. Paser', 'Kab. Penajam Paser Utara'],
            'Kalimantan Utara': ['Tarakan', 'Kab. Bulungan', 'Kab. Malinau', 'Kab. Nunukan', 'Kab. Tana Tidung'],
            'Sulawesi Utara': ['Manado', 'Bitung', 'Kotamobagu', 'Tomohon', 'Kab. Bolaang Mongondow', 'Kab. Bolaang Mongondow Selatan', 'Kab. Bolaang Mongondow Timur', 'Kab. Bolaang Mongondow Utara', 'Kab. Kepulauan Sangihe', 'Kab. Kepulauan Siau Tagulandang Biaro', 'Kab. Kepulauan Talaud', 'Kab. Minahasa', 'Kab. Minahasa Selatan', 'Kab. Minahasa Tenggara', 'Kab. Minahasa Utara'],
            'Sulawesi Tengah': ['Palu', 'Kab. Banggai', 'Kab. Banggai Kepulauan', 'Kab. Banggai Laut', 'Kab. Buol', 'Kab. Donggala', 'Kab. Morowali', 'Kab. Morowali Utara', 'Kab. Parigi Moutong', 'Kab. Poso', 'Kab. Sigi', 'Kab. Tojo Una-Una', 'Kab. Toli-Toli'],
            'Sulawesi Selatan': ['Makassar', 'Parepare', 'Palopo', 'Kab. Bantaeng', 'Kab. Barru', 'Kab. Bone', 'Kab. Bulukumba', 'Kab. Enrekang', 'Kab. Gowa', 'Kab. Jeneponto', 'Kab. Kepulauan Selayar', 'Kab. Luwu', 'Kab. Luwu Timur', 'Kab. Luwu Utara', 'Kab. Maros', 'Kab. Pangkajene dan Kepulauan', 'Kab. Pinrang', 'Kab. Sidenreng Rappang', 'Kab. Sinjai', 'Kab. Soppeng', 'Kab. Takalar', 'Kab. Tana Toraja', 'Kab. Toraja Utara', 'Kab. Wajo'],
            'Sulawesi Tenggara': ['Kendari', 'Baubau', 'Kab. Bombana', 'Kab. Buton', 'Kab. Buton Selatan', 'Kab. Buton Tengah', 'Kab. Buton Utara', 'Kab. Kolaka', 'Kab. Kolaka Timur', 'Kab. Kolaka Utara', 'Kab. Konawe', 'Kab. Konawe Kepulauan', 'Kab. Konawe Selatan', 'Kab. Konawe Utara', 'Kab. Muna', 'Kab. Muna Barat', 'Kab. Wakatobi'],
            'Gorontalo': ['Gorontalo', 'Kab. Bone Bolango', 'Kab. Boalemo', 'Kab. Gorontalo', 'Kab. Gorontalo Utara', 'Kab. Pohuwato'],
            'Sulawesi Barat': ['Mamuju', 'Kab. Majene', 'Kab. Mamasa', 'Kab. Mamuju', 'Kab. Mamuju Tengah', 'Kab. Mamuju Utara', 'Kab. Polewali Mandar'],
            'Maluku': ['Ambon', 'Tual', 'Kab. Buru', 'Kab. Buru Selatan', 'Kab. Kepulauan Aru', 'Kab. Maluku Barat Daya', 'Kab. Maluku Tengah', 'Kab. Maluku Tenggara', 'Kab. Maluku Tenggara Barat', 'Kab. Seram Bagian Barat', 'Kab. Seram Bagian Timur'],
            'Maluku Utara': ['Ternate', 'Tidore Kepulauan', 'Kab. Halmahera Barat', 'Kab. Halmahera Selatan', 'Kab. Halmahera Tengah', 'Kab. Halmahera Timur', 'Kab. Halmahera Utara', 'Kab. Kepulauan Sula', 'Kab. Pulau Morotai', 'Kab. Pulau Taliabu'],
            'Papua': ['Jayapura', 'Kab. Asmat', 'Kab. Biak Numfor', 'Kab. Boven Digoel', 'Kab. Deiyai', 'Kab. Dogiyai', 'Kab. Intan Jaya', 'Kab. Jayapura', 'Kab. Jayawijaya', 'Kab. Keerom', 'Kab. Kepulauan Yapen', 'Kab. Lanny Jaya', 'Kab. Mamberamo Raya', 'Kab. Mamberamo Tengah', 'Kab. Mappi', 'Kab. Merauke', 'Kab. Mimika', 'Kab. Nabire', 'Kab. Nduga', 'Kab. Paniai', 'Kab. Pegunungan Bintang', 'Kab. Puncak', 'Kab. Puncak Jaya', 'Kab. Sarmi', 'Kab. Supiori', 'Kab. Tolikara', 'Kab. Waropen', 'Kab. Yahukimo', 'Kab. Yalimo'],
            'Papua Barat': ['Manokwari', 'Sorong', 'Kab. Fakfak', 'Kab. Kaimana', 'Kab. Manokwari', 'Kab. Manokwari Selatan', 'Kab. Maybrat', 'Kab. Pegunungan Arfak', 'Kab. Raja Ampat', 'Kab. Sorong', 'Kab. Sorong Selatan', 'Kab. Tambrauw', 'Kab. Teluk Bintuni', 'Kab. Teluk Wondama']
        };

        // Alpine.js Component for Address Form
        function addressPemohonForm() {
            return {
                provinces: Object.keys(indonesiaRegions),
                selectedProvince: '{{ old("state_pemohon", "") }}',
                cities: [],

                init() {
                    // Load cities for old selected province on page load
                    if (this.selectedProvince) {
                        this.updateCities();
                    }

                    // Watch for changes from searchable-select component
                    const provinceHiddenInput = document.querySelector('input[name="state_pemohon"]');
                    if (provinceHiddenInput) {
                        // Create observer to watch for value changes
                        const observer = new MutationObserver((mutations) => {
                            mutations.forEach((mutation) => {
                                if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
                                    this.selectedProvince = provinceHiddenInput.value;
                                    this.updateCities();
                                }
                            });
                        });

                        // Observe attribute changes
                        observer.observe(provinceHiddenInput, {
                            attributes: true,
                            attributeFilter: ['value']
                        });

                        // Also listen for input event
                        provinceHiddenInput.addEventListener('input', () => {
                            this.selectedProvince = provinceHiddenInput.value;
                            this.updateCities();
                        });
                    }
                },

                updateCities() {
                    if (this.selectedProvince && indonesiaRegions[this.selectedProvince]) {
                        this.cities = indonesiaRegions[this.selectedProvince];
                    } else {
                        this.cities = [];
                    }
                }
            }
        }
    </script>
</x-layout>