<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /*   public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->text('content')->nullable();
            $table->enum('media_type', ['live', 'photo_video', 'none'])->default('none');
            $table->string('video_link')->nullable();
            $table->text('media_path')->nullable();
            $table->timestamps();

        });
    } */
	
	public function up()
	{
		if (!Schema::hasTable('posts')) {
			Schema::create('posts', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->foreignId('member_id')->constrained()->onDelete('cascade');
				$table->text('content')->nullable();
				$table->enum('media_type', ['live', 'photo_video', 'video_link', 'none'])->default('none');
				$table->string('video_link')->nullable();
				$table->text('media_path')->nullable();
				$table->timestamps();
			});
		}
	}

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
