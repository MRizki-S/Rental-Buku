<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index() {
        $kategori = Category::all();
        return view('category', [
            'kategori' => $kategori,
        ]);
    }

    // method form inputan add data
    public function addDataForm() {
        return view('category-add');
    }
    // method untuk eksekusi add data
    public function store(Request $request) {

        // validasi data
        $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);

        $kategori = Category::create($request->all());

        if ($kategori) {
            // Session::flash('status', 'success');
            // Session::flash('massage', 'Add data category success!');
            return redirect('/categories')->with('status', 'success')->with('massage', 'Data berhasil ditambahkan!');
        }else {
            Session::flash('status', 'danger');
            Session::flash('massage', 'Data gagal ditambahkan');
            return redirect('/category-add');
        }
    }

    // meethod untuk form edit data
    public function editDataForm($slug) {

        $kategori = Category::where('slug', $slug)->first();
        return view('category-edit', [
            'categoryEdit' => $kategori
        ]);
    }
    // method untuk eksekusi data update 
    public function update(Request $request, $slug) {
         // validasi data
         $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);



        $kategori = Category::where('slug', $slug)->first(); //bisa juga make firtsOrFail();

        // agar slugnya dapat diupdate harus dinull dulu atau nggan harus di setting seperti di github
        $kategori->slug = null;

        $kategori->update($request->all());

        if ($kategori) {
            return redirect('/categories')->with('status', 'success')->with('massage', 'Data berhasil diubah!');
        }else {
            Session::flash('status', 'danger');
            Session::flash('massage', 'Data gagal diubah!');
            return redirect('/category-edit');
        } 
        
    }


    // method untuk menampilkan data yang akan di delete
    public function formConfirmDelete($slug) {
        $kategoriConfrimDelete = Category::where('slug', $slug)->first();
        return view('category-ConfirmDelete',[
            'dataDelete' => $kategoriConfrimDelete
        ]);
    }
    // method untuk mengeksekusi delete secara softDelete
    public function destroy($slug) {
        $Hapuskategori = Category::where('slug', $slug)->first();

        $Hapuskategori->delete();

        if($Hapuskategori) {
            Session::flash('status', 'success');
            Session::flash('massage', 'Data Berhasil Dihapus!');
            return redirect('/categories');
        }
    }
    // method untuk menampilkan history data yang terhapus
    public function showCategoryDeleted() {
        $showDeleted = Category::onlyTrashed()->get();

        return view('category-showDeleted', [
            'showDeleted' => $showDeleted,
        ]);
    }
    // method untuk restore data yang sudah di hapus
    public function restore($slug) {
        $restoreCategory = Category::withTrashed()
                                ->where('slug', $slug)->first()
                                ->restore();

        if($restoreCategory) {
            Session::flash('status', 'success');
            Session::flash('massage', 'Restore data category success!');
            return redirect('show-categoryDeleted');
        }
    }
    // method untuk delete data secara permanen 
    public function deletePermanently($slug) {
        $deletePermanent = Category::where('slug', $slug)
                                    ->forceDelete();
        
        if($deletePermanent) {
            Session::flash('status', 'success');
            Session::flash('massage', 'successfully deleted data permanently!');
            return redirect('/show-categoryDeleted');
        }
    }
}
