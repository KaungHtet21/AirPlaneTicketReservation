<!DOCTYPE html>
<html>

<head>
    <title>Flight Reservation Confirmation</title>
</head>

<body style='font-family: Arial, sans-serif; margin-left:3%; margin-right:3%'>
    <p>Dear {{ $data['customer'] }},</p>
    <p>We are delighted to inform you that your flight reservation has been successfully booked! We appreciate your
        choice in our services and can't wait to assist you with your upcoming travel plans. Please find below the
        details of your flight and important payment instructions.</p>
    <div class="header" style="text-align: center; margin-bottom: 20px;">
        <div class="container" style='display:flex; width:100%; margin-top:40px;'>
            <div class="box"
                style='margin-top:-2%;    
         width: 33.33%;
        height: 100px;
        box-sizing: border-box;
        text-align: center;'>
                <img src="cid:logo.png" alt="Logo" style='height:110%; width:100%;'>
            </div>
            <div class="box"
                style='font-family: Arial, sans-serif;
        width: 33.33%;
        height: 100px;
        box-sizing: border-box;
        text-align: center;'>
                <p style="font-size:10px;  color: #999999;">Reservation No</p>
                <h3>{{ $data['reservation']['reservation_number'] }}</h3>
            </div>
            <div class="box"
                style='font-family: Arial, sans-serif;
        width: 33.33%;
        height: 100px;
        box-sizing: border-box;
        text-align: center;'>
                <p style="font-size:10px;  color: #999999;">Reservation Date</p>
                <h4>{{ Carbon\Carbon::parse($data['reservation']['reservation_date'])->format('d M Y') }}</h4>
            </div>

        </div>
    </div>



    <h3 style='margin-top:10%;'>Flight Information:</h3>
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

    <p>Payment Due Date: <b>
            {{ Carbon\Carbon::parse($data['reservation']['due_date'])->format('d M Y') }}
        </b></p>

    <p>To ensure your reservation is confirmed, we kindly request that you complete the payment before the specified due
        date. Please note that failure to make the payment within the provided timeframe will result in the cancellation
        of your ticket.</p>

    <h3>Payment Instructions:</h3>
    <p>Amount Due: <b>{{ $data['reservation']['total_amount'] }}$</b></p>
    <p>Payment Method: In-person payment at our Head Office</p>

    <p>Please visit our Head Office located at <b>{{ $data['office']['address'] }}</b> to settle the
        payment. Our dedicated staff will be
        ready to assist you during our office hours, ensuring a smooth and hassle-free transaction. Remember to provide
        your reservation number when making the payment.</p>

    <p>For any queries or concerns regarding your reservation or payment process, please don't hesitate to reach out to
        our customer support team at <b>{{ $data['office']['email'] }}</b>.</p>

    <p>We genuinely appreciate your cooperation and look forward to serving you on your upcoming flight. Should you
        require any further assistance, please feel free to contact us. Have a wonderful travel experience!</p>

    <p>Best regards,</p>
    <h3>Air Horizon</h3>
</body>

</html>
