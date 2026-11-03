<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeCourse extends Model
{
    protected $fillable = [
        'instructor_id',
        'course_name',
        'training_hours',
        'passing_grade',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}