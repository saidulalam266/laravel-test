<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'second_name',
        'phone_number',
        'email',
        'date_of_birth',
        'salary',
    ];

    protected $casts = [
        'date_of_birth' => 'date:Y-m-d'
    ];
    
}
