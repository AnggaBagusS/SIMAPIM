<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan melakukan request ini.
     */
    public function authorize(): bool
    {
        return auth()->check(); // Siapapun yang login bisa ubah profilnya sendiri
    }

    /**
     * Aturan validasi pembaruan profil mandiri.
     */
    public function rules(): array
    {
        $userId = auth()->id();

        return [
            'firstname' => 'nullable|string|max:200',
            'lastname'  => 'nullable|string|max:200',
            'email'     => 'nullable|email|max:200|unique:users,email,' . $userId,
            'password'  => 'nullable|string|min:6',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    /**
     * Pesan kustom validasi.
     */
    public function messages(): array
    {
        return [
            'email.email'   => 'Format alamat email tidak valid.',
            'email.unique'  => 'Alamat email sudah digunakan oleh pengguna lain.',
            'password.min'  => 'Kata sandi baru minimal 6 karakter.',
            'avatar.image'  => 'Berkas avatar harus berupa file gambar.',
            'avatar.mimes'  => 'Format avatar yang didukung: JPG, JPEG, PNG.',
            'avatar.max'    => 'Ukuran foto profil maksimal 2 MB.',
        ];
    }
}
