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
        Schema::create('timeslots', function (Blueprint $table) {
            
            $table->id(); // Primary key

            // Starting time of the timeslot e.g. (09:30)
            // Defines when the booking begins
            $table->time('start_time');
            
            // The ending time of the timeslot e.g. (09:30)
            // Defines when the booking ends
            $table->time('end_time');
            
            $table->timestamps(); // Adds created_at and updated_at timestamp columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeslots');
    }
};
