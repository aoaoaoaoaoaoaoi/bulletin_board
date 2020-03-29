<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thread_tags', function (Blueprint $table) {
            $table->bigInteger('thread_id');
            $table->bigInteger('tag_id');

            $table->unique(['thread_id', 'tag_id']);
            
            $table->foreign('thread_id')->references('id')->on('threads');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thread_tags');
    }
}
