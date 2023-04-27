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
            $table->foreignId('fitness_center_id')->constrained('fitness_centers');
            $table->string('event_name');
            $table->text('event_description');
            $table->date('event_date');
            $table->string('event_location');
            $table->enum('event_type', ['indoors', 'outdoors']);
            $table->integer('max_participants');
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
