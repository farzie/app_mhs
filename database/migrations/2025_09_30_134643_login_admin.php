<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('login_admin', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique(); // Username admin
            $table->string('password'); // Kolom password WAJIB BCrypt
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('login_admin');
    }
};