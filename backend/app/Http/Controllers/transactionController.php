<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\seat;
use App\Models\flight;
use App\Models\ticket;
use App\Models\contact;
use App\Models\mileage;
use App\Mail\eTicketMail;
use App\Models\passenger;
use App\Models\office;
use App\Models\reservation;
use App\Models\transaction;
use App\Models\visa;
use App\Models\master;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\reservationMail;
use App\Mail\newMembershipMail;
use App\Mail\updateMembershipMail;
use App\Mail\EmailConfirmationMail;
use Illuminate\Support\Facades\Mail;

class transactionController extends Controller
{
  

    public function postPassengersInfo(Request $request){
       $data = $request;
       if($data['status'] == 'purchased'){
         $this->afterTransaction($data);
       }elseif($data['status'] == 'pending'){
        $this->reservation($data);
       }

    }

    public function testReservation(){
      $jsonData = '{
        "selectedDepartFlight": {
            "flight_id": 19,
            "flight_number": "K7-870",
            "from": "Yangon",
            "to": "Mandalay",
            "depart_date": "2023-06-26",
            "depart_time": "07:00:00",
            "arrive_time": "08:30:00",
            "flight_distance": "350",
            "created_at": "2023-06-19T16:21:10.000000Z",
            "updated_at": "2023-06-19T16:21:10.000000Z"
        },
        "selectedReturnFlight": null,
        "passengers": [
            {
                "firstName": "ei ",
                "lastName": "phyu",
                "dob": "2000-11-19",
                "gender": "Female",
                "country": "Myanmar",
                "documentType": "nrc",
                "documentData": "13/LAYANA(N)909022",
                "cabin": "Economy",
                "price": "53.00",
                "memberCode": ""
            }
        ],
        "contact": {
            "firstNameInput": "ei ",
            "lastNameInput": "phyu",
            "email": "eiphyusment@gmail.com",
            "phone": " 95 98989299",
            "address": "lashio"
        },
        "status": "pending",
        "totalPrice": 53,
        "cardNumber": "",
        "cardPassword": "",
        "headOffice": "Lashio",
        "payerName": "eps",
        "phoneNumber": "989389"
    }';
    $data = json_decode($jsonData,true);
   return $this->reservation($data);
    }

   public function reservation($data){
   
   $this->putContactData($data);
   $this->putPassengerDataForReservation($data);
    $this->sendReservationMail();
   }

    public function afterTransaction($data){
    
   $this->putContactData($data);
   $this->putPassengerData($data);
   $this->mile();
   $this->sendEticket();

    }

    public function putContactData($data){
      
        $contact = $data['contact'];
      contact::create([
        'full_name' => $contact['firstNameInput']. " " .$contact['lastNameInput'],
        'user_id' => '1',
        'email' => $contact['email'],
        'phone_number' => $contact['phone'],
        'address' => $contact['address'],
      ]);
        
    }

  private function putPassengerData($data){

    $passengers = $data['passengers'];
    $depart_flight = $data['selectedDepartFlight'];
    $return_flight =  $data['selectedReturnFlight'];
     
    $depart_seats = flight::where('flight_id',$depart_flight['flight_id'])->with('seats')->first()->seats;
  
    if($return_flight !== null){
         $return_seats = flight::where('flight_id',$return_flight['flight_id'])->with('seats')->first()->seats;
    }
    $seats = [];
  
    foreach($passengers as $passenger){

       passenger::create([
    'contact_id' => contact::orderBy('contact_id','DESC')->first()->contact_id,
    'full_name' => $passenger['firstName'] . " " . $passenger['lastName'],
    'dob' => $passenger['dob'],
    'gender' => $passenger['gender'],
    'nationality' => $passenger['country'],
    'nrc' => ($passenger['documentType'] == 'nrc') ? $passenger['documentData'] : null,
    'passport' => ($passenger['documentType'] == 'passport') ? $passenger['documentData'] : null,
]);

// seat reserved for each passenger
    $selected_depart_seat = $depart_seats->where('available','1')->where('class',strtolower($passenger['cabin']))->first();
     
      array_push($seats, $selected_depart_seat->seat_id);
       seat::where('seat_id',$selected_depart_seat->seat_id)->update([
        'available' => '0',
     ]);
     $ticket = ticket::create([
            'ticket_number' => $this->ticketCode(),
            'passenger_id' => passenger::orderBy('passenger_id','DESC')->first()->passenger_id,
            'seat_id' => $selected_depart_seat->seat_id,
            'price' => $selected_depart_seat->price,
            'status' => 'success',
        ]); //for depart

     if($return_flight != null){
         $selected_return_seat = $return_seats->where('available','1')->where('class',strtolower($passenger['cabin']))->first();
           array_push($seats, $selected_return_seat->seat_id);
         seat::where('seat_id',$selected_return_seat->seat_id)->update([
        'available' => '0',
     ]);
     $ticket = ticket::create([
            'ticket_number' => $this->ticketCode(),
            'passenger_id' => passenger::orderBy('passenger_id','DESC')->first()->passenger_id,
            'seat_id' => $selected_return_seat->seat_id,
            'price' => $selected_return_seat->price,
            'status' => 'success',
        ]); //for return 
     }
    } 
  
    $this->newTransaction($data,$seats);
     
     
  }

  private function newTransaction($data,$seats){
 
if($data['selectedReturnFlight'] == null){
    $returnFlight_id = null;
}else{
  $returnFlight_id =  $data['selectedReturnFlight']['flight_id'];
}
    $transaction =  transaction::create([
        'transaction_number' => $this->ticketCode(),
        'contact_id' => contact::orderBy('contact_id',"DESC")->first()->contact_id,
         'departFlight_id' => $data['selectedDepartFlight']['flight_id'],
         'returnFlight_id' =>$returnFlight_id,
         'payment' => 'card',
         'total_seats' => implode(',', $seats),
         'total_amount' => $data['totalPrice'],
         'status' => 'success',
         'transaction_date' => Carbon::now(),
     ]);
  $this->deductAmount($data);
    
}
 public function deductAmount($data){

  $card = $data['cardNumber'];;
  $numbers = explode(' ', $card);
  $card_number = implode('', $numbers);
  
   $visaCard =  visa::where('card_number',$card_number)->first();
   $masterCard =  master::where('card_number',$card_number)->first();
   
   if($visaCard != null){
    visa::where('card_number',$card_number)->update([
      'balance' => $visaCard->balance - $data['totalPrice'],
    ]);
   }
   if($masterCard != null){
    master::where('card_number',$card_number)->update([
      'balance' => $masterCard->balance -  $data['totalPrice'],
    ]);
   }
   
 }
 
  
 
    private function ticketCode(){
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomAlphabets = Str::upper(Str::random(2, $alphabet));
        $randomDigits = '';
        for ($i = 0; $i < 4; $i++) {
            $randomDigits .= mt_rand(0, 9);
        }
        return $randomAlphabets.$randomDigits;
    }
      public function mile(){
        $transaction = transaction::orderBy('transaction_id','DESC')->first();
        $miles = flight::where('flight_id',$transaction->departFlight_id)->first()->flight_distance;
        if($transaction->returnFlight_id != null){
            $miles = $miles + flight::where('flight_id',$transaction->returnFlight_id)->first()->flight_distance;
        }
        
        $contact = contact::where('contact_id',$transaction->contact_id)->first();
        $passengers = contact::where('contact_id',$transaction->contact_id)->with('passengers')->first()->passengers;


        foreach($passengers as $passenger){
        
            if($passenger->nrc != 'null'){
                
                if(mileage::where('nrc',$passenger->nrc)->exists()){
               
                 $oldMiles =   mileage::where('nrc',$passenger->nrc)->first()->miles_travelled;
                
                 $newMiles =  $miles + $oldMiles;
                
                 $member = $this->checkMember($newMiles);
                $memberCode = $this->memberCode($member);

              $old_membershipType = mileage::where('nrc',$passenger->nrc)->first()->membership_tier;
              
              $data = [
                'customer' => $contact->full_name,
                'member' => $member,
                'code' => $memberCode,
                'date' => Carbon::now()->addYear(1)->format('d M Y'),
              ];
              
              if($old_membershipType != $member){
                 Mail::to($contact["email"])->send(new updateMembershipMail($data));
              }
              mileage::where('nrc',$passenger->nrc)->update([
                'miles_travelled' => $newMiles,
                'membership_tier' => $member,
                'member_code' => $memberCode
               ]);
              
    
            }else{
                  $newMiles =  $miles;
                  $member = $this->checkMember($newMiles);
                   $memberCode = $this->memberCode($member);
        
                  mileage::create([
                    'passenger_name' => $passenger->full_name,
                    'nrc' => $passenger->nrc,
                    'miles_travelled' => $newMiles,
                    'membership_tier' => $member,
                    'member_code' => $memberCode
               ]);
                $data = [
                'customer' => $contact->full_name,
                'member' => $member,
                'code' => $memberCode,
                'date' => Carbon::now()->addYear(1)->format('d M Y'),
              ];
               if($member != ''){
                Mail::to($contact["email"])->send(new newMembershipMail($data));
               }
                  
               
            }
            }
          

            //passport 
            if($passenger->passport != null)
            {

                if(mileage::where('passport',$passenger->passport)->exists()){
               
                 $oldMiles =   mileage::where('passport',$passenger->passport)->first()->miles_travelled;
                 $newMiles =  $miles + $oldMiles;
                 $member = $this->checkMember($newMiles);
                $memberCode = $this->memberCode($member);

              $old_membershipType = mileage::where('passport',$passenger->passport)->first()->membership_tier;
                $data = [
                'customer' => $contact->full_name,
                'member' => $member,
                'code' => $memberCode,
                'date' => Carbon::now()->addYear(1)->format('d M Y'),
              ];
              if($old_membershipType != $member){
                 Mail::to($contact["email"])->send(new UpdateMembershipMail($data));
              }
              mileage::where('passport',$passenger->passport)->update([
                'miles_travelled' => $newMiles,
                'membership_tier' => $member,
                'member_code' => $memberCode
               ]);
               
    
            }else{
                  $newMiles =  $miles;
                  $member = $this->checkMember($newMiles);
                   $memberCode = $this->memberCode($member);
                  
                  mileage::create([
                    'passenger_name' => $passenger->full_name,
                    'passport' => $passenger->passport,
                    'miles_travelled' => $newMiles,
                    'membership_tier' => $member,
                    'member_code' => $memberCode
               ]);
                 $data = [
                'customer' => $contact->full_name,
                'member' => $member,
                'code' => $memberCode,
                'date' => Carbon::now()->addYear(1)->format('d M Y'),
              ];
              
             
               if($member != ''){
                Mail::to($contact["email"])->send(new newMembershipMail($data));
               }
        
        }
    }  
    }
    }
    private function checkMember($newMiles){
        
        if($newMiles >= 600 && $newMiles < 1000){
                    $member = 'silver';
                 }elseif($newMiles >= 1000 && $newMiles < 2000 ){
                    $member = 'gold';
                 }elseif($newMiles >= 2000){
                    $member = 'platinum';
                 }else{
                    $member = '';
                 }
                 return $member;
    }
    private function memberCode($member){
        if($member!= null){
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomAlphabets = Str::upper(Str::random(3, $alphabet));
        $randomDigits = '';
        for ($i = 0; $i < 3; $i++) {
            $randomDigits .= mt_rand(0, 9);
        }
        return $randomAlphabets.$randomDigits;
        }else{
            return '';
        }
    }

    public function sendEticket(){
    $transaction = transaction::orderBy('transaction_id','DESC')->first();
    $contact = contact::where('contact_id',$transaction->contact_id)->first();
     $passengers = passenger::where('contact_id',$contact->contact_id)->get();
 //   $passengers = passenger::where('contact_id',2)->with('ticket')->get();
    $depart_flight = flight::where('flight_id',$transaction->departFlight_id)->first();
    $return_flight = flight::where('flight_id',$transaction->returnFlight_id)->first();
    $seats = seat::get();
    
    $data = [
        'customer' => $contact->full_name,
        'passengers' => $passengers,
        'depart_flight' => $depart_flight, 
        'transaction' => $transaction,
        'return_flight' => $return_flight,
        'seats' => $seats,
    ];
    Mail::to($contact["email"])->send(new eTicketMail($data));
  
    }
    public function eticket(){
         $transaction = transaction::orderBy('transaction_id','DESC')->first();
    $contact = contact::where('contact_id',$transaction->contact_id)->first();
    $passengers = passenger::where('contact_id',$contact->contact_id)->get();
    //$passengers = passenger::where('contact_id',2)->with('ticket')->get();
    $depart_flight = flight::where('flight_id',$transaction->departFlight_id)->first();
    $return_flight = flight::where('flight_id',$transaction->returnFlight_id)->first();
    $seats = seat::get();
    
    $data = [
        'customer' => $contact->full_name,
        'passengers' => $passengers,
        'depart_flight' => $depart_flight, 
        'transaction' => $transaction,
        'return_flight' => $return_flight,
        'seats' => $seats,
    ];
        return view('mail.eTicketTest')->with(['data'=>$data]);
    }
    

  
