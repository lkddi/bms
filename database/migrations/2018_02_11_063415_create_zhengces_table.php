<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZhengcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zhengces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jmodel')->comment('型号简称');
            $table->string('model')->comment('型号');
            $table->integer('quyu_id')->default('0')->comment('区域id');
            $table->integer('qudao_id')->default('0')->comment('渠道id');
            $table->integer('hdamount')->default('0')->comment('直降金额');
            $table->integer('year')->comment('卖价');
            $table->integer('month')->comment('卖价');
            $table->tinyInteger('arbitrary')->default('0')->comment('是否乱价 乱价1');
            $table->tinyInteger('state')->default('0')->comment('是否完成');
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
        Schema::dropIfExists('zhengces');
    }
}
