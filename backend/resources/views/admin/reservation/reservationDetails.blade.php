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
            box-shadow: 0 10px 8px rgba(0, 0, 0, 0.2), 0 -2px 2px rgba(0, 0, 0, 0.2);

        }

        .h3 {
            font-family: Arial, Helvetica, sans-serif
        }

        input {

            box-shadow: 5px 10px #cdcaca8e;
            color: white;
            font-weight: bold;
            background: linear-gradient(to top, #7479e3, #bfc0cd);
        }
    </style>
    <div class="container box my-4">
        <div class="row" style="padding:20px">
            <div class='col-md-7'>
                {{-- <h4>reservation ID : {{ $reservation->reservation_id }}</h4> --}}
                <p class='h3'>Reservation Number : {{ $reservation->reservation_number }}</p>
            </div>
            {{-- <div class='col-md-2'>
                @if ($reservation->returnFlight_id != null)
                    <p class="btn btn-primary btn-sm">Round Trip</p>
                @else
                    <p class="btn btn-primary btn-sm">One Way</p>
                @endif
            </div> --}}
            <div class="col-md-1 offset-3">
                <a href="{{ route('manage#reservations') }}"><i class="fa fas fa-angle-right"></i>Back</a>
            </div>
        </div>
        <div class="row mt-4">

            <div class="col-md-4">
                <label for="from" class="form-label small">From</label>
                <input type="text" name='from' class="form-control" value={{ $departFlight->from }} disabled>
            </div>
            <div class="col-md-4">
                <label for="from" class="form-label small">To</label>
                <input type="text" name='to' class="form-control"value={{ $departFlight->to }} disabled>
            </div>
            <div class="col-md-2">
                <label for="from" class="form-label small">Depart on</label>
                <input type="text" name='from' class="form-control" value={{ $departFlight->depart_date }} disabled>
            </div>
            @if ($returnFlight != null)
                <div class="col-md-2">
                    <label for="from" class="form-label small">Return on</label>
                    <input type="text" name='from' class="form-control" value={{ $returnFlight->depart_date }}
                        disabled>
                </div>
            @endif

        </div>
        <div class="row my-3">
            <div class="col-md-4">
                <label for="name" class="form-label small">Name</label>
                <input type="text" class="form-control" value={{ $contact->full_name }} disabled>
            </div>
            <div class="col-md-4">
                <label for="name" class="form-label small">Email</label>
                <input type="text" class="form-control" value={{ $contact->email }} disabled>
            </div>
            <div class="col-md-4">
                <label for="name" class="form-label small">Group of</label>
                <input type="text" class="form-control" value={{ $contact->passengers->count() }} disabled>

            </div>
        </div>

        <div class="container my-4">
            <hr>
            <h4>Passengers</h4>
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Passenger ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Nationality</th>
                        <th scope="col">NRC</th>
                        <th scope="col">Passport</th>


                    </tr>
                </thead>

                <tbody>
                    <p class='d-none'>{{ $i = 1 }}</p>
                    @foreach ($contact->passengers as $passenger)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $passenger->full_name }}</td>
                            <td>{{ $passenger->dob }}</td>
                            <td>{{ $passenger->gender }}</td>
                            <td>{{ $passenger->nationality }}</td>
                            @if ($passenger->nrc != null)
                                <td>{{ $passenger->nrc }}
                                </td>
                            @else
                                <td>-</td>
                            @endif
                            @if ($passenger->passport != null)
                                <td>{{ $passenger->passport }}
                                </td>
                            @else
                                <td>-</td>
                            @endif
                            {{-- <td>
                                <span>

                                    <a href="{{ route('edit#passenger', $passenger->passenger_id) }}" class='text-white'>
                                        <i class="fa fas fa-edit"></i> Edit Info</a>

                                </span>
                            </td> --}}

                        </tr>
                        <p class='d-none'>{{ $i++ }}</p>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="container my-4">
            <h4>Payment Information</h4>
            <div class="row my-3">
                <div class="col-md-4">
                    <label for="" class="form-label small">Payment Method</label>
                    <input type="text" class="form-control" value=disabled>
                </div>
                <div class="col-md-4">
                    <label for="name" class="form-label small">Amount(USD)</label>
                    <input type="text" class="form-control" value={{ $reservation->total_amount }} disabled>
                </div>
                <div class="col-md-4">
                    <label for="name" class="form-label small">Due Date</label>
                    <input type="text" class="form-control"
                        value={{ Carbon\Carbon::parse($reservation->due_date)->format('d.M.Y') }} disabled>

                </div>
            </div>
        </div>
    </div>
@endsection
