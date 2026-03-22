<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Booking
 *
 * Represents a user booking for a specific employee timeslot.
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $user_email
 * @property int $employee_timeslot_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\EmployeeTimeslot $employeeTimeslot
 */

class Booking extends Model {
    use HasFactory;

/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'user_email',
        'employee_timeslot_id'
    ];

    public function employeeTimeslot() {
        return $this->belongsTo(EmployeeTimeslot::class);
    }

}
