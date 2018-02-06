<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMendiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mendians', function (Blueprint $table) {
            $table->increments('id')->comment('门店ID');
            $table->string('mdname')->comment('门店名称');
            $table->string('mdpy')->default('')->comment('门店简称');
            $table->string('quyu_id')->default('')->comment('区域ID');
            $table->string('qudao_id')->default('')->comment('区域ID');
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
        Schema::dropIfExists('mendians');
    }
}
