<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermohonanInformasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Public form
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Personal Data
            'nama' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\.\-\']+$/u'],
            'nik' => ['required', 'string', 'size:16', 'regex:/^[0-9]{16}$/'],
            'no_kk' => ['nullable', 'string', 'max:16', 'regex:/^[0-9]*$/'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20', 'regex:/^(08|628)[0-9]{8,12}$/'],
            'alamat' => ['required', 'string', 'max:500'],
            'pekerjaan_id' => ['required', 'integer', 'exists:master_pekerjaan,id'],
            'domisili_id' => ['required', 'integer', 'exists:master_domisili,id'],

            // File Upload - strict validation
            'foto_ktp' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,jpg,png',
                'max:5120', // 5MB
                'dimensions:min_width=100,min_height=100,max_width=4000,max_height=4000',
            ],

            // Information Details
            'nmr_pengesahan' => ['nullable', 'string', 'max:255'],
            'tujuan' => ['required', 'string', 'max:1000'],
            'rincian' => ['required', 'string', 'max:5000'],
            'id_bentuk_informasi' => ['required', 'integer', 'exists:ms_bentuk_informasi,id'],
            'contoh_informasi' => ['nullable', 'string', 'max:500'],

            // Honeypot field - must be empty
            'website' => ['nullable', 'max:0'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, tanda hubung, dan apostrof.',
            'nik.size' => 'NIK harus terdiri dari 16 digit angka.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'no_hp.regex' => 'Format nomor HP tidak valid. Gunakan format 08xx atau 628xx.',
            'email.email' => 'Format email tidak valid.',
            'foto_ktp.max' => 'Ukuran file KTP maksimal 5MB.',
            'foto_ktp.mimes' => 'File KTP harus berformat JPEG, JPG, atau PNG.',
            'foto_ktp.dimensions' => 'Dimensi gambar KTP tidak valid.',
            'pekerjaan_id.exists' => 'Pekerjaan yang dipilih tidak valid.',
            'domisili_id.exists' => 'Domisili yang dipilih tidak valid.',
        ];
    }

    /**
     * Prepare the data for validation.
     * This method sanitizes input before validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama' => $this->sanitizeString($this->nama),
            'alamat' => $this->sanitizeString($this->alamat),
            'tujuan' => $this->sanitizeString($this->tujuan),
            'rincian' => $this->sanitizeString($this->rincian),
            'nmr_pengesahan' => $this->sanitizeString($this->nmr_pengesahan),
            'contoh_informasi' => $this->sanitizeString($this->contoh_informasi),
            'nik' => preg_replace('/[^0-9]/', '', $this->nik ?? ''),
            'no_kk' => preg_replace('/[^0-9]/', '', $this->no_kk ?? ''),
            'no_hp' => preg_replace('/[^0-9+]/', '', $this->no_hp ?? ''),
        ]);
    }

    /**
     * Sanitize a string input.
     */
    private function sanitizeString(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        // Strip HTML tags
        $value = strip_tags($value);

        // Trim whitespace
        $value = trim($value);

        // Remove any null bytes
        $value = str_replace(chr(0), '', $value);

        // Convert special characters to HTML entities for safety
        $value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8', false);

        return $value;
    }
}
