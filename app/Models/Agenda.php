<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Agenda extends Model
{
    use HasFactory, LogsActivity;

    /**
     * Konfigurasi pencatatan audit log aktivitas.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judul_acara', 'tanggal', 'hari', 'jam_mulai', 'jam_selesai', 'lokasi', 'pejabat', 'status', 'link', 'file_sambutan'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('agenda')
            ->setDescriptionForEvent(fn(string $eventName) => "Agenda {$eventName}");
    }

    // Secara eksplisit beri tahu nama tabel aslinya
    protected $table = 'project_lists';

    // Jika tidak pakai timestamps default (created_at, updated_at):
    public $timestamps = false;

    // Kolom-kolom yang bisa diisi massal
    protected $fillable = [
        'judul_acara',
        'tanggal',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'pejabat',
        'link',
        'status',
        'file_sambutan',
        'user_ids',
    ];

    /**
     * Relasi many-to-many ke Petugas (User) melalui tabel pivot agenda_user.
     */
    public function petugas(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'agenda_user', 'agenda_id', 'user_id')->withTimestamps();
    }

    /**
     * Helper waktu pelaksanaan format (jam_mulai - jam_selesai).
     */
    public function getWaktuFormattedAttribute(): string
    {
        if ($this->jam_mulai && $this->jam_selesai) {
            return substr($this->jam_mulai, 0, 5) . ' - ' . substr($this->jam_selesai, 0, 5) . ' WIB';
        } elseif ($this->jam_mulai) {
            return substr($this->jam_mulai, 0, 5) . ' WIB - Selesai';
        }
        return 'Waktu belum ditentukan';
    }

    /**
     * Helper status badge styling.
     */
    public function getStatusBadgeAttribute(): array
    {
        return match ($this->status) {
            'berlangsung' => [
                'label' => 'Sedang Berlangsung',
                'class' => 'bg-amber-50 text-amber-700 border-amber-200/80',
                'dot'   => 'bg-amber-500 animate-pulse',
            ],
            'selesai' => [
                'label' => 'Selesai',
                'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200/80',
                'dot'   => 'bg-emerald-500',
            ],
            'batal' => [
                'label' => 'Dibatalkan',
                'class' => 'bg-rose-50 text-rose-700 border-rose-200/80',
                'dot'   => 'bg-rose-500',
            ],
            default => [
                'label' => 'Terjadwal',
                'class' => 'bg-blue-50 text-blue-700 border-blue-200/80',
                'dot'   => 'bg-blue-500',
            ],
        };
    }
}
