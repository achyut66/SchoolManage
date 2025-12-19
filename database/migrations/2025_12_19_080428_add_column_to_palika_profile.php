<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPalikaProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('palika_profiles', function (Blueprint $table) {
            //
            $table->string('schoolname',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('palika_profiles', function (Blueprint $table) {
            //
            $table->dropColumn('schoolname');
        });
    }
}
