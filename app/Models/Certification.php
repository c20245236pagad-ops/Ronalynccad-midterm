<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'enrollment_id',
        'cert_number',
        'issue_date',
        'cert_status',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}