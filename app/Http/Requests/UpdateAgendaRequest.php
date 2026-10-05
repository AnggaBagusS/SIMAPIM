<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgendaRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan melakukan request ini.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->type == 1; // Hanya admin
    }

    /**
     * Aturan validasi untuk pembaruan agenda.
     */
    public function rules(): array
    {
        return [
            'judul_acara'   => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'hari'          => 'nullable|string|max:50',
            'jam_mulai'     => 'nullable',
            'jam_selesai'   => 'nullable',
            'status'        => 'required|in:terjadwal,berlangsung,selesai,batal',
            'lokasi'        => 'nullable|string',
            'pejabat'       => 'nullable|string|max:255',
            'link'          => 'nullable|url|max:1000',
            'file_sambutan' => 'nullable|file|mimes:pdf|max:2048',
            'user_ids'      => 'required|array|min:1',
            'user_ids.*'    => 'exists:users,id',
        ];
    }

    /**
     * Pesan kustom validasi.
     */
    public function messages(): array
    {
        return [
            'judul_acara.required' => 'Judul acara wajib diisi.',
            'tanggal.required'     => 'Tanggal acara wajib dipilih.',
            'status.required'      => 'Status agenda wajib dipilih.',
            'user_ids.required'    => 'Pilih minimal satu petugas pendamping.',
            'user_ids.min'         => 'Pilih minimal satu petugas pendamping.',
            'file_sambutan.mimes'  => 'Berkas sambutan harus berupa dokumen PDF.',
            'file_sambutan.max'    => 'Ukuran berkas sambutan maksimal 2 MB.',
            'link.url'             => 'Format link dokumentasi harus berupa tautan URL yang valid.',
        ];
    }
}
