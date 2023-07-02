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

        }

        tr {
            text-align: center;
        }
    </style>
    <div class="container box my-4">


        <p class='h3'>Manage All Head Offices</p>

        <div class="col-md-3 offset-9 my-3 ">


            <a href="{{ route('add#headOffice') }}">
                <button class="addBtn">
                    <i class="fa fa-solid fa-plus"></i>Add New Head Office
                </button>
            </a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">City</th>
                    <th scope="col">Hotline Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($offices as $office)
                        <th scope="row">{{ $office->office_id }}</th>
                        <td>{{ $office->city }}</td>
                        <td>{{ $office->phone_number }}</td>
                        <td>{{ $office->email }}</td>
                        <td>{{ $office->address }}</td>
                        <td>
                            <span class="ml-3">
                                <a href="{{ route('edit#office', $office->office_id) }}">
                                    <i class="fa fas fa-edit"></i></a>
                                <a href='{{ route('delete#office', $office->office_id) }}'>
                                    <i class="mx-1 fa fa-solid fa-trash"></i></a>
                            </span>


                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
