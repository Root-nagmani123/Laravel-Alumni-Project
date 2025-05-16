<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToBroadcastsTable extends Migration
{
    public function up()
    {
        Schema::table('broadcasts', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->after('youtube_link');
        });
    }

    public function down()
    {
        Schema::table('broadcasts', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
