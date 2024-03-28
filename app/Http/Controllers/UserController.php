<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function profile(Request $request) {

        // ngambil data rent log
        // dapetin data rent-log dari user
        $renBooks = RentLogs::with(['user', 'book'])->where('user_id', Auth::user()->id)->get();

        return view('profil', [
            'rentBooks' => $renBooks,
        ]);
    }

    public function index() {
        // $users = User::all();
        // tampilin hanya yang role_id client aja (role_id 2)
        $users = User::where('status', 'active')->where('role_id', 2)->get();

        return view('user', [
            'dataUsers' => $users,
        ]);
    }

    // method untuk detail dari user yang aktif
    public function userActiveDetail($slug) {
        $dataUser = User::where('slug', $slug)->first();

        // dd($dataUser->id);

        // dapetin data rent-log dari user
        $renBooks = RentLogs::with(['user', 'book'])->where('user_id', $dataUser->id)->get();

        return view('userActive-detail', [
            'dataUser' => $dataUser,
            'rentBooks' => $renBooks,
        ]);
    }


    // method untuk melihat user baru yang daftar
    public function newRegisterUser() {
        $usersRegister = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('user-newRegister',[
            'dataUserNewRegister' => $usersRegister,
        ]);
    }
    // method untuk approve account user
    public function userApprove($slug) {
        $userApprove = User::where('slug', $slug)->first();
        $userApprove->status = 'active';

        // bisa make save() atau update()
        $userApprove->save();
        // $userApprove->update();

        if($userApprove) {
            Session::flash('status', 'success');
            Session::flash('massage', 'Pengguna berhasil diAktifkan!');
            return redirect('/newRegister-user');
        }
    }



    // mehtod untuk hapus akun secara softDelete pada akun yg sudah active
    //  (Ban Account)
    public function delete($slug) {
        $deleteUser = User::where('slug', $slug)->first();

        $deleteUser->delete();

        if($deleteUser) {
            Session::flash('status', 'success');
            Session::flash('massage', 'Pengguna berhasil diblokir!');
            return redirect('/users');
        }
    }
    // method untuk menampilkan user yang dibanned/ dihapus secara softDelete
    public function showBannedUser() {
        $showBannedUser = User::onlyTrashed()->where('status', 'active')
                            ->where('role_id', 2)->get();
        return view('user-showBanned',[
            'dataBannedUser' => $showBannedUser
        ]);
    }
    // method untuk restore data yang dibanned/dihapus secara soft deleted
    public function restore($slug) {
        $userRestore = User::where('slug', $slug)
                            ->restore();

        if($userRestore) {
            Session::flash('status', 'success');
            Session::flash('massage', 'Restore user success!');
            return redirect('show-bannedUser');
        }
    }
    //method untuk delete user secara permanen
    public function deletePermanently($slug) {

        // membuat pengkodisan
        // jika akun yang dicari memiliki status inactive ber arti itu akun minta di accept tapi ditolak
        if(User::where('slug', $slug)->where('status', 'inactive')->first()) {
            // dd('ini akun dengan status inactive');
            $userDeletePermanent = User::where('slug', $slug)
                                    ->forceDelete();


            if($userDeletePermanent) {
                Session::flash('status', 'success');
                Session::flash('massage', 'the request was successfully rejected');
                return redirect('/newRegister-user');
            }
            }else {
            // jika salah berarti ini delete permanent dari akun yang sudah aktif dan diblok
            $userDeletePermanent = User::where('slug', $slug)
                                    ->forceDelete();


            if($userDeletePermanent) {
                Session::flash('status', 'success');
                Session::flash('massage', 'successfully deleted user permanently!');
                return redirect('/show-bannedUser');
            }
        }

    }

}
