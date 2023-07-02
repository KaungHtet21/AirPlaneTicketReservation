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
            background: linear-gradient(to right, rgb(105, 105, 217), rgb(188, 16, 188));
            font-size: small;
            opacity: 0.8;
        }
    </style>
    <div class="container userBox mt-4 p-5">
        <p class='h3'>Edit Registered User Information</p>
        <div class='offset-9'>

            <a href="{{ route('manage#users') }}">
                <p class="text-center text-muted"><i class="fa fas fa-arrow-right"></i>
                    Back to previous page</p>

            </a>

        </div>
        <form action='{{ route('update#user', $user->id) }}' method='POST' class='mb-4'>
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" name='fullName' value='{{ $user->name }}' class="form-control" id="name"
                    aria-describedby="emailHelp">
                @if ($errors->has('fullName'))
                    <small class="text-danger">This filed is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name='email' value='{{ $user->email }}' class="form-control" id="email">
                @if ($errors->has('email'))
                    <small class="text-danger">This field is required.</small>
                @endif
            </div>
            
            <button type="submit" class="offset-9 btn btn-light addBtn">Update User Info</button>

        </form>
    </div>
@endsection
