<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index() {
        $books = Book::paginate(4);
        return view('books',[
            'dataBuku' => $books
        ]);
    }

    // function untuk form add data
    public function addDataForm() {
        $kategori = Category::all();
        return view('book-add', [
            'kategori' => $kategori,
        ]);
    }
    // function untuk eksekusi add data book
    public function store(Request $request) {
        // validasi data
        $request->validate([
            'book_code' => 'required|unique:books',
            'title' => 'required|max:5',
            'cover' => 'mimes:jpg,jpeg,png',
        ]);


        // jika ada request cover_image
        $newName = '';
        if($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
                                    // now() untuk memberikan nama unique setiap waktu upload
            $newName = $request->title .'_' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
        }

        $request['cover'] = $newName;

        $books = Book::create($request->all());

        // cara menambahkan data kedalam table pivot
        // masukkan data array kedalam table pivotnya yaitu book_category
        // dengan cara dipanggil function Relasinya trs sync
        $books->categories()->sync($request->categories);

        if ($books) {
            return redirect('/books')->with('status', 'success')->with('massage', 'Data berhasil ditambahkan!');
        }else {
            Session::flash('status', 'danger');
            Session::flash('massage', 'Data gagal ditambahkan');
            return redirect('/book-add');
        }
    }


    // function untuk menampilkan form edit data book
    public function editDataForm($slug) {
        $book = Book::where('slug', $slug)->first();

        $kategori = Category::all();


        return view('book-edit', [
            'DataEditBuku' => $book,
            'kategori' => $kategori,
        ]);
    }
    // function untuk eksekusi data dari edit
    public function update(Request $request, $slug) {
         // validasi data
         $request->validate([
            'book_code' => 'required',
            'title' => 'required|max:255',
            'cover' => 'mimes:jpg,jpeg,png',
        ]);

        // cari data apa yang diupdate
        $bookUpdate = Book::where('slug', $slug)->first();
        // dd($bookUpdate->cover);
        // jika ada request cover_image
        $newName = '';
        if($request->file('image')) {
            // hapus img lama
            Storage::delete('cover/'. $bookUpdate->cover);

            $extension = $request->file('image')->getClientOriginalExtension();
                                    // now() untuk memberikan nama unique setiap waktu upload
            $newName = $request->title .'_' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
        }else {
            $newName = $bookUpdate->cover;
        }
        // ganti image ke dalam request[cover] agar dapat ke detect di fillable dan di update
        $request['cover'] = $newName;

        // agar slugnya dapat diupdate harus dinull dulu atau nggan harus di setting seperti di github
        $bookUpdate->slug = null;


        // update
        $bookUpdate->update($request->all());

        // jika request->categories di pilih
        if($request->categories){
            // update table pivot / book_category dengan tetap menggunakan sync
            $bookUpdate->categories()->sync($request->categories);
                        // categories() nama dari relasi di model book
        }


        // jika bener semua lempar ke halaman books
        if($bookUpdate) {
            Session::flash('status', 'success');
            Session::flash('massage', 'Update data book successs!');
            return redirect('/books');
        }

    }


    // method untuk delete data (namun secara softDelete)
    public function destroy($slug) {
        $hapusBuku = Book::where('slug', $slug)->first();

        $hapusBuku->delete();

        if($hapusBuku) {
            Session::flash('status', 'success');
            Session::flash('massage', 'Data Berhasil Dihapus!');
            return redirect('/books');
        }
    }
    // method untuk menampilkan data yang sudah dihapus
    public function showBookDeleted() {
        $booksDeleted = Book::onlyTrashed()->get();

        return view('book-showDeleted',[
            'dataBukuDihapus' => $booksDeleted,
        ]);
    }
    // method untuk restore buku yang sudah di hapus
    public function restore($slug) {
        $retoreBook = Book::withTrashed()
                            ->where('slug', $slug)->first()
                            ->restore();

        if($retoreBook) {
            Session::flash('status', 'success');
            Session::flash('massage', 'Restore data book success!');
            return redirect('show-bookDeleted');
        }
    }
    // method untuk delete secara permanen buku
    public function deletePermanently($slug) {
        $deletePermanentBook = Book::where('slug', $slug);

        $deletePermanentBook->forceDelete();

        if($deletePermanentBook) {
            Session::flash('status', 'success');
            Session::flash('massage', 'successfully deleted data permanently!');
            return redirect('/show-bookDeleted');
        }
    }

}

