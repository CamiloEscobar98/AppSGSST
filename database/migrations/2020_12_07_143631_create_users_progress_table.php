<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_progress', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('topic_id');
            $table->boolean('completed')->default(0);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::table('users_progress', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_users_progress')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('topic_id', 'fk_topics_progress')->references('id')->on('topics')->cascadeOnUpdate()->onDelete('restrict');
            $table->unique(['user_id', 'topic_id'], 'unique_users_progress');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_progress');
        Schema::table('users_progress', function (Blueprint $table) {
            $table->dropForeign('fk_users_progress');
            $table->dropForeign('fk_topics_progress');
            $table->dropUnique('unique_users_progress');
        });
    }
}
