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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // Primary key
            
            // Email address of the person making a booking
            // Identitifies the user without a full user model
            $table->string('user_email');

            // Foreign key referencing the 'employee_timeslots' table
            // Ensures each booking is tied to a specific employee timeslot
            $table->foreignId('employee_timeslot_id')->constrained('employee_timeslots')->cascadeOnDelete();

            $table->timestamps(); // Adds created_at and updated_at timestamp columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
