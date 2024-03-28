@extends('layouts.mainlayout')

@section('title', 'Users')
    
@section('content')

<div class="mb-3 ">
    <h3 class="py-2">List User</h3>
</div>
    <div class="container bg-light shadow-sm px-3 py-4">

        <div class="mb-3 d-flex justify-content-end gap-2">
            <a href="/show-bannedUser" class="btn btn btn-secondary"></i>View Banned Users</a>
            <a href="/newRegister-user" class="btn btn btn-primary"><i class="fa-solid fa-bell me-2"></i>New Register Users</a>
        </div>


        {{-- flash massage --}}
        @if (Session::has('status'))
        <div class="alert alert-{{Session::get('status')}} alert-dismissible fade show" role="alert">
            {{Session::get('massage')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataUsers as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->username}}</td>
                        <td>
                            {{-- jika gak ada phonenya maka tampil kosong --}}
                            @if ($item->phone)
                                {{$item->phone}}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="/user-detail/{{$item->slug}}" class="btn btn-sm btn-primary">Detail</a>
                            <a href="/user-ban/{{$item->slug}}" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalBanUser-{{$item->slug}}">Ban User</a>
                            
                            {{-- <a href="/users/{{$item->slug}}" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditData-{{$item->slug}}">Detail</a> --}}
                        </td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
@endsection





{{-- modal untuk detail data --}}
@foreach ($dataUsers as $dataForModal)
  <!-- Modal -->
  <div class="modal fade" id="modalEditData-{{$dataForModal->slug}}" tabindex="-1" aria-labelledby="modalEditDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-4 fw-bold" id="modalEditDataLabel">Detial Data User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <div class="modal-body">
        
                <div class="mb-3">
                    <p class="fs-5">Username: <span class="text-primary fw-bold">{{$dataForModal->username}}</span></p>
                </div>
                <div class="mb-3">
                    <p class="fs-5">Phone:
                        @if ($dataForModal->phone)
                            {{$dataForModal->phone}}
                        @else
                            -
                        @endif
                    </p>
                </div>
                <div class="mb-3">
                    <p class="fs-5">Address: {{$dataForModal->address}}
                    </p>
                </div>
                <div class="mb-3">
                    <p class="fs-5">Status: 
                        @if ($dataForModal->status == 'active')
                            <span class="me-3 btn btn-success px-3 rounded">{{$dataForModal->status}}</span>
                        @else
                            <span class="me-3 btn btn-danger px-3 rounded">{{$dataForModal->status}}</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                
                {{-- <button type="button" class="btn btn-warning text-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success">Update</button> --}}
            </div>
            
        </div>
    </div>
  </div>
@endforeach
{{-- akhir modal untuk detail data --}}




{{-- Modal untuk hapus data --}}
@foreach ($dataUsers as $dataModalForConfirmDete)
  <!-- Modal -->
  <div class="modal fade" id="modalBanUser-{{$dataModalForConfirmDete->slug}}" tabindex="-1" aria-labelledby="modalBanUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEditDataLabel">Delete Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <p class="fs-5">Are you sure you want to ban the iben account <span class="text-primary fw-bold">{{$dataModalForConfirmDete->username}}</span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success text-light" data-bs-dismiss="modal">Cancel</button>
                <a href="/user-ban/{{$dataModalForConfirmDete->slug}}" class="btn btn-danger">Delete</a>
            </div>
        </form>

      </div>
    </div>
  </div>
@endforeach
{{-- akhir modal untuk hapus data --}}