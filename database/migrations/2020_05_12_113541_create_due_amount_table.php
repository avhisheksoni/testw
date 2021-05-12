<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDueAmountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('due_amount', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id');
            $table->foreign('company_id')->references('id')->on('company_mast');
            $table->string('tender_no',30);
            $table->date('tender_date');
            $table->string('name_of_work',50);
            $table->double('tender_emd_fdr',20,2);
            $table->double('maturity_amount',20,2);
            $table->date('date_of_fdr');
            $table->string('fdr_interest_rate',10);
            $table->string('place',50);
            $table->string('division',50);
            $table->double('value_of_work',20,2);
            $table->string('acceptance_letter_no',30);
            $table->string('accepted_rate',30);
            $table->string('period_of_contract',30);
            $table->string('bg_no',20);
            $table->date('bg_expiry_date');
            $table->string('bg_fdr_no',30);
            $table->date('bg_fdr_date');
            $table->double('bg_fdr_amount',20,2);
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
        Schema::dropIfExists('due_amount');
    }
}
