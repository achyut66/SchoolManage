<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTeacherOnLeave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_teacher_on_leave', function (Blueprint $table) {
            $table->id();
            $table->string('teachers_id',255);
            $table->string('leave_from',255);
            $table->string('leave_to',255);
            $table->string('reason',255);
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
        Schema::dropIfExists('table_teacher_on_leave');
    }
}
