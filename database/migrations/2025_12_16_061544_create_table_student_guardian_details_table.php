<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStudentGuardianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_student_guardian_details', function (Blueprint $table) {
            $table->id();

            // FOREIGN KEY
            $table->foreignId('student_id')
                  ->constrained('students_parents_details')
                  ->onDelete('cascade');

            $table->string('parent_name');
            $table->string('relation_to_student');
            $table->string('contact_no');
            $table->string('address');
            $table->string('occupation');

            $table->string('emergency_contact')->nullable();
            $table->string('medical_condition')->nullable();

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
        Schema::dropIfExists('table_student_guardian_details');
    }
}
