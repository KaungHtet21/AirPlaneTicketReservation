<?php

namespace App\Models;

use App\Models\flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class seat extends Model
{
    use HasFactory;
    protected $fillable = [
        'seat_number',
        'flight_id',
        'class',
        'price',
        'available'
    ];
    protected $primaryKey = 'seat_id';
    public function flight(){
        return $this->belongsTo(flight::class,'flight_id','flight_id');
    }
    
}
