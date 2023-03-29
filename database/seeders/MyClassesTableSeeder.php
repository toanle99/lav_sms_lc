<?php
namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MyClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my_classes')->delete();
        $ct = ClassType::pluck('id')->all();

        $data = [
            ['name' => '10 A1', 'class_type_id' => $ct[0]],
            ['name' => '10 A2', 'class_type_id' => $ct[0]], 

            ['name' => '11 A1', 'class_type_id' => $ct[1]],
            ['name' => '11 A2', 'class_type_id' => $ct[1]], 
            
            ['name' => '12 A1', 'class_type_id' => $ct[2]], 
        ];

        DB::table('my_classes')->insert($data);

    }
}
