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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->enum('status',['pending','accepted'])->default('pending');

            $table->foreignId('uni_id')
                ->constrained(table: 'universities', column: 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('event_id')
                ->constrained(table: 'events', column: 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('trainee_id')
                ->constrained(table: 'trainees', column: 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
