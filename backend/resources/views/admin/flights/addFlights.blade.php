@extends('admin.home')
@section('contenteps')
    <style>
        .flightBox {
            color: black;
            border-radius: 20px;
            padding: 20px;
            background-color: white;
            /* background-color: rgb(234, 232, 232); */
            margin: 10px;
            box-shadow: 0 10px 8px rgba(0, 0, 0, 0.2);
        }


        .h3 {
            font-family: Arial, Helvetica, sans-serif;

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
            background-color: rgb(88, 16, 188);
            font-size: small;
            opacity: 0.6;
            font-weight: bold;
        }
    </style>
    <div class="container flightBox">
        <div class="mt-4">
            <p class="h3 text-center mt-4">
                Add A New Route
            </p>
        </div>
        <div class="col-md-1 offset-10 mt-3">
            <a href="{{ route('manage#flights') }}"><i class="fa fas fa-angle-right btn btn-dark">Back</i></a>
        </div>
        <form action='{{ route('add#newflight') }}' method='POST'>
            @csrf

            <div class="mb-3">
                <label for="flight_number" class="form-label">Flight Number</label>
                <input type="text" name='flightNumber' value='{{ old('flightNumber') }}' class="form-control"
                    id="flight_number" aria-describedby="emailHelp">
                @if ($errors->has('flightNumber'))
                    <small class="text-danger">This filed is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="from" class="form-label">Departure</label>
                <input type="text" name='from' value='{{ old('from') }}' class="form-control" id="from">
                @if ($errors->has('from'))
                    <small class="text-danger">The departure city is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="to" class="form-label">Destination</label>
                <input type="text" name='to' value='{{ old('to') }}' class="form-control" id="to">
                @if ($errors->has('to'))
                    <small class="text-danger">The destination city is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="departDate" class="form-label">Depart Date</label>
                <input type="date" name='departDate' value='{{ old('departDate') }}' class="form-control"
                    id="departDate">
                @if ($errors->has('departDate'))
                    <small class="text-danger">The depart date filed is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="departTime" class="form-label">Depart Time</label>
                <input type="time" name='departTime' value='{{ old('departTime') }}' class="form-control"
                    id="departTime">
                @if ($errors->has('departTime'))
                    <small class="text-danger">The depart time field is required.</small>
                @endif

            </div>

            <div class="mb-3">
                <label for="arriveTime" class="form-label">Arrive Time</label>
                <input type="time" name='arriveTime' value='{{ old('arriveTime') }}' class="form-control"
                    id="arriveTime">
                @if ($errors->has('arriveTime'))
                    <small class="text-danger">The arrive time field is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="distance" class="form-label">Air Distance By Miles</label>
                <input type="string" name='distance' value='{{ old('distance') }}' class="form-control" id="distance">
                @if ($errors->has('distance'))
                    <small class="text-danger">The arrive time field is required.</small>
                @endif
            </div>
            <div class='mt-3'>
   
            <div class="ml-3 mt-5 row ">
                <div class="col-md-6">
                    <h5 class="text-center">Business</h5>
                    <div class="mb-3">
                        <label for="number" class="form-label">Number of seats</label>
                        <input type="number" value='0' name='businessNumber' class="form-control" id="number"
                            max='40'>
                        @if ($errors->has('businessNumber'))
                            <small class="text-danger">This filed is required.</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price($)</label>
                        <input type="text" value='0' name='businessPrice' class="form-control" id="price">
                    </div>
                    @if ($errors->has('businessPrice'))
                        <small class="text-danger">This filed is required.</small>
                    @endif
                </div>
                <div class="col-md-6 ">
                    <h5 class="text-center">Economy</h5>
                    <div class="mb-3">
                        <label for="number" class="form-label">Number of seats</label>
                        <input type="number" max='40' value='0' name='economyNumber' class="form-control"
                            id="number">
                        @if ($errors->has('economyNumber'))
                            <small class="text-danger">This filed is required.</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price($)</label>
                        <input type="text" value='0' name='economyPrice' class="form-control" id="price">

                        @if ($errors->has('economyPrice'))
                            <small class="text-danger">This field is required.</small>
                        @endif
                    </div>
                </div>

            </div>
            <button type="submit" class="offset-4 col-md-3 addBtn">Add Flight</button>

      
    </div>
        </form>
    </div>
   
   


@endsection
