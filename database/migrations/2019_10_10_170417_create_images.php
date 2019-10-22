<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('src');
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->string('alt')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('product_many_images', function (Blueprint $table) {
            $table->string('images_id');
            $table->string('product_id');
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
        Schema::dropIfExists('product_many_images');
        Schema::dropIfExists('images');
    }
}
