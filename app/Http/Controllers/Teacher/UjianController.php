<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Models\tbl_ujian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UjianController extends Controller
{
    public function index()
    {
        $ujian = tbl_ujian::all();
        return view('pages.teacher.ujian.view', [
            'ujian' => $ujian,
        ]);
    }

    public function viewCreateUjian($kelas_id, $guru_id)
    {
        return view('pages.teacher.ujian.create', [
            'id_kelas' => $kelas_id,
            'id_guru'   => $guru_id,
        ]);
    }

    public function createUjian(Request $req)
    {
        $req->validate([
            'judul_ujian'       => 'required',
            'deskripsi_ujian'   => 'required',
            'file'              => 'file|mimes:pdf,docx|max:2048',
            'id_kelas'          => 'required',
            'id_guru'           => 'required'
        ]);

        $fileName = null;

        if ($req->file != null) {
            $fileName = time() . '.' . $req->file('file')->extension();
            $fileDir = 'public/' . $req->id_guru .'/'. $req->id_kelas . '/ujian/';

            Storage::putFileAs($fileDir, $req->file('file'), $fileName);
        }

        $create_ujian = tbl_ujian::create([
            'judul_ujian'       => $req->judul_ujian,
            'deskripsi_ujian'   => $req->description,
            'id_guru'           => $req->id_guru,
            'file_upload_tugas' => $fileName,
            'id_kelas'          => $req->id_kelas,
        ]);

        if ($create_ujian) {
            return redirect()->route('teacher.detail.class', ['id' => $req->id_kelas])->with('success', 'Berhasil Membuat Kelas');
        } return redirect()->back()->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }

    public function downloadFileTugas($fileName, $id_kelas, $id_guru){
        return Storage::download('public/' . $id_guru .'/'. $id_kelas . '/ujian/' . $fileName);
    }
}
