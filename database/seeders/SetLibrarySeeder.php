<?php

namespace Database\Seeders;

use App\Models\set_library;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SetLibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id'          => 199200,
                'category_id' => 1,
                'name'        => 'Student Access',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'          => 199300,
                'category_id' => 1,
                'name'        => 'Teacher Access',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'          => 999999,
                'category_id' => 1,
                'name'        => 'Admin Access',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        set_library::insert($data);

        $data = [
            [
                'id'            => 1,
                'category_id'   => 2,
                'name'          => 'Joined',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 2,
                'category_id'   => 2,
                'name'          => 'Leave',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        set_library::insert($data);
    }
}
