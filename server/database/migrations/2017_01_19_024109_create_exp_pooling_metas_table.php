<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpPoolingMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_pooling_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sample_amount')->nullable();
            $table->string('theoretic_c')->nullable();
            $table->string('operator')->nullable();
            $table->timestamp('operate_time')->nullable();
            $table->string('actual_c')->nullable();
            $table->string('sample_v')->nullable();
            $table->string('mb_v')->nullable();
            $table->string('after_c_c')->nullable();
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
        Schema::dropIfExists('exp_pooling_metas');
    }
}
