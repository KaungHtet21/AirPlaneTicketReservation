@extends('admin.home')
@section('contenteps')
    <style>
        .flightBox {
            background-color: white;

            border-radius: 20px;
            padding: 20px;

        }

        .h3 {
            font-family: Arial, Helvetica, sans-serif
        }

        .addBtn {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            color: #fff;
            padding-left: 30px;
            padding-right: 30px;
            padding-top: 10px;
            padding-bottom: 10px;
            background: linear-gradient(to right, rgb(105, 105, 217), rgb(188, 16, 188));
            font-size: small;
            opacity: 0.8;
        }

        .btn-group button {

            /* Green background */
            border: 1px solid;
            /* Green border */
            color: black;
            /* White text */
            padding: 10px 24px;
            /* Some padding */
            cursor: pointer;
            /* Pointer/hand icon */
            float: left;
            /* Float the buttons side by side */
        }

        /* Clear floats (clearfix hack) */
        .btn-group:after {
            content: "";
            clear: both;
            display: table;
        }

        .btn-group button::after {
            background: linear-gradient(to top, #4e54c8, #8f94fb);
        }

        .btn-group button:not(:last-child) {

            border-right: none;
            /* Prevent double borders */
        }

        .btn-group button:hover {
            color: white;

        }

        .upcomingBtn {
            /* background: linear-gradient(to top, #1f2af6, #c2c4f0); */
            background-color: rgb(105, 105, 217);
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .todayBtn {
            background: linear-gradient(to right, rgb(105, 105, 217), rgb(188, 16, 188));

        }

        .previousBtn {
            /* background: linear-gradient(to top, #4aa161, #b0b1c4); */
            background-color: rgb(188, 16, 188);
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .btnText {
            color: white;
            font-weight: bold;
        }

        .table-cell {
            padding: 10px;
            /* Adjust the padding value as needed */
        }
    </style>
    <div class="container flightBox bg-opacity-20">
        <div class="">
            <p class="h3 text-center my-3 mb-5">View All Routes and Flights Information</p>

        </div>

        <div class="row my-3">
            <div class="col-md-8 ">
                <form action="{{ route('filter#flights') }}" method='post'>
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <label for="">Source</label>
                            <input type="text" name='from' class='form-control form-control-sm'>
                        </div>
                        <div class="col-md-5">
                            <label for="">Destination</label>
                            <input type="text" name='to' class='form-control form-control-sm'>
                        </div>
                        <div class="col-md-2">
                            <label for="">Filter</label><br>
                            <button type='submit' class="btn btn-primary btn-sm text-white"><i
                                    class="fa fas fa-filter"></i></button>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
            <div class="col-md-4 mt-5">


                <a href="{{ route('add#flight') }}" class="">
                    <button class="btn addBtn offset-1">
                        <i class="fa fa-solid fa-plus"></i>Add New Upcoming Routes
                    </button>
                </a>
            </div>
        </div>

        <div class="offset-2 my-3 mb-5 btn-group">

            <button class="upcomingBtn"><a href="{{ route('flight#upcoming') }}" class="btnText">
                    <i class="fa fas fa-calendar"></i> Upcoming Flights
                </a></button>
            <button class="todayBtn"><a href="{{ route('flight#today') }}" class="btnText">
                    <i class="fa fas fa-calendar"></i> Today Flights
                </a></button>
            <button class="previousBtn"><a href="{{ route('flight#previous') }}" class="btnText">
                    <i class="fa fas fa-calendar"></i> Previous
                    Flights</a></button>


        </div>
        @if ($flights->count() == 0)
            <p class="text-muted text-center h4">There is no flight.</p>
        @else
        @if(!isset($paginate))
        <div class="mt-3">
            {{$flights->links()}}
          
        </div>
        @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="table-cell">#</th>
                        <th scope="col" class="table-cell">Route Number</th>
                        <th scope="col" class="table-cell">Source</th>
                        <th scope="col" class="table-cell">Destination</th>
                        <th scope="col" class="table-cell">Departing Date</th>
                        <th scope="col" class="table-cell">Depart Time</th>
                        <th scope="col" class="table-cell">Arrive Time</th>
                        <th scope='col' class="table-cell">Air Distance</th>
                        <th scope="col" class="table-cell">Seat Available</th>
                        <th scope="col" class="table-cell">Seat Reserved</th>
                        <th scope="col" class="table-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($flights as $flight)
                        <tr class="mt-3">
                            <th scope="row" class="table-cell">{{ $flight->flight_id }}</th>
                            <td class="table-cell">{{ $flight->flight_number }}</td>
                            <td class="table-cell">{{ $flight->from }}</td>
                            <td class="table-cell">{{ $flight->to }}</td>
                            <td class="table-cell">{{ $flight->depart_date }}</td>
                            <td class="table-cell">{{ Carbon\Carbon::parse($flight->depart_time)->format('h:i A') }}</td>
                            <td class="table-cell">{{ Carbon\Carbon::parse($flight->arrive_time)->format('h:i A') }}</td>
                            <td class="table-cell">{{ $flight->flight_distance }}miles</td>

                            <td class="table-cell">{{ $flight->seats->where('available', '1')->count() }}</td>
                            <td class="table-cell">{{ $flight->seats->where('available', '0')->count() }}</td>

                            <td class="table-cell">

                                <span>
                                    <a href="{{ route('edit#flight', $flight->flight_id) }}"> <i
                                            class="fa fas fa-edit"></i></a>
                                    <a href="{{ route('delete#flight', $flight->flight_id) }}">
                                        <i class="mx-1 fa fa-solid fa-trash"></i>
                                    </a>


                                </span>
                                {{-- <span>
                                <a href=""> <i>Edit</i></a>
                                <a href=''>
                                    <i class="mx-1 fa fa-solid fa-trash"></i></a>
                            </span> --}}

                            </td>
                        </tr>
                    @endforeach
            </table>
        @endif
    </div>
@endsection
