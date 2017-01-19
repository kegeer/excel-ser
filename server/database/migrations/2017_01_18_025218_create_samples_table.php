<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ori_num')->nullable();
            $table->string('py_num')->nullable();
            $table->string('sample_type')->nullable();
            $table->string('sample_amount')->nullable();
            $table->string('sender')->nullable();
            $table->string('sender_contact')->nullable();
            $table->string('send_time')->nullable();
            $table->string('receive_status')->nullable();
            $table->string('sample_status')->nullable();
            $table->string('express_num')->nullable();
            $table->string('receive_time')->nullable();
            $table->string('recipient')->nullable();
            $table->string('store_location')->nullable();
            $table->string('sample_batch')->nullable();
            $table->string('project')->nullable();
            $table->string('pipeline')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('samples');
    }
}
