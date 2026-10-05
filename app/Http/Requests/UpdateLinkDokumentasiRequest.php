<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLinkDokumentasiRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan melakukan request ini.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Aturan validasi pembaruan link Google Drive dokumentasi.
     */
    public function rules(): array
    {
        return [
            'link' => 'nullable|url|max:1000',
        ];
    }

    /**
     * Pesan kustom validasi.
     */
    public function messages(): array
    {
        return [
            'link.url' => 'Format tautan Google Drive harus berupa URL yang valid (diawali https://).',
            'link.max' => 'Panjang karakter tautan maksimal 1000 karakter.',
        ];
    }
}
