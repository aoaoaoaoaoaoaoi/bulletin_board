<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserThreadReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_thread_reactions', function (Blueprint $table) {
            $table->bigInteger('user_id')->comment('ユーザーID');
            $table->bigInteger('thread_id')->comment('スレッドID');
            $table->integer('reaction_type')->comment('リアクションタイプ');
            $table->unique(['user_id', 'thread_id', 'reaction_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_thread_reactions');
    }
}
