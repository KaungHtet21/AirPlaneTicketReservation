<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-image: url({{ asset('images/loginImage.jpg') }});
            background-size: cover;

        }

        .container {
            margin-top: 100px;
            max-width: 400px;
            padding: 20px;
            background-color: rgb(0, 0, 0, 0.5);

            color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-color: #b2dffc;
        }

        .form-control:focus {
            border-color: #73b4e6;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-facebook {
            background-color: #3b5998;
            border-color: #3b5998;
        }

        .btn-facebook:hover {
            background-color: #2d4373;
            border-color: #2d4373;
        }

        .btn-twitter {
            background-color: #1da1f2;
            border-color: #1da1f2;
        }

        .btn-twitter:hover {
            background-color: #0c7cba;
            border-color: #0c7cba;
        }

        .btn-google {
            background-color: #db4a39;
            border-color: #db4a39;
        }

        .btn-google:hover {
            background-color: #c13522;
            border-color: #c13522;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ asset('/images/logo_transparent_white.png') }}" alt="Logo" width="220" height="200"
            style='margin-top:-5%;' class="offset-2">
        <h5> Login here</h5>
        <form action={{ route('admin#authentication') }} method='post'>
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input name='email' type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name='password' type="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            @if (Session::has('failed'))
                <p class="text-danger">*Authentication failed. Please try again.</p>
            @endif
            <button type="submit" class="btn btn-outline-primary btn-block col-md-3 offset-9">Login</button>


        </form>
    </div>
    <!-- Bootstrap JS -->
    <
