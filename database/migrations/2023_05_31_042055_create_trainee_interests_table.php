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
        Schema::create('trainee_interests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainee_id')
                ->constrained(table: 'trainees', column: 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        $table->foreignId('topic_id')
                ->constrained(table: 'topics', column: 'id')
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
        Schema::dropIfExists('trainee_interests');
    }
};
