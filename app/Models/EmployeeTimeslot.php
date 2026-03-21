<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeTimeslot extends Model
{
    use HasFactory;

    protected $fillable = [
        'timeslot_id',
        'employee_id',
        'queue_position',
        'is_assigned'
    ];
}

