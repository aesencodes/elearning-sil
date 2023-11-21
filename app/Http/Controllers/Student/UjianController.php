<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\tbl_tugas;
use App\Models\tbl_ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UjianController extends Controller
{

    public function upload_jawaban(Request $req) {
        $req->validate([
            'file'              => 'required|file|mimes:pdf,docx|max:2048',
            'description'       => 'required',
        ]);

        if ($req->file != null) {
            $fileName = time() . '.' . $req->file('file')->extension();
            $fileDir = 'public/' . $req->id_guru .'/'. $req->id_kelas . '/ujian/jawaban/';

            Storage::putFileAs($fileDir, $req->file('file'), $fileName);
        }

        $create_ujian = tbl_ujian::create([
            'deskripsi_tugas'           => $req->deskripsi_tugas,
            'nama_file_jawaban_ujian'   => $fileName,
            'kelas_id'                  => $req->id_guru,
            'guru_id'                   => $req->id_kelas,
        ]);

        if ($create_ujian) {
            return redirect()->back()->with('success', 'Berhasil Upload Jawaban Ujian');
        } return redirect()->back()->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');

    }

    public function downloadFileMateri($fileName, $id_kelas, $id_guru){
        return Storage::download('public/' . $id_guru .'/'. $id_kelas . '/ujian/' . $fileName);
    }
}
