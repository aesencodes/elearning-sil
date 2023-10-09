<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\tbl_siswa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use PHPUnit\Event\Code\Throwable;

class loginController extends Controller
{
    // Dummy Data
    function createDataDummy(): bool {
        $user = New User();
        $user->email = 'email@gmail.com';
        $user->password = Hash::make('123123123');
        $user->role_id = 199200;
        $user->save();

        $siswa =  tbl_siswa::create([
            'user_id' => $user->id,
            'nis'   => 12312312,
            'name'  => 'nest',
        ]);

        return true;
    }

    function viewLogin(): View|string{
        if (!Auth::check()) {
            return view('Auth.login');
        } return print_r("anda sudah login mas");
    }

    function loginProcess(Request $req): object|bool|String{

        if (!Auth::check()){
            $credential = $req->validate([
                'email'     => 'required',
                'password'  => 'required'
            ]);

            if (User::where('email', $req->email)->count() > 0){
                if (Auth::attempt($req->except(['_token', '_method']))){
                    // Security for random id session
                    $req->session()->regenerate();

                    // Access Route Redirect
                    return $this->accessRoute();

                } return print_r('Silakan Periksa Password Anda!!!');
            } return print_r('Email Tidak Tersedia');
        } return print_r("Anda sudah login Hey!!!");
    }

    // Return Type Function : View or Response
    private function accessRoute(): string {
        $access = match (Auth::user()->role_id) {
            '199200' => print_r("Access for Student", true),
            '199300' => print_r("Access for Teacher", true),
            '999999' => print_r("Access for Admin", true),
        };

        return $access;
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return true;
    }
}
