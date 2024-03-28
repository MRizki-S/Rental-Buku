<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RenBook | Login</title>
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
            <form action="/login" method="post">
                @csrf

                <div class="mb-4 text-center border-bottom border-primary">
                    <h3 class="fw-bold text-primary">RenBook Login </h3>
                </div>

                {{-- Session Massage --}}
                @if (Session::has('status'))
                <div class="alert alert-{{Session::get('status')}} alert-dismissible fade show" role="alert">
                    {{Session::get('massage')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="mb-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="mb-2">
                    <button type="submit" class="btn btn-primary form-control">Login</button>
                </div>

                <div class="mb-3 text-center ">
                    Don't have account?
                    <a href="/register" class="text-decoration-none">Sign Up</a>
                </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>