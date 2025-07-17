<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tbl_countries', function (Blueprint $table) {
            if (!Schema::hasColumn('tbl_countries', 'status')) {
                $table->boolean('status')->default(1)->after('sortname');
            }
        });
    }

    public function down()
    {
        Schema::table('tbl_countries', function (Blueprint $table) {
            if (Schema::hasColumn('tbl_countries', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}; 