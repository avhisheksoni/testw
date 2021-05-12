<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuaranteeRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guarantee_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bg_type');
            $table->integer('bg_code');
            $table->integer('bank_code');
            $table->string('amended_from_bg_code',20);
            $table->string('amended_from_bg_no',20);
            $table->integer('bg_no');
            $table->date('bg_date');
            $table->string('application_no',20);
            $table->text('application_note');
            $table->text('bg_note');
            $table->string('job_code',20);
            $table->string('job_name',20);
            $table->integer('beneficiary_id');
            $table->text('beneficiary_address');
            $table->double('bg_value',20,2);
            $table->double('exchange_rate',20,2);
            $table->date('expiry_date');
            $table->date('claim_expiry_date');
            $table->text('file');
            $table->string('new_field1',20);
            $table->string('new_field2',20);
            $table->string('new_field3',20);
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
        Schema::dropIfExists('guarantee_request');
    }
}
