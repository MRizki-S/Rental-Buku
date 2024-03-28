@extends('layouts.mainlayout')

@section('title', 'Book-Rent')
    
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <h3 class="text-md-center text-lg-start">Book Rent</h3>

    <div class="mt-3 bg-light p-3 rounded col-12 col-md-10 offset-md-1  col-lg-8 offset-lg-0">
        <form action="book-rent" method="post">
            @csrf

            {{-- Session Massage --}}
            @if (Session::has('status'))
            <div class="alert alert-{{Session::get('status')}} alert-dismissible fade show" role="alert">
                {{Session::get('massage')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-control boxSelect-2">
                    <option value="">Select Users</option>
                    @foreach ($users as $dataUser)
                        <option value="{{$dataUser->id}}">{{$dataUser->username}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="book_id" class="form-label">Book</label>
                <select name="book_id" id="book_id" class="form-control boxSelect-2">
                    <option value="">Select Book</option>
                    @foreach ($books as $dataBuku)
                        <option value="{{$dataBuku->id}}">{{$dataBuku->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <a href="/dashboard" class="btn btn-warning w-25 text-light me-1">Back</a>
                <button type="submit" class="btn btn-success w-25">Sumbit</button>
            </div>
        </form>
    </div>


{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
{{-- cdn select 2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- untuk select 2  --}}
<script>
    // untuk select user dam book
    $(document).ready(function(){
        $('.boxSelect-2').select2();
    });
</script>

@endsection