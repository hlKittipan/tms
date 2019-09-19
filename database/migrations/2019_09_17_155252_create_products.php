<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('staff_id');
            $table->integer('number_of_pax');
            $table->integer('duration_days')->nullable()->default(1);
            $table->integer('duration_nights')->nullable()->default(1);
            $table->text('includes');
            $table->text('excludes');
            $table->text('conditions');
            $table->text('itinerary');
            $table->text('remark');
            $table->string('status')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id');
            $table->string('staff_id');
            $table->double('adult')->nullable()->default(0);
            $table->double('child')->nullable()->default(0);
            $table->double('infra')->nullable()->default(0);
            $table->text('remark');
            $table->string('status')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('periods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id');
            $table->string('price_id');
            $table->string('staff_id');
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->boolean('sun')->nullable()->default(0);
            $table->boolean('mon')->nullable()->default(0);
            $table->boolean('tue')->nullable()->default(0);
            $table->boolean('wed')->nullable()->default(0);
            $table->boolean('thu')->nullable()->default(0);
            $table->boolean('fri')->nullable()->default(0);
            $table->boolean('sat')->nullable()->default(0);
            $table->text('remark');
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
        Schema::dropIfExists('periods');
        Schema::dropIfExists('prices');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_types');
    }
}
