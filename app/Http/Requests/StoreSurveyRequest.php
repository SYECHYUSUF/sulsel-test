<?php

namespace App\Http\Requests;

use App\Models\Survey;
use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyRequest extends FormRequest
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
        $validAnswers = ['Sangat Baik', 'Baik', 'Cukup Baik', 'Tidak Baik'];
        
        return [
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'nama' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\.\-\']+$/u'],
            'lembaga' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:500'],
            'tanggal' => ['required', 'date', 'before_or_equal:today'],
            'answer' => ['required', 'array'],
            'answer.*' => ['nullable', 'string', 'in:' . implode(',', $validAnswers)],
            'masukan' => ['nullable', 'string', 'max:2000'],
            
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
            'nama.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, dan tanda hubung.',
            'email.email' => 'Format email tidak valid.',
            'tanggal.before_or_equal' => 'Tanggal tidak boleh lebih dari hari ini.',
            'answer.*.in' => 'Pilihan jawaban tidak valid.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama' => $this->sanitizeString($this->nama),
            'lembaga' => $this->sanitizeString($this->lembaga),
            'alamat' => $this->sanitizeString($this->alamat),
            'masukan' => $this->sanitizeString($this->masukan),
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
