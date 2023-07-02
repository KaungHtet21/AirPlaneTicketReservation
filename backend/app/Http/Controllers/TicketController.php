<?php

namespace App\Http\Controllers;

use App\Models\seat;
use App\Models\flight;
use App\Models\ticket;
use App\Models\contact;
use App\Models\passenger;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function manageTickets(){
        $tickets = ticket::paginate(20);
        $passengers = passenger::get();
        $seats = seat::get();
        $flights = flight::get();
        return view('admin.tickets.tickets')
                ->with(['tickets'=>$tickets,'passengers'=>$passengers,'seats'=>$seats,'flights'=>$flights]);
    }

    public function filterConfirmedTickets(){
        $tickets = ticket::where('status','success')->paginate(20);
        $msg = 'Filtered Confirmed Tickets';
        $passengers = passenger::get();
        $seats = seat::get();
        $flights = flight::get();
        return view('admin.tickets.tickets')
                ->with(['tickets'=>$tickets,'passengers'=>$passengers,'seats'=>$seats,'flights'=>$flights,'msg'=>$msg]);
    }

    public function filterPendingTickets(){
        $tickets = ticket::where('status','pending')->paginate(20);
        $msg = 'Filtered Pending Tickets';
        $passengers = passenger::get();
        $seats = seat::get();
        $flights = flight::get();
        return view('admin.tickets.tickets')
                ->with(['tickets'=>$tickets,'passengers'=>$passengers,'seats'=>$seats,'flights'=>$flights,'msg'=>$msg]);
    }
    public function filterCancelledTickets(){
        $tickets = ticket::where('status','cancelled')->paginate(20);
        $msg = 'Filtered Cancelled Tickets';
        $passengers = passenger::get();
        $seats = seat::get();
        $flights = flight::get();
        return view('admin.tickets.tickets')
                ->with(['tickets'=>$tickets,'passengers'=>$passengers,'seats'=>$seats,'flights'=>$flights,'msg'=>$msg]);
    }
}
