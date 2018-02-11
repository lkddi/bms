<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQudaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qudaos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('qdname')->comment('渠道名称');
            $table->integer('quyu_id')->default('0')->comment('区域id');
            $table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('qudaos');
    }
}
