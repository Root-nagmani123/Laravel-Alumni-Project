<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupMemberTable extends Migration
{
    public function up()
    {
        Schema::create('group_member', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('status');
            $table->string('mentor', 50)->nullable();
            $table->string('mentiee', 255)->nullable();
            $table->timestamps(); // for: created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_member');
    }
}