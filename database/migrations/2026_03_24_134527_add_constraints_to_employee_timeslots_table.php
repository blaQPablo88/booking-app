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
        Schema::table('employee_timeslots', function (Blueprint $table) {
            $table->unique(['timeslot_id', 'queue_position'], 'unique_timeslot_queue_position');
            $table->unique(['timeslot_id', 'employee_id'], 'unique_timeslot_employee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_timeslots', function (Blueprint $table) {
            $table->dropUnique('unique_timeslot_queue_position');
            $table->dropUnique('unique_timeslot_employee');
        });
    }
};
