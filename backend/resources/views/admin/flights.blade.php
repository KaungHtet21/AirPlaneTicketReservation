@extends('admin.home')
@section('contenteps')
    <div class="container mt-3">
        <h3>Manage Flights</h3>
        <button class="col-md-3 offset-9 btn btn-secondary text-white"><a href="{{ route('add#flight') }}">

                <i class="fa fa-solid fa-plus">Add new flight</i></a></button>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Flight Id</th>
                    <th scope="col">Flight Number</th>
                    <th scope="col">Source</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Depart Date</th>
                    <th scope="col">Depart Time</th>
                    <th scope="col">Arrive Time</th>
                    <th scope="col">Seat Reserved</th>
                    <th scope="col">Seat Available</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flights as $flight)
                    <tr>
                        <th scope="row">{{ $flight->flight_id }}</th>
                        <td>{{ $flight->flight_number }}</td>
                        <td>{{ $flight->from }}</td>
                        <td>{{ $flight->to }}</td>
                        <td>{{ $flight->depart_date }}</td>
                        <td>{{ Carbon\Carbon::parse($flight->depart_time)->format('h:i A') }}</td>
                        <td>{{ Carbon\Carbon::parse($flight->arrive_time)->format('h:i A') }}</td>
                        <td>{{ $flight->with('seats')->first()->seats->where('available', 1)->count() }}</td>
                        <td>{{ $flight->with('seats')->first()->seats->where('available', 0)->count() }}</td>

                        <td>

                            <span>

                                <a href="{{ route('edit#flight', $flight->flight_id) }}"><i>Edit</i></a>


                                <i class="mx-1 fa fa-solid fa-trash"></i>
                            </span>
                            {{-- <span>
                                <a href=""> <i>Edit</i></a>
                                <a href=''>
                                    <i class="mx-1 fa fa-solid fa-trash"></i></a>
                            </span> --}}

                        </td>
                    </tr>
                @endforeach
        </table>
    </div>
@endsection
