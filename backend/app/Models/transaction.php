<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
      use HasFactory;
    protected $fillable = [
        'transaction_number',
        'contact_id',
        'departFlight_id',
        'returnFlight_id',
        'payment',
        'total_seats',
        'total_amount',
        'payment_id',
        'transaction_date',
        'status'
    ];
    public $timestamps = false;
  
   public function contact(){
    return $this->belongsTo(contact::class,'contact_id','contact_id');
   }
}
