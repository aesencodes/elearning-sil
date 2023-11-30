<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\tbl_jawaban_tugas;
use App\Models\tbl_jawaban_ujian;
use App\Models\tbl_tugas;
use App\Models\tbl_ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UjianController extends Controller
{

    public function uploadJawabanUjian(Request $req) {
        $req->validate([
            'file'              => 'required|file|mimes:pdf,docx|max:2048',
        ]);

        $uploadJawaban = null;
        $newFileName = $req->old_file;
        $id_siswa = Auth::user()->id;
        $checkDataReady = tbl_jawaban_ujian::where([
            ['kelas_id', $req->id_kelas],
            ['ujian_id', $req->id_ujian],
            ['siswa_id', $id_siswa]
        ]);

        if (File::exists($req->file)){
            if ($checkDataReady->first() != null) {
                // Delete old file
                $fileDirOld = 'public/' . $req->id_kelas . '/ujian/jawaban/' . $id_siswa . '/' . $req->old_file;
                Storage::delete($fileDirOld);
            }

            // Upload New File
            $newFileName = time() . '.' . $req->file('file')->extension();
            $fileDir= 'public/' . $req->id_kelas . '/ujian/jawaban/' . $id_siswa . "/";

            Storage::putFileAs($fileDir, $req->file('file'), $newFileName);
        }

        if ($checkDataReady->first() == null){
            $uploadJawaban = tbl_jawaban_ujian::create([
                'nama_file_jawaban_ujian'   => $newFileName,
                'kelas_id'                  => $req->id_kelas,
                'ujian_id'                  => $req->id_ujian,
                'siswa_id'                  => $id_siswa,
            ]);
        } else {
            $uploadJawaban = $checkDataReady->update([
                'nama_file_jawaban_ujian'   => $newFileName,
            ]);
        }

        if ($uploadJawaban) {
            return redirect()->back()->with('success', 'Berhasil Upload Jawaban Ujian');
        } return redirect()->back()->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }

    public function downloadJawabanUjian($id_jawaban){
        $dataJawaban = tbl_jawaban_ujian::findOrFail($id_jawaban);

        $path = 'public/' . $dataJawaban->kelas_id . '/ujian/jawaban/' . $dataJawaban->siswa_id . '/' . $dataJawaban->nama_file_jawaban_ujian;
        return Storage::download($path);
    }

    public function downloadFileUjian($id_ujian){
        $dataUjian = tbl_ujian::where('id', $id_ujian)->first();
        $path = 'public/' . $dataUjian->guru_id .'/'. $dataUjian->kelas_id . '/ujian/' . $dataUjian->nama_file_ujian;

        return Storage::download($path);
    }
}
