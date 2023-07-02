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
            /* border-radius: 20px; */
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
            text-align: center;
            margin;
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

        .card-img-top {
            height: 12rem;
        }

        .card {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            padding: 5px;
            height: 23rem;
            position: relative;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .card-btn {
            position: absolute;
            bottom: 3%;
        }
    </style>

    {{-- <div class="background-opacity mt-5">
        <div class="content">
            <h1>Your Text Here</h1>
            <p>Your text content goes here.</p>
        </div>
    </div> --}}
    <div class='mb-5'>
        <div class="row  mx-3">
            <h3
                style='
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", 
    Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", 
    sans-serif;'>
                Welcome back!
            </h3>

            <p class='text-muted'>From here, you can oversee flight schedules, monitor bookings, manage user accounts, and ensure smooth operations. </p>
            <div class="col-md-9">
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
        </div>
        <div class="row my-5 mx-3">
            <div class="col-md-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('images/flight.png') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Manage Flights</h5>
                        <p class="card-text">Add new routes, edit and filter routes</p>
                        <a href="{{ route('manage#flights') }}" class="btn btn-primary round-btn card-btn offset-1">Manage
                            Flights</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('images/ticket.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Manage Tickets</h5>
                        <p class="card-text">View tickets sold and manage them.</p>
                        <a href="{{ route('manage#tickets') }}" class="btn btn-primary round-btn card-btn offset-1">Manage
                            Tickets</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('images/seat.avif') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Manage Seats</h5>
                        <p class="card-text">Add seats on particular flights.</p>
                        <a href="{{ route('manage#seats') }}" class="btn btn-primary round-btn card-btn offset-1">Manage
                            Seats</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('images/user.png') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Manage Users</h5>
                        <p class="card-text">Manage registered users</p>
                        <a href="{{ route('manage#users') }}" class="btn btn-primary round-btn card-btn offset-1">Manage
                            Users</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row my-3 mx-3">
            <div class="col-md-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('images/transaction.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">View Transactions</h5>
                        <p class="card-text">View Transactions by different categories.</p>
                        <a href="{{ route('manage#transactions') }}" class="btn btn-primary round-btn card-btn ">View
                            Transactions</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('images/reservation.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">View Reservations</h5>
                        <p class="card-text">View reservations by different categories</p>
                        <a href="{{ route('manage#reservations') }}" class="btn btn-primary round-btn card-btn">View
                            Reservations</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('images/member.png') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Manage Members</h5>
                        <p class="card-text">View memberships, filter and manage them.</p>
                        <a href="{{ route('manage#members') }}" class="btn btn-primary round-btn card-btn ">Manage
                            Members</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('images/office.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Manage Offices</h5>
                        <p class="card-text">Add, edit information of offices.</p>
                        <a href="{{ route('manage#offices') }}" class="btn btn-primary round-btn card-btn ">Manage
                            Offices</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
