<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;
     protected $fillable = [
    'ticket_number',
    'passenger_id',
    'seat_id',
    'price',
    'status',
    ];
     public function passenger(){
        return $this->hasOne(passenger::class,'passenger_id','passenger_id');
    }
}
