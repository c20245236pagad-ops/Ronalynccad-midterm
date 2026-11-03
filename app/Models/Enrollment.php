<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'trainee_id',
        'trade_course_id',
        'assessment_score',
    ];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }

    public function tradeCourse()
    {
        return $this->belongsTo(TradeCourse::class);
    }

    public function certification()
    {
        return $this->hasOne(Certification::class);
    }
}