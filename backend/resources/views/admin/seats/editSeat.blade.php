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
            background: linear-gradient(to right, rgb(105, 105, 217), rgb(188, 16, 188));
            font-size: small;
            opacity: 0.8;
        }

        .input-group-text {
            background: linear-gradient(to right, rgb(105, 105, 217), rgb(188, 16, 188));
        }

        .form-floating {
            border: 0.2px solid rgb(164, 152, 152);
        }
    </style>
    <div class="container seatBox mt-5 p-lg-5">
        <p class="h3">Edit Seat Information</p>
        <div class="col-md-2 offset-10">
            <a href="{{ route('manage#seats') }}">
                <p class="text-muted">Back <i class="fa fas fa-arrow-right"></i></p>
            </a>
        </div>
        <div class="container">

            <form action="{{ route('update#seat', $id) }}" method='POST'>
                @csrf
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <div class="input-group ">
                                <span class="input-group-text">Seat Number</span>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGroup1"
                                        placeholder="Edit seat number" name='seatNumber' value={{ $seat->seat_number }}>
                                    <label for="floatingInputGroup1">Edit seat number</label>
                                </div>
                            </div>
                            @if ($errors->has('seatNumber'))
                                <small class="text-danger">This field is required.</small>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group mb-3">
                            <div class="input-group ">
                                <span class="input-group-text">Price</span>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGroup1"
                                        placeholder="Edit Price" name='price' value={{ $seat->price }}>
                                    <label for="floatingInputGroup1">Edit Price</label>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('price'))
                            <small class="text-danger">This field is required.</small>
                        @endif
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6 offset-3">
                        <div class="form-group mb-3">
                            <div class="input-group ">
                                <span class="input-group-text">Class</span>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputGroup1"
                                        placeholder="Edit 
                                        class" name='class'
                                        value={{ $seat->class }}>
                                    <label for="floatingInputGroup1">Edit
                                        class
                                    </label>
                                </div>

                            </div>
                            @if ($errors->has('class'))
                                <small class="text-danger">This field is required.</small>
                            @endif
                        </div>
                    </div>

                </div>
                <button type="submit" class="addBtn col-md-2 offset-10">Update</button>
            </form>
        </div>

    </div>
@endsection
