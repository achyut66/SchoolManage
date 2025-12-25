<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOtherStaffSalaryPayemnt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_other_staff_salary_payemnt', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id',255);
            $table->string('staff_name',255);
            $table->string('staff_post',255);
            $table->string('staff_salary',255);
            $table->string('paid_from',255);
            $table->string('paid_to',255);
            $table->string('academic_year',255);
            $table->string('total_paid_amount',255);
            $table->string('due_amount',255);
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
        Schema::dropIfExists('table_other_staff_salary_payemnt');
    }
}
