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
            
            $table->string('name', 255);
            $table->string('description', 255);
            $table->string('location', 255);
            $table->double('capacity', 3);
            
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status',['pending','active','completed'])->default('pending');

            $table->foreignId('uni_id')
                  ->constrained(table: 'universities', column: 'id')
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
        Schema::dropIfExists('events');
    }
};
