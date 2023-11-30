<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\tbl_jawaban_tugas;
use App\Models\tbl_jawaban_ujian;
use App\Models\tbl_ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

    public function viewUpdateUjian($id_ujian) {
        $dataUjian = tbl_ujian::where('id', $id_ujian)->first();

        return view('pages.teacher.ujian.update', [
            'dataUjian' => $dataUjian
        ]);
    }

    public function updateUjian(Request $req) {
        $req->validate([
            'judul_ujian'       => 'required',
            'description'       => 'required',
            'file'              => 'file|mimes:pdf,docx|max:2048',
            'deadline'          => 'required',
        ]);

        $newFileName = $req->old_file;
        if (File::exists($req->file)){
            // Delete old file
            $fileDirOld = 'public/' . $req->id_guru .'/'. $req->id_kelas . '/ujian/' . $req->old_file;
            Storage::delete($fileDirOld);

            // Upload New File
            $newFileName = time() . '.' . $req->file('file')->extension();
            $fileDir = 'public/' . $req->id_guru .'/'. $req->id_kelas . '/ujian/';

            Storage::putFileAs($fileDir, $req->file('file'), $newFileName);
        }

        $updateUjian = tbl_ujian::where('id', $req->id_ujian)->update([
            'judul_ujian'       => $req->judul_ujian,
            'description'       => $req->description,
            'deadline'          => $req->deadline,
            'nama_file_ujian'   => $newFileName,
        ]);

        if ($updateUjian) {
            return redirect()->route('teacher.detail.class', ['id' => $req->id_kelas])->with('success', 'Berhasil Memperbaharui Ujian');
        } return redirect()->back()->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }

    public function destroyUjian($id_ujian) {
        $dataUjian = tbl_ujian::where('id', $id_ujian)->first();

        if ($dataUjian->nama_file_ujian != null) {
            $fileDirOld = 'public/' . $dataUjian->guru_id . '/' . $dataUjian->kelas_id . '/ujian/' . $dataUjian->nama_file_ujian;
            Storage::delete($fileDirOld);
        }

        $destroyUjian = tbl_ujian::where('id', $id_ujian)->delete();

        if ($destroyUjian) {
            return redirect()->back()->with('success', 'Berhasil Menghapus Ujian');
        } return redirect()->back()->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }

    public function listJawabanUjian($id_kelas, $id_ujian) {

        $listjawaban = tbl_jawaban_ujian::where([
            ['ujian_id', $id_ujian],
            ['kelas_id', $id_kelas],
        ])->with('siswa');

        return view('pages.teacher.ujian.list_jawaban', [
            'listJawaban'   => $listjawaban->get(),
            'countJawaban'  => $listjawaban->count(),
            'id_kelas'      => $id_kelas,
        ]);
    }

    public function uploadNilaiUjian(Request $req) {
        $req->validate([
            'nilai'       => 'required',
        ]);

        $updateNilai = tbl_jawaban_ujian::where([
            ['ujian_id', $req->id_ujian],
            ['kelas_id', $req->id_kelas],
            ['siswa_id', $req->id_siswa],
        ])->update([
            'nilai' => $req->nilai,
        ]);

        if ($updateNilai) {
            return redirect()->back()->with('success', 'Berhasil Upload Nilai');
        } return redirect()->back()->with('danger', 'Whoops!! Terjadi kesalahan, Silakan coba kembali.');
    }

}
