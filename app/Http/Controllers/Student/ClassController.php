<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\tbl_kelas;
use App\Models\tbl_kelas_siswa;
use App\Models\tbl_materi;
use App\Models\tbl_tugas;
use App\Models\tbl_ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClassController extends Controller
{

    public function viewClass() {
        $datakelas = tbl_kelas_siswa::where('siswa_id', Auth::user()->id)->get('kelas_id');
        $datakelas = tbl_kelas::whereIn('id', $datakelas->pluck('kelas_id'))->get();

        return view('pages.student.kelas.listClass', [
            'dataKelas' => $datakelas,
        ]);
    }

    public function viewDetailClass($id_class){
        $checkListClass = tbl_kelas_siswa::where([
            ['kelas_id', $id_class],
            ['siswa_id', Auth::user()->id]
        ])->first();

        if($checkListClass != null){
            $detailClass = tbl_kelas::findOrFail($id_class);
            $dataMateri = tbl_materi::where('kelas_id', $id_class)->orderBy('created_at', 'desc')->with('comment_materi')->get();
            $dataTugas  = tbl_tugas::where('id_kelas', $id_class)->orderBy('created_at', 'desc')->with('comment_tugas')->get();
            $dataUjian  = tbl_ujian::where('kelas_id', $id_class)->orderBy('created_at', 'desc')->get();

            return view('pages.student.kelas.detail', [
                'datakelas' => $detailClass,
                'datamateri'    => $dataMateri,
                'dataTugas'     => $dataTugas,
                'dataUjian'     => $dataUjian
            ]);
        } else {
            return redirect()->route('student.class')->with('danger', 'Kamu tidak terdaftar dalam kelas.');
        }
    }

    public function joinCLass(Request $req) {
        $req->validate([
            'code_class' => 'required|min:4'
        ]);

        // Search Class
        $data_class = tbl_kelas::where('code_class', $req->code_class)->first('id');

        $returns = match ($data_class != null) {
            true => $this->createJoinClass($data_class->id),
            default => redirect()->route('student.class')->with('danger', "Kelas tidak dapat ditemukan"),
        };

        return $returns;
    }

    private function createJoinClass($id_class) {

        //Check double join class
        $check = tbl_kelas_siswa::where([
            ['siswa_id', Auth::user()->id],
            ['kelas_id', $id_class],
        ])->first();

        if (!$check){
            //  insert join class
            $insertSiswaJoinClass = tbl_kelas_siswa::create([
                'kelas_id'   => $id_class,
                'siswa_id'  => Auth::user()->id,
            ]);

            if ($insertSiswaJoinClass) {
                return redirect()->route('student.class')->with('success', "Berhasil Bergabung dalam kelas");
            } return redirect()->route('student.class')->with('danger', "Gagal bergabung dalam kelas, Silakan coba kembali.");
        } return redirect()->route('student.class')->with('danger', "Kamu telah bergabung dengan kelas tersebut.");
    }

    public function upload_jawaban_tugas(Request $req) {
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
}
