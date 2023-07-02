@extends('admin.home')
@section('contenteps')
    <style>
        .transactionBox {

            color: black;
            border-radius: 20px;
            padding: 20px;
            background-color: white;

            margin: 10px;
            box-shadow: 0 10px 8px rgba(0, 0, 0, 0.2);
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
            margin-top: -1%
        }

        .h3 {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }


        .table {
            /* color: white; */
        }

        a+#details {
            display: none;
        }

        a:hover+#details {
            display: block;
            /* background-color: white; */
            color: black;

        }

        a:hover {}
    </style>
    <div class="container transactionBox mt-3">
        <p class="h3">Manage Transactions</p>
        <div class="container my-3">
            <form action="{{ route('search#transactions') }}" method='post'>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-select" name='flight_id'>

                                <option value='' class="text-muted small text-danger disabled">View particular
                                    transcations
                                    by flight number. Select Here.
                                </option>
                                @foreach ($flights as $flight)
                                    <option value="{{ $flight->flight_id }}">{{ $flight->flight_number }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('flight_id'))
                                <small class="text-danger">Please choose a flight.</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="addBtn"><i class="fa fas fa-filter"></i> Filter
                        </button>
                    </div>
                    {{-- <div class="col-md-3">
                        <a href="{{ route('manage#transactions') }}">View all
                            Transactions
                          
                        </a>
                    </div> --}}
                </div>

            </form>
        </div>

        <div class="">
            <div class="row">
                <div class="col-md-5 ">
                    <h5 style="">Recents Transaction Lists</h5>

                </div>
                <div class="col-md-6 offset-1 ">
                    <form action="{{ route('filter#transactions') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <select class="form-select" aria-label="Default select example" name='day'>
                                    <option value="" disabled>Filter</option>
                                    <option value="all">All Transactions</option>
                                    <option value='thirty'>Last 30 days</option>
                                    <option value="week">Last week</option>
                                    <option value="three">Last three days</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fas fa-search"></i>
                                </button>

                            </div>

                        </div>
                    </form>
                </div>
            </div>

            @if ($transactions->count() == 0)
                <div class='text-center my-3'>
                    <p class="text-muted font-italic">There is no transaction.</p>
                </div>
            @else
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Transaction</th>
                            <th scope="col">Customer</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope='col'>Way</th>

                            <th scope="col">Amount(USD)</th>
                            <th scope="col">Transaction Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>


                        @foreach ($transactions as $transaction)
                            <tr>
                              
                                <td>{{ $transaction->transaction_number }}</td>
                                <td>{{ $contacts->where('contact_id', $transaction->contact_id)->first()->full_name }} </td>
                                <td>
                                    {{ $flights->where('flight_id', $transaction->departFlight_id)->first()->from }}
                                </td>

                                <td>
                                    {{ $flights->where('flight_id', $transaction->departFlight_id)->first()->to }}
                                </td>
                                @if ($transaction->returnFlight_id != null)
                                    <td>Round Trip</td>
                                @else
                                    <td>One Way</td>
                                @endif


                                <td>{{ $transaction->total_amount }}</td>
                                <td>{{ $transaction->transaction_date }}</td>
                                <td>completed</td>
                                <td>
                                    <span>

                                        <a href="{{ route('details#transaction', $transaction->transaction_id) }}"
                                            class="">
                                            Details <i class="fa fas fa-info-circle mx-1 "></i></a>

                                    </span>
                                </td>
                        @endforeach
                        </tr>
                    </tbody>


                </table>
            @endif
        </div>

    </div>
@endsection
