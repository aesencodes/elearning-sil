<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\tbl_kelas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClassController extends Controller
{

    public function viewCreateClass(): View {
        return view('pages.teacher.kelas.create');
    }

    public function createClass(Request $req) {
        $req->validate([
            'name_class'            => 'required',
            'description_class'     => 'required',
        ]);

        // create class
        $code_class = RandomForCode(5);

        $create_class = tbl_kelas::create([
            'name_class'        => $req->name_class,
            'description_class' => $req->description_class,
            'guru_id'           => Auth::user()->id,
            'code_class'        => $code_class,
        ]);

        // response
        if ($create_class) {
            return redirect()->route('teacher.create.class')->with('success', 'Berhasil Membuat Kelas');
        } return redirect()->route('teacher.create.class')->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }
}
