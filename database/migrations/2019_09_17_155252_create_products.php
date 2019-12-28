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
            $table->string('code','20');
            $table->string('name');
            $table->string('staff_id',10);
            $table->string('product_type_id',10);
            $table->integer('number_of_pax');
            $table->integer('duration_days')->nullable()->default(1);
            $table->integer('duration_nights')->nullable()->default(1);
            $table->text('overview')->nullable();
            $table->text('includes')->nullable();
            $table->text('excludes')->nullable();
            $table->text('conditions')->nullable();
            $table->text('itinerary')->nullable();
            $table->text('remark')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id',10);
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_end')->nullable();
            $table->string('period_id',10)->nullable();
            $table->string('staff_id',10);
            $table->double('cost_adult')->nullable()->default(0);
            $table->double('cost_child')->nullable()->default(0);
            $table->double('cost_infant')->nullable()->default(0);
            $table->double('public_adult')->nullable()->default(0);
            $table->double('public_child')->nullable()->default(0);
            $table->double('public_infant')->nullable()->default(0);
            $table->text('remark')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('periods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id',10);
            $table->string('price_id',10)->nullable();
            $table->string('staff_id',10);
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->boolean('sun')->nullable()->default(0);
            $table->boolean('mon')->nullable()->default(0);
            $table->boolean('tue')->nullable()->default(0);
            $table->boolean('wed')->nullable()->default(0);
            $table->boolean('thu')->nullable()->default(0);
            $table->boolean('fri')->nullable()->default(0);
            $table->boolean('sat')->nullable()->default(0);
            $table->text('remark')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('highlights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('icon')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('product_many_highlights', function (Blueprint $table) {
            $table->string('highlight_id',10);
            $table->string('product_id',10);
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
        Schema::dropIfExists('product_many_highlights');
        Schema::dropIfExists('highlights');
        Schema::dropIfExists('periods');
        Schema::dropIfExists('prices');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_types');
    }
}
