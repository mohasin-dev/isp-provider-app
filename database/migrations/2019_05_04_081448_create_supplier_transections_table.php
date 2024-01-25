<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTransectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_transections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('supplier_id');
            $table->string('invoice_id')->unique();
            $table->integer('total_cost');
            $table->integer('amount_paid');
            $table->foreign('supplier_id')->references('id')->on('supliers');
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
        Schema::dropIfExists('supplier_transections');
    }
}
