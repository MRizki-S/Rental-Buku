<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index() {
        $renBooks = RentLogs::with(['user', 'book'])->get();
        return view('riwayatPenyewaan', [
            'rentBooks' => $renBooks, 
        ]);
    }
}
