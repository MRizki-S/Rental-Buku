<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    
    // function untuk menampilkan login
    public function login() {
        return view('login');
    }
    // function untuk eksekusi login
    public function authenticating(Request $request) {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        //cek apakah login benar
        if(Auth::attempt($credentials)) {
            
            //cek apakah user statusnya = active (jika aktif baru boleh masuk) 
            if (Auth::user()->status != 'active') {
                // jika benar tidak aktif maka dipaksa logout
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerate();
                 
                // kembalikan untuk tetap di halaman login dan bikin session flash massage
                Session::flash('status', 'warning');
                Session::flash('massage', 'Akun anda belum aktif. Silahkan hubungi admin!');
                return redirect('login');
            }
            
            // jika user yang login role_id admin(1)
            $request->session()->regenerate();
            if(Auth::user()->role_id == 1) {
                return redirect('dashboard');
            }
            // jika user yang login role_id client(2)
            if(Auth::user()->role_id == 2) {
                return redirect('profile');
            }

        }

        // jika login gagal
        Session::flash('status', 'danger');
        Session::flash('massage', 'Login Gagal!');
        return redirect('login');
    }

    // function untuk menampikan view register
    public function register() {
        return view('register');
    }
    // function untuk eksekusi register
    public function registerAuth(Request $request) {
        // validasi sebelum di proses
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255', //unik di table users
            'password' => 'required',
            'phone' => 'max:255',
            'address' => 'required'
        ]);

        // hash password    //ini merah kerena ada exstension php intelephense
        $request['password'] = Hash::make($request->password);
        // dd($request->password); bisa make $request->password atau $request['password']
        
        // membuat dan memasukkan ke dalam database
        $user = User::create($request->all());

        if ($user){
            Session::flash('status', 'success');
            Session::flash('massage', 'Akun berhasil didaftarkan, Tunggu persetujuan admin');
            return redirect('/register');
        }
    }

    // function untuk logout
    public function logout(Request $request) {
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
