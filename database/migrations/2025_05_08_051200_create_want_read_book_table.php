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
        Schema::create('want_read_book', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookId');
            $table->unsignedBigInteger('userId');
            $table->boolean('isRead');
            $table->timestamps();

            $table->foreign('bookId')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('want_read_book');
    }
};
