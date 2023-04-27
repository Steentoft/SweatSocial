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
        Schema::create('fitness_centers', function (Blueprint $table) {
            $table->id();
            $table->string('center_name');
            $table->string('center_address');
            $table->text('center_description');
            $table->text('center_facilities');
            $table->text('contant_info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitness_centers');
    }
};
