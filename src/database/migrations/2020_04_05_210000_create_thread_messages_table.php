<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thread_messages', function (Blueprint $table) {
            $table->bigInteger('thread_id');
            $table->integer('thread_order');
            $table->bigInteger('user_id')->unsigned();
            $table->text('message');
            $table->dateTime('posted_time');

            $table->foreign('thread_id')->references('id')->on('threads');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unique(['thread_id', 'thread_order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thread_messages');
    }
}
