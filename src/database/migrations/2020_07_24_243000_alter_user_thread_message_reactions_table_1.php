<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserThreadMessageReactionsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_thread_message_reactions', function (Blueprint $table) {
            $table->renameColumn('thread_id', 'thread_message_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_thread_message_reactions', function (Blueprint $table) {
            $table->renameColumn('thread_message_id', 'thread_id');
        });
    }
}
