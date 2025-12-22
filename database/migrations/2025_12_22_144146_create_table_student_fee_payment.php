<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStudentFeePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_student_fee_payment', function (Blueprint $table) {
            $table->id();
            $table->string('student_id',255);
            $table->string('school_id',255);
            $table->string('academic_year',255);
            $table->string('grade',255);
            $table->string('payment_from_date',255);
            $table->string('payment_to_date',255);
            $table->string('admission_date',255);
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
        Schema::dropIfExists('table_student_fee_payment');
    }
}
