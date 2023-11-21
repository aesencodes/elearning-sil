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
        $detailClass = tbl_kelas::where('id', $id_class)->first();
        $dataMateri = tbl_materi::where('kelas_id', $id_class)->orderBy('created_at', 'desc')->get();
        $dataTugas  = tbl_tugas::where('id_kelas', $id_class)->orderBy('created_at', 'desc')->get();
        $dataUjian  = tbl_ujian::where('kelas_id', $id_class)->orderBy('created_at', 'desc')->get();

        return view('pages.student.kelas.detail', [
            'datakelas' => $detailClass,
            'datamateri'    => $dataMateri,
            'dataTugas'     => $dataTugas,
            'dataUjian'     => $dataUjian
        ]);
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
}
