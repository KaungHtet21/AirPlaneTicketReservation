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

        .filterBtn {
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

        .card-header {
            color: white;
            opacity: 0.8;
            background: linear-gradient(to right, rgb(105, 105, 217), rgb(188, 16, 188));
        }

        .card {
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>
    <div class="container flightBox bg-opacity-20">
        <p class="h3 text-center my-3 mb-5">Manage and View All Tickets Sold</p>
        <div class="row my-4">
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header" style='text-align:center'>Confirmed Tickets</h5>
                    <div class="card-body">
                        <p class="card-text text-sm">Once a ticket is confirmed, it guarantees the traveler's seat or spot
                            for the specified event, journey, or reservation.</p>
                        <a href="{{ route('filterConfirmed') }}" class="btn filterBtn offset-2">Filter confirmed tickets</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header" style='text-align:center'>In Progress Tickets</h5>
                    <div class="card-body">
                        <p class="card-text text-sm">Requested or reserved tickets that have not yet been fully processed or
                            finalized.</p><br>
                        <a href="{{ route('filterPending') }}" class="btn filterBtn offset-2">Filter pending tickets</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="card" >
                    <h5 class="card-header" style='text-align:center'>Cancelled Tickets</h5>
                    <div class="card-body">
                        <p class="card-text text-sm">The ticket's validity has been terminated, and the reservation or
                            purchase is no longer valid.</p><br>
                        <a href="{{ route('filterCancelled') }}" class="btn filterBtn offset-2">Filter cancelled tickets</a>
                    </div>
                </div>
            </div>
        </div>
        @if (isset($msg))
            <div class='col-md-4 mt-5'>
                <h5> {{ $msg }}</h5>
                <hr>

            </div>
        @endif
        <div class="mt-3">
            {{$tickets->links()}}
        </div>

        <div class="table-responsive my-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Customer Name</th>
                        <th>Flight Number</th>
                        <th>Price</th>
                        <th>Purchase Date</th>
                        <th>Payment Status</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows with ticket sales data -->
                    @if ($tickets->count() == 0)
                        <tr>
                            <td colspan="6 " style='text-align:center;'>

                                <p class="text-muted">There is no ticket.</p>

                            </td>
                        </tr>
                    @endif
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->ticket_number }}</td>
                            <td>{{ $passengers->where('passenger_id', $ticket->passenger_id)->first()->full_name }}</td>
                            <td>{{ $flights->where('flight_id', $seats->where('seat_id', $ticket->seat_id)->first()->flight_id)->first()->flight_number }}
                            </td>
                            <td>{{ $ticket->price }} $</td>
                            <td>{{ Carbon\Carbon::parse($ticket->created_at)->format('d M Y') }}</td>
                            <td>{{ $ticket->status }}</td>


                        </tr>
                    @endforeach

                    <!-- Add more rows for other ticket sales -->
                </tbody>
            </table>
        </div>

    </div>
@endsection
