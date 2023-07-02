<?php

namespace App\Http\Controllers;

use App\Models\seat;
use App\Models\flight;
use App\Models\contact;
use App\Models\master;
use App\Models\visa;
use App\Models\user;
use App\Models\mileage;
use Illuminate\Http\Request;
use App\Mail\EmailConfirmationMail;
use Illuminate\Support\Facades\Mail;

class RouteController extends Controller
{
    public function register(Request $req){
        $user = new user();
        $user->name = $req->input('name');
        $user->surname = $req->input('surname');
        $user->title = $req->input('title');
        $user->email = $req->input('email');
        $user->password = $req->input('password');
        $user->save();
        return user::get();
        return $user;
    }
       public function getFlights()
    {
        
        return flight::get();
    }

    // Seats
    public function getSeats()
    {
        return seat::get();
    }

    // Mmebers 
    public function getMembers() {
        return mileage::get();
    }

    public function getUsers() {
        return user::get();
    }

    public function getEmailCode(Request $request) {
        $data = $request;
        
     Mail::to($data['email'])->send(new EmailConfirmationMail($data));
    //    return $request;
    }

    public function getVisas() {
        return visa::get();
    }

    public function getMasters() {
        return master::get();
    }

    public function postPassengersInfo(Request $request)
    {
        $data =  $request;
       
    }

  
}
