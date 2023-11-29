<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\tbl_ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UjianController extends Controller
{
    public function viewCreateUjian($id_kelas, $id_guru) {
        return view('pages.teacher.ujian.create', [
            'id_kelas'  => $id_kelas,
            'id_guru'   => $id_guru,
        ]);
    }

    public function createUjian(Request $req) {
        $req->validate([
            'judul_ujian'       => 'required',
            'description'   => 'required',
            'file'              => 'file|mimes:pdf,docx|max:2048',
            'id_kelas'          => 'required',
            'id_guru'           => 'required',
            'deadline'          => 'required',
        ]);

        $fileName = null;
        if ($req->file != null) {
            $fileName = time() . '.' . $req->file('file')->extension();
            $fileDir = 'public/' . $req->id_guru .'/'. $req->id_kelas . '/ujian/';

            Storage::putFileAs($fileDir, $req->file('file'), $fileName);
        }

        $createUjian = tbl_ujian::create([
            'kelas_id'          => $req->id_kelas,
            'guru_id'           => $req->id_guru,
            'judul_ujian'       => $req->judul_ujian,
            'description'       => $req->description,
            'deadline'          => $req->deadline,
            'nama_file_ujian'   => $fileName,
        ]);

        if ($createUjian) {
            return redirect()->route('teacher.detail.class', ['id' => $req->id_kelas])->with('success', 'Berhasil Membuat Ujian');
        } return redirect()->back()->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }
}
