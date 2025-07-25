<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 200);
            $table->string('lastname', 200);
            $table->string('email', 200)->unique();
            $table->text('password');
            $table->tinyInteger('type')->default(2)->comment('1 = admin, 2 = staff, 3 = petugas');
            $table->string('avatar', 255)->default('no-image-available.png');
            $table->timestamp('date_created')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
