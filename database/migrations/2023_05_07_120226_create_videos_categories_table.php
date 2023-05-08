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
        Schema::create('videos_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('video_id'); // foreign key
            $table->unsignedInteger('category_id'); // foreign key
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('video_id')
                    ->references('id')
                    ->on('videos')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();

            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos_categories');
    }
};
