<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentWritte extends Eloquent
{
    use HasFactory;

    protected $fillable = [
        'student_record_id', 'date_at', 'session_time', 'reason',    
    ];

    public function student_record()
    {
        return $this->belongsTo(StudentRecord::class);
    } 
}
