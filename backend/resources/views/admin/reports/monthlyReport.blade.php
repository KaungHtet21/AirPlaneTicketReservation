@extends('admin.home')
@section('contenteps')
    <div class="container my-4">
        <h4 class='text-center'>Sales Report for {{ $month }}</h4>


        <form action="{{ route('select#month') }}" method="get">
            @csrf
            <div class="form-group col-md-3 offset-8">
                <label for="monthSelect">Select a month:</label>
                <select class="form-control" id="monthSelect" name='month'>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <input type="submit" class="btn btn-primary">
        </form>

        <div class="row my-5">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card Title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card Title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card Title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                    </div>
                </div>

            </div>
        </div>
        <div>
            <table class="table table-bordered table-hover table-light">
                <thead>
                    <tr>
                        <th colspan='3'>
                            <h5 class="text-center">Ticket Type Breakdown</h5>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                    </tr>
                    <tr>
                        <th>Tickets Sold</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Business</th>
                        <td>Value 1</td>
                        <td>Value 2</td>
                    </tr>
                    <tr>
                        <th scope="row">Economy</th>
                        <td>Value 4</td>
                        <td>Value 5</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="my-5">
            <h4>Top Destinations by Revenue:</h4>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Cras justo odio
                    <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Dapibus ac facilisis in
                    <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Morbi leo risus
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
            </ul>
        </div>
    </div>
@endsection
