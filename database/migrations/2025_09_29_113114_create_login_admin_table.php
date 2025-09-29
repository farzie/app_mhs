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

/*
INSERT INTO `login_admin` (`id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, 'admin', '$2y$12$7JCIj5RZoG9/zvgMq4tu/ubvwHyQemIPb9fznwj3RBxEgXdXxstH6', NULL, '2025-09-29 17:12:57', '2025-09-29 17:34:52')
*/