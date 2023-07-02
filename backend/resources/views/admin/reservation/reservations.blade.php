@extends('admin.home')
@section('contenteps')
    <style>
        .box {
            color: black;
            border-radius: 20px;
            padding: 20px;
            background-color: white;
            /* background-color: rgb(234, 232, 232); */
            margin: 10px;
            box-shadow: 0 10px 8px rgba(0, 0, 0, 0.2);
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
            background: black;
            font-size: small;
            opacity: 0.6;
        }

        #status {
            font-weight: bold;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1.1rem;
            color: #777cd6;

        }

        #office {
            font-weight: bold;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1.1rem;
            color: #777cd6;

        }

        #dueDate {
            font-weight: bold;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1.1rem;
            color: #777cd6;

        }



        tr {
            text-align: center;
            padding: 20px;
        }
    </style>


    <div class='container box'>

        <p class=' text-center h3'>View All Reservations</p>
        <div class="row mt-3">
            <div class="text-center col-md-4">
                <hr>
                <p id='status' onclick='myfunc()'>Filter by Reservation Status</p>

                <div id="statusBox" style='display:none'>
                    <form action="{{ route('reservation#statusFilter') }}" method='post' id="statusForm">
                        @csrf
                        <select class="form-select" name='status' onchange="submitStatusForm()">
                            <option value='' class="text-muted small disabled">Select Here.
                            </option>
                            <option value="completed">completed</option>
                            <option value="pending">pending</option>
                            <option value="canceled">canceled</option>
                        </select>
                    </form>
                </div>
                <hr>
            </div>
            <div class="text-center col-md-4">
                <hr>
                <p id='office' onclick='myfunc1()'>Filter by Head Office</p>

                <div id="officeBox" style='display:none'>
                    <form action="{{ route('reservation#officeFilter') }}" method='post' id="officeForm">
                        @csrf
                        <select class="form-select" name='office' onchange="submitofficeForm()">
                            <option value='' class="text-muted small disabled">Select Here.
                            </option>
                            @foreach ($offices as $office)
                                <option value="{{ $office->office_id }}">{{ $office->city }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <hr>
            </div>

            <div class="text-center col-md-4">
                <hr>
                <p id='dueDate' onclick='mysortFunc()'>Sort Reservations by Due Date</p>

                <div id="dueDateBox" style='display:none'>
                    <form action="{{ route('reservation#dueDateSort') }}" method='post' id="dueDateForm">
                        @csrf
                        <select class="form-select" name='dueDate' onchange="submitdueDateForm()">
                            <option value='' class="text-muted small disabled">Select Here.
                            </option>
                            <option value="1">Sort By Ascending Order</option>
                            <option value="0">Sort By Descending Order</option>
                        </select>
                    </form>
                </div>
                <hr>
            </div>
        </div>

        @if ($reservations->count() == 0)
            <p class="text-center">There is no reservations.</p>
        @else
            <table class="table table-hover table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Booking Reference</th>
                        <th>Customer</th>
                        <th>Route</th>
                        <th>Amount Due</th>
                        <th>Head Office</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->reservation_number }}</td>
                            <td>{{ $contact->where('contact_id', $reservation->contact_id)->first()->full_name }}</td>
                            <td>{{ $flights->where('flight_id', $reservation->departFlight_id)->first()->from }}-
                                {{ $flights->where('flight_id', $reservation->departFlight_id)->first()->to }}
                                @if ($reservation->returnFlight_id != null)
                                    <hr>
                                    {{ $flights->where('flight_id', $reservation->returnFlight_id)->first()->from }} ->
                                    {{ $flights->where('flight_id', $reservation->returnFlight_id)->first()->to }}
                            </td>
                    @endif
                    <td>{{ $reservation->total_amount }}$</td>
                    <td>{{ $offices->where('office_id', $reservation->headOffice_id)->first()->city }}</td>
                    <td>{{ $reservation->due_date }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>
                        <span>

                            <a href="{{ route('details#reservation', $reservation->reservation_id) }}">
                                Details <i class="fa fas fa-info-circle mx-1 "></i></a>

                        </span>
                    </td>
                    </tr>
        @endforeach

        </tbody>
        </table>
        @endif
    </div>
    <script>
        function myfunc() {
            var display = document.getElementById('statusBox').style.display;
            if (display == 'none') {
                document.getElementById('statusBox').style.display = 'block';
            } else {
                document.getElementById('statusBox').style.display = 'none';
            }
        }

        function submitStatusForm() {
            document.getElementById("statusForm").submit();
        }

        function myfunc1() {
            var display = document.getElementById('officeBox').style.display;
            if (display == 'none') {
                document.getElementById('officeBox').style.display = 'block';
            } else {
                document.getElementById('officeBox').style.display = 'none';
            }
        }

        function submitofficeForm() {
            document.getElementById("officeForm").submit();
        }

        function mysortFunc() {

            var display = document.getElementById('dueDateBox').style.display;
            if (display == 'none') {
                document.getElementById('dueDateBox').style.display = 'block';
            } else {
                document.getElementById('dueDateBox').style.display = 'none';
            }
        }

        function submitdueDateForm() {
            document.getElementById("dueDateForm").submit();
        }
    </script>
@endsection
