<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\StudentRecord;

class StudentWrittesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = StudentRecord::pluck('id')->all();
        foreach ($students as $student){
            $data = [
                [
                    'student_record_id' => $student, 
                    'reason' => 'Giấy xin phép giáo viên từ chối',
                    'status' => 4, 
                    'date_at' => date('Y-m-d', strtotime("- 2 day")),
                    'session_time' => 'Cả ngày',  
                ],
                [
                    'student_record_id' => $student, 
                    'reason' => 'Giấy xin phép phụ huynh từ chối',
                    'status' => 3, 
                    'date_at' => date('Y-m-d', strtotime("- 1 day")),
                    'session_time' => 'Cả ngày',  
                ],
                [
                    'student_record_id' => $student, 
                    'reason' => 'Giấy xin phép giáo viên phê duyệt',
                    'status' => 2, 
                    'date_at' => date('Y-m-d'),
                    'session_time' => 'Cả ngày',  
                ],
                [
                    'student_record_id' => $student, 
                    'reason' => 'Giấy xin phép phụ huynh phê duyệt',
                    'status' => 1, 
                    'date_at' => date('Y-m-d', strtotime("+ 1 day")),
                    'session_time' => 'Buổi chiều',  
                ],
                [
                    'student_record_id' => $student, 
                    'reason' => 'Giấy xin phép vừa tạo',
                    'status' => 0, 
                    'date_at' => date('Y-m-d', strtotime("+ 2 day")),
                    'session_time' => 'Buổi sáng',  
                ],
                [
                    'student_record_id' => $student, 
                    'reason' => 'Giấy xin phép phụ huynh phê duyệt',
                    'status' => 1, 
                    'date_at' => date('Y-m-d', strtotime("+ 3 day")),
                    'session_time' => 'Buổi chiều',  
                ],
                [
                    'student_record_id' => $student, 
                    'reason' => 'Giấy xin phép vừa tạo',
                    'status' => 0, 
                    'date_at' => date('Y-m-d', strtotime("+ 4 day")),
                    'session_time' => 'Buổi sáng',  
                ],
                [
                    'student_record_id' => $student, 
                    'reason' => 'Giấy xin phép phụ huynh phê duyệt',
                    'status' => 1, 
                    'date_at' => date('Y-m-d', strtotime("+ 5 day")),
                    'session_time' => 'Buổi chiều',  
                ],
                [
                    'student_record_id' => $student, 
                    'reason' => 'Giấy xin phép vừa tạo',
                    'status' => 0, 
                    'date_at' => date('Y-m-d', strtotime("+ 6 day")),
                    'session_time' => 'Buổi sáng',  
                ],
            ];
            DB::table('student_writtes')->insert($data);
        } 
    }
}
