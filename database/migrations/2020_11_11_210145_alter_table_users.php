<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('document_id', 'fk_documents_users')->references('id')->on('documents')->cascadeOnUpdate()->onDelete('restrict');
            $table->unique(['phone', 'email', 'document_id'], 'unique_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('fk_documents_users');
            $table->dropUnique('unique_users');
        });
    }
}
