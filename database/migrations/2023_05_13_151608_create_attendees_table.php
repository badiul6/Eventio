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
        Schema::create('attendees', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('contact');
            $table->string('uniname')->nullable();
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
            $table->foreign('uniname')->references('uniname')->on('universities')->onDelete('set null');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees');
    }
};
