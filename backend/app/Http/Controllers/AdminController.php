<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use Carbon\Carbon;
use App\Models\seat;
use App\Models\user;
use App\Models\flight;
use App\Models\office;
use App\Models\ticket;
use App\Models\contact;
use App\Models\mileage;
use App\Models\passenger;
use App\Models\reservation;
use App\Models\transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\newMembershipMail;
use App\Mail\updateMembershipMail;
use Illuminate\Support\Facades\DB;
use App\Mail\cancellationFailedMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\cancellationSuccessMail;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function homePage(){
        // return 'hi there';
        return view('admin.login');
    }
    public function authentication(Request $request){ 
       if($request->email == 'admin@gmail.com' && $request->password=='admin123')

       {
            return redirect()->route('dashboard');
            
       }
       else{
         return back()->with(['failed'=>'Authentication failed']);
       }
    }
   public function dashboard(){
   
    return view("admin.dashboardTest");
   }
    public function manageFlights(){
        $flights =  flight::with('seats')->paginate(20);
        
        // foreach($flights as $flight){
        //    echo $flight->seats->where('available','1')->count();
        //    echo $flight->seats->where('available','0')->count();
        //  }
        // return 'done';
        
        return view('admin.flights.flights')->with(['flights'=>$flights]);
    }

    public function filterFlights(Request $request){
        $from = $request->from;
        $to = $request->to;
        $flights = flight::get();
        if($from == null && $to != null){
            $filterFlights = flight::where('to',$to)->get();
        }elseif($from != null && $to == null){
            $filterFlights = flight::where('from',$from)->get();
        }elseif($from != null && $to != null){
            $filterFlights = flight::where('from',$from)->where('to',$to)->get();
        }else{
              return view('admin.flights.flights')->with(['flights'=>$flights]);
        } 
    
     return view('admin.flights.flights')->with(['flights'=>$filterFlights,'paginate'=>'paginate']);
        
    }
    public function previousFlight(){
        $today = Carbon::now();
        $flights = flight::where('depart_date','<',$today)->paginate(20);
        return view('admin.flights.flights')->with(['flights'=>$flights,'previous'=>'previous']);
    }
     public function upcomingFlight(){
        $today = Carbon::now();
        $flights = flight::where('depart_date','>',$today)->paginate(20);
        return view('admin.flights.flights')->with(['flights'=>$flights,'upcoming'=>'upcoming']);
    }
     public function todayFlight(){
        $today = Carbon::now()->format('Y-m-d');
        $flights = flight::where('depart_date','=',$today)->paginate(20);
        return view('admin.flights.flights')->with(['flights'=>$flights,'today'=>'today']);
    }
     public function addFlights(){
        return view('admin.flights.addFlights');
    }

    public function addNewFlight(Request $request){
       
   
        Validator::make($request->all(), [
    'flightNumber' => 'required',
    'from' => 'required',
    'to' => 'required',
    'departDate' => 'required',
    'departTime' => 'required',
    'arriveTime' => 'required',
    'distance' => 'required',
    'businessNumber' => 'required',
    'businessPrice' => 'required',
    'economyNumber' => 'required',
    'economyPrice' => 'required',
])->validate();

flight::create([
            'flight_number' => $request->flightNumber,
            'from' => $request->from,
            'to' => $request->to,
            'depart_date' => $request->departDate,
            'depart_time' => $request->departTime,
            'arrive_time' => $request->arriveTime,
            'flight_distance' => $request->distance,
        ]);
        $businessNumber = $request->businessNumber;
        for($i=1;$i<=$businessNumber;$i++){
            seat::create([
                'seat_number' => 'B',
                'class' => 'business',
                'price' => $request->businessPrice,
                'available' => '1',
                'flight_id' => flight::orderBy('flight_id','DESC')->first()->flight_id,

            ]);
        }
   $economyNumber = $request->economyNumber;
        for($i=1;$i<=$economyNumber;$i++){
            seat::create([
                'seat_number' => 'E',
                'class' => 'economy',
                'price' => $request->economyPrice,
                'available' => '1',
                'flight_id' => flight::orderBy('flight_id','DESC')->first()->flight_id,
            ]);
        }

        return redirect()->route('manage#flights');
    }
      public function editFlight($id){
       $flight = flight::where('flight_id',$id)->first();
        return view('admin.flights.editFlights')->with(['id'=>$id,'flight'=>$flight]);
    }
    public function updateFlight($id,Request $request){
       
            Validator::make($request->all(), [
    'flightNumber' => 'required',
    'from' => 'required',
    'to' => 'required',
    'departDate' => 'required',
    'departTime' => 'required',
    'arriveTime' => 'required',
    'distance' => 'required',
])->validate();
   $flight = flight::where('flight_id',$id)->first();

       flight::where('flight_id',$id)->update([
            'flight_number' => $request->flightNumber,
            'from' => $request->from,
            'to' => $request->to,
            'depart_date' => $request->departDate,
            'depart_time' => $request->departTime,
            'arrive_time' => $request->arriveTime,
            'flight_distance' => $request->distance,
        ]);
        $businessNumber = $request->businessNumber;
        for($i=1;$i<=$businessNumber;$i++){
            seat::create([
                'seat_number' => 'B',
                'class' => 'business',
                'price' => $request->businessPrice,
                'available' => '1',
                'flight_id' => $id,

            ]);
        }
   $economyNumber = $request->economyNumber;
        for($i=1;$i<=$economyNumber;$i++){
            seat::create([
                'seat_number' => 'E',
                'class' => 'economy',
                'price' => $request->economyPrice,
                'available' => '1',
                'flight_id' => $id,
            ]);
        }
 return redirect()->route('manage#flights');
    }

       
    public function deleteFlight($id){
        flight::where('flight_id',$id)->delete();
       return redirect()->route('manage#flights');
    }

    //Seats
     public function manageSeats(){

         $seats = seat::with('flight')->paginate(50);
         $flights = flight::get();
        return view('admin.seats.seats')->with(['seats'=>$seats,'flights'=>$flights]);
     }
     
     public function searchSeats(Request $request){
         Validator::make($request->all(), [
            'flight_id' => 'required',
    
])->validate();
      $seats = seat::where('flight_id',$request->flight_id)->with('flight')->paginate(20);

       $flights = flight::get();
   return view('admin.seats.seats')->with(['seats'=>$seats,'flights'=>$flights]);
     }
     public function addSeats(){
        $flights = flight::get();
       
        return view('admin.seats.addSeats')->with(['flights'=>$flights]);
     }
     public function addNewSeats(Request $request){
           Validator::make($request->all(), [
            'flight_id' => 'required',
    'businessNumber' => 'required',
    'businessPrice' => 'required',
    'economyNumber' => 'required',
    'economyPrice' => 'required',
    
])->validate();
        $businessNumber = $request->businessNumber;
        for($i=1;$i<=$businessNumber;$i++){
            seat::create([
                'seat_number' => 'B',
                'class' => 'business',
                'price' => $request->businessPrice,
                'available' => '1',
                'flight_id' => $request->flight_id,
            ]);
        }
   $economyNumber = $request->economyNumber;
        for($i=1;$i<=$economyNumber;$i++){
            seat::create([
                'seat_number' => 'E',
                'class' => 'economy',
                'price' => $request->economyPrice,
                'available' => '1',
                'flight_id' => $request->flight_id,
            ]);
        }
return redirect()->route('manage#seats');
    }
