<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterThreadsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('threads', function (Blueprint $table) {

            $table->dropForeign('threads_created_user_id_foreign');
            $table->dropColumn('created_user_id');
            $table->dropColumn('overview');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('threads', function (Blueprint $table) {
        
            $table->foreign('created_user_id')->references('id')->on('users');
            $table->bigInteger('created_user_id')->unsigned();
            $table->text('overview');
        });
    }
}