//For reservation
  private function putPassengerDataForReservation($data){
    $passengers = $data['passengers'];
    $depart_flight = $data['selectedDepartFlight'];
    $return_flight =  $data['selectedReturnFlight'];
     
    $depart_seats = flight::where('flight_id',$depart_flight['flight_id'])->with('seats')->first()->seats;
   
    if($return_flight !== null){
         $return_seats = flight::where('flight_id',$return_flight['flight_id'])->with('seats')->first()->seats;
    }
    $seats = [];
  
    foreach($passengers as $passenger){

       passenger::create([
    'contact_id' => contact::orderBy('contact_id','DESC')->first()->contact_id,
    'full_name' => $passenger['firstName'] . " " . $passenger['lastName'],
    'dob' => $passenger['dob'],
    'gender' => $passenger['gender'],
    'nationality' => $passenger['country'],
    'nrc' => ($passenger['documentType'] == 'nrc') ? $passenger['documentData'] : null,
    'passport' => ($passenger['documentType'] == 'passport') ? $passenger['documentData'] : null,
]);

// seat reserved for each passenger
    $selected_depart_seat = $depart_seats->where('available','1')->where('class',strtolower($passenger['cabin']))->first();
     
      array_push($seats, $selected_depart_seat->seat_id);
    //    seat::where('seat_id',$selected_depart_seat->seat_id)->update([
    //     'available' => '0',
    //  ]);
     $ticket = ticket::create([
            'ticket_number' => $this->ticketCode(),
            'passenger_id' => passenger::orderBy('passenger_id','DESC')->first()->passenger_id,
            'seat_id' => $selected_depart_seat->seat_id,
            'price' => $selected_depart_seat->price,
            'status' => 'pending',
        ]); //for depart

     if($return_flight != null){
         $selected_return_seat = $return_seats->where('available','1')->where('class',strtolower($passenger['cabin']))->first();
           array_push($seats, $selected_return_seat->seat_id);
    //      seat::where('seat_id',$selected_return_seat->seat_id)->update([
    //     'available' => '0',
    //  ]);
     $ticket = ticket::create([
            'ticket_number' => $this->ticketCode(),
            'passenger_id' => passenger::orderBy('passenger_id','DESC')->first()->passenger_id,
            'seat_id' => $selected_return_seat->seat_id,
            'price' => $selected_return_seat->price,
            'status' => 'pending',
        ]); //for return 
     }
    } 

   $this->newReservation($data,$seats);
     
     
  }

    public function newReservation($data,$seats){
     
      
 if($data['selectedReturnFlight'] == null){
    $returnFlight_id = null;
}else{
  $returnFlight_id =  $data['selectedReturnFlight']['flight_id'];
}
$headOffice_id = office::where('city',$data['headOffice'])->first()->office_id;  

    $reservation =  reservation::create([
        'reservation_number' => $this->ticketCode(),
        'contact_id' => contact::orderBy('contact_id',"DESC")->first()->contact_id,
         'departFlight_id' => $data['selectedDepartFlight']['flight_id'],
         'returnFlight_id' =>$returnFlight_id,
         'total_seats' => implode(',', $seats),
         'total_amount' => $data['totalPrice'],
         'status' => 'pending',
         'due_date' => Carbon::now()->addDays(3),
         'headOffice_id' => $headOffice_id,
     ]);

    }

    public function sendReservationMail(){
    
   
    $reservation = reservation::orderBy('reservation_id','DESC')->first();
    $contact = contact::where('contact_id',$reservation->contact_id)->first();
    $passengers = passenger::where('contact_id',$contact->contact_id)->get();
    $depart_flight = flight::where('flight_id',$reservation->departFlight_id)->first();
    $return_flight = flight::where('flight_id',$reservation->returnFlight_id)->first();
    $office = office::where('office_id',$reservation->headOffice_id)->first();
    $seats = seat::get();
    $data = [
        'customer' => $contact->full_name,
        'passengers' => $passengers,
        'depart_flight' => $depart_flight, 
        'reservation' => $reservation,
        'return_flight' => $return_flight,
        'office' => $office,
        'seats' => $seats,
    ];
      
    Mail::to($contact['email'])->send(new reservationMail($data));
    

    }

}

