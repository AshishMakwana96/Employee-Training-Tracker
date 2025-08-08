<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'department',
        'status',
    ];

    public function assignments()
    {
        return $this->hasMany(TrainingAssignment::class, 'employee_id');
    }
}
