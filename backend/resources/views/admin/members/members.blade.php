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
            background: black;
            font-size: small;
            opacity: 0.6;
        }




        tr {
            text-align: center;
            padding: 20px;
        }

        .blue {
            background-color: #ffd900d4;
        }

        #diamond {
            font-size: 20px;
            color: rgb(44, 44, 112);
        }

        #star {
            font-size: 20px;
            color: yellow;
        }

        #trophy {
            font-size: 20px;
            color: gray;
        }
    </style>
    <div class="container box mt-3">
        <p class="h3">Members</p>

        <div class="container my-4">
            <div class="floating-filter">
                <form action="{{ route('select#memberType') }}" method='post'>
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                                <label for="tier-filter">Membership Tier:</label>
                                <select class="form-control" id="tier-filter" name='member'>
                                    <option value="all">All Tiers</option>
                                    <option value="platinum">Platinum</option>
                                    <option value="gold">Gold</option>
                                    <option value="silver">Silver</option>
                                </select>

                            </div>
                            <div class="col-md-2">
                                <label for="">.</label><br>
                                <input type="submit" class="btn btn-sm btn-primary" value='Filter'>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <!-- Rest of your content -->
        </div>
        </body>

        </html>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Passenger Name <i class="fa fas fa-user"></i></th>
                    <th scope="col">Miles Travelled <i class="fa fas fa-plane"></i></th>
                    <th scope="col">Membership Tier <i class="fa fas fa-diamond"></i></th>
                    <th scope="col">Member Since <i class="fa far fa-calendar"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <p class="d-none">{{ $i = 1 }}</p>
                @foreach ($passengers as $passenger)
                    @if ($passenger->membership_tier != null)
                        <tr>
                            <td>
                                {{ $i }}
                            </td>
                            <td>{{ $passenger->passenger_name }}</td>
                            <td>{{ $passenger->miles_travelled }}</td>
                            @if ($passenger->membership_tier == 'platinum')
                                <td>{{ $passenger->membership_tier }}</td>
                            @endif
                            @if ($passenger->membership_tier == null)
                                <td>-</td>
                            @endif
                            @if ($passenger->membership_tier == 'gold')
                                <td>{{ $passenger->membership_tier }}</td>
                            @endif
                            @if ($passenger->membership_tier == 'silver')
                                <td>{{ $passenger->membership_tier }}</td>
                            @endif


                            <td>{{ Carbon\Carbon::parse($passenger->created_at)->format('d M,Y') }}</td>

                        </tr>
                    @endif
                    <p class='d-none'>{{ $i++ }}</p>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
