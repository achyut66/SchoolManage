<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTeachersPersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers_personal_details', function (Blueprint $table) {
            $table->string('is_class_teacher',255);
            $table->string('teaching_grade',255);
            $table->string('teaching_subject',255)->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers_personal_details', function (Blueprint $table) {
            $table->dropColumn([
                'is_class_teacher',
                'teaching_grade',
                'teaching_subject'
            ]);
        });
    }
}
