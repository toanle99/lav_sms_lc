<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentWrittesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_writtes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_record_id');
            $table->unsignedInteger('accept_by')->nullable();
            $table->unsignedInteger('deny_by')->nullable();
            $table->string('reason'); // li do
            $table->tinyInteger('status')->nullable()->default(0); // trang thai=-> 0: cho xu ly, 1: duoc duyet, 2: tu choi 
            $table->date('date_at');
            $table->string('session_time')->nullable(); // thoi gian xin nghi =->  ca ngay, sang, chieu, toi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_writtes');
    }
}
