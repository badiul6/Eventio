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
        Schema::create('societies', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('name');
            $table->string('type');
            $table->string('uniname');
            $table->foreign('email')->references('email')->on('users');
            $table->foreign('uniname')->references('uniname')->on('universities');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('societies');
    }
};
