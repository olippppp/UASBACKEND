<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("no_order");
            $table->foreignId('meja_id')->nullable()->constrained('meja');
            $table->foreignId('customer_id')->constrained('customers');
            $table->dateTime("tgl_pemesanan")->nullable();
            $table->dateTime("tgl_pembayaran")->nullable();
            $table->integer("total");
            $table->integer("status");
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
        Schema::dropIfExists('orders');
    }
}
