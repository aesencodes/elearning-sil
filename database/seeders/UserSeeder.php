<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\tbl_guru;
use App\Models\tbl_siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Teacher
        $teacher = new User();
        $teacher->email = 'guru@gmail.com';
        $teacher->password = Hash::make('112233');
        $teacher->role_id = 199300;
        $teacher->save();

        tbl_guru::create([
            'user_id' => $teacher->id,
            'nuptk' => 12312312,
            'name' => 'Nama Guru',
        ]);

        // Student
        $student = new User();
        $student->email = 'siswa@gmail.com';
        $student->password = Hash::make('123123123');
        $student->role_id = 199200;
        $student->save();

        tbl_siswa::create([
            'user_id' => $student->id,
            'nis' => 12312312,
            'name' => 'Nama Siswa',
        ]);

        // Admin
        $admin = new User();
        $admin->email = 'asd@gmail.com';
        $admin->password = Hash::make('asd');
        $admin->role_id = 999999;
        $admin->save();
    }
}
