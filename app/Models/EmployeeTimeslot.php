<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EmployeeTimeslot
 *
 * Represents the assignment of an employee to a specific timeslot,
 * including their queue position and assignment status.
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $timeslot_id
 * @property int $employee_id
 * @property int $queue_position
 * @property bool $is_assigned
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Timeslot $timeslot
 * @property-read \App\Models\Employee $employee
 */

class EmployeeTimeslot extends Model
{
    use HasFactory;

    protected $fillable = [
        'timeslot_id',
        'employee_id',
        'queue_position',
        'is_assigned'
    ];

/**
     * Get the timeslot associated with this record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function timeslot() {
        return $this->belongsTo(Timeslot::class);
    }
    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}

