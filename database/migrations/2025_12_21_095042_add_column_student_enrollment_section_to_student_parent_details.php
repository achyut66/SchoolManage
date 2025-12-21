<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStudentEnrollmentSectionToStudentParentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students_parents_details', function (Blueprint $table) {
            //
            $table->string('student_enrollment_section',255);
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
            //
            $table->dropColumn('student_enrollment_section');
        });
    }
}
