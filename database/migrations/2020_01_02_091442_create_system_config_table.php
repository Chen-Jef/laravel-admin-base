<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->default('');
            $table->string('group',30)->default('');
            $table->string('title',100)->default('');
            $table->string('tip',100)->default('');
            $table->string('type',30)->default('');
            $table->text('value');
            $table->text('content');
            $table->string('rule',30)->default('');
            $table->string('extend',255)->default('');
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
        Schema::dropIfExists('system_config');
    }
}
