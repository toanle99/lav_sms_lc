<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WritteTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['level' => 0, 'title' => 'Chờ xử lý'],
            ['level' => 1, 'title' => 'Phụ huynh chấp nhận'],
            ['level' => 2, 'title' => 'Giáo viên chấp nhận'],
            ['level' => 3, 'title' => 'Phụ huynh từ chối'],
            ['level' => 4, 'title' => 'Giáo viên từ chối'],
        ];
        DB::table('writte_types')->insert($data);
    }
}