public function editSeat($id){
    $seat = seat::where('seat_id',$id)->first();
    return view('admin.seats.editSeat')->with(['id'=>$id,'seat'=>$seat]);
}
public function updateSeat($id,Request $request){
    Validator::make($request->all(), [
    'seatNumber' => 'required',
    'price' => 'required',
    'class' => 'required',
    
])->validate();
    seat::where('seat_id',$id)->update([
        'seat_number' => $request->seatNumber,
        'price' => $request->price,
        'class' => $request->class,
    ]);
    
    return redirect()->route('manage#seats');
}
public function deleteSeat($id){
    seat::where('seat_id',$id)->delete();
    return redirect()->route('manage#seats');
}

public function updateSeatPrice(){
   
    $today = Carbon::now()->addDays(0);
    $nextFiveDays = $today->addDays(5);
  $flights = flight::where('depart_date','<',$today)->where('depart_date','>',$nextFiveDays)->with('seats')->get();
  
  // return Carbon::parse($flights->depart_date)->diffInDays($today);
    foreach($flights as $flight){
        foreach($flight->seats as $seat){
           
            $seat->update([
                'price' =>  $seat->price + 10,
               
            ]);
        }
    }
    
    return redirect()->route('manage#seats');
}
//transactions 

public function manageTransactions(){
       
    $recents = transaction::orderBy('transaction_id', 'DESC')->take(10)->get();
    $flights = flight::get();
   
    $contacts = contact::get();
    
    return view('admin.transactions.transactions')->with(['flights'=>$flights,'transactions'=>$recents,'contacts'=>$contacts]);
}
public function editTransaction($id){
      return view('admin.transactions.editTransaction')->with(['id',$id]);
}
public function deleteTransaction($id){
    transaction::where('transaction_id',$id)->delete();
    // return redirect()->route('manage#transactions');
}
 public function searchTransactions(Request $request){
         Validator::make($request->all(), [
            'flight_id' => 'required',
    
])->validate();
      $transactions = transaction::where('departFlight_id',$request->flight_id)->get();
    $contacts = contact::get();
       $flights = flight::get();
   return view('admin.transactions.transactions')->with(['transactions'=>$transactions,'flights'=>$flights,'contacts'=>$contacts]);
     }

