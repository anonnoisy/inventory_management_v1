<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_parent_id');
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('number_id');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('postcode');
            $table->string('image')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->foreign('user_parent_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
