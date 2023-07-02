<?php

namespace App\Models;

use App\Models\seat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class flight extends Model
{
    use HasFactory;
    protected $fillable = [
        'flight_number',
        'from',
        'to',
        'depart_date',
        'depart_time',
        'arrive_time',
        'flight_distance',
    ];
    public function seats(){
        return $this->hasMany(seat::class,'flight_id','flight_id');
    }
}
 