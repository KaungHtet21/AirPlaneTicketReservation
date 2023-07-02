@extends('admin.home')
@section('contenteps')
    <style>
        .container {
             color: black;
            border-radius: 20px;
            padding: 20px;
            background-color: white;

            margin: 10px;
            box-shadow: 0 10px 8px rgba(0, 0, 0, 0.2);
        }
        .editBtn {
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

        input {
            box-shadow: 5px 5px rgb(146, 145, 145);
        }
    </style>
    <div class="container my-3">
        <div class="mx-3">
            <a href="{{ route('manage#transactions') }}"><i class="fa fas fa-angle-right"
                    ></i>back to previous page</a>
        </div>
        <form action='{{ route('update#passenger', $passenger->passenger_id) }}' method='POST' class='mb-4'>
            @csrf
            <button type="submit" class="offset-9 editBtn"><i class="fa fas fa-sync"></i>Update Passenger</button>

            <div class="mb-3">
                <label for="name" class="form-label">Full name</label>
                <input type="text" name='fullName' value='{{ $passenger->full_name }}' class="form-control"
                    id="name" aria-describedby="emailHelp">
                @if ($errors->has('fullName'))
                    <small class="text-danger">This filed is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" name='dob' value='{{ $passenger->dob }}' class="form-control" id="dob">
                @if ($errors->has('dob'))
                    <small class="text-danger">This field is required.</small>
                @endif
            </div>
            <div class="mb-3">
                <label for="nationality" class="form-label">Nationality</label>
                <input type="text" name='nationality' value='{{ $passenger->nationality }}' class="form-control"
                    id="nationality">
                @if ($errors->has('nationality'))
                    <small class="text-danger">This field is required.</small>
                @endif
            </div>
            @if ($passenger->nrc != null)
                <div class="mb-3">
                    <label for="nrc" class="form-label">NRC</label>
                    <input type="text" name='nrc' value='{{ $passenger->nrc }}' class="form-control" id="nrc">
                    @if ($errors->has('nrc'))
                        <small class="text-danger">The Address field is required.</small>
                    @endif
                </div>
            @endif
            @if ($passenger->passport != null)
                <div class="mb-3">
                    <label for="passport" class="form-label">Passport</label>
                    <input type="text" name='passport' value='{{ $passenger->passport }}' class="form-control"
                        id="passport">
                    @if ($errors->has('passport'))
                        <small class="text-danger">The Address field is required.</small>
                    @endif
                </div>
            @endif

        </form>
    </div>
@endsection
