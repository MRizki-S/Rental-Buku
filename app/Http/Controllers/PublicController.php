<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PublicController extends Controller
{
    
    // untuk menampilkan index buat client
    public function index(Request $request) {
        // ambil kategori untuk ditampilin ke book-list pencarian 
        $categories = Category::all();

        // jika tidak melakukan pencarian maka tampilin semua
        if($request->category || $request->title) {
            // $books = Book::with('categories')
            //             ->where('title', 'LIKE', '%'.$request->title.'%')
            //             ->orWhereHas('categories', function($c) use($request){
            //                 // ambil dari catigories id nya
            //                     $c->where('categories.id', $request->category);
            //             })->get();

            if($request->category && $request->title) {
                // bikin session untuk mengisi pencarian agar tidak ke reset ketika di klik cari
                Session::flash('category', $request->category);
                Session::flash('title', $request->title);

                // dd('ini kategory: '.$request->category. ', dan ini adalah title: '.$request->title);
                $books = Book::with('categories')
                            ->where('title', 'LIKE', '%'.$request->title.'%')
                            ->whereHas('categories', function($c) use($request){
                                    // ambil dari catigories id nya
                                $c->where('categories.id', $request->category);
                            })->get();

            }else if($request->title) {
                $books = Book::where('title', 'LIKE', '%'.$request->title.'%')->get();
                
            }else if($request->category) {
                $books = Book::with('categories')
                                ->whereHas('categories', function($c) use($request){
                    // ambil dari catigories id nya
                    $c->where('categories.id', $request->category);
                })->get();
            }

                    // mencari dengan adanya relationshipnya
            // $books = Book::whereHas('categories', function($c) use($request){
            //             // ambil dari catigories id nya
            //     $c->where('categories.id', $request->category);
            // })->get();
        }else{
            $books = Book::all();
        }

        return view('book-list', [
            'dataBuku' => $books,
            'categories' => $categories
        ]);
    }
}
