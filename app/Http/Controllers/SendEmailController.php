<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmailGmail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\TestSendingEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index() {

        $user = User::findOrFail(1);
        // dd($user[0]->username);

        // Mail::to($request->user())->send(new OrderShipped($order));
                                            // ordershipped nama mail yang dibuat
        // Mail::to('rizkisus0@gmail.com')->send(new TestSendingEmail($user));
        Mail::to('doni2007putra@gmail.com')->send(new kirimEmailGmail($user));
        dd('email berhasil di kirim!');
    }

}
