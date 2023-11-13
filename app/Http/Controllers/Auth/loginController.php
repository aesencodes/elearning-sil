<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\tbl_guru;
use App\Models\tbl_siswa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class loginController extends Controller
{

    function viewLogin(): RedirectResponse|string|View
    {
        if (!Auth::check()) {
            return view('pages.auth.login');
        }
        return $this->accessRoute();
    }

    function loginProcess(Request $req): bool|String|RedirectResponse{
        $credential = $req->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);

        if (!Auth::check()){
            if (User::where('email', $req->email)->count() > 0){
                if (Auth::attempt($req->only(['email', 'password']))){
                    // Security for random id session
                    $req->session()->regenerate();

                    // Access Route Redirect
                    return $this->accessRoute();

                } return back()->with('danger', 'Password Salah');
            } return back()->with('danger', 'Email Tidak Tersedia');
        } return print_r("Anda sudah login Hey!!!");
    }

    // Return Type Function : View or Response
    private function accessRoute(): string|RedirectResponse {
        $access = match (Auth::user()->role_id) {
            '199200' => redirect()->route('student.dashboard'),
            '199300' => redirect()->route('teacher.dashboard'),
            '999999' => redirect()->route('admin.dashboard'),
        };

        return $access;
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.view');
    }
}
