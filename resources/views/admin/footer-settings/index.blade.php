<x-admin-layout>
    <div class="space-y-6">
        <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Footer Settings</h1>
                <p class="text-slate-500 mt-1">Kelola konten footer website (Logo, Kontak, Sosial Media, Legal)</p>
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Sukses!</span> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.footer-settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Branding Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-6">
                <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Branding & Logo</h2>
                
                <!-- Logo -->
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">Logo Footer</label>
                    <div class="flex items-center gap-6">
                        <div class="w-32 h-32 bg-slate-100 rounded-lg flex items-center justify-center overflow-hidden border border-slate-200">
                            @if($settings['footer_logo'])
                                <img src="{{ asset('storage/' . $settings['footer_logo']) }}" alt="Current Logo" class="w-full h-full object-contain">
                            @else
                                <span class="text-slate-400 text-xs text-center">No Logo</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input type="file" name="footer_logo" class="block w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100
                            "/>
                            <p class="mt-2 text-xs text-slate-500">Format: JPG, PNG. Max: 2MB. Disarankan background transparan.</p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="footer_description" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi Singkat</label>
                    <textarea name="footer_description" id="footer_description" rows="3" 
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">{{ old('footer_description', $settings['footer_description']) }}</textarea>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-6">
                <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Informasi Kontak</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="footer_phone" class="block text-sm font-medium text-slate-700 mb-2">Nomor Telepon</label>
                        <input type="text" name="footer_phone" id="footer_phone" 
                            value="{{ old('footer_phone', $settings['footer_phone']) }}"
                            class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="footer_email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <input type="email" name="footer_email" id="footer_email" 
                            value="{{ old('footer_email', $settings['footer_email']) }}"
                            class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label for="footer_address" class="block text-sm font-medium text-slate-700 mb-2">Alamat</label>
                    <textarea name="footer_address" id="footer_address" rows="2" 
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">{{ old('footer_address', $settings['footer_address']) }}</textarea>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-6">
                <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Social Media Links</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="social_facebook" class="block text-sm font-medium text-slate-700 mb-2">Facebook URL</label>
                        <input type="url" name="social_facebook" id="social_facebook" 
                            value="{{ old('social_facebook', $settings['social_facebook']) }}"
                            class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="social_twitter" class="block text-sm font-medium text-slate-700 mb-2">Twitter/X URL</label>
                        <input type="url" name="social_twitter" id="social_twitter" 
                            value="{{ old('social_twitter', $settings['social_twitter']) }}"
                            class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="social_instagram" class="block text-sm font-medium text-slate-700 mb-2">Instagram URL</label>
                        <input type="url" name="social_instagram" id="social_instagram" 
                            value="{{ old('social_instagram', $settings['social_instagram']) }}"
                            class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="social_youtube" class="block text-sm font-medium text-slate-700 mb-2">YouTube URL</label>
                        <input type="url" name="social_youtube" id="social_youtube" 
                            value="{{ old('social_youtube', $settings['social_youtube']) }}"
                            class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Legal Documents -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-6">
                <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Dokumen Legal</h2>
                
                <div>
                    <label for="privacy_policy" class="block text-sm font-medium text-slate-700 mb-2">Privacy Policy</label>
                    <textarea name="privacy_policy" id="privacy_policy" rows="10" 
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 editor">{{ old('privacy_policy', $settings['privacy_policy']) }}</textarea>
                </div>

                <div>
                    <label for="terms_conditions" class="block text-sm font-medium text-slate-700 mb-2">Terms & Conditions</label>
                    <textarea name="terms_conditions" id="terms_conditions" rows="10" 
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 editor">{{ old('terms_conditions', $settings['terms_conditions']) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-sm rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all shadow-lg hover:shadow-blue-500/30">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    @push('styles')
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script>
        document.querySelectorAll('.editor').forEach((element) => {
            ClassicEditor
                .create(element)
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
    @endpush
</x-admin-layout>
