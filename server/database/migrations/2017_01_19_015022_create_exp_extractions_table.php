<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpExtractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_extractions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meta_id')->nullable();
            $table->string('py_num')->nullable();
            $table->string('sample_type')->nullable();
            $table->string('pipeline')->nullable();
            $table->float('c')->nullable();
            $table->float('v')->nullable();
            $table->float('total')->nullable();
            $table->string('elec_result')->nullable();
            $table->string('exp_batch')->nullable();
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
        Schema::dropIfExists('exp_extractions');
    }
}
