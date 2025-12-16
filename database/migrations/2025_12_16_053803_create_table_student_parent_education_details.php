<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStudentParentEducationDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_student_parent_education_details', function (Blueprint $table) {
            $table->id();
            // FOREIGN KEY
            $table->foreignId('student_id')
                  ->constrained('students_parents_details')
                  ->onDelete('cascade');
                  
            $table->string('prev_school_name',255)->nullable();
            $table->string('prev_school_address',255)->nullable();
            $table->string('prev_school_left_grade',255)->nullable();
            $table->string('prev_school_obtained_percentage',255)->nullable();
            $table->string('prev_school_left_certificate',255)->nullable();
            // $table->string('slc_passed_year',255)->nullable();
            // $table->string('slc_school_name',255)->nullable();
            // $table->string('slc_percent',255)->nullable();
            // $table->string('slc_pass_marks',255)->nullable();
            // $table->string('slc_major_subject',255)->nullable();
            // $table->string('slc_certificate_upload',255)->nullable();
            // $table->string('slc_marksheet_upload',255)->nullable();
            // $table->string('plustwo_passed_year',255)->nullable();
            // $table->string('plustwo_school_name',255)->nullable();
            // $table->string('plustwo_school_address',255)->nullable();
            // $table->string('plustwo_faculty',255)->nullable();
            // $table->string('plustwo_percentage',255)->nullable();
            // $table->string('plustwo_pass_marks',255)->nullable();
            // $table->string('plustwo_certificate_upload',255)->nullable();
            // $table->string('plustwo_marksheet_upload',255)->nullable();
            // $table->string('plustwo_transcript_upload',255)->nullable();
            // $table->string('bachelor_passed_year', 255)->nullable();
            // $table->string('bachelor_school_name', 255)->nullable();
            // $table->string('bachelor_school_address', 255)->nullable();
            // $table->string('bachelor_uuniversity_name', 255)->nullable();
            // $table->string('bachelor_faculty', 255)->nullable();
            // $table->string('bachelor_percentage', 255)->nullable();
            // $table->string('bachelor_pass_marks', 255)->nullable();
            // $table->string('bachelor_major_subject', 255)->nullable();
            // $table->string('bachelor_certificate_upload', 255)->nullable();
            // $table->string('bachelor_marksheet_upload', 255)->nullable();
            // $table->string('bachelor_transcript_upload', 255)->nullable();
            // $table->string('bed_passed_year', 255)->nullable();
            // $table->string('bed_school_name', 255)->nullable();
            // $table->string('bed_school_address', 255)->nullable();
            // $table->string('bed_university_name', 255)->nullable();
            // $table->string('bed_faculty', 255)->nullable();
            // $table->string('bed_percentage', 255)->nullable();
            // $table->string('bed_pass_marks', 255)->nullable();
            // $table->string('bed_major_subject', 255)->nullable();
            // $table->string('bed_certificate_upload', 255)->nullable();
            // $table->string('bed_marksheet_upload', 255)->nullable();
            // $table->string('bed_transcript_upload', 255)->nullable();
            // $table->string('masters_passed_year', 255)->nullable();
            // $table->string('masters_school_name', 255)->nullable();
            // $table->string('masters_school_address', 255)->nullable();
            // $table->string('masters_university_name', 255)->nullable();
            // $table->string('masters_percentage', 255)->nullable();
            // $table->string('masters_pass_marks', 255)->nullable();
            // $table->string('masters_major_subject', 255)->nullable();
            // $table->string('masters_certificate_upload', 255)->nullable();
            // $table->string('masters_marksheet_upload', 255)->nullable();
            // $table->string('masters_transcript_upload', 255)->nullable();
            // $table->string('others_certificate_upload', 255)->nullable();
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
        Schema::dropIfExists('table_student_parent_education_details');
    }
}
