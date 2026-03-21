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
        Schema::create('employee_timeslots', function (Blueprint $table) {
            
            $table->id(); // Primary key
            
            // Foreign key linking to timeslots table
            // Indicates which timeslot this queue entry belongs to
            $table->foreignId('timeslot_id')->constrained()->cascadeOnDelete();
            
            // Foreign key linking to employees table
            // Identifies which employee is assigned to this timeslot queue
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            
            // Determines the order of employees in the queue for a specific timeslot per 'employees.role'
            // Lower numbers are assigned first (e.g. 1 = first in line)
            $table->integer('queue_position');

            // Indicates whether the employee has already been assigned to a booking
            // false = available, true = already assigned
            $table->boolean('is_assigned')->default(false);
            
            $table->timestamps(); // Adds created_at and updated_at timestamp columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_timeslots');
    }
};
