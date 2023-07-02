<?php

namespace App\Models;

use App\Models\passenger;
use App\Models\transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'user_id',
        'email',
        'phone_number',
        'address',
    ];
    public function passengers(){
        return $this->hasMany(passenger::class,'contact_id','contact_id');
    }
    public function transactions(){
        return $this->hasMany(transaction::class,'contact_id','contact_id');
    }
}
