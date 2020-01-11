<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_parent_id');
            $table->string('vendor_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('mobile');
            $table->string('address');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
