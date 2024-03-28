<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RenBook | Register</title>
    {{-- link css bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container col-4  shadow rounded py-3 px-3 bg-light">
            <form action="/register" method="post">
                @csrf

                <div class="mb-4 text-center border-bottom border-primary">
                    <h3 class="fw-bold text-primary">RenBook Sign Up </h3>
                </div>

                {{-- flash massage validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- flash massage validasi --}}

                {{-- Session Massage --}}
                @if (Session::has('status'))
                <div class="alert alert-{{Session::get('status')}} alert-dismissible fade show" role="alert">
                    {{Session::get('massage')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="mb-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" >
                </div>
                <div class="mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" >
                </div>
                <div class="mb-3">
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="+62">
                </div>
                <div class="mb-3">
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" >
                </div>

                <div class="mb-2">
                    <button type="submit" class="btn btn-primary form-control">Sign Up</button>
                </div>

                <div class="mb-3 text-center ">
                    Already have an account?
                    <a href="/login" class="text-decoration-none">Login</a>
                </div>
            </form>
        </div>
    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
