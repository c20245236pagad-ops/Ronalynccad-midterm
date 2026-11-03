<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'instructor_name',
    ];

    public function tradeCourses()
    {
        return $this->hasMany(TradeCourse::class);
    }
}
