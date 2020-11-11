<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->foreign('topic_id', 'fk_topics_games')->references('id')->on('topics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique(['topic_id', 'title'], 'unique_games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign('fk_topics_games');
            $table->dropUnique('unique_games');
        });
    }
}
