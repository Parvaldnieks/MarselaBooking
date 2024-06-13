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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('availability');
            $table->integer('rating')->nullable();
            $table->integer('price');
            $table->json('images')->nullable(); // Use json type to store image URLs as JSON array
            $table->timestamps();
        });               
    }

    public function down()
    {
        Schema::dropIfExists('apartments');
    }
};