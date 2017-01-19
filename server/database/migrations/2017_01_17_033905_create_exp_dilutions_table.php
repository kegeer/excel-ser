<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpDilutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_dilutions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meta_id')->nullable();
            $table->string('sample_id')->nullable();
            $table->string('pipeline')->nullable();
            $table->float('ori_c')->nullable();
            $table->float('sample_v')->nullable();
            $table->float('water')->nullable();
            $table->float('end_c')->nullable();
            $table->float('product_c')->nullable();
            $table->string('exp_bacth')->nullable();
            $table->string('project')->nullable();
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
        Schema::dropIfExists('exp_dilutions');
    }
}
