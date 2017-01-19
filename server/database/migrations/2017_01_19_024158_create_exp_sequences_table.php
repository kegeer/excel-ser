<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_sequences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meta_id')->nullable();
            $table->string('library_num')->nullable();
            $table->string('qubit')->nullable();
            $table->string('index1')->nullable();
            $table->string('index2')->nullable();
            $table->string('fragment_size')->nullable();
            $table->string('m_c')->nullable();
            $table->string('sample_v')->nullable();
            $table->string('water')->nullable();
            $table->string('data')->nullable();
            $table->string('ratio')->nullable();
            $table->string('mix_v')->nullable();
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
        Schema::dropIfExists('exp_sequences');
    }
}
