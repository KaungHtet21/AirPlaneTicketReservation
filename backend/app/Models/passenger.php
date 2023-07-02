<?php

namespace App\Models;

use App\Models\ticket;
use App\Models\contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class passenger extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_id',
        'full_name',
        'dob',
        'gender',
        'nationality',
        'nrc',
        'passport',
    ];
      
     public function contact(){
       return $this->belongsTo(contact::class,'contact_id','contact_id');
    }
    public function ticket(){
        return $this->hasOne(ticket::class,'passenger_id','passenger_id');
    }
    
}
