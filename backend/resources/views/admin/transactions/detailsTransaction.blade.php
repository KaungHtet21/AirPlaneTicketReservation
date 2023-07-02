@extends('admin.home')
@section('contenteps')
    <style>
        input {

            box-shadow: 2px 5px #4343438e;
            color: white;
            font-weight: bold;
            background: linear-gradient(to top, #a7abf6, #bfc0cd);

        }

        .transactionBox {

            color: black;
            border-radius: 20px;
            padding: 20px;
            background-color: white;
            /* background-color: rgb(234, 232, 232); */
            margin: 10px;
            box-shadow: 0 10px 8px rgba(0, 0, 0, 0.2);
        }

        .addBtn {
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
            border-bottom-left-radius: 18px;
            border-bottom-right-radius: 18px;
            color: #fff;
            padding-left: 30px;
            padding-right: 30px;
            padding-top: 10px;
            padding-bottom: 10px;
            background: linear-gradient(to right, rgb(105, 105, 217), rgb(188, 16, 188));
            font-size: small;
            opacity: 0.8;
            margin-top: -1%;
            text-align: center;
        }

        table {
            text-align: center;
        }
    </style>
    <div class="container transactionBox p-3">
        <div class="row">
            <div class='col-md-2 offset-4'>
                {{-- <h4>TRANSACTION ID : {{ $transaction->transaction_id }}</h4> --}}

                <p class=" mt-3">Transaction Number</p>
                <h4 class="offset-1">
                    {{ $transaction->transaction_number }}</h4>

            </div>
            {{-- <div class='col-md-2 mt-4'>
                @if ($returnFlight != null)
                    <p class="addBtn">Round Trip</p>
                @else
                    <p class="addBtn">One Way</p>
                @endif
            </div> --}}
            <div class="col-md-3 offset-3">
                <a href="{{ route('manage#transactions') }}"><i class="fa fas fa-arrow-right"></i>Back to previous page</a>
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
            <h5>Passengers</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Nationality</th>
                        <th scope="col">NRC</th>
                        <th scope="col">Passport</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <p class="d-none">{{ $i = 1 }}</p>
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
                            <td>
                                <span>

                                    <a href="{{ route('edit#passenger', $passenger->passenger_id) }}">
                                        <i class="fa fas fa-edit"></i> Edit Info</a>

                                </span>
                            </td>

                        </tr>
                        <p class="d-none">{{ $i++ }}</p>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="container my-4">
            <h4>Payment Information</h4>
            <div class="row my-3">
                <div class="col-md-4">
                    <label for="" class="form-label small">Payment Method</label>
                    <input type="text" class="form-control" value={{ $transaction->payment }} disabled>
                </div>
                <div class="col-md-4">
                    <label for="name" class="form-label small">Amount(USD)</label>
                    <input type="text" class="form-control" value={{ $transaction->total_amount }} disabled>
                </div>
                <div class="col-md-4">
                    <label for="name" class="form-label small">Transaction Date</label>
                    <input type="text" class="form-control" value={{ $transaction->transaction_date }} disabled>

                </div>
            </div>
        </div>
    </div>
@endsection
