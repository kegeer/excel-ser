<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_libraries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('method')->nullable();
            $table->string('operator')->nullable();
            $table->string('operate_time')->nullable();
            $table->string('project')->nullable();
            $table->string('pre_v')->nullable();
            $table->string('pre_c')->nullable();
            $table->string('after_index')->nullable();
            $table->string('after_v')->nullable();
            $table->string('after_c')->nullable();
            $table->string('after_elec')->nullable();
            $table->string('after_size')->nullable();
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
        Schema::dropIfExists('exp_libraries');
    }
}
