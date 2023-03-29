<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // ['title' => 'accountant',   'name' => 'Student',     'level' => 5],
            ['title' => 'parent',       'name' => 'Phụ huynh',      'level' => 4],
            ['title' => 'teacher',      'name' => 'Giáo viên',      'level' => 3],
            ['title' => 'admin',        'name' => 'Ban giám hiệu',  'level' => 2],
            ['title' => 'super_admin',  'name' => 'Admin',          'level' => 1],
           // ['title' => 'librarian',  'name' => 'librarian',      'level' => 6],
        ];
        DB::table('user_types')->insert($data);
    }
}
