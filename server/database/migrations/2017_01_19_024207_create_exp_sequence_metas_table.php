<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpSequenceMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_sequence_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('operator')->nullable();
            $table->timestamp('operate_time')->nullable();
            $table->string('run_regent')->nullable();
            $table->string('sample_sheet')->nullable();
            $table->string('phix_ratio')->nullable();
            $table->string('run_c')->nullable();
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
        Schema::dropIfExists('exp_sequence_metas');
    }
}
