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
        Schema::create('category_community', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('community_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('community_id')->references('id')->on('community')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('category_book')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_community');
    }
};
