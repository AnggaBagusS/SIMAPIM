<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;
use Illuminate\Support\Facades\DB;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan tabel sebelum seeding dengan menonaktifkan pengecekan foreign key sementara
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        DB::table('agenda_user')->truncate();
        DB::table('project_lists')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $agendas = [
            [
                'judul_acara'   => 'Rapat Koordinasi Evaluasi Program Kerja Triwulan III',
                'tanggal'       => '2026-09-24',
                'hari'          => 'Kamis',
                'jam_mulai'     => '09:00:00',
                'jam_selesai'   => '12:00:00',
                'status'        => 'selesai',
                'lokasi'        => 'Ruang Rapat Utama Lantai 2, Kantor Gubernur',
                'pejabat'       => 'Gubernur / Sekretaris Daerah',
                'file_sambutan' => null,
                'link'          => 'https://drive.google.com/drive/folders/1A2b3C4d5E6f_dokumentasi_rakor',
                'user_ids'      => '2,3',
                'petugas_ids'   => [2, 3],
            ],
            [
                'judul_acara'   => 'Sosialisasi Penerapan Sistem Informasi Manajemen Terintegrasi',
                'tanggal'       => '2026-09-25',
                'hari'          => 'Jumat',
                'jam_mulai'     => '13:30:00',
                'jam_selesai'   => '16:00:00',
                'status'        => 'selesai',
                'lokasi'        => 'Aula Gedung Pertemuan Serbaguna',
                'pejabat'       => 'Kepala Dinas Kominfo',
                'file_sambutan' => null,
                'link'          => null,
                'user_ids'      => '2,4',
                'petugas_ids'   => [2, 4],
            ],
            [
                'judul_acara'   => 'Seminar Nasional Transformasi Digital Sektor Publik',
                'tanggal'       => '2026-09-28',
                'hari'          => 'Senin',
                'jam_mulai'     => '08:00:00',
                'jam_selesai'   => '15:30:00',
                'status'        => 'selesai',
                'lokasi'        => 'Ballroom Grand Mercure Hotel, Bandar Lampung',
                'pejabat'       => 'Wakil Gubernur',
                'file_sambutan' => null,
                'link'          => 'https://drive.google.com/drive/folders/7X8y9Z0a1B2c_dokumentasi_seminar',
                'user_ids'      => '3,4',
                'petugas_ids'   => [3, 4],
            ],
            [
                'judul_acara'   => 'Monitoring dan Pengawasan Layanan Publik Wilayah',
                'tanggal'       => '2026-09-29',
                'hari'          => 'Selasa',
                'jam_mulai'     => '10:00:00',
                'jam_selesai'   => '14:00:00',
                'status'        => 'terjadwal',
                'lokasi'        => 'Ruang Command Center, Lt. 1',
                'pejabat'       => 'Asisten Bidang Pemerintahan dan Kesra',
                'file_sambutan' => null,
                'link'          => null,
                'user_ids'      => '2',
                'petugas_ids'   => [2],
            ],
        ];

        foreach ($agendas as $item) {
            $petugasIds = $item['petugas_ids'];
            unset($item['petugas_ids']);

            $agenda = Agenda::create($item);
            $agenda->petugas()->sync($petugasIds);
        }
    }
}
