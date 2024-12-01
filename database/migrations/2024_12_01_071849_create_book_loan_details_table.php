<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookLoanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_loan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('book_loan_id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('sale');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('discount');
            $table->unsignedBigInteger('total_money');
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
        Schema::dropIfExists('book_loan_details');
    }
}
