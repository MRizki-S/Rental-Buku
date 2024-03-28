<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RenBook | @yield('title')</title>

    {{-- link css bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- link  icon fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- link css vanila --}}
    <link rel="stylesheet" href="{{asset('css/styleMain.css')}}">

</head>
<body>
    
    <div class="vh-100 main d-flex justify-content-between flex-column">
        <nav class="navbar navbar-dark  navbar-expand-lg bg-primary shadow">
            <div class="container-fluid">
              <a class="navbar-brand fw-bold" href="#">RenBook</a>
              <a href="" class="navbar-brand"><i class="fa-solid fa-bell"></i></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>
        </nav>

{{-- {{ request()->route()->uri }} --> Untuk mengambil url yang aktif --}}

        {{-- body content --}}
        <div class=" h-100">
            <div class="row g-0 h-100 ">
                <div class="sidebar pt-lg-5 text-lg-start text-center col-lg-2 collapse d-lg-block bg-light shadow-lg" id="sidebar">
                    @if (Auth::user())
                        
                        @if (Auth::user()->role_id == 1)
                            <a href="/dashboard" 
                                class="{{request()->route()->uri == 'dashboard' ? 'active' : ''}}">
                                <i class="fa-solid fa-house"></i>
                                Dashboard
                            </a>
                            <a href="/books" @if (request()->route()->uri == 'books' || request()->route()->uri == 'book-add' 
                            ||  request()->route()->uri == 'book-edit/{slug}' || request()->route()->uri == 'show-bookDeleted')
                                    class="active"
                                @endif>
                                <i class="fa-solid fa-book"></i>
                                Buku
                            </a>
                            <a href="/book-rent" 
                                class="{{request()->route()->uri == 'book-rent' ? 'active' : ''}}">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Penyewaan Buku
                            </a>
                            <a href="/book-return" 
                            class="{{request()->route()->uri == 'book-return' ? 'active' : ''}}">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Pengembalian Buku
                            </a>
                            {{-- class="{{Request::is('categories', 'category-add', 'show-categoryDeleted', 'category-edit/{slug}', 'category-confirmDelete/{slug}')? 'active' : ''}}" --}}
                            <a href="/categories" @if (request()->route()->uri == 'categories' || request()->route()->uri == 'category-add' 
                            || request()->route()->uri == 'show-categoryDeleted' || request()->route()->uri == 'category-edit/{slug}' 
                            || request()->route()->uri == 'category-confirmDelete/{slug}')
                                class="active"
                            @endif>
                                <i class="fa-solid fa-layer-group"></i>
                                Kategory
                            </a>
                            <a href="/users" @if (request()->route()->uri == 'users' || request()->route()->uri == 'newRegister-user'
                                || request()->route()->uri == 'show-bannedUser' || request()->route()->uri == 'user-detail/{slug}')
                                class="active"
                            @endif>
                                <i class="fa-solid fa-user"></i>
                                Users
                            </a>
                            <a href="/rent-logs" 
                                class="{{request()->route()->uri == 'rent-logs' ? 'active' : ''}}">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                Riwayat Penyewaan
                            </a>
                            <a href="/logout">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                Logout
                            </a>
                        @else
                            <a href="/profile"
                                class="{{request()->route()->uri == 'profile' ? 'active' : ''}}">
                                <i class="fa-solid fa-user"></i>
                                Profil</a>
                            <a href="/" 
                                class="{{request()->route()->uri == '/' ? 'active' : ''}}">
                                <i class="fa-solid fa-book"></i>
                                Buku</a>
                            <a href="/logout">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                Logout</a>
                        @endif

                    {{-- jika user tidak login --}}
                    @else
                        <a href="/login" class="active">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Login</a> 

                    @endif
                </div>
                <div class="main-content px-5 py-3 col-lg-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>