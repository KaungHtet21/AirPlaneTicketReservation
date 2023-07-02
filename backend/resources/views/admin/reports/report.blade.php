@extends('admin.home')
@section('contenteps')
    <style>
        .box {
            color: black;
            border-radius: 20px;
            padding: 30px;
            background-color: white;
            /* background-color: rgb(234, 232, 232); */
            margin: 10px;
            box-shadow: 0 10px 8px rgba(0, 0, 0, 0.2), 0 -2px 2px rgba(0, 0, 0, 0.2);

        }

        .h3 {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
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
            margin-top: -2%;

        }

        table {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        tr {
            text-align: center;
        }

        .card-title {
            color: rgb(49, 49, 211);
            /* font-weight: bold; */
            font-size: 1.5rem;
        }

        .title-table {
            color: white;
            background: linear-gradient(to right, rgb(105, 105, 217), rgb(155, 95, 155));

        }
    </style>
    <div class="container my-4 box">
        <p class='h3 text-center'>Sales Report for 2023</h3>

        <div class='col-md-6 offset-6 my-4'>

            <form action="{{ route('date#select') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <label for="">From</label>
                        <input type="date" name='startDate' class="form-control" placeholder='from'>
                    </div>
                    <div class="col-md-5">
                        <label for="">To</label>
                        <input type="date" name='endDate' class="form-control" placeholder='from'>
                    </div>
                    <div class="col-md-1">
                        <label for=""></label>
                        <button type="submit" class='addBtn'> <i class=" fa fas fa-search"></i>
                    </div>
                </div>
            </form>
        </div>
        <div class="mt-5">
            {{-- @if (Session::has($startDate))
                @if ($startDate != null && $endDate != null)
                    <h5> Transactions between {{ $startDate }} and {{ $endDate }}</h5>
                @endif

                @if ($startDate != null && $endDate == null)
                    Transactions from {{ $startDate }}
                @endif
                @if ($endDate != null && $startDate == null)
                    Transactions before {{ $endDate }}
                @endif
                @endif --}}
            @if ($transactions->count() == 0)
                <h5 class="text-center">No Transactions On This Date</h5>

        </div>
    @else
        <div class="row my-5">

            <div class="col-md-4">

                <div class="card" style="width: 18rem; ">
                    <div class="card-body">
                        <h5 class="card-title">{{ $transactions->count() }}</h5>
                        <p class="card-text">Total Transactions</p>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $total_revenue }}USD</h5>
                        <p class="card-text">Total Revenue</p>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $total_tickets }}</h5>
                        <p class="card-text">Total Ticket Sold</p>
                    </div>
                </div>

            </div>
        </div>
        <div>
            <table class="table table-bordered table-hover table-light">
                <thead>
                    <tr>
                        <th colspan='3' class="title-table">
                            <h5 class="text-center">Ticket Type Breakdown</h5>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                    </tr>
                    <tr>
                        <th>Tickets Sold</th>
                        <th>Total Revenue(USD)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Business</th>
                        <td>{{ $businessSeats }}</td>
                        <td>{{ $businessPrice }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Economy</th>
                        <td>{{ $economySeats }}</td>
                        <td>{{ $economyPrice }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
        @endif
        <div class="mt-5">
            <h4>Monthly Sale Analysis</h4>
            <div class="container my-4">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class='text-center'>Month</th>

                            <th class='text-center'>Economy Class</th>
                            <th class='text-center'>Business Class</th>
                            <th class='text-center'>Total Sales</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthlyData['months'] as $month)
                            <tr>
                                <td class='text-center'>{{ $month }}</td>

                                <td class='text-center'>{{ $monthlyData['economy'][$month] }}$</td>
                                <td class='text-center'>{{ $monthlyData['business'][$month] }}$</td>
                                <td class='text-center'>{{ $monthlyData['economy'][$month]+$monthlyData['business'][$month]}}$</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
