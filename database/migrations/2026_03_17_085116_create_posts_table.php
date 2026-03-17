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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title", 255);
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('post_cats')->onDelete('cascade');
            $table->string('thumbnail', 255);
            $table->enum('status', ['pending', 'public']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
