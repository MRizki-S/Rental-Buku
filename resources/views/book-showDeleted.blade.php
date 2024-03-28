@extends('layouts.mainlayout')

@section('title', 'Books')
    
@section('content')

<div class="mb-3">
    <h3 class=" py-2">Books Deleted</h3>
</div>
<div class="container bg-light p-3 shadow-sm rounded">
    
    <div class="mb-3 d-flex justify-content-end">
        <a href="/books" class="btn btn-primary ">Back</a>
    </div>
        {{-- Session Massage --}}
        @if (Session::has('status'))
        <div class="alert alert-{{Session::get('status')}} alert-dismissible fade show" role="alert">
            {{Session::get('massage')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-striped table-hover mt-3">
            <thead>
                <tr class="table-info">
                    <th>No.</th>
                    <th>Code</th>
                    <th>Title</th>
                    {{-- <th>Category</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataBukuDihapus as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->book_code}}</td>
                    <td>{{$item->title}}</td>
                    {{-- <td>
                        @foreach ($item->categories as $category)
                            - {{$category->name}} <br>
                        @endforeach
                    </td> --}}
                    <td>
                        <a href="/book/{{$item->slug}}/restore" class="btn btn-sm btn-warning text-light">Restore</a>
                        <a href="/book/{{$item->slug}}/deletePermanent" class="btn btn-sm btn-danger" >Permanently Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
 