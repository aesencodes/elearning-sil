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
            'nuptk' => 123123123,
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

        $student = new User();
        $student->email = 'siswa2@gmail.com';
        $student->password = Hash::make('123123123');
        $student->role_id = 199200;
        $student->save();

        tbl_siswa::create([
            'user_id' => $student->id,
            'nis' => 98712343,
            'name' => 'Nama Siswa 2',
        ]);

        $student = new User();
        $student->email = 'siswa3@gmail.com';
        $student->password = Hash::make('123123123');
        $student->role_id = 199200;
        $student->save();

        tbl_siswa::create([
            'user_id' => $student->id,
            'nis' => 87612332,
            'name' => 'Nama Siswa 3',
        ]);

        $student = new User();
        $student->email = 'siswa4@gmail.com';
        $student->password = Hash::make('123123123');
        $student->role_id = 199200;
        $student->save();

        tbl_siswa::create([
            'user_id' => $student->id,
            'nis' => 29812345,
            'name' => 'Nama Siswa 4',
        ]);

        // Admin
        $admin = new User();
        $admin->email = 'asd@gmail.com';
        $admin->password = Hash::make('asd');
        $admin->role_id = 999999;
        $admin->save();
    }
}
