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
        Schema::create('book_categories_partner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partnerId');
            $table->string('name');
            $table->timestamps();

            $table->foreign('partnerId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_categories_partner');
    }
};
