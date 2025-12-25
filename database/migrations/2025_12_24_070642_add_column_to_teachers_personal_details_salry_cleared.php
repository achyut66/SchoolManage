<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTeachersPersonalDetailsSalryCleared extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers_personal_details', function (Blueprint $table) {
            //
            $table->string('salary_cleared',255);
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
            //
            $table->dropColumn('salary_cleared');
        });
    }
}
