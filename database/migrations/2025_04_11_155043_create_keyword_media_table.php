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
        Schema::create('keyword_media', function (Blueprint $table) {
            $table->string('keyword_name');
            $table->string('media_uuid');
            $table->foreign('keyword_name')->references('name')->on('keywords')->onDelete('cascade');
            $table->foreign('media_uuid')->references('uuid')->on('media')->onDelete('cascade');
            $table->primary(['keyword_name', 'media_uuid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keyword_media');
    }
};
