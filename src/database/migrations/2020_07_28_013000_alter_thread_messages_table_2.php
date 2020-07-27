<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterThreadMessagesTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thread_messages', function (Blueprint $table) {
            $table->string('resource1')->nullable()->after('posted_time');
            $table->string('resource2')->nullable()->after('resource1');
            $table->string('resource3')->nullable()->after('resource2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thread_messages', function (Blueprint $table) {
            $table->dropColumn('resource1');
            $table->dropColumn('resource2');
            $table->dropColumn('resource3');
        });
    }
}
