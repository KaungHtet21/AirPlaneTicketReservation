<html>
{{-- <style>
    .body {}

    .container {
        display: flex;
    }

    .box {
        font-family: Arial, sans-serif;
        width: 33.33%;
        /* Set the width to divide the container equally */
        height: 100px;
        box-sizing: border-box;
        text-align: center;
    }

    .borderless-table {
        border: 1px solid rgb(152, 149, 149);
        border-collapse: collapse;
        width: 100%;
    }

    .borderless-table th,
    .borderless-table td {
        padding: 15px;


    }


    .borderless-table thead {
        background-color: rgb(200, 196, 196);
        color: black;
    }

    .borderless-table th {
        text-align: left;
    }

    .table {

        font-family: Arial, sans-serif;
        margin-left: 50px;
        margin-right: 50px;
    }

    i {
        opacity: 0.5;
    }



    .my-table {
        border-collapse: collapse;
        width: 70%;

    }

    .my-table th,
    .my-table td {
        padding: 8px;
        text-align: center;
    }

    .my-table thead {
        border-bottom: 1px solid black;
    }

    .my-table th {
        font-weight: bold;
    }
</style> --}}

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container" style='display: flex;'>
        <div class="box" style='margin-top:-2%'><img src="{{ asset('images/logo_transparent_blue.png') }}" alt=""
                style='height:150px; width:40%; '></div>
        <div class="box">
            <p>Booking No</p>
            <h3>{{ $data['transaction']['transaction_number'] }}</h3>
        </div>
        <div class="box"
            style='font-family: Arial, sans-serif;
        width: 33.33%;
        height: 100px;
        box-sizing: border-box;
        text-align: center;
    '>
            <p>Booking Date</p>
            <h4>{{ Carbon\Carbon::parse($data['transaction']['transaction_date'])->format('D,d M Y') }}</h4>
        </div>

    </div>
    <div class="table">
        <h2>Travel itineray</h2>
        <div>

            {{-- <table class="borderless-table"
                style=' border: 1px solid rgb(152, 149, 149);
        border-collapse: collapse;
        width: 100%;'>
                <thead>
                    <tr>
                        <th>Flight 1</th>

                        <th>
                            {{ Carbon\Carbon::parse($data['depart_flight']['depart_date'])->format('D,d M Y') }}
                        </th>

                        <th style='text-align:end'>
                            {{ Carbon\Carbon::parse($data['depart_flight']['depart_time'])->diff(Carbon\Carbon::parse($data['depart_flight']['arrive_time']))->format('%h hours %i minutes') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><i class="fa fas fa-plane-departure"></i>
                            {{ Carbon\Carbon::parse($data['depart_flight']['depart_time'])->format('h:i') }}</td>
                        <td>{{ $data['depart_flight']['from'] }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><i class="fa fas fa-map-marker-alt"></i>
                            {{ Carbon\Carbon::parse($data['depart_flight']['arrive_time'])->format('h:i') }}</td>
                        <td>{{ $data['depart_flight']['to'] }}</td>
                        <td></td>
                    </tr>
                    <!-- Add more table rows as needed -->
                </tbody>
            </table> --}}
            @if ($data['return_flight'] != null)
                <table class="borderless-table"
                    style="margin-top:50px; border: 1px solid rgb(125, 122, 122);
        border-collapse: collapse;
        width: 100%;">
                    <thead style=' border-bottom: 1px solid black;'>
                        <tr style="padding: 15px;">
                            <th>Flight 2</th>

                            <th>
                                {{ Carbon\Carbon::parse($data['return_flight']['depart_date'])->format('D,d M Y') }}
                            </th>

                            <th style='text-align:end'>
                                {{ Carbon\Carbon::parse($data['return_flight']['depart_time'])->diff(Carbon\Carbon::parse($data['return_flight']['arrive_time']))->format('%h hours %i minutes') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <i class="fa fas fa-plane-departure"></i>
                                {{ Carbon\Carbon::parse($data['return_flight']['depart_time'])->format('h:i') }}</td>
                            <td>{{ $data['return_flight']['from'] }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><i class="fa fas fa-map-marker-alt"></i>
                                {{ Carbon\Carbon::parse($data['return_flight']['arrive_time'])->format('h:i') }}</td>
                            <td>{{ $data['return_flight']['to'] }}</td>
                            <td></td>
                        </tr>
                        <!-- Add more table rows as needed -->
                    </tbody>
                </table>
            @endif
            <p>All times shown are local time.</p>
        </div>
        <div class='passengers' style='
        margin-top:5%;'>
            <h3>Guests</h3>
            <table class="my-table" style="  border-collapse: collapse;
        width: 70%;">
                <thead>
                    <tr>
                        <th scope="col" style='padding: 8px;text-align: center;'>#</th>
                        <th scope="col" style='padding: 8px;text-align: center;'>Guest Name</th>

                        <th scope="col" style='padding: 8px;text-align: center;'>Class</th>
                    </tr>
                </thead>
                <tbody>
                    <p style='display:none'>{{ $i = 1 }}</p>
                    @foreach ($data['passengers'] as $passenger)
                        <tr>
                            <th scope="row" style='padding: 8px;text-align: center;'>{{ $i }}</th>
                            <td style='padding: 8px;text-align: center;'>{{ $passenger['full_name'] }}</td>
                            <td style='padding: 8px;text-align: center;'>
                                {{ $data['seats']->where('seat_id', $passenger['ticket']['seat_id'])->first()->class }}
                            </td>
                        </tr>
                        <p style='display:none'>{{ $i++ }}</p>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="passenger-info">
            <h2>Passenger Information</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Name</th>
                    <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Passport Number</th>
                    <th style="padding: 8px; text-align: left; background-color: #f2f2f2;">Seat Number</th>
                </tr>
                <tr>
                    <td style="padding: 8px; text-align: left;">John Doe</td>
                    <td style="padding: 8px; text-align: left;">AB1234567</td>
                    <td style="padding: 8px; text-align: left;">12A</td>
                </tr>
                <tr>
                    <td style="padding: 8px; text-align: left;">Jane Smith</td>
                    <td style="padding: 8px; text-align: left;">CD9876543</td>
                    <td style="padding: 8px; text-align: left;">12B</td>
                </tr>
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


</div>
</div>
</body>

</html>
