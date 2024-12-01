<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->string('size');
            $table->unsignedBigInteger('page_number');
            $table->string('img');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('amount')->default(0);
            $table->unsignedBigInteger('sale');
            $table->text('content');
            $table->unsignedBigInteger('is_highlight');
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
        Schema::dropIfExists('books');
    }
}
