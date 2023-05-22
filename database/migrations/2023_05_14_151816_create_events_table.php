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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('society_email')->nullable(); // Add email column
            $table->string('uni_email'); // Add email column
            $table->string('name', 255);
            $table->string('niche', 255);
            $table->string('location', 255);
            $table->double('capacity', 3);
            $table->foreign('society_email')->references('email')->on('societies')->onDelete('set null');
            $table->foreign('uni_email')->references('email')->on('universities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
