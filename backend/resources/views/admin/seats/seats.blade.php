@extends('admin.home')
@section('contenteps')
    <style>
        .container {

            background-color: white;

            border-radius: 20px;
            padding: 20px;
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
            opacity: 0.8;
        }
    </style>
    <div class="container">
        <div class="row mt-3">
            <p class="h3">View and Manage Seats</p>
            <div class="my-4">
                <i class="text-sm">Filter Seats By Flight Number</i>
                <form action="{{ route('search#seats') }}" method='post'>
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-select" name='flight_id'>
                                    <option value='' class="text-muted small text-danger">Select flight number
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

                        <div class="col-md-2">
                            <button value='submit' class="addBtn"><i class="fa fas fa-search"></i></button>
                        </div>
                </form>
                {{-- <div class="col-md-3 offset-3">
                    <a href="{{ route('update#seatPrice') }}" class="addBtn">Update Seat Price</a>

                </div> --}}
            </div>


        </div>


        <div class="col-md-3 offset-9 mb-3">
            <a href="{{ route('add#seats') }}" class="addBtn"> <i class="fa fas fa-plus">Add new
                    seats</i></a>

        </div>
    </div>
    <div class="mt-3">
            {{$seats->links()}}
        </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Seat Number</th>
                <th scope="col">Flight</th>
                <th scope="col">Class</th>
                <th scope="col">Price(USD)</th>
                <th scope="col">Availibility</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <p class="d-none">{{ $i = 1 }}</p>
            @foreach ($seats as $seat)
                <tr>
                    <th>{{ $i }}</th>
                    <td>{{ $seat->seat_number }}</td>
                    <td>{{ $flights->where('flight_id',$seat->flight_id)->first()->flight_number}}</td>
                    <td>{{ $seat->class }}</td>
                    <td>{{ $seat->price }}</td>
                    <td>
                        @if ($seat->available == 0)
                            <p class="font-weight-bold">Reserved</p>
                        @else
                            <p class="font-weight-bold">Not reserved</p>
                        @endif

                    </td>
                    <td>
                        <span>
                            <a href="{{ route('edit#seat', $seat->seat_id) }}"> <i class="fa fas fa-edit"></i></a>
                            <a href='{{ route('delete#seat', $seat->seat_id) }}'>
                                <i class="mx-1 fa fa-solid fa-trash"></i></a>
                        </span>

                    </td>
                </tr>
                <p class="d-none">{{ $i++ }}</p>
            @endforeach


        </tbody>
    </table>

    </div>
@endsection
