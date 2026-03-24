<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Timeslot
 *
 * Represents a time window that can be assigned to one or more employees.
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $start_time
 * @property string $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EmployeeTimeslot[] $employeeTimeslots
 */

class Timeslot extends Model
{
    use HasFactory;

/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // Allows mass assignment when creating timeslots
    protected $fillable = [
        'start_time',
        'end_time',
    ];
    
    protected $casts = [
        'date' => 'date',
    ];

    // Relationship: one timeslot has many queue entries
    public function employeeTimeslots() {
        return $this->hasMany(EmployeeTimeslot::class);
    }
    public function isFull() {
        return $this->employeeTimeslots()
            ->where('is_assigned', false)
            ->count() === 0;
    }
}
