@extends('layouts.mainlayout')

@section('title', 'Add-Book')
    
@section('content')

{{-- cdn  select 2--}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <h3>Add New Book</h3>

    <div class="mt-3 bg-light p-3  w-75 rounded">
        <form action="book-add" method="post" enctype="multipart/form-data">
            @csrf

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

            {{-- Session Massage --}}
            @if (Session::has('status'))
            <div class="alert alert-{{Session::get('status')}} alert-dismissible fade show" role="alert">
                {{Session::get('massage')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="mb-3">
                <label for="book_code" class="form-label">Code</label>
                <input type="text" name="book_code" id="book_code" class="form-control" placeholder="Book Code" value="{{ old('book_code') }}">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Book Title" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Cover Image</label>
                <input type="file" name="image" id="image" class="form-control" placeholder="Cover Image">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                {{-- name nya dikasih [] agar jadi array pilihan category karena multiple --}}
                <select name="categories[]" id="category" class="form-control select-multiple" multiple>
                    @foreach ($kategori as $item)       
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <a href="/books" class="btn btn-warning w-25 text-light me-1">Back</a>
                <button type="submit" class="btn btn-success w-25">Save</button>
            </div>
        </form>
    </div>


{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
{{-- cdn select 2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- untuk select 2  --}}
<script>
    $(document).ready(function() {
        $('.select-multiple').select2();
    });
</script>
@endsection