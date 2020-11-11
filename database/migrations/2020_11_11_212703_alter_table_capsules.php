<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCapsules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('capsules', function (Blueprint $table) {
            $table->foreign('topic_id', 'fk_topics_capsules')->references('id')->on('topics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique(['topic_id', 'title'], 'unique_capsules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('capsules', function (Blueprint $table) {
            $table->dropForeign('fk_topics_capsules');
            $table->dropUnique('unique_capsules');
        });
    }
}
