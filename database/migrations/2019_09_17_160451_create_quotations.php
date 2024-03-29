<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('staff_id')->nullable();
            $table->string('client_id');
            $table->dateTime('quo_date')->nullable();
            $table->double('total')->nullable()->default(0);
            $table->integer('discount_per')->nullable()->default(0);
            $table->double('discount_price')->nullable()->default(0);
            $table->double('vat')->nullable()->default(0);
            $table->double('net')->nullable()->default(0);
            $table->text('remark')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('quotation_details', function (Blueprint $table) {
            $table->string('quo_id');
            $table->string('product_id');
            $table->string('price_id');
            $table->string('period_id');
            $table->dateTime('book_date')->nullable(); //Client date use tour
            $table->integer('unit_adult')->nullable()->default(0);
            $table->integer('unit_child')->nullable()->default(0);
            $table->integer('unit_infant')->nullable()->default(0);
            $table->double('public_adult')->nullable()->default(0);
            $table->double('public_child')->nullable()->default(0);
            $table->double('public_infant')->nullable()->default(0);
            $table->double('discount')->nullable()->default(0);
            $table->integer('vat')->nullable()->default(0);
            $table->double('total')->nullable()->default(0);
            $table->double('net')->nullable()->default(0);
            $table->text('remark')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('pickups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quo_id');
            $table->string('product_id');
            $table->string('client_id');
            $table->string('address');
            $table->string('tel')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quo_id');
            $table->string('product_id');
            $table->string('client_id');
            $table->string('address');
            $table->string('payment_id');
            $table->string('gateway');
            $table->string('pay_date');
            $table->text('remark')->nullable();
            $table->string('status')->nullable()->default(0);
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
        Schema::dropIfExists('payments');
        Schema::dropIfExists('pickups');
        Schema::dropIfExists('quotation_details');
        Schema::dropIfExists('quotations');
    }
}
