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


        input {
            box-shadow: 5px 5px rgb(146, 145, 145);
        }
    </style>
    <div class="container box my-3">
        <p class="h3">Update HeadOffice Information</p>
        <div class="col-md-1">
            <a href="{{ route('manage#offices') }}"><i class="fa fas fa-angle-left"></i> Back</a>
        </div>
        <form action='{{ route('update#office', $office->office_id) }}' method='POST' class='mb-4'>
            @csrf
            <button type="submit" class="offset-10 addBtn">Update office</button>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name='city' value='{{ $office->city }}' class="form-control" id="name"
                    aria-describedby="emailHelp">
                @if ($errors->has('city'))
                    <small class="text-danger">This filed is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" name='email' value='{{ $office->email }}' class="form-control" id="email">
                @if ($errors->has('email'))
                    <small class="text-danger">This field is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">phoneNumber</label>
                <input type="text" name='phoneNumber' value='{{ $office->phone_number }}' class="form-control"
                    id="phoneNumber">
                @if ($errors->has('phoneNumber'))
                    <small class="text-danger">This field is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">address</label>
                <input type="text" name='address' value='{{ $office->address }}' class="form-control" id="address">
                @if ($errors->has('address'))
                    <small class="text-danger">The Address field is required.</small>
                @endif
            </div>

        </form>
    </div>
@endsection
