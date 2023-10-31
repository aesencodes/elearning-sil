<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\tbl_tugas;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = tbl_tugas::all();
        return view('pages.teacher.tugas.view', [
            'tugas' => $tugas,
        ]);
    }

    public function viewCreateTugas()
    {
        return view('pages.teacher.tugas.create');
    }

    public function createTugas(Request $req)
    {
        $req->validate([
            'judul_tugas' => 'required',
            'deskripsi_tugas' => 'required',
            'file_upload_tugas' => 'required',
        ]);

        $create_tugas = tbl_tugas::create([
            'judul_tugas'       => $req->judul_tugas,
            'deskripsi_tugas'   => $req->deskripsi_tugas,
            'id'                => $req->id,
            'id_guru'           => Auth::user()->id,
            'file_upload_tugas' => $req->file_upload_tugas,
            'id_kelas'          => $code_class,
        ]);

        if ($create_tugas) {
            return redirect()->route('teacher.tugas')->with('success', 'Berhasil Membuat Kelas');
        } return redirect()->route('teacher.tugas')->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }

}
