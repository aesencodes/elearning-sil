<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\tbl_siswa;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = tbl_siswa::all();
        $counter = 1;

        foreach($student as $id){
            $id -> seq_id = $counter++;
        }

        return view('pages.admin.student.student', [
            'student' => $student
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nis' => 'required|numeric',
            'password' => 'required|string|min:8'
        ]);

        $guru = New User();
        $guru->email = $valid['email'];
        $guru->password = Hash::make($valid['password']);
        $guru->role_id = 199200;
        $guru->save();

        tbl_siswa::create([
            'user_id' => $guru->id,
            'nis'   => $valid['nis'],
            'name'  => $valid['name'],
        ]);
        return redirect()->intended(route('admin.student'));
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
        $student = tbl_siswa::findOrFail($id);
        $email = User::findOrFail($student->user_id);

        return view('pages.admin.student.edit', [
            'student' => $student,
            'email' => $email->email
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $valid = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'nis' => 'required|numeric'
            ]);
        
            $student = tbl_siswa::findOrFail($id);
        
            $user = User::findOrFail($student->user_id);
            $user->email = $valid['email'];
            $user->save();
        
            $student->nis = $valid['nis'];
            $student->name = $valid['name'];
            $student->save();
        
            return redirect()->intended(route('admin.student'));
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = tbl_siswa::findOrFail($id);
        $user_id = $student->user_id;
        $user = User::findOrFail($user_id);

        $student->delete();
        $user->delete();

        return redirect()->intended(route('admin.student'));
    }
}
