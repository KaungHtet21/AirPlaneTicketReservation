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
    <div class="container box mt-3">
        <p class="h3">Add A New Head Office</p>
        <div class="col-md-1">
            <a href="{{ route('manage#offices') }}"><i class="fa fas fa-angle-left">Back</i></a>
        </div>
        <form action='{{ route('add#newHeadOffice') }}' method='POST'>
            @csrf
            <button type="submit" class="offset-10 addBtn">Add</button>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name='city' value='{{ old('city') }}' class="form-control" id="city">
                @if ($errors->has('city'))
                    <small class="text-danger">The city is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name='email' value='{{ old('email') }}' class="form-control" id="email">
                @if ($errors->has('email'))
                    <small class="text-danger">The email field is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Hotline Number</label>
                <input type="text" name='phoneNumber' value='{{ old('phoneNumber') }}' class="form-control"
                    id="phoneNumber">
                @if ($errors->has('phoneNumber'))
                    <small class="text-danger">This field is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Location</label>
                <input type="text" name='address' value='{{ old('address') }}' class="form-control" id="address">
                @if ($errors->has('address'))
                    <small class="text-danger">The depart date filed is required.</small>
                @endif
            </div>

        </form>
    </div>
@endsection
