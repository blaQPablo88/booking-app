<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timeslot extends Model
{
    use HasFactory;

    // Allows mass assignment when creating timeslots
    protected $fillable = [
        'start_time',
        'end_time',
    ];

    // Relationship: one timeslot has many queue entries
    public function employeeTimeslots()
    {
        return $this->hasMany(EmployeeTimeslot::class);
    }
}
