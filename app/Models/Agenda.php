<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;

    // Secara eksplisit beri tahu nama tabel aslinya
    protected $table = 'project_lists';

    // Jika tidak pakai timestamps (created_at, updated_at), set ini:
    public $timestamps = false;
    

    // Kolom-kolom yang bisa diisi massal
    protected $fillable = [
        'judul_acara',
        'tanggal',
        'hari',
        'lokasi',
        'pejabat',
        'link',
        'file_sambutan',
        'user_ids',
    ];
    protected $casts = [
        'user_ids' => 'array', // jika Anda sudah simpan dalam bentuk JSON
    ];

    // Relasi ke petugas (jika ada pivot table, misal: project_user)
    public function getPetugasAttribute()
    {
        $ids = is_array($this->user_ids)
            ? $this->user_ids
            : explode(',', $this->user_ids);

        return User::whereIn('id', $ids)->get();
    }
}
