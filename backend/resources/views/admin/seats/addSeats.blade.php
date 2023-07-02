@extends('admin.home')
@section('contenteps')
    <style>
        .seatBox {

            color: black;
            border-radius: 20px;
            padding: 20px;
            background-color: white;
            margin-left: 20px;
            margin-right: 20px;
            box-shadow: 0 10px 8px rgba(0, 0, 0, 0.2);

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
            background: rgb(67, 114, 213);
            font-size: small;
            opacity: 0.8;
        }
    </style>
    <div class="container seatBox my-5" style="padding: 50px;">
        <p class="h3 mb-5">Add New Seats To A Particular Flight</p>
        {{-- <form action='{{ route('add#newSeats', $id) }}' method='POST'> --}}
        <div class="col-md-2 offset-10">
            <a href="{{ route('manage#seats') }}">
                <p class="text-muted">Back <i class="fa fas fa-arrow-right"></i></p>
            </a>
        </div>
        <form action='{{ route('add#newSeats') }}' method='POST'>
            @csrf
            <div class="mt-3">
                <select class="form-select" name='flight_id'>
                    <option value='' class="text-muted small text-danger">Select flight to add new seats</option>
                    @foreach ($flights as $flight)
                        <option value="{{ $flight->flight_id }}">{{ $flight->flight_number }}</option>
                    @endforeach
                </select>
                @if ($errors->has('flight_id'))
                    <small class="text-danger">Please choose a flight.</small>
                @endif
            </div>
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
                            <small class="text-danger">This filed is required.</small>
                        @endif
                    </div>
                </div>

            </div>
            <button type="submit" class="offset-4 col-md-3 addBtn">Add</button>

        </form>
    </div>
@endsection
