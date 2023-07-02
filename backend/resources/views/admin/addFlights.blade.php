@extends('admin.home')
@section('contenteps')
    <div class="container mt-3">

        <form action='{{ route('add#newflight') }}' method='POST'>
            @csrf
            <button type="submit" class="offset-10 btn btn-light">Add new flight</button>

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
                <label for="arriveTime" class="form-label">arriveTime</label>
                <input type="time" name='arriveTime' value='{{ old('arriveTime') }}' class="form-control"
                    id="arriveTime">
                @if ($errors->has('arriveTime'))
                    <small class="text-danger">The arrive time field is required.</small>
                @endif
            </div>

        </form>
    </div>
@endsection
