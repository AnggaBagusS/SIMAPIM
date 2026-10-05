<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdatePetugasRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan melakukan request ini.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->type == 1; // Hanya admin
    }

    /**
     * Aturan validasi pembaruan petugas.
     */
    public function rules(): array
    {
        $targetUser = $this->route('petuga');
        $userId = $targetUser instanceof User ? $targetUser->id : ($targetUser ?? $this->route('id'));

        return [
            'firstname' => 'required|string|max:200',
            'lastname'  => 'nullable|string|max:200',
            'email'     => 'required|email|max:200|unique:users,email,' . $userId,
            'password'  => 'nullable|string|min:6|confirmed',
            'type'      => 'required|in:1,2',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    /**
     * Pesan kustom validasi.
     */
    public function messages(): array
    {
        return [
            'firstname.required' => 'Nama depan wajib diisi.',
            'email.required'     => 'Alamat email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Alamat email sudah digunakan oleh pengguna lain.',
            'password.min'       => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'avatar.image'       => 'Berkas avatar harus berupa gambar.',
            'avatar.mimes'       => 'Format avatar yang didukung: JPG, JPEG, PNG.',
            'avatar.max'         => 'Ukuran foto avatar maksimal 2 MB.',
        ];
    }
}
