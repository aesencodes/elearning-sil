<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\tbl_guru;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = tbl_guru::all();
        $counter = 1;

        foreach($teacher as $id){
            $id -> seq_id = $counter++;
        }

        return view('pages.admin.teacher.teacher', [
            'teacher' => $teacher
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nuptk' => 'required|numeric',
            'password' => 'required|string|min:8'
        ]);

        $guru = New User();
        $guru->email = $valid['email'];
        $guru->password = Hash::make($valid['password']);
        $guru->role_id = 199300;
        $guru->save();

        tbl_guru::create([
            'user_id' => $guru->id,
            'nuptk'   => $valid['nuptk'],
            'name'  => $valid['name'],
        ]);
        return redirect()->intended(route('admin.teacher'));
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
        $teacher = tbl_guru::findOrFail($id);
        $teacher->delete();
    }
}
