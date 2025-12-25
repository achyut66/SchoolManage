<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOtherStaffsDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_other_staffs_details', function (Blueprint $table) {
            $table->id();
            $table->string('full_name',255);
            $table->string('address',255);
            $table->string('contact_no',255);
            $table->string('email',255);
            $table->string('post',255);
            $table->string('salary',255);
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
        Schema::dropIfExists('table_other_staffs_details');
    }
}
