<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname',30)->comment('昵称');
            $table->string('content',255)->comment('内容');
            $table->string('type',6)->comment('类型：qq/wechat/mobile/email');
            $table->string('contact',30)->index()->comment('联系方式');
            $table->string('ip',15)->comment('IP地址');
            $table->string('remark',255)->nullable()->comment('备注');
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
        Schema::dropIfExists('message');
    }
}
