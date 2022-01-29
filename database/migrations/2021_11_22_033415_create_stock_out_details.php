<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out_details', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_out_id');
            $table->integer('product_id');
            $table->integer('qty');
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('stock_out_details');
    }
}
