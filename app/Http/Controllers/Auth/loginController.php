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

class loginController extends Controller
{
    // Dummy Data
    function createDataDummy(): bool {

        $this->insertDataSiswaw();
        $this->insertDataGuru();

        return true;
    }

    private function insertDataSiswaw() {
        $user = New User();
        $user->email = 'siswa@gmail.com';
        $user->password = Hash::make('123123123');
        $user->role_id = 199200;
        $user->save();

        tbl_siswa::create([
            'user_id' => $user->id,
            'nis'   => 12312312,
            'name'  => 'Nama Siswa',
        ]);
    }

    private function insertDataGuru() {
        // Teacher
        $guru = New User();
        $guru->email = 'guru@gmail.com';
        $guru->password = Hash::make('112233');
        $guru->role_id = 199300;
        $guru->save();

        tbl_guru::create([
            'user_id' => $guru->id,
            'nuptk'   => 12312312,
            'name'  => 'Nama Guru',
        ]);
    }

    function viewLogin(): View|string{
        if (!Auth::check()) {
            return view('Auth.login');
        } return print_r("anda sudah login mas");
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

                } return back()->with('error', 'Password Salah');
            } return back()->with('error', 'Email Tidak Tersedia');
        } return print_r("Anda sudah login Hey!!!");
    }

    // Return Type Function : View or Response
    private function accessRoute(): string|RedirectResponse {
        $access = match (Auth::user()->role_id) {
            '199200' => redirect()->route('student.dashboard'),
            '199300' => redirect()->route('teacher.dashboard'),
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
