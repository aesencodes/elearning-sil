<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\tbl_kelas;
use App\Models\tbl_materi;
use App\Models\tbl_tugas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            return redirect()->route('teacher.class')->with('success', 'Berhasil Membuat Kelas');
        } return redirect()->route('teacher.class')->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }

    public function viewClass() {
        $dataKelas = tbl_kelas::where('guru_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('pages.teacher.kelas.view', [
            'dataKelas' => $dataKelas,
        ]);
    }

    public function viewDetailClass($id_class){
        $dataClass  = tbl_kelas::where('id', $id_class)->first();
        $dataMateri = tbl_materi::where('kelas_id', $id_class)->orderBy('created_at', 'desc')->get();
        $dataTugas  = tbl_tugas::where('id_kelas', $id_class)->orderBy('created_at', 'desc')->get();

        return view('pages.teacher.kelas.detail', [
            'datakelas'     => $dataClass,
            'datamateri'    => $dataMateri,
            'dataTugas'     => $dataTugas,
        ]);
    }

    public function viewUpdateClass($id_class) {
        $dataClass = tbl_kelas::where('id', $id_class)->first();

        return view('pages.teacher.kelas.update', [
            'datakelas' => $dataClass,
        ]);
    }

    public function updateClass(Request $req) {
        $req->validate([
            'name_class'            => 'required',
            'description_class'     => 'required',
        ]);

        $update_class = tbl_kelas::where('id', $req->id_class)->update([
            'name_class'        => $req->name_class,
            'description_class' => $req->description_class,
        ]);

        // response
        if ($update_class) {
            return redirect()->route('teacher.detail.class', ['id' => $req->id_class])->with('success', 'Berhasil Memperbaharui Kelas');
        } return redirect()->route('teacher.detail.class', ['id' => $req->id_class])->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }

    public function destroyClass($id_class) {
        $destroyClass = tbl_kelas::where('id', $id_class)->delete();

        if ($destroyClass) {
            return redirect()->route('teacher.class')->with('success', 'Berhasil Menghapus Kelas');
        } return redirect()->route('teacher.class')->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }
}
