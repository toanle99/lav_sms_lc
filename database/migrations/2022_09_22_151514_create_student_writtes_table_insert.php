<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentWrittesTableInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //     Schema::table('student_writtes', function($table) {
    //         $table->unsignedInteger('accept_by')->nullable();
    //         $table->unsignedInteger('deny_by')->nullable();
    //     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('student_writtes', function($table) {
        //     $table->dropColumn('accept_by');
        //     $table->dropColumn('deny_by');
        // });
    }
}
