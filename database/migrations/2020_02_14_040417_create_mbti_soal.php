<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMbtiSoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbti_soal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('groupdimensi',255)->nullable();
            $table->string('pernyataanA',255)->nullable();
            $table->string('dimensiA',10)->nullable();
            $table->string('pernyataanB',255)->nullable();
            $table->string('dimensiB',10)->nullable();
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
        Schema::dropIfExists('mbti_soal');
    }
}
