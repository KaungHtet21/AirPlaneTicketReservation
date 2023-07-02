@extends('admin.home')
@section('contenteps')
    <style>
        #flight {
            background-image: url({{ asset('images/flight.png') }});
            background-repeat: no-repeat;
            background-size: cover;
            height: 200px;
            border-radius: 20px;
            color: white;
            position: relative;
        }

        #ticket {
            background-image: url({{ asset('images/ticket.jpg') }});
            background-repeat: no-repeat;
            background-size: cover;
            height: 200px;
            border-radius: 20px;
            color: white;
            position: relative;
        }

        #user {
            background-image: url({{ asset('images/user.png') }});
            background-repeat: no-repeat;
            background-size: cover;
            height: 200px;
            border-radius: 20px;
            color: white;
            position: relative;
        }

        #member {
            background-image: url({{ asset('images/member.png') }});
            background-repeat: no-repeat;
            background-size: cover;
            height: 200px;
            border-radius: 20px;
            color: white;
            position: relative;

        }

        #office {
            background-image: url({{ asset('images/office.jpg') }});
            background-repeat: no-repeat;
            background-size: cover;
            height: 200px;
            border-radius: 20px;
            color: white;
            position: relative;

        }

        #transaction {
            background-color: white;
            background-image: url({{ asset('images/transaction.jpg') }});
            background-repeat: no-repeat;
            background-size: cover;
            height: 200px;
            border-radius: 20px;
            color: white;
            position: relative;

        }

        #report {
            background-image: url({{ asset('images/report.png') }});
            background-repeat: no-repeat;
            background-size: contain;
            height: 200px;
            border-radius: 20px;
            color: white;
            position: relative;


        }

        .innerText {
            margin-top: auto;
            background: black;
            opacity: 0.6;
            padding-left: 15px;
            padding-right: 15px;
            font-size: 1.2rem;
            font-family: sans-serif;
            color: white;
            font-weight: bolder;
        }



        .content {
            position: relative;
            z-index: 1;
            padding: 20px;
            color: #ffffff;
            /* Set the desired text color */
        }

        .round-btn {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            /* border: 2px solid #fff; */

            /* Add a white border */
            color: #fff;

            padding-left: 30px;
            padding-right: 30px;
            padding-top: 10px;
            padding-bottom: 10px;
            /* Set the text color to white */
            /* Set border-radius to 50% for a round shape */
        }

        .flightBtn {
            position: absolute;
            /* Set the button to absolute position */
            bottom: 10px;
            /* Distance from the bottom */
            right: 10px;
        }

        .ticketBtn {
            position: absolute;
            /* Set the button to absolute position */
            top: 10px;
            /* Distance from the bottom */
            right: 5px;
            border: 2px solid black;
            color: black;
        }

        .reportText {
            position: absolute;
            top: 20%;
            left: 10px;

            color: white;
            font-weight: bolder;
        }

        .reportBtn {
            color: #4e54c8;
            background: white;
            text-align: center;
            font-weight: bolder;
        }
    </style>

    {{-- <div class="background-opacity mt-5">
        <div class="content">
            <h1>Your Text Here</h1>
            <p>Your text content goes here.</p>
        </div>
    </div> --}}
    <div class='mb-5'>
        <div class="row  ml-3">
            <h3
                style='
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", 
    Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", 
    sans-serif;'>
                Welcome back!
            </h3>

            <p class='text-muted'>From here, you can oversee flight schedules, monitor bookings, manage user accounts, and ensure smooth operations. </p>
            <div class="col-md-7">
                <div style='height:250px' id='report'>
                    <div class="reportText">
                        <h3>Your Monthy </h3>
                        <h3>Advert Report</h3>
                        <small class="text-white">View the reports of transactions per month.</small>
                        <br>
                        <button class="btn round-btn reportBtn">
                            <a href="{{ route('monthly#reports') }}" class="reportBtn">See Reports</a>
                        </button>
                    </div>


                </div>
            </div>
            {{-- <div class="col-md-7">
                <div style='height:250px' id='flight'>
                    <button class="btn round-btn flightBtn" style='background-color: black;'>Manage Flight</button>

                </div>
            </div> --}}
            <div class='row my-5'>
                <div class='col-md-3 offset-1 d-flex align-items-center justify-content-center' style='height:250px'
                    id='ticket'>
                    <div class='innerText my-1'>
                        <hr>
                        <a href="#">
                            <p class="text-white">View Tickets</p>
                        </a>
                        <hr>
                    </div>
                </div>
                <div class='col-md-3 offset-1 d-flex align-items-center justify-content-center' style='height:250px'
                    id='user'>
                    <div class='innerText my-1'>
                        <hr>
                        <a href="{{ route('manage#users') }}">
                            <p class="text-white">Manage Users</p>
                        </a>
                        <hr>
                    </div>
                </div>
                <div class='col-md-3 offset-1 d-flex align-items-center justify-content-center' style='height:250px'
                    id='member'>
                    <div class='innerText my-1'>
                        <hr>
                        <a href="{{ route('manage#members') }}">
                            <p class="text-white">Manage Membership</p>
                        </a>
                        <hr>
                    </div>
                </div>

            </div>
            <div class='row '>

                <div class='col-md-3 offset-1 d-flex align-items-center justify-content-center' style='height:250px'
                    id='office'>
                    <div class='innerText my-1'>
                        <hr>
                        <a href="{{ route('manage#offices') }}">
                            <p class="text-white">Manage offices</p>
                        </a>
                        <hr>
                    </div>
                </div>
                <div class='col-md-3 offset-1 d-flex align-items-center justify-content-center' style='height:250px'
                    id='transaction'>
                    <div class='innerText my-1'>
                        <hr>
                        <a href="{{ route('manage#transactions') }}">
                            <p class="text-white">Manage transactions</p>
                        </a>
                        <hr>
                    </div>
                </div>
                <div class='col-md-3 offset-1 d-flex align-items-center justify-content-center' style='height:250px'
                    id='report'>
                    <div class='innerText my-1'>
                        <hr>
                        <a href="{{ route('monthly#reports') }}">
                            <p class="text-white">Manage reports</p>
                        </a>
                        <hr>
                    </div>
                </div>

            </div>


        </div>

    </div>
@endsection
