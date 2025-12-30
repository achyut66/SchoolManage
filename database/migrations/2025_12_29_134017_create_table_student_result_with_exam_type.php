<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStudentResultWithExamType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_student_result_with_exam_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students_parents_details');
            $table->string('academic_year',255);
            $table->foreignId('exam_type_id')->constrained('table_schedule_exams_setting');
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
        Schema::dropIfExists('table_student_result_with_exam_type');
    }
}
