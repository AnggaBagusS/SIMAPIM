<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_lists', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('hari', 50)->nullable();
            $table->text('lokasi')->nullable();
            $table->string('judul_acara', 255)->nullable();
            $table->string('pejabat', 255)->nullable();
            $table->string('file_sambutan', 255)->nullable();
            $table->text('link')->nullable();
            $table->text('user_ids');
            $table->timestamp('date_created')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_lists');
    }
};
