<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreteLostbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lostbooks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('orderdetail_id')->unsigned();
            $table->integer('price')->default(0);
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->foreign('orderdetail_id')->references('id')->on('detail_order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lostbooks');
    }
}
