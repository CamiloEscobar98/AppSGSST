<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formatos', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->unsignedBigInteger('user_id');
            $table->json('info');
            $table->timestamps();
        });

        Schema::table('formatos', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_user_formato')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formatos', function (Blueprint $table) {
            $table->dropForeign('fk_user_formato');
        });
        Schema::dropIfExists('formatos');
    }
}
