@extends('master.app')
@section('content')
    <style>
        body {
            background: linear-gradient(to top, #4e54c8, #8f94fb);
            padding: 20px;
        }

        .container {
            border-radius: 40px;
            background-color: white;
            padding: 20px;
        }

        .card:hover {
            transform: scale(1.1);
            animation-delay: 1s;

            /* Change the background color to a light red */
        }

        .lists {
            padding: 12px;
            border-radius: 20px;

        }

        .lists:hover {
            background: linear-gradient(to top, #4e54c8, #8f94fb);

        }

        .title {
            text-align: center;
        }
    </style>

    <div class="container">



        <div class="row mt-3">
            <div class="col-md-2 border-end">
                <div class="">
                    <div class="row">
                        <div class='title' style="margin-top:-20%; text-align:center;">
                            <img src="{{ asset('/images/logo_transparent_blue.png') }}" alt="Logo" width="220"
                                height="200" class="" style='border-radius: 40%;'>

                        </div>

                        <p class="text-muted text-sm">Ad Tools</p>

                        <div class="lists mr-2">
                            <a href="{{ route('dashboard') }}">
                                <i class="mx-1 fa fas fa-tachometer"></i>
                                Dashboard
                            </a>

                        </div>

                        <div class="lists mr-2">
                            <a href="{{ route('manage#flights') }}">
                                <i class="mx-1 fa fas fa-plane"></i>
                                Flights
                            </a>
                        </div>
                        <div class="lists mr-2">
                            <a href="{{ route('manage#seats') }}">
                                <i class="mx-1 fa fas fa-building"></i>

                                Seats
                            </a>
                        </div>
                        <div class="lists mr-2">
                            <a href="{{ route('manage#tickets') }}">
                                <i class="mx-1 fa fas fa-ticket"></i>Tickets
                            </a>
                        </div>
                        <div class="lists mr-2">
                            <a href="{{ route('manage#users') }}">
                                <i class="mx-1 fa fas fa-user"></i> Users
                            </a>
                        </div>

                        <div class="lists mr-2">
                            <a href="{{ route('manage#transactions') }}">
                                <i class="mx-1 fa fas fa-exchange"></i>Transactions
                            </a>
                        </div>

                        <div class="lists mr-2">
                            <a href="{{ route('manage#reservations') }}">
                                <i class="mx-1 fa fas fa-calendar"></i> Reservations
                            </a>
                        </div>

                        <div class="lists mr-2">
                            <a href="{{ route('manage#members') }}">
                                <i class="mx-1 fa fas fa-users"></i> Members
                            </a>
                        </div>

                        <div class="lists mr-2">
                            <a href="{{ route('manage#offices') }}">
                                <i class="mx-1 fa fas fa-building"></i>Head Offices
                            </a>

                        </div>
                        <div class="lists mr-2">
                            <a href="{{ route('monthly#reports') }}">
                                <i class="mx-1 fa fas fa-file"></i>Reports
                            </a>

                        </div>
                        <div class="lists mr-2">
                            <a href="{{ route('homePage') }}">
                                <i class="fa fas fa-sign-out"></i> Logout
                            </a>

                        </div>





                    </div>


                </div>
            </div>
            <div class="col">
                @yield('contenteps')
            </div>
        </div>
    </div>
@endsection
