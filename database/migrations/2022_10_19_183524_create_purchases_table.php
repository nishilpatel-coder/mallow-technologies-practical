<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('customer_email');
            $table->text('bill_no');
            $table->float('total_price', 8, 2);
            $table->float('total_tax', 8, 2);
            $table->float('net_price', 8, 2);
            $table->float('paid_by_customer', 8, 2);
            $table->float('payable_to_customer', 8, 2);
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
        Schema::dropIfExists('purchases');
    }
}
