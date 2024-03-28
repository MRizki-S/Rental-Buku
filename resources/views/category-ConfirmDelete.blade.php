@extends('layouts.mainlayout')

@section('title', 'Category')
    
@section('content')
    <div class="container bg-light rounded shadow-sm px-3 py-4">
        <h3 class="mb-3">Apakah anda yakin ingin menghapus kategori <span class="text-primary">{{$dataDelete->name}}</span></h3>

        {{-- <form action="/category-delete/{{$dataDelete->slug}}" method="post">
            @csrf
            @method('DELETE') --}}
            <a href="/categories" class="btn btn-success text-light ">Cancel</a>
            <a href="/category-delete/{{$dataDelete->slug}}" class="btn btn-danger text-light ">Delete</a>
            {{-- <button type="submit" class="btn btn-danger">Delete</button> --}}
        {{-- </form> --}}
    </div>
@endsection