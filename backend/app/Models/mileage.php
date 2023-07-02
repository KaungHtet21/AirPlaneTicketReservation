<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mileage extends Model
{
    use HasFactory;
    protected $fillable = [
        'passenger_name',
        'nrc',
        'passport',
        'miles_travelled',
        'membership_tier',
        'member_code'
    ];
      
}
