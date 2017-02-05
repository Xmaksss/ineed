<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link');
            $table->string('image');
            $table->integer('sort')->nullable();
	    
	    $table->string('title_en');
	    $table->string('sub_title_en');
	    $table->string('button_en');
	    $table->string('title_ru');
	    $table->string('sub_title_ru');
	    $table->string('button_ru');

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
        Schema::dropIfExists('sliders');
    }
}
