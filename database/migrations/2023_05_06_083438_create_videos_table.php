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
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 400)->unique();
            $table->string('broadcast_date', 100)->nullable();
            $table->unsignedSmallInteger('genre')->nullable();
            $table->text('synopsis')->nullable();
            $table->mediumText('key_visual_url')->nullable();
            $table->string('key_visual_reference', 450)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
