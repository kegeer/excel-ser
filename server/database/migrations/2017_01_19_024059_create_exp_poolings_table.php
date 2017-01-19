<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpPoolingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_poolings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meta_id')->nullable();
            $table->string('library_name')->nullable();
            $table->string('py_num')->nullable();
            $table->string('primer')->nullable();
            $table->float('c')->nullable();
            $table->integer('cycle')->nullable();
            $table->float('sample_v')->nullable();
            $table->float('sample_m')->nullable();
            $table->string('exp_batch')->nullable();
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
        Schema::dropIfExists('exp_poolings');
    }
}
