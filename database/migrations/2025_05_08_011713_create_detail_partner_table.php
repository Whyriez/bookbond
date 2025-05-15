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
        Schema::create('detail_partner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->string('shop_name');
            $table->string('personal_email');
            $table->string('phone_number');
            $table->string('address');
            $table->string('city');
            $table->string('zip');
            $table->string('website')->nullable();
            $table->string('short_description');
            $table->string('bussiness_hours');
            $table->string('logo')->nullable();
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_partner');
    }
};
