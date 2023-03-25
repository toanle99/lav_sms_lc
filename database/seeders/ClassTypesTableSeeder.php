<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_types')->delete();

        $data = [
            ['name' => '10', 'code' => '10A'],
            ['name' => '11', 'code' => '11A'],
            ['name' => '12', 'code' => '12A'], 
        ];

        DB::table('class_types')->insert($data);

    }
}
