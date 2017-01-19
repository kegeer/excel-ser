<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpDistributionMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_distribution_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sample_source')->nullable();
            $table->string('sample_plate_num')->nullable();
            $table->string('serial_num')->nullable();
            $table->string('pipeline')->nullable();
            $table->timestamp('operate_time')->nullable();
            $table->string('lister')->nullable();
            $table->string('sample_add_operator')->nullable();
            $table->string('sample_add_auditor')->nullable();
            $table->string('pcr_cycle')->nullable();
            $table->string('combine_transfer_operator')->nullable();
            $table->string('combine_transfer_autitor')->nullable();
            $table->string('note')->nullable();
            $table->string('elec_operator')->nullable();
            $table->string('elec_name')->nullable();
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
        Schema::dropIfExists('exp_distribution_metas');
    }
}
