<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAddStudentsResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_add_students_result', function (Blueprint $table) {
            $table->id();
            $table->string('student_id',255);
            $table->string('school_id',255);
            $table->string('student_name',255);
            $table->string('academic_year',255);
            $table->string('grade',255);
            $table->string('subjects',255);
            $table->string('obtained_marks',255);
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
        Schema::dropIfExists('table_add_students_result');
    }
}
