<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpExtractionMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exp_extraction_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('extract_operator')->nullable();
            $table->timestamp('extract_time')->nullable();
            $table->string('purify_operator')->nullable();
            $table->timestamp('purify_time')->nullable();
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
        Schema::dropIfExists('exp_extraction_metas');
    }
}
