<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambah kolom waktu (jam_mulai, jam_selesai) dan status pada tabel project_lists
        Schema::table('project_lists', function (Blueprint $table) {
            $table->time('jam_mulai')->nullable()->after('hari');
            $table->time('jam_selesai')->nullable()->after('jam_mulai');
            $table->string('status', 30)->default('terjadwal')->after('link');
        });

        // 2. Buat tabel pivot agenda_user
        Schema::create('agenda_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agenda_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('agenda_id')->references('id')->on('project_lists')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['agenda_id', 'user_id']);
        });

        // 3. Migrasi data lama dari project_lists.user_ids (CSV) ke agenda_user
        $agendas = DB::table('project_lists')->get();
        $now = now();
        $pivotRows = [];

        foreach ($agendas as $agenda) {
            if (!empty($agenda->user_ids)) {
                $ids = explode(',', $agenda->user_ids);
                foreach ($ids as $userId) {
                    $userId = trim($userId);
                    if (is_numeric($userId) && DB::table('users')->where('id', $userId)->exists()) {
                        $pivotRows[] = [
                            'agenda_id'  => $agenda->id,
                            'user_id'    => (int) $userId,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                }
            }
        }

        if (!empty($pivotRows)) {
            // Gunakan insertOrIgnore untuk mencegah duplikasi
            DB::table('agenda_user')->insertOrIgnore($pivotRows);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_user');

        Schema::table('project_lists', function (Blueprint $table) {
            $table->dropColumn(['jam_mulai', 'jam_selesai', 'status']);
        });
    }
};
