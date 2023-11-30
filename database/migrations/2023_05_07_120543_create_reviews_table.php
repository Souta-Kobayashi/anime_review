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
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('video_id'); // foreign key
            $table->unsignedSmallInteger('watched_status');
            $table->unsignedDecimal('review_story',       5, 1)->nullable();
            $table->unsignedDecimal('review_drawing',     5, 1)->nullable();
            $table->unsignedDecimal('review_voice_actor', 5, 1)->nullable();
            $table->unsignedDecimal('review_music',       5, 1)->nullable();
            $table->unsignedDecimal('review_characters',  5, 1)->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
