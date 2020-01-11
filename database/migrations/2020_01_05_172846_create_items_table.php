<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_parent_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('name');
            $table->string('code_name');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedMediumInteger('quantity');
            $table->string('image')->nullable();
            $table->string('active');
            $table->timestamps();

            $table->foreign('user_parent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
