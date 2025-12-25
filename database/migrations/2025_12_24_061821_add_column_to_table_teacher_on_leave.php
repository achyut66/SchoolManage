<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTableTeacherOnLeave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('table_teacher_on_leave', function (Blueprint $table) {
            //
            $table->string('academic_year',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_teacher_on_leave', function (Blueprint $table) {
            //
            $table->dropColumn('academic_year');
        });
    }
}
