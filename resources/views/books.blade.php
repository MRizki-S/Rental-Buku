@extends('layouts.mainlayout')

@section('title', 'Buku')
    
@section('content')

<div class="mb-3">
    <h3 class=" py-2">Books</h3>
</div>

    <div class="container bg-light p-3 shadow-sm rounded">

        <div class="mb-3 d-flex justify-content-end">
            <a href="/book-add" class="btn btn-primary me-2">Add data</a>
            <a href="/show-bookDeleted" class="btn  btn-secondary text-light">Show History Deleted</a>
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
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataBuku as $item)
                    <tr>
                        <td>{{$loop->iteration + $dataBuku->firstItem() - 1}}</td>
                        <td>{{$item->book_code}}</td>
                        <td>{{$item->title}}</td>
                        <td>
                            @foreach ($item->categories as $category)
                                - {{$category->name}} <br>
                            @endforeach
                        </td>
                        <td>{{$item->status}}</td>
                        <td>
                            {{-- <a href="" class="btn btn-sm btn-warning text-light" data-bs-toggle="modal" data-bs-target="#modalEditData-{{$item->slug}}">Edit</a> --}}
                            <a href="/book-edit/{{$item->slug}}" class="btn btn-sm btn-warning text-light">Edit</a>
                            <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteData-{{$item->slug}}">Hapus</a>
                            {{-- /category-confirmDelete/{{$item->slug}} --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-3">
        {{$dataBuku->withQueryString()->onEachSide(5)->links()}}
        {{-- jika ingin style dari tombol paginationnya bagus harus impor dulu boostrap 
            di App/providers/AppServiceProvider --}}
    </div>

@endsection





{{-- Modal untuk hapus data --}}
@foreach ($dataBuku as $data)
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
@endforeach
{{-- akhir modal untuk hapus data --}}