public function detailsTransaction($id){
   $transaction = transaction::where('transaction_id',$id)->with('contact')->first();
   $departFlight = flight::where('flight_id',$transaction->departFlight_id)->first();
   $returnFlight = flight::where('flight_id',$transaction->returnFlight_id)->first();
   $contact = contact::where('contact_id',$transaction->contact_id)->with('passengers')->first();
//    return $contact->passengers->count();
 
   return view('admin.transactions.detailsTransaction')->with(['transaction'=>$transaction,'departFlight'=>$departFlight,
   'returnFlight'=>$returnFlight,'contact'=>$contact]);
}

public function filterTransactions(Request $request){
    $now = Carbon::now();
     if($request->day == 'thirty'){
        $day = 30;
        $subDate = $now->subDay($day);
        $recents = transaction::where('transaction_date','>',$subDate)->get();
     }elseif($request->day == 'week'){
        $day = 7;
        $subDate = $now->subDay($day);
        $recents = transaction::where('transaction_date','>',$subDate)->get();
     }elseif($request->day == 'three'){
        $day = 3;
        $subDate = $now->subDay($day);
        $recents = transaction::where('transaction_date','>',$subDate)->get();
     }elseif($request->day == 'all'){
         $recents = transaction::get();
     }
     
   
    $total_amount = transaction::sum('total_amount');
    $flights = flight::get();
    $contacts = contact::get();
    
     return view("admin.transactions.transactions")->with(['transactions'=>$recents,'flights'=>$flights,'contacts'=>$contacts]);
    
}
     //users
     public function manageUsers(){
        $users = user::get();
        return view('admin.users.users')->with(['users'=>$users]);
     }
     public function editUser($id){
        $user = user::where("id",$id)->first();
        return view('admin.users.editUsers')->with(['user'=>$user]);
     }
     public function updateUser($id,Request $request){
         Validator::make($request->all(), [
            'fullName' => 'required',
             'email' => 'required',
             'address' => 'required',
             'phoneNumber' => 'required'
])->validate();
        user::where('id',$id)->update([
            'full_name' => $request->fullName,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phoneNumber,
        ]);
        return redirect()->route('manage#users');
     }
     public function deleteUser($id){
        user::where('id',$id)->delete();
        return redirect()->route('manage#users');
     }

     //Passengers
     public function editPassenger($id){
      
        $passenger = passenger::where("passenger_id",$id)->first();
        return view('admin.passengers.editPassengers')->with(['passenger'=>$passenger]);
     }
     public function updatePassenger($id,Request $request){
         Validator::make($request->all(), [
            'fullName' => 'required',
             'dob' => 'required',
             'nationality' => 'required',
])->validate();
        passenger::where('passenger_id',$id)->update([
            'full_name' => $request->fullName,
            'dob' => $request->dob,
            'nationality' => $request->nationality,
            'nrc' => $request->nrc,
            'passport' => $request->passport,
        ]);
        // return redirect()->route('manage#transactions');
     }
     public function deletePassenger($id){
        passenger::where('passenger_id',$id)->delete();
        return redirect()->route('manage#passengers');
     }
     public function manageReservations(){
        $contact = contact::get();
        $flights = flight::get();
        $offices = office::get();
      
        $reservations = reservation::get();
        
        return view('admin.reservation.reservations')->with(['reservations'=>$reservations,
        'contact'=>$contact,'flights'=>$flights,'offices'=>$offices]);
     }
     public function detailsReservation($id){
        $reservation = reservation::where('reservation_id',$id)->first();
        
   $departFlight = flight::where('flight_id',$reservation->departFlight_id)->first();
   $returnFlight = flight::where('flight_id',$reservation->returnFlight_id)->first();
  $contact = contact::where('contact_id',$reservation->contact_id)->with('passengers')->first();
        $flights = flight::get();
        $offices = office::get();
       return view('admin.reservation.reservationDetails')->with(['reservation'=>$reservation,
        'contact'=>$contact,'flights'=>$flights,'offices'=>$offices,'departFlight'=>$departFlight,'returnFlight'=>$returnFlight]);
     }
     public function filterStatus(Request $request){
     $status = $request->status;
     if($status == 'completed'){
        $reservations = reservation::where('status','completed')->get();
     }elseif($status == 'pending'){
        $reservations = reservation::where('status','pending')->get();
     }elseif($status == 'canceled'){
        $reservations = reservation::where('status','canceled')->get();
     }
       $contact = contact::get();
        $flights = flight::get();
        $offices = office::get();
        return view('admin.reservation.reservations')->with(['reservations'=>$reservations,
        'contact'=>$contact,'flights'=>$flights,'offices'=>$offices]);  
     
     }

     public function filterOffice(Request $request){
       $reservations = reservation::where('headOffice_id',$request->office)->get();
       $contact = contact::get();
        $flights = flight::get();
        $offices = office::get();
        return view('admin.reservation.reservations')->with(['reservations'=>$reservations,
        'contact'=>$contact,'flights'=>$flights,'offices'=>$offices]);  
     

     }
     public function sortDueDate(Request $request){
        
        if($request->dueDate == 1){
$reservations = reservation::orderBy('due_date','ASC')->get();
        }else{
$reservations = reservation::orderBy('due_date','DESC')->get();

        }
         $contact = contact::get();
        $flights = flight::get();
        $offices = office::get();
        return view('admin.reservation.reservations')->with(['reservations'=>$reservations,
        'contact'=>$contact,'flights'=>$flights,'offices'=>$offices]);  
     }

     public function manageOffices(){
        $offices = office::get();
        return view('admin.headOffices.offices')->with(['offices'=>$offices]);
     }

       public function editOffice($id){
       $office = office::where('office_id',$id)->first();

        return view('admin.headOffices.editoffices')->with(['id'=>$id,'office'=>$office]);
    }
    public function updateOffice($id,Request $request){
    
//             Validator::make($request->all(), [
//     'city' => 'required',
//     'email' => 'required',
//     'phone_number' => 'required',
//     'address' => 'required',
// ])->validate();

       office::where('office_id',$id)->update([
        'city' => $request->city,
        'email' => $request->email,
        'phone_number' => $request->phoneNumber,
        'address' => $request->address,
        ]);
 return redirect()->route('manage#offices');
    }

        public function addHeadOffice(){
    return view('admin.headOffices.addOffices');
    
  }
  public function addNewHeadOffice(Request $request){
   Validator::make($request->all(),[
    'city' => 'required',
    'email' => 'required',
    'address' => 'required',
    'phoneNumber' => 'required',
   ])->validate();
    office::create([
        'city' => $request->city,
        'email' => $request->email,
        'address' => $request->address,
        'phone_number' => $request->phoneNumber,
    ]);
    return redirect()->route('manage#offices');
  }
    public function deleteoffice($id){
        office::where('office_id',$id)->delete();
       return redirect()->route('manage#offices');
    }

    public function manageMembers(){
       
       $passengers = mileage::get();
     
        return view('admin.members.members')->with('passengers',$passengers);
    }
    public function selectMembers(Request $request){
         $member = $request->member;
         if($member == 'all'){
            $passengers = mileage::get();
         }
         
         else{
            $passengers = mileage::where('membership_tier',$member)->get();
         }
        
        return view('admin.members.members')->with('passengers',$passengers);
    }
    public function reports(){
     
         $monthlyData = $this->monthlyReports();
              
        $year = date('Y');
        $transactions = transaction::where('transaction_date','>',$year)->get();
        
        $flights = flight::get();
        $total_tickets = 0;
        $total_revenue = 0;
        $businessSeats = 0;
        $businessPrice = 0;
        $economySeats = 0;
        $economyPrice = 0;
        foreach($transactions as $transaction){
            $seats = explode(',',$transaction->total_seats);
            
            foreach($seats as $seat){
                
            
             $s = seat::where('seat_id',$seat)->first();
             if($s->class == 'business'){
                $ticket = ticket::where('seat_id',$s->seat_id)->first();
                $businessSeats = $businessSeats+1;
                $businessPrice = $businessPrice + $ticket->price;
             }elseif($s->class=='economy'){
                $ticket = ticket::where('seat_id',$s->seat_id)->first();
                $economySeats = $economySeats+1;
                $economyPrice = $economyPrice + $ticket->price;
             }
                 $total_tickets = $total_tickets+1; 
                 $total_revenue = $total_revenue + $ticket->price;
                 }  
        }
       $data = [
        'eco' => $economyPrice,
        'business' => $businessPrice,
        'total' => $total_revenue,
       ];
       
       
       

      return view('admin.reports.report')->with(
                    ['transactions'=>$transactions,
                    'flights'=>$flights,
                    'total_tickets' => $total_tickets,
                    'total_revenue' => $total_revenue,
                    'businessSeats' => $businessSeats,
                    'businessPrice' => $businessPrice,
                    'economySeats' => $economySeats,
                    'economyPrice' => $economyPrice,
                    'monthlyData' => $monthlyData
                ]);
    }

      public function monthlyReports(){
      
        $date = Carbon::now();
        $startOfYear = $date->copy()->startOfYear();
        $diff = $date->diffInMonths($startOfYear);
        $i = 0;
        $months = [];
         while ($i <= $diff) {
            $date = clone $startOfYear;  // Create a clone of the $startOfYear object
            $month =  $date->addMonth($i);  // Add $i months to the cloned object
            
            $start =  $month->startOfMonth()->toDateString();
            $end = $month->endOfMonth()->toDateString();
           
            $transactionByMonth =  transaction::where('transaction_date','>',$start)->where('transaction_date','<',$end)->get(); 
            
            $sales[$month->format('F')] = $transactionByMonth->sum('total_amount'); //total sales by month
          
          //  calculating ticket type breakdown
          $businessPrice = 0;
            $economyPrice = 0;
           foreach($transactionByMonth as $transaction){
            //business and economy
           // echo $transaction;
            $seats = explode(',',$transaction->total_seats);
            
            foreach($seats as $seat){
                
             $s = seat::where('seat_id',$seat)->first();
             $ticket = ticket::where('seat_id',$s->seat_id)->first();
             if($s->class == 'business'){
                $businessPrice = $businessPrice + $ticket->price;
    
             }else{
                $economyPrice = $economyPrice + $ticket->price;
             }
        
            }  
        
            $business[$month->format('F')] = $businessPrice;
            $economy[$month->format('F')] = $economyPrice;
           
        //Top Route
       
        $orderByRoute = $transaction->select('departFlight_id')
                // ->selectRaw('count(departFlight_id) as qty')
                // ->groupBy('departFlight_id')
                // ->orderBy('qty', 'DESC')
                ->get();
                // echo $month->format('F'). $orderByRoute;
         }
          
            $business[$month->format('F')] = $businessPrice;
            $economy[$month->format('F')] = $economyPrice;
            array_push($months,$month->format('F'));
            $i++;     

    
        }
  return ['business'=>$business,'economy'=>$economy,'sales'=>$sales,'months'=>$months];
       
    }    

    public function dateSelect(Request $request){
        
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        
        if($startDate == null && $endDate != null){
            $transactions = transaction::where('transaction_date','<=',$endDate)->get(); 
            // return 'startnull';
        }elseif($endDate == null && $startDate != null){
             $transactions = transaction::where('transaction_date','>=',$startDate)->get(); 
            
        }elseif($startDate != null && $endDate != null){
               $transactions = transaction::where('transaction_date','>=',$startDate)->where('transaction_date','<=',$endDate)->get(); 
             
            }elseif($startDate == null && $endDate == null){
                return redirect()->route('monthly#reports');
            }

        $flights = flight::get();
        $total_tickets = 0;
        $total_revenue = 0;
        $businessSeats = 0;
        $businessPrice = 0;
        $economySeats = 0;
        $economyPrice = 0;
        foreach($transactions as $transaction){
            $seats = explode(',',$transaction->total_seats);
            
            foreach($seats as $seat){
             $s = seat::where('seat_id',$seat)->first();
             if($s->class = 'business'){
                $businessSeats = $businessSeats+1;
                $businessPrice = $businessPrice + $s->price;
             }else{
                $economySeats = $economySeats+1;
                $economyPrice = $economyPrice + $s->price;
             }
                 $total_tickets = $total_tickets+1; 
                 $total_revenue = $total_revenue + $s->price;
                 }  
        }
       
         $monthlyData = $this->monthlyReports();

      return view('admin.reports.report')->with(
                    ['transactions'=>$transactions,
                    'flights'=>$flights,
                    'total_tickets' => $total_tickets,
                    'total_revenue' => $total_revenue,
                    'businessSeats' => $businessSeats,
                    'businessPrice' => $businessPrice,
                    'economySeats' => $economySeats,
                    'economyPrice' => $economyPrice,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'monthlyData' => $monthlyData,
                ]);
    }
    
  


    public function cancellation(){
        //react yae date
        $transaction_id = 2;
        $flight_id = 1;
        $passenger_name = 'thaw';
        $ticket_number = '8989ee';
        $email = 'eiphyusment@gmail.com';

       if(!(transaction::where('transaction_id',$transaction_id)->exists())){
      //  return $this->sendCancellationFailedEmail($email);
       }
      
       $transaction= transaction::where('transaction_id',$transaction_id)->first();
       $contact = contact::where('contact_id',$transaction->contact_id)->first();
       $passengers = contact::where('contact_id',$transaction->contact_id)->with('passengers')->first()->passengers;
       
       $passenger = $passengers->where('full_name',$passenger_name)->first();
      
       if($passenger == null){
         //  return $this->sendCancellationFailedEmail($email);
       }
    $flight = flight::where('flight_id',$transaction->departFlight_id)->first();
    // $cancelled_ticket = ticket::where('ticket_number',$ticket_number)->first();
    // return $cancelled_ticket;

    $passenger_ticket =  $passenger->where('full_name',$passenger_name)->with('ticket')->first()->ticket->ticket_number;
    // if($ticket_number != $passenger_ticket){
        
    //      //  return $this->sendCancellationFailedEmail($email);
    // }

    //success 
    $data = [
            'transaction_id' => $transaction->transaction_id,
            'contact_name' => $contact->full_name,
            'from' => $flight->from ,
            'to' => $flight->to,
            'depart_date' => $flight->depart_date,
    ];
     return $this->cancellationSuccess($email,$data);
  
    }
 public function cancellationSuccess($email,$data){
    return $data;
    transaction::where('transaction_id',$data['transaction_id'])->update([
 'status' => 'cancelled',
 //'amount' =>  
    ]);
    //seat ka 1 
    
    // Mail::to($email)->send(new cancellationSuccessMail($data));
    return 'mail sent';
 }
  public function sendCancellationFailedMail($email){
 Mail::to($email)->send(new cancellationFailedMail());

  }

 
}


    





