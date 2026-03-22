<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Employee
 *
 * Represents an employee that can be assigned to timeslots.
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $full_name
 * @property string $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EmployeeTimeslot[] $employeeTimeslots
 */

class Employee extends Model
{
    use HasFactory;

/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'full_name', 
        'position'
    ];
}
