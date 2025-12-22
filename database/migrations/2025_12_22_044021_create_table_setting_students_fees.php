<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSettingStudentsFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_setting_students_fees', function (Blueprint $table) {
            $table->id();
            $table->string('grade_id',255);
            $table->string('fee_name',255);
            $table->string('fee_amount',255);
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
        Schema::dropIfExists('table_setting_students_fees');
    }
}
