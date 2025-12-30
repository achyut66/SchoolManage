<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableScheduleExamsSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_schedule_exams_setting', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('table_exam_name_settings');
            $table->string('academic_year',255);
            $table->string('exam_start_date',255);
            $table->string('exam_end_date',255);
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
        Schema::dropIfExists('table_schedule_exams_setting');
    }
}
