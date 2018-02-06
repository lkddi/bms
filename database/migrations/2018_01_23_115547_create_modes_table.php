<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modes', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('model')->comment('型号');
            $table->string('jmodel')->comment('型号简称');
            $table->integer('price')->comment('零售价');
            $table->tinyInteger('state')->default('0')->comment('状态 下线1 正常0');
            $table->timestamps();
            $table->unique('id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modes');
    }
}
