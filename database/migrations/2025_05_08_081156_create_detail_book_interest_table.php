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
        Schema::create('detail_book_interest', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookInterestId');
            $table->unsignedBigInteger('categoryId');
            $table->timestamps();

            $table->foreign('bookInterestId')->references('id')->on('book_interest')->onDelete('cascade');
            $table->foreign('categoryId')->references('id')->on('category_book')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_book_interest');
    }
};
