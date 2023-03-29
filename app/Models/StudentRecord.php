<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentRecord extends Eloquent
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'my_class_id', 'my_parent_id', 'adm_no', 'year_admitted', 'wd', 'wd_date', 'grad', 'grad_date', 'age'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function my_parent()
    {
        return $this->belongsTo(User::class, 'my_parent_id');
    }

    public function my_class()
    {
        return $this->belongsTo(MyClass::class);
    }

}
