<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $req->validate([
            'name'      => 'required|string',
            'desc'      => 'required |string',
            'file'      => 'nullable|file|mimes:pdf,docx',
            'id'        => 'required',
            'guru_id'   => 'required'
        ]);

        // create class
        $create_class = tbl_materi::create([
            'name'      => $req->title_materi,
            'desc'      => $req->description_materi,
            'file'      => $req->file_name_materi,
            'id'        => $req->kelas_id,
            'guru_id'   => $req->guru_id
        ]);

        // response
        if ($create_class) {
            return redirect()->route('teacher.class')->with('success', 'Berhasil Membuat Kelas');
        } return redirect()->route('teacher.class')->with('danger', 'Whoops!! Terjadi Kesalahan, Silakan coba kembali.');
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
