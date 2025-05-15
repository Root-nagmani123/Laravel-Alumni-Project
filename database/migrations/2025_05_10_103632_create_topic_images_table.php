<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicImagesTable extends Migration
{
    public function up()
    {
        Schema::create('topic_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id')->nullable();
            $table->string('name')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('topic_images');
    }
}
