@extends('layouts.mainlayout')

@section('title', 'Category')

@section('content')
<div class="mb-3">
    <h3 class=" py-2">List Category</h3>
</div>
    <div class="container bg-light px-3 py-4 shadow-sm rounded">
        {{-- <h3 class="mb-3">List Kategori</h3> --}}

        <div class="mb-3 d-flex justify-content-end">
            <a href="/category-add" class="btn btn-primary me-2">Add data</a>
            <a href="/show-categoryDeleted" class="btn  btn-secondary text-light">Show History Deleted</a>
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
                <tr class="tablesa-info">
                    <th>No.</th>
                    <th>Name</th>
                    <th>Last Update</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        {{-- {{$kategori[0]->updated_at->diffForHumans()}} --}}
                    </td>
                    <td class="d-flex flex-wrap gap-2">
                        <a href="" class="btn btn-sm btn-warning text-light" data-bs-toggle="modal" data-bs-target="#modalEditData-{{$item->slug}}">Edit</a>
                        {{-- <a href="/category-edit/{{$item->slug}}" class="btn btn-sm btn-warning text-light">Edit</a> --}}
                        <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteData-{{$item->slug}}">Hapus</a>
                        {{-- /category-confirmDelete/{{$item->slug}} --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection






{{-- modal untuk edit data --}}
@foreach ($kategori as $dataModal)
  <!-- Modal -->
<form  action="category-edit/{{$dataModal->slug}}" method="post">
  <div class="modal fade" id="modalEditData-{{$dataModal->slug}}" tabindex="-1" aria-labelledby="modalEditDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEditDataLabel">Edit Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <div class="modal-body">
                @csrf
                @method('put')

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

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name Category" value="{{$dataModal->name}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning text-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success">Update</button>
            </div>

        </div>
    </div>
  </div>
</form>
@endforeach
{{-- akhir modal untuk edit data --}}




{{-- Modal untuk hapus data --}}
@foreach ($kategori as $dataModal)
  <!-- Modal -->
  <div class="modal fade" id="modalDeleteData-{{$dataModal->slug}}" tabindex="-1" aria-labelledby="modalDeleteDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEditDataLabel">Delete Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <p class="fs-5">Apakah Anda Yakin Ingin Menghapus kategori <span class="text-primary fw-bold">{{$dataModal->name}}</span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success text-light" data-bs-dismiss="modal">Cancel</button>
                <a href="/category-delete/{{$dataModal->slug}}" class="btn btn-danger">Delete</a>
            </div>
        </form>

      </div>
    </div>
  </div>
@endforeach
{{-- akhir modal untuk hapus data --}}



