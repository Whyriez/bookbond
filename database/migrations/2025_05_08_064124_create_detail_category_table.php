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
        Schema::create('detail_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookId');
            $table->unsignedBigInteger('categoryId');
            $table->timestamps();

            $table->foreign('bookId')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('categoryId')->references('id')->on('category_book')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_category');
    }
};
