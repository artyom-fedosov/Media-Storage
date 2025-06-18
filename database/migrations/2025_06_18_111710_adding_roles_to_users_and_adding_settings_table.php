<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('theme_style')->default('light');
            $table->string('density')->default('comfortable');
            $table->string('user_login')->unique();
            $table->foreign('user_login')->references('login')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['theme_style', 'density']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('simple');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
