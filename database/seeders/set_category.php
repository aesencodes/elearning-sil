<?php

namespace Database\Seeders;

use App\Models\set_category as ModelsSet_category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class set_category extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id'    => 1,
                'name'  => 'Access Account',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'    => 2,
                'name'  => 'Status Siswa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        ModelsSet_category::insert($data);
    }
}
