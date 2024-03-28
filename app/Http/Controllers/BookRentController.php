<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index() {
        $users = User::where('role_id', 2)->where('status', 'active')->get();
        $books = Book::all();
       return view('book-rent', [
        'users' => $users,
        'books' => $books,
       ]);
    }

    // method untuk eksekusi yang mau minjam
    public function storeAction(Request $request) {

        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(7)->toDateString();
        // dd($request->all());
                                                // ambil statusnya aja
        $book = Book::findOrFail($request->book_id)->only('status');

        // cek apakah status dari buku in stock
        if($book['status'] != 'in stock'){
            Session::flash('status', 'danger');
            Session::flash('massage', 'Cannot rent, the book is not available!');
            return redirect('/book-rent');
        }else {
            // cek apakah user sudah meminjam 3 buku dan belum di balikin semua
            // maksimal peminjaman 3 buku (jika belum di balikin)
            $jumlah = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)
                                ->count();
            // dd($jumlah);
            if($jumlah >= 3) {
                Session::flash('status', 'danger');
                Session::flash('massage', 'Cannot rent, user has reach limit of book!');
                return redirect('/book-rent');
            }

            try {
                // menggunakan laravel trancation
                DB::beginTransaction();

                // // proses menambahkan kedalam table rent_logs
                RentLogs::create($request->all());
                // proses update status buku di table books
                $book = Book::findOrFail($request->book_id);
                $book->status = 'not available';
                $book->save();

                // jika sudah selesai/berhasil maka di commit
                DB::commit();

                Session::flash('status', 'success');
                Session::flash('massage', 'book successfully rented!');
                return redirect('/book-rent');

            } catch (\Throwable $th) {
                DB::rollBack();
                // dd($th);
            }
        }

    }


    // method untuk manampilkan layout pengembalian buku
    public function returnBook() {
        $users = User::where('role_id', 2)->where('status', 'active')->get();
        $books = Book::all();
        return view('return-book', [
            'users' => $users,
            'books' => $books,
        ]);
    }
    // method untuk eksekusi dari pengembalian buku
    public function returnBookAction(Request $request) {
        // dd($request->all());

        $cekRentLogs = RentLogs::where('user_id', $request->user_id)
                        ->where('book_id', $request->book_id)
                        ->where('actual_return_date',  null);
        $returnData = $cekRentLogs->first();
        $jumlahData = $cekRentLogs->count();



        // user dan buku yang dipilih untuk direturn benar, maka berhasil return book
        // user dan buku yang dipilih untuk return salah, maka munculin flash session
        if($jumlahData == 1) {
            // mengubah actual_return_date ke dalam hari ini(hari pengembalian)
            $returnData->actual_return_date = Carbon::now()->toDateString();
            $returnData->save();

            // mengubah status dari buku yang dikembalikan menjadi in stock kembali
            $changeStatusBook = Book::findOrFail($request->book_id);
            $changeStatusBook->status  = 'in stock';
            $changeStatusBook->save();

            // redirect ke return book
            Session::flash('status', 'success');
            Session::flash('massage', 'The book is returned successfully!');
            return redirect('/book-return');
        }else {
            // error flash massage
            Session::flash('status', 'danger');
            Session::flash('massage', 'The book is returned unsuccessful!');
            return redirect('/book-return');
        }
    }


}
