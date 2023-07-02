<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory;
     protected $fillable = [
        'reservation_number',
        'contact_id',
        'departFlight_id',
        'returnFlight_id',
        'total_seats',
        'total_amount',
        'headOffice_id',
        'due_date',
        'status'

    ];
}
