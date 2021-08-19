<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('author');
            $table->string('image');
            $table->longText('body');
            $table->longText('short_description');
            $table->integer('admin_approval')->default('0');
            $table->longText('reject_reason')->nullable();
            $table->timestamps();
            $table->longText('positives')->nullable();
            $table->longText('negatives')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
