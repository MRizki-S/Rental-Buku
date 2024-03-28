<div class="overflow-x-scroll">
    {{-- {{$rentlog}} --}}
    {{-- ini component rent log table --}}
    <table class="table table-sstriped table-hover mt-3 >
        <thead>
            <tr class="">
                <th>No.</th>
                <th>User</th>
                <th>Book</th>
                <th>Rent Date</th>
                <th>Return Date</th>
                <th>Actual Return Date</th>
            </tr>
        </thead>
        {{-- {{$rentBooks}}  --}}
        <tbody> 
            {{-- dapetin data rentLog dari kiriman riwayatPenyewaan datanya --}}
            @foreach ($rentlog as $item)
                {{-- jika tanggal pengembalian sebenarnya null (berarti buku belum dikembalikan == row berwarna putih) --}}
                {{-- dan jika tanggal pengembalian sebenarnya lebih besar dari tanggal pengembalian == row berwarna merah --}}
                {{-- dan jika tanggal pengembalian sebenarnya tidak lebih besar dari  return date ==  row berwanra hijau--}}
                <tr class="{{$item->actual_return_date == null ? '' : 
                            ($item->actual_return_date > $item->return_date ? 'table-danger' : 'table-success')}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->user->username}}</td>
                    <td>{{$item->book->title}}</td>
                    <td>{{$item->rent_date}}</td>
                    <td>{{$item->return_date}}</td>
                    <td>{{$item->actual_return_date}}</td>
                </tr>
            @endforeach
        </tbody>
    </table> 
</div>