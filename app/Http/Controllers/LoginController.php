<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        $auth = $request->username;
        $password = $request->password;
        $checkUser = User::where('username', $auth)->first();

            if($checkUser != null){

                    $credentials = ([
                        'username' => $auth,
                        'password' => $password,
                    ]);


                    if (Auth::attempt($credentials)) {
                            return redirect()->route('home');
                    }

            }elseif ($checkUser == null ){
                Alert::error('Failed', 'Gagal login');
                return redirect()->back();
            }
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect()->route('login');
    }
}
