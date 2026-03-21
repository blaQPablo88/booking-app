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
        Schema::create('employees', function (Blueprint $table) {
        
            $table->id(); // Primary key

            // Store full name of employee e.g. (Kagiso Mogotsi)
            $table->string('full_name');

            // Stores role/position of the employee
            // e.g. (Technician, Agent)
            $table->string('position');
            
            $table->timestamps(); // Adds created_at and updated_at timestamp columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
