@extends('layouts.mainlayout')

@section('title', 'Dashboard')
    
@section('content')

    <div class=" border-bottom border-secondary  fw-bold ">
        <h3>Selamat datang, {{Auth::user()->username}}</h3>
    </div>

    <div class="row mt-4">
        {{-- buku --}}
        <div class="col-lg-4">
            <div class="card-data shadow bg-info rounded">
                <div class="row">
                    <div class="col-6 "><i class="fa-solid fa-book"></i></div>
                    <div class="col-6 d-flex justify-content-center align-items-center flex-column text-light">
                        <div class="card-jumlah fw-bold">{{$jumlahBuku}}</div>
                        <div class="card-desc">Buku</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Kategori --}}
        <div class="col-lg-4">
            <div class="card-data shadow bg-warning rounded">
                <div class="row">
                    <div class="col-6 "><i class="fa-solid fa-layer-group"></i></div>
                    <div class="col-6 d-flex justify-content-center align-items-center flex-column text-light">
                        <div class="card-jumlah fw-bold">{{$jumlahKategori}}</div>
                        <div class="card-desc">Kategori</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- User --}}
        <div class="col-lg-4">
             <div class="card-data shadow bg-success rounded">
                <div class="row">
                    <div class="col-6 "> <i class="fa-solid fa-user"></i></div>
                    <div class="col-6 d-flex justify-content-center align-items-center flex-column text-light">
                        <div class="card-jumlah fw-bold">{{$jumlahUser}}</div>
                        <div class="card-desc">User</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 bg-light shadow py-3 rounded">
        <h4 class="text-primary ms-3">#Riwayat Penyewaan</h4>

        <table class="table table-striped table-hover mt-3">
            <thead>
                <tr class="table-info">
                    <th>No.</th>
                    <th>User</th>
                    <th>Book Title</th>
                    <th>Rent Date</th>
                    <th>Return Date</th>
                    <th>Actual Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="text-center">no data</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>uwong</td>
                    <td>laskar</td>
                    <td>20-20-2020</td>
                    <td>90-90-2003</td>
                    <td>12-09-2009</td>
                    <td>Returned</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection