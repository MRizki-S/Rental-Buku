@extends('layouts.mainlayout')

@section('title', 'Buku')

@section('content')
<style>
    .card-img{
        background-color: aqua
        height: 100px;
    }
    img{
        background-size: cover;
        background-position: center;
    }
</style>

<div class="mb-5">

    <div class="container bg-light shadow-sm rounded py-4 mb-3">
        <form action="" method="get">
            @csrf

            <div class="row">
                {{-- search untuk kategori --}}
                <div class="col-12 col-sm-6">
                    <select name="category" id="category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                {{-- search untuk title --}}
                <div class="col-12 col-sm-6">
                    <div class="input-group">
                        <input type="text" name="title" class="form-control" placeholder="Search book's title..." value="{{request('title')}}">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        @foreach ($dataBuku as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                {{-- card book--}}
                <div class="card h-100 shadow-sm" style="">
                    <div class="card-img h-75 bg-">
                        <img src="{{ $item->cover == null ? asset('images/cover-image-not-available.jpg') : asset( 'storage/cover/'.$item->cover)}}" draggable="false" class="img-thumbnail object-fit-cover mx-auto" alt="..." style="">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$item->book_code}}</h5>
                        <p class="card-text">{{$item->title}}</p>
                        <div class="text-end">
                            <p class="card-text btn btn-{{$item->status == 'in stock' ?
                            'success' : 'danger'}}">{{$item->status}}</p>
                            <p>@foreach ($item->categories as $category)
                                {{$category->name}}
                            @endforeach</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


</div>

@endsection





{{-- Modal untuk hapus data --}}
{{-- @foreach ($dataBuku as $data)
  <!-- Modal -->
  <div class="modal fade" id="modalDeleteData-{{$data->slug}}" tabindex="-1" aria-labelledby="modalDeleteDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEditDataLabel">Delete Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <p class="fs-5">Apakah Anda Yakin Ingin Menghapus Buku <br><span class="text-primary">{{$data->title}}</span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success text-light" data-bs-dismiss="modal">Cancel</button>
                <a href="/book-delete/{{$data->slug}}" class="btn btn-danger">Delete</a>
            </div>
        </form>

      </div>
    </div>
  </div>
@endforeach --}}
{{-- akhir modal untuk hapus data --}}
