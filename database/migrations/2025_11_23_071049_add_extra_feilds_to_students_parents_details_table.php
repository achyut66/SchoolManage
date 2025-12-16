<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFeildsToStudentsParentsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students_parents_details', function (Blueprint $table) {
            $table->string('s_caste',255);
            $table->string('s_religion',255);
            $table->string('s_gender',255);
            $table->string('s_birthplace',255);
            $table->string('s_bccopy',255);
            $table->string('s_province',255);
            $table->string('s_district',255);
            $table->string('s_municipality',255);
            $table->string('s_ward',255);
            $table->string('s_tol',255);
            $table->string('s_gf_name',255);
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
        Schema::table('students_parents_details', function (Blueprint $table) {
            //
        });
    }
}
