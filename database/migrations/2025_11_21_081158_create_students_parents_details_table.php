<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsParentsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_parents_details', function (Blueprint $table) {
            $table->id();
            $table->string('student_full_name',255);
            $table->string('student_address',255);
            $table->string('student_fathers_name',255);
            $table->string('student_mothers_name',255);
            $table->string('student_dob',255);
            $table->string('student_contact',255);
            $table->string('student_email',255);
            $table->string('student_enrollment_class',255);

            $table->string('student_prev_school_name',255);
            $table->string('student_prev_school_certificate',255);
            $table->string('student_prev_school_cont_person',255);

            $table->string('student_parents_full_name',255);
            $table->string('student_parents_cont_no',255);
            $table->string('student_parents_email',255);
            $table->string('student_parents_address',255);
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
        Schema::dropIfExists('students_parents_details');
    }
}
