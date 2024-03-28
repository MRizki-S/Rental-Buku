@extends('layouts.mainlayout')

@section('title', 'Riwayat')
    
@section('content')
    
<div class="mb-3">
    <h3 class=" py-2">Rent log books</h3>
</div>

    <div class="container bg-light p-3 shadow-sm rounded">

        {{-- manggil view componen rent log table --}}
        <x-rent-log-table :rentlog='$rentBooks' />
                    {{-- ngirim data ke rent-log component view --}}
                    {{-- dengan parameter dtaa yang dikirim dari RentLogController yaitu rentBooks--}}
                    {{-- dikasih : karena manggil variabel yang dikirim dari controller--}}
    </div>
@endsection


{{-- <td> --}}
                            {{-- <a href="" class="btn btn-sm btn-warning text-light" data-bs-toggle="modal" data-bs-target="#modalEditData-{{$item->slug}}">Edit</a> --}}
                            {{-- <a href="/book-edit/{{$item->slug}}" class="btn btn-sm btn-warning text-light">Detail</a>
                            <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteData-{{$item->slug}}">Hapus</a> --}}
                            {{-- /category-confirmDelete/{{$item->slug}} --}}
                        {{-- </td> --}}