@extends('layouts.mainlayout')

@section('title', 'Category')
    
@section('content')

<div class="mb-3">
    <h3 class=" py-2">List of removed Category</h3>
</div>
<div class="container bg-light p-3 shadow-sm rounded">
    
    <div class="mb-3 d-flex justify-content-end">
        <a href="/categories" class="btn btn-primary ">Back</a>
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
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($showDeleted as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        <a href="/category/{{$item->slug}}/restore" class="btn btn-sm btn-warning text-light">Restore</a>
                        <a href="/category/{{$item->slug}}/deletePermanent" class="btn btn-sm btn-danger" >Permanently Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
 