<!DOCTYPE html>
<html>

<head>
    <title>E-Ticket</title>
</head>

<body style='font-family: Arial, sans-serif; margin-left:3%; margin-right:3%'>
    <div class="header" style="text-align: center; margin-bottom: 20px;">
        <div class="container" style='display:flex; width:100%'>
            <div class="box"
                style='margin-top:-2%;    
         width: 33.33%;
        height: 100px;
        box-sizing: border-box;
        text-align: center;'>
                {{-- <img src="{{ asset('images/logo_transparent_blue.png') }}" alt=""
                    style='height:150px; width:40%; '> --}}
                {{-- <img src="{{ $message->embed(public_path('images/logo.png'), 'logo') }}" alt="Logo"> --}}
                {{-- <img src="{{ $logoUrl }}" alt="Logo"> --}}
                {{-- <img src="cid:logo.png" alt="Logo" style='height:auto; width:auto;'> --}}
                <img src="cid:logo.png" alt="Logo" style='height:110%; width:100%;'>
            </div>
            <div class="box"
                style='font-family: Arial, sans-serif;
        width: 33.33%;
        height: 100px;
        box-sizing: border-box;
        text-align: center;'>
                <p style="font-size:10px;  color: #999999;">Booking No</p>
                <h3>{{ $data['transaction']['transaction_number'] }}</h3>
            </div>
            <div class="box"
                style='font-family: Arial, sans-serif;
        width: 33.33%;
        height: 100px;
        box-sizing: border-box;
        text-align: center;'>
                <p style="font-size:10px;  color: #999999;">Booking Date</p>
                <h4>{{ Carbon\Carbon::parse($data['transaction']['transaction_date'])->format('d M Y') }}</h4>
            </div>

        </div>
    </div>

    <div class="itinerary" style="margin-bottom: 3%;">
        <div class="table">
            <h2 style="margin-bottom: 2%; margin-top:3%; font-size:20px;">Travel itineray</h2>

            <h4>Flight 1</h4>
            <table style="width: 100%; border-collapse: collapse; margin-bottom:5%;">
                <tr>
                    <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Flight</th>
                    <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Departure</th>
                    <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Arrival</th>
                    <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Date</th>
                    <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Departure Time</th>
                    <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Arrival Time</th>
                </tr>
                <tr>
                    <td style="padding: 8px; text-align: left;">{{ $data['depart_flight']['flight_number'] }}</td>
                    <td style="padding: 8px; text-align: left;">{{ $data['depart_flight']['from'] }}</td>
                    <td style="padding: 8px; text-align: left;">{{ $data['depart_flight']['to'] }}</td>
                    <td style="padding: 8px; text-align: left;">
                        {{ Carbon\Carbon::parse($data['depart_flight']['depart_date'])->format('d M Y') }}</td>
                    <td style="padding: 8px; text-align: left;">
                        {{ Carbon\Carbon::parse($data['depart_flight']['depart_time'])->format('h:i A') }}</td>
                    <td style="padding: 8px; text-align: left;">
                        {{ Carbon\Carbon::parse($data['depart_flight']['arrive_time'])->format('h:i A') }}</td>
                </tr>
            </table>
            @if ($data['return_flight'] != null)
                <h4>Flight 2</h4>
                <table style="width: 100%; border-collapse: collapse; ">
                    <tr>
                        <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Flight</th>
                        <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Departure</th>
                        <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Arrival</th>
                        <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Date</th>
                        <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Departure Time</th>
                        <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Arrival Time</th>
                    </tr>
                    <tr>
                        <td style="padding: 8px; text-align: left;">{{ $data['return_flight']['flight_number'] }}</td>
                        <td style="padding: 8px; text-align: left;">{{ $data['return_flight']['from'] }}</td>
                        <td style="padding: 8px; text-align: left;">{{ $data['return_flight']['to'] }}</td>
                        <td style="padding: 8px; text-align: left;">
                            {{ Carbon\Carbon::parse($data['return_flight']['depart_date'])->format('d M Y') }}</td>
                        <td style="padding: 8px; text-align: left;">
                            {{ Carbon\Carbon::parse($data['return_flight']['depart_time'])->format('h:i A') }}</td>
                        <td style="padding: 8px; text-align: left;">
                            {{ Carbon\Carbon::parse($data['return_flight']['arrive_time'])->format('h:i A') }}</td>
                    </tr>
                </table>
            @endif
            <p style="font-size:small;   color: #999999; ">All times shown are local time.</p>

        </div>
    </div>

    <div class="passenger-info " style='margin-top:5%;'>
        <h2>Passenger Information</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Name</th>
                <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Class
                </th>
                <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Ticket</th>
            </tr>
            @foreach ($data['passengers'] as $passenger)
                <tr>
                    <td style="padding: 8px; text-align: left;">{{ $passenger['full_name'] }}</td>
                    <td style="padding: 8px; text-align: left;">
                        {{ $data['seats']->where('seat_id', $passenger['ticket']['seat_id'])->first()->class }}</td>
                    <td style="padding: 8px; text-align: left;"> {{ $passenger['ticket']['ticket_number'] }}</td>
                <tr>
            @endforeach

        </table>
    </div>
    <div style='margin-top:5%;  font-family: Arial, sans-serif;'>
        <h3>Entry Guidelines</h3>
        <p>

            Welcome aboard! To ensure a smooth and efficient entry onto your flight, please follow these
            guidelines:</p>
        <ul>
            <li>
                <h4>Online Check-In:</h4>
                <p> Utilize the online check-in facility provided by the airline.
                    Enter your eTicket number or booking reference and select your preferred seat.
                    Print your boarding pass or save it on your mobile device</p>
            </li>



            <li>
                <h4> Baggage Check-In:</h4>
                <p>Proceed to the bag drop counters if you have checked baggage.
                    Ensure your bags adhere to the size and weight restrictions specified by the airline.
                    Attach proper identification tags to your checked-in bags.</p>
            </li>


            <li>
                <h4> Security Screening:</h4>
                <p>Have your eTicket and identification ready for verification at the security checkpoint.
                    Follow the instructions of the security officers, removing any necessary items for
                    screening.</p>
            </li>

            <li>
                <h4> Gate and Boarding:</h4>
                <p>Proceed to the designated gate mentioned on your eTicket.
                    Present your eTicket and identification at the boarding gate.
                    Follow the boarding instructions provided by the airline staff, typically based on seat
                    numbers or
                    boarding groups.</p>
            </li>

            <li>
                <h4> In-Flight Etiquette:</h4>
                <p> Keep your eTicket accessible, either as a printed copy or on your electronic device.
                    Follow the instructions and guidelines provided by the flight attendants.
                    Enjoy your flight and respect the comfort and privacy of fellow passengers.</p>
            </li>
        </ul>
        <p>Thank you for your cooperation. We wish you a pleasant journey!"

            Please note that these examples are generalized and may not cover all specific requirements or
            procedures. Always refer to the instructions provided by your airline and stay updated with any
            changes or additional requirements for your particular flight.</p>
    </div>
</body>

</html>
