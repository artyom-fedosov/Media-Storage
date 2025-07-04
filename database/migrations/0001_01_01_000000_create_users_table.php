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
        Schema::create('users', function (Blueprint $table) {
            $table->string('login')->unique()->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('theme_style')->default('light');
            $table->integer('density')->default(100);
            $table->string('language')->default('en');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
