<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->string('title', 25);
            $table->mediumInteger('year');
            $table->string('rating', 3);
            $table->boolean('is_bookmarked')->default(false);
            $table->boolean('is_trending')->default(false);
            $table->tinyInteger('category');
            $table->string('thumbnail_small', 100);
            $table->string('thumbnail_medium', 100);
            $table->string('thumbnail_large', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shows');
    }
};
