@extends('layouts.mainlayout')

@section('title', 'Profil')
    
@section('content')
<div class="mb-3">
    <h3>Profile</h3>
</div>

    <div class="col-s6 offset-lg-0 container bg-light shadow-sm px-3 py-4">
        <h4>Your Rent Log</h4>
        <x-rent-log-table :rentlog='$rentBooks' />
    </div>
@endsection