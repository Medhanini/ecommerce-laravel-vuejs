<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Biginteger('products_id')->unsigned()->index();
            $table->Biginteger('product_variation_types_id')->unsigned()->index();
            $table->string('name');
            $table->timestamps();

            
            $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_variation_types_id')->references('id')->on('product_variation_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
}
