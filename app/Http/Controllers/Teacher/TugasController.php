<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\tbl_comment_materi;
use App\Models\tbl_comment_tugas;
use App\Models\tbl_kelas;
use App\Models\tbl_tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = tbl_tugas::all();
        return view('pages.teacher.tugas.view', [
            'tugas' => $tugas,
        ]);
    }

    public function viewCreateTugas($id_kelas, $id_guru)
    {
        return view('pages.teacher.tugas.create', [
            'id_kelas' => $id_kelas,
            'id_guru'   => $id_guru,
        ]);
    }

    public function createTugas(Request $req)
    {
        $req->validate([
            'judul_tugas'       => 'required',
            'deskripsi_tugas'   => 'required',
            'file'              => 'file|mimes:pdf,docx|max:2048',
            'id_kelas'          => 'required',
            'id_guru'           => 'required',
            'deadline'          => 'required',
        ]);

        $fileName = null;

        if ($req->file != null) {
            $fileName = time() . '.' . $req->file('file')->extension();
            $fileDir = 'public/' . $req->id_guru .'/'. $req->id_kelas . '/tugas/';

            Storage::putFileAs($fileDir, $req->file('file'), $fileName);
        }

        $create_tugas = tbl_tugas::create([
            'judul_tugas'       => $req->judul_tugas,
            'deskripsi_tugas'   => $req->deskripsi_tugas,
            'id_guru'           => $req->id_guru,
            'file_upload_tugas' => $fileName,
            'id_kelas'          => $req->id_kelas,
            'deadline'          => $req->deadline,
        ]);

        if ($create_tugas) {
            return redirect()->route('teacher.detail.class', ['id' => $req->id_kelas])->with('success', 'Berhasil Membuat Kelas');
        } return redirect()->back()->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }

    public function downloadFileTugas($fileName, $id_kelas, $id_guru){
        return Storage::download('public/' . $id_guru .'/'. $id_kelas . '/tugas/' . $fileName);
    }

    public function comment_tugas(Request $req) {
        $req->validate([
            'comment_materi' => 'required'
        ]);

        $create_comment_materi = tbl_comment_tugas::create([
            'user_id'       => $req->user_id,
            'kelas_id'      => $req->kelas_id,
            'tugas_id'      => $req->tugas_id,
            'comment'       => $req->comment_materi,
        ]);

        if ($create_comment_materi) {
            return redirect()->back()->with('success', 'Berhasil Menambahkan Komentar');
        } return redirect()->back()->with('danger', 'Terjadi Kesalahan, Silakan coba kembali');
    }

    public function viewUpdateTugas($id_tugas) {
        $dataTugas = tbl_tugas::where('id', $id_tugas)->first();

        return view('pages.teacher.tugas.update', [
            'dataTugas' => $dataTugas
        ]);
    }

    public function updateTugas(Request $req) {
        $req->validate([
            'judul_tugas'       => 'required',
            'deskripsi_tugas'   => 'required',
            'file'              => 'file|mimes:pdf,docx|max:2048',
            'deadline'          => 'required',
        ]);

        $newFileName = null;
        if (File::exists($req->file)){
            // Delete old file
            $fileDirOld = 'public/' . $req->id_guru .'/'. $req->id_kelas . '/tugas/' . $req->old_file;
            Storage::delete($fileDirOld);

            // Upload New File
            $newFileName = time() . '.' . $req->file('file')->extension();
            $fileDir = 'public/' . $req->id_guru .'/'. $req->id_kelas . '/tugas/';

            Storage::putFileAs($fileDir, $req->file('file'), $newFileName);
        }

        $updateTugas = tbl_tugas::where('id', $req->id_tugas)->update([
            'judul_tugas'           => $req->judul_tugas,
            'deskripsi_tugas'       => $req->deskripsi_tugas,
            'file_upload_tugas'     => $newFileName,
            'deadline'              => $req->deadline,
        ]);

        if ($updateTugas) {
            return redirect()->route('teacher.detail.class', ['id' => $req->id_kelas])->with('success', 'Berhasil Memperbarui Kelas');
        } return redirect()->back()->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }

    public function destroyTugas($id_tugas) {
        $destroytugas = tbl_tugas::where('id', $id_tugas)->delete();

        if ($destroytugas) {
            return redirect()->back()->with('success', 'Berhasil Menghapus Tugas');
        } return redirect()->back()->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }

}
