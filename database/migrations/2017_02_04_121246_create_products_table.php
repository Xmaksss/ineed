<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('slug');
            $table->integer('price');
            $table->integer('price_new')->default(0);
            $table->tinyInteger('public')->default(0);
	    
            $table->string('image_main');
            $table->string('image_1');
            $table->string('image_2');
            $table->string('image_3');
            $table->string('image_4');
            $table->string('image_5');
            $table->string('image_6');
	    
	    $table->integer('size_id');
	    $table->integer('material_id');
	    $table->integer('type_id')->default(0);
	    $table->integer('color_id');
	    $table->integer('body_id');
	    $table->integer('border_id')->default(0);

	    $table->string('title_en');
	    $table->text('description_en');
	    $table->string('title_ru');
	    $table->text('description_ru');

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
        Schema::dropIfExists('products');
    }
}
