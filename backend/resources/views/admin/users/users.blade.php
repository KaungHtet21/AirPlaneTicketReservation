@extends('admin.home')
@section('contenteps')
    <style>
        .userBox {

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
            background: black;
            font-size: small;
            opacity: 0.6;
        }
    </style>
    <div class="container userBox mt-4 p-3">
        <p class="h3 mb-3">Manage Users</p>
        <div class='col-md-4'>
            <p class="text muted h5 mb-3"><i class="fa fas fa-users ml-4"></i> Total Register Users : {{ $users->count() }}
                <hr>
            </p>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">User Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Registered Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <p class='d-none'>{{$i=1}}</p>
                @foreach ($users as $user)
                    <tr>
                        
                        <td>{{ $i}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td>{{ Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
                        <td>
                            <span>
                                <a href="{{ route('edit#user', $user->id) }}"> <i class="fa fas fa-edit"></i></a>
                                <a href="{{ route('delete#user', $user->id) }}">
                                    <i class="mx-1 fa fa-solid fa-trash"></i></a>
                            </span>
                        </td>
                    </tr>
                    <p class='d-none'>{{$i++}}</p>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
