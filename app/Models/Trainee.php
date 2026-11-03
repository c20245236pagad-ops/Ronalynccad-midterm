<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    protected $fillable = [
        'trainee_name',
        'trainee_email',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}