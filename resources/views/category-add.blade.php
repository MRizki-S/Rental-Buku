@extends('layouts.mainlayout')

@section('title', 'Add-Category')
    
@section('content')
    <h3>Add New Category</h3>

    <div class="mt-3 bg-light p-3  w-75 rounded">
        <form action="category-add" method="post">
            @csrf

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
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name Category">
            </div>
            <div class="mb-3">
                <a href="/categories" class="btn btn-warning w-25 text-light me-1">Back</a>
                <button type="submit" class="btn btn-success w-25">Save</button>
            </div>
        </form>
    </div>
@endsection