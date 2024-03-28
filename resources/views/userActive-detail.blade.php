@extends('layouts.mainlayout')

@section('title', 'NewRegistered-user')
    
@section('content')
<div class="mb-3">
    <h3 class="py-2 ">Detail User <span class="fw-bold ">{{$dataUser->username}}</span></h3>
</div>

    <div class="col-8   offset-lg-0 container bg-light shadow-sm px-3 py-4 mb-3">
        <div class="mb-3 d-flex justify-content-end gap-2">
            <a href="/users" class="btn btn btn-primary"></i>Back</a>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" readonly value="{{$dataUser->username}}">
        </div>
        <div class="mb-3">
            <label for="Phone" class="form-label">Phone</label>
            <input type="text" name="Phone" id="Phone" class="form-control" readonly value="{{$dataUser->phone == NULL ? '-' : $dataUser->phone}}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control" readonly value="{{$dataUser->address}}">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label me-3">status</label>
            <a href="" class="btn w-25 {{$dataUser->status == 'active' ? 'btn-success' : 'btn-danger'}}">{{$dataUser->status}}</a>
        </div>
    </div>

    <div class="col-s6 offset-lg-0 container bg-light shadow-sm px-3 py-4">
        <h4>User Rent Log</h4>
        <x-rent-log-table :rentlog='$rentBooks' />
    </div>

@endsection
