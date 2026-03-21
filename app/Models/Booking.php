<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_email',
        'employee_timeslot_id'
    ];

    public function employeeTimeslot() {
        return $this->belongsTo(EmployeeTimeslot::class);
    }

}
