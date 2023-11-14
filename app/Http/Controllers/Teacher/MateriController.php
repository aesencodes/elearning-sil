<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\View\View;
use App\Models\tbl_materi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id, $guru_id)
    {
        return view('pages.teacher.materi.create', compact('id', 'guru_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'desc'      => 'required|string',
            'file'      => 'required|file|mimes:pdf,docx|max:2048',
            'id'        => 'required',
            'guru_id'   => 'required'
        ]);

        $fileName = time().'.'.$request->file('file')->extension();
        $fileDir = 'public/' . $request->guru_id .'/'. $request->id . '/materi/' . $fileName;

        Storage::putFileAs($fileDir, $request->file('file'), $fileName);

        $create_materi = tbl_materi::create([
            'title_materi'          => $request->name,
            'description_materi'    => $request->desc,
            'file_name_materi'      => $request->file,
            'kelas_id'              => $request->id,
            'guru_id'               => $request->guru_id
        ]);

        // response
        if ($create_materi) {
            return redirect()->route('teacher.detail.class', ['id' => $request->id])->with('success', 'Berhasil Membuat Kelas');
        } return redirect()->back()->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
