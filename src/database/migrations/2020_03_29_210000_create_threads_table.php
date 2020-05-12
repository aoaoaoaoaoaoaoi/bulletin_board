<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('created_user_id')->unsigned();
            $table->bigInteger('group_id')->unsigned();
            $table->string('title');
            $table->text('overview');
            $table->dateTime('end_at')->nullable();

            $table->foreign('created_user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
