<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIntoTableAddStudentsResultExaType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('table_add_students_result', function (Blueprint $table) {
            $table->string('exam_type_id',255);
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
        Schema::table('table_add_students_result', function (Blueprint $table) {
            $table->dropColumn('exam_type_id');
            //
        });
    }
}
