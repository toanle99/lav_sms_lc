<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Qs;
use Illuminate\Support\Str;

class UsersTableSeeder2 extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->delete();

        $this->createNewUsers();
        // $this->createManyUsers( 3);
    }

    protected function createNewUsers()
    {
        $password = Hash::make('cj'); // Default user password
        $d = Array();
        for($i=0;$i<5;$i++) {
            $data = [
                'name' => 'Thầy An '.$i,
                'email' => 'teacher'.$i.'@teacher.com',
                'user_type' => 'teacher',
                'username' => 'teacher'.$i,
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'remember_token' => Str::random(10),
            ];
            array_push($d, $data);
            $data = [
                'name' => 'Bố An '.$i,
                'email' => 'parent'.$i.'@parent.com',
                'user_type' => 'parent',
                'username' => 'parent'.$i,
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'remember_token' => Str::random(10),
            ];
            array_push($d, $data);
        }
        
        DB::table('users')->insert($d);
    }

    protected function createManyUsers(int $count)
    {
        $data = [];
        // $user_type = Qs::getAllUserTypes(['super_admin', 'librarian', 'student']);

        // for($i = 1; $i <= $count; $i++){

        //     foreach ($user_type as $k => $ut){

        //         $data[] = [
        //             'name' => ucfirst($user_type[$k]).' '.$i,
        //             'email' => $user_type[$k].$i.'@'.$user_type[$k].'.com',
        //             'user_type' => $user_type[$k],
        //             'username' => $user_type[$k].$i,
        //             'password' => Hash::make($user_type[$k]),
        //             'code' => strtoupper(Str::random(10)),
        //             'remember_token' => Str::random(10),
        //         ];

        //     }

        // }

        DB::table('users')->insert($data);
    }
}
