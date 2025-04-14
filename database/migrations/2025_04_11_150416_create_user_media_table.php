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
        Schema::create('user_media', function (Blueprint $table) {
            $table->string('user_login');
            $table->string('media_uuid');
            $table->foreign('user_login')->references('login')->on('users')->onDelete('cascade');
            $table->foreign('media_uuid')->references('uuid')->on('media')->onDelete('cascade');
            $table->primary(['user_login', 'media_uuid']);
            $table->boolean('read');
            $table->boolean('write');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_media');
    }
};
