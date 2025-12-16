<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromStudentsParentsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students_parents_details', function (Blueprint $table) {
            $table->dropColumn(['student_prev_school_name','student_prev_school_certificate','student_prev_school_cont_person','student_parents_full_name','student_parents_cont_no','student_parents_email','student_parents_address']);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students_parents_details', function (Blueprint $table) {
            $table->string('student_prev_school_name')->nullable();
            $table->string('student_prev_school_certificate')->nullable();
            $table->string('student_prev_school_cont_person')->nullable();
            $table->string('student_parents_full_name')->nullable();
            $table->string('student_parents_cont_no')->nullable();
            $table->string('student_parents_email')->nullable();
            $table->string('student_parents_address')->nullable();
            //
        });
    }
}
