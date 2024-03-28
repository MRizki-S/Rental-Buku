<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $jumlahBuku = Book::count();
        $jumlahKategori = Category::count();
        $jumalhUser = User::count();

        // untuk mendapatkan data rent_log buku
        $renBooks = RentLogs::with(['user', 'book'])->get();

        return view('dashboard', [
            'jumlahBuku' => $jumlahBuku,
            'jumlahKategori' => $jumlahKategori,
            'jumlahUser' => $jumalhUser,
            'rentLogs' => $renBooks, 
        ]);
    }
}
