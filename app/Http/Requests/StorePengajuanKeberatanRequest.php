<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengajuanKeberatanRequest extends FormRequest
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
            // Core fields
            'no_pendaftaran' => ['required', 'string', 'max:100'],
            'tujuan' => ['required', 'string', 'max:1000'],

            // Pemohon identity
            'nama_pemohon' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\.\-\']+$/u'],
            'alamat_pemohon' => ['required', 'string', 'max:500'],
            'address_pemohon' => ['nullable', 'string', 'max:255'],
            'city_pemohon' => ['required', 'string', 'max:100'],
            'state_pemohon' => ['required', 'string', 'max:100'],
            'pekerjaan_pemohon' => ['required', 'string', 'max:100'],
            'no_telp_pemohon' => ['required', 'string', 'min:10', 'max:12', 'regex:/^(08|628|\+628)[0-9]{8,10}$/'],
            'email_pemohon' => ['required', 'email:rfc,dns', 'max:255'],

            // Alasan keberatan
            'alasan' => ['required', 'array', 'min:1'],
            'alasan.*' => ['string', 'max:500'],

            // Kasus
            'kasus' => ['required', 'string', 'max:5000'],

            // Kuasa (Optional)
            'nama_kuasa' => ['nullable', 'string', 'max:255', 'regex:/^[\pL\s\.\-\']*$/u'],
            'alamat_kuasa' => ['nullable', 'string', 'max:500'],
            'address_kuasa' => ['nullable', 'string', 'max:255'],
            'apt_kuasa' => ['nullable', 'string', 'max:100'],
            'city_kuasa' => ['nullable', 'string', 'max:100'],
            'state_kuasa' => ['nullable', 'string', 'max:100'],
            'no_telp_kuasa' => ['nullable', 'string', 'min:10', 'max:12', 'regex:/^(08|628|\+628)?[0-9]{8,10}$/'],

            // Hidden fields
            'apt_pemohon' => ['nullable', 'string', 'max:100'],

            // Honeypot field
            'website' => ['nullable', 'max:0'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama_pemohon.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, dan tanda hubung.',
            'no_telp_pemohon.regex' => 'Format nomor telepon tidak valid. Gunakan format 08xx atau 628xx.',
            'no_telp_pemohon.min' => 'Nomor telepon minimal 10 digit.',
            'no_telp_pemohon.max' => 'Nomor telepon maksimal 12 digit.',
            'no_telp_kuasa.min' => 'Nomor telepon minimal 10 digit.',
            'no_telp_kuasa.max' => 'Nomor telepon maksimal 12 digit.',
            'email_pemohon.email' => 'Format email tidak valid.',
            'alasan.required' => 'Pilih minimal satu alasan keberatan.',
            'alasan.min' => 'Pilih minimal satu alasan keberatan.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama_pemohon' => $this->sanitizeString($this->nama_pemohon),
            'alamat_pemohon' => $this->sanitizeString($this->alamat_pemohon),
            'tujuan' => $this->sanitizeString($this->tujuan),
            'kasus' => $this->sanitizeString($this->kasus),
            'nama_kuasa' => $this->sanitizeString($this->nama_kuasa),
            'alamat_kuasa' => $this->sanitizeString($this->alamat_kuasa),
            'no_telp_pemohon' => preg_replace('/[^0-9+]/', '', $this->no_telp_pemohon ?? ''),
            'no_telp_kuasa' => preg_replace('/[^0-9+]/', '', $this->no_telp_kuasa ?? ''),
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

        $value = strip_tags($value);
        $value = trim($value);
        $value = str_replace(chr(0), '', $value);
        $value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8', false);

        return $value;
    }
}
