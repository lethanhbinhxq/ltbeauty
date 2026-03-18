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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string('slug', 255)->unique();
            $table->text('description');
            $table->unsignedBigInteger('price');
            $table->string('thumbnail', 255);
            $table->text('detail');
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('product_cats')->onDelete('cascade');
            $table->enum('status', ['pending', 'public']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
