<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('mdname')->comment('门店');
            $table->string('model')->comment('型号');
            $table->integer('quyu_id')->default('0')->comment('区域id');
            $table->integer('qudao_id')->default('0')->comment('渠道id');
            $table->integer('price')->default('0')->comment('零售价');
            $table->integer('hdamount')->default('0')->comment('直降金额');
            $table->integer('amount')->comment('卖价');
            $table->string('image')->default('')->comment('图片地址');
            $table->date('date')->comment('销售日期');
            $table->tinyInteger('arbitrary')->default('0')->comment('是否乱价 乱价1');
            $table->tinyInteger('state')->default('0')->comment('是否完成');
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
        Schema::dropIfExists('sales');
    }
}
