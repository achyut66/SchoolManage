<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSettingsTeachersSalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_settings_teachers_salary', function (Blueprint $table) {
            $table->id();
            $table->string('grade_id',255);
            $table->string('allowance_type',255);
            $table->string('allowance_amount',255);
            $table->string('academic_year',255);
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
        Schema::dropIfExists('table_settings_teachers_salary');
    }
}
