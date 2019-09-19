<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('id_card')->unique();
            $table->string('address',255);
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('postal_code',10);
            $table->string('tel');
            $table->string('phone');
            $table->string('email')->unique();
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
        Schema::dropIfExists('clients')->dropForeign(['user_id']);
    }
}
